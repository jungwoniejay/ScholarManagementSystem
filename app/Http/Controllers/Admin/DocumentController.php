<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Document;
use Illuminate\Http\Request;

class DocumentController extends Controller
{
    public function verify()
    {
        $documents = Document::with(['application.student.user'])
            ->where('status', 'pending')
            ->latest()
            ->paginate(15);

        return view('admin.documents.verify', compact('documents'));
    }

    public function approve(Document $document)
    {
        $document->update([
            'status'      => 'verified',
            'verified_at' => now(),
            'verified_by' => auth()->id(),
        ]);

        return back()->with('success', 'Document verified successfully.');
    }

    public function reject(Request $request, Document $document)
    {
        $request->validate(['remarks' => 'nullable|string|max:500']);

        $document->update([
            'status'  => 'rejected',
            'remarks' => $request->remarks,
        ]);

        return back()->with('success', 'Document rejected.');
    }
}
