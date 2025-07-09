<template>
    <div>
        <div class="mb-4">
            <Link :href="route('admin.params.index')" class="inline-block py-2 px-3 bg-sky-600 border border-sky-500 text-white">Назад</Link>
        </div>
        <div>
            <table class="min-w-full bg-white shadow-md rounded-lg overflow-hidden">
                <thead class="bg-gray-100">
                <tr>
                    <th class="text-left px-6 py-3 text-gray-600 font-semibold uppercase text-sm">ID</th>
                    <th class="text-left px-6 py-3 text-gray-600 font-semibold uppercase text-sm">Заголовок</th>
                    <th class="text-left px-6 py-3 text-gray-600 font-semibold uppercase text-sm">Тип фильтра</th>
                    <th class="text-left px-6 py-3 text-gray-600 font-semibold uppercase text-sm">Заголовок типа фильтра</th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td class="px-6 py-4 border-b border-gray-200 text-gray-800">{{ param.id }}</td>
                    <td class="px-6 py-4 border-b border-gray-200 text-gray-800">{{param.title}}</td>
                    <td class="px-6 py-4 border-b border-gray-200 text-gray-800">{{param.filter_type}}</td>
                    <td class="px-6 py-4 border-b border-gray-200 text-gray-800">{{param.filter_type_title}}</td>
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
        param: Object
    },
    layout: AdminLayout,
    components: {
        Link
    }
}

</script>


<style scoped>

</style>
