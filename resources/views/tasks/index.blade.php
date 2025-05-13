@extends('layouts.dashboard')

@section('title', 'To Do List')

@section('content')

<h1 class="text-3xl font-semibold mb-6">📝 Your To-Do List</h1>

@if($tasks->isEmpty())
<div class="bg-yellow-100 border-l-4 border-yellow-500 text-yellow-700 p-4 rounded mb-4">
    <p class="font-medium">You have no tasks yet.</p>
    <p class="text-sm mt-2">Start by creating your first task!</p>
</div>
<a href="{{ route('tasks.create') }}"
    class="inline-block bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 transition">
    + Create New Task
</a>
@else
<a href="{{ route('tasks.create') }}"
    class="inline-block bg-blue-500 text-white px-4 py-2 mb-2 rounded hover:bg-blue-600 transition">
    + Create New Task
</a>

<div x-data="filterComponent(@js($tasks))" x-init="init()" class="mb-6 space-y-2">
    <div class="flex flex-col md:flex-row gap-2 mb-4">
        <input x-model="filterSearch" @input.debounce.500ms="updateQueryParams()" type="text" placeholder="Search tasks..."
            class="w-full border border-gray-300 rounded px-4 py-2">
        <select x-model="filterStatus" @change="updateQueryParams()" class="border border-gray-300 rounded px-4 py-2 w-full md:w-48">
            <option value="">All Statuses</option>
            <option value="not_started">Not Started</option>
            <option value="completed">Completed</option>
            <option value="in_progress">In Progress</option>
            <option value="pending">Pending</option>
        </select>
        <select x-model="filterPriority" @change="updateQueryParams()" class="border border-gray-300 rounded px-4 py-2 w-full md:w-48">
            <option value="">All Priorities</option>
            <option value="none">None</option>
            <option value="low">Low</option>
            <option value="medium">Medium</option>
            <option value="high">High</option>
        </select>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-10">
        <template x-for="task in filteredTasks" :key="task.id">
            <div x-data="taskCard(task, @js(csrf_token()))" :class="isCompleted ? 'opacity-50 bg-green-50 border-green-400' : ''"
                class="task-card bg-white rounded-2xl shadow-md p-6 hover:shadow-lg border-l-4 border-blue-400 transition flex flex-col justify-between">
                <div>
                    <h3 :class="isCompleted ? 'line-through text-xl font-bold text-gray-800 mb-2' : 'text-xl font-bold text-gray-800 mb-2'"
                        x-text="task.title"></h3>
                    <p :class="isCompleted ? 'line-through text-gray-600 mb-4' : 'text-gray-600 mb-4'"
                        x-text="task.description">
                    </p>
                    <div class="flex flex-col text-sm text-gray-500 mb-4 space-y-1">
                        <span>Status:
                            <span class="label-status font-semibold capitalize" :class="statusClass"
                                x-text="statusLabel"></span>
                        </span>
                        <span>Priority:
                            <span class="font-semibold capitalize" :class="priorityClass" x-text="task.priority"></span>
                        </span>
                        <span>Due date:
                            <span class="font-semibold capitalize" x-text="formattedDueDate"></span>
                        </span>
                    </div>
                </div>

                <div class="flex flex-col mb-4">
                    <label class="inline-flex items-center">
                        <input type="checkbox" class="form-checkbox h-5 w-5 text-green-600" @change="toggleStatus"
                            :checked="isCompleted">
                        <span class="ml-2 text-sm text-gray-700" x-text="toggleLabel">
                        </span>
                    </label>
                </div>

                <div class="flex space-x-2 mt-auto">
                    <a :href="`/tasks/${id}/edit`"
                        class="bg-yellow-400 hover:bg-yellow-500 text-white px-3 py-1 rounded text-sm">
                        Edit
                    </a>
                    <form :action="`/tasks/${id}`" method="POST"
                        @submit.prevent="if (confirm('Are you sure?')) $el.submit()">
                        <input type="hidden" name="_method" value="DELETE">
                        <input type="hidden" name="_token" :value="csrfToken">
                        <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded text-sm">
                            Delete
                        </button>
                    </form>
                </div>
            </div>
        </template>
    </div>
</div>
@endif
@endsection
