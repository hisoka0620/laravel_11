@extends('layouts.dashboard')

@section('title', 'Dashboard')

@section('content')

<div x-data="urgentTaskNotifier(@js($tasks))" x-init="init()" class="relative">
    <!-- notification pop-up -->
    <div x-cloak x-show="show" x-transition.duration.500ms
        class="fixed bottom-2 right-2 sm:bottom-3 sm:right-3 z-50 bg-yellow-100 border border-yellow-300 text-yellow-600 px-4 py-3 sm:px-6 sm:py-4 rounded-xl shadow-lg flex flex-col sm:flex-row items-center sm:items-start space-y-2 sm:space-y-0 sm:space-x-4 max-w-xs sm:max-w-md opacity-90">
        <p class="text-center sm:text-left text-sm md:text-base">
            <span x-show="urgentCount === 1">🚨 There is a task that is due soon</span>
            <span x-show="urgentCount > 1">⏰ There are <strong x-text="urgentCount"></strong> tasks that are due
                soon</span>
        </p>
        <button @click="show = false" class="text-sm text-yellow-600 underline cursor-pointer">Close</button>
    </div>
</div>

<h1 class="text-2xl sm:text-3xl font-bold mb-6 text-center sm:text-left break-words">Welcome, {{ Auth::user()->name }}
    👋</h1>

<h2 class="text-xl sm:text-2xl font-semibold mb-3 text-center sm:text-left">📝 Your To-Do List</h2>

<div class="mb-6">
    @if($tasks->isNotEmpty() && $completedCount > 0 && $unfinishedCount == 0 && $expiredCount == 0 && $urgentTasksCount
    ==
    0)
    <div
        class="flex flex-col sm:flex-row sm:items-center bg-green-50 border-l-4 border-green-400 p-4 rounded mb-6 shadow-sm animate-fade-in">
        <svg class="w-6 h-6 text-green-500 mr-3" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" d="M5 13l4 4L19 7" />
        </svg>
        <p class="text-green-700 font-semibold text-center sm:text-left">
            All tasks completed! 🎉 Great job!
        </p>
    </div>
    @endif

    @if($unfinishedCount > 0)
    <div
        class="flex flex-col sm:flex-row sm:items-center bg-blue-50 border-l-4 border-blue-400 p-4 rounded mb-3 shadow-sm animate-fade-in">
        <svg class="w-6 h-6 text-blue-500 mb-2 sm:mb-0 sm:mr-3 self-center" fill="none" stroke="currentColor"
            stroke-width="2" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round"
                d="M13 16h-1v-4h-1m1-4h.01M12 2a10 10 0 1010 10A10 10 0 0012 2z" />
        </svg>
        <p class="text-blue-500 text-center sm:text-left">
            You currently have
            <span class="font-bold text-blue-700">{{ $unfinishedCount }}</span> unfinished task{{ $unfinishedCount > 1 ?
            's'
            : ''}}.
        </p>
    </div>
    @endif

    @if($expiredCount > 0)
    <div
        class="flex flex-col sm:flex-row sm:items-center sm:gap-4 bg-rose-50 border-l-4 border-rose-500 text-rose-800 p-4 mb-3 rounded shadow-md animate-fade-in">

        {{-- icon --}}
        <div class="flex justify-center sm:justify-start mb-2 sm:mb-0">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-rose-500 flex-shrink-0" fill="none"
                viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round"
                    d="M12 9v3m0 4h.01M4.93 4.93l14.14 14.14M12 2a10 10 0 100 20 10 10 0 000-20z" />
            </svg>
        </div>

        {{-- message & link container --}}
        <div class="flex flex-col sm:flex-row items-center sm:items-end justify-between w-full sm:flex-grow">

            {{-- message text --}}
            <div class="text-center sm:text-left">
                <p class="sm:text-base">
                    You currently have <strong>{{ $expiredCount }}</strong> overdue {{ Str::plural('task',
                    $expiredCount)
                    }}.
                </p>
                <p class="text-xs text-rose-600 mt-1 md:mt-0">
                    Please review and update them as soon as possible.
                </p>
            </div>

            <a href="{{ route('tasks.index') }}"
                class="font-bold text-sm text-rose-500 hover:text-white hover:bg-rose-500 transition mt-4 md:mt-0 px-2 py-1 border border-rose-500 rounded-xl flex-shrink-0 sm:animate-bounce">Go
                to
                check</a>
        </div>
    </div>
    @endif

    @if($urgentTasksCount > 0)
    <div
        class="flex flex-col sm:flex-row sm:items-center text-yellow-600 bg-yellow-100 border-l-4 border-yellow-500 p-4 rounded shadow-sm animate-fade-in">
        <svg class="w-6 h-6 mb-2 sm:mb-0 sm:mr-3 self-center flex-shrink-0" fill="none" stroke="currentColor"
            stroke-width="1.5" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round"
                d="M12 9v3.75m9-.75a9 9 0 1 1-18 0 9 9 0 0 1 18 0Zm-9 3.75h.008v.008H12v-.008Z" />
        </svg>
        <p class="text-center sm:text-left flex-shrink-0">
            You currently have <span class="font-bold">{{ $urgentTasksCount }}</span> task{{ $urgentTasksCount > 1 ? 's'
            :
            '' }} that are due soon!
        </p>
        <div class="w-full flex justify-center sm:justify-end">
            <a href="{{ route('tasks.index') }}"
                class="font-bold text-sm hover:text-white hover:bg-yellow-500 transition mt-4 md:mt-0 px-2 py-1 border border-yellow-600 rounded-xl flex-shrink-0 sm:animate-bounce">Go
                to
                check</a>
        </div>
    </div>
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
