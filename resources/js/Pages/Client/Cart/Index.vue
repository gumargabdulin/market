<template>
    <article class="w-full max-w-6xl mx-auto px-8 py-6 bg-white rounded shadow-sm">
        <div>
            Корзина
        </div>
    </article>
</template>




<script>
import MainLayout from "@/Layouts/MainLayout.vue";
import { Link } from "@inertiajs/vue3";
export default {
    name: "Show",
    components: { Link },
    layout: MainLayout,

    props: {

    },
    data() {

    }
}
</script>

<style scoped>
</style>
