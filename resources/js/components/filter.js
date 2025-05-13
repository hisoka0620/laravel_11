export default (tasks) => ({
    filterSearch: "",
    filterStatus: "",
    filterPriority: "",
    tasks: tasks,

    init() {
        const params = new URLSearchParams(window.location.search);
        this.filterSearch = params.get("search") || "";
        this.filterStatus = params.get("status") || "";
        this.filterPriority = params.get("priority") || "";
    },

    updateQueryParams() {
        const params = new URLSearchParams(window.location.search);
        this.filterSearch
            ? params.set("search", this.filterSearch)
            : params.delete("search");
        this.filterStatus
            ? params.set("status", this.filterStatus)
            : params.delete("status");
        this.filterPriority
            ? params.set("priority", this.filterPriority)
            : params.delete("priority");

        const newUrl = `${window.location.pathname}?${params.toString()}`;
        window.history.replaceState({}, "", newUrl); // Update URL without reloading the page
    },

    get filteredTasks() {
        return this.tasks.filter((task) => {
            const matchesText =
                this.filterSearch === "" ||
                task.title
                    .toLowerCase()
                    .includes(this.filterSearch.toLowerCase()) ||
                task.description
                    .toLowerCase()
                    .includes(this.filterSearch.toLowerCase());
            const matchesStatus =
                this.filterStatus === "" || this.filterStatus === task.status;
            const matchesPriority =
                this.filterPriority === "" ||
                this.filterPriority === task.priority;

            return matchesText && matchesStatus && matchesPriority;
        });
    },
});
