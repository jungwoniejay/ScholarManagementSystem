<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AiRule;
use Illuminate\Http\Request;

class RuleController extends Controller
{
    public function index()
    {
        $rules = AiRule::orderBy('key')->paginate(20);
        return view('admin.rules.index', compact('rules'));
    }

    public function create()
    {
        return view('admin.rules.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'key'   => 'required|string|max:255|unique:ai_rules,key',
            'value' => 'required|string',
        ]);

        AiRule::create($data);

        return redirect()->route('admin.rules.index')->with('success', 'Rule created successfully.');
    }

    public function show(string $id)
    {
        $rule = AiRule::findOrFail($id);
        return view('admin.rules.show', compact('rule'));
    }

    public function edit(string $id)
    {
        $rule = AiRule::findOrFail($id);
        return view('admin.rules.edit', compact('rule'));
    }

    public function update(Request $request, string $id)
    {
        $rule = AiRule::findOrFail($id);

        $data = $request->validate([
            'key'   => 'required|string|max:255|unique:ai_rules,key,' . $id,
            'value' => 'required|string',
        ]);

        $rule->update($data);

        return redirect()->route('admin.rules.index')->with('success', 'Rule updated successfully.');
    }

    public function destroy(string $id)
    {
        AiRule::findOrFail($id)->delete();
        return redirect()->route('admin.rules.index')->with('success', 'Rule deleted successfully.');
    }
}
