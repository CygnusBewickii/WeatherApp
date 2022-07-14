import {createRouter, createWebHistory} from "vue-router";
import Index from './components/pages/Index.vue';

const routes = [
    { path: '/', component: Index },

]

export default createRouter({
    history: createWebHistory(),
    routes,
})
