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
    class="inline-block bg-blue-500 text-white px-4 py-2 mb-6 ml-1 rounded hover:bg-blue-600 transition">
    + Create New Task
</a>

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-10">
    @foreach($tasks as $task)
    <div
        class="bg-white rounded-2xl shadow-md p-6 hover:shadow-lg border-l-4 border-blue-400 transition flex flex-col justify-between">
        <div>
            <h3 class="text-xl font-bold text-gray-800 mb-2">{{ $task->title }}</h3>
            <p class="text-gray-600 mb-4">{{ $task->description }}</p>

            <div class="flex flex-col text-sm text-gray-500 mb-4 space-y-1">
                <span>Status:
                    <span class="font-semibold capitalize {{
                        $task->status === 'completed' ? 'text-blue-600' :
                        ($task->status === 'in_progress' ? 'text-yellow-600' : 'text-gray-400')
                    }}">
                        {{ str_replace('_', ' ', $task->status) }}
                    </span>
                </span>
                <span>Priority:
                    <span
                        class="font-semibold capitalize {{ $task->priority === 'low' ? 'text-blue-600' : ($task->priority === 'medium' ? 'text-green-500' : 'text-red-600') }}">{{
                        $task->priority }}</span>
                </span>
                <span>Due date:
                    <span>{{ $task->due_date ? $task->due_date->format('F j, Y H:i') : 'No due date' }}</span>
                </span>
            </div>
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
                <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded text-sm">
                    Delete
                </button>
            </form>
        </div>
    </div>
    @endforeach
</div>
@endif
@endsection
