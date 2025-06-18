@props(['tasks'])

<div x-data="urgentTaskNotifier(@js($tasks))" x-init="init()" class="relative">
    <!-- notification pop-up -->
    <div x-cloak x-show="show" x-transition.duration.500ms aria-live="polite"
        class="fixed bottom-2 right-2 sm:bottom-3 sm:right-3 z-50 bg-yellow-100 border border-yellow-300 text-yellow-600 px-4 py-3 sm:px-6 sm:py-4 rounded-xl shadow-lg flex flex-col sm:flex-row items-center sm:items-start space-y-2 sm:space-y-0 sm:space-x-4 max-w-xs sm:max-w-md opacity-90">
        <p class="text-center sm:text-left text-sm md:text-base">
            <span x-show="urgentCount === 1">🚨 There is a task that is due soon</span>
            <span x-show="urgentCount > 1">⏰ There are <strong x-text="urgentCount"></strong> tasks that are due
                soon</span>
        </p>
        <button @click="show = false" class="text-sm text-yellow-600 underline cursor-pointer">Close</button>
    </div>
</div>
