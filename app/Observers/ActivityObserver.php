<?php

namespace App\Observers;

use App\Models\ActivityLog;
use App\Services\ActivityMonitor;
use Illuminate\Database\Eloquent\Model;

class ActivityObserver
{
    protected ActivityMonitor $activityMonitor;

    public function __construct(ActivityMonitor $activityMonitor)
    {
        $this->activityMonitor = $activityMonitor;
    }

    /**
     * Handle the "created" event for any model
     */
    public function created(Model $model): void
    {
        $this->activityMonitor->logAction(
            'create',
            "Created {$this->getModelName($model)}: {$this->getModelIdentifier($model)}",
            get_class($model),
            $model->id,
            $this->getRelevantAttributes($model)
        );
    }

    /**
     * Handle the "updated" event for any model
     */
    public function updated(Model $model): void
    {
        // Only log if there were actual changes
        if ($model->wasRecentlyUpdated()) {
            $this->activityMonitor->logAction(
                'update',
                "Updated {$this->getModelName($model)}: {$this->getModelIdentifier($model)}",
                get_class($model),
                $model->id,
                array_keys($model->getChanges())
            );
        }
    }

    /**
     * Handle the "deleted" event for any model
     */
    public function deleted(Model $model): void
    {
        $this->activityMonitor->logAction(
            'delete',
            "Deleted {$this->getModelName($model)}: {$this->getModelIdentifier($model)}",
            get_class($model),
            $model->id,
            $this->getRelevantAttributes($model)
        );
    }

    /**
     * Get a human-readable model name
     */
    protected function getModelName(Model $model): string
    {
        $class = class_basename($model);
        return strtolower(preg_replace('/([a-z])([A-Z])/', '$1 $2', $class));
    }

    /**
     * Get a unique identifier for the model
     */
    protected function getModelIdentifier(Model $model): string
    {
        // Try common identifier fields
        if (isset($model->name)) {
            return "\"{$model->name}\" (ID: {$model->id})";
        }
        if (isset($model->title)) {
            return "\"{$model->title}\" (ID: {$model->id})";
        }
        if (isset($model->email)) {
            return "\"{$model->email}\" (ID: {$model->id})";
        }
        return "(ID: {$model->id})";
    }

    /**
     * Get relevant attributes for logging
     */
    protected function getRelevantAttributes(Model $model): array
    {
        $attributes = [];
        
        // Include common identifiable fields
        $logFields = ['name', 'email', 'title', 'status', 'amount', 'type'];
        
        foreach ($logFields as $field) {
            if (isset($model->$field)) {
                $attributes[$field] = $model->$field;
            }
        }
        
        return $attributes;
    }
}