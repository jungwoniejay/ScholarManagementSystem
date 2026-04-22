<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'ScholarHub') }}</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@300;400;600;700&family=DM+Sans:wght@300;400;500;600&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/gsap.min.js"></script>
    <style>
        :root{--midnight:#060D1F;--navy-deep:#0B1735;--navy:#0F2050;--gold:#E8B84B;--gold-bright:#FFD060;--font-display:'Cormorant Garamond',Georgia,serif;--font-body:'DM Sans',sans-serif}
        *{margin:0;padding:0;box-sizing:border-box}
        body{font-family:var(--font-body);background:var(--midnight);color:#fff;overflow-x:hidden}
    </style>
</head>
<body>

@if(auth()->user()->isAdmin())
@include('layouts.admin-sidebar')
@elseif(auth()->user()->isDonator())
@include('layouts.donator-sidebar')
@else
@include('layouts.student-sidebar')
@endif
<div class="ml-0 lg:ml-64 min-h-screen transition-all lg:ml-64" style="background:radial-gradient(ellipse 80% 70% at 50% 0%,#122356 0%,#060D1F 70%);">
@include('layouts.navigation')
@isset($header)
<header style="background:#0F2044;border-bottom:1px solid #1E3A8A;">
<div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8" style="color:#e2e8f0;">{{ $header }}</div>
</header>
@endisset
<main class="p-4 sm:p-6 lg:p-8" style="min-height:calc(100vh - 64px); background:#0d1b3e; color:#e2e8f0;">
@if(isset($slot)){{ $slot }}@else @yield('content')@endif
</main>
</div>
<div id="toast-container" class="fixed top-4 right-4 z-50 space-y-2"></div>
<script>
function openSidebar(name) {
    document.getElementById(name+'-sidebar').style.transform = 'translateX(0)';
    var ov = document.getElementById(name+'-sidebar-overlay');
    if (ov) ov.style.display = 'block';
}
function closeSidebar(name) {
    document.getElementById(name+'-sidebar').style.transform = 'translateX(-100%)';
    var ov = document.getElementById(name+'-sidebar-overlay');
    if (ov) ov.style.display = 'none';
}
function handleResize() {
    var names = ['donator','student'];
    names.forEach(function(name) {
        var sb = document.getElementById(name+'-sidebar');
        if (!sb) return;
        if (window.innerWidth >= 1024) {
            sb.style.transform = 'translateX(0)';
            var ov = document.getElementById(name+'-sidebar-overlay');
            if (ov) ov.style.display = 'none';
        } else {
            sb.style.transform = 'translateX(-100%)';
        }
    });
}
window.addEventListener('resize', handleResize);
handleResize();
window.showToast=function(message,type='success'){const container=document.getElementById('toast-container'),toast=document.createElement('div'),bgColors={success:'bg-emerald-500',error:'bg-red-500',warning:'bg-amber-500',info:'bg-blue-500'};toast.className=`${bgColors[type]} text-white px-6 py-4 rounded-lg shadow-lg transition-all duration-300 max-w-sm`;toast.innerHTML=`<div class="flex items-center gap-3"><svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"><path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"/></svg><span>${message}</span></div>`;container.appendChild(toast);setTimeout(()=>{toast.classList.add('opacity-0','translate-x-full');setTimeout(()=>toast.remove(),300)},3000)};
if(typeof gsap!=='undefined'){document.querySelectorAll('a,button').forEach(btn=>{btn.addEventListener('mousemove',function(e){const r=this.getBoundingClientRect(),x=e.clientX-r.left-r.width/2,y=e.clientY-r.top-r.height/2;gsap.to(this,{x:x*.15,y:y*.15,duration:.4,ease:'power2.out'})});btn.addEventListener('mouseleave',function(){gsap.to(this,{x:0,y:0,duration:.5,ease:'elastic.out(1,0.5)'})})})}
</script>

@include('components.cookie-banner', ['settings' => $cookieSettings])

</body>
</html>
