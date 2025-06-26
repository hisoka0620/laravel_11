@extends('layouts.dashboard')

@section('title', 'To Do List')

@section('content')

<h1 class="text-3xl font-semibold mb-6">📝 Your To-Do List</h1>

@if($tasks->isEmpty())
<x-banners.empty-banner />
<x-create-task-button>+ Create New Task</x-create-task-button>
@else
<x-create-task-button>+ Create New Task</x-create-task-button>
<div x-data="filterComponent(@js($tasks))" x-init="init()" class="mb-6 space-y-2">

    <div x-data="{ showFilters: false }" class="container mx-auto max-w-screen-lg">
        <!-- mobile: search + filter icon -->
        <div class="flex md:hidden gap-2 mb-2">
            <!-- search form（always display） -->
            <x-search-options.search />
            <!-- filter icon -->
            <button @click="showFilters = !showFilters" class="p-2 border border-gray-300 rounded hover:bg-gray-100">
                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                    stroke="currentColor" class="size-6">
                    <path stroke-linecap="round" stroke-linejoin="round"
                        d="M6.75 12a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0ZM12.75 12a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0ZM18.75 12a.75.75 0 1 1-1.5 0 .75.75 0 0 1 1.5 0Z" />
                </svg>
            </button>
        </div>

        <!-- mobile: Filter item (open/close) -->
        <div x-show="showFilters" x-transition class="flex flex-col gap-2 mb-4 md:hidden">
            <x-search-options.status-filter />
            <x-search-options.priority-filter />
            <x-search-options.sort-button />
        </div>

        <!-- md or higher: Normal search + filter -->
        <div class="hidden md:flex md:flex-col gap-y-2 mb-4">
            <x-search-options.search />
            <div class="flex flex-row gap-x-2">
                <x-search-options.status-filter />
                <x-search-options.priority-filter />
                <x-search-options.sort-button />
            </div>
        </div>
    </div>

    <!-- 🔹 Grid layout support -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-10">
        <template x-for="task in filteredAndSortedTasks" :key="task.id">
            <div class="h-full">
                @include('components.task-card')
            </div>
        </template>
    </div>
</div>
@endif
@endsection
