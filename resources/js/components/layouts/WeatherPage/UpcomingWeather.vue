<template>
    <div class="w-full 2xl:w-1/2 xl:max-w-1/2 mt-6 xl:mt-0">
        <div class="rounded-xl bg-soon w-full h-full mb-6">
            <div class="carousel">
                <UpcomingWeatherSlide :upcoming-weather="forecast[upcoming]" :num="upcoming" v-for="upcoming in 6"></UpcomingWeatherSlide>
            </div>
        </div>
    </div>
</template>

<script>
import UpcomingWeatherSlide from "./UpcomingWeatherSlide.vue";
export default {
    name: "UpcomingWeather",
    components: {UpcomingWeatherSlide},
    props: {
        forecast: Object,
    },
}
</script>

<style scoped>
    .bg-soon {
        background: linear-gradient(90deg, #efd5ff 0%, #515ada 100%);
    }
</style>
