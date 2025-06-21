@props(['task'])

<div x-data="taskCard(@js($task))" x-init="init()" x-cloak
    class="taskCard bg-white rounded-2xl shadow-md p-6 hover:shadow-lg border-l-4 transition flex flex-col justify-between"
    :class="showUrgent ? 'border-yellow-500' : 'border-blue-400'">
    <div>
        <x-task-card.urgent-banner />
        <h3 class="text-lg sm:text-xl font-bold text-gray-800 mb-2 break-words">{{ $task->title }}</h3>
        <p class="text-gray-600 mb-4 break-words">{{ $task->description }}</p>

        <div class="flex flex-col text-sm text-gray-500 mb-4 space-y-1">
            <span>Status:
                <span class="px-1 rounded text-sm font-semibold bg-blue-100 text-blue-800 capitalize"
                    :class="statusClass" x-text="statusLabel">
                </span>
            </span>
            <span>Priority:
                <span class="font-semibold capitalize px-1 rounded text-sm" :class="priorityClass">{{
                    $task->priority }}</span>
            </span>
            <span>Due date:
                <span class="font-semibold capitalize px-1 rounded text-sm" :class="dueDateClass"
                    x-text="formattedDueDate"></span>
            </span>
        </div>
    </div>
</div>
