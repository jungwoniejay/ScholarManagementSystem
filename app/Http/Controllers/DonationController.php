<?php

namespace App\Http\Controllers;

use App\Models\Donation;
use Illuminate\Http\Request;

class DonationController extends Controller
{
    public function index()
    {
        $donations = Donation::latest()->paginate(10);
        return view('donator.donation', compact('donations'));
    }

    public function create()
    {
        return view('donator.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'donor_name' => 'required',
            'amount' => 'required|numeric',
            'donation_date' => 'required|date',
        ]);

        Donation::create($request->all());

        return redirect()->route('donators')
            ->with('success', 'Donation added successfully');
    }

    public function show(Donation $donation)
    {
        return view('donator.view', compact('donation'));
    }

    public function edit(Donation $donation)
    {
        return view('donator.edit', compact('donation'));
    }

    public function update(Request $request, Donation $donation)
    {
        $request->validate([
            'donor_name' => 'required',
            'amount' => 'required|numeric',
            'donation_date' => 'required|date',
        ]);

        $donation->update($request->all());

        return redirect()->route('donators')
            ->with('success', 'Donation updated');
    }

    public function destroy(Donation $donation)
    {
        $donation->delete();

        return redirect()->route('donators')
            ->with('success', 'Donation deleted');
    }
}
