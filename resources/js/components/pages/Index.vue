<template>
    <div>
        <div class="hero min-h-screen" style="background-image: url('/storage/images/Weatherbg.jpg');">
            <div class="hero-overlay bg-opacity-60"></div>
            <div class="hero-content text-center text-neutral-content">
                <div class="max-w-md">
                    <h1 class="mb-5 text-5xl font-bold">Привет</h1>
                    <p class="mb-5 text-xl">Начать просто: жми на поиск и вводи название своего города</p>
                    <button @click="setFocus" class="btn btn-primary">Пора вводить город</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "Index",
    data() {
        return {

        }
    },
    methods: {
        setFocus() {
            this.$emit('setFocus');
        }
    }
}
</script>

<style scoped>

</style>
