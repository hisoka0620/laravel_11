<div x-data="taskCard(task, @js(csrf_token()))"
    class="task-card rounded-2xl shadow-md p-6 hover:shadow-lg border-l-4 transition flex flex-col justify-between"
    :class="taskCardClass">
    <div>
        <h3 class="text-xl font-bold text-gray-800 mb-2 break-words" :class="isCompleted ? 'line-through' : ''"
            x-text="task.title"></h3>
        <p class="text-gray-600 mb-4 break-words" :class="isCompleted ? 'line-through' : ''" x-text="task.description">
        </p>
        <div class="flex flex-col text-sm text-gray-500 mb-4 space-y-1">
            <span>Status:
                <span class="label-status font-semibold capitalize px-1 rounded" :class="statusClass"
                    x-text="statusLabel"></span>
            </span>
            <span>Priority:
                <span class="font-semibold capitalize px-1 rounded" :class="priorityClass"
                    x-text="task.priority"></span>
            </span>
            <span>Due date:
                <span class="font-semibold capitalize px-1 rounded" :class="dueDateClass"
                    x-text="formattedDueDate"></span>
            </span>
        </div>
        <x-task-card.complete-checkbox />
        <div class="flex flex-col sm:flex-row gap-2 mt-auto">
            <x-task-card.edit-button />
            <x-task-card.delete-button />
        </div>
    </div>
</div>
