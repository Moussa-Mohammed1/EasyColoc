<aside
    class="fixed hidden inset-y-0 left-0 z-50 w-64 bg-white border-r border-slate-200 transform transition-transform duration-300 ease-in-out lg:translate-x-0 shadow-sm md:flex flex-col">
    <!-- Logo Area -->
    <div class="flex items-center gap-3 p-6 border-b border-slate-100">
        <div class="bg-primary/10 text-primary p-2 rounded-lg">
            <span class="material-symbols-outlined text-3xl">real_estate_agent</span>
        </div>
        <div class="flex flex-col">
            <h1 class="text-slate-900 text-lg font-bold leading-tight">EasyColoc</h1>
            <p class="text-secondary text-xs font-medium">Gestionnaire de Colocation</p>
        </div>
    </div>
    <!-- Navigation -->
    <nav class="flex-1 overflow-y-auto py-4 px-3 space-y-1">
        <a class="flex items-center gap-3 px-3 py-2.5 rounded-lg bg-primary/10 text-primary font-medium group transition-colors"
            href="#">
            <span class="material-symbols-outlined filled">dashboard</span>
            Tableau de bord
        </a>
        <a class="flex items-center gap-3 hover:bg-slate-50 hover:text-slate-900  px-3 py-2.5 rounded-lg text-primary font-medium group transition-colors"
            href="#">
            <span class="material-symbols-outlined filled">house</span>
            Colocations
        </a>
        

        @if (auth()->user()->isAdmin)
            <!-- Admin Section -->
            <div class="px-3 pt-4 pb-2">
                <p class="text-xs font-semibold text-slate-400 uppercase tracking-wider">Administration</p>
            </div>
            <a class="flex items-center gap-3 px-3 py-2.5 rounded-lg text-slate-600 hover:bg-slate-50 hover:text-slate-900 font-medium transition-colors"
                href="#">
                <span class="material-symbols-outlined">settings</span>
                Admin
            </a>
        @endif

    </nav>
    <!-- User Profile Snippet in Sidebar Bottom -->
    <div class="p-4 border-t border-slate-100">
        <div class="flex items-center gap-3">
            <div class="h-10 w-10 rounded-full bg-slate-200 bg-cover bg-center" data-alt="User Avatar"
                style="background-image: url('https://i.pinimg.com/1200x/1e/c6/4e/1ec64e2e926f1ab6c553963b86578886.jpg');">
            </div>
            <div>
                <p class="text-sm font-bold text-slate-900">{{ auth()->user()->name }}</p>
                <div class="flex items-center gap-1 font-bold text-xs text-success font-medium">
                    <span class="material-symbols-outlined text-[14px]"></span>
                    <span>{{ auth()->user()->reputation_score }} + </span>
                </div>
            </div>
        </div>
    </div>
</aside>