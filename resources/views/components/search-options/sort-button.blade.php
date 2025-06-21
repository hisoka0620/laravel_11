<button @click="toggleDueDateSort()"
    class="min-w-[48px] flex items-center gap-2 bg-white border border-gray-300 px-4 py-2 rounded hover:bg-gray-100 text-sm">
    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-600" fill="none" viewBox="0 0 24 24"
        stroke="currentColor">
        <path :d="sortByDueDateAsc ? 'M5 15l7-7 7 7' : 'M19 9l-7 7-7-7'" stroke-linecap="round" stroke-linejoin="round"
            stroke-width="2" />
    </svg>
    <span x-text="sortByDueDateAsc ? 'Due Soon → Later' : 'Due Later → Soon'"></span>
</button>
