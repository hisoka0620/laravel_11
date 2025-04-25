@extends('layouts.app')

@section('title', 'task edit')

@section('content')
<div class="max-w-xl mx-auto mt-10 bg-white p-6 rounded shadow">
    <h1 class="text-2xl font-semibold mb-6">Edit Task</h1>

    @if ($errors->any())
    <div class="mb-4 text-red-600">
        <ul class="list-disc pl-5">
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    <form action="{{ route('tasks.update', $task->id) }}" method="POST" class="space-y-4">
        @csrf
        @method('PUT')

        <div>
            <label for="title" class="block font-medium">Title</label>
            <input type="text" name="title" id="title" value="{{ old('title', $task->title) }}"
                class="w-full border border-gray-300 px-3 py-2 rounded" required>
        </div>

        <div>
            <label for="description" class="block font-medium">Description</label>
            <textarea name="description" id="description" rows="4"
                class="w-full border border-gray-300 px-3 py-2 rounded">{{ old('description', $task->description) }}</textarea>
        </div>

        <div>
            <label for="status" class="block font-medium">Status</label>
            <select name="status" id="status" class="w-full border border-gray-300 px-3 py-2 rounded">
                <option value="not_started" {{ old('status', $task->status) === 'not_started' ? 'selected' : '' }}>Not
                    Started</option>
                <option value="in_progress" {{ old('status', $task->status) === 'in_progress' ? 'selected' : '' }}>In
                    Progress</option>
                <option value="completed" {{ old('status', $task->status) === 'completed' ? 'selected' : '' }}>Completed
                </option>
            </select>
        </div>

        <div>
            <label for="priority" class="block font-medium">Priority</label>
            <select name="priority" id="priority" class="w-full border border-gray-300 px-3 py-2 rounded">
                <option value="low" {{ old('priority', $task->priority) === 'low' ? 'selected' : '' }}>Low</option>
                <option value="medium" {{ old('priority', $task->priority) === 'medium' ? 'selected' : '' }}>Medium
                </option>
                <option value="high" {{ old('priority', $task->priority) === 'high' ? 'selected' : '' }}>High</option>
            </select>
        </div>

        <div>
            <label for="due_date" class="block font-medium">Due Date</label>
            <input type="datetime-local" name="due_date" id="due_date"
                value="{{ old('due_date', optional($task->due_date)->format('Y-m-d\TH:i')) }}"
                class="w-full border border-gray-300 px-3 py-2 rounded">
        </div>

        <div class="flex justify-end space-x-4">
            <a href="{{ url()->previous() }}"
                class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-semibold px-6 py-2 rounded-lg transition duration-150">
                Cancel
            </a>
            <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 hover:cursor-pointer">
                Update
            </button>
        </div>
    </form>
</div>
@endsection
