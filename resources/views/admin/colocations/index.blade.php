<!DOCTYPE html>

<html class="light" lang="fr">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>EasyColoc - Gestion des Colocations</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@300;400;500;600;700;800&amp;display=swap"
        rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght@100..700,0..1&amp;display=swap"
        rel="stylesheet" />
    <link
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap"
        rel="stylesheet" />
    <script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        "primary": "#2b8cee",
                        "background-light": "#f6f7f8",
                        "background-dark": "#101922",
                    },
                    fontFamily: {
                        "display": ["Manrope", "sans-serif"]
                    },
                    borderRadius: { "DEFAULT": "0.25rem", "lg": "0.5rem", "xl": "0.75rem", "full": "9999px" },
                },
            },
        }
    </script>
    <style>
        body {
            font-family: 'Manrope', sans-serif;
        }
    </style>
</head>

<body class="bg-background-light dark:bg-background-dark text-slate-900 dark:text-slate-100 min-h-screen">
    <div class="flex h-screen overflow-hidden">
        <!-- Sidebar Navigation -->
        @include('layouts.admin-sidebar')
        <!-- Main Content Area -->
        <main class="flex-1 flex flex-col overflow-hidden">
            <!-- Header -->
            <header
                class="h-16 flex items-center justify-between px-8 bg-white dark:bg-slate-900 border-b border-slate-200 dark:border-slate-800 shrink-0">
                <div class="flex items-center gap-2 text-sm text-slate-500">
                    <span>Admin</span>
                    <span class="material-symbols-outlined text-xs">chevron_right</span>
                    <span class="text-slate-900 dark:text-slate-100 font-medium">Colocations</span>
                </div>
                
            </header>
            <!-- Content -->
            <div class="flex-1 overflow-y-auto p-8">
                <div class="max-w-7xl mx-auto space-y-6">
                    <!-- Title Section -->
                    <div class="flex flex-col md:flex-row md:items-end justify-between gap-4">
                        <div>
                            <h2 class="text-3xl font-extrabold text-slate-900 dark:text-white tracking-tight">Gestion
                                des colocations</h2>
                            <p class="text-slate-500 dark:text-slate-400 mt-1">Consultez et gérez l'ensemble des
                                colocations de la plateforme.</p>
                        </div>
                    </div>
                    
                    <!-- Table Container -->
                    <div
                        class="bg-white dark:bg-slate-900 rounded-xl border border-slate-200 dark:border-slate-800 shadow-sm overflow-hidden">
                        <div class="overflow-x-auto">
                            <table class="w-full text-left border-collapse">
                                <thead>
                                    <tr
                                        class="bg-slate-50 dark:bg-slate-800/50 border-b border-slate-200 dark:border-slate-700">
                                        <th class="px-6 py-4 text-xs font-bold text-slate-500 uppercase tracking-wider">
                                            Nom</th>
                                        <th class="px-6 py-4 text-xs font-bold text-slate-500 uppercase tracking-wider">
                                            Propriétaire</th>
                                        <th class="px-6 py-4 text-xs font-bold text-slate-500 uppercase tracking-wider">
                                            Membres</th>
                                        <th
                                            class="px-6 py-4 text-xs font-bold text-slate-500 uppercase tracking-wider text-right">
                                            Dépenses totales</th>
                                        <th class="px-6 py-4 text-xs font-bold text-slate-500 uppercase tracking-wider">
                                            Date de création</th>
                                        <th class="px-6 py-4 text-xs font-bold text-slate-500 uppercase tracking-wider">
                                            Statut</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-slate-100 dark:divide-slate-800">
                                    @forelse($colocations as $colocation)
                                    <tr class="hover:bg-slate-50/50 dark:hover:bg-slate-800/30 transition-colors">
                                        <td class="px-6 py-4">
                                            <div class="font-semibold text-slate-900 dark:text-white">{{ $colocation->name }}</div>
                                            @if($colocation->description)
                                            <div class="text-xs text-slate-400">{{ Str::limit($colocation->description, 50) }}</div>
                                            @endif
                                        </td>
                                        <td class="px-6 py-4">
                                            <div class="flex items-center gap-2">
                                                @if($colocation->user)
                                                <div class="size-6 rounded-full bg-slate-200 dark:bg-slate-700 flex items-center justify-center text-[10px]"
                                                    data-alt="Avatar icon for {{ $colocation->user->name }}">
                                                    {{ strtoupper(substr($colocation->user->name, 0, 1)) }}{{ strtoupper(substr(explode(' ', $colocation->user->name)[1] ?? $colocation->user->name, 0, 1)) }}
                                                </div>
                                                <span class="text-sm font-medium">{{ $colocation->user->name }}</span>
                                                @else
                                                <span class="text-sm text-slate-400">Non assigné</span>
                                                @endif
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 text-sm text-slate-600 dark:text-slate-400">
                                            {{ $colocation->members_count }} {{ Str::plural('membre', $colocation->members_count) }}
                                        </td>
                                        <td class="px-6 py-4 text-sm font-semibold text-right text-slate-900 dark:text-white">
                                            {{ number_format($colocation->expenses->sum('amount'), 2, ',', ' ') }} €
                                        </td>
                                        <td class="px-6 py-4 text-sm text-slate-600 dark:text-slate-400">
                                            {{ $colocation->created_at->format('d/m/Y') }}
                                        </td>
                                        <td class="px-6 py-4">
                                            @if($colocation->status === 'active')
                                            <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-bold bg-green-100 text-green-700 dark:bg-green-900/30 dark:text-green-400">
                                                Active
                                            </span>
                                            @else
                                            <span class="inline-flex items-center px-2.5 py-1 rounded-full text-xs font-bold bg-red-100 text-red-700 dark:bg-red-900/30 dark:text-red-400">
                                                {{ ucfirst($colocation->status) }}
                                            </span>
                                            @endif
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="7" class="px-6 py-12 text-center">
                                            <div class="flex flex-col items-center justify-center gap-2">
                                                <span class="material-symbols-outlined text-5xl text-slate-300 dark:text-slate-700">home_work</span>
                                                <p class="text-slate-500 dark:text-slate-400">Aucune colocation trouvée</p>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        <!-- Pagination -->
                        @if($colocations->hasPages())
                        <div class="px-6 py-4 border-t border-slate-200 dark:border-slate-800">
                            {{ $colocations->links() }}
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </main>
    </div>
</body>

</html>