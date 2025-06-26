<input x-model="filters.search" @input.debounce.500ms="updateQueryParams()" type="text" placeholder="Search tasks..."
    class="w-full border border-gray-300 rounded px-4 py-2">
