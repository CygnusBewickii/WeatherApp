<template>

            <div class="h-auto bg-current rounded-xl w-full 2xl:w-1/2 2xl:mb-0 p-4 xl:mr-6">
                <div class="flex flex-1 flex-wrap xl:flex-nowrap flex-row m-12 justify-between">
                    <div class="flex flex-col flex-wrap">
                        <div class="text-3xl sm:text-5xl mb-16 font-bold flex justify-center lg:block">
                            Погода сейчас
                        </div>
                        <div class="flex flex-row lg:flex-nowrap flex-wrap justify-center">
                            <div class="mr-6 mb-6 lg:mb-0">
                                <img :src="currentWeather.icon" alt="Здесь должна была быть иконка">
                            </div>
                            <div>
                                <div class="text-xl sm:text-3xl flex justify-center md:block font-semibold first-letter:uppercase">
                                    {{ currentWeather.description }}
                                </div>
                                <div class="text-9xl">
                                    <div class="flex">{{ currentWeather.temperature }}&deg;</div>
                                    <div class="text-2xl opacity-50">Ощущается как {{ currentWeather.feelsLike }}&deg;</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="stats hidden min-w-[165px] sm:inline-grid md:stats-horizontal lg:stats-vertical shadow bg-secondary ml-4 mt-6 md:mt-0">

                        <div class="stat place-items-center">
                            <div class="stat-title">Давление</div>
                            <div class="stat-value">{{ currentWeather.pressure }}</div>
                            <div class="stat-desc">ММ. Рт. столба</div>
                        </div>

                        <div class="stat place-items-center">
                            <div class="stat-title">Влажность</div>
                            <div class="stat-value">{{ this.currentWeather.humidity }}%</div>
                            <div class="stat-desc"></div>
                        </div>

                        <div class="stat place-items-center">
                            <div class="stat-title">Облачность</div>
                            <div class="stat-value">{{ this.currentWeather.cloudiness }}%</div>
                            <div class="stat-desc"></div>
                        </div>

                        <div class="stat place-items-center">
                            <div class="stat-title">Скорость ветра</div>
                            <div class="stat-value">{{ this.currentWeather.windSpeed }}</div>
                            <div class="stat-desc">М/С</div>
                        </div>

                    </div>
                </div>

            </div>

</template>

<script>
export default {
    name: "CurrentWeather",
    props: {
        currentWeather: Object,
    },
}
</script>

<style scoped>
    .bg-current {
        background-color: #0093E9;
        background-image: linear-gradient(160deg, #0093E9 0%, #80D0C7 100%);
    }
    .bg-soon {
        background: linear-gradient(90deg, #efd5ff 0%, #515ada 100%);
    }
</style>
