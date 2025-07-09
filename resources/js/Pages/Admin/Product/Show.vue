<template>
    <div>
        <div class="mb-4">
            <Link :href="route('admin.products.index')"
                  class="inline-block py-2 px-3 bg-sky-600 border border-sky-500 text-white">Назад
            </Link>
        </div>
        <div>
            <table class="min-w-full bg-white shadow-md rounded-lg overflow-hidden">
                <thead class="bg-gray-100">
                <tr>
                    <th class="text-left px-6 py-3 text-gray-600 font-semibold uppercase text-sm">ID</th>
                    <th class="text-left px-6 py-3 text-gray-600 font-semibold uppercase text-sm">Заголовок</th>
                    <th class="text-left px-6 py-3 text-gray-600 font-semibold uppercase text-sm">Описание</th>
                    <th class="text-left px-6 py-3 text-gray-600 font-semibold uppercase text-sm">Контент</th>
                    <th class="text-left px-6 py-3 text-gray-600 font-semibold uppercase text-sm">Цена</th>
                    <th class="text-left px-6 py-3 text-gray-600 font-semibold uppercase text-sm">Старая цена</th>
                    <th class="text-left px-6 py-3 text-gray-600 font-semibold uppercase text-sm">Склад</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td class="px-6 py-4 border-b border-gray-200 text-gray-800">{{ product.id }}</td>
                    <td class="px-6 py-4 border-b border-gray-200 text-gray-800">{{ product.title }}</td>
                    <td class="px-6 py-4 border-b border-gray-200 text-gray-800">{{ product.description }}</td>
                    <td class="px-6 py-4 border-b border-gray-200 text-gray-800">{{ product.content }}</td>
                    <td class="px-6 py-4 border-b border-gray-200 text-gray-800">{{ product.price }}</td>
                    <td class="px-6 py-4 border-b border-gray-200 text-gray-800">{{ product.old_price }}</td>
                    <td class="px-6 py-4 border-b border-gray-200 text-gray-800">{{ product.qty }}</td>
                </tr>
                </tbody>
            </table>
        </div>
        <div>
            <div class="flex justify-between">
                <div v-for="image in product.images">
                    <img :src="image.url" :alt="product.title">
                </div>
            </div>

        </div>

    </div>
</template>
<script>
import {Link} from "@inertiajs/vue3";
import AdminLayout from "@/Layouts/AdminLayout.vue";

export default {
    name: "Show",
    props: {
        product: Object
    },
    layout: AdminLayout,
    components: {
        Link
    }
}

</script>


<style scoped>

</style>
