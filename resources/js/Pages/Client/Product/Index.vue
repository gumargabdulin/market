<template>
    <aside class="w-1/4 bg-gray-600 min-h-screen">
        <nav>

        </nav>
    </aside>
    <article class="w-3/4 bg-gray-100 p-4">
        <div class="grid grid-cols-3 gap-4">
            <div v-for="product in products" class="p-4 border border-gray-200 bg-white">
                <h3>{{product.title}}</h3>
                <img :src="product.preview_image_url" :alt="product.title">
                <div class="flex items-center justify-between">
                    <p>{{product.price}}</p>
                    <p>{{product.old_price}}</p>
                </div>
                <div>
                    <a href="#" class="block p-4 bg-indigo-600 text-white text-center">Купить</a>
                </div>
            </div>
        </div>
    </article>
</template>

<script>
import {Link} from "@inertiajs/vue3";
import MainLayout from "@/Layouts/MainLayout.vue";

export default {
    name: "Index",
    layout: MainLayout,
    components: {Link},
    props:{
        products:Array
    }
}
</script>


<style scoped>

</style>
