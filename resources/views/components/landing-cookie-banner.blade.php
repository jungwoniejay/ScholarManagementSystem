@php
    $cookieName = 'announcement_consent';
    $expiryDays = $settings->expiry_days ?? 365;
    $showBanner = ($settings->enabled ?? true) && ($settings->show_on_landing ?? true);
@endphp

@if($showBanner)
<style>
*,*::before,*::after{box-sizing:border-box;}
#shb-overlay{
    position:fixed;inset:0;z-index:99990;
    background:rgba(15,23,42,.45);backdrop-filter:blur(3px);
    opacity:0;transition:opacity .4s ease;pointer-events:none;
}
#shb-overlay.shb-show{opacity:1;pointer-events:auto;}
#shb-wrap{
    position:fixed;bottom:0;left:0;right:0;z-index:99999;
    display:flex;justify-content:center;padding:0 1rem 1.5rem;
    pointer-events:none;
}
#shb-card{
    width:100%;max-width:880px;
    background:#fff;border-radius:24px;
    box-shadow:0 32px 80px rgba(30,58,138,.22),0 8px 24px rgba(0,0,0,.1);
    border:1px solid rgba(30,58,138,.08);
    overflow:hidden;pointer-events:auto;
    transform:translateY(120%);opacity:0;
    transition:transform .45s cubic-bezier(.34,1.56,.64,1), opacity .35s ease;
}
#shb-card.shb-visible{transform:translateY(0);opacity:1;}

/* Gradient top bar */
.shb-bar{height:5px;background:linear-gradient(90deg,#1E3A8A 0%,#3B82F6 50%,#14B8A6 100%);}

.shb-main{padding:1.5rem 1.75rem 1.25rem;}
.shb-top{display:flex;align-items:flex-start;gap:1rem;}

/* Cookie icon badge */
.shb-badge{
    flex-shrink:0;width:52px;height:52px;border-radius:16px;
    background:linear-gradient(135deg,#1E3A8A,#2563EB);
    display:flex;align-items:center;justify-content:center;
    box-shadow:0 8px 20px rgba(37,99,235,.35);
    font-size:1.5rem;line-height:1;
}

.shb-info{flex:1;min-width:0;}
.shb-title{font-family:'Inter',sans-serif;font-size:1rem;font-weight:800;color:#0F172A;margin:0 0 .35rem;letter-spacing:-.2px;}
.shb-desc{font-family:'Inter',sans-serif;font-size:.82rem;color:#64748B;line-height:1.65;margin:0;}
.shb-desc strong{color:#334155;font-weight:600;}

.shb-dismiss{
    flex-shrink:0;background:none;border:none;cursor:pointer;
    width:32px;height:32px;border-radius:8px;
    display:flex;align-items:center;justify-content:center;
    color:#94A3B8;transition:background .2s,color .2s;
}
.shb-dismiss:hover{background:#F1F5F9;color:#475569;}

/* Bottom row */
.shb-bottom{
    display:flex;flex-wrap:wrap;align-items:center;
    justify-content:space-between;gap:.75rem;
    margin-top:1.1rem;padding-top:1rem;
    border-top:1px solid #F1F5F9;
}
.shb-links{display:flex;align-items:center;gap:.5rem;flex-wrap:wrap;}
.shb-link{
    font-family:'Inter',sans-serif;font-size:.75rem;font-weight:600;
    color:#2563EB;text-decoration:none;
    display:inline-flex;align-items:center;gap:.3rem;
    padding:.25rem .5rem;border-radius:6px;
    transition:background .15s;
}
.shb-link:hover{background:#EFF6FF;text-decoration:none;}
.shb-dot{width:3px;height:3px;border-radius:50%;background:#CBD5E1;}

.shb-actions{display:flex;align-items:center;gap:.5rem;flex-wrap:wrap;}
.shb-btn{
    font-family:'Inter',sans-serif;font-size:.8rem;font-weight:600;
    padding:.5rem 1rem;border-radius:10px;cursor:pointer;
    border:1.5px solid #E2E8F0;background:#F8FAFC;color:#475569;
    transition:all .2s;white-space:nowrap;
}
.shb-btn:hover{background:#F1F5F9;border-color:#CBD5E1;transform:translateY(-1px);}
.shb-btn-outline{
    font-family:'Inter',sans-serif;font-size:.8rem;font-weight:600;
    padding:.5rem 1rem;border-radius:10px;cursor:pointer;
    border:1.5px solid #BFDBFE;background:#EFF6FF;color:#1E3A8A;
    transition:all .2s;white-space:nowrap;
}
.shb-btn-outline:hover{background:#DBEAFE;border-color:#93C5FD;transform:translateY(-1px);}
.shb-btn-accept{
    font-family:'Inter',sans-serif;font-size:.82rem;font-weight:700;
    padding:.5rem 1.4rem;border-radius:10px;cursor:pointer;border:none;
    background:linear-gradient(135deg,#1E3A8A,#2563EB);
    color:#fff;box-shadow:0 4px 14px rgba(37,99,235,.4);
    transition:all .2s;white-space:nowrap;display:flex;align-items:center;gap:.4rem;
}
.shb-btn-accept:hover{transform:translateY(-2px);box-shadow:0 8px 20px rgba(37,99,235,.5);}
.shb-btn-accept svg{width:14px;height:14px;}

/* Preferences panel */
#shb-prefs{
    display:none;
    border-top:1px solid #F1F5F9;
    padding:1.25rem 1.75rem 1.5rem;
    background:linear-gradient(180deg,#F8FAFC,#fff);
    animation:shb-slide-down .25s ease;
}
@keyframes shb-slide-down{from{opacity:0;transform:translateY(-8px)}to{opacity:1;transform:translateY(0)}}
.shb-prefs-title{font-family:'Inter',sans-serif;font-size:.88rem;font-weight:700;color:#0F172A;margin:0 0 1rem;}
.shb-pref-item{
    display:flex;align-items:center;justify-content:space-between;gap:1rem;
    padding:.75rem 1rem;border-radius:12px;background:#fff;
    border:1px solid #E2E8F0;margin-bottom:.5rem;
    transition:border-color .2s,box-shadow .2s;
}
.shb-pref-item:hover{border-color:#BFDBFE;box-shadow:0 2px 8px rgba(37,99,235,.08);}
.shb-pref-item:last-child{margin-bottom:0;}
.shb-pref-left{flex:1;min-width:0;}
.shb-pref-name{font-family:'Inter',sans-serif;font-size:.82rem;font-weight:700;color:#1E293B;display:flex;align-items:center;gap:.5rem;}
.shb-pref-desc{font-family:'Inter',sans-serif;font-size:.74rem;color:#94A3B8;margin-top:.2rem;}
.shb-tag{font-size:.65rem;font-weight:700;padding:.15rem .5rem;border-radius:50px;background:#DCFCE7;color:#166534;}
.shb-tag-req{background:#E0E7FF;color:#3730A3;}

/* Toggle */
.shb-toggle-wrap{flex-shrink:0;position:relative;width:44px;height:24px;}
.shb-toggle-wrap input{position:absolute;opacity:0;width:0;height:0;}
.shb-toggle-track{
    position:absolute;inset:0;border-radius:50px;cursor:pointer;
    background:#CBD5E1;transition:background .25s;
}
.shb-toggle-track.active{background:linear-gradient(135deg,#2563EB,#1D4ED8);}
.shb-toggle-knob{
    position:absolute;top:3px;left:3px;
    width:18px;height:18px;border-radius:50%;
    background:#fff;box-shadow:0 1px 4px rgba(0,0,0,.25);
    transition:left .25s cubic-bezier(.34,1.56,.64,1);pointer-events:none;
}
.shb-toggle-knob.active{left:23px;}

.shb-prefs-actions{display:flex;gap:.5rem;margin-top:1rem;}

/* Toast */
#shb-toast{
    position:fixed;bottom:2rem;right:1.5rem;z-index:100000;
    display:flex;align-items:center;gap:.75rem;
    padding:.9rem 1.25rem;border-radius:16px;
    color:#fff;font-family:'Inter',sans-serif;font-size:.84rem;font-weight:600;
    box-shadow:0 12px 32px rgba(0,0,0,.25);
    opacity:0;transform:translateX(120%);
    transition:opacity .35s ease,transform .4s cubic-bezier(.34,1.56,.64,1);
    pointer-events:none;max-width:340px;min-width:220px;
}
#shb-toast.shb-toast-in{opacity:1;transform:translateX(0);}
.shb-toast-dot{width:8px;height:8px;border-radius:50%;background:rgba(255,255,255,.5);flex-shrink:0;}

/* Mobile */
@media(max-width:600px){
    #shb-wrap{padding:0 .75rem 1rem;}
    .shb-main{padding:1.25rem 1.25rem 1rem;}
    .shb-badge{width:42px;height:42px;border-radius:12px;font-size:1.25rem;}
    .shb-title{font-size:.9rem;}
    .shb-actions{width:100%;justify-content:flex-end;}
    #shb-prefs{padding:1rem 1.25rem 1.25rem;}
}
</style>

{{-- Overlay --}}
<div id="shb-overlay"></div>

{{-- Banner --}}
<div id="shb-wrap">
    <div id="shb-card" role="dialog" aria-modal="true" aria-label="Cookie consent">
        <div class="shb-bar"></div>

        <div class="shb-main">
            <div class="shb-top">
                <div class="shb-badge">🍪</div>

                <div class="shb-info">
                    <p class="shb-title">Your privacy, your choice</p>
                    <p class="shb-desc">
                        <strong>ScholarHub</strong> uses cookies to keep you logged in, improve performance, and personalise your experience.
                        You're in control — accept all, reject non-essential, or pick exactly what you want.
                    </p>
                </div>

                <button class="shb-dismiss" onclick="shbClose()" title="Dismiss for now" aria-label="Close">
                    <svg width="16" height="16" fill="none" stroke="currentColor" stroke-width="2.2" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>

            <div class="shb-bottom">
                <div class="shb-links">
                    <a href="{{ route('privacy-policy') }}" class="shb-link" target="_blank">
                        <svg width="12" height="12" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 2l6 3v5c0 5.25-3.75 9.75-6 11-2.25-1.25-6-5.75-6-11V5l6-3z"/>
                        </svg>
                        Privacy Policy
                    </a>
                    <div class="shb-dot"></div>
                    <a href="{{ route('terms-and-conditions') }}" class="shb-link" target="_blank">
                        <svg width="12" height="12" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"/>
                        </svg>
                        Terms & Conditions
                    </a>
                </div>

                <div class="shb-actions">
                    <button class="shb-btn" onclick="shbReject()">Reject All</button>
                    <button class="shb-btn-outline" onclick="shbTogglePrefs()">
                        <span id="shb-prefs-label">Customize</span>
                    </button>
                    <button class="shb-btn-accept" onclick="shbAccept()">
                        <svg fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                        </svg>
                        Accept All
                    </button>
                </div>
            </div>
        </div>

        {{-- Preferences Panel --}}
        <div id="shb-prefs">
            <p class="shb-prefs-title">Manage Cookie Preferences</p>

            {{-- Essential --}}
            <div class="shb-pref-item">
                <div class="shb-pref-left">
                    <p class="shb-pref-name">
                        <svg width="14" height="14" fill="none" stroke="#1E3A8A" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M12 2l6 3v5c0 5.25-3.75 9.75-6 11-2.25-1.25-6-5.75-6-11V5l6-3z"/>
                        </svg>
                        Essential Cookies
                        <span class="shb-tag shb-tag-req">Required</span>
                    </p>
                    <p class="shb-pref-desc">Login sessions, CSRF protection, and core site functionality. Cannot be disabled.</p>
                </div>
                <div style="flex-shrink:0;font-size:.72rem;font-weight:700;color:#64748B;background:#E2E8F0;padding:.3rem .75rem;border-radius:50px;">Always On</div>
            </div>

            {{-- Analytics --}}
            <div class="shb-pref-item">
                <div class="shb-pref-left">
                    <p class="shb-pref-name">
                        <svg width="14" height="14" fill="none" stroke="#7C3AED" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"/>
                        </svg>
                        Analytics Cookies
                        <span class="shb-tag">Optional</span>
                    </p>
                    <p class="shb-pref-desc">Help us understand how you use ScholarHub so we can improve it. No personal data is sold.</p>
                </div>
                <div class="shb-toggle-wrap" onclick="shbToggle('analytics')">
                    <input type="checkbox" id="shb-chk-analytics" checked>
                    <div class="shb-toggle-track active" id="shb-trk-analytics"></div>
                    <div class="shb-toggle-knob active" id="shb-knb-analytics"></div>
                </div>
            </div>

            {{-- Marketing --}}
            <div class="shb-pref-item">
                <div class="shb-pref-left">
                    <p class="shb-pref-name">
                        <svg width="14" height="14" fill="none" stroke="#D97706" stroke-width="2" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M11 5.882V19.24a1.76 1.76 0 01-3.417.592l-2.147-6.15M18 13a3 3 0 100-6M5.436 13.683A4.001 4.001 0 017 6h1.832c4.1 0 7.625-1.234 9.168-3v14c-1.543-1.766-5.067-3-9.168-3H7a3.988 3.988 0 01-1.564-.317z"/>
                        </svg>
                        Marketing Cookies
                        <span class="shb-tag">Optional</span>
                    </p>
                    <p class="shb-pref-desc">Personalised scholarship recommendations and relevant content based on your interests.</p>
                </div>
                <div class="shb-toggle-wrap" onclick="shbToggle('marketing')">
                    <input type="checkbox" id="shb-chk-marketing">
                    <div class="shb-toggle-track" id="shb-trk-marketing"></div>
                    <div class="shb-toggle-knob" id="shb-knb-marketing"></div>
                </div>
            </div>

            <div class="shb-prefs-actions">
                <button class="shb-btn-accept" onclick="shbSavePrefs()" style="font-size:.8rem;padding:.5rem 1.25rem;">
                    <svg fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24" style="width:13px;height:13px;">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                    </svg>
                    Save My Preferences
                </button>
                <button class="shb-btn" onclick="shbTogglePrefs()" style="font-size:.78rem;">Cancel</button>
            </div>
        </div>
    </div>
</div>

{{-- Toast --}}
<div id="shb-toast">
    <div class="shb-toast-dot"></div>
    <span id="shb-toast-msg"></span>
</div>

<script>
(function(){
    var NAME = '{{ $cookieName }}';
    var DAYS = {{ $expiryDays }};
    var prefsOpen = false;

    function getCookie(n){
        var c=document.cookie?document.cookie.split('; '):[];
        for(var i=0;i<c.length;i++){var p=c[i].split('='),k=decodeURIComponent(p.shift());if(k===n)return decodeURIComponent(p.join('='));}
        return null;
    }
    function setCookie(n,v,d){
        var e=new Date(Date.now()+d*864e5).toUTCString();
        document.cookie=encodeURIComponent(n)+'='+encodeURIComponent(v)+'; expires='+e+'; path=/; SameSite=Lax';
    }
    function save(v){setCookie(NAME,v,DAYS);try{localStorage.setItem(NAME,v);}catch(e){}}

    function show(){
        var card=document.getElementById('shb-card');
        var overlay=document.getElementById('shb-overlay');
        card.style.display='block';
        overlay.style.display='block';
        requestAnimationFrame(function(){
            requestAnimationFrame(function(){
                card.classList.add('shb-visible');
                overlay.classList.add('shb-show');
            });
        });
    }
    function hide(){
        var card=document.getElementById('shb-card');
        var overlay=document.getElementById('shb-overlay');
        card.classList.remove('shb-visible');
        overlay.classList.remove('shb-show');
        setTimeout(function(){card.style.display='none';overlay.style.display='none';},460);
    }

    function toast(msg,color){
        var t=document.getElementById('shb-toast');
        document.getElementById('shb-toast-msg').textContent=msg;
        t.style.background=color;
        t.classList.add('shb-toast-in');
        setTimeout(function(){t.classList.remove('shb-toast-in');},3500);
    }

    document.addEventListener('DOMContentLoaded',function(){
        setTimeout(show, 700);
    });

    window.shbAccept=function(){
        hide();
        toast('🎉 All cookies accepted — thank you!','linear-gradient(135deg,#166534,#15803D)');
    };
    window.shbReject=function(){
        hide();
        toast('Only essential cookies are active.','linear-gradient(135deg,#1E293B,#334155)');
    };
    window.shbClose=function(){hide();};

    window.shbTogglePrefs=function(){
        var panel=document.getElementById('shb-prefs');
        var label=document.getElementById('shb-prefs-label');
        prefsOpen=!prefsOpen;
        panel.style.display=prefsOpen?'block':'none';
        label.textContent=prefsOpen?'Hide Options':'Customize';
    };

    window.shbToggle=function(type){
        var cb=document.getElementById('shb-chk-'+type);
        var trk=document.getElementById('shb-trk-'+type);
        var knb=document.getElementById('shb-knb-'+type);
        cb.checked=!cb.checked;
        if(cb.checked){trk.classList.add('active');knb.classList.add('active');}
        else{trk.classList.remove('active');knb.classList.remove('active');}
    };

    window.shbSavePrefs=function(){
        hide();
        toast('✓ Your preferences have been saved!','linear-gradient(135deg,#1E3A8A,#2563EB)');
    };
})();
</script>
@endif
