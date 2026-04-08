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
        $scholarships = \App\Models\Scholarship::where('status', 'active')->orderBy('name')->get();
        return view('donator.create', compact('scholarships'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'scholarship_id' => 'required|exists:scholarships,id',
            'donor_name'     => 'required',
            'amount'         => 'required|numeric',
            'donation_date'  => 'required|date',
        ]);

        $donator = \App\Models\Donator::where('user_id', auth()->id())->first();

        $donationData = $request->only(['scholarship_id', 'donor_name', 'email', 'amount', 'method', 'message', 'donation_date']);

        if ($donator) {
            $donationData['donator_id'] = $donator->donator_id;
            $donationData['donor_name'] = $donationData['donor_name'] ?? $donator->contact_person;
            $donationData['email']      = $donationData['email'] ?? $donator->email;
        }

        Donation::create($donationData);

        return redirect()->route('donator.donations.index')
            ->with('success', 'Donation submitted and awaiting admin approval.');
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

        return redirect()->route('donator.donations.index')
            ->with('success', 'Donation updated');
    }

    public function destroy(Donation $donation)
    {
        $donation->delete();

        return redirect()->route('donator.donations.index')
            ->with('success', 'Donation deleted');
    }
}
