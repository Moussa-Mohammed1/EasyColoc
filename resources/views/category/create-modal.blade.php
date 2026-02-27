<div id="category-modal" class="fixed inset-0 bg-slate-900/50 backdrop-blur-sm hidden items-center justify-center p-4"
    style="z-index: 9999; background-color: rgba(15, 23, 42, 0.5); width: 100vw; height: 100vh;">
    <div class="bg-white rounded-2xl shadow-2xl max-w-md w-full max-h-[90vh] overflow-y-auto relative">
        <!-- Header -->
        <div
            class="sticky top-0 bg-white border-b border-slate-200 px-6 py-4 flex items-center justify-between rounded-t-2xl">
            <h3 class="text-xl font-bold text-slate-900">Ajouter une catégorie</h3>
            <button onclick="closeCategoryModal()" class="text-slate-400 hover:text-slate-600 transition-colors">
                <span class="material-symbols-outlined">close</span>
            </button>
        </div>

        <!-- Form -->
        <form action="{{ route('categories.store') }}" method="POST" class="p-6 space-y-6">
            @csrf
            @if(isset($colocation) && $colocation)
                <input type="hidden" name="colocation_id" value="{{ $colocation->id }}">
            @endif
            
            <div>
                <label for="category_title" class="block text-sm font-medium text-slate-700 mb-2">
                    Titre de la catégorie <span class="text-danger">*</span>
                </label>
                <input type="text" id="category_title" name="title" required
                    class="w-full px-4 py-2.5 border border-slate-200 rounded-lg focus:ring-2 focus:ring-primary focus:border-primary transition-colors"
                    placeholder="Ex: Courses, Loyer, Internet...">
            </div>

            <div class="flex flex-col-reverse sm:flex-row gap-3 pt-4 border-t border-slate-200">
                <button type="button" onclick="closeCategoryModal()"
                    class="flex-1 px-4 py-2.5 border border-slate-200 text-slate-700 font-medium rounded-lg hover:bg-slate-50 transition-colors">
                    Annuler
                </button>
                <button type="submit"
                    class="flex-1 px-4 py-2.5 bg-primary text-white font-medium rounded-lg hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-primary transition-colors flex items-center justify-center gap-2">
                    <span class="material-symbols-outlined text-lg">add</span>
                    Ajouter
                </button>
            </div>
        </form>
    </div>
</div>

<script>
    function openCategoryModal() {
        let modal = document.getElementById('category-modal');
        modal.classList.remove('hidden');
        modal.classList.add('flex');
        document.body.style.overflow = 'hidden';
    }

    function closeCategoryModal() {
        let modal = document.getElementById('category-modal');
        modal.classList.add('hidden');
        modal.classList.remove('flex');
        document.body.style.overflow = 'auto';
    }

    document.getElementById('category-modal')?.addEventListener('click', function (e) {
        if (e.target === this) {
            closeCategoryModal();
        }
    });
</script>
