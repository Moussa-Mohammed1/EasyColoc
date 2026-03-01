<div id="expense-modal" class="fixed inset-0 bg-slate-900/50 backdrop-blur-sm hidden items-center justify-center p-4"
    style="z-index: 9999; background-color: rgba(15, 23, 42, 0.5); width: 100vw; height: 100vh;">
    <div class="bg-white rounded-2xl shadow-2xl max-w-2xl w-full max-h-[90vh] overflow-y-auto relative">
        <!-- Header -->
        <div
            class="sticky top-0 bg-white border-b border-slate-200 px-6 py-4 flex items-center justify-between rounded-t-2xl">
            <h3 class="text-xl font-bold text-slate-900">Ajouter une dépense</h3>
            <button onclick="closeExpenseModal()" class="text-slate-400 hover:text-slate-600 transition-colors">
                <span class="material-symbols-outlined">close</span>
            </button>
        </div>

        <!-- Form -->
        <form action="{{ route('expenses.store') }}" method="POST" class="p-6 space-y-6">
            @csrf
            <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
            <div>
                <label for="title" class="block text-sm font-medium text-slate-700 mb-2">
                    Titre de la dépense <span class="text-danger">*</span>
                </label>
                <input type="text" id="title" name="title" required
                    class="w-full px-4 py-2.5 border border-slate-200 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary transition-colors"
                    placeholder="Ex: Courses du mois, Facture électricité...">
            </div>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">

                <div>
                    <label for="amount" class="block text-sm font-medium text-slate-700 mb-2">
                        Montant (€) <span class="text-danger">*</span>
                    </label>
                    <div class="relative">
                        <span
                            class="absolute inset-y-0 left-0 pl-3 flex items-center text-slate-500 pointer-events-none">€</span>
                        <input type="number" id="amount" name="amount" step="0.01" min="0" required
                            class="w-full pl-8 pr-4 py-2.5 border border-slate-200 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary transition-colors"
                            placeholder="0.00">
                    </div>
                </div>

                <div>
                    <label for="category_id" class="block text-sm font-medium text-slate-700 mb-2">
                        Catégorie <span class="text-danger">*</span>
                    </label>
                    <select id="category_id" name="category_id" required
                        class="w-full px-4 py-2.5 border border-slate-200 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary transition-colors">
                        <option value="">Sélectionner une catégorie</option>
                        @if(isset($colocation) && $colocation && $colocation->categories)
                            @foreach($colocation->categories as $category)
                                <option value="{{ $category->id }}">{{ $category->title }}</option>
                            @endforeach
                        @endif
                    </select>
                </div>
            </div>
            <div class="flex flex-col-reverse sm:flex-row gap-3 pt-4 border-t border-slate-200">
                <button type="button" onclick="closeExpenseModal()"
                    class="flex-1 px-4 py-2.5 border border-slate-200 text-slate-700 font-medium rounded-lg hover:bg-slate-50 transition-colors">
                    Annuler
                </button>
                <button type="submit"
                    class="flex-1 px-4 py-2.5 bg-primary text-white font-medium rounded-lg hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary transition-colors flex items-center justify-center gap-2">
                    <span class="material-symbols-outlined text-lg">add</span>
                    Ajouter la dépense
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    function openExpenseModal() {
        let modal = document.getElementById('expense-modal');
        modal.classList.remove('hidden');
        modal.classList.add('flex');
        document.body.style.overflow = 'hidden';
    }

    function closeExpenseModal() {
        let modal = document.getElementById('expense-modal');
        modal.classList.add('hidden');
        modal.classList.remove('flex');
        document.body.style.overflow = 'auto';
    }

    document.getElementById('expense-modal')?.addEventListener('click', function (e) {
        if (e.target === this) {
            closeExpenseModal();
        }
    });
</script>