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

        // Get the logged-in user's donator record
        $donator = \App\Models\Donator::where('user_id', auth()->id())->first();

        $donationData = $request->all();
        
        // Auto-link to donator if user is logged in as donator
        if ($donator) {
            $donationData['donator_id'] = $donator->donator_id;
            // Auto-fill donor_name and email from donator if not provided
            $donationData['donor_name'] = $donationData['donor_name'] ?? $donator->contact_person;
            $donationData['email'] = $donationData['email'] ?? $donator->email;
        }

        Donation::create($donationData);

        // Update donator's total_fund if linked
        if ($donator) {
            $donator->increment('total_fund', $request->amount);
            $donator->increment('available_fund', $request->amount);
        }

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
