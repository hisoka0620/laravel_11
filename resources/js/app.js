import './bootstrap';
import taskCard from './components/taskCard';
import filterComponent from './components/filter';
import Alpine from 'alpinejs';

Alpine.data("taskCard", taskCard);
Alpine.data("filterComponent", filterComponent);
window.Alpine = Alpine;
Alpine.start();
