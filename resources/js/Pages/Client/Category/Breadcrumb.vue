<template>
    <div class="mb-4 text-sm text-gray-600">
        <Link :href="route('client.categories.index')" class="hover:underline">Категории</Link>
        <span> / </span>
        <template v-for="(breadcrumb, index) in breadcrumbs" :key="breadcrumb.id">
            <Link :href="route('client.categories.products.index', breadcrumb.id)" class="hover:underline">
                {{ breadcrumb.title }}
            </Link>
            <span v-if="index !== breadcrumbs.length - 1"> / </span>
        </template>
        <span class="text-gray-800 font-medium"> / {{ current }}</span>
    </div>
</template>
<script>
import {Link} from "@inertiajs/vue3";

export default {
    name: "Breadcrumb",
    components: {Link},
    props: {
        breadcrumbs: Array,
        current: String,
    }
}
</script>


<style scoped>

</style>
