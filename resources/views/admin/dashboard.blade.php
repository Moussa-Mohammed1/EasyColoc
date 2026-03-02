<!DOCTYPE html>

<html class="light" lang="fr">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>EasyColoc Admin Dashboard</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@300;400;500;600;700&amp;display=swap"
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
                        "display": ["Manrope"]
                    },
                    borderRadius: { "DEFAULT": "0.25rem", "lg": "0.5rem", "xl": "0.75rem", "full": "9999px" },
                },
            },
        }
    </script>
</head>

<body class="bg-background-light dark:bg-background-dark font-display text-slate-900 dark:text-slate-100 antialiased">
    <div class="flex h-screen overflow-hidden">
        <!-- Sidebar Navigation -->
       @include('layouts.admin-sidebar')
        <!-- Main Content -->
        <main class="flex-1 flex flex-col overflow-hidden">
            <!-- Header -->
            <header
                class="h-16 border-b border-slate-200 dark:border-slate-800 bg-white dark:bg-slate-900 px-8 flex items-center justify-between">
                <h2 class="text-xl font-bold">Tableau de bord administrateur</h2>
            </header>
            <!-- Scrollable Content -->
            <div class="flex-1 overflow-y-auto p-8 space-y-8">
                <!-- Stats Grid -->
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                    <div
                        class="bg-white dark:bg-slate-900 p-6 rounded-xl border border-slate-200 dark:border-slate-800 shadow-sm">
                        <div class="flex justify-between items-start mb-4">
                            
                        </div>
                        <p class="text-slate-500 dark:text-slate-400 text-sm font-medium">Total des utilisateurs</p>
                        <h3 class="text-2xl font-bold mt-1">{{ number_format($totalUsers) }}</h3>
                    </div>
                    <div
                        class="bg-white dark:bg-slate-900 p-6 rounded-xl border border-slate-200 dark:border-slate-800 shadow-sm">
                        <div class="flex justify-between items-start mb-4">
                            
                        </div>
                        <p class="text-slate-500 dark:text-slate-400 text-sm font-medium">Colocations actives</p>
                        <h3 class="text-2xl font-bold mt-1">{{ number_format($activeColocations) }}</h3>
                    </div>
                    <div
                        class="bg-white dark:bg-slate-900 p-6 rounded-xl border border-slate-200 dark:border-slate-800 shadow-sm">
                        <div class="flex justify-between items-start mb-4">
                            
                        </div>
                        <p class="text-slate-500 dark:text-slate-400 text-sm font-medium">Total des dépenses</p>
                        <h3 class="text-2xl font-bold mt-1">{{ number_format($totalExpenses, 2) }} €</h3>
                    </div>
                    <div
                        class="bg-white dark:bg-slate-900 p-6 rounded-xl border border-slate-200 dark:border-slate-800 shadow-sm">
                        
                        <p class="text-slate-500 dark:text-slate-400 text-sm font-medium">Utilisateurs bannis</p>
                        <h3 class="text-2xl font-bold mt-1">{{ number_format($bannedUsers) }}</h3>
                    </div>
                </div>
                <!-- Main Grid Layout -->
                <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
                    <!-- Colocations récentes (Left Panel) -->
                    <div
                        class="lg:col-span-12 bg-white dark:bg-slate-900 rounded-xl border border-slate-200 dark:border-slate-800 overflow-hidden shadow-sm">
                        <div
                            class="p-6 border-b border-slate-200 dark:border-slate-800 flex items-center justify-between">
                            <h4 class="font-bold text-lg">Colocations récentes</h4>
                            <a href="/admin/colocations" class="text-primary text-sm font-semibold hover:underline">Voir tout</a>
                        </div>
                        <div class="overflow-x-auto">
                            <table class="w-full text-left">
                                <thead
                                    class="bg-slate-50 dark:bg-slate-800/50 text-slate-500 dark:text-slate-400 uppercase text-[10px] font-bold tracking-wider">
                                    <tr>
                                        <th class="px-6 py-4">Nom</th>
                                        <th class="px-6 py-4">Propriétaire</th>
                                        <th class="px-6 py-4">Date de création</th>
                                        <th class="px-6 py-4 text-center">Statut</th>
                                    </tr>
                                </thead>
                                <tbody class="divide-y divide-slate-100 dark:divide-slate-800">
                                    @forelse($recentColocations as $colocation)
                                    <tr class="hover:bg-slate-50 dark:hover:bg-slate-800 transition-colors">
                                        <td class="px-6 py-4 font-medium">{{ $colocation->name }}</td>
                                        <td class="px-6 py-4 text-slate-600 dark:text-slate-400">{{ $colocation->user->name  }}</td>
                                        <td class="px-6 py-4 text-slate-600 dark:text-slate-400">{{ $colocation->created_at->format('d/m/Y') }}</td>
                                        <td class="px-6 py-4 text-center">
                                              <span class="px-2.5 py-1 rounded-full text-xs font-medium bg-green-100 text-green-700 dark:bg-green-900/30 dark:text-green-400">{{$colocation->status}}</span>
                                            
                                        </td>
                                    </tr>
                                    @empty
                                    <tr>
                                        <td colspan="4" class="px-6 py-8 text-center text-slate-500 dark:text-slate-400">
                                            Aucune colocation trouvée
                                        </td>
                                    </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                    
                </div>
            </div>
        </main>
    </div>
</body>

</html>