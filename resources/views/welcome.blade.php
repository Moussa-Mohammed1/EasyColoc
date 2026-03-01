<!DOCTYPE html>
<html class="light" lang="fr">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>EasyColoc - Gérez vos dépenses de colocation sans stress</title>
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
                        "primary": "#ec5b13",
                        "background-light": "#f8f6f6",
                        "background-dark": "#221610",
                    },
                    fontFamily: {
                        "display": ["Public Sans", "sans-serif"]
                    },
                    borderRadius: {
                        "DEFAULT": "0.25rem",
                        "lg": "0.5rem",
                        "xl": "0.75rem",
                        "full": "9999px"
                    },
                },
            },
        }
    </script>
</head>

<body class="font-display bg-background-light dark:bg-background-dark text-slate-900 dark:text-slate-100 antialiased">
    <div class="relative flex min-h-screen w-full flex-col overflow-x-hidden">
        <header
            class="sticky top-0 z-50 w-full border-b border-slate-200 dark:border-slate-800 bg-background-light/80 dark:bg-background-dark/80 backdrop-blur-md">
            <div class="container mx-auto max-w-[1200px] px-4 md:px-6">
                <div class="flex h-16 items-center justify-between gap-4">
                    <div class="flex items-center gap-2 group cursor-pointer">
                        <div class="flex h-8 w-8 items-center justify-center rounded-lg bg-primary text-white">
                           <img class="w-12 w-12 rounded-lg" src="https://i.pinimg.com/1200x/8f/0d/3b/8f0d3bb747fd0b24ce1cebe012a030b5.jpg" alt="">
                        </div>
                        <h2 class="text-xl font-bold tracking-tight text-slate-900 dark:text-white">EasyColoc</h2>
                    </div>
                   
                    <div class="flex items-center gap-3">
                        <a href="{{ route('login') }}"
                            class="hidden sm:inline-flex h-10 items-center justify-center rounded-xl px-4 text-sm font-semibold text-slate-900 dark:text-white hover:bg-slate-100 dark:hover:bg-slate-800 transition-all">
                            Connexion
                        </a>
                        <a href="{{ route('register') }}"
                            class="inline-flex h-10 items-center justify-center rounded-xl bg-primary px-5 text-sm font-bold text-white hover:opacity-90 transition-all shadow-lg shadow-primary/20">
                            S'inscrire
                        </a>
                    </div>
                </div>
            </div>
        </header>
        <main class="flex-1">
            <section class="relative overflow-hidden pt-12 pb-16 md:pt-20 md:pb-32">
                <div class="container mx-auto max-w-[1200px] px-4 md:px-6">
                    <div class="grid items-center gap-12 lg:grid-cols-2">
                        <div class="flex flex-col gap-6 text-left">
                            <div
                                class="inline-flex w-fit items-center rounded-full bg-primary/10 px-3 py-1 text-xs font-bold text-primary dark:bg-primary/20">
                                Nouveau : Facturation groupée simplifiée
                            </div>
                            <h1
                                class="text-4xl font-black leading-tight tracking-[-0.033em] text-slate-900 dark:text-white sm:text-5xl md:text-6xl">
                                Gérez vos dépenses de colocation <span class="text-primary">sans stress.</span>
                            </h1>
                            <p class="max-w-[540px] text-lg text-slate-600 dark:text-slate-400">
                                L'application simple pour suivre les frais communs, calculer les dettes et simplifier
                                les remboursements entre colocataires.
                            </p>
                            
                            <div class="flex items-center gap-4 pt-4">
                                <div class="flex -space-x-2">
                                    <div class="h-8 w-8 rounded-full border-2 border-white bg-slate-200 dark:border-slate-900"
                                        data-alt="Avatar d'utilisateur souriant"></div>
                                    <div class="h-8 w-8 rounded-full border-2 border-white bg-slate-300 dark:border-slate-900"
                                        data-alt="Portrait d'une jeune colocataire"></div>
                                    <div class="h-8 w-8 rounded-full border-2 border-white bg-slate-400 dark:border-slate-900"
                                        data-alt="Photo d'un étudiant heureux"></div>
                                </div>
                                <p class="text-sm font-medium text-slate-500">Rejoint par +10,000 colocataires ce
                                    mois-ci</p>
                            </div>
                        </div>
                        <div class="relative">
                            <div
                                class="absolute -inset-4 rounded-[2rem] bg-gradient-to-tr from-primary/20 to-transparent blur-2xl">
                            </div>
                            <div
                                class="relative aspect-[4/3] w-full overflow-hidden rounded-2xl border border-slate-200 dark:border-slate-800 bg-white dark:bg-slate-900 shadow-2xl">
                                <div class="flex h-full w-full flex-col">
                                    <div
                                        class="flex items-center gap-2 border-b border-slate-100 dark:border-slate-800 px-4 py-3">
                                        <div class="h-3 w-3 rounded-full bg-red-400"></div>
                                        <div class="h-3 w-3 rounded-full bg-amber-400"></div>
                                        <div class="h-3 w-3 rounded-full bg-emerald-400"></div>
                                    </div>
                                    <div class="flex flex-1 items-center justify-center p-8">
                                        <div
                                            class="h-full w-full rounded-lg bg-slate-50 dark:bg-slate-950 p-4 border border-dashed border-slate-300 dark:border-slate-700 flex flex-col gap-4">
                                            <div class="h-8 w-1/3 rounded bg-primary/20"></div>
                                            <div class="grid grid-cols-2 gap-4">
                                                <div
                                                    class="h-24 rounded bg-white dark:bg-slate-900 border border-slate-100 dark:border-slate-800 shadow-sm">
                                                </div>
                                                <div
                                                    class="h-24 rounded bg-white dark:bg-slate-900 border border-slate-100 dark:border-slate-800 shadow-sm">
                                                </div>
                                            </div>
                                            <div
                                                class="h-40 rounded bg-white dark:bg-slate-900 border border-slate-100 dark:border-slate-800 shadow-sm flex items-center justify-center">
                                                <span
                                                    class="material-symbols-outlined text-slate-300 dark:text-slate-700 text-6xl">bar_chart</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <img class="absolute inset-0 h-full w-full object-cover opacity-0"
                                    data-alt="Interface propre du tableau de bord EasyColoc"
                                    src="https://lh3.googleusercontent.com/aida-public/AB6AXuAfmWMvQ1f4thT3Z3acImTtZvR9Am-vX7jM_5DadoMqxy2WL0QECW-SBNjGGkGQbdb_yUhVhUOL8Id_T2Bw1_k5lUI8SBevNJoDO0MSxWFEHY1dAAKoBDp6o0si7BB9scD0l0C2IVMBlTqq55hZ_AvTM5XfJ0kBgDW2dYHodBHwUXH0Eb_eu_nXa8EwGswvef1o17Fq0Ft_URU7LpO0ncNVqlKtXsiP4unsYX2AhnhTWGN2bL0eKZGTVA2zdB54grYeZY9uTRbHu34r" />
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            
        </main>
      
    </div>
</body>

</html>