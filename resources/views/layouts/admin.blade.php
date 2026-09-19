<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, viewport-fit=cover">
    <meta name="mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black-translucent">
    <meta name="theme-color" content="#006E61">
    <title>@yield('title','Dashboard') | Aakar Admin</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Playfair+Display:wght@600;700&display=swap" rel="stylesheet">
    @vite(['resources/css/app.css'])

    @php
        $cp  = App\Models\SiteSetting::get('color_primary',      '#006E61');
        $cpd = App\Models\SiteSetting::get('color_primary_dark',  '#00584E');
        $cpl = App\Models\SiteSetting::get('color_primary_light', '#E8F7F5');
        $ca  = App\Models\SiteSetting::get('color_accent',        '#CC9134');
        $cad = App\Models\SiteSetting::get('color_accent_dark',   '#A87228');
        $cal = App\Models\SiteSetting::get('color_accent_light',  '#FBF4E8');

        // Build nav items array used by both sidebar and mobile bottom nav
        $pendingCount = \App\Models\Appointment::where('status','pending')->count();

        $navGroups = [
            'Main' => [
                ['route'=>'admin.dashboard',           'match'=>'admin.dashboard',           'label'=>'Dashboard',    'icon'=>'M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6'],
                ['route'=>'admin.appointments.index',  'match'=>'admin.appointments.*',       'label'=>'Appts',        'icon'=>'M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z', 'badge'=>$pendingCount],
                ['route'=>'admin.services.index',      'match'=>'admin.services.*',           'label'=>'Services',     'icon'=>'M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z'],
                ['route'=>'admin.blogs.index',         'match'=>'admin.blogs.*',              'label'=>'Blogs',        'icon'=>'M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z'],
                ['route'=>'admin.videos.index',        'match'=>'admin.videos.*',             'label'=>'Videos',       'icon'=>'M15 10l4.553-2.276A1 1 0 0121 8.618v6.764a1 1 0 01-1.447.894L15 14M5 18h8a2 2 0 002-2V8a2 2 0 00-2-2H5a2 2 0 00-2 2v8a2 2 0 002 2z'],
                ['route'=>'admin.gallery.index',       'match'=>'admin.gallery.*',            'label'=>'Gallery',      'icon'=>'M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z M15 13a3 3 0 11-6 0 3 3 0 016 0z'],
            ],
            'Content' => [
                ['route'=>'admin.testimonials.index',  'match'=>'admin.testimonials.*',       'label'=>'Testimonials', 'icon'=>'M8 10h.01M12 10h.01M16 10h.01M9 16H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-5l-5 5v-5z'],
                ['route'=>'admin.before-afters.index', 'match'=>'admin.before-afters.*',      'label'=>'Before/After', 'icon'=>'M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z'],
                ['route'=>'admin.team.index',          'match'=>'admin.team.*',               'label'=>'Team',         'icon'=>'M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0z'],
            ],
            'Settings' => [
                ['route'=>'admin.seo.index',           'match'=>'admin.seo.*',                'label'=>'SEO',          'icon'=>'M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z'],
                ['route'=>'admin.why-choose-us.index', 'match'=>'admin.why-choose-us.*',      'label'=>'Why Us',       'icon'=>'M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z'],
                ['route'=>'admin.settings.index',      'match'=>'admin.settings.*',           'label'=>'Settings',     'icon'=>'M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z M15 12a3 3 0 11-6 0 3 3 0 016 0z'],
            ],
        ];

        // Bottom 5 tabs (most-used)
        $bottomTabs = [
            ['route'=>'admin.dashboard',          'match'=>'admin.dashboard',      'label'=>'Home',      'icon'=>'M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6'],
            ['route'=>'admin.appointments.index', 'match'=>'admin.appointments.*', 'label'=>'Appts',     'icon'=>'M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z', 'badge'=>$pendingCount],
            ['route'=>'admin.services.index',     'match'=>'admin.services.*',     'label'=>'Services',  'icon'=>'M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z'],
            ['route'=>'admin.blogs.index',        'match'=>'admin.blogs.*',        'label'=>'Blogs',     'icon'=>'M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1m2 13a2 2 0 01-2-2V7m2 13a2 2 0 002-2V9a2 2 0 00-2-2h-2m-4-3H9M7 16h6M7 8h6v4H7V8z'],
            ['route'=>'admin.settings.index',     'match'=>'admin.settings.*',     'label'=>'Settings',  'icon'=>'M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z M15 12a3 3 0 11-6 0 3 3 0 016 0z'],
        ];
    @endphp

    <style>
        /* ─── Brand tokens ─────────────────────────────── */
        :root {
            --primary:       {{ $cp }};
            --primary-dark:  {{ $cpd }};
            --primary-light: {{ $cpl }};
            --primary-glow:  {{ hexToRgba($cp, 0.15) }};
            --accent:        {{ $ca }};
            --accent-dark:   {{ $cad }};
            --accent-light:  {{ $cal }};
            --accent-glow:   {{ hexToRgba($ca, 0.18) }};
            --dark:          #002B26;
            --text:          #1A2B29;
            --muted:         #4D7A75;
            --border:        #B2D9D4;
            --bg:            #F5FBFA;
            --sidebar-bg:    linear-gradient(170deg,#002B26 0%,{{ $cpd }} 100%);

            /* mobile safe area */
            --safe-bottom: env(safe-area-inset-bottom, 0px);
            --safe-top:    env(safe-area-inset-top, 0px);
        }

        /* ─── Reset / Base ────────────────────────────── */
        *, *::before, *::after { box-sizing: border-box; }
        html, body { height: 100%; margin: 0; }
        body {
            background: var(--bg);
            font-family: 'Inter', sans-serif;
            color: var(--text);
            -webkit-font-smoothing: antialiased;
            overscroll-behavior: none;
        }

        /* ─── Desktop sidebar ─────────────────────────── */
        .admin-sidebar {
            width: 260px;
            flex-shrink: 0;
            position: sticky;
            top: 0;
            height: 100vh;
            overflow-y: auto;
            background: var(--sidebar-bg);
        }
        .sidebar-link {
            display: flex; align-items: center; gap: .75rem;
            padding: .6rem 1rem; border-radius: 10px;
            color: rgba(255,255,255,.68); font-size: .875rem; font-weight: 500;
            text-decoration: none; transition: all .2s;
        }
        .sidebar-link:hover, .sidebar-link.active {
            background: rgba(255,255,255,.1); color: #fff;
        }
        .sidebar-link.active {
            border-left: 3px solid {{ $ca }};
            padding-left: calc(1rem - 3px);
        }
        .sidebar-group-label {
            font-size: .62rem; font-weight: 700; letter-spacing: .14em;
            text-transform: uppercase; color: rgba(255,255,255,.28);
            padding: .5rem 1rem; margin-top: 1rem;
        }

        /* ─── Desktop topbar ──────────────────────────── */
        .admin-topbar {
            background: #fff;
            border-bottom: 1px solid #E5E7EB;
            height: 64px;
            display: flex; align-items: center;
            padding: 0 1.5rem; gap: 1rem;
            position: sticky; top: 0; z-index: 40;
            box-shadow: 0 1px 8px {{ hexToRgba($cp, 0.06) }};
        }

        /* ─── Stat cards ──────────────────────────────── */
        .stat-card {
            background: #fff; border-radius: 16px; padding: 1.25rem 1.5rem;
            box-shadow: 0 2px 12px {{ hexToRgba($cp, 0.08) }};
            border-left: 4px solid {{ $ca }};
        }

        /* ─── Tables ──────────────────────────────────── */
        .admin-table { min-width: 640px; }
        .admin-table th {
            background: #F5FBFA; font-size: .78rem; font-weight: 700;
            color: {{ $cp }}; text-transform: uppercase; letter-spacing: .08em;
            padding: .75rem 1rem; text-align: left;
            border-bottom: 2px solid {{ $cpl }};
        }
        .admin-table td {
            padding: .75rem 1rem; font-size: .875rem; color: var(--text);
            border-top: 1px solid #F0FAF8;
        }
        .admin-table tr:hover td { background: #F5FBFA; }

        /* ─── Badges ──────────────────────────────────── */
        .badge {
            display: inline-flex; align-items: center; gap: .25rem;
            padding: .2rem .65rem; border-radius: 9999px;
            font-size: .7rem; font-weight: 700; letter-spacing: .04em;
        }
        .badge-green  { background: #D1FAE5; color: #065F46; }
        .badge-yellow { background: #FEF3C7; color: #92400E; }
        .badge-red    { background: #FEE2E2; color: #991B1B; }
        .badge-blue   { background: {{ $cpl }}; color: {{ $cpd }}; }
        .badge-gray   { background: #F3F4F6; color: #374151; }
        .badge-accent { background: {{ $cal }}; color: {{ $cad }}; }

        /* ─── Dropzone ────────────────────────────────── */
        .dropzone-wrap {
            border: 1.5px dashed var(--border); border-radius: 16px;
            background: linear-gradient(135deg,#fff,{{ $cpl }});
            padding: 1rem; transition: all .2s;
        }
        .dropzone-wrap.dragover { border-color: var(--primary); background: {{ hexToRgba($cp,.05) }}; }
        .dropzone-label {
            display: flex; align-items: center; justify-content: center; gap: .5rem;
            cursor: pointer; color: var(--primary); font-weight: 600; font-size: .85rem; text-align: center;
        }
        .dropzone-files { margin-top: .75rem; display: flex; flex-wrap: wrap; gap: .5rem; font-size: .75rem; color: var(--muted); }
        .dropzone-files span { background: {{ hexToRgba($cp,.08) }}; border: 1px solid {{ hexToRgba($cp,.12) }}; border-radius: 999px; padding: .35rem .6rem; }

        /* ═══════════════════════════════════════════════
           MOBILE APP SHELL  (< 1024px)
           ═══════════════════════════════════════════════ */
        @media (max-width: 1023px) {

            /* ── Wrapper ── */
            .mobile-shell {
                display: flex;
                flex-direction: column;
                min-height: 100vh;
                min-height: -webkit-fill-available;
            }

            /* ── Mobile top header ── */
            .mobile-header {
                position: sticky; top: 0; z-index: 60;
                background: var(--primary-dark);
                padding: calc(var(--safe-top) + .75rem) 1rem .75rem;
                display: flex; align-items: center; justify-content: space-between;
                box-shadow: 0 2px 12px rgba(0,0,0,.2);
            }
            .mobile-header-brand { display: flex; align-items: center; gap: .625rem; }
            .mobile-header-avatar {
                width: 36px; height: 36px; border-radius: 10px; flex-shrink: 0;
                background: linear-gradient(135deg, var(--primary), var(--accent));
                display: flex; align-items: center; justify-content: center;
            }
            .mobile-header-btn {
                width: 40px; height: 40px; border-radius: 10px; border: none;
                background: rgba(255,255,255,.1); cursor: pointer;
                display: flex; align-items: center; justify-content: center;
                color: #fff; transition: background .2s;
            }
            .mobile-header-btn:active { background: rgba(255,255,255,.2); }

            /* ── Flash toast ── */
            .mobile-toast {
                position: fixed; top: calc(var(--safe-top) + 72px); left: 1rem; right: 1rem;
                z-index: 100; border-radius: 14px;
                padding: .75rem 1rem;
                font-size: .85rem; font-weight: 500;
                box-shadow: 0 8px 24px rgba(0,0,0,.15);
                animation: slideDown .3s ease both;
            }
            @keyframes slideDown {
                from { opacity:0; transform:translateY(-12px); }
                to   { opacity:1; transform:translateY(0); }
            }

            /* ── Main scroll area ── */
            .mobile-main {
                flex: 1; overflow-y: auto; -webkit-overflow-scrolling: touch;
                padding: 1rem 1rem calc(80px + var(--safe-bottom));
            }

            /* ── Bottom navigation bar ── */
            .mobile-bottom-nav {
                position: fixed;
                bottom: 0; left: 0; right: 0;
                z-index: 60;
                background: #fff;
                border-top: 1px solid #E5E7EB;
                padding-bottom: var(--safe-bottom);
                display: grid;
                grid-template-columns: repeat(5, 1fr);
                box-shadow: 0 -4px 20px rgba(0,0,0,.08);
            }
            .bottom-tab {
                display: flex; flex-direction: column; align-items: center; justify-content: center;
                gap: 3px; padding: .6rem .25rem;
                text-decoration: none; color: var(--muted);
                font-size: .6rem; font-weight: 600; letter-spacing: .02em;
                position: relative; transition: color .18s; border: none; background: none; cursor: pointer;
                -webkit-tap-highlight-color: transparent;
            }
            .bottom-tab svg { width: 22px; height: 22px; flex-shrink: 0; transition: transform .18s; }
            .bottom-tab.active { color: var(--primary); }
            .bottom-tab.active svg { transform: scale(1.12); }
            .bottom-tab.active::before {
                content: ''; position: absolute; top: 0; left: 50%; transform: translateX(-50%);
                width: 28px; height: 3px; border-radius: 0 0 6px 6px;
                background: var(--primary);
            }
            .bottom-tab-badge {
                position: absolute; top: 6px; right: calc(50% - 16px);
                background: #EF4444; color: #fff;
                font-size: .55rem; font-weight: 700;
                min-width: 16px; height: 16px; border-radius: 8px;
                display: flex; align-items: center; justify-content: center;
                padding: 0 3px; border: 2px solid #fff;
            }

            /* ── Drawer overlay ── */
            .drawer-overlay {
                position: fixed; inset: 0; z-index: 70;
                background: rgba(0,0,0,.45);
                opacity: 0; pointer-events: none;
                transition: opacity .25s;
                backdrop-filter: blur(2px);
            }
            .drawer-overlay.open { opacity: 1; pointer-events: all; }

            /* ── Slide-in drawer ── */
            .mobile-drawer {
                position: fixed; top: 0; left: 0; bottom: 0;
                width: min(300px, 82vw); z-index: 80;
                background: var(--sidebar-bg);
                transform: translateX(-100%);
                transition: transform .28s cubic-bezier(.4,0,.2,1);
                display: flex; flex-direction: column;
                box-shadow: 6px 0 24px rgba(0,0,0,.25);
                overscroll-behavior: contain;
            }
            .mobile-drawer.open { transform: translateX(0); }

            /* drawer scrollable nav */
            .drawer-nav { flex: 1; overflow-y: auto; padding: .5rem .75rem 1rem; }

            /* Drawer nav link */
            .drawer-link {
                display: flex; align-items: center; gap: .75rem;
                padding: .65rem .875rem; border-radius: 12px;
                color: rgba(255,255,255,.72); font-size: .9rem; font-weight: 500;
                text-decoration: none; transition: all .18s;
                margin-bottom: 2px;
            }
            .drawer-link:active, .drawer-link.active {
                background: rgba(255,255,255,.12); color: #fff;
            }
            .drawer-link.active { border-left: 3px solid {{ $ca }}; padding-left: calc(.875rem - 3px); }
            .drawer-group-label {
                font-size: .6rem; font-weight: 700; letter-spacing: .16em;
                text-transform: uppercase; color: rgba(255,255,255,.28);
                padding: .75rem .875rem .35rem; margin-top: .25rem;
            }

            /* ── Mobile card styles ── */
            .mob-stat-card {
                background: #fff; border-radius: 18px; padding: 1rem 1.125rem;
                box-shadow: 0 2px 12px rgba(0,110,97,.08);
            }
            .mob-quick-btn {
                display: flex; flex-direction: column; align-items: center; justify-content: center; gap: 6px;
                padding: .875rem .5rem; background: #fff; border-radius: 16px;
                box-shadow: 0 2px 12px rgba(0,110,97,.07);
                text-decoration: none; color: var(--dark); font-size: .7rem; font-weight: 600;
                text-align: center; border: 1.5px solid var(--border);
                transition: all .18s; -webkit-tap-highlight-color: transparent;
            }
            .mob-quick-btn:active { transform: scale(.96); }

            /* ── Mobile table → card list ── */
            .admin-table {
                min-width: 0 !important;
                width: 100%;
                display: block !important;
                border-radius: 16px;
                overflow: hidden;
            }
            .admin-table thead { display: none; }
            .admin-table tbody { display: block !important; width: 100%; }
            .admin-table tr {
                display: block !important; width: 100% !important;
                background: #fff !important; margin-bottom: .625rem;
                border-radius: 14px; padding: .875rem 1rem;
                box-shadow: 0 1px 8px rgba(0,110,97,.07);
                border: 1px solid var(--border);
            }
            .admin-table td {
                width: 100%;
                display: flex; align-items: flex-start; gap: .625rem;
                padding: .2rem 0; border-top: none;
                font-size: .85rem;
            }
            .admin-table td::before {
                content: attr(data-label);
                font-size: .65rem; font-weight: 700; text-transform: uppercase;
                letter-spacing: .06em; color: var(--muted);
                min-width: 88px; flex-shrink: 0; padding-top: 1px;
            }

            /* ─ hide desktop sidebar/topbar ─ */
            .admin-sidebar, .admin-topbar { display: none !important; }
            /* ─ hide desktop content wrapper (JS moves children to mobile-main) ─ */
            .admin-content { display: none !important; }
            .admin-table { min-width: 0 !important; width: 100%; }
        }

        /* ─── Desktop only ────────────────────────────── */
        @media (min-width: 1024px) {
            .admin-desktop-shell { min-height: 100vh; }
            .mobile-shell { display: none !important; }
            .mobile-header,
            .mobile-bottom-nav,
            .mobile-drawer,
            .drawer-overlay { display: none !important; }
            .admin-content { flex: 1; min-width: 0; }
            .mobile-main { padding: 0; overflow: visible; }
            /* On desktop, always show the content even if JS didn't run */
            #admin-page-content { display: block !important; }
        }

        /* ─── Pull-to-refresh indicator ──────────────── */
        .ptr-spinner {
            position: fixed; top: calc(var(--safe-top) + 68px); left: 50%;
            transform: translateX(-50%);
            z-index: 55; opacity: 0; transition: opacity .2s;
        }
        .ptr-spinner.show { opacity: 1; }
    </style>
    @stack('styles')
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.8/css/dataTables.dataTables.min.css"/>
</head>
<body>

{{-- ══════════════════════════════════════════════
     DESKTOP LAYOUT (lg+)
══════════════════════════════════════════════ --}}
<div class="admin-desktop-shell lg:flex">

    {{-- Desktop sidebar --}}
    <aside class="admin-sidebar hidden lg:flex flex-col">
        {{-- Brand --}}
        <div class="p-5 border-b" style="border-color:rgba(255,255,255,.08)">
            <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3" style="text-decoration:none">
                <div class="w-10 h-10 rounded-xl flex items-center justify-center flex-shrink-0"
                     style="background:linear-gradient(135deg,var(--primary),var(--accent))">
                    <span class="text-white font-bold text-lg" style="font-family:'Playfair Display',serif">AR</span>
                </div>
                <div>
                    <div class="font-bold text-sm text-white" style="font-family:'Playfair Display',serif">AAKAR</div>
                    <div class="text-xs font-semibold tracking-widest" style="color:var(--accent)">ADMIN PANEL</div>
                </div>
            </a>
        </div>

        {{-- Nav --}}
        <nav class="flex-1 p-3 overflow-y-auto">
            @foreach($navGroups as $groupName => $items)
            <div class="sidebar-group-label">{{ $groupName }}</div>
            @foreach($items as $item)
            <a href="{{ route($item['route']) }}"
               class="sidebar-link {{ request()->routeIs($item['match']) ? 'active' : '' }}">
                <svg class="w-4 h-4 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $item['icon'] }}"/>
                </svg>
                {{ $item['label'] }}
                @if(!empty($item['badge']) && $item['badge'])
                <span class="ml-auto badge badge-yellow">{{ $item['badge'] }}</span>
                @endif
            </a>
            @endforeach
            @endforeach
        </nav>

        {{-- User footer --}}
        <div class="p-4 border-t" style="border-color:rgba(255,255,255,.08)">
            <div class="flex items-center gap-3 mb-3">
                <div class="w-8 h-8 rounded-full flex items-center justify-center text-white text-sm font-bold"
                     style="background:linear-gradient(135deg,var(--primary),var(--accent))">
                    {{ strtoupper(substr(auth()->user()->name ?? 'A', 0, 1)) }}
                </div>
                <div class="flex-1 min-w-0">
                    <div class="text-sm font-medium text-white truncate">{{ auth()->user()->name ?? 'Admin' }}</div>
                    <div class="text-xs" style="color:rgba(255,255,255,.4)">Administrator</div>
                </div>
            </div>
            <div class="flex gap-2">
                <a href="{{ route('home') }}" target="_blank"
                   class="flex-1 text-center py-1.5 text-xs rounded-lg"
                   style="background:rgba(255,255,255,.08);color:rgba(255,255,255,.65)">View Site</a>
                <form action="{{ route('admin.logout') }}" method="POST" class="flex-1">
                    @csrf
                    <button type="submit" class="w-full py-1.5 text-xs rounded-lg"
                            style="background:rgba(204,145,52,.15);color:#D9A24A">Logout</button>
                </form>
            </div>
        </div>
    </aside>

    {{-- Desktop main --}}
    <div class="admin-content hidden lg:flex flex-col" style="min-height:100vh">
        {{-- Topbar --}}
        <div class="admin-topbar">
            <div class="flex items-center gap-3 flex-1">
                <div class="w-1 h-7 rounded-full" style="background:linear-gradient(180deg,var(--primary),var(--accent))"></div>
                <h1 class="text-lg font-bold" style="color:var(--dark);font-family:'Playfair Display',serif">@yield('title','Dashboard')</h1>
            </div>
            @if(session('success'))
            <div class="alert-success text-sm px-4 py-2 max-w-sm">{{ session('success') }}</div>
            @endif
            @if(session('error'))
            <div class="alert-error text-sm px-4 py-2 max-w-sm">{{ session('error') }}</div>
            @endif
        </div>
        <main class="flex-1 p-6" id="admin-page-content">@yield('content')</main>
    </div>

</div>{{-- /desktop layout --}}


{{-- ══════════════════════════════════════════════
     MOBILE APP SHELL  (< 1024px)
══════════════════════════════════════════════ --}}
<div class="mobile-shell lg:hidden">

    {{-- ── Mobile top header ── --}}
    <header class="mobile-header">
        {{-- Left: hamburger --}}
        <button class="mobile-header-btn" id="mob-drawer-open" aria-label="Open menu">
            <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"/>
            </svg>
        </button>

        {{-- Center: brand --}}
        <a href="{{ route('admin.dashboard') }}" class="mobile-header-brand" style="text-decoration:none">
            <div class="mobile-header-avatar">
                <span class="text-white font-bold text-base" style="font-family:'Playfair Display',serif">AR</span>
            </div>
            <div>
                <div class="font-bold text-sm text-white" style="font-family:'Playfair Display',serif;line-height:1.1">AAKAR</div>
                <div class="text-xs" style="color:var(--accent);letter-spacing:.1em">ADMIN</div>
            </div>
        </a>

        {{-- Right: avatar + pending badge --}}
        <div class="relative">
            <a href="{{ route('admin.appointments.index') }}"
               class="mobile-header-btn" aria-label="Appointments">
                <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z"/>
                </svg>
            </a>
            @if($pendingCount)
            <span class="bottom-tab-badge" style="top:-2px;right:-2px">{{ $pendingCount }}</span>
            @endif
        </div>
    </header>

    {{-- ── Flash toast ── --}}
    @if(session('success'))
    <div class="mobile-toast alert-success" id="mob-toast">{{ session('success') }}</div>
    @endif
    @if(session('error'))
    <div class="mobile-toast alert-error" id="mob-toast-err">{{ session('error') }}</div>
    @endif

    {{-- ── Page title strip ── --}}
    <div class="flex items-center gap-2 px-4 pt-4 pb-1">
        <div class="w-1 h-5 rounded-full flex-shrink-0"
             style="background:linear-gradient(180deg,var(--primary),var(--accent))"></div>
        <h1 class="text-base font-bold" style="color:var(--dark);font-family:'Playfair Display',serif">
            @yield('title','Dashboard')
        </h1>
    </div>

    {{-- ── Scrollable content — JS moves #admin-page-content here on mobile ── --}}
    <main class="mobile-main" id="mobile-content-area"></main>

    {{-- ── Bottom tab bar ── --}}
    <nav class="mobile-bottom-nav" role="navigation" aria-label="Main navigation">
        @foreach($bottomTabs as $tab)
        @php $tabActive = request()->routeIs($tab['match']); @endphp
        <a href="{{ route($tab['route']) }}"
           class="bottom-tab {{ $tabActive ? 'active' : '' }}"
           aria-label="{{ $tab['label'] }}">
            @if(!empty($tab['badge']) && $tab['badge'] && !$tabActive)
            <span class="bottom-tab-badge">{{ $tab['badge'] }}</span>
            @endif
            <svg fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round"
                      stroke-width="{{ $tabActive ? '2.5' : '1.8' }}"
                      d="{{ $tab['icon'] }}"/>
            </svg>
            <span>{{ $tab['label'] }}</span>
        </a>
        @endforeach
    </nav>

</div>{{-- /mobile-shell --}}


{{-- ══════════════════════════════════════════════
     MOBILE DRAWER (shared for all sizes)
══════════════════════════════════════════════ --}}
<div class="drawer-overlay" id="drawer-overlay"></div>

<div class="mobile-drawer" id="mobile-drawer" role="dialog" aria-modal="true" aria-label="Navigation menu">

    {{-- Drawer header --}}
    <div class="p-4 flex items-center justify-between border-b" style="border-color:rgba(255,255,255,.08)">
        <div class="flex items-center gap-3">
            <div class="w-10 h-10 rounded-xl flex items-center justify-center"
                 style="background:linear-gradient(135deg,var(--primary),var(--accent))">
                <span class="text-white font-bold" style="font-family:'Playfair Display',serif">AR</span>
            </div>
            <div>
                <div class="font-bold text-sm text-white" style="font-family:'Playfair Display',serif">AAKAR</div>
                <div class="text-xs" style="color:var(--accent)">ADMIN PANEL</div>
            </div>
        </div>
        <button class="mobile-header-btn" id="mob-drawer-close" aria-label="Close menu">
            <svg width="18" height="18" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
            </svg>
        </button>
    </div>

    {{-- User card inside drawer --}}
    <div class="mx-3 mt-3 mb-1 rounded-2xl p-3 flex items-center gap-3"
         style="background:rgba(255,255,255,.08)">
        <div class="w-10 h-10 rounded-full flex items-center justify-center text-white font-bold flex-shrink-0"
             style="background:linear-gradient(135deg,var(--primary),var(--accent))">
            {{ strtoupper(substr(auth()->user()->name ?? 'A', 0, 1)) }}
        </div>
        <div class="flex-1 min-w-0">
            <div class="text-sm font-semibold text-white truncate">{{ auth()->user()->name ?? 'Admin' }}</div>
            <div class="text-xs" style="color:rgba(255,255,255,.45)">Administrator</div>
        </div>
    </div>

    {{-- All nav links --}}
    <nav class="drawer-nav">
        @foreach($navGroups as $groupName => $items)
        <div class="drawer-group-label">{{ $groupName }}</div>
        @foreach($items as $item)
        <a href="{{ route($item['route']) }}"
           class="drawer-link {{ request()->routeIs($item['match']) ? 'active' : '' }}">
            <svg class="w-5 h-5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $item['icon'] }}"/>
            </svg>
            <span>{{ $item['label'] }}</span>
            @if(!empty($item['badge']) && $item['badge'])
            <span class="ml-auto badge badge-yellow">{{ $item['badge'] }}</span>
            @endif
        </a>
        @endforeach
        @endforeach
    </nav>

    {{-- Drawer footer actions --}}
    <div class="p-3 border-t flex gap-2" style="border-color:rgba(255,255,255,.08)">
        <a href="{{ route('home') }}" target="_blank"
           class="flex-1 flex items-center justify-center gap-2 py-2.5 rounded-xl text-xs font-semibold"
           style="background:rgba(255,255,255,.08);color:rgba(255,255,255,.7)">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14"/>
            </svg>
            View Site
        </a>
        <form action="{{ route('admin.logout') }}" method="POST" class="flex-1">
            @csrf
            <button type="submit" class="w-full flex items-center justify-center gap-2 py-2.5 rounded-xl text-xs font-semibold"
                    style="background:rgba(239,68,68,.15);color:#FCA5A5">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1"/>
                </svg>
                Logout
            </button>
        </form>
    </div>
</div>{{-- /mobile-drawer --}}


@stack('scripts')

{{-- External scripts --}}
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.datatables.net/2.1.8/js/dataTables.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.jsdelivr.net/npm/tinymce@7/tinymce.min.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function () {

    /* ── Move content into mobile shell (single DOM node, no duplication) ─── */
    var contentSrc  = document.getElementById('admin-page-content');
    var contentDest = document.getElementById('mobile-content-area');
    if (contentSrc && contentDest && window.innerWidth < 1024) {
        // Move the content node into mobile shell
        while (contentSrc.firstChild) {
            contentDest.appendChild(contentSrc.firstChild);
        }
        contentSrc.remove();
        document.dispatchEvent(new CustomEvent('admin:content-synced'));
    }

    /* Keep responsive duplicate content valid for labels and form controls. */
    var elementsById = {};
    document.querySelectorAll('[id]').forEach(function (element) {
        (elementsById[element.id] ||= []).push(element);
    });
    Object.keys(elementsById).forEach(function (id) {
        var elements = elementsById[id];
        if (elements.length < 2) return;

        var labels = Array.from(document.querySelectorAll('label[for="' + id + '"]'));
        elements.slice(1).forEach(function (element, index) {
            var replacementId = id + '-responsive-' + (index + 1);
            element.id = replacementId;
            if (labels[index + 1]) labels[index + 1].setAttribute('for', replacementId);
        });
    });

    /* Reuse the same page content in the active responsive shell. */
    var pageContent = document.getElementById('admin-page-content');
    var mobileContent = document.getElementById('mobile-content-area');
    var desktopContent = pageContent ? pageContent.parentElement : null;
    function syncAdminContent() {
        if (!pageContent || !mobileContent || !desktopContent) return;
        if (window.innerWidth < 1024) {
            mobileContent.appendChild(pageContent);
        } else {
            desktopContent.appendChild(pageContent);
        }
        document.dispatchEvent(new CustomEvent('admin:content-synced'));
    }
    syncAdminContent();
    window.addEventListener('resize', syncAdminContent);

    /* ── Drawer open / close ───────────────────── */
    var drawer  = document.getElementById('mobile-drawer');
    var overlay = document.getElementById('drawer-overlay');
    var openBtn = document.getElementById('mob-drawer-open');
    var closeBtn = document.getElementById('mob-drawer-close');

    function openDrawer() {
        drawer.classList.add('open');
        overlay.classList.add('open');
        document.body.style.overflow = 'hidden';
    }
    function closeDrawer() {
        drawer.classList.remove('open');
        overlay.classList.remove('open');
        document.body.style.overflow = '';
    }

    if (openBtn)  openBtn.addEventListener('click', openDrawer);
    if (closeBtn) closeBtn.addEventListener('click', closeDrawer);
    if (overlay)  overlay.addEventListener('click', closeDrawer);

    /* ── Swipe-right to close drawer ──────────── */
    var touchStartX = 0;
    if (drawer) {
        drawer.addEventListener('touchstart', function (e) {
            touchStartX = e.touches[0].clientX;
        }, { passive: true });
        drawer.addEventListener('touchend', function (e) {
            var dx = e.changedTouches[0].clientX - touchStartX;
            if (dx < -50) closeDrawer();
        }, { passive: true });
    }

    /* ── Swipe-right on edge to open drawer ───── */
    document.addEventListener('touchstart', function (e) {
        if (e.touches[0].clientX < 24) touchStartX = e.touches[0].clientX;
        else touchStartX = -1;
    }, { passive: true });
    document.addEventListener('touchend', function (e) {
        if (touchStartX >= 0) {
            var dx = e.changedTouches[0].clientX - touchStartX;
            if (dx > 60 && !drawer.classList.contains('open')) openDrawer();
        }
    }, { passive: true });

    /* ── Auto-dismiss mobile toast ─────────────── */
    var toast = document.getElementById('mob-toast');
    if (toast) {
        setTimeout(function () {
            toast.style.transition = 'opacity .4s';
            toast.style.opacity = '0';
            setTimeout(function () { toast.remove(); }, 400);
        }, 4000);
    }

    /* ── DataTables (desktop only) ─────────────── */
    var isMobile = window.innerWidth < 1024;
    if (!isMobile && window.jQuery && $.fn.dataTable) {
        $('.admin-table:not([data-no-datatable]):not([data-server-side])').filter(function () {
            return this.getClientRects().length > 0 && !$.fn.dataTable.isDataTable(this);
        }).DataTable({
            paging: true, searching: true, ordering: true,
            pageLength: 10, lengthMenu: [5, 10, 20, 50],
            language: {
                search: 'Search:', lengthMenu: 'Show _MENU_ entries',
                info: 'Showing _START_ to _END_ of _TOTAL_ entries',
                paginate: { previous: 'Prev', next: 'Next' }
            }
        });
    }

    /* Add data-label to table cells for mobile card view */
    document.querySelectorAll('.admin-table').forEach(function (table) {
        var headers = Array.from(table.querySelectorAll('th')).map(function (th) {
            return th.textContent.trim();
        });
        table.querySelectorAll('tbody tr').forEach(function (row) {
            row.querySelectorAll('td').forEach(function (td, i) {
                if (headers[i]) td.setAttribute('data-label', headers[i]);
            });
        });
    });

    /* ── SweetAlert delete confirm ─────────────── */
    document.addEventListener('submit', function (event) {
        var form = event.target.closest('.delete-form');
        if (!form || form.dataset.confirming === 'true') return;
        event.preventDefault();
        Swal.fire({
            title: 'Delete this item?',
            text: form.dataset.deleteMessage || 'This action cannot be undone.',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#991B1B',
            cancelButtonColor: '#6B7280',
            confirmButtonText: 'Yes, delete it',
            cancelButtonText: 'Cancel'
        }).then(function (result) {
            if (result.isConfirmed) {
                form.dataset.confirming = 'true';
                form.submit();
            }
        });
    });

    /* ── Drag-and-drop file upload ──────────────── */
    document.querySelectorAll('.dropzone-wrap').forEach(function (wrap) {
        var input    = wrap.querySelector('input[type="file"]');
        var fileList = wrap.querySelector('.dropzone-files');
        if (!input || !fileList) return;

        var updateFiles = function (files) {
            var labels = Array.from(files).map(function (f) { return f.name; });
            fileList.innerHTML = labels.length
                ? labels.map(function (n) { return '<span>' + n + '</span>'; }).join('')
                : '<span>No file chosen</span>';
        };
        input.addEventListener('change', function (e) { updateFiles(e.target.files || []); });
        ['dragenter','dragover'].forEach(function (ev) {
            wrap.addEventListener(ev, function (e) { e.preventDefault(); wrap.classList.add('dragover'); });
        });
        ['dragleave','drop'].forEach(function (ev) {
            wrap.addEventListener(ev, function (e) { e.preventDefault(); wrap.classList.remove('dragover'); });
        });
        wrap.addEventListener('drop', function (e) {
            e.preventDefault();
            if (e.dataTransfer && e.dataTransfer.files) {
                input.files = e.dataTransfer.files;
                updateFiles(e.dataTransfer.files);
            }
        });
    });

    /* ── TinyMCE rich editor ─────────────────────── */
    if (window.tinymce) {
        tinymce.init({
            selector: '.rich-editor', height: 320, menubar: false,
            plugins: 'advlist autolink lists link image code preview',
            toolbar: 'undo redo | bold italic underline | alignleft aligncenter alignright | bullist numlist | link image | code preview',
            content_style: 'body{font-family:Inter,sans-serif;color:#1A2B29;}',
            images_upload_handler: function (blobInfo) {
                return new Promise(function (resolve) {
                    var reader = new FileReader();
                    reader.onload = function () { resolve(reader.result); };
                    reader.readAsDataURL(blobInfo.blob());
                });
            }
        });
    }

    /* ── Active ripple on bottom tabs ───────────── */
    document.querySelectorAll('.bottom-tab').forEach(function (tab) {
        tab.addEventListener('click', function () {
            tab.style.transform = 'scale(.92)';
            setTimeout(function () { tab.style.transform = ''; }, 150);
        });
    });

});
</script>
</body>
</html>
