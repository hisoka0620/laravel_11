export default (tasks) => ({
    show: false,
    urgentCount: 0,
    tasks, 

    init() {
        const now = new Date();
        const tomorrow = new Date(now.getTime() + 24 * 60 * 60 * 1000);

        const urgentTasks = this.tasks.filter((task) => {
            const due = new Date(task.due_date);
            const notCompleted = task.status !== 'completed'
            return due >= now && due < tomorrow && notCompleted;
        });
        if (urgentTasks.length > 0) {
            this.urgentCount = urgentTasks.length;
            this.show = true;
        }
    },

});
