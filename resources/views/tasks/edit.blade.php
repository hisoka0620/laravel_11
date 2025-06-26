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

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <label for="status" class="block font-medium">Status</label>
                <select name="status" id="status" class="w-full border border-gray-300 px-3 py-2 rounded">
                    <option value="not_started" {{ old('status', $task->status) === 'not_started' ? 'selected' : ''
                        }}>Not
                        Started</option>
                    <option value="pending" {{ old('status', $task->status) === 'pending' ? 'selected' : '' }}>Pending
                    </option>
                    <option value="in_progress" {{ old('status', $task->status) === 'in_progress' ? 'selected' : ''
                        }}>In
                        Progress</option>
                    <option value="completed" {{ old('status', $task->status) === 'completed' ? 'selected' : ''
                        }}>Completed
                    </option>
                </select>
            </div>

            <div>
                <label for="priority" class="block font-medium">Priority</label>
                <select name="priority" id="priority" class="w-full border border-gray-300 px-3 py-2 rounded">
                    <option value="none" {{ old('priority', $task->priority) === 'none' ? 'selected' : '' }}>None
                    </option>
                    <option value="low" {{ old('priority', $task->priority) === 'low' ? 'selected' : '' }}>Low</option>
                    <option value="medium" {{ old('priority', $task->priority) === 'medium' ? 'selected' : '' }}>Medium
                    </option>
                    <option value="high" {{ old('priority', $task->priority) === 'high' ? 'selected' : '' }}>High
                    </option>
                </select>
            </div>
        </div>

        <div>
            <label for="due_date" class="block font-medium">Due Date</label>
            <input type="datetime-local" name="due_date" id="due_date"
                value="{{ old('due_date', optional($task->due_date)->format('Y-m-d\TH:i')) }}"
                class="w-full border border-gray-300 px-3 py-2 rounded">
        </div>

        <div class="flex flex-col md:flex-row md:justify-end space-x-4">
            <button type="submit"
                class="w-full bg-blue-600 text-white px-4 py-2 mb-2 md:mb-0 rounded-lg transition hover:bg-blue-700 hover:cursor-pointer">
                Update
            </button>
            <a href="{{ route('tasks.index') }}"
                class="md:inline-block text-center w-full bg-gray-300 hover:bg-gray-400 text-gray-800 font-semibold px-6 py-2 rounded-lg transition duration-150">
                Cancel
            </a>
        </div>
    </form>
</div>
@endsection
