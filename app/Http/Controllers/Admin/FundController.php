<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Donation;
use App\Models\Donator;
use App\Models\Scholarship;
use App\Models\Application;
use Illuminate\Http\Request;

class FundController extends Controller
{
    public function monitor()
    {
        // Get donation statistics
        $totalDonations = Donation::count();
        $totalDonationAmount = Donation::sum('amount');
        
        // Get donator statistics
        $totalDonors = Donator::count();
        $activeDonors = Donator::where('account_status', 'active')->count();
        $totalDonorFunds = Donator::sum('total_fund');
        $availableDonorFunds = Donator::sum('available_fund');
        
        // Get scholarship funding
        $totalScholarshipAmount = Scholarship::where('status', 'active')->sum('amount');
        $approvedApplications = Application::where('status', 'approved')->sum('awarded_amount');
        
        // Get recent donations
        $recentDonations = Donation::with('donator')->orderBy('donation_date', 'desc')->take(10)->get();
        
        // Get donations by month for chart
        $donationsByMonth = Donation::selectRaw('MONTH(donation_date) as month, SUM(amount) as total')
            ->whereYear('donation_date', date('Y'))
            ->groupBy('month')
            ->get();
        
        // Get top donors
        $topDonors = Donator::withSum('donations', 'amount')
            ->orderBy('donations_sum_amount', 'desc')
            ->take(5)
            ->get();

        return view('admin.funds.monitor', compact(
            'totalDonations',
            'totalDonationAmount',
            'totalDonors',
            'activeDonors',
            'totalDonorFunds',
            'availableDonorFunds',
            'totalScholarshipAmount',
            'approvedApplications',
            'recentDonations',
            'donationsByMonth',
            'topDonors'
        ));
    }
}
