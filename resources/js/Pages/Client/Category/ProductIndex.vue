<template>
    <aside class="w-1/4 bg-gray-600 min-h-screen">
        <nav class="p-4">
            <div>
                <template v-for="param in params">
                    <div v-if="param.filter_type==3" class="mb-4 pb-4 border-b border-gray-700">
                        <div>
                            <h3 class="text-white mb-2">{{ param.title }}</h3>
                        </div>
                        <div>
                            <div class="mb-2 flex items-center">
                                <input class="mr-2" type="checkbox" value="check1" id="check1">
                                <label class="text-sm text-gray-300" for="check1">Check1</label>
                            </div>
                        </div>
                        <div>
                            <div class="mb-2 flex items-center">
                                <input class="mr-2" type="checkbox" value="check2" id="check1">
                                <label class="text-sm text-gray-300" for="check2">Check1</label>
                            </div>
                        </div>
                    </div>
                    <div v-if="param.filter_type==1" class="mb-4 pb-4 border-b border-gray-700">
                        <div>
                            <h3 class="text-white mb-2">{{ param.title }}</h3>
                        </div>
                        <div>
                            <div class="mb-2 flex items-center">
                                <input class="border border-gray-200 p-2" type="text" placeholder="От">
                                <input class="border border-gray-200 p-2" type="text" placeholder="До">
                            </div>
                        </div>
                    </div>
                </template>
                <div>
                    <a href="#" class="block px-3 py-2 text-gray-300 bg-indigo-800 border border-indigo-900">Фильтр</a>
                </div>
            </div>
        </nav>
    </aside>
    <article class="w-3/4 bg-gray-100 p-4">
        <div class="mb-4">
            <template v-for="breadcrumb in breadcrumbs">
                <Link :href="route('client.categories.products.index', breadcrumb.id)">{{ breadcrumb.title }}</Link>
                <span> / </span>
            </template>
            <span>{{ category.title }}</span>
        </div>
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
    props: {
        products: Array,
        breadcrumbs: Array,
        category: Object,
        params: Array
    }
}
</script>


<style scoped>

</style>
