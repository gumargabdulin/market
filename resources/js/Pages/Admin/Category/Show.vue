<template>
    <div>
        <div class="mb-4">
            <Link :href="route('admin.categories.index')" class="inline-block py-2 px-3 bg-sky-600 border border-sky-500 text-white">Назад</Link>
        </div>
        <div>
            <table class="min-w-full bg-white shadow-md rounded-lg overflow-hidden">
                <thead class="bg-gray-100">
                <tr>
                    <th class="text-left px-6 py-3 text-gray-600 font-semibold uppercase text-sm">ID</th>
                    <th class="text-left px-6 py-3 text-gray-600 font-semibold uppercase text-sm">Заголовок</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td class="px-6 py-4 border-b border-gray-200 text-gray-800">{{ category.id }}</td>
                    <td class="px-6 py-4 border-b border-gray-200 text-gray-800">{{category.title}}</td>
                </tr>
                </tbody>
            </table>
        </div>

    </div>
</template>
<script>
import {Link} from "@inertiajs/vue3";
import AdminLayout from "@/Layouts/AdminLayout.vue";

export default {
    name: "Show",
    props:{
        category: Object
    },
    layout: AdminLayout,
    components: {
        Link
    }
}

</script>


<style scoped>

</style>
