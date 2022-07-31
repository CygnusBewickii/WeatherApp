<template>
    <div>
        <table class="table w-full table-normal text-2xs md:text-4xl">
            <thead>
                <tr>
                    <th class="">Время</th>
                    <th class="">Температура</th>
                    <th class="hidden sm:table-cell">Ощущается как</th>
                    <th class="hidden md:table-cell">Давление</th>
                    <th class="hidden md:table-cell">Влажность</th>
                    <th class="hidden lg:table-cell">Облачность</th>
                    <th class="hidden lg:table-cell">Скорость ветра</th>
                </tr>
            </thead>
            <tbody>
                <ForecastTableRow v-for="i in 34" :forecast="forecast[i+6]"></ForecastTableRow>
            </tbody>
        </table>
    </div>
</template>

<script>
import ForecastTableRow from "./ForecastTableRow.vue";
export default {
    name: "Forecast",
    components: {ForecastTableRow},
    props: {
        forecast: Object,
    },
    data() {
        return {

        }
    },

}
</script>

<style scoped>

</style>
