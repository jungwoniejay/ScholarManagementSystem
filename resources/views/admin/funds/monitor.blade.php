<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight" style="color:#e2e8f0;">Fund Monitoring</h2>
    </x-slot>

    <div class="max-w-7xl mx-auto space-y-6">

        {{-- Stats --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
            @foreach([
                ['label'=>'Total Donations','value'=>number_format($totalDonations),'sub'=>null,'color'=>'#60a5fa'],
                ['label'=>'Total Amount','value'=>'₱'.number_format($totalDonationAmount,2),'sub'=>null,'color'=>'#4ade80'],
                ['label'=>'Total Donors','value'=>number_format($totalDonors),'sub'=>$activeDonors.' active','color'=>'#a78bfa'],
                ['label'=>'Available Funds','value'=>'₱'.number_format($availableDonorFunds,2),'sub'=>null,'color'=>'#fbbf24'],
            ] as $stat)
            <div class="p-5 rounded-xl" style="background:#0F2044;border:1px solid #1E3A8A;">
                <p class="text-xs font-semibold mb-1" style="color:#8b949e;">{{ $stat['label'] }}</p>
                <p class="text-2xl font-bold" style="color:{{ $stat['color'] }};">{{ $stat['value'] }}</p>
                @if($stat['sub'])<p class="text-xs mt-1" style="color:#8b949e;">{{ $stat['sub'] }}</p>@endif
            </div>
            @endforeach
        </div>

        {{-- Scholarship Funding + Top Donors --}}
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6">

            <div class="rounded-xl p-6" style="background:#0F2044;border:1px solid #1E3A8A;">
                <h3 class="text-sm font-bold mb-4" style="color:#FFD700;">Scholarship Funding</h3>
                <div class="space-y-3">
                    <div class="flex justify-between items-center">
                        <span class="text-sm" style="color:#8b949e;">Total Scholarship Amount</span>
                        <span class="text-sm font-bold" style="color:#e2e8f0;">₱{{ number_format($totalScholarshipAmount, 2) }}</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-sm" style="color:#8b949e;">Approved Applications</span>
                        <span class="text-sm font-bold" style="color:#e2e8f0;">₱{{ number_format($approvedApplications, 2) }}</span>
                    </div>
                    <div class="flex justify-between items-center pt-3" style="border-top:1px solid #1E3A8A;">
                        <span class="text-sm font-semibold" style="color:#8b949e;">Remaining</span>
                        <span class="text-sm font-bold" style="color:#4ade80;">₱{{ number_format($totalScholarshipAmount - $approvedApplications, 2) }}</span>
                    </div>
                </div>
            </div>

            <div class="rounded-xl p-6" style="background:#0F2044;border:1px solid #1E3A8A;">
                <h3 class="text-sm font-bold mb-4" style="color:#FFD700;">Top Donors</h3>
                @if($topDonors->count() > 0)
                    <div class="space-y-3">
                        @foreach($topDonors as $donor)
                        <div class="flex items-center justify-between p-3 rounded-lg" style="background:#0A1628;border:1px solid #1E3A8A;">
                            <div class="flex items-center gap-3">
                                <div class="w-8 h-8 rounded-lg flex items-center justify-center text-xs font-bold flex-shrink-0"
                                     style="background:linear-gradient(135deg,#FFD700,#B8860B);color:#0A1628;">
                                    {{ substr($donor->organization_name, 0, 1) }}
                                </div>
                                <span class="text-sm font-medium" style="color:#e2e8f0;">{{ $donor->organization_name }}</span>
                            </div>
                            <span class="text-sm font-semibold" style="color:#4ade80;">₱{{ number_format($donor->donations_sum_amount ?? 0, 2) }}</span>
                        </div>
                        @endforeach
                    </div>
                @else
                    <p class="text-sm text-center py-4" style="color:#8b949e;">No donors yet</p>
                @endif
            </div>
        </div>

        {{-- Recent Donations --}}
        <div class="rounded-xl overflow-hidden" style="background:#0F2044;border:1px solid #1E3A8A;">
            <div class="px-6 py-4" style="border-bottom:1px solid #1E3A8A;">
                <h3 class="text-sm font-bold" style="color:#e2e8f0;">Recent Donations</h3>
            </div>
            @if($recentDonations->count() > 0)
            <div class="overflow-x-auto">
                <table class="min-w-full">
                    <thead>
                        <tr style="background:#0A1628;border-bottom:1px solid #1E3A8A;">
                            <th class="px-6 py-3 text-left text-xs font-semibold uppercase" style="color:#8b949e;">Donor</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold uppercase" style="color:#8b949e;">Amount</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold uppercase" style="color:#8b949e;">Method</th>
                            <th class="px-6 py-3 text-left text-xs font-semibold uppercase" style="color:#8b949e;">Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($recentDonations as $donation)
                        <tr style="border-bottom:1px solid #1E3A8A;">
                            <td class="px-6 py-4 text-sm font-medium" style="color:#e2e8f0;">
                                {{ $donation->donator->organization_name ?? $donation->donor_name }}
                            </td>
                            <td class="px-6 py-4 text-sm font-semibold" style="color:#4ade80;">₱{{ number_format($donation->amount, 2) }}</td>
                            <td class="px-6 py-4">
                                @if($donation->method)
                                    <span class="px-2 py-1 text-xs font-semibold rounded-full"
                                          style="background:rgba(96,165,250,0.15);color:#60a5fa;">{{ $donation->method }}</span>
                                @else
                                    <span style="color:#8b949e;">—</span>
                                @endif
                            </td>
                            <td class="px-6 py-4 text-sm" style="color:#8b949e;">{{ $donation->donation_date->format('M d, Y') }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @else
                <p class="px-6 py-8 text-center text-sm" style="color:#8b949e;">No donations recorded yet</p>
            @endif
        </div>

        {{-- By Month --}}
        @if($donationsByMonth->count() > 0)
        <div class="rounded-xl p-6" style="background:#0F2044;border:1px solid #1E3A8A;">
            <h3 class="text-sm font-bold mb-4" style="color:#e2e8f0;">Donations This Year</h3>
            @php $months = ['','Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec']; @endphp
            <div class="grid grid-cols-2 sm:grid-cols-4 lg:grid-cols-6 gap-3">
                @foreach($donationsByMonth as $data)
                <div class="p-3 rounded-xl text-center" style="background:#0A1628;border:1px solid #1E3A8A;">
                    <p class="text-xs mb-1" style="color:#8b949e;">{{ $months[$data->month] }}</p>
                    <p class="text-sm font-bold" style="color:#4ade80;">₱{{ number_format($data->total, 0) }}</p>
                </div>
                @endforeach
            </div>
        </div>
        @endif
    </div>
</x-app-layout>
