<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Scholarship;
use Illuminate\Http\Request;

class ScholarshipController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $scholarships = Scholarship::latest()->paginate(10); // paginate 10 per page
        return view('admin.scholarships.index', compact('scholarships'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.scholarships.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'amount' => 'required|numeric|min:0',
            'eligibility_criteria' => 'nullable|string',
            'application_deadline' => 'required|date|after:today',
            'status' => 'required|in:active,inactive',
            'max_recipients' => 'required|integer|min:1',
            'academic_year' => 'required|string|max:20',
        ]);

        Scholarship::create($request->all());

        return redirect()->route('admin.scholarships.index')
                         ->with('success', 'Scholarship created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $scholarship = Scholarship::findOrFail($id);
        return view('admin.scholarships.show', compact('scholarship'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $scholarship = Scholarship::findOrFail($id);
        return view('admin.scholarships.edit', compact('scholarship'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $scholarship = Scholarship::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'amount' => 'required|numeric|min:0',
            'eligibility_criteria' => 'nullable|string',
            'application_deadline' => 'required|date|after:today',
            'status' => 'required|in:active,inactive',
            'max_recipients' => 'required|integer|min:1',
            'academic_year' => 'required|string|max:20',
        ]);

        $scholarship->update($request->all());

        return redirect()->route('admin.scholarships.index')
                         ->with('success', 'Scholarship updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $scholarship = Scholarship::findOrFail($id);
        $scholarship->delete();

        return redirect()->route('admin.scholarships.index')
                         ->with('success', 'Scholarship deleted successfully.');
    }

    public function approve(Scholarship $scholarship)
    {
        $scholarship->update(['approval_status' => 'approved']);
        return redirect()->back()->with('success', 'Scholarship approved. Students can now apply.');
    }

    public function reject(Scholarship $scholarship)
    {
        $scholarship->update(['approval_status' => 'rejected']);
        return redirect()->back()->with('success', 'Scholarship rejected.');
    }
}
