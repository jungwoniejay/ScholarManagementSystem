<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AdminAccount;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminAccountController extends Controller
{
    public function index()
    {
        $admins = AdminAccount::paginate(10);
        return view('admin.accounts.index', compact('admins'));
    }

    public function create()
    {
        return view('admin.accounts.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'full_name'      => 'required|string|max:255',
            'role'           => 'required|string|max:50',
            'email'          => 'required|email|unique:admin_accounts,email',
            'contact_number' => 'nullable|string|max:20',
            'password'       => 'required|string|min:8|confirmed',
        ]);

        $data['password'] = Hash::make($data['password']);
        AdminAccount::create($data);

        return redirect()->route('admin.accounts.index')->with('success', 'Admin account created successfully.');
    }

    public function show(string $id)
    {
        $account = AdminAccount::findOrFail($id);
        return view('admin.accounts.show', compact('account'));
    }

    public function edit(string $id)
    {
        $account = AdminAccount::findOrFail($id);
        return view('admin.accounts.edit', compact('account'));
    }

    public function update(Request $request, string $id)
    {
        $account = AdminAccount::findOrFail($id);

        $data = $request->validate([
            'full_name'      => 'required|string|max:255',
            'role'           => 'required|string|max:50',
            'email'          => 'required|email|unique:admin_accounts,email,' . $id,
            'contact_number' => 'nullable|string|max:20',
            'password'       => 'nullable|string|min:8|confirmed',
        ]);

        if (empty($data['password'])) {
            unset($data['password']);
        } else {
            $data['password'] = Hash::make($data['password']);
        }

        $account->update($data);

        return redirect()->route('admin.accounts.index')->with('success', 'Admin account updated successfully.');
    }

    public function destroy(string $id)
    {
        AdminAccount::findOrFail($id)->delete();
        return redirect()->route('admin.accounts.index')->with('success', 'Admin account deleted successfully.');
    }
}
