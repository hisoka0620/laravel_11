export default (task, csrfToken) => ({
    id: task.id,
    title: task.title,
    description: task.description,
    status: task.status,
    previousStatus: task.previousStatus,
    priority: task.priority,
    dueDate: task.due_date,
    csrfToken,

    get isCompleted() {
        return this.status === "completed";
    },
    get statusLabel() {
        if (this.isCompleted) return "Completed ☑️";
        return this.status
            .replace(/_/g, " ")
            .replace(/\b\w/g, (l) => l.toUpperCase());
    },
    get toggleLabel() {
        return this.isCompleted ? "Mark as incomplete" : "Mark as completed";
    },
    get statusClass() {
        if (this.status === "completed") return "bg-green-100 text-green-700";
        if (this.status === "in_progress")
            return "bg-yellow-100 text-yellow-700";
        if (this.status === "pending") return "bg-orange-100 text-orange-700";
        return "bg-gray-100 text-gray-700";
    },
    get priorityClass() {
        if (this.priority === "low") return "text-blue-600";
        if (this.priority === "medium") return "text-green-500";
        if (this.priority === "high") return "text-red-600";
        return "text-gray-700";
    },
    get formattedDueDate() {
        if (!this.dueDate) return "No due date";

        const date = new Date(this.dueDate.replace(" ", "T"));
        if (isNaN(date)) return "Invalid date";

        const yyyy = date.getFullYear();
        const mm = String(date.getMonth() + 1).padStart(2, '0');
        const dd = String(date.getDay()).padStart(2, '0');
        const hh = String(date.getHours()).padStart(2, '0');
        const mi = String(date.getMinutes()).padStart(2, '0');

        return `${yyyy}-${mm}-${dd} ${hh}:${mi}`;

    },
    toggleStatus() {
        fetch(`/tasks/${this.id}/toggle-status`, {
            method: "PATCH",
            headers: {
                "X-CSRF-TOKEN": this.csrfToken,
                Accept: "application/json",
                "Content-Type": "application/json",
            },
        })
            .then((response) => response.json())
            .then((data) => {
                this.status = data.status;
                this.previousStatus = data.previous_status ?? null;
            })
            .catch((err) => {
                alert("Failed to update task status");
                console.error(err);
            });
    },
});
