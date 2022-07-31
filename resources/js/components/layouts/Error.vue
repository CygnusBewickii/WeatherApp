<template>
    <div class="hero min-h-screen bg-custom">
        <div class="hero-content text-center">
            <div class="max-w-md">
                <h1 class="text-8xl font-bold">{{ code }}</h1>
                <p class="py-6 text-2xl">{{ description }}</p>
                <router-link :to="{ name: 'index' }">
                    <button class="btn btn-error">На главную</button>
                </router-link>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "Error",
    props: {
        code: String,
        description: String,
    }
}
</script>

<style scoped>
    .bg-custom {
        background: #5433FF;  /* fallback for old browsers */
        background: -webkit-linear-gradient(to right, #A5FECB, #20BDFF, #5433FF);  /* Chrome 10-25, Safari 5.1-6 */
        background: linear-gradient(to right, #A5FECB, #20BDFF, #5433FF); /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */

    }
</style>
