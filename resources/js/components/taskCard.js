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
    get borderClass() {
        const now = new Date();
        const tomorrow = new Date(now.getTime() + 24 * 60 * 60 * 1000);
        const dueDate = new Date(this.dueDate);
        if (dueDate >= now && dueDate < tomorrow && !this.isCompleted) return "border-yellow-400";
        if (dueDate < now && !this.isCompleted && this.dueDate != null) return "border-red-400";
        if (this.isCompleted) return "border-green-400 opacity-50";
        return "border-blue-400";
    },
    get statusClass() {
        switch (this.status) {
            case "completed":
                return "bg-green-100 text-green-600";
            case "in_progress":
                return "bg-orange-100 text-orange-600";
            case "pending":
                return "bg-purple-100 text-purple-600";
            default:
                return "bg-gray-100 text-gray-600";
        }
    },
    get priorityClass() {
        switch (this.priority) {
            case "low":
                return "border-l-4 border-lime-500 bg-lime-100 text-lime-600";
            case "medium":
                return "border-l-4 border-cyan-500 bg-cyan-100 text-cyan-600";
            case "high":
                return "border-l-4 border-red-500 bg-red-100 text-red-600";
            default:
                return "border-l-4 border-gray-500 bg-gray-100 text-gray-600";
        }
    },
    get dueDateClass() {
        const now = new Date();
        const tomorrow = new Date(now.getTime() + 24 * 60 * 60 * 1000);
        if (!this.dueDate) {
            return "italic text-gray-600 bg-gray-100";
        }
        const dueDate = new Date(this.dueDate);
        if (isNaN(dueDate.getTime())) {
            // If it is an invalid date (e.g., cannot be parsed)
            return "italic text-gray-600 bg-gray-100";
        }
        if (now > dueDate) {
            return "text-red-600 bg-red-100";
        } else if (dueDate >= now && dueDate < tomorrow) {
            return "text-yellow-600 bg-yellow-100";
        } else {
            return "text-slate-600 bg-slate-100";
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
            })
            .catch((err) => {
                alert("Failed to update task status");
                console.error(err);
            });
    },
});
