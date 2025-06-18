@extends('layouts.dashboard')

@section('title', 'Dashboard')

@section('content')

<x-urgent-task-notifier :tasks="$tasks" />

<h1 class="text-2xl sm:text-3xl font-bold mb-6 text-center sm:text-left break-words">Welcome, {{ Auth::user()->name }}
    👋</h1>

<h2 class="text-xl sm:text-2xl font-semibold mb-3 text-center sm:text-left">📝 Your To-Do List</h2>

<div class="mb-6">
    @if($tasks->isNotEmpty() && $completedCount > 0 && $unfinishedCount == 0 && $expiredCount == 0 && $urgentTasksCount
    ==
    0)
    <x-banner.task-complete />
    @endif

    @if($unfinishedCount > 0)
    <x-banner.unfinished-task :unfinishedCount="$unfinishedCount"/>
    @endif

    @if($expiredCount > 0)
    <x-banner.expired-task :expiredCount="$expiredCount"/>
    @endif

    @if($urgentTasksCount > 0)
    <x-banner.urgent-task :urgentTasksCount="$urgentTasksCount"/>
    @endif
</div>

@if($tasks->isEmpty())
<div class="bg-yellow-100 border-l-4 border-yellow-500 text-yellow-700 p-4 rounded mb-4">
    <p class="font-medium text-center">You have no tasks yet.</p>
    <p class="text-sm mt-2 text-center">Start by creating your first task!</p>
</div>
<div class="flex justify-center text-center">
    <a href="{{ route('tasks.create') }}"
        class="inline-block bg-blue-500 text-white px-6 py-2 rounded hover:bg-blue-600 transition">
        Let's create your first task!
    </a>
</div>
@else
<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mb-10">
    @foreach($tasks as $task)
    @if($task->status !== 'completed' && ($task->due_date === NULL || $task->due_date >= $now ))
    <div x-data="taskCard(@js($task))" x-init="init()" x-cloak
        class="taskCard bg-white rounded-2xl shadow-md p-6 hover:shadow-lg border-l-4 transition flex flex-col justify-between"
        :class="showUrgent ? 'border-yellow-500' : 'border-blue-400'">
        <div>
            <template x-if="showUrgent">
                <div class="flex flex-row border-l-4 text-yellow-600 border-yellow-500 bg-yellow-100 p-2 mb-2 rounded">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="size-6 mr-2 animate-pulse">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M12 9v3.75m9-.75a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 3.75h.008v.008H12v-.008Z" />
                    </svg>
                    <h3 class="font-bold animate-pulse">Tasks due soon</h3>
                </div>
            </template>
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
    @endif
    @endforeach
</div>
@endif
@endsection
