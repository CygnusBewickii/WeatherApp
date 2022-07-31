import {createRouter, createWebHistory} from "vue-router";
import Index from './components/pages/Index.vue';
import Weather from "./components/pages/Weather.vue";
import CityDoesntExist from "./components/pages/Errors/CityDoesntExist.vue";

const routes = [
    {
        path: '/',
        name: 'index',
        component: Index
    },
    {
        path: '/weather/:cityName',
        name: 'weather',
        component: Weather,
    },
    {
        path: '/weather/cityDoesntExist',
        name: 'cityDoesntExist',
        component: CityDoesntExist,
    },
]

export default createRouter({
    history: createWebHistory(),
    routes,
})
