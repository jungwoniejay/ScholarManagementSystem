<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl leading-tight" style="color:#e2e8f0;">System Maintenance</h2>
    </x-slot>

    <div class="max-w-7xl mx-auto space-y-6">

        <div>
            <h1 class="text-2xl font-bold" style="color:#e2e8f0;">System Maintenance</h1>
            <p class="text-sm" style="color:#8b949e;">Manage database exports, system cache, and monitor system health.</p>
        </div>

        @if(session('success'))
            <div id="success-alert" class="px-4 py-3 rounded-lg text-sm flex items-center justify-between"
                 style="background:rgba(34,197,94,0.15);color:#4ade80;border:1px solid rgba(34,197,94,0.3);">
                <span>{{ session('success') }}</span>
                <button onclick="this.parentElement.remove()" style="color:#4ade80;">✕</button>
            </div>
        @endif
        @if(session('error'))
            <div id="error-alert" class="px-4 py-3 rounded-lg text-sm flex items-center justify-between"
                 style="background:rgba(248,113,113,0.15);color:#f87171;border:1px solid rgba(248,113,113,0.3);">
                <span>{{ session('error') }}</span>
                <button onclick="this.parentElement.remove()" style="color:#f87171;">✕</button>
            </div>
        @endif

        {{-- Stats --}}
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-4">
            @foreach([
                ['label'=>'Database Tables','value'=>count($tables),'color'=>'#60a5fa'],
                ['label'=>'Total Records','value'=>number_format(array_sum(array_column($tables,'row_count'))),'color'=>'#4ade80'],
                ['label'=>'Cache Driver','value'=>ucfirst($cacheInfo['driver']),'color'=>'#fbbf24'],
                ['label'=>'Environment','value'=>ucfirst($systemInfo['environment']),'color'=>$systemInfo['debug_mode']==='Enabled'?'#f87171':'#4ade80'],
            ] as $stat)
            <div class="p-4 rounded-xl" style="background:#0F2044;border:1px solid #1E3A8A;">
                <p class="text-xs font-semibold mb-1" style="color:#8b949e;">{{ $stat['label'] }}</p>
                <p class="text-2xl font-bold" style="color:{{ $stat['color'] }};">{{ $stat['value'] }}</p>
            </div>
            @endforeach
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

            {{-- Database Export --}}
            <div class="lg:col-span-2 rounded-2xl overflow-hidden" style="background:#0F2044;border:1px solid #1E3A8A;">
                <div class="px-6 py-4" style="border-bottom:1px solid #1E3A8A;">
                    <h2 class="text-sm font-bold" style="color:#FFD700;">Database Export</h2>
                    <p class="text-xs mt-1" style="color:#8b949e;">Export your database for backup and analysis</p>
                </div>
                <div class="p-6">
                    <form action="{{ route('admin.maintenance.export') }}" method="POST" id="export-form">
                        @csrf

                        {{-- Format --}}
                        <div class="mb-5">
                            <label class="block text-xs font-semibold mb-3" style="color:#8b949e;">Export Format</label>
                            <div class="grid grid-cols-3 gap-3">
                                @foreach([['sql','SQL','Full backup'],['csv','CSV','Spreadsheet'],['json','JSON','API ready']] as [$val,$label,$sub])
                                <label class="cursor-pointer">
                                    <input type="radio" name="format" value="{{ $val }}" class="peer sr-only" {{ $val==='sql'?'checked':'' }}>
                                    <div class="flex flex-col items-center p-3 rounded-xl text-center transition"
                                         style="border:2px solid #1E3A8A;background:#0A1628;"
                                         onmouseover="this.style.borderColor='#FFD700'" onmouseout="this.style.borderColor=this.closest('label').querySelector('input').checked?'#FFD700':'#1E3A8A'">
                                        <span class="text-sm font-bold" style="color:#e2e8f0;">{{ $label }}</span>
                                        <span class="text-xs" style="color:#8b949e;">{{ $sub }}</span>
                                    </div>
                                </label>
                                @endforeach
                            </div>
                        </div>

                        {{-- Table Selection --}}
                        <div class="mb-5">
                            <div class="flex items-center justify-between mb-2">
                                <label class="text-xs font-semibold" style="color:#8b949e;">Select Tables</label>
                                <div class="flex gap-3">
                                    <button type="button" id="select-all" class="text-xs font-medium" style="color:#60a5fa;">Select All</button>
                                    <button type="button" id="deselect-all" class="text-xs font-medium" style="color:#8b949e;">Deselect All</button>
                                </div>
                            </div>
                            <div class="max-h-64 overflow-y-auto rounded-xl" style="border:1px solid #1E3A8A;">
                                <table class="min-w-full">
                                    <thead style="background:#0A1628;position:sticky;top:0;">
                                        <tr>
                                            <th class="px-4 py-2 w-10">
                                                <input type="checkbox" id="select-all-checkbox" style="accent-color:#FFD700;">
                                            </th>
                                            <th class="px-4 py-2 text-left text-xs font-semibold uppercase" style="color:#8b949e;">Table</th>
                                            <th class="px-4 py-2 text-center text-xs font-semibold uppercase" style="color:#8b949e;">Rows</th>
                                            <th class="px-4 py-2 text-center text-xs font-semibold uppercase" style="color:#8b949e;">Size</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @forelse($tables as $table)
                                        <tr style="border-top:1px solid #1E3A8A;">
                                            <td class="px-4 py-2">
                                                <input type="checkbox" name="tables[]" value="{{ $table['name'] }}" class="table-checkbox" style="accent-color:#FFD700;">
                                            </td>
                                            <td class="px-4 py-2 text-sm font-mono" style="color:#e2e8f0;">{{ $table['name'] }}</td>
                                            <td class="px-4 py-2 text-sm text-center" style="color:#8b949e;">{{ number_format($table['row_count']) }}</td>
                                            <td class="px-4 py-2 text-sm text-center" style="color:#8b949e;">{{ $table['size_mb'] }} MB</td>
                                        </tr>
                                        @empty
                                        <tr><td colspan="4" class="px-4 py-6 text-center text-sm" style="color:#8b949e;">No tables found.</td></tr>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                            <p class="text-xs mt-1" style="color:#8b949e;"><span id="selected-count">0</span> table(s) selected</p>
                        </div>

                        <button type="submit" id="export-btn"
                                class="w-full py-2.5 text-sm font-semibold rounded-xl transition disabled:opacity-50"
                                style="background:linear-gradient(135deg,#FFD700,#B8860B);color:#0A1628;">
                            Export Database
                        </button>
                    </form>
                </div>
            </div>

            {{-- Right Sidebar --}}
            <div class="space-y-4">

                {{-- Clear Cache --}}
                <div class="rounded-2xl overflow-hidden" style="background:#0F2044;border:1px solid #1E3A8A;">
                    <div class="px-5 py-4" style="border-bottom:1px solid #1E3A8A;">
                        <h2 class="text-sm font-bold" style="color:#FFD700;">Clear Cache</h2>
                        <p class="text-xs mt-1" style="color:#8b949e;">Improve system performance</p>
                    </div>
                    <div class="p-5">
                        <p class="text-xs mb-4" style="color:#8b949e;">Clear application cache, views, configuration, and routes.</p>
                        <form action="{{ route('admin.maintenance.clear-cache') }}" method="POST"
                              onsubmit="return confirm('Clear all system cache?')">
                            @csrf
                            <button type="submit" class="w-full py-2.5 text-sm font-semibold rounded-xl"
                                    style="background:rgba(251,191,36,0.15);color:#fbbf24;border:1px solid rgba(251,191,36,0.3);">
                                Clear All Cache
                            </button>
                        </form>
                    </div>
                </div>

                {{-- Cache Info --}}
                <div class="rounded-2xl p-5" style="background:#0F2044;border:1px solid #1E3A8A;">
                    <h3 class="text-sm font-bold mb-3" style="color:#FFD700;">Cache Information</h3>
                    @foreach([['Driver',$cacheInfo['driver']],['Store',$cacheInfo['store']],['Prefix',$cacheInfo['prefix']]] as [$k,$v])
                    <div class="flex justify-between items-center py-2" style="border-bottom:1px solid #1E3A8A;">
                        <span class="text-xs" style="color:#8b949e;">{{ $k }}</span>
                        <span class="text-xs font-mono px-2 py-0.5 rounded" style="background:#0A1628;color:#e2e8f0;">{{ $v }}</span>
                    </div>
                    @endforeach
                </div>

                {{-- DB Stats --}}
                <div class="rounded-2xl p-5" style="background:#0F2044;border:1px solid #1E3A8A;">
                    <h3 class="text-sm font-bold mb-3" style="color:#FFD700;">Database Statistics</h3>
                    @foreach([['Tables',count($tables),'#60a5fa'],['Records',number_format(array_sum(array_column($tables,'row_count'))),'#4ade80'],['Size',number_format(array_sum(array_column($tables,'size_mb')),2).' MB','#fbbf24']] as [$k,$v,$c])
                    <div class="flex justify-between items-center py-2" style="border-bottom:1px solid #1E3A8A;">
                        <span class="text-xs" style="color:#8b949e;">{{ $k }}</span>
                        <span class="text-xs font-semibold" style="color:{{ $c }};">{{ $v }}</span>
                    </div>
                    @endforeach
                </div>

                {{-- System Info --}}
                <div class="rounded-2xl p-5" style="background:#0F2044;border:1px solid #1E3A8A;">
                    <h3 class="text-sm font-bold mb-3" style="color:#FFD700;">System Information</h3>
                    @foreach([['PHP',$systemInfo['php_version']],['Laravel',$systemInfo['laravel_version']],['Environment',$systemInfo['environment']],['Debug',$systemInfo['debug_mode']],['Memory',$systemInfo['memory_limit']]] as [$k,$v])
                    <div class="flex justify-between items-center py-2" style="border-bottom:1px solid #1E3A8A;">
                        <span class="text-xs" style="color:#8b949e;">{{ $k }}</span>
                        <span class="text-xs font-mono px-2 py-0.5 rounded" style="background:#0A1628;color:#e2e8f0;">{{ $v }}</span>
                    </div>
                    @endforeach
                </div>

                {{-- Recent Activity --}}
                @if(count($recentActivity) > 0)
                <div class="rounded-2xl p-5" style="background:#0F2044;border:1px solid #1E3A8A;">
                    <h3 class="text-sm font-bold mb-3" style="color:#FFD700;">Recent Activity</h3>
                    <ul class="space-y-3">
                        @foreach($recentActivity as $activity)
                        <li class="flex items-start gap-3">
                            <div class="w-2 h-2 rounded-full mt-1.5 flex-shrink-0"
                                 style="background:{{ $activity['type']==='application'?'#60a5fa':'#4ade80' }};"></div>
                            <div>
                                <p class="text-xs" style="color:#e2e8f0;">{{ $activity['message'] }}</p>
                                <p class="text-xs mt-0.5" style="color:#8b949e;">{{ \Carbon\Carbon::parse($activity['timestamp'])->diffForHumans() }}</p>
                            </div>
                        </li>
                        @endforeach
                    </ul>
                </div>
                @endif
            </div>
        </div>
    </div>

    {{-- Export Confirmation Modal --}}
    <div id="export-modal" class="fixed inset-0 flex items-center justify-center z-50 hidden" style="background:rgba(0,0,0,0.7);">
        <div class="rounded-2xl p-6 max-w-md mx-4" style="background:#0F2044;border:1px solid #1E3A8A;">
            <h3 class="text-lg font-bold mb-3" style="color:#e2e8f0;">Confirm Export</h3>
            <p class="text-sm mb-2" style="color:#8b949e;">
                You are about to export <strong style="color:#e2e8f0;" id="modal-table-count">0</strong> table(s) as
                <strong style="color:#FFD700;" id="modal-format">SQL</strong>.
            </p>
            <p class="text-xs mb-5" style="color:#8b949e;">The file will be downloaded to your device.</p>
            <div class="flex gap-3">
                <button type="button" onclick="hideExportModal()" class="flex-1 py-2 text-sm font-medium rounded-xl"
                        style="background:#0A1628;border:1px solid #1E3A8A;color:#8b949e;">Cancel</button>
                <button type="button" onclick="confirmExport()" class="flex-1 py-2 text-sm font-semibold rounded-xl"
                        style="background:linear-gradient(135deg,#FFD700,#B8860B);color:#0A1628;">Export</button>
            </div>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const selectAllCb = document.getElementById('select-all-checkbox');
            const tableCbs = document.querySelectorAll('.table-checkbox');
            const countSpan = document.getElementById('selected-count');
            const exportBtn = document.getElementById('export-btn');
            const exportForm = document.getElementById('export-form');

            function updateCount() {
                const n = document.querySelectorAll('.table-checkbox:checked').length;
                countSpan.textContent = n;
                exportBtn.disabled = n === 0;
            }

            selectAllCb.addEventListener('change', function() {
                tableCbs.forEach(cb => cb.checked = this.checked);
                updateCount();
            });

            tableCbs.forEach(cb => cb.addEventListener('change', function() {
                updateCount();
                selectAllCb.checked = Array.from(tableCbs).every(c => c.checked);
                selectAllCb.indeterminate = !selectAllCb.checked && Array.from(tableCbs).some(c => c.checked);
            }));

            document.getElementById('select-all').addEventListener('click', function() {
                tableCbs.forEach(cb => cb.checked = true);
                selectAllCb.checked = true;
                updateCount();
            });

            document.getElementById('deselect-all').addEventListener('click', function() {
                tableCbs.forEach(cb => cb.checked = false);
                selectAllCb.checked = false;
                updateCount();
            });

            exportForm.addEventListener('submit', function(e) {
                e.preventDefault();
                const n = document.querySelectorAll('.table-checkbox:checked').length;
                const fmt = document.querySelector('input[name="format"]:checked').value;
                document.getElementById('modal-table-count').textContent = n;
                document.getElementById('modal-format').textContent = fmt.toUpperCase();
                document.getElementById('export-modal').classList.remove('hidden');
            });

            updateCount();
        });

        function hideExportModal() { document.getElementById('export-modal').classList.add('hidden'); }
        function confirmExport() { hideExportModal(); document.getElementById('export-form').submit(); }

        setTimeout(function() {
            ['success-alert','error-alert'].forEach(id => { const el = document.getElementById(id); if(el) el.remove(); });
        }, 5000);
    </script>
</x-app-layout>
