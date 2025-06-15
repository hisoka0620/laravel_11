@extends('layouts.dashboard')

@section('title', 'To Do List')

@section('content')

<h1 class="text-3xl font-semibold mb-6">📝 Your To-Do List</h1>

@if($tasks->isEmpty())
<div class="bg-yellow-100 border-l-4 border-yellow-500 text-yellow-700 p-4 rounded mb-4">
    <p class="font-medium">You have no tasks yet.</p>
    <p class="text-sm mt-2">Start by creating your first task!</p>
</div>
<div class="flex justify-end sm:justify-start">
    <a href="{{ route('tasks.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 transition">
        + Create New Task</a>
</div>

@else
<a href="{{ route('tasks.create') }}"
    class="inline-block bg-blue-500 text-white px-4 py-2 mb-2 rounded hover:bg-blue-600 transition">
    + Create New Task
</a>

<div x-data="filterComponent(@js($tasks))" x-init="init()" class="mb-6 space-y-2">

    <div x-data="{ showFilters: false }" class="container mx-auto max-w-screen-lg">

        <!-- mobile: search + filter icon -->
        <div class="flex md:hidden gap-2 mb-2">
            <!-- search form（always display） -->
            <input x-model="filters.search" @input.debounce.500ms="updateQueryParams()" type="text"
                placeholder="Search tasks..." class="w-full border border-gray-300 rounded px-4 py-2">
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
            <select x-model="filters.status" @change="updateQueryParams()"
                class="border border-gray-300 rounded px-4 py-2">
                <option value="">All Statuses</option>
                <option value="not_started">Not Started</option>
                <option value="completed">Completed</option>
                <option value="in_progress">In Progress</option>
                <option value="pending">Pending</option>
            </select>

            <select x-model="filters.priority" @change="updateQueryParams()"
                class="border border-gray-300 rounded px-4 py-2">
                <option value="">All Priorities</option>
                <option value="none">None</option>
                <option value="low">Low</option>
                <option value="medium">Medium</option>
                <option value="high">High</option>
            </select>

            <button @click="toggleDueDateSort()"
                class="flex items-center gap-2 bg-white border border-gray-300 px-4 py-2 rounded hover:bg-gray-100 transition text-sm">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-600" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path :d="sortByDueDateAsc ? 'M5 15l7-7 7 7' : 'M19 9l-7 7-7-7'" stroke-linecap="round"
                        stroke-linejoin="round" stroke-width="2" />
                </svg>
                <span x-text="sortByDueDateAsc ? 'Due Soon → Later' : 'Due Later → Soon'"></span>
            </button>
        </div>

        <!-- md or higher: Normal search + filter -->
        <div class="hidden md:flex md:flex-col gap-y-2 mb-4">
            <input x-model="filters.search" @input.debounce.500ms="updateQueryParams()" type="text"
                placeholder="Search tasks..." class="flex-1 min-w-[200px] border border-gray-300 rounded px-4 py-2">

            <div class="flex flex-row gap-x-2">
                <select x-model="filters.status" @change="updateQueryParams()"
                    class="min-w-[36px] border border-gray-300 rounded px-4 py-2">
                    <option value="">All Statuses</option>
                    <option value="not_started">Not Started</option>
                    <option value="completed">Completed</option>
                    <option value="in_progress">In Progress</option>
                    <option value="pending">Pending</option>
                </select>

                <select x-model="filters.priority" @change="updateQueryParams()"
                    class="min-w-[36px] border border-gray-300 rounded px-4 py-2">
                    <option value="">All Priorities</option>
                    <option value="none">None</option>
                    <option value="low">Low</option>
                    <option value="medium">Medium</option>
                    <option value="high">High</option>
                </select>

                <button @click="toggleDueDateSort()"
                    class="min-w-[48px] flex items-center gap-2 bg-white border border-gray-300 px-4 py-2 rounded hover:bg-gray-100 text-sm">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-gray-600" fill="none"
                        viewBox="0 0 24 24" stroke="currentColor">
                        <path :d="sortByDueDateAsc ? 'M5 15l7-7 7 7' : 'M19 9l-7 7-7-7'" stroke-linecap="round"
                            stroke-linejoin="round" stroke-width="2" />
                    </svg>
                    <span x-text="sortByDueDateAsc ? 'Due Soon → Later' : 'Due Later → Soon'"></span>
                </button>
            </div>


        </div>
    </div>

    <!-- 🔹 Grid layout support -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-10">
        <template x-for="task in filteredAndSortedTasks" :key="task.id">
            <div x-data="taskCard(task, @js(csrf_token()))"
                class="task-card rounded-2xl shadow-md p-6 hover:shadow-lg border-l-4 transition flex flex-col justify-between"
                :class="taskCardClass">
                <div>
                    <h3 :class="isCompleted ? 'line-through text-xl font-bold text-gray-800 mb-2' : 'text-xl font-bold text-gray-800 mb-2'"
                        x-text="task.title"></h3>
                    <p :class="isCompleted ? 'line-through text-gray-600 mb-4' : 'text-gray-600 mb-4'"
                        x-text="task.description">
                    </p>
                    <div class="flex flex-col text-sm text-gray-500 mb-4 space-y-1">
                        <span>Status:
                            <span class="label-status font-semibold capitalize px-1 rounded" :class="statusClass"
                                x-text="statusLabel"></span>
                        </span>
                        <span>Priority:
                            <span class="font-semibold capitalize px-1 rounded" :class="priorityClass"
                                x-text="task.priority"></span>
                        </span>
                        <span>Due date:
                            <span class="font-semibold capitalize px-1 rounded" :class="dueDateClass"
                                x-text="formattedDueDate"></span>
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

                <!-- 🔹 Responsive support for buttons -->
                <div class="flex flex-col sm:flex-row gap-2 mt-auto">
                    <!-- Edit Button -->
                    <a :href="`/tasks/${id}/edit`"
                        class="sm:flex-1 inline-flex items-center justify-center gap-1 bg-blue-400 hover:bg-blue-500 text-white p-2 rounded-lg text-sm font-semibold transition shadow-sm hover:shadow-md text-center">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor" class="size-6">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L6.832 19.82a4.5 4.5 0 0 1-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 0 1 1.13-1.897L16.863 4.487Zm0 0L19.5 7.125" />
                        </svg> Edit
                    </a>

                    <!-- Delete Button -->
                    <form :action="`/tasks/${id}`" method="POST"
                        @submit.prevent="if (confirm('Are you sure?')) $el.submit()" class="sm:flex-1 text-center">
                        <input type="hidden" name="_method" value="DELETE">
                        <input type="hidden" name="_token" :value="csrfToken">
                        <button type="submit"
                            class="w-full inline-flex items-center justify-center gap-1 bg-red-500 hover:bg-red-600 text-white p-2 rounded-lg text-sm font-semibold transition shadow-sm hover:shadow-md cursor-pointer">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                stroke="currentColor" class="size-6">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                            </svg> Delete
                        </button>
                    </form>
                </div>
            </div>
        </template>
    </div>
</div>
@endif
@endsection
