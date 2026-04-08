<x-student-layout>
@php
    $studentId=auth()->user()->student->id??null;
    $userApplications=$studentId?\App\Models\Application::where('student_id',$studentId)->latest()->take(10)->get():collect();
    $totalApplications=$studentId?\App\Models\Application::where('student_id',$studentId)->count():0;
    $approvedApplications=$studentId?\App\Models\Application::where('student_id',$studentId)->where('status','approved')->count():0;
    $pendingApplications=$studentId?\App\Models\Application::where('student_id',$studentId)->where('status','pending')->count():0;
    $availableScholarships=\App\Models\Scholarship::where('status','active')->count();
@endphp

<div class="max-w-7xl mx-auto space-y-6 p-4 sm:p-6">
    <div class="rounded-2xl p-6 sm:p-8 relative overflow-hidden" id="welcome-banner" style="background:linear-gradient(135deg,#0F2044 0%,#1E3A8A 60%,#FFD700 100%);">
        <div class="absolute top-0 right-0 -mt-4 -mr-4 w-32 h-32 sm:w-40 sm:h-40 rounded-full opacity-10" style="background:#FFD700;filter:blur(40px);"></div>
        <div class="absolute bottom-0 left-0 -mb-4 -ml-4 w-32 h-32 sm:w-40 sm:h-40 rounded-full opacity-10" style="background:#FFD700;filter:blur(40px);"></div>
        <div class="relative flex flex-col sm:flex-row items-start sm:items-center justify-between space-y-4 sm:space-y-0">
            <div class="flex flex-col sm:flex-row items-start sm:items-center space-y-4 sm:space-y-0 sm:space-x-5">
                <div class="w-14 h-14 sm:w-16 sm:h-16 rounded-2xl flex items-center justify-center shadow-lg" style="background:linear-gradient(135deg,#FFD700,#B8860B);"><svg class="w-7 h-7 sm:w-8 sm:h-8" fill="none" stroke="#060D1F" viewBox="0 0 24 24" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253"/></svg></div>
                <div>
                    <h2 class="text-xl sm:text-2xl font-bold text-white mb-1" style="font-family:var(--font-display);">Welcome back, {{Auth::user()->name??'Student'}}</h2>
                    <p class="text-sm sm:text-base" style="color:rgba(255,255,255,.8);">Explore available scholarships and manage your applications.</p>
                </div>
            </div>
        </div>
    </div>

    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4 sm:gap-6" id="stats-grid">
        @foreach([
            ['label'=>'My Applications','value'=>number_format($totalApplications),'badge'=>'Total','badge_color'=>'#60A5FA','icon_bg'=>'linear-gradient(135deg,#1E3A8A,#1e40af)','icon'=>'M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z'],
            ['label'=>'Approved','value'=>number_format($approvedApplications),'badge'=>'Success','badge_color'=>'#22C55E','icon_bg'=>'linear-gradient(135deg,#064E3B,#065F46)','icon'=>'M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z'],
            ['label'=>'Pending Review','value'=>number_format($pendingApplications),'badge'=>'Review','badge_color'=>'#FBBF24','icon_bg'=>'linear-gradient(135deg,#B8860B,#FFD700)','icon'=>'M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z'],
            ['label'=>'Available Scholarships','value'=>number_format($availableScholarships),'badge'=>'Browse','badge_color'=>'#A78BFA','icon_bg'=>'linear-gradient(135deg,#312e81,#4c1d95)','icon'=>'M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253'],
        ] as $stat)
        <div class="rounded-2xl p-4 sm:p-6 shadow-sm hover:shadow-xl hover:-translate-y-1 transition-all duration-300 border stat-card" style="background:#0F2044;border-color:#1E3A8A;">
            <div class="flex items-start justify-between mb-3 sm:mb-4">
                <div class="w-10 h-10 sm:w-12 sm:h-12 rounded-xl flex items-center justify-center shadow-lg" style="background:{{$stat['icon_bg']}};"><svg class="w-5 h-5 sm:w-6 sm:h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{$stat['icon']}}"/></svg></div>
            </div>
            <p class="text-xs sm:text-sm font-medium mb-1" style="color:#8b949e;">{{$stat['label']}}</p>
            <p class="text-2xl sm:text-3xl font-bold mb-2" style="color:#FFD700;font-family:var(--font-display);">{{$stat['value']}}</p>
            <div class="flex items-center text-xs" style="color:{{$stat['badge_color']}};"><span class="font-semibold">{{$stat['badge']}}</span></div>
        </div>
        @endforeach
    </div>

    @include('student.applications-list',['applications'=>$userApplications])
    @include('student.available-scholarships',['scholarships'=>$featuredScholarships])
</div>
<script>
if(typeof gsap!=='undefined'){gsap.to('#welcome-banner',{opacity:1,y:0,duration:.8,ease:'power3.out'});gsap.to('.stat-card',{opacity:1,y:0,duration:.6,stagger:.1,delay:.3,ease:'power2.out'})}
</script>
</x-student-layout>
