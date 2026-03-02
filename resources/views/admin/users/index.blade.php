<!DOCTYPE html>

<html class="light" lang="fr">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Public+Sans:wght@300;400;500;600;700;800;900&amp;display=swap"
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
                        "display": ["Public Sans"]
                    },
                    borderRadius: { "DEFAULT": "0.25rem", "lg": "0.5rem", "xl": "0.75rem", "full": "9999px" },
                },
            },
        }
    </script>
    <title>EasyColoc - Gestion des utilisateurs</title>
</head>

<body class="bg-background-light dark:bg-background-dark font-display text-slate-900 dark:text-slate-100 min-h-screen">
    <div class="flex h-screen overflow-hidden">
        @include('layouts.admin-sidebar')
        <main class="flex-1 overflow-y-auto bg-background-light dark:bg-background-dark p-8">
            <div class="max-w-7xl mx-auto">
                <header class="flex flex-col md:flex-row md:items-center justify-between gap-4 mb-8">
                    <div>
                        <h2 class="text-3xl font-black text-slate-900 dark:text-slate-100 tracking-tight">Gestion des
                            utilisateurs</h2>
                        <p class="text-slate-500 dark:text-slate-400">Gérez les comptes, les rôles et les accès des
                            membres de la plateforme.</p>
                    </div>
                </header>
                <div
                    class="bg-white dark:bg-background-dark/50 rounded-2xl shadow-sm border border-slate-200 dark:border-primary/20 overflow-hidden">
                    <div class="overflow-x-auto">
                        
                        @if (session('failure'))
                            <p>{{ session('failure') }}</p>
                        @endif
                        <table class="w-full text-left ">
                            <thead>
                                <tr
                                    class="bg-slate-50/50 dark:bg-primary/5 text-slate-500 dark:text-slate-400 text-xs font-bold uppercase tracking-wider">
                                    <th class="px-6 py-4">Nom</th>
                                    <th class="px-6 py-4">Email</th>
                                    <th class="px-6 py-4">Rôle</th>
                                    <th class="px-6 py-4">Statut</th>
                                    <th class="px-6 py-4">Date d'inscription</th>
                                    <th class="px-6 py-4 text-right">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-100 dark:divide-primary/10">
                                @forelse($users as $user)
                                    <tr class="hover:bg-slate-50/50 dark:hover:bg-primary/5 transition-colors">
                                        <td class="px-6 py-4">
                                            <div class="flex items-center gap-3">
                                                <div
                                                    class="w-10 h-10 rounded-full bg-slate-200 dark:bg-primary/20 overflow-hidden shrink-0">
                                                    <img alt="User" class="w-full h-full object-cover"
                                                        data-alt="Photo de profil de l'utilisateur Jean Dupont"
                                                        src="https://lh3.googleusercontent.com/aida-public/AB6AXuAsCT8Sx40_iNcjvRKj99Yeu16tz1DysOjenhQv_MznsSAidTCN6MJFdDVNiUZgqkZTyvYkQVnE5dO1-Rmrda7tTmauZLCjIL_B9Yj6ituMnIV31SBMqZJp5YENQqElTm3XDbURn8GgPzYGhu8oVkoMNpYqWPeKSYuaTHatIZ1bSNgUutV1iyiH4lLYhcBkdHSemPG1_eHmfVE1uT4JLyRMq4ck8zBd3nKAb89tL5MWbR470WrXemZrLZDOdAZbhJYPqdSU4fuObgau" />
                                                </div>
                                                <span class="font-bold text-sm">{{ $user->name }}</span>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 text-sm text-slate-600 dark:text-slate-300">
                                            {{ $user->email }}
                                        </td>
                                        <td class="px-6 py-4">
                                            <span
                                                class="px-3 py-1 bg-red-100 dark:bg-red-900/30 text-red-700 dark:text-red-400 text-xs font-bold rounded-full">
                                                {{ $user->isOwner ? 'Colocation Owner' : 'Member' }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4">
                                            <span
                                                class="flex items-center gap-1.5 text-xs font-bold text-green-600 dark:text-green-400">
                                                {{ $user->isBanned ? 'Banned' : 'Actif' }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4 text-sm text-slate-500 dark:text-slate-400">
                                            {{ $user->created_at->format('d M Y')}}
                                        </td>
                                        <td class="px-6 py-4 text-right">
                                            @if (!$user->isBanned)
                                                <div class="flex items-center justify-end gap-2">
                                                    <form method="POST" action="{{ route('admin.users.ban', $user->id) }}">
                                                        @csrf
                                                        <button type="submit"
                                                            class="p-2 text-slate-400 hover:text-red-600 hover:bg-red-50 dark:hover:bg-red-900/20 rounded-lg"
                                                            title="Bannir">
                                                            Bannir
                                                        </button>
                                                    </form>
                                                </div>
                                            @else
                                                <div class="flex items-center justify-end gap-2">
                                                    <form method="POST" action="{{ route('admin.users.unban', $user->id) }}">
                                                        @csrf
                                                        <button type="submit"
                                                            class="p-2 text-slate-400 hover:text-red-600 hover:bg-red-50 dark:hover:bg-red-900/20 rounded-lg"
                                                            title="Debannir">
                                                            Debannir
                                                        </button>
                                                    </form>
                                                </div>
                                            @endif
                                        </td>
                                    </tr>
                                @empty
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