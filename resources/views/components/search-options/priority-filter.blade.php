<select x-model="filters.priority" @change="updateQueryParams()" class="border border-gray-300 rounded px-4 py-2">
    <option value="">All Priorities</option>
    <option value="none">None</option>
    <option value="low">Low</option>
    <option value="medium">Medium</option>
    <option value="high">High</option>
</select>
