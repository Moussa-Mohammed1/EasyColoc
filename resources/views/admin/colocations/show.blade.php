<!DOCTYPE html>
<html class="light" lang="fr">
<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>{{ $colocation->name }} - EasyColoc Admin</title>
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
        @include('layouts.admin-sidebar')
        
        <main class="flex-1 flex flex-col overflow-hidden">
            <header class="h-16 border-b border-slate-200 dark:border-slate-800 bg-white dark:bg-slate-900 px-8 flex items-center justify-between">
                <div class="flex items-center gap-4">
                    <a href="/admin/colocations" class="p-2 hover:bg-slate-100 dark:hover:bg-slate-800 rounded-lg transition-colors">
                        <span class="material-symbols-outlined">arrow_back</span>
                    </a>
                    <h2 class="text-xl font-bold">{{ $colocation->name }}</h2>
                </div>
            </header>
            
            <div class="flex-1 overflow-y-auto p-8 space-y-8">
                @if(session('success'))
                <div class="p-4 bg-green-50 dark:bg-green-900/20 text-green-700 dark:text-green-400 rounded-lg">
                    {{ session('success') }}
                </div>
                @endif

                <!-- Colocation Info -->
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div class="bg-white dark:bg-slate-900 p-6 rounded-xl border border-slate-200 dark:border-slate-800 shadow-sm">
                        <div class="flex items-center gap-3 mb-2">
                            <span class="material-symbols-outlined text-primary">person</span>
                            <h3 class="font-bold">Propriétaire</h3>
                        </div>
                        <p class="text-slate-600 dark:text-slate-400">{{ $colocation->user->name ?? 'N/A' }}</p>
                        <p class="text-sm text-slate-500">{{ $colocation->user->email ?? '' }}</p>
                    </div>

                    <div class="bg-white dark:bg-slate-900 p-6 rounded-xl border border-slate-200 dark:border-slate-800 shadow-sm">
                        <div class="flex items-center gap-3 mb-2">
                            <span class="material-symbols-outlined text-primary">group</span>
                            <h3 class="font-bold">Membres</h3>
                        </div>
                        <p class="text-2xl font-bold">{{ $colocation->members->count() }}</p>
                    </div>

                    <div class="bg-white dark:bg-slate-900 p-6 rounded-xl border border-slate-200 dark:border-slate-800 shadow-sm">
                        <div class="flex items-center gap-3 mb-2">
                            <span class="material-symbols-outlined text-primary">payments</span>
                            <h3 class="font-bold">Total dépenses</h3>
                        </div>
                        <p class="text-2xl font-bold">{{ number_format($colocation->expenses->sum('amount'), 2) }} €</p>
                    </div>
                </div>

                <!-- Description -->
                @if($colocation->description)
                <div class="bg-white dark:bg-slate-900 p-6 rounded-xl border border-slate-200 dark:border-slate-800 shadow-sm">
                    <h3 class="font-bold mb-4">Description</h3>
                    <p class="text-slate-600 dark:text-slate-400">{{ $colocation->description }}</p>
                </div>
                @endif

                <!-- Members List -->
                <div class="bg-white dark:bg-slate-900 rounded-xl border border-slate-200 dark:border-slate-800 overflow-hidden shadow-sm">
                    <div class="p-6 border-b border-slate-200 dark:border-slate-800">
                        <h3 class="font-bold text-lg">Membres de la colocation</h3>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="w-full text-left">
                            <thead class="bg-slate-50 dark:bg-slate-800/50 text-slate-500 dark:text-slate-400 uppercase text-[10px] font-bold tracking-wider">
                                <tr>
                                    <th class="px-6 py-4">Nom</th>
                                    <th class="px-6 py-4">Email</th>
                                    <th class="px-6 py-4">Rôle</th>
                                    <th class="px-6 py-4">Date d'adhésion</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-100 dark:divide-slate-800">
                                @forelse($colocation->members as $member)
                                <tr class="hover:bg-slate-50 dark:hover:bg-slate-800 transition-colors">
                                    <td class="px-6 py-4">
                                        <div class="flex items-center gap-3">
                                            <div class="size-10 rounded-full bg-slate-200 dark:bg-slate-700 flex items-center justify-center font-bold">
                                                {{ strtoupper(substr($member->name, 0, 1)) }}
                                            </div>
                                            <span class="font-medium">{{ $member->name }}</span>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4 text-slate-600 dark:text-slate-400">{{ $member->email }}</td>
                                    <td class="px-6 py-4">
                                        <span class="px-2.5 py-1 rounded-full text-xs font-medium 
                                            {{ $member->pivot->role === 'owner' ? 'bg-purple-100 text-purple-700 dark:bg-purple-900/30 dark:text-purple-400' : 'bg-blue-100 text-blue-700 dark:bg-blue-900/30 dark:text-blue-400' }}">
                                            {{ ucfirst($member->pivot->role) }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-slate-600 dark:text-slate-400">{{ \Carbon\Carbon::parse($member->pivot->created_at)->format('d/m/Y') }}</td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="4" class="px-6 py-8 text-center text-slate-500 dark:text-slate-400">
                                        Aucun membre
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Recent Expenses -->
                <div class="bg-white dark:bg-slate-900 rounded-xl border border-slate-200 dark:border-slate-800 overflow-hidden shadow-sm">
                    <div class="p-6 border-b border-slate-200 dark:border-slate-800">
                        <h3 class="font-bold text-lg">Dépenses récentes</h3>
                    </div>
                    <div class="overflow-x-auto">
                        <table class="w-full text-left">
                            <thead class="bg-slate-50 dark:bg-slate-800/50 text-slate-500 dark:text-slate-400 uppercase text-[10px] font-bold tracking-wider">
                                <tr>
                                    <th class="px-6 py-4">Titre</th>
                                    <th class="px-6 py-4">Montant</th>
                                    <th class="px-6 py-4">Payé par</th>
                                    <th class="px-6 py-4">Date</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-100 dark:divide-slate-800">
                                @forelse($colocation->expenses->take(10) as $expense)
                                <tr class="hover:bg-slate-50 dark:hover:bg-slate-800 transition-colors">
                                    <td class="px-6 py-4 font-medium">{{ $expense->title }}</td>
                                    <td class="px-6 py-4 text-slate-600 dark:text-slate-400">{{ number_format($expense->amount, 2) }} €</td>
                                    <td class="px-6 py-4 text-slate-600 dark:text-slate-400">{{ $expense->user->name ?? 'N/A' }}</td>
                                    <td class="px-6 py-4 text-slate-600 dark:text-slate-400">{{ $expense->created_at->format('d/m/Y') }}</td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="4" class="px-6 py-8 text-center text-slate-500 dark:text-slate-400">
                                        Aucune dépense
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </main>
    </div>
</body>
</html>
