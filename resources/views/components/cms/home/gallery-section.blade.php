<div x-data="galleryFunction()" x-init="init()" class="grid grid-cols-1 gap-8 xl:grid-cols-[minmax(0,1.1fr)_420px]">
    <form action="{{ route('gallery.save') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="school_id" value="{{ SchoolLogin()->id }}">
        <div class="rounded-3xl border border-primary-800/10 bg-white shadow-sm">
            <div class="border-b border-primary-800/10 px-6 py-5 sm:px-8">
                <h2 class="text-xl font-semibold text-gray-800">Gallery Cards Management</h2>
                <p class="mt-2 text-sm text-gray-500">
                    Edit the four fixed homepage gallery cards shown below the hero banner.
                </p>
            </div>

            <div class="p-6 sm:p-8">
                <div class="rounded-3xl border border-primary-800/10 bg-gray-50 p-5 sm:p-6">
                    <div class="mb-5 flex items-center justify-between">
                        <div>
                            <h3 class="text-lg font-semibold text-gray-800">Card Editor</h3>
                            <p class="mt-1 text-sm text-gray-500">Update the selected homepage gallery card.</p>
                        </div>
                        <span class="rounded-full bg-primary-900/10 px-3 py-1 text-xs font-medium text-primary-900">
                            Editing <span x-text="cards[selectedIndex].title"></span>
                        </span>
                    </div>

                    <div class="grid grid-cols-1 gap-6 lg:grid-cols-[280px_minmax(0,1fr)]">
                        <div
                            class="rounded-2xl border border-dashed border-primary-800/20 bg-primary-900/5 p-5 transition hover:border-primary-700 hover:bg-primary-900/10">
                            <label for="gallery_card_image" class="mb-2 block text-sm font-medium text-gray-700">
                                Gallery Image
                            </label>

                            <div class="overflow-hidden rounded-2xl border border-primary-800/10 bg-white shadow-sm">
                                <img :src="form.image" alt="Gallery card preview" class="h-56 w-full object-cover">
                            </div>

                            <p class="mt-4 text-sm font-medium text-gray-700">Preview</p>
                            <p class="mt-2 text-sm leading-6 text-gray-500">
                                Update the image URL or integrate file upload handling for this fixed card slot.
                            </p>

                            <input x-model="form.image" type="file" name="gallery_card_image"
                                placeholder="Paste image URL"
                                class="mt-4 block w-full rounded-xl border border-primary-800/20 bg-white px-4 py-3 text-sm text-gray-700 shadow-sm transition placeholder:text-gray-400 focus:border-primary-700 focus:outline-none focus:ring-2 focus:ring-primary-800/20">
                        </div>

                        <div class="space-y-5">
                            <div>
                                <label for="gallery_card_title"
                                    class="mb-2 block text-sm font-medium text-gray-700">Title</label>
                                <input x-model="form.title" type="text" name="gallery_card_title"
                                    class="w-full rounded-xl border border-primary-800/15 bg-white px-4 py-3 text-sm text-gray-700 shadow-sm transition placeholder:text-gray-400 focus:border-primary-700 focus:outline-none focus:ring-2 focus:ring-primary-800/20">
                            </div>

                            <div>
                                <label for="gallery_card_subtitle" class="mb-2 block text-sm font-medium text-gray-700">
                                    Subtitle / Description
                                </label>
                                <textarea x-model="form.subtitle" rows="5" name="gallery_card_subtitle"
                                    class="w-full rounded-xl border border-primary-800/15 bg-white px-4 py-3 text-sm leading-6 text-gray-700 shadow-sm transition placeholder:text-gray-400 focus:border-primary-700 focus:outline-none focus:ring-2 focus:ring-primary-800/20"></textarea>
                            </div>

                            <div class="flex justify-end">
                                <button type="submit" @click="saveCard()"
                                    class="inline-flex items-center justify-center gap-2 rounded-xl bg-primary-900 px-4 py-2.5 text-sm font-medium text-white shadow-sm transition hover:bg-primary-800 hover:shadow-md">
                                    <i class="fa-solid fa-floppy-disk text-xs"></i>
                                    Save
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mt-8 border-t border-primary-800/10 pt-8">
                    <div class="mb-5 flex items-center justify-between">
                        <div>
                            <h3 class="text-lg font-semibold text-gray-800">Homepage Gallery Cards</h3>
                            <p class="mt-1 text-sm text-gray-500">Exactly four fixed cards are available for editing.
                            </p>
                        </div>
                        <span class="rounded-full bg-primary-900/10 px-3 py-1 text-xs font-medium text-primary-900">4
                            Cards</span>
                    </div>

                    <div class="grid grid-cols-1 gap-5 md:grid-cols-2">
                        <template x-for="(card, index) in cards" :key="index">
                            <div @click="selectCard(index)"
                                :class="selectedIndex === index ? 'ring-2 ring-primary-700 scale-[1.02]' : ''"
                                class="cursor-pointer transition-all duration-300 ease-in-out group overflow-hidden rounded-3xl border border-primary-800/10 bg-white shadow-sm hover:-translate-y-1 hover:shadow-xl">

                                <div class="relative overflow-hidden">
                                    <img :src="card.image || 'https://via.placeholder.com/400x300?text=No+Image'"
                                        :alt="card.title"
                                        class="h-56 w-full object-cover transition duration-300 group-hover:scale-105">

                                    <div
                                        class="absolute inset-0 bg-gradient-to-t from-black/70 via-black/20 to-transparent">
                                    </div>

                                    <div
                                        class="absolute left-4 top-4 rounded-full bg-white/90 px-3 py-1 text-xs font-medium text-primary-900">
                                        Fixed Card
                                    </div>

                                    <div
                                        class="absolute right-4 top-4 rounded-full bg-black/70 px-2 py-1 text-xs text-white">
                                        Card <span x-text="index + 1"></span>
                                    </div>
                                </div>

                                <div class="p-5">
                                    <h4 class="text-lg font-semibold text-gray-800" x-text="card.title"></h4>
                                    <p class="mt-2 text-sm leading-6 text-gray-500" x-text="card.subtitle"></p>

                                    <div class="mt-5 flex items-center gap-3">

                                        <!-- ✏️ EDIT BUTTON -->
                                        <a :href="`{{ url('school/gallery/edit') }}/${index}`"
                                            class="inline-flex items-center gap-2 rounded-lg px-3 py-2 text-xs font-medium border border-primary-800/20 bg-white text-primary-900 hover:border-primary-700 hover:bg-primary-900/5">

                                            <i class="fa-solid fa-pen text-[10px]"></i>
                                            Edit
                                        </a>

                                        <!-- 🗑 DELETE BUTTON -->
                                        <form action="{{ route('gallery.delete') }}" method="POST"
                                            onsubmit="return confirm('Are you sure?')">
                                            @csrf
                                            @method('DELETE')

                                            <!-- IMPORTANT -->
                                            <input type="hidden" name="school_id" value="{{ SchoolLogin()->id }}">
                                            <input type="hidden" name="index" :value="index">

                                            <button type="submit"
                                                class="inline-flex items-center gap-2 rounded-lg border border-red-200 bg-white px-3 py-2 text-xs font-medium text-red-600 hover:bg-red-50 hover:border-red-400">

                                                <i class="fa-solid fa-trash text-[10px]"></i>
                                                Delete
                                            </button>
                                        </form>

                                    </div>
                                </div>
                            </div>
                        </template>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <!-- MODAL -->
    <div x-show="isModalOpen" x-transition class="fixed inset-0 z-50 flex items-center justify-center bg-black/50">

        <div @click.outside="closeModal()" class="w-full max-w-lg rounded-2xl bg-white p-6 shadow-xl">

            <h2 class="text-lg font-semibold text-gray-800 mb-4">
                Edit Card
            </h2>

            <!-- Image -->
            <div class="mb-4">
                <img :src="form.image || 'https://via.placeholder.com/400x300'"
                    class="h-40 w-full object-cover rounded-lg mb-2">

                <input type="file" @change="handleImage($event)" class="w-full border rounded-lg p-2 text-sm">
            </div>

            <!-- Title -->
            <input type="text" x-model="form.title" class="w-full mb-3 rounded-lg border p-2 text-sm"
                placeholder="Title">

            <!-- Subtitle -->
            <textarea x-model="form.subtitle" class="w-full mb-4 rounded-lg border p-2 text-sm" placeholder="Subtitle"></textarea>

            <!-- Buttons -->
            <div class="flex justify-end gap-2">
                <button @click="closeModal()" class="px-4 py-2 text-sm bg-gray-200 rounded-lg">
                    Cancel
                </button>

                <button @click="saveModal()" class="px-4 py-2 text-sm bg-primary-900 text-white rounded-lg">
                    Save
                </button>
            </div>

        </div>
    </div>

    <div class="rounded-3xl border border-primary-800/10 bg-white p-6 shadow-sm">
        <div class="flex items-center justify-between">
            <div>
                <h2 class="text-lg font-semibold text-gray-800">Live Preview</h2>
                <p class="mt-1 text-sm text-gray-500">Homepage gallery cards appearance.</p>
            </div>
            <span class="rounded-full bg-primary-900 px-3 py-1 text-xs font-medium text-white">Gallery</span>
        </div>

        <div class="mt-6 space-y-4">
            <template x-for="(card, index) in cards" :key="'preview-' + index">
                <div @click="selectCard(index)" :class="selectedIndex === index ? 'ring-2 ring-primary-700' : ''"
                    class="cursor-pointer group overflow-hidden rounded-2xl border border-primary-800/10 bg-white shadow-sm transition duration-300 hover:shadow-lg hover:scale-[1.01]">

                    <div class="grid grid-cols-[120px_minmax(0,1fr)]">

                        <div class="overflow-hidden">
                            <img :src="card.image || 'https://via.placeholder.com/300x200?text=No+Image'"
                                :alt="card.title"
                                class="h-full min-h-[120px] w-full object-cover transition duration-300 group-hover:scale-105">
                        </div>

                        <div class="flex flex-col justify-center p-4">
                            <h3 class="text-base font-semibold text-gray-800" x-text="card.title"></h3>
                            <p class="mt-2 text-sm leading-6 text-gray-500" x-text="card.subtitle"></p>
                        </div>

                    </div>
                </div>
            </template>
        </div>

        <div class="mt-6 rounded-2xl border border-primary-800/10 bg-primary-900/5 p-4">
            <p class="text-sm font-medium text-gray-700">Section Note</p>
            <p class="mt-2 text-sm leading-6 text-gray-500">
                Maintain clear titles and short supporting text so all four homepage cards remain balanced and readable.
            </p>
        </div>
    </div>
</div>

<script>
    function galleryFunction() {
        return {
            cards: [],
            selectedIndex: 0,

            init() {
                let raw = @json($gallery ?? '[]');

                console.log("RAW DATA:", raw);

                try {
                    // 🔥 Fix: agar string hai to parse karo
                    let parsed = typeof raw === 'string' ? JSON.parse(raw) : raw;

                    console.log("PARSED:", parsed);

                    // 🔥 Fix: agar object hai to array banao
                    if (!Array.isArray(parsed)) {
                        parsed = [parsed];
                    }

                    // 🔥 Fix: mapping correct keys
                    this.cards = parsed.slice(0, 4).map(item => ({
                        image: item.gallery_card_image ?
                            '/' + item.gallery_card_image : 'https://via.placeholder.com/400x300',
                        title: item.gallery_card_title || 'No Title',
                        subtitle: item.gallery_card_subtitle || 'No Description'
                    }));

                    console.log("FINAL CARDS:", this.cards);

                } catch (e) {
                    console.error("ERROR:", e);
                    this.cards = [];
                }
            },

            selectCard(index) {
                this.selectedIndex = index;
            }
        }
    }
</script>