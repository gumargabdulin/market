<template>
    <section class="w-full border-b bg-grey-50 p-4">
        <header>
            Market Admin
        </header>
    </section>
    <section class="flex">
        <aside class="w-1/4 bg-gray-600 min-h-screen">
            <nav>
                <Link :href="route('dashboard')" class="block p-4 text-gray-200 border-b border-gray-700">Dashboard</Link>
                <Link :href="route('admin.categories.index')" class="block p-4 text-gray-200 border-b border-gray-700">Категории</Link>
                <Link :href="route('admin.product-groups.index')" class="block p-4 text-gray-200 border-b border-gray-700">Группа продуктов</Link>
                <Link :href="route('admin.products.index')" class="block p-4 text-gray-200 border-b border-gray-700">Продукты</Link>
                <Link :href="route('admin.params.index')" class="block p-4 text-gray-200 border-b border-gray-700">Характеристики</Link>
            </nav>
        </aside>
        <article class="w-3/4 bg-gray-100 p-4">
            <slot/>
        </article>
    </section>
    <section>
        <footer>

        </footer>
    </section>
</template>
<script>
import {Link} from "@inertiajs/vue3";

export default {
    name: "AdminLayout",

    components:{
        Link
    }
}
</script>


<style scoped>

</style>
