@props(['expiredCount'])

<div
    class="flex flex-col sm:flex-row sm:items-center sm:gap-4 bg-rose-50 border-l-4 border-rose-500 text-rose-800 p-4 mb-3 rounded shadow-md animate-fade-in">

    {{-- icon --}}
    <div class="flex justify-center sm:justify-start mb-2 sm:mb-0">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-rose-500 flex-shrink-0" fill="none"
            viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
            <path stroke-linecap="round" stroke-linejoin="round"
                d="M12 9v3m0 4h.01M4.93 4.93l14.14 14.14M12 2a10 10 0 100 20 10 10 0 000-20z" />
        </svg>
    </div>

    {{-- message & link container --}}
    <div class="flex flex-col sm:flex-row items-center sm:items-end justify-between w-full sm:flex-grow">

        {{-- message text --}}
        <div class="text-center sm:text-left">
            <p class="sm:text-base">
                You currently have <strong>{{ $expiredCount }}</strong> overdue {{ Str::plural('task',
                $expiredCount)
                }}.
            </p>
            <p class="text-xs text-rose-600 mt-1 md:mt-0">
                Please review and update them as soon as possible.
            </p>
        </div>

        <a href="{{ route('tasks.index') }}"
            class="font-bold text-sm text-rose-500 hover:text-white hover:bg-rose-500 transition mt-4 md:mt-0 px-2 py-1 border border-rose-500 rounded-xl flex-shrink-0 sm:animate-bounce">Go
            to
            check</a>
    </div>
</div>
