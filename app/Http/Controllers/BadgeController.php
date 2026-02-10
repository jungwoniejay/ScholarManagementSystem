<?php

namespace App\Http\Controllers;

use App\Models\Badge;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class BadgeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $badges = Badge::all();
        return view('badges.index', compact('badges'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('badges.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'icon' => 'required|string|max:255',
            'criteria_type' => 'required|in:tasks_completed,projects_created,bugs_reported,ideas_submitted,teams_joined',
            'criteria_value' => 'required|integer|min:1',
        ]);

        Badge::create([
            'name' => $request->name,
            'description' => $request->description,
            'icon' => $request->icon,
            'criteria_type' => $request->criteria_type,
            'criteria_value' => $request->criteria_value,
            'is_system_default' => false,
        ]);

        return redirect()->route('badges.index')->with('success', 'Badge created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Badge $badge): View
    {
        return view('badges.show', compact('badge'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Badge $badge): View
    {
        return view('badges.edit', compact('badge'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Badge $badge): RedirectResponse
    {
        if ($badge->is_system_default) {
            // For system default badges, only allow updating criteria
            $request->validate([
                'criteria_type' => 'required|in:tasks_completed,projects_created,bugs_reported,ideas_submitted,teams_joined',
                'criteria_value' => 'required|integer|min:1',
            ]);

            $badge->update([
                'criteria_type' => $request->criteria_type,
                'criteria_value' => $request->criteria_value,
            ]);
        } else {
            // For custom badges, allow full update
            $request->validate([
                'name' => 'required|string|max:255',
                'description' => 'nullable|string',
                'icon' => 'required|string|max:255',
                'criteria_type' => 'required|in:tasks_completed,projects_created,bugs_reported,ideas_submitted,teams_joined',
                'criteria_value' => 'required|integer|min:1',
            ]);

            $badge->update($request->only(['name', 'description', 'icon', 'criteria_type', 'criteria_value']));
        }

        return redirect()->route('badges.index')->with('success', 'Badge updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Badge $badge): RedirectResponse
    {
        // Prevent deletion of system default badges
        if ($badge->is_system_default) {
            return redirect()->route('badges.index')->with('error', 'Cannot delete system default badges.');
        }

        $badge->delete();
        return redirect()->route('badges.index')->with('success', 'Badge deleted successfully.');
    }
}
