<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Donator;
use App\Models\Scholarship;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DonatorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $donators = Donator::with('user')->paginate(10);
        return view('admin.donators.index', compact('donators'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $scholarships = Scholarship::all();
        return view('admin.donators.create', compact('scholarships'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'organization_name' => 'required|string|max:255',
            'contact_person' => 'required|string|max:255',
            'email' => 'required|email|unique:donators,email',
            'contact_number' => 'required|string|max:20',
            'total_fund' => 'required|numeric|min:0',
            'available_fund' => 'required|numeric|min:0|lte:total_fund',
            'scholarship_ids' => 'array',
            'scholarship_ids.*' => 'exists:scholarships,id',
        ]);

        DB::transaction(function () use ($request) {
            $donator = Donator::create($request->only([
                'organization_name',
                'contact_person',
                'email',
                'contact_number',
                'total_fund',
                'available_fund',
            ]));

            if ($request->has('scholarship_ids')) {
                $donator->scholarships()->attach($request->scholarship_ids);
            }
        });

        return redirect()->route('admin.donators.index')->with('success', 'Donator created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Donator $donator)
    {
        $donator->load('user', 'scholarships');
        return view('admin.donators.show', compact('donator'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Donator $donator)
    {
        $scholarships = Scholarship::all();
        $donator->load('scholarships');
        return view('admin.donators.edit', compact('donator', 'scholarships'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Donator $donator)
    {
        $request->validate([
            'organization_name' => 'required|string|max:255',
            'contact_person' => 'required|string|max:255',
            'email' => 'required|email|unique:donators,email,' . $donator->donator_id . ',donator_id',
            'contact_number' => 'required|string|max:20',
            'total_fund' => 'required|numeric|min:0',
            'available_fund' => 'required|numeric|min:0|lte:total_fund',
            'account_status' => 'required|in:active,inactive',
            'scholarship_ids' => 'array',
            'scholarship_ids.*' => 'exists:scholarships,id',
        ]);

        DB::transaction(function () use ($request, $donator) {
            $donator->update($request->only([
                'organization_name',
                'contact_person',
                'email',
                'contact_number',
                'total_fund',
                'available_fund',
                'account_status',
            ]));

            $donator->scholarships()->sync($request->scholarship_ids ?? []);
        });

        return redirect()->route('admin.donators.index')->with('success', 'Donator updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Donator $donator)
    {
        $donator->update(['account_status' => 'inactive']);
        return redirect()->route('admin.donators.index')->with('success', 'Donator deactivated successfully.');
    }
}
