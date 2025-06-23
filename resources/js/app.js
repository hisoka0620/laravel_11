import "./bootstrap";
import taskCard from "./components/taskCard";
import filterComponent from "./components/filter";
import urgentTaskNotifier from "./components/urgentTaskNotifier";
import Alpine from "alpinejs";

Alpine.data("taskCard", taskCard);
Alpine.data("filterComponent", filterComponent);
Alpine.data("urgentTaskNotifier", urgentTaskNotifier);
Alpine.store("taskStore", {
    tasks: [],
    updateTaskStatus(id, status, previousStatus) {
        const index = this.tasks.findIndex((task) => task.id === id);
        if (index !== -1) {
            this.tasks[index].status = status;
            this.tasks[index].previousStatus = previousStatus;
            this.tasks = [...this.tasks];
        }
    },
});
window.Alpine = Alpine;
Alpine.start();
