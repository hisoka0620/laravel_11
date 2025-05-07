@extends('layouts.app')

@section('content')
<div class="max-w-2xl mx-auto mt-12">
    <div class="bg-white shadow-xl rounded-2xl p-8">
        <h1 class="text-3xl font-bold text-gray-800 mb-6 border-b pb-2">Create New Task</h1>

        @if ($errors->any())
        <div class="mb-6 p-4 bg-red-50 border border-red-300 rounded text-red-700">
            <ul class="list-disc list-inside text-sm">
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <form action="{{ route('tasks.store') }}" method="POST" class="space-y-6">
            @csrf

            <div>
                <label for="title" class="block text-sm font-medium text-gray-700 mb-1">Title</label>
                <input type="text" name="title" id="title" value="{{ old('title') }}"
                    class="w-full border border-gray-300 px-4 py-2 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                    required>
            </div>

            <div>
                <label for="description" class="block text-sm font-medium text-gray-700 mb-1">Description</label>
                <textarea name="description" id="description" rows="4"
                    class="w-full border border-gray-300 px-4 py-2 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">{{ old('description') }}</textarea>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label for="status" class="block text-sm font-medium text-gray-700 mb-1">Status</label>
                    <select name="status" id="status"
                        class="w-full border border-gray-300 px-4 py-2 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="not_started" {{ old('status')==='not_started' ? 'selected' : '' }}>Not Started
                        </option>
                        <option value="pending" {{ old('status')==='pending' ? 'selected' : '' }}>Pending</option>
                        <option value="in_progress" {{ old('status')==='in_progress' ? 'selected' : '' }}>In Progress
                        </option>
                        <option value="completed" {{ old('status')==='completed' ? 'selected' : '' }}>Completed</option>
                    </select>
                </div>

                <div>
                    <label for="priority" class="block text-sm font-medium text-gray-700 mb-1">Priority</label>
                    <select name="priority" id="priority"
                        class="w-full border border-gray-300 px-4 py-2 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="none" {{ old('priority')==='none' ? 'selected' : '' }}>None</option>
                        <option value="low" {{ old('priority')==='low' ? 'selected' : '' }}>Low</option>
                        <option value="medium" {{ old('priority')==='medium' ? 'selected' : '' }}>Medium</option>
                        <option value="high" {{ old('priority')==='high' ? 'selected' : '' }}>High</option>
                    </select>
                </div>
            </div>

            <div>
                <label for="due_date" class="block text-sm font-medium text-gray-700 mb-1">Due Date</label>
                <input type="datetime-local" name="due_date" id="due_date" value="{{ old('due_date') }}"
                    class="w-full border border-gray-300 px-4 py-2 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <div class="flex justify-end space-x-4">
                <a href="{{ url()->previous() }}"
                    class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-semibold px-6 py-2 rounded-lg transition duration-150">
                    Cancel
                </a>
                <button type="submit"
                    class="bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-2 rounded-lg transition duration-150 hover:cursor-pointer">
                    Create
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
