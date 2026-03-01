<!DOCTYPE html>

<html lang="fr">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>Tableau de bord EasyColoc</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@400;500;700&amp;display=swap" rel="stylesheet" />
    <link
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap"
        rel="stylesheet" />
    <link
        href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&amp;display=swap"
        rel="stylesheet" />
    <script>
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    colors: {
                        "primary": "#2b8cee",
                        "secondary": "#4c739a",
                        "background-light": "#f3f4f6", // Lighter gray for main bg
                        "background-dark": "#101922",
                        "card-light": "#ffffff",
                        "success": "#10b981", // Green for credits
                        "danger": "#ef4444",  // Red for debts
                    },
                    fontFamily: {
                        "display": ["Manrope", "sans-serif"]
                    },
                    borderRadius: { "DEFAULT": "0.25rem", "lg": "0.5rem", "xl": "0.75rem", "full": "9999px" },
                },
            },
        }
    </script>
</head>

<body class="font-display bg-background-light text-slate-900 overflow-x-hidden antialiased">
    <div class="flex min-h-screen">

        <!-- Sidebar -->
        @include('layouts.sidebar')
        <!-- Main Content -->
        <main class="flex-1 flex flex-col min-w-0 bg-background-light lg:ml-64">

            <!-- Header -->
            <header class="bg-white border-b border-slate-200 sticky top-0 z-40">
                <div class="flex items-center justify-between px-6 py-4">
                    <div class="flex items-center gap-4 flex-1">
                        <!-- Mobile Menu Button -->
                        <button class="lg:hidden p-2 text-slate-500 hover:bg-slate-100 rounded-lg">
                            <span class="material-symbols-outlined">menu</span>
                        </button>
                        <!-- Search Bar -->
                        <h1 class="text-lg ">Colocation Actuelle : <strong>{{ $colocation?->name }}</strong></h1>
                    </div>
                    @if (!$colocation)
                        <button onclick="openModal()"
                            class="inline-flex mr-5 items-center justify-center px-4 py-2 border border-transparent text-sm font-medium rounded-lg shadow-sm text-white bg-blue-600 hover:bg-blue-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary duration-500 transition-colors">
                            <span class="material-symbols-outlined mr-2">add</span>
                            Ajouter une colocation
                        </button>
                    @else
                        <button onclick="openInviteModal()"
                            class="inline-flex mr-5 items-center justify-center px-4 py-2 border border-transparent text-sm font-medium rounded-lg shadow-sm text-white bg-blue-600 hover:bg-blue-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary duration-500 transition-colors">
                            Inviter à la colocation
                        </button>
                    @endif

                    <div class="flex items-center gap-4">
                        <span
                            class="hidden sm:inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-blue-100 text-blue-800">

                            {{ $role ?? 'member'}}
                    </div>
                </div>
            </header>
            @if ($colocation)
                        <div class="p-6 space-y-6 overflow-y-auto">
                            <!-- Welcome Section -->
                            <div class="flex flex-col sm:flex-row sm:items-center justify-between gap-4">
                                <div>
                                    <h2 class="text-2xl font-bold text-slate-900">Bon retour, {{ auth()->user()->name }} !</h2>
                                    <p class="text-slate-500">Voici ce qui se passe dans votre colocation aujourd'hui.</p>
                                </div>
                                @if ($colocation)
                                    <div class="flex gap-2">
                                        @if ($colocation->members->where('id', '=', auth()->id())->first()->pivot->role === 'owner')
                                            <button onclick="openCategoryModal()"
                                                class="inline-flex items-center justify-center px-4 py-2 border border-slate-200 text-sm font-medium rounded-lg shadow-sm text-slate-700 bg-white hover:bg-slate-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary transition-colors">
                                                <span class="material-symbols-outlined mr-2">add</span>
                                                Ajouter une catégorie
                                            </button>
                                        @endif
                                        <button onclick="openExpenseModal()"
                                            class="inline-flex items-center justify-center px-4 py-2 border border-transparent text-sm font-medium rounded-lg shadow-sm text-white bg-primary hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary transition-colors">
                                            <span class="material-symbols-outlined mr-2">add</span>
                                            Ajouter une dépense
                                        </button>
                                    </div>
                                @endif
                            </div>
                            <!-- Stats Grid -->
                            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                                <!-- Total Spent -->
                                <div
                                    class="bg-white p-5 rounded-xl border border-slate-200 shadow-sm hover:shadow-md transition-shadow">
                                    <div class="flex items-center justify-between mb-4">
                                        <h3 class="text-slate-500 text-sm font-medium">Votre Total Dépensé</h3>
                                        <div class="p-2 bg-blue-50 text-blue-600 rounded-lg">
                                            <span class="material-symbols-outlined">payments</span>
                                        </div>
                                    </div>
                                    <div class="flex items-baseline gap-2">
                                        <span class="text-2xl font-bold text-slate-900">€{{ $userExpenses }}</span>
                                    </div>
                                    <p class="text-xs text-slate-400 mt-1">Ce mois-ci</p>
                                </div>
                                <!-- Balance -->
                                <div
                                    class="bg-white p-5 rounded-xl border border-slate-200 shadow-sm hover:shadow-md transition-shadow">
                                    <div class="flex items-center justify-between mb-4">
                                        <h3 class="text-slate-500 text-sm font-medium">Votre Balance</h3>
                                        <div class="p-2 bg-green-50 text-success rounded-lg">
                                            <span class="material-symbols-outlined">account_balance_wallet</span>
                                        </div>
                                    </div>
                                    <div class="flex items-baseline gap-2">
                                        <span
                                            class="text-2xl font-bold text-slate-900">{{ $userSolde >= 0 ? '+' . number_format($userSolde, 2) : '-' . number_format($userSolde)}}€</span>
                                    </div>
                                    <p class="text-xs text-slate-400 mt-1">Total des dettes remboursées</p>
                                </div>
                                <!-- Total Flat Expenses -->
                                <div
                                    class="bg-white p-5 rounded-xl border border-slate-200 shadow-sm hover:shadow-md transition-shadow">
                                    <div class="flex items-center justify-between mb-4">
                                        <h3 class="text-slate-500 text-sm font-medium">Total des Dépenses de la Colocation</h3>
                                        <div class="p-2 bg-purple-50 text-purple-600 rounded-lg">
                                            <span class="material-symbols-outlined">home</span>
                                        </div>
                                    </div>
                                    <div class="flex items-baseline gap-2">
                                        <span class="text-2xl font-bold text-slate-900">€{{  $totalExpenses }}</span>
                                    </div>
                                    <p class="text-xs text-slate-400 mt-1">Dépenses totales combinées</p>
                                </div>
                                <!-- Active Debts -->
                                <div
                                    class="bg-white p-5 rounded-xl border border-slate-200 shadow-sm hover:shadow-md transition-shadow">
                                    <div class="flex items-center justify-between mb-4">
                                        <h3 class="text-slate-500 text-sm font-medium">Vos Dettes Actives</h3>
                                        <div class="p-2 bg-red-50 text-danger rounded-lg">
                                            <span class="material-symbols-outlined">trending_down</span>
                                        </div>
                                    </div>
                                    <div class="flex items-baseline gap-2">
                                        <span
                                            class="text-2xl font-bold text-slate-900">-€{{ number_format($activeDebts, 2) }}</span>
                                    </div>
                                    <p class="text-xs text-slate-400 mt-1">Montant que vous devez</p>
                                </div>
                            </div>
                            <!-- Main Layout Columns -->
                            <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
                                <!-- Left Column: Recent Expenses (Span 2) -->
                                <div class="lg:col-span-2 space-y-6">
                                    <!-- Recent Expenses Card -->
                                    <div class="bg-white rounded-xl border border-slate-200 shadow-sm overflow-hidden">
                                        <div class="px-6 py-4 border-b border-slate-100 flex items-center justify-between">
                                            <h3 class="text-lg font-bold text-slate-900">Dépenses Récentes</h3>
                                            <div class="relative">
                                                <select
                                                    class="appearance-none bg-slate-50 border border-slate-200 text-slate-700 text-sm rounded-lg focus:ring-primary focus:border-primary block w-full p-2.5 pr-8">
                                                    <option>Ce mois-ci</option>
                                                    <option>Le mois dernier</option>
                                                    <option>Tout le temps</option>
                                                </select>
                                                <div
                                                    class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-slate-700">
                                                    <span class="material-symbols-outlined text-sm">expand_more</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="overflow-x-auto">
                                            <table class="w-full text-sm text-left text-slate-500">
                                                <thead class="text-xs text-slate-700 uppercase bg-slate-50">
                                                    <tr>
                                                        <th class="px-6 py-3" scope="col">Dépense</th>
                                                        <th class="px-6 py-3" scope="col">Catégorie</th>
                                                        <th class="px-6 py-3" scope="col">Payeur</th>
                                                        <th class="px-6 py-3" scope="col">Date</th>
                                                        <th class="px-6 py-3 text-right" scope="col">Montant</th>
                                                        <th class="px-6 py-3 text-center" scope="col">Actions</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @if (empty($colocation->expenses))
                                                        <p>no exp</p>
                                                    @else
                                                        @foreach ($colocation->expenses as $expense)
                                                            <tr class="bg-white border-b border-slate-100 hover:bg-slate-50">
                                                                <td class="px-6 py-4 font-medium text-slate-900">
                                                                    {{ $expense->title }}
                                                                </td>
                                                                <td class="px-6 py-4">
                                                                    <div class="flex items-center gap-2">

                                                                        <span>{{ $expense->category->title ?? 'Aucune' }}</span>
                                                                    </div>
                                                                </td>
                                                                <td class="px-6 py-4">
                                                                    <div class="flex items-center gap-2">
                                                                        <div class="h-6 w-6 rounded-full bg-slate-200 bg-cover bg-center"
                                                                            data-alt="User Avatar"
                                                                            style="background-image: url('https://lh3.googleusercontent.com/aida-public/AB6AXuAF6Vo1FEdZBUQHemOg9HaZfmDhCyCz8NFAKTa0ASoz7Hs-woanddwsP89z8V34RW3fR3KI-4XBxByjH2VWR54aH21NKBNsFUAxnyvVCs5A-UilIX0dHJdaXX9VhqsmrrtcGmoEeAxySP7gknFiKNpz2KcWigqPaphcWHZBAbc_nY9iFThnDDpOedd0a1UmSr2csdF2Nq6ZNLH1q6OlxGEPBavcBhXGumFfyb1HoiH5XbbErwdZHjoFtZ8JCDkeu8QBLzd0wFWdriUF');">
                                                                        </div>
                                                                        <span>{{ $expense->user->name }}</span>
                                                                    </div>
                                                                </td>
                                                                <td class="px-6 py-4 ">{{ date('d M Y', strtotime($expense->created_at)) }}
                                                                </td>
                                                                <td class="px-6 py-4 text-right font-bold text-slate-900">
                                                                    €{{ $expense->amount }}</td>
                                                                <td class="px-6 py-4 text-center">
                                                                    @if ($expense->user->id === auth()->id())
                                                                        <form action="{{ route('expenses.destroy', $expense->id) }}"
                                                                            method="POST" class="inline">
                                                                            @csrf
                                                                            @method('DELETE')
                                                                            <button type="submit"
                                                                                class="text-slate-400 hover:text-primary transition-colors">
                                                                                <span class="material-symbols-outlined text-lg">delete</span>
                                                                            </button>
                                                                        </form>
                                                                    @else
                                                                        
                                                                    @endif
                                                                </td>
                                                            </tr>
                                                        @endforeach
                                                    @endif
                                                </tbody>
                                            </table>
                                        </div>

                                    </div>
                                    <!-- Flatmates Section -->
                                    <div>
                                        <h3 class="text-lg font-bold text-slate-900 mb-4 px-1">Colocataires</h3>
                                        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">

                                            @if (empty($colocation->members))
                                                <p class="text-lg font-bold ">pas de colocataire pour le moment , les inviter!</p>
                                            @else
                                                @foreach ($colocation->members as $member)
                                                    <div
                                                        class="bg-white p-4 rounded-xl border border-slate-200 flex items-center gap-4 shadow-sm relative ">
                                                        <div class="h-12 w-12 rounded-full bg-slate-200 bg-cover bg-center shrink-0"
                                                            data-alt="Alex Avatar"
                                                            style="background-image: url('https://i.pinimg.com/1200x/1e/c6/4e/1ec64e2e926f1ab6c553963b86578886.jpg');">
                                                        </div>
                                                        <div class="flex-1 min-w-0">
                                                            <p class="text-sm font-bold text-slate-900 truncate">@if ($member->isAdmin)<span class="material-symbols-outlined text-sm text-yellow-500 pr-1">crown</span>@endif{{ $member->name }}</p>
                                                            <p class="text-xs text-slate-500">{{ $member->isAdmin ? 'Platform Admin' . ' + ' . ucfirst($member->pivot->role) : ucfirst($member->pivot->role)}}</p>
                                                        </div>
                                                        <div class="text-right">
                                                            <span
                                                                class="inline-flex items-center px-2 py-0.5 rounded text-xs font-medium bg-green-100 text-green-800">
                                                                {{ $member->reputation_score >= 0 ? '+' . $member->reputation_score : '-' . $member->reputation_score  }}
                                                            </span>
                                                        </div>
                                                        
                                                        @if ($member->pivot->role === 'member' && $member->pivot->firstWhere('role', 'owner')->user_id === auth()->id())
                                                            <form action="{{ route('user.remove')}}" method="POST">
                                                                @csrf
                                                                <input type="hidden" name="user_id" value="{{ $member->id }}">
                                                                <input type="hidden" name="amount" value="">
                                                                <button class="text-right " type="submit">
                                                                    <span
                                                                        class="inline-flex items-center hover:bg-slate-100 px-2 py-2 transition rounded text-xs font-medium bg-green-100 text-green-800">
                                                                        retirer
                                                                    </span>
                                                                </button>
                                                            </form>
                                                        @endif
                                                    </div>
                                                @endforeach
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <!-- Right Column: Who Owes Whom (Span 1) -->
                                <div class="lg:col-span-1 space-y-6">
                                    <div class="bg-white rounded-xl border border-slate-200 shadow-sm p-6">
                                        <h3 class="text-lg font-bold text-slate-900 mb-6">Qui Doit à Qui</h3>
                                        <div class="space-y-6">
                                            @forelse($owes as $owe)
                                                @if($owe['from']->id === auth()->id())
                                                    <!-- You Owe Someone -->
                                                    <div class="flex flex-col gap-3 pb-6 border-b border-slate-100 last:border-0 last:pb-0">
                                                        <div class="flex items-center justify-between">
                                                            <div class="flex items-center gap-3">
                                                                <div
                                                                    class="h-10 w-10 rounded-full bg-slate-100 flex items-center justify-center text-slate-500">
                                                                    <span class="material-symbols-outlined">person</span>
                                                                </div>
                                                                <div>
                                                                    <p class="text-sm font-medium text-slate-900"><strong>Vous</strong>
                                                                        devez à <strong>{{ $owe['to']->name }}</strong></p>
                                                                </div>
                                                            </div>
                                                            <p class="text-base font-bold text-danger">
                                                                €{{$owe['amount'] }}</p>
                                                        </div>
                                                        <form action="{{ route('payments.store') }}" method="POST">
                                                            @csrf
                                                            <input type="hidden" name="payer_id" value="{{ $owe['from']->id }}">
                                                            <input type="hidden" name="expense_id" value="{{ $owe['expense_id'] }}">
                                                            <input type="hidden" name="amount" value="{{ $owe['amount'] }}">
                                                            <button type="submit"
                                                                class="w-full py-2 px-4 bg-slate-50 hover:bg-slate-100 text-slate-700 text-sm font-medium rounded-lg border border-slate-200 transition-colors flex items-center justify-center gap-2">
                                                                <span class="material-symbols-outlined text-lg">check_circle</span>
                                                                Marquer comme Payé
                                                            </button>
                                                        </form>
                                                    </div>
                                                @elseif($owe['to']->id === auth()->id())
                                                    <!-- Someone Owes You -->
                                                    <div class="flex flex-col gap-3 pb-6 border-b border-slate-100 last:border-0 last:pb-0">
                                                        <div class="flex items-center justify-between">
                                                            <div class="flex items-center gap-3">
                                                                <div
                                                                    class="h-10 w-10 rounded-full bg-slate-100 flex items-center justify-center text-slate-500">
                                                                    <span class="material-symbols-outlined">person</span>
                                                                </div>
                                                                <div>
                                                                    <p class="text-sm font-medium text-slate-900">{{ $owe['from']->name }}
                                                                        vous doit</p>
                                                                </div>
                                                            </div>
                                                            <p class="text-base font-bold text-success">
                                                                +€{{ number_format($owe['amount'], 2) }}</p>
                                                        </div>
                                                    </div>
                                                @elseif($owe['to']->id !== auth()->id() && $owe['from']->id !== auth()->id())
                                                    <div class="text-center py-8">
                                                        <p class="text-xs text-slate-500 mt-1">Aucune dette active</p>
                                                    </div>
                                                @endif
                                            @empty
                                                <div class="text-center py-8">
                                                    <p class="text-xs text-slate-500 mt-1">Aucune dette active</p>
                                                </div>
                                            @endforelse
                                        </div>
                                    </div>
                                </div>
                            </div>
                    </main>
                </div>
                <div id="invite-modal" class="fixed inset-0 bg-slate-900/50 backdrop-blur-sm hidden items-center justify-center p-4"
                    style="z-index: 9999; background-color: rgba(15, 23, 42, 0.5); width: 100vw; height: 100vh;">
                    <div class="bg-white rounded-2xl shadow-2xl max-w-lg w-full max-h-[90vh] overflow-y-auto relative">
                        <div
                            class="sticky top-0 bg-white border-b border-slate-200 px-6 py-4 flex items-center justify-between rounded-t-2xl">
                            <h3 class="text-xl font-bold text-slate-900">Inviter à une colocation</h3>
                            <button type="button" onclick="closeInviteModal()"
                                class="text-slate-400 hover:text-slate-600 transition-colors">
                                <span class="material-symbols-outlined">close</span>
                            </button>
                        </div>

                        <form action="{{ url('/invitations') }}" method="POST" class="p-6 space-y-6">
                            @csrf
                            <div>
                                <label for="invite-email" class="block text-sm font-medium text-slate-700 mb-2">
                                    Adresse email du colocataire <span class="text-danger">*</span>
                                </label>
                                <input type="email" id="invite-email" name="email" required
                                    class="w-full px-4 py-2.5 border border-slate-200 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary transition-colors"
                                    placeholder="exemple@mail.com">
                            </div>
                            <div class="flex flex-col-reverse sm:flex-row gap-3 pt-4 border-t border-slate-200">
                                <button type="button" onclick="closeInviteModal()"
                                    class="flex-1 px-4 py-2.5 border border-slate-200 text-slate-700 font-medium rounded-lg hover:bg-slate-50 transition-colors">
                                    Annuler
                                </button>
                                <button type="submit"
                                    class="flex-1 px-4 py-2.5 bg-primary text-white font-medium rounded-lg hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary transition-colors flex items-center justify-center gap-2">
                                    <span class="material-symbols-outlined text-lg">send</span>
                                    Envoyer l'invitation
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            @else
                <div class="p-6 flex items-center justify-center min-h-[calc(100vh-5rem)]">
                    <div class="text-center max-w-md">
                        <div class="mb-6">
                            <div class="inline-flex items-center justify-center w-24 h-24 bg-blue-50 rounded-full mb-4">
                                <span class="material-symbols-outlined text-5xl text-primary">home</span>
                            </div>
                            <h2 class="text-2xl font-bold text-slate-900 mb-2">Aucune colocation active</h2>
                            <p class="text-slate-500 mb-6">Commencez par créer votre première colocation pour gérer vos dépenses partagées.</p>
                        </div>
                        <button onclick="openModal()"
                            class="inline-flex items-center justify-center px-6 py-3 border border-transparent text-base font-medium rounded-lg shadow-sm text-white bg-primary hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary transition-colors">
                            <span class="material-symbols-outlined mr-2">add</span>
                            Créez votre colocation
                        </button>
                    </div>
                </div>
            @endif
    <script>
        function openInviteModal() {
            let modal = document.getElementById('invite-modal');
            modal.classList.remove('hidden');
            modal.classList.add('flex');
            document.body.style.overflow = 'hidden';
        }

        function closeInviteModal() {
            let modal = document.getElementById('invite-modal');
            modal.classList.add('hidden');
            modal.classList.remove('flex');
            document.body.style.overflow = 'auto';
        }

        document.getElementById('invite-modal')?.addEventListener('click', function (e) {
            if (e.target === this) {
                closeInviteModal();
            }
        });
    </script>
    @include('colocation.create-modal')
    @include('expense.create-modal')
    @include('category.create-modal')
</body>

</html>