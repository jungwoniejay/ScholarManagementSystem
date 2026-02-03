<?php

namespace App\Http\Controllers;

use App\Models\Document;
use Illuminate\Http\Request;

class StudentDocumentController extends Controller
{
    public function index()
    {
        $documents = Document::whereHas('application.student', function($query) {
            $query->where('user_id', auth()->id());
        })->with(['application.scholarship'])->paginate(10);

        return view('student.documents.index', compact('documents'));
    }
}
