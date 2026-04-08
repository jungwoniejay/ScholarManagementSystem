<x-app-layout>
    <div class="px-8 py-10 max-w-7xl mx-auto">

        <!-- Back to Dashboard -->
        <a href="{{ route('admin.dashboard') }}"
           class="inline-flex items-center gap-2 mb-6 text-sm font-medium text-gray-600 hover:text-gray-900 transition">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M15 19l-7-7 7-7"/>
            </svg>
            Back to Dashboard
        </a>

        <!-- Header -->
        <div class="mb-8">
            <h1 class="text-3xl font-extrabold text-gray-900">System Maintenance</h1>
            <p class="text-sm text-gray-500 mt-1">
                Manage database exports, system cache, and monitor system health
            </p>
        </div>

        <!-- Success/Error Alerts -->
        @if(session('success'))
            <div id="success-alert" class="mb-6 flex items-center gap-3 p-4 bg-green-50 border border-green-200 text-green-800 rounded-xl shadow-sm">
                <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                <span>{{ session('success') }}</span>
                <button onclick="this.parentElement.remove()" class="ml-auto text-green-600 hover:text-green-800">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
        @endif

        @if(session('error'))
            <div id="error-alert" class="mb-6 flex items-center gap-3 p-4 bg-red-50 border border-red-200 text-red-800 rounded-xl shadow-sm">
                <svg class="w-5 h-5 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                </svg>
                <span>{{ session('error') }}</span>
                <button onclick="this.parentElement.remove()" class="ml-auto text-red-600 hover:text-red-800">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
        @endif

        <!-- Quick Stats Bar -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-8">
            <div class="bg-white rounded-2xl shadow-md border border-gray-200 p-4 flex items-center gap-4">
                <div class="p-3 bg-indigo-100 rounded-xl">
                    <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M4 7v10c0 2.21 3.582 4 8 4s8-1.79 8-4V7M4 7c0 2.21 3.582 4 8 4s8-1.79 8-4M4 7c0-2.21 3.582-4 8-4s8 1.79 8 4m0 5c0 2.21-3.582 4-8 4s-8-1.79-8-4"/>
                    </svg>
                </div>
                <div>
                    <p class="text-2xl font-bold text-gray-900">{{ count($tables) }}</p>
                    <p class="text-xs text-gray-500 font-medium">Database Tables</p>
                </div>
            </div>
            
            <div class="bg-white rounded-2xl shadow-md border border-gray-200 p-4 flex items-center gap-4">
                <div class="p-3 bg-emerald-100 rounded-xl">
                    <svg class="w-6 h-6 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                    </svg>
                </div>
                <div>
                    <p class="text-2xl font-bold text-gray-900">{{ number_format(array_sum(array_column($tables, 'row_count'))) }}</p>
                    <p class="text-xs text-gray-500 font-medium">Total Records</p>
                </div>
            </div>
            
            <div class="bg-white rounded-2xl shadow-md border border-gray-200 p-4 flex items-center gap-4">
                <div class="p-3 bg-amber-100 rounded-xl">
                    <svg class="w-6 h-6 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                    </svg>
                </div>
                <div>
                    <p class="text-2xl font-bold text-gray-900">{{ $cacheInfo['driver'] === 'file' ? 'File' : ucfirst($cacheInfo['driver']) }}</p>
                    <p class="text-xs text-gray-500 font-medium">Cache Driver</p>
                </div>
            </div>
            
            <div class="bg-white rounded-2xl shadow-md border border-gray-200 p-4 flex items-center gap-4">
                <div class="p-3 {{ config('app.debug') ? 'bg-red-100' : 'bg-green-100' }} rounded-xl">
                    <svg class="w-6 h-6 {{ config('app.debug') ? 'text-red-600' : 'text-green-600' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
                    </svg>
                </div>
                <div>
                    <p class="text-2xl font-bold text-gray-900">{{ config('app.debug') ? 'Debug' : 'Live' }}</p>
                    <p class="text-xs text-gray-500 font-medium">Environment</p>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            
            <!-- Left Column - Database Export -->
            <div class="lg:col-span-2 space-y-6">
                
                <!-- Database Export Section -->
                <div class="bg-white rounded-3xl shadow-lg border border-gray-200 overflow-hidden">
                    <div class="px-6 py-5 border-b border-gray-200 bg-gradient-to-r from-indigo-50 to-blue-50">
                        <div class="flex items-center gap-3">
                            <div class="p-2 bg-indigo-100 rounded-lg">
                                <svg class="w-5 h-5 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M4 7v10c0 2.21 3.582 4 8 4s8-1.79 8-4V7M4 7c0 2.21 3.582 4 8 4s8-1.79 8-4M4 7c0-2.21 3.582-4 8-4s8 1.79 8 4m0 5c0 2.21-3.582 4-8 4s-8-1.79-8-4"/>
                                </svg>
                            </div>
                            <div>
                                <h2 class="text-lg font-bold text-gray-900">Database Export</h2>
                                <p class="text-sm text-gray-500">Export your database for backup and analysis</p>
                            </div>
                        </div>
                    </div>

                    <div class="p-6">
                        <form action="{{ route('admin.maintenance.export') }}" method="POST" id="export-form">
                            @csrf
                            
                            <!-- Export Format Selection -->
                            <div class="mb-6">
                                <label class="block text-sm font-semibold text-gray-700 mb-3">Export Format</label>
                                <div class="grid grid-cols-3 gap-3">
                                    <label class="relative cursor-pointer group">
                                        <input type="radio" name="format" value="sql" class="peer sr-only" checked>
                                        <div class="flex flex-col items-center p-4 rounded-xl border-2 border-gray-200 peer-checked:border-indigo-500 peer-checked:bg-indigo-50 transition-all hover:border-gray-300 hover:shadow-md">
                                            <svg class="w-6 h-6 text-gray-500 peer-checked:text-indigo-600 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                      d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"/>
                                            </svg>
                                            <span class="text-sm font-medium text-gray-700 peer-checked:text-indigo-700">SQL</span>
                                            <span class="text-xs text-gray-400 peer-checked:text-indigo-500 mt-1">Full backup</span>
                                        </div>
                                    </label>
                                    <label class="relative cursor-pointer group">
                                        <input type="radio" name="format" value="csv" class="peer sr-only">
                                        <div class="flex flex-col items-center p-4 rounded-xl border-2 border-gray-200 peer-checked:border-indigo-500 peer-checked:bg-indigo-50 transition-all hover:border-gray-300 hover:shadow-md">
                                            <svg class="w-6 h-6 text-gray-500 peer-checked:text-indigo-600 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                      d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                                            </svg>
                                            <span class="text-sm font-medium text-gray-700 peer-checked:text-indigo-700">CSV</span>
                                            <span class="text-xs text-gray-400 peer-checked:text-indigo-500 mt-1">Spreadsheet</span>
                                        </div>
                                    </label>
                                    <label class="relative cursor-pointer group">
                                        <input type="radio" name="format" value="json" class="peer sr-only">
                                        <div class="flex flex-col items-center p-4 rounded-xl border-2 border-gray-200 peer-checked:border-indigo-500 peer-checked:bg-indigo-50 transition-all hover:border-gray-300 hover:shadow-md">
                                            <svg class="w-6 h-6 text-gray-500 peer-checked:text-indigo-600 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                      d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"/>
                                            </svg>
                                            <span class="text-sm font-medium text-gray-700 peer-checked:text-indigo-700">JSON</span>
                                            <span class="text-xs text-gray-400 peer-checked:text-indigo-500 mt-1">API ready</span>
                                        </div>
                                    </label>
                                </div>
                            </div>

                            <!-- Table Selection -->
                            <div class="mb-6">
                                <div class="flex items-center justify-between mb-3">
                                    <label class="block text-sm font-semibold text-gray-700">Select Tables</label>
                                    <div class="flex items-center gap-2">
                                        <button type="button" id="select-all" class="text-sm text-indigo-600 hover:text-indigo-800 font-medium">
                                            Select All
                                        </button>
                                        <span class="text-gray-300">|</span>
                                        <button type="button" id="deselect-all" class="text-sm text-gray-500 hover:text-gray-700 font-medium">
                                            Deselect All
                                        </button>
                                    </div>
                                </div>
                                
                                <div class="max-h-64 overflow-y-auto border border-gray-200 rounded-xl">
                                    <table class="min-w-full divide-y divide-gray-200">
                                        <thead class="bg-gray-50 sticky top-0">
                                            <tr>
                                                <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase w-10">
                                                    <input type="checkbox" id="select-all-checkbox" class="rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
                                                </th>
                                                <th class="px-4 py-3 text-left text-xs font-semibold text-gray-500 uppercase">Table Name</th>
                                                <th class="px-4 py-3 text-center text-xs font-semibold text-gray-500 uppercase">Rows</th>
                                                <th class="px-4 py-3 text-center text-xs font-semibold text-gray-500 uppercase">Size</th>
                                            </tr>
                                        </thead>
                                        <tbody class="divide-y divide-gray-100 bg-white">
                                            @forelse($tables as $table)
                                                <tr class="hover:bg-gray-50 transition">
                                                    <td class="px-4 py-3">
                                                        <input type="checkbox" name="tables[]" value="{{ $table['name'] }}" 
                                                               class="table-checkbox rounded border-gray-300 text-indigo-600 focus:ring-indigo-500">
                                                    </td>
                                                    <td class="px-4 py-3 text-sm font-medium text-gray-900">
                                                        <div class="flex items-center gap-2">
                                                            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                                      d="M3 10h18M3 14h18m-9-4v8m-7 0h14a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z"/>
                                                            </svg>
                                                            {{ $table['name'] }}
                                                        </div>
                                                    </td>
                                                    <td class="px-4 py-3 text-sm text-gray-600 text-center">
                                                        {{ number_format($table['row_count']) }}
                                                    </td>
                                                    <td class="px-4 py-3 text-sm text-gray-600 text-center">
                                                        {{ $table['size_mb'] }} MB
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="4" class="px-4 py-8 text-center text-gray-400">
                                                        No tables found in the database.
                                                    </td>
                                                </tr>
                                            @endforelse
                                        </tbody>
                                    </table>
                                </div>
                                <p class="text-xs text-gray-500 mt-2">
                                    <span id="selected-count">0</span> table(s) selected
                                </p>
                            </div>

                            <!-- Export Button -->
                            <button type="submit" id="export-btn" 
                                    class="w-full flex items-center justify-center gap-2 px-6 py-3 bg-indigo-600 text-white rounded-xl hover:bg-indigo-700 transition shadow-sm font-medium disabled:opacity-50 disabled:cursor-not-allowed">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                                </svg>
                                Export Database
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Right Column - Cache Management & Info -->
            <div class="space-y-6">
                
                <!-- Clear Cache Section -->
                <div class="bg-white rounded-3xl shadow-lg border border-gray-200 overflow-hidden">
                    <div class="px-6 py-5 border-b border-gray-200 bg-gradient-to-r from-amber-50 to-orange-50">
                        <div class="flex items-center gap-3">
                            <div class="p-2 bg-amber-100 rounded-lg">
                                <svg class="w-5 h-5 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"/>
                                </svg>
                            </div>
                            <div>
                                <h2 class="text-lg font-bold text-gray-900">Clear Cache</h2>
                                <p class="text-sm text-gray-500">Improve system performance</p>
                            </div>
                        </div>
                    </div>

                    <div class="p-6">
                        <p class="text-sm text-gray-600 mb-4">
                            Clear all cached data including application cache, views, configuration, and routes. This can help resolve issues and improve performance.
                        </p>

                        <form action="{{ route('admin.maintenance.clear-cache') }}" method="POST" 
                              onsubmit="return confirm('Are you sure you want to clear all system cache? This will temporarily slow down the application as caches are rebuilt.')">
                            @csrf
                            <button type="submit" 
                                    class="w-full flex items-center justify-center gap-2 px-6 py-3 bg-amber-500 text-white rounded-xl hover:bg-amber-600 transition shadow-sm font-medium">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M4 4v5h.582m15.356 2A8.001 8.001 0 004.582 9m0 0H9m11 11v-5h-.581m0 0a8.003 8.003 0 01-15.357-2m15.357 2H15"/>
                                </svg>
                                Clear All Cache
                            </button>
                        </form>

                        <div class="mt-4 p-3 bg-gray-50 rounded-lg">
                            <p class="text-xs text-gray-500 text-center">
                                <svg class="w-4 h-4 inline mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                          d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                </svg>
                                This action will clear: Application Cache, View Cache, Config Cache, Route Cache
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Cache Information -->
                <div class="bg-white rounded-3xl shadow-lg border border-gray-200 overflow-hidden">
                    <div class="px-6 py-5 border-b border-gray-200">
                        <h3 class="text-base font-bold text-gray-900">Cache Information</h3>
                    </div>
                    <div class="p-6">
                        <dl class="space-y-3">
                            <div class="flex justify-between items-center">
                                <dt class="text-sm text-gray-500">Driver</dt>
                                <dd class="text-sm font-medium text-gray-900 capitalize">
                                    <span class="px-2 py-1 bg-gray-100 rounded-md text-xs">{{ $cacheInfo['driver'] }}</span>
                                </dd>
                            </div>
                            <div class="flex justify-between items-center">
                                <dt class="text-sm text-gray-500">Store</dt>
                                <dd class="text-sm font-medium text-gray-900 capitalize">
                                    <span class="px-2 py-1 bg-gray-100 rounded-md text-xs">{{ $cacheInfo['store'] }}</span>
                                </dd>
                            </div>
                            <div class="flex justify-between items-center">
                                <dt class="text-sm text-gray-500">Prefix</dt>
                                <dd class="text-sm font-medium text-gray-900 font-mono text-xs">
                                    <span class="px-2 py-1 bg-gray-100 rounded-md">{{ $cacheInfo['prefix'] }}</span>
                                </dd>
                            </div>
                        </dl>
                    </div>
                </div>

                <!-- Database Statistics -->
                <div class="bg-white rounded-3xl shadow-lg border border-gray-200 overflow-hidden">
                    <div class="px-6 py-5 border-b border-gray-200">
                        <h3 class="text-base font-bold text-gray-900">Database Statistics</h3>
                    </div>
                    <div class="p-6">
                        <dl class="space-y-3">
                            <div class="flex justify-between items-center">
                                <dt class="text-sm text-gray-500">Total Tables</dt>
                                <dd class="text-sm font-medium text-gray-900">
                                    <span class="px-2 py-1 bg-indigo-50 text-indigo-700 rounded-md">{{ count($tables) }}</span>
                                </dd>
                            </div>
                            <div class="flex justify-between items-center">
                                <dt class="text-sm text-gray-500">Total Records</dt>
                                <dd class="text-sm font-medium text-gray-900">
                                    <span class="px-2 py-1 bg-emerald-50 text-emerald-700 rounded-md">
                                        {{ number_format(array_sum(array_column($tables, 'row_count'))) }}
                                    </span>
                                </dd>
                            </div>
                            <div class="flex justify-between items-center">
                                <dt class="text-sm text-gray-500">Total Size</dt>
                                <dd class="text-sm font-medium text-gray-900">
                                    <span class="px-2 py-1 bg-amber-50 text-amber-700 rounded-md">
                                        {{ number_format(array_sum(array_column($tables, 'size_mb')), 2) }} MB
                                    </span>
                                </dd>
                            </div>
                        </dl>
                    </div>
                </div>

                <!-- System Information -->
                <div class="bg-white rounded-3xl shadow-lg border border-gray-200 overflow-hidden">
                    <div class="px-6 py-5 border-b border-gray-200">
                        <h3 class="text-base font-bold text-gray-900">System Information</h3>
                    </div>
                    <div class="p-6">
                        <dl class="space-y-3">
                            <div class="flex justify-between items-center">
                                <dt class="text-sm text-gray-500">PHP Version</dt>
                                <dd class="text-sm font-medium text-gray-900 font-mono text-xs">
                                    <span class="px-2 py-1 bg-gray-100 rounded-md">{{ $systemInfo['php_version'] }}</span>
                                </dd>
                            </div>
                            <div class="flex justify-between items-center">
                                <dt class="text-sm text-gray-500">Laravel Version</dt>
                                <dd class="text-sm font-medium text-gray-900 font-mono text-xs">
                                    <span class="px-2 py-1 bg-gray-100 rounded-md">{{ $systemInfo['laravel_version'] }}</span>
                                </dd>
                            </div>
                            <div class="flex justify-between items-center">
                                <dt class="text-sm text-gray-500">Environment</dt>
                                <dd class="text-sm font-medium text-gray-900">
                                    <span class="px-2 py-1 {{ $systemInfo['debug_mode'] === 'Enabled' ? 'bg-red-50 text-red-700' : 'bg-green-50 text-green-700' }} rounded-md text-xs">
                                        {{ $systemInfo['environment'] }}
                                    </span>
                                </dd>
                            </div>
                            <div class="flex justify-between items-center">
                                <dt class="text-sm text-gray-500">Debug Mode</dt>
                                <dd class="text-sm font-medium {{ $systemInfo['debug_mode'] === 'Enabled' ? 'text-red-600' : 'text-green-600' }}">
                                    <span class="flex items-center gap-1">
                                        <span class="w-2 h-2 rounded-full {{ $systemInfo['debug_mode'] === 'Enabled' ? 'bg-red-500' : 'bg-green-500' }} animate-pulse"></span>
                                        {{ $systemInfo['debug_mode'] }}
                                    </span>
                                </dd>
                            </div>
                            <div class="flex justify-between items-center">
                                <dt class="text-sm text-gray-500">Memory Limit</dt>
                                <dd class="text-sm font-medium text-gray-900">{{ $systemInfo['memory_limit'] }}</dd>
                            </div>
                        </dl>
                    </div>
                </div>

                <!-- Recent Activity -->
                @if(count($recentActivity) > 0)
                <div class="bg-white rounded-3xl shadow-lg border border-gray-200 overflow-hidden">
                    <div class="px-6 py-5 border-b border-gray-200">
                        <h3 class="text-base font-bold text-gray-900">Recent Activity</h3>
                    </div>
                    <div class="p-6">
                        <ul class="space-y-3">
                            @foreach($recentActivity as $activity)
                                <li class="flex items-start gap-3">
                                    <div class="p-1.5 {{ $activity['type'] === 'application' ? 'bg-blue-100' : 'bg-green-100' }} rounded-lg shrink-0">
                                        <svg class="w-4 h-4 {{ $activity['type'] === 'application' ? 'text-blue-600' : 'text-green-600' }}" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                  d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"/>
                                        </svg>
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <p class="text-sm text-gray-700">{{ $activity['message'] }}</p>
                                        <p class="text-xs text-gray-400 mt-0.5">
                                            {{ \Carbon\Carbon::parse($activity['timestamp'])->diffForHumans() }}
                                        </p>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>

    <!-- Export Confirmation Modal -->
    <div id="export-modal" class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
        <div class="bg-white rounded-2xl shadow-2xl p-6 max-w-md mx-4 transform transition-all">
            <div class="flex items-center gap-3 mb-4">
                <div class="p-2 bg-indigo-100 rounded-lg">
                    <svg class="w-6 h-6 text-indigo-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                              d="M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4"/>
                    </svg>
                </div>
                <h3 class="text-lg font-bold text-gray-900">Confirm Export</h3>
            </div>
            
            <p class="text-gray-600 mb-4">
                You are about to export <strong id="modal-table-count">0</strong> table(s) as <strong id="modal-format">SQL</strong>.
            </p>
            
            <p class="text-sm text-gray-500 mb-6">
                The export file will be downloaded to your device. This may take a moment depending on the data size.
            </p>

            <div class="flex gap-3">
                <button type="button" onclick="hideExportModal()" 
                        class="flex-1 px-4 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition font-medium">
                    Cancel
                </button>
                <button type="button" onclick="confirmExport()" 
                        class="flex-1 px-4 py-2 bg-indigo-600 text-white rounded-lg hover:bg-indigo-700 transition font-medium">
                    Export
                </button>
            </div>
        </div>
    </div>

    <script>
        // Table checkbox functionality
        document.addEventListener('DOMContentLoaded', function() {
            const selectAllCheckbox = document.getElementById('select-all-checkbox');
            const tableCheckboxes = document.querySelectorAll('.table-checkbox');
            const selectedCountSpan = document.getElementById('selected-count');
            const exportBtn = document.getElementById('export-btn');
            const selectAllBtn = document.getElementById('select-all');
            const deselectAllBtn = document.getElementById('deselect-all');
            const exportForm = document.getElementById('export-form');
            const exportModal = document.getElementById('export-modal');

            // Update selected count
            function updateSelectedCount() {
                const checkedCount = document.querySelectorAll('.table-checkbox:checked').length;
                selectedCountSpan.textContent = checkedCount;
                exportBtn.disabled = checkedCount === 0;
            }

            // Select/Deselect all
            selectAllCheckbox.addEventListener('change', function() {
                tableCheckboxes.forEach(cb => cb.checked = this.checked);
                updateSelectedCount();
            });

            // Individual checkbox change
            tableCheckboxes.forEach(cb => {
                cb.addEventListener('change', function() {
                    updateSelectedCount();
                    // Update "select all" checkbox state
                    selectAllCheckbox.checked = Array.from(tableCheckboxes).every(cb => cb.checked);
                    selectAllCheckbox.indeterminate = !selectAllCheckbox.checked && Array.from(tableCheckboxes).some(cb => cb.checked);
                });
            });

            // Select All button
            selectAllBtn.addEventListener('click', function() {
                tableCheckboxes.forEach(cb => cb.checked = true);
                selectAllCheckbox.checked = true;
                selectAllCheckbox.indeterminate = false;
                updateSelectedCount();
            });

            // Deselect All button
            deselectAllBtn.addEventListener('click', function() {
                tableCheckboxes.forEach(cb => cb.checked = false);
                selectAllCheckbox.checked = false;
                selectAllCheckbox.indeterminate = false;
                updateSelectedCount();
            });

            // Export form submission with modal
            exportForm.addEventListener('submit', function(e) {
                e.preventDefault();
                
                const checkedCount = document.querySelectorAll('.table-checkbox:checked').length;
                const selectedFormat = document.querySelector('input[name="format"]:checked').value;
                
                document.getElementById('modal-table-count').textContent = checkedCount;
                document.getElementById('modal-format').textContent = selectedFormat.toUpperCase();
                
                exportModal.classList.remove('hidden');
            });

            // Initialize
            updateSelectedCount();
        });

        // Hide export modal
        function hideExportModal() {
            document.getElementById('export-modal').classList.add('hidden');
        }

        // Confirm export
        function confirmExport() {
            hideExportModal();
            document.getElementById('export-form').submit();
        }

        // Auto-hide alerts after 5 seconds
        setTimeout(function() {
            const successAlert = document.getElementById('success-alert');
            const errorAlert = document.getElementById('error-alert');
            if (successAlert) successAlert.remove();
            if (errorAlert) errorAlert.remove();
        }, 5000);
    </script>
</x-app-layout>