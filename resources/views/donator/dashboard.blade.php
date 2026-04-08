@extends('layouts.app')

@section('content')
    <div class="flex h-screen bg-gradient-to-br from-slate-50 via-blue-50/30 to-slate-50">

        <!-- Main content -->
        <div class="flex-1 flex flex-col overflow-hidden">

            <!-- Content -->
            <main class="flex-1 overflow-y-auto p-4 sm:p-6 lg:p-8">
                <div class="max-w-7xl mx-auto space-y-8">

                    <!-- PHP DATA -->
                    @php
                        $donator = \App\Models\Donator::where('user_id', auth()->id())->first();
                        $totalFund = $donator->total_fund ?? 0;
                        $availableFund = $donator->available_fund ?? 0;
                        $scholarshipsFunded = $donator?->scholarships()->count() ?? 0;
                        $activeScholarships = \App\Models\Scholarship::where('status', 'active')->count();
                    @endphp

                    <!-- Stats -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">

                        <!-- Total Fund -->
                        <div class="bg-white p-6 rounded-2xl shadow border">
                            <p class="text-sm text-slate-600">Total Fund</p>
                            <p class="text-3xl font-bold">₱{{ number_format($totalFund) }}</p>
                        </div>

                        <!-- Available Fund -->
                        <div class="bg-white p-6 rounded-2xl shadow border">
                            <p class="text-sm text-slate-600">Available Fund</p>
                            <p class="text-3xl font-bold">₱{{ number_format($availableFund) }}</p>
                        </div>

                        <!-- Funded Scholarships -->
                        <div class="bg-white p-6 rounded-2xl shadow border">
                            <p class="text-sm text-slate-600">Scholarships Funded</p>
                            <p class="text-3xl font-bold">{{ $scholarshipsFunded }}</p>
                        </div>

                        <!-- Active Scholarships -->
                        <div class="bg-white p-6 rounded-2xl shadow border">
                            <p class="text-sm text-slate-600">Available Scholarships</p>
                            <p class="text-3xl font-bold">{{ $activeScholarships }}</p>
                        </div>

                    </div>

                    <!-- Funded Scholarships List -->
                    <div class="bg-white p-6 rounded-2xl shadow border">
                        <h3 class="text-lg font-bold mb-4">Your Funded Scholarships</h3>

                        <div class="space-y-3">
                            @forelse(($donator ? $donator->scholarships : collect()) as $scholarship)
                                <div class="flex items-center justify-between p-4 bg-slate-50 rounded-xl">
                                    <div class="flex items-center space-x-3">
                                        <div class="w-10 h-10 rounded-full bg-purple-500 text-white flex items-center justify-center font-bold">
                                            {{ substr($scholarship->name, 0, 1) }}
                                        </div>
                                        <div>
                                            <p class="font-semibold">{{ $scholarship->name }}</p>
                                            <p class="text-sm text-slate-500">
                                                Funded {{ $scholarship->created_at?->diffForHumans() }}
                                            </p>
                                        </div>
                                    </div>
                                    <span class="text-xs px-3 py-1 bg-green-100 text-green-700 rounded-full font-semibold">
                                        Active
                                    </span>
                                </div>
                            @empty
                                <div class="text-center text-slate-400 py-8">
                                    <p class="font-semibold">No funded scholarships yet</p>
                                    <p class="text-sm">Start supporting education today</p>
                                </div>
                            @endforelse
                        </div>
                    </div>

                </div>
            </main>
        </div>
    </div>
@endsection
