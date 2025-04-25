@extends('layouts.dashboard')

@section('title', 'Dashboard')

@section('content')

@php
$unfinishedCount = $tasks->where('status', '!=', 'completed')->count();
@endphp

<h1 class="text-3xl font-bold mb-6">Welcome, {{ Auth::user()->name }} 👋</h1>

<h2 class="text-2xl font-semibold mb-6">📝 Your To-Do List</h2>

@if($unfinishedCount > 0)
<div
    class="flex flex-col sm:flex-row sm:items-center bg-blue-50 border-l-4 border-blue-400 p-4 rounded mb-6 shadow-sm animate-fade-in">
    <svg class="w-6 h-6 text-blue-500 mb-2 sm:mb-0 sm:mr-3" fill="none" stroke="currentColor" stroke-width="2"
        viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round"
            d="M13 16h-1v-4h-1m1-4h.01M12 2a10 10 0 1010 10A10 10 0 0012 2z" />
    </svg>
    <p class="text-gray-700 text-sm text-center sm:text-left">
        You currently have
        <span class="font-bold text-blue-600">
            {{ $tasks->where('status', '!=', 'completed')->count() }}
        </span>
        unfinished task{{ $tasks->where('status', '!=', 'completed')->count() === 1 ? '' : 's' }}.
    </p>
</div>
@elseif($tasks->isNotEmpty() && $unfinishedCount == 0)
<div
    class="flex flex-col sm:flex-row sm:items-center bg-green-50 border-l-4 border-green-400 p-4 rounded mb-6 shadow-sm animate-fade-in">
    <svg class="w-6 h-6 text-green-500 mr-3" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
    </svg>
    <p class="text-green-700 text-sm font-semibold">
        All tasks completed! 🎉 Great job!
    </p>
</div>
@endif



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
    @if($task->status !== 'completed')
    <div
        class="bg-white rounded-2xl shadow-md p-6 hover:shadow-lg border-l-4 border-blue-400 transition flex flex-col justify-between {{ $task->status === 'completed' ? 'opacity-50 border-green-400 bg-green-50' : '' }}">
        <div>
            <h3 class="text-xl font-bold text-gray-800 mb-2 {{ $task->status == 'completed' ? 'line-through' : '' }}">{{
                $task->title }}</h3>
            <p class="text-gray-600 mb-4 {{ $task->status == 'completed' ? 'line-through' : '' }}">{{ $task->description
                }}</p>

            <div class="flex flex-col text-sm text-gray-500 mb-4 space-y-1">
                <span>Status:
                    <span class="font-semibold capitalize {{
                        $task->status === 'completed' ? 'bg-green-100 text-green-700' :
                        ($task->status === 'in_progress' ? 'bg-yellow-100 text-yellow-700' : 'bg-gray-100 text-gray-700')
                    }}">
                        {{ ucfirst(str_replace('_', ' ', $task->status)) }}
                        @if($task->status === 'completed')
                        ☑️
                        @endif
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
    @endif
    @endforeach
</div>
@endif
@endsection
