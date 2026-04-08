<x-student-layout>
    <div class="px-8 py-10 max-w-7xl mx-auto">
        <!-- Header -->
        <div class="mb-8">
            <h1 class="text-3xl font-bold text-gray-900 mb-2">Available Scholarships</h1>
            <p class="text-gray-500">Explore and apply for scholarships that match your profile</p>
        </div>

        @if(session('success'))
            <div class="bg-green-50 border border-green-200 text-green-800 px-4 py-3 rounded-lg mb-6">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="bg-red-50 border border-red-200 text-red-800 px-4 py-3 rounded-lg mb-6">
                {{ session('error') }}
            </div>
        @endif

        <!-- Search and Filters -->
        <div class="bg-white rounded-xl shadow-sm border p-4 mb-6">
            <form method="GET" action="{{ route('student.scholarships.index') }}" class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div class="md:col-span-2">
                    <div class="relative">
                        <svg class="w-5 h-5 absolute left-3 top-1/2 -translate-y-1/2 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
                        </svg>
                        <input type="text" name="search" value="{{ $search ?? '' }}" placeholder="Search scholarships..."
                            class="w-full pl-10 pr-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent">
                    </div>
                </div>
                <div class="flex gap-2">
                    <select name="sort" class="flex-1 px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-purple-500 focus:border-transparent">
                        <option value="" {{ ($sort ?? '') === '' ? 'selected' : '' }}>Latest</option>
                        <option value="amount-high" {{ ($sort ?? '') === 'amount-high' ? 'selected' : '' }}>Highest Amount</option>
                        <option value="amount-low" {{ ($sort ?? '') === 'amount-low' ? 'selected' : '' }}>Lowest Amount</option>
                        <option value="deadline" {{ ($sort ?? '') === 'deadline' ? 'selected' : '' }}>Deadline</option>
                    </select>
                    <button type="submit" class="px-4 py-2 bg-purple-600 text-white rounded-lg hover:bg-purple-700 transition text-sm font-semibold">Search</button>
                </div>
            </form>
        </div>

        <!-- Scholarships Grid -->
        @if($scholarships->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
                @foreach($scholarships as $scholarship)
                    <div class="bg-white rounded-xl shadow-sm border overflow-hidden hover:shadow-lg hover:-translate-y-1 transition-all duration-300">
                        <!-- Card Header -->
                        <div class="p-6 pb-4">
                            <div class="flex items-start justify-between mb-4">
                                <div class="w-12 h-12 bg-gradient-to-br from-purple-500 to-pink-600 rounded-lg flex items-center justify-center text-white font-bold text-xl flex-shrink-0">
                                    {{ substr($scholarship->name, 0, 1) }}
                                </div>
                                @if($scholarship->isAcceptingApplications())
                                    <span class="px-3 py-1 rounded-full text-xs font-semibold bg-green-100 text-green-800">
                                        Accepting
                                    </span>
                                @else
                                    <span class="px-3 py-1 rounded-full text-xs font-semibold bg-gray-100 text-gray-800">
                                        Closed
                                    </span>
                                @endif
                            </div>

                            <h3 class="text-lg font-semibold text-gray-900 mb-2 line-clamp-1">{{ $scholarship->name }}</h3>
                            <p class="text-sm text-gray-500 mb-4">{{ $scholarship->academic_year }}</p>

                            <p class="text-sm text-gray-600 line-clamp-2 mb-4">{{ $scholarship->description ?? 'No description available' }}</p>

                            <!-- Key Details -->
                            <div class="space-y-2 mb-4">
                                <div class="flex justify-between text-sm">
                                    <span class="text-gray-500">Amount:</span>
                                    <span class="font-semibold text-gray-900">${{ number_format($scholarship->amount, 2) }}</span>
                                </div>
                                <div class="flex justify-between text-sm">
                                    <span class="text-gray-500">Recipients:</span>
                                    <span class="font-semibold text-gray-900">{{ $scholarship->max_recipients }}</span>
                                </div>
                                <div class="flex justify-between text-sm">
                                    <span class="text-gray-500">Deadline:</span>
                                    <span class="font-semibold text-gray-900">
                                        {{ $scholarship->application_deadline ? $scholarship->application_deadline->format('M d, Y') : 'No deadline' }}
                                    </span>
                                </div>
                            </div>

                            <!-- Funding Progress -->
                            <div class="mb-4">
                                <div class="flex justify-between text-xs mb-1">
                                    <span class="text-gray-500">Funding Progress</span>
                                    <span class="font-semibold text-gray-900">{{ number_format($scholarship->funding_progress, 1) }}%</span>
                                </div>
                                <div class="w-full bg-gray-200 rounded-full h-2">
                                    <div class="bg-gradient-to-r from-purple-500 to-pink-600 h-2 rounded-full" style="width: {{ $scholarship->funding_progress }}%"></div>
                                </div>
                            </div>
                        </div>

                        <!-- Card Footer -->
                        <div class="px-6 py-4 bg-gray-50 border-t border-gray-100">
                            <a href="{{ route('student.scholarships.show', $scholarship) }}" 
                               class="block w-full text-center bg-gradient-to-r from-purple-600 to-pink-600 text-white font-semibold py-2 px-4 rounded-lg hover:from-purple-700 hover:to-pink-700 transition-all duration-300">
                                {{ $scholarship->isAcceptingApplications() ? 'Apply Now' : 'View Details' }}
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="mt-8">
                {{ $scholarships->links() }}
            </div>
        @else
            <!-- Empty State -->
            <div class="bg-white rounded-xl shadow-sm border p-12 text-center">
                <div class="w-16 h-16 bg-gray-100 rounded-full flex items-center justify-center mx-auto mb-4">
                    <svg class="w-8 h-8 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                    </svg>
                </div>
                <h3 class="text-lg font-semibold text-gray-900 mb-2">No Scholarships Available</h3>
                <p class="text-gray-500 mb-6">There are currently no scholarships available for application. Check back later!</p>
                <a href="{{ route('student.dashboard') }}" class="inline-flex items-center text-purple-600 hover:text-purple-700 font-semibold">
                    <svg class="w-4 h-4 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"/>
                    </svg>
                    Back to Dashboard
                </a>
            </div>
        @endif
    </div>
</x-student-layout>
