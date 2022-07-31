<template>
    <div class="drawer">
        <input id="my-drawer-3" type="checkbox" class="drawer-toggle" />
        <div class="drawer-content flex flex-col">
            <!-- Navbar -->
            <div class="w-full navbar bg-base-300">
                <div class="flex-none lg:hidden">
                    <label for="my-drawer-3" class="btn btn-square btn-ghost">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" class="inline-block w-6 h-6 stroke-current"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path></svg>
                    </label>
                </div>
                <router-link :to="{ name: 'index' }">
                    <div class="flex-none px-2 mx-2">CygnusWeather.ru</div>
                </router-link>
                <div class="flex-1 form-control hidden lg:block">
                    <div class="input-group justify-center">
                        <input @keyup.enter="submitSearch" type="text" placeholder="Введите название города" class="input input-bordered w-96" v-model="searcher" ref="search"/>
                        <button @click="submitSearch" @keypress.enter="submitSearch" class="btn btn-square" >
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" /></svg>
                        </button>
                    </div>
                </div>
                <div class="flex-none hidden lg:block">
                    <ul class="menu menu-horizontal">
                        <!-- Navbar menu content here -->
                        <li><a><span class="font-bold">Вход</span></a></li>
                        <li><a><span class="font-bold">Регистрация</span></a></li>
                    </ul>
                </div>
            </div>
            <!-- Page content here -->
            <router-view @setFocus="setFocus"></router-view>
            <Footer></Footer>
        </div>
        <div class="drawer-side">
            <label for="my-drawer-3" class="drawer-overlay"></label>
            <ul class="menu p-4 overflow-y-auto w-80 bg-base-100">
                <!-- Sidebar content here -->
                <li class="disabled">
                    <form>
                        <input type="text" placeholder="Введите название города" class="input input-bordered text-black w-4/5" v-model="searcher" />
                        <button @click="submitSearch" class="btn btn-square">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z" /></svg>
                        </button>
                    </form>
                </li>
                <li><a>Вход</a></li>
                <li><a>Регистрация</a></li>
            </ul>

        </div>
    </div>
</template>

<script>
import axios from "axios";
import router from "../router.js";
import Footer from "./layouts/Footer.vue";
export default {
    name: "App",
    components: {
        Footer

    },
    data() {
        return {
            searcher: '',
        }
    },
    methods: {
        submitSearch() {
            if (this.searcher != null) {
                router.push({ name: 'weather', params: { cityName: this.searcher } });
            }
        },
        setFocus() {
            this.$refs.search.focus();
        }
    },
    mounted() {
    }
}
</script>

<style scoped>

</style>
