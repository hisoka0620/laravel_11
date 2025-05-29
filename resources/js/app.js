import './bootstrap';
import taskCard from './components/taskCard';
import filterComponent from './components/filter';
import urgentTaskNotifier from './components/urgentTaskNotifier';
import Alpine from 'alpinejs';

Alpine.data("taskCard", taskCard);
Alpine.data("filterComponent", filterComponent);
Alpine.data("urgentTaskNotifier", urgentTaskNotifier);
window.Alpine = Alpine;
Alpine.start();
