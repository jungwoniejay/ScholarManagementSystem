<?php

namespace App\Http\Controllers;

use App\Models\Application;
use App\Models\Document;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class StudentDocumentController extends Controller
{
    public function index()
    {
        $documents = Document::whereHas('application.student', function($query) {
            $query->where('user_id', auth()->id());
        })->with(['application.scholarship'])->paginate(10);

        return view('student.documents.index', compact('documents'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'application_id' => 'required|exists:applications,id',
            'documents'      => 'required|array|min:1|max:10',
            'documents.*'    => 'file|mimes:pdf,jpg,jpeg,png|max:10240',
        ]);

        // Ensure the application belongs to this student
        $application = Application::whereHas('student', function($q) {
            $q->where('user_id', auth()->id());
        })->findOrFail($request->application_id);

        foreach ($request->file('documents') as $file) {
            $path = $file->store('documents/applications/' . $application->id, 'public');
            Document::create([
                'application_id' => $application->id,
                'name'           => $file->getClientOriginalName(),
                'file_path'      => $path,
                'status'         => 'pending',
            ]);
        }

        return redirect()->route('student.documents.index')
            ->with('success', 'Documents uploaded successfully.');
    }
}
