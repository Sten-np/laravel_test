<div class="Modal fixed inset-0 flex items-center justify-center z-50 hidden">
    <div class="modal-overlay absolute inset-0 bg-gray-900 opacity-50"></div>
    <div class="modal-content bg-white p-4 rounded-lg shadow-md z-10 w-96">
        <div class="flex justify-between items-center mb-4">
            <h2 class="text-lg font-semibold">Create a new category</h2>
            <button class="text-gray-700 hover:text-gray-900 focus:outline-none">
                <svg id="closeModal" class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                     xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>
        @error('name')
        <div class="text-red-500 text-xs">{{ $message }}</div>
        @enderror
        <div class="mb-4">
{{--            <form id="createcategory" action="{{ route('category.store') }}" method="POST">--}}
{{--                @csrf--}}
                <label for="name" class="block text-sm font-medium text-gray-700">Category name</label><br>
                <input id="catname" name="catname" type="text" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight
                focus:outline-none focus:shadow-outline" value="{{ old('name') }}" placeholder="Enter category name"
                       maxlength="255" minlength="5" required>

                <div class="flex justify-end">
                    <button id="submitcategory"
                            class="px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600 focus:outline-none focus:bg-blue-600">
                        Create
                    </button>
                </div>
{{--            </form>--}}

        </div>


    </div>
</div>
