<a href="{{ route('tasks.create') }}"
    class="inline-block bg-blue-500 text-white px-4 py-2 mb-2 rounded hover:bg-blue-600 transition">
    {{ $slot ?? '+ Create New Task'}}
</a>
