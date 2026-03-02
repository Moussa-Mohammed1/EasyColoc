<!DOCTYPE html>

<html lang="fr">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@300;400;500;600;700;800&amp;display=swap"
        rel="stylesheet" />
    <link
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap"
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
    <title>EasyColoc - Anciennes Colocations</title>
</head>

<body
    class="font-display bg-background-light dark:bg-background-dark text-slate-900 dark:text-slate-100 min-h-screen flex">
    <!-- Top Navigation Bar -->
    @include('layouts.sidebar')
    <main class="flex-1 min-w-0 px-8 py-8 lg:ml-64 min-h-screen overflow-y-auto">
        <div class="mb-8">
            <h1 class="text-3xl font-extrabold text-slate-900 dark:text-white mb-2">Mes colocations</h1>
            <p class="text-slate-600 dark:text-slate-400">Retrouvez votre colocation active et l'historique de vos
                séjours.</p>
        </div>

        <section class="space-y-10">
            <div class="bg-white dark:bg-slate-900 border border-slate-200 dark:border-slate-800 rounded-xl p-6 shadow-sm">
                @if ($activeMembership)
                    @php $activeColocation = $activeMembership->colocation; @endphp
                    <div class="flex flex-col lg:flex-row lg:items-start lg:justify-between gap-6">
                        <div class="space-y-4">
                            <div class="flex items-center gap-2 text-xs font-semibold uppercase tracking-wider text-primary">
                                <span class="material-symbols-outlined text-base">bolt</span>
                                <span>Colocation active</span>
                            </div>
                            <div class="space-y-2">
                                <h2 class="text-2xl font-bold text-slate-900 dark:text-white">{{ $activeColocation?->name ?? 'Colocation' }}</h2>
                                @if (!empty($activeColocation?->description))
                                    <p class="text-slate-600 dark:text-slate-400">{{ $activeColocation->description }}</p>
                                @endif
                            </div>
                            <div class="flex flex-wrap gap-4 text-sm text-slate-600 dark:text-slate-400">
                                <div class="flex items-center gap-2">
                                    <span class="material-symbols-outlined text-lg">calendar_today</span>
                                    <span>Rejoint le: {{ $activeMembership->created_at->format('d M Y') }}</span>
                                </div>
                                <div class="flex items-center gap-2">
                                    <span class="material-symbols-outlined text-lg">badge</span>
                                    <span>Rôle: {{ ucfirst($activeMembership->role) }}</span>
                                </div>
                                <div class="flex items-center gap-2">
                                    <span class="material-symbols-outlined text-lg">group</span>
                                    <span>{{ $activeColocation?->members_count ?? $activeColocation?->members()->count() }} membres</span>
                                </div>
                            </div>
                        </div>
                        <div class="flex flex-col items-start lg:items-end gap-3">
                            <span
                                class="px-3 py-1 text-xs font-semibold rounded-full bg-primary/10 text-primary uppercase tracking-wide">{{ ucfirst($activeColocation->status ?? 'active') }}</span>
                        </div>
                    </div>
                @else
                    <div class="flex flex-col sm:flex-row sm:items-center sm:justify-between gap-4">
                        <div>
                            <p class="text-lg font-semibold text-slate-900 dark:text-white">Aucune colocation active</p>
                            <p class="text-slate-600 dark:text-slate-400">Créez ou rejoignez une colocation pour commencer à suivre vos dépenses.</p>
                        </div>
                    </div>
                @endif
            </div>

            <div class="space-y-4">
                <div class="flex items-center justify-between">
                    <h2 class="text-xl font-bold text-slate-900 dark:text-white">Anciennes colocations</h2>
                   </div>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @forelse ($pastMemberships as $membership)
                        @php $colocation = $membership->colocation; @endphp
                        <div class="bg-white dark:bg-slate-900 rounded-xl border border-slate-200 dark:border-slate-800 overflow-hidden flex flex-col hover:shadow-lg transition-shadow">
                            <div class="p-6 flex-1 space-y-4">
                                <div class="flex justify-between items-start">
                                    <h3 class="text-lg font-bold text-slate-900 dark:text-white leading-tight">{{ $colocation?->name ?? 'Colocation' }}</h3>
                                    <span class="px-2 py-1 text-[10px] font-bold uppercase tracking-wider bg-slate-100 dark:bg-slate-800 text-slate-600 dark:text-slate-400 rounded">Quittée</span>
                                </div>
                                <div class="flex items-center gap-2">
                                    <span class="px-2 py-1 text-[10px] font-bold uppercase tracking-wider bg-primary/10 text-primary rounded">{{ ucfirst($membership->role) }}</span>
                                </div>
                                <div class="space-y-3 text-sm text-slate-600 dark:text-slate-400">
                                    <div class="flex items-center gap-3">
                                        <span class="material-symbols-outlined text-lg">calendar_today</span>
                                        <span>Rejoint le: {{ $membership?->created_at?->format('d M Y') }}</span>
                                    </div>
                                    <div class="flex items-center gap-3">
                                        <span class="material-symbols-outlined text-lg">event_busy</span>
                                        <span>Quitté le: {{ $membership->left_at->format('d M Y') }}</span>
                                    </div>
                                    <div class="flex items-center gap-3">
                                        <span class="material-symbols-outlined text-lg">group</span>
                                        <span>{{ $colocation?->members_count ?? $colocation?->members()->count() }} membres</span>
                                    </div>
                                </div>
                            </div>
                            <div class="px-6 pb-6">
                                <span class="text-xs text-slate-500 dark:text-slate-400">Dernier statut : {{ ucfirst($colocation->status ?? 'inactif') }}</span>
                            </div>
                        </div>
                    @empty
                        <div class="col-span-full bg-white dark:bg-slate-900 border border-dashed border-slate-300 dark:border-slate-700 rounded-xl p-8 text-center">
                            <p class="text-slate-700 dark:text-slate-300 font-semibold">Aucune ancienne colocation</p>
                            <p class="text-sm text-slate-500 dark:text-slate-400">Les colocations quittées apparaîtront ici.</p>
                        </div>
                    @endforelse
                </div>
            </div>
        </section>
    </main>
</body>

</html>