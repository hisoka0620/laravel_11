<select x-model="filters.status" @change="updateQueryParams()"
    class="min-w-[36px] border border-gray-300 rounded px-4 py-2">
    <option value="">All Statuses</option>
    <option value="not_started">Not Started</option>
    <option value="completed">Completed</option>
    <option value="in_progress">In Progress</option>
    <option value="pending">Pending</option>
</select>
