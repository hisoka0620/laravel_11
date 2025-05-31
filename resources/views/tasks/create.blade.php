@extends('layouts.app')

@section('title', 'Create Task')

@section('content')
<div class="max-w-2xl mx-auto my-12">
    <div class="bg-white shadow-xl rounded-2xl p-8">
        <h1 class="text-3xl font-bold text-gray-800 mb-6 border-b pb-2">Create New Task</h1>

        <form action="{{ route('tasks.store') }}" method="POST" class="space-y-6">
            @csrf

            <div>
                <label for="title" class="block text-sm font-medium text-gray-700 mb-1">Title</label>
                <input type="text" name="title" id="title" value="{{ old('title') }}"
                    class="w-full border border-gray-300 px-4 py-2 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"
                    required>
                @error('title')
                <p class="text-red-600 mt-1">*{{$message}}</p>
                @enderror
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
                        <option value="">-----</option>
                        <option value="not_started" {{ old('status')==='not_started' ? 'selected' : '' }}>Not Started
                        </option>
                        <option value="pending" {{ old('status')==='pending' ? 'selected' : '' }}>Pending</option>
                        <option value="in_progress" {{ old('status')==='in_progress' ? 'selected' : '' }}>In Progress
                        </option>
                        <option value="completed" {{ old('status')==='completed' ? 'selected' : '' }}>Completed</option>
                    </select>
                    @error('status')
                    <p class="text-red-600 mt-1">*{{$message}}</p>
                    @enderror
                </div>

                <div>
                    <label for="priority" class="block text-sm font-medium text-gray-700 mb-1">Priority</label>
                    <select name="priority" id="priority"
                        class="w-full border border-gray-300 px-4 py-2 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                        <option value="">-----</option>
                        <option value="none" {{ old('priority')==='none' ? 'selected' : '' }}>None</option>
                        <option value="low" {{ old('priority')==='low' ? 'selected' : '' }}>Low</option>
                        <option value="medium" {{ old('priority')==='medium' ? 'selected' : '' }}>Medium</option>
                        <option value="high" {{ old('priority')==='high' ? 'selected' : '' }}>High</option>
                    </select>
                    @error('priority')
                    <p class="text-red-600 mt-1">*{{$message}}</p>
                    @enderror
                </div>
            </div>

            <div>
                <label for="due_date" class="block text-sm font-medium text-gray-700 mb-1">Due Date</label>
                <input type="datetime-local" name="due_date" id="due_date" value="{{ old('due_date') }}"
                    class="w-full border border-gray-300 px-4 py-2 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

            <div class="flex flex-col md:flex-row md:justify-end space-x-4">
                <button type="submit"
                    class="w-full md:w-32 max-md:mb-2 bg-blue-600 hover:bg-blue-700 text-white font-semibold px-6 py-2 rounded-lg transition duration-150 hover:cursor-pointer">
                    Create
                </button>
                <a href="{{ route('tasks.index') }}"
                    class="w-full md:w-32 bg-gray-300 hover:bg-gray-400 text-gray-800 block text-center font-semibold px-6 py-2 rounded-lg transition duration-150">
                    Cancel
                </a>
            </div>
        </form>
    </div>
</div>
@endsection
