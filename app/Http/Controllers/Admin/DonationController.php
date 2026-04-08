<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Donation;
use App\Models\Donator;
use Illuminate\Http\Request;

class DonationController extends Controller
{
    /**
     * Display a listing of all donations.
     */
    public function index(Request $request)
    {
        $query = Donation::with('donator');

        // Filter by donator
        if ($request->has('donator_id') && $request->donator_id) {
            $query->where('donator_id', $request->donator_id);
        }

        // Filter by date range
        if ($request->has('start_date') && $request->start_date) {
            $query->where('donation_date', '>=', $request->start_date);
        }
        if ($request->has('end_date') && $request->end_date) {
            $query->where('donation_date', '<=', $request->end_date);
        }

        // Filter by method
        if ($request->has('method') && $request->method) {
            $query->where('method', $request->method);
        }

        $donations = $query->orderBy('donation_date', 'desc')->paginate(15);
        $donators = Donator::all();
        
        // Calculate totals
        $totalDonations = Donation::count();
        $totalAmount = Donation::sum('amount');
        $totalByMethod = Donation::select('method')
            ->selectRaw('COUNT(*) as count, SUM(amount) as total')
            ->groupBy('method')
            ->get();

        return view('admin.donations.index', compact('donations', 'donators', 'totalDonations', 'totalAmount', 'totalByMethod'));
    }

    /**
     * Display donation statistics for the dashboard.
     */
    public function statistics()
    {
        $totalDonations = Donation::count();
        $totalAmount = Donation::sum('amount');
        $recentDonations = Donation::with('donator')->latest()->take(10)->get();
        
        $donationsByMonth = Donation::selectRaw('MONTH(donation_date) as month, SUM(amount) as total')
            ->whereYear('donation_date', date('Y'))
            ->groupBy('month')
            ->get();

        $topDonators = Donator::withCount('donations')
            ->withSum('donations', 'amount')
            ->orderBy('donations_sum_amount', 'desc')
            ->take(5)
            ->get();

        return view('admin.donations.statistics', compact('totalDonations', 'totalAmount', 'recentDonations', 'donationsByMonth', 'topDonators'));
    }

    /**
     * Export donations as CSV.
     */
    public function export(Request $request)
    {
        $query = Donation::with('donator');

        if ($request->donator_id) {
            $query->where('donator_id', $request->donator_id);
        }
        if ($request->start_date) {
            $query->where('donation_date', '>=', $request->start_date);
        }
        if ($request->end_date) {
            $query->where('donation_date', '<=', $request->end_date);
        }
        if ($request->method) {
            $query->where('method', $request->method);
        }

        $donations = $query->orderBy('donation_date', 'desc')->get();
        $filename  = 'donations_' . date('Y-m-d_His') . '.csv';

        $headers = [
            'Content-Type'        => 'text/csv',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ];

        $callback = function () use ($donations) {
            $file = fopen('php://output', 'w');
            fputcsv($file, ['ID', 'Donator', 'Donor Name', 'Email', 'Amount', 'Method', 'Date']);
            foreach ($donations as $d) {
                fputcsv($file, [
                    $d->id,
                    $d->donator->organization_name ?? 'Guest',
                    $d->donor_name,
                    $d->email ?? '',
                    $d->amount,
                    $d->method ?? '',
                    $d->donation_date,
                ]);
            }
            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    /**
     * Display the specified donation.
     */
    public function show(Donation $donation)
    {
        $donation->load('donator');
        return view('admin.donations.show', compact('donation'));
    }

    public function approve(Request $request, Donation $donation)
    {
        if ($donation->approval_status !== 'pending') {
            return redirect()->back()->with('error', 'Donation has already been processed.');
        }

        $donation->update([
            'approval_status' => 'approved',
            'approved_at'     => now(),
            'admin_remarks'   => $request->admin_remarks,
        ]);

        // Credit the donator's funds
        if ($donation->donator) {
            $donation->donator->increment('total_fund', $donation->amount);
            $donation->donator->increment('available_fund', $donation->amount);
        }

        return redirect()->back()->with('success', 'Donation approved and funds credited to donor.');
    }

    public function reject(Request $request, Donation $donation)
    {
        if ($donation->approval_status !== 'pending') {
            return redirect()->back()->with('error', 'Donation has already been processed.');
        }

        $donation->update([
            'approval_status' => 'rejected',
            'approved_at'     => now(),
            'admin_remarks'   => $request->admin_remarks,
        ]);

        return redirect()->back()->with('success', 'Donation rejected.');
    }
}
