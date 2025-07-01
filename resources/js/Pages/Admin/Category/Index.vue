<template>
    <div>
        <div class="mb-4">
            <Link :href="route('admin.categories.create')" class="inline-block py-2 px-3 bg-sky-600 border border-sky-500 text-white">Добавить</Link>
        </div>
    </div>
</template>
<script>
import {Link} from "@inertiajs/vue3";
import AdminLayout from "@/Layouts/AdminLayout.vue";

export default {
    name: "Index",
    layout: AdminLayout,
    components: {
        Link
    }
}

</script>


<style scoped>

</style>
