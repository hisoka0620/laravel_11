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
        class="task-card bg-white rounded-2xl shadow-md p-6 hover:shadow-lg border-l-4 border-blue-400 transition flex flex-col justify-between {{ $task->status === 'completed' ? 'opacity-50 bg-green-50 border-green-400' : '' }}">
        <div>
            <h3
                class="task-title text-xl font-bold text-gray-800 mb-2 {{ $task->status == 'completed' ? 'line-through' : '' }}">
                {{
                $task->title }}</h3>
            <p class="task-desc text-gray-600 mb-4 {{ $task->status == 'completed' ? 'line-through' : '' }}">{{
                $task->description
                }}</p>

            <div class="flex flex-col text-sm text-gray-500 mb-4 space-y-1">
                <span>Status:
                    <span class="label-status font-semibold capitalize {{
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

        <div class="flex flex-col mb-4">
            <form action="{{ route('tasks.toggleStatusAjax', $task->id) }}" method="POST">
                @csrf
                @method('PATCH')
                <label class="inline-flex items-center">
                    <input type="checkbox" class="toggle-status form-checkbox h-5 w-5 text-green-600"
                        data-task-id="{{ $task->id }}" {{ $task->status === 'completed' ? 'checked' : '' }}>
                    <span class="status-label ml-2 text-sm text-gray-700" data-task-id="{{ $task->id }}">
                        {{ $task->status === 'completed' ? 'Mark as incomplete' : 'Mark as completed' }}
                    </span>
                </label>
            </form>
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
@endif
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.toggle-status').forEach(checkbox => {
    checkbox.addEventListener('change', function () {
    const taskId = this.dataset.taskId;

    fetch(`/tasks/${taskId}/toggle-status`, {
    method: 'PATCH',
    headers: {
    'X-CSRF-TOKEN': '{{ csrf_token() }}',
    'Accept': 'application/json',
    'Content-Type': 'application/json'
    },
    })
    .then(response => response.json())
    .then(data => {

    const label = document.querySelector(`.status-label[data-task-id="${taskId}"]`);
    if (label) {
    label.textContent = data.status === 'completed'
    ? 'Mark as incomplete'
    : 'Mark as completed';
    }

    const card = this.closest('.task-card');
    const labelStatus = card.querySelector('.label-status');
    if (card) {
    if (data.status === 'completed') {
    card.classList.add('opacity-50', 'bg-green-50', 'border-green-400');
    card.querySelectorAll('.task-title, .task-desc').forEach(el => el.classList.add('line-through'));
    labelStatus.textContent = 'Completed ☑️';
    labelStatus.className = 'label-status font-semibold capitalize bg-green-100 text-green-700';
    } else {
    card.classList.remove('opacity-50', 'bg-green-50', 'border-green-400');
    card.querySelectorAll('.task-title, .task-desc').forEach(el => el.classList.remove('line-through'));
    labelStatus.textContent = 'In progress';
    labelStatus.className = 'label-status font-semibold capitalize bg-yellow-100 text-yellow-700';
    }
    }
    })
    .catch(error => {
    console.error('Error:', error);
    alert('Failed to update task status.');
    this.checked = !this.checked;
    });
    });
    });
    });
</script>
@endpush
