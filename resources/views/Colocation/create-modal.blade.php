<div class="create-colocation inset-0 fixed backdrop-blur-lg z-50 hidden">
    <div class="flex justify-center">
        <div
            class="w-full max-w-[560px] bg-white dark:bg-slate-900 rounded-xl shadow-sm border border-slate-200 dark:border-slate-800 overflow-hidden">
            <div class="p-8 border-b border-slate-100 dark:border-slate-800">
                <h1 class="text-slate-900 dark:text-slate-100 text-2xl font-bold leading-tight">Create a new colocation
                </h1>
                <p class="text-slate-500 dark:text-slate-400 text-sm mt-1">You will become the owner of this shared flat
                </p>
            </div>
            <form action="{{ route('colocations.store') }}" method="POST" class="p-8 space-y-6">
                @csrf
                <div class="space-y-2">
                    <label class="block text-slate-700 dark:text-slate-300 text-sm font-semibold">Colocation
                        Name</label>
                    <input name="name" required
                        class="flex w-full rounded-lg text-slate-900 dark:text-slate-100 border border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-800/50 focus:border-primary focus:ring-1 focus:ring-primary h-12 px-4 text-base font-normal outline-none transition-all placeholder:text-slate-400"
                        placeholder="Appartement Rue Victor Hugo" type="text" />
                </div>
                <div class="space-y-2">
                    <label class="block text-slate-700 dark:text-slate-300 text-sm font-semibold">Description
                        (Optional)</label>
                    <textarea name="description"
                        class="flex w-full rounded-lg text-slate-900 dark:text-slate-100 border border-slate-200 dark:border-slate-700 bg-slate-50 dark:bg-slate-800/50 focus:border-primary focus:ring-1 focus:ring-primary min-h-[120px] p-4 text-base font-normal outline-none transition-all placeholder:text-slate-400"
                        placeholder="Describe your shared flat..."></textarea>
                </div>

                <div class="pt-4 space-y-4 ">
                    <button type="submit"
                        class="w-full p-3 bg-primary hover:bg-primary/90 text-white font-bold h-12 rounded-lg transition-colors shadow-sm">
                        Create colocation
                    </button>
                    <div class="text-center">
                        <button type="button" onclick="closeModal()"
                            class="text-slate-500 dark:text-slate-400 hover:text-slate-700 dark:hover:text-slate-200 text-sm font-medium transition-colors">Cancel</button>
                    </div>
                </div>
                <div class="mt-8 flex items-start gap-3 p-4 rounded-lg bg-primary/5 border border-primary/10">
                    <span class="material-symbols-outlined text-primary text-xl">info</span>
                    <p class="text-sm text-slate-600 dark:text-slate-400 leading-relaxed">
                        You can invite members once the colocation is created. You will be able to share a joining link
                        or
                        invite them by email.
                    </p>
                </div>
            </form>
            <script>
                function closeModal() {
                    document.querySelector('.create-colocation').classList.add('hidden');
                }
                function openModal() {
                    document.querySelector('.create-colocation').classList.remove('hidden');
                }
            </script>
        </div>
    </div>
</div>