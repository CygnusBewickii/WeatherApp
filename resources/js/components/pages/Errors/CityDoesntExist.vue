<template>
    <Error :code="'404'" :description="'Такого города не существует'"></Error>
</template>

<script>
import Error from "../../layouts/Error.vue";
export default {
    name: "CityDoesntExist",
    components: {Error}
}
</script>

<style scoped>

</style>
