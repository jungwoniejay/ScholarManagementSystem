@once
<style>
[x-cloak]{display:none!important;}
#app-cookie-banner{
    position:fixed;bottom:1.5rem;right:1.5rem;z-index:9999;
    width:calc(100% - 3rem);max-width:420px;
    background:#fff;border-radius:20px;
    box-shadow:0 20px 60px rgba(30,58,138,.18),0 4px 16px rgba(0,0,0,.08);
    border:1px solid rgba(30,58,138,.08);overflow:hidden;
    font-family:'Inter',ui-sans-serif,sans-serif;
}
.acb-bar{height:4px;background:linear-gradient(90deg,#1E3A8A,#3B82F6,#14B8A6);}
.acb-body{padding:1.25rem;}
.acb-head{display:flex;align-items:flex-start;gap:.85rem;margin-bottom:1rem;}
.acb-icon{
    flex-shrink:0;width:42px;height:42px;border-radius:12px;
    background:linear-gradient(135deg,#1E3A8A,#2563EB);
    display:flex;align-items:center;justify-content:center;
    font-size:1.2rem;box-shadow:0 4px 12px rgba(37,99,235,.3);
}
.acb-text{flex:1;min-width:0;}
.acb-title{font-size:.88rem;font-weight:800;color:#0F172A;margin:0 0 .25rem;letter-spacing:-.1px;}
.acb-desc{font-size:.76rem;color:#64748B;line-height:1.55;margin:0;}
.acb-close{
    flex-shrink:0;background:none;border:none;cursor:pointer;
    width:28px;height:28px;border-radius:7px;
    display:flex;align-items:center;justify-content:center;
    color:#94A3B8;transition:background .15s,color .15s;
}
.acb-close:hover{background:#F1F5F9;color:#475569;}
.acb-links{display:flex;align-items:center;gap:.4rem;margin-bottom:.85rem;flex-wrap:wrap;}
.acb-link{font-size:.72rem;font-weight:600;color:#2563EB;text-decoration:none;padding:.2rem .4rem;border-radius:5px;transition:background .15s;}
.acb-link:hover{background:#EFF6FF;}
.acb-sep{width:3px;height:3px;border-radius:50%;background:#CBD5E1;}
.acb-btns{display:flex;gap:.4rem;flex-wrap:wrap;}
.acb-btn-reject{
    flex:1;font-size:.76rem;font-weight:600;padding:.5rem .75rem;
    border-radius:9px;cursor:pointer;border:1.5px solid #E2E8F0;
    background:#F8FAFC;color:#475569;transition:all .2s;
}
.acb-btn-reject:hover{background:#F1F5F9;border-color:#CBD5E1;}
.acb-btn-custom{
    flex:1;font-size:.76rem;font-weight:600;padding:.5rem .75rem;
    border-radius:9px;cursor:pointer;border:1.5px solid #BFDBFE;
    background:#EFF6FF;color:#1E3A8A;transition:all .2s;
}
.acb-btn-custom:hover{background:#DBEAFE;}
.acb-btn-accept{
    flex:2;font-size:.78rem;font-weight:700;padding:.5rem .75rem;
    border-radius:9px;cursor:pointer;border:none;
    background:linear-gradient(135deg,#1E3A8A,#2563EB);
    color:#fff;box-shadow:0 4px 12px rgba(37,99,235,.35);
    transition:all .2s;display:flex;align-items:center;justify-content:center;gap:.35rem;
}
.acb-btn-accept:hover{transform:translateY(-1px);box-shadow:0 6px 16px rgba(37,99,235,.45);}

/* Prefs */
.acb-prefs{border-top:1px solid #F1F5F9;padding:1rem 1.25rem 1.25rem;background:#F8FAFC;}
.acb-prefs-title{font-size:.78rem;font-weight:700;color:#0F172A;margin:0 0 .75rem;}
.acb-pref-row{
    display:flex;align-items:center;justify-content:space-between;gap:.75rem;
    padding:.6rem .75rem;border-radius:10px;background:#fff;
    border:1px solid #E2E8F0;margin-bottom:.4rem;
}
.acb-pref-row:last-of-type{margin-bottom:0;}
.acb-pref-name{font-size:.76rem;font-weight:700;color:#1E293B;}
.acb-pref-sub{font-size:.68rem;color:#94A3B8;margin-top:.1rem;}
.acb-always{font-size:.65rem;font-weight:700;padding:.2rem .55rem;background:#E0E7FF;color:#3730A3;border-radius:50px;}
/* Toggle */
.acb-toggle{position:relative;width:38px;height:21px;flex-shrink:0;}
.acb-toggle input{position:absolute;opacity:0;width:0;height:0;}
.acb-track{
    position:absolute;inset:0;border-radius:50px;cursor:pointer;
    background:#CBD5E1;transition:background .2s;
}
.acb-track.on{background:linear-gradient(135deg,#2563EB,#1D4ED8);}
.acb-knob{
    position:absolute;top:2.5px;left:2.5px;
    width:16px;height:16px;border-radius:50%;
    background:#fff;box-shadow:0 1px 3px rgba(0,0,0,.2);
    transition:left .22s cubic-bezier(.34,1.56,.64,1);pointer-events:none;
}
.acb-knob.on{left:19.5px;}
.acb-save-btn{
    width:100%;margin-top:.75rem;font-size:.76rem;font-weight:700;
    padding:.55rem;border-radius:9px;cursor:pointer;border:none;
    background:linear-gradient(135deg,#1E3A8A,#2563EB);
    color:#fff;box-shadow:0 3px 10px rgba(37,99,235,.3);transition:all .2s;
}
.acb-save-btn:hover{transform:translateY(-1px);box-shadow:0 5px 14px rgba(37,99,235,.4);}

@media(max-width:480px){
    #app-cookie-banner{right:.75rem;bottom:.75rem;width:calc(100% - 1.5rem);max-width:100%;}
}
</style>
@endonce

@php $enabled = $settings->enabled ?? false; @endphp

@if($enabled)
<div id="app-cookie-banner"
    x-data="cookieBanner({ cookieName:'announcement_consent', expiryDays:{{ $settings->expiry_days ?? 365 }} })"
    x-init="init()"
    x-show="show"
    x-cloak
    x-transition:enter="transition ease-out duration-400"
    x-transition:enter-start="opacity-0 translate-y-4 scale-95"
    x-transition:enter-end="opacity-100 translate-y-0 scale-100"
    x-transition:leave="transition ease-in duration-250"
    x-transition:leave-start="opacity-100 translate-y-0 scale-100"
    x-transition:leave-end="opacity-0 translate-y-4 scale-95"
    role="dialog" aria-label="Cookie consent">

    <div class="acb-bar"></div>
    <div class="acb-body">
        <div class="acb-head">
            <div class="acb-icon">🍪</div>
            <div class="acb-text">
                <p class="acb-title">Cookie Preferences</p>
                <p class="acb-desc">We use cookies to keep you signed in and improve your experience on ScholarHub.</p>
            </div>
            <button class="acb-close" @click="closeTemporarily()" title="Dismiss" aria-label="Close">
                <svg width="14" height="14" fill="none" stroke="currentColor" stroke-width="2.2" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
        </div>

        <div class="acb-links">
            <a href="{{ route('privacy-policy') }}" class="acb-link" target="_blank">Privacy Policy</a>
            <div class="acb-sep"></div>
            <a href="{{ route('terms-and-conditions') }}" class="acb-link" target="_blank">Terms & Conditions</a>
        </div>

        <div class="acb-btns">
            <button class="acb-btn-reject" @click="reject()">Reject</button>
            <button class="acb-btn-custom" @click="openPreferences()">
                <span x-text="prefsOpen ? 'Hide' : 'Customize'"></span>
            </button>
            <button class="acb-btn-accept" @click="accept()">
                <svg width="13" height="13" fill="none" stroke="currentColor" stroke-width="2.5" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7"/>
                </svg>
                Accept All
            </button>
        </div>
    </div>

    {{-- Preferences --}}
    <div class="acb-prefs" x-show="prefsOpen" x-transition x-cloak>
        <p class="acb-prefs-title">Manage Cookies</p>

        <div class="acb-pref-row">
            <div>
                <p class="acb-pref-name">Essential</p>
                <p class="acb-pref-sub">Login, security & core features.</p>
            </div>
            <span class="acb-always">Always On</span>
        </div>

        <div class="acb-pref-row">
            <div>
                <p class="acb-pref-name">Analytics</p>
                <p class="acb-pref-sub">Helps us improve the platform.</p>
            </div>
            <div class="acb-toggle" @click="prefs.analytics = !prefs.analytics">
                <input type="checkbox" x-model="prefs.analytics">
                <div class="acb-track" :class="prefs.analytics ? 'on' : ''"></div>
                <div class="acb-knob" :class="prefs.analytics ? 'on' : ''"></div>
            </div>
        </div>

        <div class="acb-pref-row">
            <div>
                <p class="acb-pref-name">Marketing</p>
                <p class="acb-pref-sub">Personalised content & offers.</p>
            </div>
            <div class="acb-toggle" @click="prefs.marketing = !prefs.marketing">
                <input type="checkbox" x-model="prefs.marketing">
                <div class="acb-track" :class="prefs.marketing ? 'on' : ''"></div>
                <div class="acb-knob" :class="prefs.marketing ? 'on' : ''"></div>
            </div>
        </div>

        <button class="acb-save-btn" @click="savePreferences()">Save My Preferences</button>
    </div>
</div>
@endif

@once
<script>
function cookieBanner({ cookieName = 'announcement_consent', expiryDays = 365 } = {}) {
    return {
        show: false,
        prefsOpen: false,
        cookieName,
        expiryDays: parseInt(expiryDays) || 365,
        prefs: { analytics: true, marketing: false },

        init() {
            const raw = this.getCookie(this.cookieName) || localStorage.getItem(this.cookieName);
            if (!raw) { this.show = true; return; }
            try { JSON.parse(raw); }
            catch(e) {
                this.setCookie(this.cookieName, '', -1);
                try { localStorage.removeItem(this.cookieName); } catch(e) {}
                this.show = true;
            }
        },

        accept() {
            this.save(JSON.stringify({ consent:true, analytics:true, marketing:true }));
            this.show = false;
        },

        reject() {
            this.save(JSON.stringify({ consent:false, analytics:false, marketing:false }));
            this.show = false;
        },

        openPreferences() {
            const raw = this.getCookie(this.cookieName) || localStorage.getItem(this.cookieName);
            if (raw) { try { const o = JSON.parse(raw); this.prefs.analytics = !!o.analytics; this.prefs.marketing = !!o.marketing; } catch(e) {} }
            this.prefsOpen = !this.prefsOpen;
        },

        savePreferences() {
            this.save(JSON.stringify({ consent: !!(this.prefs.analytics||this.prefs.marketing), analytics: !!this.prefs.analytics, marketing: !!this.prefs.marketing }));
            this.prefsOpen = false;
            this.show = false;
        },

        closeTemporarily() { this.show = false; },

        save(v) {
            this.setCookie(this.cookieName, v, this.expiryDays);
            try { localStorage.setItem(this.cookieName, v); } catch(e) {}
        },

        setCookie(n, v, d) {
            const e = new Date(Date.now() + d * 864e5).toUTCString();
            document.cookie = encodeURIComponent(n) + '=' + encodeURIComponent(v) + '; expires=' + e + '; path=/; SameSite=Lax';
        },

        getCookie(n) {
            const c = document.cookie ? document.cookie.split('; ') : [];
            for (const s of c) { const [k,...v] = s.split('='); if (decodeURIComponent(k) === n) return decodeURIComponent(v.join('=')); }
            return null;
        }
    };
}
</script>
@endonce
