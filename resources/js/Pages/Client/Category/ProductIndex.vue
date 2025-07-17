<template>
    <aside class="w-1/4 bg-gray-600 min-h-screen">
        <nav>

        </nav>
    </aside>
    <article class="w-3/4 bg-gray-100 p-4">
        <div class="grid grid-cols-3 gap-4">
            <ProductItem v-for="product in products" :product="product"></ProductItem>
        </div>
    </article>
</template>

<script>
import {Link} from "@inertiajs/vue3";
import MainLayout from "@/Layouts/MainLayout.vue";
import ProductItem from "@/Components/Client/Product/ProductItem.vue";

export default {
    name: "ProductIndex",
    layout: MainLayout,
    components: {Link, ProductItem},
    props:{
        products:Array
    }
}
</script>


<style scoped>

</style>
