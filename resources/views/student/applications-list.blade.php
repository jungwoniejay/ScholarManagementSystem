<div class="rounded-2xl p-4 sm:p-6 shadow-sm border mt-6" id="applications-list" style="background:#0F2044;border-color:#1E3A8A;">
    <div class="flex items-center justify-between mb-4 sm:mb-6">
        <h3 class="text-base sm:text-lg font-bold text-white flex items-center space-x-2" style="font-family:var(--font-display);">
            <div class="w-8 h-8 rounded-lg flex items-center justify-center" style="background:linear-gradient(135deg,#FFD700,#B8860B);">
                <svg class="w-4 h-4" fill="none" stroke="#060D1F" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/>
                </svg>
            </div>
            <span>Recent Applications</span>
        </h3>
    </div>
    <div class="space-y-3">
        @forelse($applications as $application)
        <div class="flex flex-col sm:flex-row sm:items-center justify-between p-3 sm:p-4 rounded-xl transition-colors space-y-2 sm:space-y-0" style="background:#0A1628;" onmouseover="this.style.background='#0F2044'" onmouseout="this.style.background='#0A1628'">
            <div class="flex items-center space-x-3">
                <div class="w-8 h-8 sm:w-10 sm:h-10 rounded-full flex items-center justify-center text-white font-bold text-sm sm:text-base" style="background:linear-gradient(135deg,#FFD700,#B8860B);color:#060D1F;font-family:var(--font-display);">{{substr($application->scholarship->name??'S',0,1)}}</div>
                <div>
                    <p class="font-semibold text-white text-sm sm:text-base">{{$application->scholarship->name??'Scholarship'}}</p>
                    <p class="text-xs sm:text-sm" style="color:#8b949e;">Applied {{$application->created_at->diffForHumans()}}</p>
                </div>
            </div>
            <div class="flex items-center space-x-3">
                @php $sc=['pending'=>['#FBBF24','rgba(251,191,36,0.15)'],'approved'=>['#22C55E','rgba(34,197,94,0.15)'],'rejected'=>['#F87171','rgba(248,113,113,0.15)']];[$tc,$bc]=$sc[$application->status]??['#8b949e','rgba(139,148,158,0.15)'];@endphp
                <span class="text-xs px-2 sm:px-3 py-1 rounded-full font-semibold" style="color:{{$tc}};background:{{$bc}};">{{ucfirst($application->status)}}</span>
            </div>
        </div>
        @empty
        <div class="text-center py-6 sm:py-8" style="color:#8b949e;">
            <svg class="w-12 h-12 mx-auto mb-2 opacity-30" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z"/></svg>
            <p>No applications yet</p>
            <p class="text-xs mt-1">Start by browsing available scholarships</p>
        </div>
        @endforelse
    </div>
</div>
<script>if(typeof gsap!=='undefined'){gsap.to('#applications-list',{opacity:1,y:0,duration:.8,delay:1.2,ease:'power3.out'})}</script>
