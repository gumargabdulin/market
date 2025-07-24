<template>
    <div class="w-full min-h-screen bg-gray-100 py-8">
        <div class="max-w-7xl mx-auto px-4">
            <h1 class="text-2xl font-bold text-gray-800 mb-6">Категории</h1>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                <Link
                    v-for="category in categories"
                    :key="category.id"
                    :href="route('client.categories.products.index', category.id)"
                    class="block bg-white p-6 border border-gray-200 hover:border-gray-400 shadow-sm hover:shadow-md transition rounded-md"
                >
                    <div class="flex items-center justify-between">
                        <h2 class="text-lg font-semibold text-gray-800">{{ category.title }}</h2>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400 group-hover:text-gray-600 transition" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                        </svg>
                    </div>
                </Link>
            </div>
        </div>
    </div>
</template>

<script>
import MainLayout from "@/Layouts/MainLayout.vue";
import { Link } from "@inertiajs/vue3";

export default {
    name: "Index",
    layout: MainLayout,
    components: {Link, MainLayout},
    props: {
        categories: Array
    }
}
</script>

<style scoped>
/* Вся стилизация — через Tailwind */
</style>
