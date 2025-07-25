<template>
    <article class="w-full max-w-6xl mx-auto px-8 py-6 bg-white rounded shadow-sm">
        <div>
            <table class="min-w-full bg-white shadow-md rounded-lg overflow-hidden">
                <thead class="bg-gray-100">
                <tr>
                    <th class="text-left px-6 py-3 text-gray-600 font-semibold uppercase text-sm">ID</th>
                    <th class="text-left px-6 py-3 text-gray-600 font-semibold uppercase text-sm">Наименование</th>
                    <th class="text-left px-6 py-3 text-gray-600 font-semibold uppercase text-sm">Изображение</th>
                    <th class="text-left px-6 py-3 text-gray-600 font-semibold uppercase text-sm">Колличество</th>
                    <th class="text-left px-6 py-3 text-gray-600 font-semibold uppercase text-sm">Сумма</th>
                    <th class="text-left px-6 py-3 text-gray-600 font-semibold uppercase text-sm">Действие</th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="cart in cartsData">
                    <td class="px-6 py-4 border-b border-gray-200 text-gray-800">{{ cart.id }}</td>
                    <td class="px-6 py-4 border-b border-gray-200 text-gray-800">{{cart.product_title}}</td>
                    <td class="px-6 py-4 border-b border-gray-200 text-gray-800">
                        <img :src="cart.product_image" class="w-30">
                    </td>
                    <td class="px-6 py-4 border-b border-gray-200 text-gray-800">{{cart.qty}}</td>
                    <td class="px-6 py-4 border-b border-gray-200 text-gray-800">{{cart.total_sum}}</td>
                    <td class="px-6 py-4 border-b border-gray-200 text-gray-800"></td>
                </tr>
                </tbody>
            </table>
        </div>
    </article>
</template>




<script>
import MainLayout from "@/Layouts/MainLayout.vue";
import { Link } from "@inertiajs/vue3";
export default {
    name: "Index",
    components: { Link },
    layout: MainLayout,

    props: {
        carts:Array
    },
    data() {
        return {
            cartsData:this.carts
        }
    }
}
</script>

<style scoped>
</style>
