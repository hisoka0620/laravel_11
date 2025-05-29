@extends('layouts.dashboard')

@section('title', 'Dashboard')

@section('content')

<div x-data="urgentTaskNotifier(@js($tasks))" x-init="init()" class="relative">
    <!-- notification pop-up -->
    <div x-show="show" x-transition.duration.500ms
        class="fixed bottom-6 right-6 bg-red-100 border border-red-300 text-red-800 px-6 py-4 rounded-xl shadow-lg flex flex-row">
        <p x-show="urgentCount === 1">There is a task that is due soon</p>
        <p x-show="urgentCount !== 1">⏰ There are <strong x-text="urgentCount"></strong> tasks that are due soon</p>
        <button @click="show = false" class="ml-4 text-sm text-red-600 underline">close</button>
    </div>
</div>

<h1 class="text-3xl font-bold mb-6">Welcome, {{ Auth::user()->name }} 👋</h1>

<h2 class="text-2xl font-semibold mb-6">📝 Your To-Do List</h2>

@if($unfinishedCount > 0)
<div
    class="flex flex-col sm:flex-row sm:items-center bg-blue-50 border-l-4 border-blue-400 p-4 rounded mb-3 shadow-sm animate-fade-in">
    <svg class="w-6 h-6 text-blue-500 mb-2 sm:mb-0 sm:mr-3" fill="none" stroke="currentColor" stroke-width="2"
        viewBox="0 0 24 24">
        <path stroke-linecap="round" stroke-linejoin="round"
            d="M13 16h-1v-4h-1m1-4h.01M12 2a10 10 0 1010 10A10 10 0 0012 2z" />
    </svg>
    <p class="text-gray-700 text-sm text-center sm:text-left">
        You currently have
        @if($unfinishedCount === 1)
        a unfinished task.
        @elseif($unfinishedCount > 1)
        <span class="font-bold text-blue-600">
            {{ $unfinishedCount }}
        </span>
        unfinished task{{ $unfinishedCount === 1 ? '' : 's' }}.
        @endif
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

@if($urgentTasksCount > 0)
<div
    class="flex flex-col sm:flex-row sm:items-center bg-red-50 border-l-4 border-red-500 p-4 rounded mb-6 shadow-sm animate-fade-in">
    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
        class="w-6 h-6 text-red-600 mb-2 sm:mb-0 sm:mr-3">
        <path stroke-linecap="round" stroke-linejoin="round"
            d="M12 9v3.75m9-.75a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 3.75h.008v.008H12v-.008Z" />
    </svg>
    <p class="text-red-600 text-sm text-center sm:text-left">
        @if($urgentTasksCount === 1)
        There is a task that are due soon!
        @elseif($urgentTasksCount > 1 )
        There are <span class="font-bold">{{ $urgentTasksCount }}</span> tasks that are due soon!
        @endif
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
    @if($task->status !== 'completed' && $task->due_date >= Carbon\Carbon::now())
    <div x-data="taskCard(@js($task))"
        class="taskCard bg-white rounded-2xl shadow-md p-6 hover:shadow-lg border-l-4 border-blue-400 transition flex flex-col justify-between {{ $task->due_date >= $now && $task->due_date <= $tomorrow ? 'border-red-500' : '' }}">
        <div>
            <div x-show="isTasksDueSoon" class="border-l-4 border-red-500 bg-red-50 p-2 mb-2 rounded">
                <h3 class="text-red-700 font-bold animate-pulse">🔥 Tasks due soon</h3>
            </div>
            <h3 class="text-xl font-bold text-gray-800 mb-2">{{
                $task->title }}</h3>
            <p class="text-gray-600 mb-4">{{ $task->description
                }}</p>

            <div class="flex flex-col text-sm text-gray-500 mb-4 space-y-1">
                <span>Status:
                    <span class="p-1 rounded text-sm font-semibold bg-blue-100 text-blue-800 capitalize {{
                        $task->status === 'in_progress' ? 'bg-yellow-100  text-yellow-600' : ($task->status === 'pending' ? 'bg-orange-100 text-orange-500' : 'bg-gray-100 text-gray-700')
                    }}">
                        {{ ucfirst(str_replace('_', ' ', $task->status)) }}
                    </span>
                </span>
                <span>Priority:
                    <span
                        class="font-semibold capitalize border-l-4 px-2 {{ $task->priority === 'low' ? 'border-green-500 bg-green-100 text-green-700' : ($task->priority === 'medium' ? 'border-blue-500 bg-blue-100 text-blue-700' : ($task->priority === 'high' ? 'border-red-500 bg-red-100 text-red-700' : 'border-gray-300 bg-gray-100')) }}">{{
                        $task->priority }}</span>
                </span>
                <span>Due date:
                    <span
                        class="font-semibold capitalize p-1 rounded text-sm {{ $task->due_date >= $now && $task->due_date <= $tomorrow ? 'text-yellow-600 bg-yellow-100' : '' }}">{{
                        $task->due_date ? $task->due_date->format('Y-m-d D H:i') : 'No due date' }}</span>
                </span>
            </div>
        </div>
    </div>
    @endif
    @endforeach
</div>
@endif
@endsection
