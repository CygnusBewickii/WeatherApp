<template>
    <div class="m-6">
        <div class="text-3xl sm:text-5xl mb-6 font-bold flex justify-center lg:block">
            {{ currentWeather.city }}
        </div>
        <div class="h-auto flex flex-row justify-between flex-wrap xl:flex-nowrap">
            <CurrentWeather :current-weather="currentWeather"></CurrentWeather>
            <UpcomingWeather :forecast="forecast"></UpcomingWeather>
        </div>
        <div class="mt-6">
            <Forecast :forecast="forecast"></Forecast>
        </div>
    </div>
</template>

<script>
import axios from "axios";
import router from "../../router.js";
import CurrentWeather from "../layouts/WeatherPage/CurrentWeather.vue";
import UpcomingWeather from "../layouts/WeatherPage/UpcomingWeather.vue";
import Forecast from "../layouts/WeatherPage/Forecast.vue";

export default {
    name: "Weather",
    components: {Forecast, UpcomingWeather, CurrentWeather},
    data() {
        return {
            weather: {},
            currentWeather: {
                city: '',
                icon: '',
                description: '',
                temperature: '',
                feelsLike: '',
                pressure: '',
                humidity: '',
                cloudiness: '',
                windSpeed: '',
            },
            forecast: {}
        }
    },
    methods: {
        async getWeather() {
            const cityName = this.$route.params.cityName;
            await axios.get(`/api/weather`, {params: { cityName: cityName }})
                .then(response => response.data)
                .then(data => this.weather = data)
                .catch(function (error) {
                    if(error.response.status === 404) {
                        router.push({name: 'cityDoesntExist'})
                    }
                });
        },
    },
    watch: {
        weather() {
            this.currentWeather.description = this.weather.currentWeather.weather[0].description;
            this.currentWeather.icon = `/storage/images/icons/WeatherCondition/${this.weather.currentWeather.weather[0].icon}.png`;
            this.currentWeather.city = this.weather.currentWeather.name;
            this.currentWeather.temperature = Math.round(this.weather.currentWeather.main.temp);
            this.currentWeather.feelsLike = Math.round(this.weather.currentWeather.main.feels_like);
            this.currentWeather.pressure = Math.round(this.weather.currentWeather.main.pressure / 1.333);
            this.currentWeather.humidity = this.weather.currentWeather.main.humidity;
            this.currentWeather.cloudiness = this.weather.currentWeather.clouds.all;
            this.currentWeather.windSpeed = this.weather.currentWeather.wind.speed;
            this.forecast = this.weather.forecast.list;

        }
    },
    mounted() {
        this.getWeather()
    },
    beforeUpdate() {
        this.getWeather();
    }
}
</script>

<style scoped>
    .bg-custom {
        background-color: #0093E9;
        background-image: linear-gradient(160deg, #0093E9 0%, #80D0C7 100%);
    }
</style>
