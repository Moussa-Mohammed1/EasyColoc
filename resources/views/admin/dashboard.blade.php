<!DOCTYPE html>

<html class="dark" lang="en">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>EasyColoc Global Admin Dashboard</title>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;700;800&amp;display=swap"
        rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans:wght@400;500;700;900&amp;display=swap"
        rel="stylesheet" />
    <link
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap"
        rel="stylesheet" />
    <link
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap"
        rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <script>
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        "primary": "#2b8cee",
                        "background-light": "#f6f7f8",
                        "background-dark": "#101922",
                        "surface-dark": "#16212b",
                        "surface-light": "#ffffff",
                    },
                    fontFamily: {
                        "display": ["Manrope", "sans-serif"],
                        "body": ["Noto Sans", "sans-serif"],
                    },
                    borderRadius: { "DEFAULT": "0.25rem", "lg": "0.5rem", "xl": "0.75rem", "full": "9999px" },
                },
            },
        }
    </script>
</head>

<body
    class="bg-background-light dark:bg-background-dark text-slate-900 dark:text-slate-100 font-display antialiased overflow-x-hidden">
    <div class="flex h-screen w-full overflow-hidden bg-background-light dark:bg-background-dark">
        <!-- Sidebar -->
        <div
            class="hidden md:flex fixed w-72 flex-col border-r border-slate-200 dark:border-slate-800 bg-surface-light dark:bg-[#111a22]">
            <div class="flex flex-col gap-4 p-4">
                <div class="flex gap-3 items-center">
                    <div class="bg-center bg-no-repeat bg-cover rounded-full size-12"
                        data-alt="Admin user profile picture"
                        style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuDbG4zwhvMKwak3mzUSaPuONVg_7d-gZQbgIV1qaaY2hrDkxwMrdszzFDjZJW0sV5SZ4n4wKzeC5BRy3ewaU9EPHjW09ysqh04paxNrQJeta9oGl8DvI-Hh5l1I-C88XWAkrGMfO0lbFPxWJFWJX8mWMtghd3N8quLIlj88530La6jrW8hndLwBDHp-8kebdrwNLskxK4WzlQrivNirtcV0pzOn0CuMCkEeUhHwm16pwLMmTSOrOEdpJRxmZu8ZN2WzviOxU0uu3w8P");'>
                    </div>
                    <div class="flex flex-col">
                        <h1 class="text-slate-900 dark:text-white text-base font-bold leading-normal">Global Admin</h1>
                        <p class="text-slate-500 dark:text-[#92adc9] text-xs font-normal leading-normal">EasyColoc
                            Manager</p>
                    </div>
                </div>
                <div class="flex flex-col gap-1 mt-4">
                    <a class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-slate-500 dark:text-slate-400 hover:bg-slate-100 dark:hover:bg-slate-800 transition-colors"
                        href="#">
                        <span class="material-symbols-outlined text-[24px]">grid_view</span>
                        <p class="text-sm font-medium leading-normal">Dashboard</p>
                    </a>
                    <a class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-slate-500 dark:text-slate-400 hover:bg-slate-100 dark:hover:bg-slate-800 transition-colors"
                        href="#">
                        <span class="material-symbols-outlined text-[24px]">group</span>
                        <p class="text-sm font-medium leading-normal">My Coloc</p>
                    </a>
                    <a class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-slate-500 dark:text-slate-400 hover:bg-slate-100 dark:hover:bg-slate-800 transition-colors"
                        href="#">
                        <span class="material-symbols-outlined text-[24px]">payments</span>
                        <p class="text-sm font-medium leading-normal">Expenses</p>
                    </a>
                    <a class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-slate-500 dark:text-slate-400 hover:bg-slate-100 dark:hover:bg-slate-800 transition-colors"
                        href="#">
                        <span class="material-symbols-outlined text-[24px]">settings</span>
                        <p class="text-sm font-medium leading-normal">Settings</p>
                    </a>
                </div>
                <div class="my-2 h-px bg-slate-200 dark:bg-slate-800 w-full"></div>
                <div class="flex flex-col gap-1">
                    <p class="px-3 text-xs font-bold text-slate-400 dark:text-slate-500 uppercase tracking-wider mb-2">
                        Administration</p>
                    <a class="flex items-center gap-3 px-3 py-2.5 rounded-lg bg-primary/10 text-primary dark:text-primary"
                        href="#">
                        <span class="material-symbols-outlined text-[24px] fill-1">verified_user</span>
                        <p class="text-sm font-bold leading-normal">Admin Panel</p>
                    </a>
                    <a class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-slate-500 dark:text-slate-400 hover:bg-slate-100 dark:hover:bg-slate-800 transition-colors"
                        href="#">
                        <span class="material-symbols-outlined text-[24px]">bug_report</span>
                        <p class="text-sm font-medium leading-normal">System Logs</p>
                    </a>
                </div>
            </div>
        </div>
        <!-- Main Content -->
        <div class="flex-1 flex flex-col h-full overflow-hidden relative">
            <!-- Header -->
            <header
                class="h-16 flex items-center justify-between px-6 border-b border-slate-200 dark:border-slate-800 bg-surface-light dark:bg-[#111a22]">
                <div class="flex items-center gap-4">
                    <button class="md:hidden text-slate-500 dark:text-slate-400">
                        <span class="material-symbols-outlined">menu</span>
                    </button>
                    <h2 class="text-lg font-bold text-slate-900 dark:text-white">Admin Dashboard</h2>
                </div>
                <div class="flex items-center gap-4">
                    <button
                        class="relative p-2 text-slate-500 dark:text-slate-400 hover:bg-slate-100 dark:hover:bg-slate-800 rounded-full transition-colors">
                        <span class="material-symbols-outlined">notifications</span>
                        <span
                            class="absolute top-1.5 right-1.5 size-2.5 bg-red-500 rounded-full border-2 border-white dark:border-[#111a22]"></span>
                    </button>
                    <div class="h-8 w-px bg-slate-200 dark:bg-slate-700 mx-1"></div>
                    <button
                        class="flex items-center gap-2 text-sm font-medium text-slate-700 dark:text-slate-300 hover:text-primary transition-colors">
                        <span>Log Out</span>
                        <span class="material-symbols-outlined text-[20px]">logout</span>
                    </button>
                </div>
            </header>
            <!-- Scrollable Content -->
            <main class="flex-1 overflow-y-auto p-4 md:p-8 scrollbar-hide">
                <div class="max-w-7xl mx-auto flex flex-col gap-8">
                    <!-- Intro Section -->
                    <div class="flex flex-col gap-2">
                        <h1 class="text-3xl font-bold tracking-tight text-slate-900 dark:text-white">Overview</h1>
                        <p class="text-slate-500 dark:text-slate-400">Welcome back, Admin. Here is the latest system
                            performance summary.</p>
                    </div>
                    <!-- Stats Cards -->
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                        <!-- Stat 1 -->
                        <div
                            class="bg-surface-light dark:bg-surface-dark p-6 rounded-xl border border-slate-200 dark:border-slate-800 flex flex-col gap-4 shadow-sm">
                            <div class="flex items-start justify-between">
                                <div
                                    class="p-2 bg-blue-100 dark:bg-blue-900/30 text-blue-600 dark:text-blue-400 rounded-lg">
                                    <span class="material-symbols-outlined">group</span>
                                </div>
                                <span
                                    class="flex items-center gap-1 text-xs font-medium text-emerald-500 bg-emerald-100 dark:bg-emerald-900/20 px-2 py-1 rounded-full">
                                    <span class="material-symbols-outlined text-[14px]">trending_up</span>
                                    12%
                                </span>
                            </div>
                            <div>
                                <p class="text-slate-500 dark:text-slate-400 text-sm font-medium">Total Users</p>
                                <h3 class="text-2xl font-bold text-slate-900 dark:text-white mt-1">12,450</h3>
                            </div>
                        </div>
                        <!-- Stat 2 -->
                        <div
                            class="bg-surface-light dark:bg-surface-dark p-6 rounded-xl border border-slate-200 dark:border-slate-800 flex flex-col gap-4 shadow-sm">
                            <div class="flex items-start justify-between">
                                <div
                                    class="p-2 bg-indigo-100 dark:bg-indigo-900/30 text-indigo-600 dark:text-indigo-400 rounded-lg">
                                    <span class="material-symbols-outlined">home_work</span>
                                </div>
                                <span
                                    class="flex items-center gap-1 text-xs font-medium text-emerald-500 bg-emerald-100 dark:bg-emerald-900/20 px-2 py-1 rounded-full">
                                    <span class="material-symbols-outlined text-[14px]">trending_up</span>
                                    5%
                                </span>
                            </div>
                            <div>
                                <p class="text-slate-500 dark:text-slate-400 text-sm font-medium">Active Colocations</p>
                                <h3 class="text-2xl font-bold text-slate-900 dark:text-white mt-1">3,200</h3>
                            </div>
                        </div>
                        <!-- Stat 3 -->
                        <div
                            class="bg-surface-light dark:bg-surface-dark p-6 rounded-xl border border-slate-200 dark:border-slate-800 flex flex-col gap-4 shadow-sm">
                            <div class="flex items-start justify-between">
                                <div
                                    class="p-2 bg-emerald-100 dark:bg-emerald-900/30 text-emerald-600 dark:text-emerald-400 rounded-lg">
                                    <span class="material-symbols-outlined">attach_money</span>
                                </div>
                                <span
                                    class="flex items-center gap-1 text-xs font-medium text-emerald-500 bg-emerald-100 dark:bg-emerald-900/20 px-2 py-1 rounded-full">
                                    <span class="material-symbols-outlined text-[14px]">trending_up</span>
                                    18%
                                </span>
                            </div>
                            <div>
                                <p class="text-slate-500 dark:text-slate-400 text-sm font-medium">Expenses Processed</p>
                                <h3 class="text-2xl font-bold text-slate-900 dark:text-white mt-1">$4.5M</h3>
                            </div>
                        </div>
                        <!-- Stat 4 -->
                        <div
                            class="bg-surface-light dark:bg-surface-dark p-6 rounded-xl border border-slate-200 dark:border-slate-800 flex flex-col gap-4 shadow-sm">
                            <div class="flex items-start justify-between">
                                <div
                                    class="p-2 bg-rose-100 dark:bg-rose-900/30 text-rose-600 dark:text-rose-400 rounded-lg">
                                    <span class="material-symbols-outlined">block</span>
                                </div>
                                <span
                                    class="flex items-center gap-1 text-xs font-medium text-rose-500 bg-rose-100 dark:bg-rose-900/20 px-2 py-1 rounded-full">
                                    <span class="material-symbols-outlined text-[14px]">trending_down</span>
                                    2%
                                </span>
                            </div>
                            <div>
                                <p class="text-slate-500 dark:text-slate-400 text-sm font-medium">Banned Users</p>
                                <h3 class="text-2xl font-bold text-slate-900 dark:text-white mt-1">15</h3>
                            </div>
                        </div>
                    </div>
                    <!-- Chart Section -->
                    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                        <div
                            class="lg:col-span-2 bg-surface-light dark:bg-surface-dark rounded-xl border border-slate-200 dark:border-slate-800 p-6 shadow-sm">
                            <div class="flex items-center justify-between mb-6">
                                <div>
                                    <h3 class="text-lg font-bold text-slate-900 dark:text-white">Global Expense Activity
                                    </h3>
                                    <p class="text-sm text-slate-500 dark:text-slate-400">Trends over the last 6 months
                                    </p>
                                </div>
                                <div class="flex items-center gap-2">
                                    <span class="size-3 rounded-full bg-primary"></span>
                                    <span class="text-sm font-medium text-slate-600 dark:text-slate-300">Volume</span>
                                </div>
                            </div>
                            <!-- Graph SVG (Reused & Styled from prompt) -->
                            <div class="w-full h-64 relative">
                                <svg class="overflow-visible" fill="none" height="100%" preserveaspectratio="none"
                                    viewbox="0 0 478 150" width="100%" xmlns="http://www.w3.org/2000/svg">
                                    <!-- Gradient Defs -->
                                    <defs>
                                        <lineargradient gradientunits="userSpaceOnUse" id="paint0_linear" x1="236"
                                            x2="236" y1="1" y2="149">
                                            <stop stop-color="#2b8cee" stop-opacity="0.3"></stop>
                                            <stop offset="1" stop-color="#2b8cee" stop-opacity="0"></stop>
                                        </lineargradient>
                                    </defs>
                                    <!-- Grid Lines -->
                                    <line stroke="#334155" stroke-dasharray="4 4" stroke-opacity="0.2" x1="0" x2="478"
                                        y1="149" y2="149"></line>
                                    <line stroke="#334155" stroke-dasharray="4 4" stroke-opacity="0.2" x1="0" x2="478"
                                        y1="100" y2="100"></line>
                                    <line stroke="#334155" stroke-dasharray="4 4" stroke-opacity="0.2" x1="0" x2="478"
                                        y1="50" y2="50"></line>
                                    <!-- Area Path -->
                                    <path
                                        d="M0 109C18.1538 109 18.1538 21 36.3077 21C54.4615 21 54.4615 41 72.6154 41C90.7692 41 90.7692 93 108.923 93C127.077 93 127.077 33 145.231 33C163.385 33 163.385 101 181.538 101C199.692 101 199.692 61 217.846 61C236 61 236 45 254.154 45C272.308 45 272.308 121 290.462 121C308.615 121 308.615 149 326.769 149C344.923 149 344.923 1 363.077 1C381.231 1 381.231 81 399.385 81C417.538 81 417.538 129 435.692 129C453.846 129 453.846 25 472 25V149H0V109Z"
                                        fill="url(#paint0_linear)"></path>
                                    <!-- Stroke Path -->
                                    <path
                                        d="M0 109C18.1538 109 18.1538 21 36.3077 21C54.4615 21 54.4615 41 72.6154 41C90.7692 41 90.7692 93 108.923 93C127.077 93 127.077 33 145.231 33C163.385 33 163.385 101 181.538 101C199.692 101 199.692 61 217.846 61C236 61 236 45 254.154 45C272.308 45 272.308 121 290.462 121C308.615 121 308.615 149 326.769 149C344.923 149 344.923 1 363.077 1C381.231 1 381.231 81 399.385 81C417.538 81 417.538 129 435.692 129C453.846 129 453.846 25 472 25"
                                        stroke="#2b8cee" stroke-linecap="round" stroke-width="3"></path>
                                </svg>
                            </div>
                            <div class="flex justify-between mt-4 px-2">
                                <p class="text-slate-400 text-xs font-bold uppercase tracking-wider">Jan</p>
                                <p class="text-slate-400 text-xs font-bold uppercase tracking-wider">Feb</p>
                                <p class="text-slate-400 text-xs font-bold uppercase tracking-wider">Mar</p>
                                <p class="text-slate-400 text-xs font-bold uppercase tracking-wider">Apr</p>
                                <p class="text-slate-400 text-xs font-bold uppercase tracking-wider">May</p>
                                <p class="text-slate-400 text-xs font-bold uppercase tracking-wider">Jun</p>
                            </div>
                        </div>
                        <!-- Colocation Overview List -->
                        <div
                            class="bg-surface-light dark:bg-surface-dark rounded-xl border border-slate-200 dark:border-slate-800 p-6 shadow-sm flex flex-col h-full">
                            <h3 class="text-lg font-bold text-slate-900 dark:text-white mb-4">Top Colocations</h3>
                            <div class="flex flex-col gap-4 flex-1 overflow-y-auto pr-2">
                                <!-- Item 1 -->
                                <div
                                    class="flex items-center gap-3 p-3 rounded-lg hover:bg-slate-50 dark:hover:bg-slate-800/50 transition-colors">
                                    <div class="size-10 rounded-lg bg-cover bg-center shrink-0"
                                        data-alt="Apartment building exterior"
                                        style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuBn3lVX5ka4uLibUMeP1xjb9erCty4KSyyYLcSdV2D0s9maAUhRxvwMphQnx-HXOLZN66MhxRCXbeNyo74QKh-NFhiJqZHABsRrmh3JlmfoET68mZV-OTkpBsdnN3-asrjiRgSyhOwIkocK6cClKuwe8WzOEgxurzrPY0eFO4ztof_Tu-QQrvIPFzFzLHVsOHDrYST9NOiphHMS66g3HA6mMSzMz5NLzPVniq3vNPcAGBcO98jRuycGgFE3QQ7sFgNer6_xlXHmnf8o");'>
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <p class="text-sm font-bold text-slate-900 dark:text-white truncate">Sunset
                                            Boulevard Apt</p>
                                        <p class="text-xs text-slate-500 dark:text-slate-400">4 Members • Active</p>
                                    </div>
                                    <div class="text-right">
                                        <p class="text-sm font-bold text-primary">$12.4k</p>
                                        <p class="text-[10px] text-slate-500">/mo</p>
                                    </div>
                                </div>
                                <!-- Item 2 -->
                                <div
                                    class="flex items-center gap-3 p-3 rounded-lg hover:bg-slate-50 dark:hover:bg-slate-800/50 transition-colors">
                                    <div class="size-10 rounded-lg bg-cover bg-center shrink-0"
                                        data-alt="Modern house front"
                                        style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuB8M4q0b0edeRegmEoWj7HU1GqtkuOb5W4yNPw4EBHwxW8GsVMrbAnMUXEoVIoR4iT4DlzKd1HuowOC9xMCUD40u-wbZqxxY2_dvlmUi7Ikcy14z-aZyj7ScH2iYdt0w3UE8EgvZGYTrwFcFcWffw5Ly-J0d1IqM4H1z0-HAwrrX0zG8QvK3Wcm64UzexVKm7nLyi3tY3poP1jhS-tp4fnNKttzhDzV787emKF9pqYxiKFRbYHzJjTUpbYaDnEO5znN9I1sEafqq3eE");'>
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <p class="text-sm font-bold text-slate-900 dark:text-white truncate">The Loft
                                            Space</p>
                                        <p class="text-xs text-slate-500 dark:text-slate-400">6 Members • Active</p>
                                    </div>
                                    <div class="text-right">
                                        <p class="text-sm font-bold text-primary">$8.2k</p>
                                        <p class="text-[10px] text-slate-500">/mo</p>
                                    </div>
                                </div>
                                <!-- Item 3 -->
                                <div
                                    class="flex items-center gap-3 p-3 rounded-lg hover:bg-slate-50 dark:hover:bg-slate-800/50 transition-colors">
                                    <div class="size-10 rounded-lg bg-cover bg-center shrink-0"
                                        data-alt="University dorm room"
                                        style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuBg5sV3d9IHmS-1FIBUypFni0KlbND2fV8MabjePoTuAtMreJFo1DdBaiZZM_zkpGuL_h84j024UgF3IHmwlDbuHHtqpGQUQFv-WGAqKUwUaS8JI6jFmz_EY3R6WQQoaPwg1fZxRtZXbq-hQlKIezTtoni1XQhg6AKmTDboYhYIdrMSwmkkWsjKj_EKKaTzXBO_Lz6uhbviRq_IkOM8IyzNDR0IfW1MFy8FMkYBeLB2A_nn1Q_1Qw_T_6gMYdw7vXDenhaJ6Ufjh1Jo");'>
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <p class="text-sm font-bold text-slate-900 dark:text-white truncate">University
                                            Heights</p>
                                        <p class="text-xs text-slate-500 dark:text-slate-400">3 Members • Active</p>
                                    </div>
                                    <div class="text-right">
                                        <p class="text-sm font-bold text-primary">$4.1k</p>
                                        <p class="text-[10px] text-slate-500">/mo</p>
                                    </div>
                                </div>
                                <!-- Item 4 -->
                                <div
                                    class="flex items-center gap-3 p-3 rounded-lg hover:bg-slate-50 dark:hover:bg-slate-800/50 transition-colors opacity-60">
                                    <div class="size-10 rounded-lg bg-cover bg-center shrink-0 grayscale"
                                        data-alt="Old apartment building"
                                        style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuALwthXcYDKEECVo5UF85JGUDa6ZsQ6bKo4VhUejxkfHQLPQ0wo_RKIvyBTlDhkm4nniEhzJYHeys0Ie8ZQAkVCI3cPjxHbZvg2BEElcE0EZ-TZpKDJJhHPEN9k51g7bF94UrX1TGOc7iQAMKPaKfyWew6am2FDclN0bo8_JkaUwbU6RIf6pthPsduP_DvK-R0xjDzLqC6jiaQnSMJ4uCO7aiJ5122dWP08cQPkrnoxcDGV05jQUGMhP7RpkWGWfGuWAmVPcSdkFeik");'>
                                    </div>
                                    <div class="flex-1 min-w-0">
                                        <p class="text-sm font-bold text-slate-900 dark:text-white truncate">Riverside
                                            Condo</p>
                                        <p class="text-xs text-slate-500 dark:text-slate-400">2 Members • Cancelled</p>
                                    </div>
                                    <div class="text-right">
                                        <p class="text-sm font-bold text-slate-500">$0</p>
                                        <p class="text-[10px] text-slate-500">/mo</p>
                                    </div>
                                </div>
                            </div>
                            <button
                                class="mt-4 w-full py-2 text-sm text-primary font-medium hover:bg-primary/10 rounded-lg transition-colors">View
                                All Colocations</button>
                        </div>
                    </div>
                    <!-- User Management Table -->
                    <div
                        class="bg-surface-light dark:bg-surface-dark rounded-xl border border-slate-200 dark:border-slate-800 shadow-sm overflow-hidden">
                        <div
                            class="p-6 border-b border-slate-200 dark:border-slate-800 flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                            <div>
                                <h3 class="text-lg font-bold text-slate-900 dark:text-white">User Management</h3>
                                <p class="text-sm text-slate-500 dark:text-slate-400">Manage access and review user
                                    standings.</p>
                            </div>
                            <div class="relative">
                                <span
                                    class="material-symbols-outlined absolute left-3 top-2.5 text-slate-400 text-[20px]">search</span>
                                <input
                                    class="pl-10 pr-4 py-2 bg-slate-50 dark:bg-slate-900 border border-slate-300 dark:border-slate-700 rounded-lg text-sm text-slate-900 dark:text-white focus:outline-none focus:ring-2 focus:ring-primary/50 w-full sm:w-64 placeholder-slate-500"
                                    placeholder="Search users..." type="text" />
                            </div>
                        </div>
                        <div class="overflow-x-auto">
                            <table class="w-full text-left border-collapse">
                                <thead>
                                    <tr
                                        class="bg-slate-50 dark:bg-slate-800/50 border-b border-slate-200 dark:border-slate-800">
                                        <th
                                            class="py-4 px-6 text-xs font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wider">
                                            User</th>
                                        <th
                                            class="py-4 px-6 text-xs font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wider">
                                            Reputation</th>
                                        <th
                                            class="py-4 px-6 text-xs font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wider">
                                            Coloc Status</th>
                                        <th
                                            class="py-4 px-6 text-xs font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wider">
                                            Role</th>
                                        <th
                                            class="py-4 px-6 text-xs font-bold text-slate-500 dark:text-slate-400 uppercase tracking-wider text-right">
                                            Actions</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-slate-200 dark:divide-slate-800">
                                    <!-- Row 1 -->
                                    <tr class="hover:bg-slate-50 dark:hover:bg-slate-800/30 transition-colors">
                                        <td class="py-4 px-6">
                                            <div class="flex items-center gap-3">
                                                <div class="size-9 rounded-full bg-cover bg-center"
                                                    data-alt="User profile photo"
                                                    style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuDID3ON2aIq1OSqYIX2gJ8WDedpH4sqvSRdzHw34t3uGwiXlhszzgh9mXeeHHnMA8LvTdIbiEUwevxEGY70dXLrjdj7m6GKYMzXxDTzgfsVetMi9IZSk4wpKRTKmBW0J-cSkhyaMNeTYbnPKOaYY1G18LF3cMsmpy0CVAo9SgOqjrRUJnjKTTEoFEeTkLuaZTxWWQ7CnY0q-4NygTp4U3bvl7zNDONQ_7XvYpe3rDFw1AkIzaDRz0HBIRPsYYjrCpRMTw6NBEoySAsx");'>
                                                </div>
                                                <div class="flex flex-col">
                                                    <span
                                                        class="text-sm font-semibold text-slate-900 dark:text-white">Sarah
                                                        Jenkins</span>
                                                    <span
                                                        class="text-xs text-slate-500 dark:text-slate-400">sarah.j@example.com</span>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="py-4 px-6">
                                            <div class="flex items-center gap-1">
                                                <span
                                                    class="material-symbols-outlined text-amber-400 text-[18px] fill-1">star</span>
                                                <span
                                                    class="text-sm font-medium text-slate-700 dark:text-slate-200">4.9</span>
                                            </div>
                                        </td>
                                        <td class="py-4 px-6">
                                            <span
                                                class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-medium bg-emerald-100 text-emerald-700 dark:bg-emerald-900/30 dark:text-emerald-400 border border-emerald-200 dark:border-emerald-800">
                                                <span class="size-1.5 rounded-full bg-emerald-500"></span> Active
                                            </span>
                                        </td>
                                        <td class="py-4 px-6">
                                            <span class="text-sm text-slate-600 dark:text-slate-300">Tenant</span>
                                        </td>
                                        <td class="py-4 px-6 text-right">
                                            <button
                                                class="text-slate-400 hover:text-rose-500 dark:hover:text-rose-400 transition-colors"
                                                title="Ban User">
                                                <span class="material-symbols-outlined">block</span>
                                            </button>
                                        </td>
                                    </tr>
                                    <!-- Row 2 -->
                                    <tr class="hover:bg-slate-50 dark:hover:bg-slate-800/30 transition-colors">
                                        <td class="py-4 px-6">
                                            <div class="flex items-center gap-3">
                                                <div class="size-9 rounded-full bg-cover bg-center"
                                                    data-alt="User profile photo"
                                                    style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuDKwSybSdn4E6lUpLTWQMGahTLZJbZk8k_cx5yn_FvY1YdLWFd_UBTIogXi5RImUp4r4wfA2fAWccEkFnn-uN21-g4faYeg9JznOz7Qk_ScpagnEW9nG63zXLdMxeHLYpkOYpe9w6KAIncMv4bh29VdzHx959FkrygADv0SIyA3QUBXqgOWkaqYFD2gLTXwJcShQ3zXsncUNU2EhVQALV1KLuB__F8Bp19ncMQe-DcSiLJmAKfbis3b71GSUKpcfQMlcnwLVZOBDVxp");'>
                                                </div>
                                                <div class="flex flex-col">
                                                    <span
                                                        class="text-sm font-semibold text-slate-900 dark:text-white">Mike
                                                        Ross</span>
                                                    <span
                                                        class="text-xs text-slate-500 dark:text-slate-400">mike.ross@legal.com</span>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="py-4 px-6">
                                            <div class="flex items-center gap-1">
                                                <span
                                                    class="material-symbols-outlined text-amber-400 text-[18px] fill-1">star</span>
                                                <span
                                                    class="text-sm font-medium text-slate-700 dark:text-slate-200">3.2</span>
                                            </div>
                                        </td>
                                        <td class="py-4 px-6">
                                            <span
                                                class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-medium bg-slate-100 text-slate-600 dark:bg-slate-800 dark:text-slate-300 border border-slate-200 dark:border-slate-700">
                                                <span class="size-1.5 rounded-full bg-slate-400"></span> Inactive
                                            </span>
                                        </td>
                                        <td class="py-4 px-6">
                                            <span class="text-sm text-slate-600 dark:text-slate-300">Manager</span>
                                        </td>
                                        <td class="py-4 px-6 text-right">
                                            <button
                                                class="text-slate-400 hover:text-rose-500 dark:hover:text-rose-400 transition-colors"
                                                title="Ban User">
                                                <span class="material-symbols-outlined">block</span>
                                            </button>
                                        </td>
                                    </tr>
                                    <!-- Row 3 (Banned) -->
                                    <tr
                                        class="bg-rose-50/50 dark:bg-rose-900/10 hover:bg-rose-100/50 dark:hover:bg-rose-900/20 transition-colors">
                                        <td class="py-4 px-6">
                                            <div class="flex items-center gap-3">
                                                <div class="size-9 rounded-full bg-cover bg-center grayscale opacity-70"
                                                    data-alt="User profile photo"
                                                    style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuAagRzrxYSLQYLOwaSBvE7--C299G303qnAjLKIwc0UUgO3LcQYzOK9fO5WoRvDOlcBikljCvm4x-9Lx9g8ma9mEGNtphsXCIqRs2fEt3qYZlJYas5bPCLBKZGUFPgbZXX64hK4CqWVpliVCHDl3J8O_xOgwB4WTw3crL3sIIEQKiXRbirBPY6gHkHN04Y-yuGfGORhLpxiSgHgJKwPi-GNu0_ZryDh2vniDOvfZuIm2zqBBlwgFbI6U1e82BPCpg-4N_R3nBrLt5e3");'>
                                                </div>
                                                <div class="flex flex-col">
                                                    <span
                                                        class="text-sm font-semibold text-rose-700 dark:text-rose-300">Alex
                                                        DeLarge</span>
                                                    <span
                                                        class="text-xs text-rose-500/70 dark:text-rose-400/70">alex.d@baduser.net</span>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="py-4 px-6">
                                            <div class="flex items-center gap-1">
                                                <span
                                                    class="material-symbols-outlined text-slate-300 dark:text-slate-600 text-[18px] fill-1">star</span>
                                                <span
                                                    class="text-sm font-medium text-slate-500 dark:text-slate-400">1.1</span>
                                            </div>
                                        </td>
                                        <td class="py-4 px-6">
                                            <span
                                                class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-bold bg-rose-100 text-rose-700 dark:bg-rose-900/40 dark:text-rose-400 border border-rose-200 dark:border-rose-800">
                                                <span class="material-symbols-outlined text-[14px]">block</span> Banned
                                            </span>
                                        </td>
                                        <td class="py-4 px-6">
                                            <span class="text-sm text-rose-600/70 dark:text-rose-400/70">Tenant</span>
                                        </td>
                                        <td class="py-4 px-6 text-right">
                                            <button
                                                class="text-emerald-500 hover:text-emerald-600 dark:text-emerald-400 dark:hover:text-emerald-300 font-medium text-sm px-3 py-1 bg-emerald-100 dark:bg-emerald-900/30 rounded-md transition-colors"
                                                title="Unban User">
                                                Unban
                                            </button>
                                        </td>
                                    </tr>
                                    <!-- Row 4 -->
                                    <tr class="hover:bg-slate-50 dark:hover:bg-slate-800/30 transition-colors">
                                        <td class="py-4 px-6">
                                            <div class="flex items-center gap-3">
                                                <div class="size-9 rounded-full bg-cover bg-center"
                                                    data-alt="User profile photo"
                                                    style='background-image: url("https://lh3.googleusercontent.com/aida-public/AB6AXuCHk8ixJ6T1aMZA_g1tfVuSrwzEveISCGSX5c2hl-IIwfnyFPpE3Ta_JW6R3bDIwn-ZrFjfIp9piReAQI7XrFdjOAPoGopPW8KDX6_KFqa6QAzs_w00EMIkdLrCkDLEVxIcTaF3McyzOgGfrvqUaVYXaBnF4pRfNG8dZBUg8z8VSnBwNrsrVV_9ld_5275tv_3fNgz-OIQu2bXWVIHPyVXFB63dL7lbKCyze4akRcBDSe_68z9zuAS-Gn453-ya-39ymbqg2Ss7jMyf");'>
                                                </div>
                                                <div class="flex flex-col">
                                                    <span
                                                        class="text-sm font-semibold text-slate-900 dark:text-white">Jessica
                                                        Pearson</span>
                                                    <span
                                                        class="text-xs text-slate-500 dark:text-slate-400">jess.pearson@law.com</span>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="py-4 px-6">
                                            <div class="flex items-center gap-1">
                                                <span
                                                    class="material-symbols-outlined text-amber-400 text-[18px] fill-1">star</span>
                                                <span
                                                    class="text-sm font-medium text-slate-700 dark:text-slate-200">5.0</span>
                                            </div>
                                        </td>
                                        <td class="py-4 px-6">
                                            <span
                                                class="inline-flex items-center gap-1.5 px-2.5 py-1 rounded-full text-xs font-medium bg-emerald-100 text-emerald-700 dark:bg-emerald-900/30 dark:text-emerald-400 border border-emerald-200 dark:border-emerald-800">
                                                <span class="size-1.5 rounded-full bg-emerald-500"></span> Active
                                            </span>
                                        </td>
                                        <td class="py-4 px-6">
                                            <span class="text-sm text-slate-600 dark:text-slate-300">Manager</span>
                                        </td>
                                        <td class="py-4 px-6 text-right">
                                            <button
                                                class="text-slate-400 hover:text-rose-500 dark:hover:text-rose-400 transition-colors"
                                                title="Ban User">
                                                <span class="material-symbols-outlined">block</span>
                                            </button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div
                            class="p-4 border-t border-slate-200 dark:border-slate-800 flex justify-between items-center bg-slate-50 dark:bg-slate-800/20">
                            <p class="text-xs text-slate-500 dark:text-slate-400">Showing 4 of 12,450 users</p>
                            <div class="flex gap-2">
                                <button
                                    class="px-3 py-1 text-xs font-medium rounded border border-slate-300 dark:border-slate-700 text-slate-600 dark:text-slate-300 hover:bg-white dark:hover:bg-slate-700 disabled:opacity-50"
                                    disabled="">Previous</button>
                                <button
                                    class="px-3 py-1 text-xs font-medium rounded border border-slate-300 dark:border-slate-700 text-slate-600 dark:text-slate-300 hover:bg-white dark:hover:bg-slate-700">Next</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="h-20"></div>
            </main>
        </div>
    </div>
</body>

</html>