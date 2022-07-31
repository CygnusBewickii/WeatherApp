<template>
    <tr>
        <th class="">{{ formattedDate }}</th>
        <th class="">{{ Math.round(forecast.main.temp) }}&deg;</th>
        <th class="hidden sm:table-cell">{{ Math.round(forecast.main.feels_like) }}&deg;</th>
        <th class="hidden md:table-cell">{{ Math.round(forecast.main.pressure / 1.333) }} мм рт. ст.</th>
        <th class="hidden md:table-cell">{{ forecast.main.humidity }}%</th>
        <th class="hidden lg:table-cell">{{ forecast.clouds.all }} %</th>
        <th class="hidden lg:table-cell">{{ forecast.wind.speed }} м/с</th>
    </tr>
</template>

<script>
export default {
    name: "ForecastTableRow",
    props: {
        forecast: Object,
    },
    computed: {
        formattedDate() {
            let date = new Date(this.forecast.dt * 1000);
            let day = ("0" + date.getDate()).slice(-2);
            let month = ("0" + (date.getMonth() + 1)).slice(-2);
            let hours = ("0" + date.getHours()).slice(-2);
            let minutes = ("0" + date.getMinutes()).slice(-2);
            return `${day}.${month} ${hours}:${minutes}`
        }
    },
}
</script>

<style scoped>

</style>
