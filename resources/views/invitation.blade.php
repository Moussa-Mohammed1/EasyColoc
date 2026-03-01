<!DOCTYPE html>

<html class="light" lang="fr">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
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
    <title>Invitation EasyColoc</title>
</head>

<body
    class="bg-background-light dark:bg-background-dark font-display text-slate-900 dark:text-slate-100 min-h-screen flex flex-col">
    <main class="flex-1 flex items-center justify-center p-4 sm:p-6 lg:p-8">
        <div class="max-w-md w-full">
            @if (session('info'))
                <div class="alert alert-info">
                    {{ session('info') }}
                </div>
            @endif
            <div
                class="bg-white dark:bg-slate-900 rounded-xl shadow-xl shadow-primary/5 border border-slate-200 dark:border-slate-800 overflow-hidden">
                <div class="h-32 bg-primary relative overflow-hidden">
                    <div
                        class="absolute inset-0 opacity-20 bg-[radial-gradient(circle_at_50%_120%,rgba(255,255,255,0.8),transparent)]">
                    </div>
                    <div class="absolute inset-0 flex items-center justify-center">
                        <img class="w-12 h-12"
                            src="https://i.pinimg.com/736x/87/e1/59/87e1599193c9d1184d91c040d6844b6b.jpg" alt="">
                    </div>
                </div>
                <div class="p-6 sm:p-8 -mt-10 relative">
                    <div class="bg-white dark:bg-slate-900 p-2 rounded-lg shadow-md inline-block mb-6">
                        <div class="bg-primary/10 rounded-md p-3">
                            <span class="material-symbols-outlined text-primary text-3xl">mail</span>
                        </div>
                    </div>
                    <h2 class="text-2xl font-bold text-slate-900 dark:text-white leading-tight mb-4">
                        Vous avez été invité à rejoindre une colocation
                    </h2>
                    <div class="space-y-4 mb-8">
                        <p class="text-slate-600 dark:text-slate-400 text-base leading-relaxed">
                            L'administrateur vous a invité à rejoindre la colocation
                            <span class="italic text-primary">"{{ $invitation->colocation->name }}"</span>.
                        </p>
                    </div>


                    <form action="{{ route('invitations.process', $invitation->token) }}" method="POST"
                        class="flex flex-col gap-3">
                        @csrf
                        <button type="submit" name="accept" value="1"
                            class="w-full bg-primary hover:bg-primary/90 text-white font-semibold py-3 px-6 rounded-lg transition-all shadow-lg shadow-primary/25 flex items-center justify-center gap-2 group">
                            <span>Accepter l'invitation</span>
                            <span
                                class="material-symbols-outlined text-xl group-hover:translate-x-1 transition-transform">arrow_forward</span>
                        </button>
                        <button type="submit" name="refuse" value="1"
                            class="w-full bg-slate-100 hover:bg-slate-200 dark:bg-slate-800 dark:hover:bg-slate-700 text-slate-700 dark:text-slate-300 font-medium py-3 px-6 rounded-lg transition-all flex items-center justify-center">
                            Refuser
                        </button>
                    </form>
                </div>
            </div>
            <p class="text-center mt-8 text-slate-500 text-sm">
                Vous avez des questions ? <a class="text-primary hover:underline font-medium" href="#">Consultez notre
                    FAQ</a>
            </p>
        </div>
    </main>
    <footer class="py-8 text-center border-t border-slate-200 dark:border-slate-800">
        <div class="flex justify-center gap-6 mb-4">
            <a class="text-slate-400 hover:text-primary transition-colors" href="#">
                <span class="material-symbols-outlined text-2xl">help</span>
            </a>
            <a class="text-slate-400 hover:text-primary transition-colors" href="#">
                <span class="material-symbols-outlined text-2xl">policy</span>
            </a>
            <a class="text-slate-400 hover:text-primary transition-colors" href="#">
                <span class="material-symbols-outlined text-2xl">language</span>
            </a>
        </div>
        <p class="text-slate-400 text-xs uppercase tracking-widest font-semibold">© 2024 EasyColoc France</p>
    </footer>
</body>

</html>