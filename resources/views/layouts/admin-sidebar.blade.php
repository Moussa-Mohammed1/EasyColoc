<aside class="w-64 border-r border-slate-200 dark:border-slate-800 bg-white dark:bg-slate-900 flex flex-col shrink-0">
    <div class="p-6 flex items-center gap-3">
        <div>
            <h1 class="text-lg font-bold leading-none">EasyColoc</h1>
            <p class="text-xs text-slate-500 dark:text-slate-400">Global Admin</p>
        </div>
    </div>
    <nav class="flex-1 px-4 py-4 space-y-1">
        <a 
            class="flex items-center gap-3 px-3 py-2 rounded-lg {{ request()->is('dashboard') ? 'bg-primary/10 text-primary font-semibold' : 'text-slate-600 dark:text-slate-400 hover:bg-slate-100 dark:hover:bg-slate-800 transition-colors' }}" 
            href="/dashboard">
            <span class="material-symbols-outlined text-lg">dashboard</span>
            <span class="text-sm">Tableau de bord utilisateur</span>
        </a>
        <a 
            href="/admin/dashboard"
            class="flex items-center gap-3 px-3 py-2 rounded-lg {{ request()->is('admin/dashboard') ? 'bg-primary/10 text-primary font-semibold' : 'text-slate-600 dark:text-slate-400 hover:bg-slate-100 dark:hover:bg-slate-800 transition-colors' }}">
            <span class="material-symbols-outlined text-lg">admin_panel_settings</span>
            <span class="text-sm">Dashboard Admin</span>
        </a>
        <a 
            class="flex items-center gap-3 px-3 py-2 rounded-lg {{ request()->is('admin/users*') ? 'bg-primary/10 text-primary font-semibold' : 'text-slate-600 dark:text-slate-400 hover:bg-slate-100 dark:hover:bg-slate-800 transition-colors' }}"
            href="/admin/users">
            <span class="material-symbols-outlined text-lg">group</span>
            <span class="text-sm">Utilisateurs</span>
        </a>
        <a 
            class="flex items-center gap-3 px-3 py-2 rounded-lg {{ request()->is('admin/colocations*') ? 'bg-primary/10 text-primary font-semibold' : 'text-slate-600 dark:text-slate-400 hover:bg-slate-100 dark:hover:bg-slate-800 transition-colors' }}"
            href="/admin/colocations">
            <span class="material-symbols-outlined text-lg">location_city</span>
            <span class="text-sm">Colocations</span>
        </a>
    </nav>
    
</aside>