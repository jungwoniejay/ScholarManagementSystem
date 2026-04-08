<div class="rounded-2xl p-4 sm:p-6 shadow-sm border mt-6" id="scholarships-list" style="background:#0F2044;border-color:#1E3A8A;">
    <div class="flex items-center justify-between mb-4 sm:mb-6">
        <h3 class="text-base sm:text-lg font-bold text-white flex items-center space-x-2" style="font-family:var(--font-display);">
            <div class="w-8 h-8 rounded-lg flex items-center justify-center" style="background:linear-gradient(135deg,#FFD700,#B8860B);">
                <svg class="w-4 h-4" fill="none" stroke="#060D1F" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/>
                </svg>
            </div>
            <span>Available Scholarships</span>
        </h3>
    </div>
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
        @forelse($scholarships as $scholarship)
        <div class="p-4 rounded-xl hover:shadow-lg hover:-translate-y-1 transition-all duration-300 border" style="background:#0A1628;border-color:#1E3A8A;" onmouseover="this.style.borderColor='#FFD700'" onmouseout="this.style.borderColor='#1E3A8A'">
            <div class="flex items-start justify-between mb-3">
                <div class="w-10 h-10 rounded-lg flex items-center justify-center text-white font-bold" style="background:linear-gradient(135deg,#FFD700,#B8860B);color:#060D1F;font-family:var(--font-display);">{{substr($scholarship->name,0,1)}}</div>
                <span class="text-xs px-2 py-1 rounded-full font-semibold" style="background:rgba(34,197,94,0.15);color:#22C55E;">Active</span>
            </div>
            <h4 class="font-semibold text-white mb-2 text-sm" style="font-family:var(--font-display);">{{$scholarship->name}}</h4>
            <p class="text-xs mb-3 line-clamp-2" style="color:#8b949e;">{{$scholarship->description??'No description available'}}</p>
            <div class="flex items-center justify-between text-xs">
                <span style="color:#8b949e;">Deadline: {{$scholarship->deadline?$scholarship->deadline->format('M d, Y'):'N/A'}}</span>
                <a href="{{route('student.scholarships.show',$scholarship)}}" class="font-semibold" style="color:#FFD700;">View Details →</a>
            </div>
        </div>
        @empty
        <div class="col-span-full text-center py-6 sm:py-8" style="color:#8b949e;">
            <svg class="w-12 h-12 mx-auto mb-2 opacity-30" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg>
            <p>No scholarships available</p>
            <p class="text-xs mt-1">Check back later for new opportunities</p>
        </div>
        @endforelse
    </div>
</div>
<script>if(typeof gsap!=='undefined'){gsap.to('#scholarships-list',{opacity:1,y:0,duration:.8,delay:1.4,ease:'power3.out'})}</script>
