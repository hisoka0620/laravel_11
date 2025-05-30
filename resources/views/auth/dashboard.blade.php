@extends('layouts.dashboard')

@section('title', 'Dashboard')

@section('content')
<h1 class="text-3xl font-bold mb-6">Welcome, {{ Auth::user()->name }} 👋</h1>

<h2 class="text-2xl font-semibold mb-6">📝 Your To-Do List</h2>

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
                        $task->status === 'completed' ? 'text-green-600' :
                        ($task->status === 'in_progress' ? 'text-yellow-600' : 'text-gray-600')
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
    </div>
    @endforeach
</div>
@endif
@endsection
