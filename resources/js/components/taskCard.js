export default (task, csrfToken) => ({
    id: task.id,
    title: task.title,
    description: task.description,
    status: task.status,
    previousStatus: task.previousStatus,
    priority: task.priority,
    dueDate: task.due_date,
    csrfToken,
    showUrgent: false,

    init() {
        const dueDate = new Date(this.dueDate);
        const now = new Date();
        const tomorrow = new Date(now.getTime() + 24 * 60 * 60 * 1000);
        this.showUrgent = dueDate >= now && dueDate < tomorrow;
    },
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
    get taskCardClass() {
        // tasks border color
        const now = new Date();
        const tomorrow = new Date(now.getTime() + 24 * 60 * 60 * 1000);
        const dueDate = new Date(this.dueDate);
        if (dueDate >= now && dueDate < tomorrow && !this.isCompleted) {
            return "border-yellow-400 bg-yellow-100";
        } else if (dueDate < now && !this.isCompleted && this.dueDate != null) {
            return "border-red-400 bg-red-100";
        } else if (this.isCompleted) {
            return "border-green-400 bg-green-100 opacity-50";
        } else {
            return "border-blue-400 bg-white";
        }
    },
    get statusClass() {
        switch (this.status) {
            case "completed":
                return "bg-green-200 text-green-600";
            case "in_progress":
                return "bg-orange-200 text-orange-600";
            case "pending":
                return "bg-purple-200 text-purple-600";
            default:
                return "bg-gray-200 text-gray-600";
        }
    },
    get priorityClass() {
        switch (this.priority) {
            case "low":
                return "border-l-4 border-lime-600 bg-lime-200 text-lime-600";
            case "medium":
                return "border-l-4 border-cyan-600 bg-cyan-200 text-cyan-600";
            case "high":
                return "border-l-4 border-red-600 bg-red-200 text-red-600";
            default:
                return "border-l-4 border-gray-600 bg-gray-200 text-gray-600";
        }
    },
    get dueDateClass() {
        const now = new Date();
        const tomorrow = new Date(now.getTime() + 24 * 60 * 60 * 1000);
        if (!this.dueDate) {
            return "italic text-gray-600 bg-gray-200";
        }
        const dueDate = new Date(this.dueDate);
        if (isNaN(dueDate.getTime())) {
            // If it is an invalid date (e.g., cannot be parsed)
            return "italic text-gray-600 bg-gray-200";
        }
        if (now > dueDate) {
            return "text-red-600 bg-red-200";
        } else if (dueDate >= now && dueDate < tomorrow) {
            return "text-yellow-600 bg-yellow-200";
        } else {
            return "text-slate-600 bg-slate-200";
        }
    },
    get isTasksDueSoon() {
        const now = new Date();
        const tomorrow = new Date(now.getTime() + 24 * 60 * 60 * 1000);
        const dueDate = new Date(this.dueDate);
        return dueDate >= now && dueDate < tomorrow;
    },
    get formattedDueDate() {
        if (!this.dueDate) return "No due date";
        const dueDate = new Date(this.dueDate);
        if (isNaN(dueDate)) return "Invalid date";

        const yyyy = dueDate.getFullYear();
        const mm = String(dueDate.getMonth() + 1).padStart(2, "0");
        const dd = String(dueDate.getDate()).padStart(2, "0");
        const weekDay = String(
            new Intl.DateTimeFormat("en-US", { weekday: "short" }).format(
                dueDate
            )
        );
        const hh = String(dueDate.getHours()).padStart(2, "0");
        const mi = String(dueDate.getMinutes()).padStart(2, "0");
        const formattedDateTime = `${yyyy}-${mm}-${dd} ${weekDay} ${hh}:${mi}`;

        const now = new Date();
        const tomorrow = new Date(now.getTime() + 24 * 60 * 60 * 1000);

        if (now <= dueDate && tomorrow > dueDate) {
            return `${formattedDateTime}`;
        } else if (dueDate < now) {
            return `${formattedDateTime}`;
        } else {
            return formattedDateTime;
        }
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
                this.$store.taskStore.updateTaskStatus(this.id, data.status, data.previous_status);
            })
            .catch((err) => {
                alert("Failed to update task status");
                console.error(err);
            });
    },
});
