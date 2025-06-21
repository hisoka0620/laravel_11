<template x-if="showUrgent">
    <div class="flex flex-row border-l-4 text-yellow-600 border-yellow-500 bg-yellow-100 p-2 mb-2 rounded">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
            class="size-6 mr-2 animate-pulse">
            <path stroke-linecap="round" stroke-linejoin="round"
                d="M12 9v3.75m9-.75a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 3.75h.008v.008H12v-.008Z" />
        </svg>
        <h3 class="font-bold animate-pulse">Tasks due soon</h3>
    </div>
</template>
