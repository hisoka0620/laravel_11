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

<div x-data="{ searchText: '', filterStatus: '', filterPriority: '' }" class="mb-6 space-y-2">
    <div class="flex flex-col md:flex-row gap-2 mb-4">
        <input x-model="searchText" type="text" placeholder="Search tasks..."
            class="w-full border border-gray-300 rounded px-4 py-2">
        <select x-model="filterStatus" class="border border-gray-300 rounded px-4 py-2 w-full md:w-48">
            <option value="">All Statuses</option>
            <option value="not_started">Not Started</option>
            <option value="completed">Completed</option>
            <option value="in_progress">In Progress</option>
            <option value="pending">Pending</option>
        </select>
        <select x-model="filterPriority" class="border border-gray-300 rounded px-4 py-2 w-full md:w-48">
            <option value="">All Priorities</option>
            <option value="low">Low</option>
            <option value="medium">Medium</option>
            <option value="high">High</option>
        </select>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-10">
        @foreach($tasks as $task)
        <div x-data="taskCard({
        id: {{ $task->id }},
        status: '{{ $task->status }}',
        previousStatus: '{{ $task->previous_status }}',
        priority: '{{ $task->priority }}',
        title: @js($task->title),
        description: @js($task->description), })" x-show="(title.toLowerCase().includes(searchText.toLowerCase()) || description.toLowerCase().includes(searchText.toLowerCase()))
        && (!filterStatus || filterStatus === '{{ $task->status }}')
        && (!filterPriority || filterPriority === '{{ $task->priority }}')"
            :class="isCompleted ? 'opacity-50 bg-green-50 border-green-400' : ''"
            class="task-card bg-white rounded-2xl shadow-md p-6 hover:shadow-lg border-l-4 border-blue-400 transition flex flex-col justify-between">
            <div>
                <h3 :class="isCompleted ? 'line-through text-xl font-bold text-gray-800 mb-2' : 'text-xl font-bold text-gray-800 mb-2'"
                    x-text="title"></h3>
                <p :class="isCompleted ? 'line-through text-gray-600 mb-4' : 'text-gray-600 mb-4'" x-text="description">
                </p>
                <div class="flex flex-col text-sm text-gray-500 mb-4 space-y-1">
                    <span>Status:
                        <span class="label-status font-semibold capitalize" :class="statusClass"
                            x-text="statusLabel"></span>
                    </span>
                    <span>Priority:
                        <span
                            class="font-semibold capitalize {{ $task->priority === 'low' ? 'text-blue-600' : ($task->priority === 'medium' ? 'text-green-500' : ($task->priority === 'high' ? 'text-red-600' : 'text-gray-700')) }}">{{
                            $task->priority }}</span>
                    </span>
                    <span>Due date:
                        <span>{{ $task->due_date ? $task->due_date->format('F j, Y H:i') : 'No due date' }}</span>
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
                <a href="{{ route('tasks.edit', $task->id) }}"
                    class="bg-yellow-400 hover:bg-yellow-500 text-white px-3 py-1 rounded text-sm">
                    Edit
                </a>
                <form action="{{ route('tasks.destroy', $task->id) }}" method="POST"
                    onsubmit="return confirm('Are you sure you want to delete this task?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                        class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded text-sm hover:cursor-pointer">
                        Delete
                    </button>
                </form>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endif
@endsection
