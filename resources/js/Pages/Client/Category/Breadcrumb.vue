<template>
    <div class="mb-4">
        <template v-for="breadcrumb in breadcrumbs">
            <Link :href="route('client.categories.products.index', breadcrumb.id)">{{ current }}</Link>
            <span> / </span>
        </template>
        <span>{{ current }}</span>
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
