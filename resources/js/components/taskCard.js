import Alpine from "alpinejs";
Alpine.data(
    "taskCard",
    ({ id, status, previousStatus, priority , title, description }) => ({
        id,
        status,
        previousStatus,
        priority,
        title,
        description,
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
            return this.isCompleted
                ? "Mark as incomplete"
                : "Mark as completed";
        },
        get statusClass() {
            if (this.status === "completed")
                return "bg-green-100 text-green-700";
            if (this.status === "in_progress")
                return "bg-yellow-100 text-yellow-700";
            if (this.status === "pending")
                return "bg-orange-100 text-orange-700";
            return "bg-gray-100 text-gray-700";
        },
        toggleStatus() {
            fetch(`/tasks/${this.id}/toggle-status`, {
                method: "PATCH",
                headers: {
                    "X-CSRF-TOKEN": document
                        .querySelector('meta[name="csrf-token"]')
                        .getAttribute("content"),
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
    })
);
