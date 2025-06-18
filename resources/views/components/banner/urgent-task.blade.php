@props(['urgentTasksCount'])

<div
    class="flex flex-col sm:flex-row sm:items-center text-yellow-600 bg-yellow-100 border-l-4 border-yellow-500 p-4 rounded shadow-sm animate-fade-in">
    <svg class="w-6 h-6 mb-2 sm:mb-0 sm:mr-3 self-center flex-shrink-0" fill="none" stroke="currentColor"
        stroke-width="1.5" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round"
            d="M12 9v3.75m9-.75a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 3.75h.008v.008H12v-.008Z" />
    </svg>
    <p class="text-center sm:text-left flex-shrink-0">
        You currently have <span class="font-bold">{{ $urgentTasksCount }}</span> task{{ $urgentTasksCount > 1 ? 's'
        :
        '' }} that are due soon!
    </p>
    <div class="w-full flex justify-center sm:justify-end">
        <a href="{{ route('tasks.index') }}"
            class="font-bold text-sm hover:text-white hover:bg-yellow-500 transition mt-4 md:mt-0 px-2 py-1 border border-yellow-600 rounded-xl flex-shrink-0 sm:animate-bounce">Go
            to
            check</a>
    </div>
</div>
