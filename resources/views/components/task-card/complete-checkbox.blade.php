<div class="flex flex-col mb-4">
    <label class="inline-flex items-center">
        <input type="checkbox" class="form-checkbox h-5 w-5 text-green-600" @change="toggleStatus"
            :checked="isCompleted">
        <span class="ml-2 text-sm text-gray-700" x-text="toggleLabel">
        </span>
    </label>
</div>
