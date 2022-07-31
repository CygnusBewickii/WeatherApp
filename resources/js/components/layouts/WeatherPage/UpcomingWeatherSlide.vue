<template>
    <div :id="'soon' + num" class="carousel-item w-full">
        <a :href="'#soon' + (num == 1 ? 6 : num-1)" class="btn btn-circle ml-4 mt-56">❮</a>
        <div class="flex-1 flex-col flex-wrap mt-16">
            <div class="text-3xl sm:text-5xl mb-4 font-bold flex justify-center lg:block">
                Погода ближайшие 24 часа
            </div>
            <div class="text-4xl flex justify-center text-semibold mb-6">
                {{ formattedDate }}
            </div>
            <div class="flex flex-row lg:flex-nowrap flex-wrap justify-center">
                <div class="mr-6 mb-6 lg:mb-0">
                    <img :src="icon" alt="Здесь должна была быть иконка">
                </div>
                <div>
                    <div class="text-xl sm:text-3xl flex justify-center md:block font-semibold first-letter:uppercase">
                        {{ description }}
                    </div>
                    <div class="text-9xl">
                        <div class="flex justify-center md:justify-start">{{ temperature }}&deg;</div>
                        <div class="text-2xl opacity-50">Ощущается как {{ feelsLike }}&deg;</div>
                    </div>
                </div>
            </div>
        </div>
        <a :href="'#soon' + (num == 6 ? 1 : num+1)" class="btn btn-circle mr-4 mt-56">❯</a>
    </div>
</template>

<script>
export default {
    name: "UpcomingWeatherSlide",
    props: {
        upcomingWeather: Object,
        num: Number,
    },
    data() {
        return {
            icon: '',
            description: '',
            temperature: '',
            feelsLike: '',
        }
    },
    computed: {
        formattedDate() {
            let date = new Date(this.upcomingWeather.dt * 1000);
            let day = ("0" + date.getDate()).slice(-2);
            let month = ("0" + (date.getMonth() + 1)).slice(-2);
            let hours = ("0" + date.getHours()).slice(-2);
            let minutes = ("0" + date.getMinutes()).slice(-2);
            return `${day}.${month} ${hours}:${minutes}`
        }
    },
    updated() {
        this.icon = `/storage/images/icons/WeatherCondition/${this.upcomingWeather.weather[0].icon}.png`;
        this.description = this.upcomingWeather.weather[0].description;
        this.temperature = Math.round(this.upcomingWeather.main.temp);
        this.feelsLike = Math.round(this.upcomingWeather.main.feels_like);
    }
}
</script>

<style scoped>

</style>
