<template>

    <div>
        <div class="mb-4">
            <Link :href="route('admin.params.create')"
                  class="inline-block py-2 px-3 bg-sky-600 border border-sky-500 text-white">Добавить
            </Link>
        </div>
        <div>
            <table class="min-w-full bg-white shadow-md rounded-lg overflow-hidden">
                <thead class="bg-gray-100">
                <tr>
                    <th class="text-left px-6 py-3 text-gray-600 font-semibold uppercase text-sm">ID</th>
                    <th class="text-left px-6 py-3 text-gray-600 font-semibold uppercase text-sm">Заголовок</th>
                    <th class="text-left px-6 py-3 text-gray-600 font-semibold uppercase text-sm">Тип фильтра</th>
                    <th class="text-left px-6 py-3 text-gray-600 font-semibold uppercase text-sm">Заголовок типа фильтра</th>
                    <th class="text-left px-6 py-3 text-gray-600 font-semibold uppercase text-sm">Действие</th>
                </tr>
                </thead>
                <tbody v-if="params && params.length">
                <tr
                    v-for="param in paramsData"
                    :key="param.id"
                    class="hover:bg-gray-50 transition-colors"
                >
                    <td class="px-6 py-4 border-b border-gray-200 text-gray-800">{{ param.id }}</td>
                    <td class="px-6 py-4 border-b border-gray-200 text-gray-800">
                        <Link :href="route('admin.params.show', param.id)">{{ param.title }}</Link>
                    </td>
                    <td class="px-6 py-4 border-b border-gray-200 text-gray-800">{{ param.filter_type }}</td>
                    <td class="px-6 py-4 border-b border-gray-200 text-gray-800">{{ param.filter_type_title }}</td>
                    <td class="px-6 py-4 border-b border-gray-200 text-gray-800 flex">
                        <Link :href="route('admin.params.edit', param.id)">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                                 stroke="currentColor" class="text-emerald-500 cursor-pointer size-4">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                      d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L6.832 19.82a4.5 4.5 0 0 1-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 0 1 1.13-1.897L16.863 4.487Zm0 0L19.5 7.125"/>
                            </svg>
                        </Link>
                        <svg @click.prevent = deleteParam(param) xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                             stroke="currentColor" class="mr-3 text-red-600 size-4 cursor-pointer">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                  d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0"/>
                        </svg>
                    </td>
                </tr>
                </tbody>
                <tbody v-else>
                <tr>
                    <td colspan="2" class="px-6 py-4 text-center text-gray-500">Нет категорий</td>
                </tr>
                </tbody>
            </table>

        </div>
    </div>
</template>
<script>
import AdminLayout from "@/Layouts/AdminLayout.vue";
import {Link} from "@inertiajs/vue3";

export default {
    name: "Index",
    props: {
        params: Array
    },
    data() {
        return{
            paramsData: this.params
        }

    },
    layout: AdminLayout,
    components: {
        Link
    },
    methods: {
        deleteParam(param) {
            axios.delete(route('admin.params.destroy', param.id))
                .then(res => {
                    this.paramsData = this.paramsData.filter(paramData=>paramData.id !== param.id)
                })
        }
    }
}


</script>

<style scoped>

</style>
