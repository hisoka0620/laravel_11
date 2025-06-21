@props(['unfinishedCount'])

<div
    class="flex flex-col sm:flex-row sm:items-center bg-blue-50 border-l-4 border-blue-400 p-4 rounded mb-3 shadow-sm animate-fade-in">
    <svg class="w-6 h-6 text-blue-500 mb-2 sm:mb-0 sm:mr-3 self-center" fill="none" stroke="currentColor"
        stroke-width="2" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round"
            d="M13 16h-1v-4h-1m1-4h.01M12 2a10 10 0 1010 10A10 10 0 0012 2z" />
    </svg>
    <p class="text-blue-500 text-center sm:text-left">
        You currently have
        <span class="font-bold text-blue-700">{{ $unfinishedCount }}</span> unfinished task{{ $unfinishedCount > 1 ?
        's'
        : ''}}.
    </p>
</div>
