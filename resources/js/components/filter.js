export default (tasks) => ({
    filters: {
        search: "",
        status: "",
        priority: "",
        sort: "",
    },
    tasks: tasks,
    sortByDueDateAsc: true,
    sortEnabled: false, //　sort On/Off

    init() {
        const params = new URLSearchParams(window.location.search);

        const searchParams = params.get("search");
        this.filters.search = searchParams || "";

        const statusParams = params.get("status");
        this.filters.status = statusParams || "";

        const priorityParams = params.get("priority");
        this.filters.priority = priorityParams || "";

        const sortParams = params.get("sort");
        this.sortEnabled =
            sortParams === "due_date_asc" || sortParams === "due_date_desc";
        this.sortByDueDateAsc = sortParams !== "due_date_desc";
    },

    updateQueryParams() {
        const params = new URLSearchParams();
        for (const key in this.filters) {
            if (this.filters[key]) {
                params.set(key, this.filters[key]);
            } else {
                params.delete(key);
            }
        }

        if (this.sortEnabled) {
            params.set(
                "sort",
                this.sortByDueDateAsc ? "due_date_asc" : "due_date_desc"
            );
        } else {
            params.delete("sort");
        }

        const newUrl = `${window.location.pathname}?${params.toString()}`;
        window.history.replaceState({}, "", newUrl); // Update URL without reloading the page
    },

    get filteredAndSortedTasks() {
        const filteredTasks = this.tasks.filter((task) => {
            const matchesText =
                this.filters.search === "" ||
                task.title
                    .toLowerCase()
                    .includes(this.filters.search.toLowerCase()) ||
                task.description
                    .toLowerCase()
                    .includes(this.filters.search.toLowerCase());
            const matchesStatus =
                this.filters.status === "" ||
                this.filters.status === task.status;
            const matchesPriority =
                this.filters.priority === "" ||
                this.filters.priority === task.priority;

            return matchesText && matchesStatus && matchesPriority;
        });

        if (this.sortEnabled) {
            const now = new Date();
            const pastTasks = filteredTasks.filter((task) => {
                const dueDate = new Date(task.due_date);
                return dueDate <= now;
            });
            const futureTasks = filteredTasks.filter((task) => {
                const dueDate = new Date(task.due_date);
                return dueDate > now;
            });
            const sortedTasks = futureTasks.slice().sort((a, b) => {
                const dateA = new Date(a.due_date);
                const dateB = new Date(b.due_date);
                const diffA = dateA - now;
                const diffB = dateB - now;

                return this.sortByDueDateAsc ? diffA - diffB : diffB - diffA; // asc : desc
            });
            return [...sortedTasks, ...pastTasks];
        }
        return filteredTasks;
    },
    toggleDueDateSort() {
        if (!this.sortEnabled) {
            this.sortEnabled = true;
            this.sortByDueDateAsc = true;
        } else {
            this.sortByDueDateAsc = !this.sortByDueDateAsc;
        }
        this.updateQueryParams();
    },
});
