@extends('layouts.dashboard')

@section('title', 'Dashboard')

@section('content')

<x-urgent-task-notifier :tasks="$tasks" />

<h1 class="text-2xl sm:text-3xl font-bold mb-6 text-center sm:text-left break-words">Welcome, {{ Auth::user()->name }}
    👋</h1>

<h2 class="text-xl sm:text-2xl font-semibold mb-3 text-center sm:text-left">📝 Your To-Do List</h2>

@php
$tasksCompleted = $tasks->isNotEmpty()
&& $completedCount > 0
&& $unfinishedCount == 0
&& $expiredCount == 0
&& $urgentTasksCount == 0
@endphp

<div class="mb-6">
    @if($tasksCompleted)
    <x-banners.completed-banner />
    @endif

    @if($unfinishedCount > 0)
    <x-banners.unfinished-banner :unfinishedCount="$unfinishedCount" />
    @endif

    @if($expiredCount > 0)
    <x-banners.expired-banner :expiredCount="$expiredCount" />
    @endif

    @if($urgentTasksCount > 0)
    <x-banners.urgent-banner :urgentTasksCount="$urgentTasksCount" />
    @endif
</div>

@if($tasks->isEmpty())
<x-banners.empty-banner class="text-center" />
<div class="flex justify-center text-center">
    <x-create-task-button>Let's create your first task!</x-create-task-button>
</div>
@else

<div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 mb-10">
    @foreach($ongoingTasks as $task)
    <x-task-card.card :task="$task" />
    @endforeach
</div>
@endif
@endsection
