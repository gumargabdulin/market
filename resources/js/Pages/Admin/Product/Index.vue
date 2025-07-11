<template>

    <div>
        <div class="mb-4">
            <Link :href="route('admin.products.create')"
                  class="inline-block py-2 px-3 bg-sky-600 border border-sky-500 text-white">Добавить
            </Link>
        </div>
        <div>
            <table class="min-w-full bg-white shadow-md rounded-lg overflow-hidden">
                <thead class="bg-gray-100">
                <tr>
                    <th class="text-left px-6 py-3 text-gray-600 font-semibold uppercase text-sm">ID</th>
                    <th class="text-left px-6 py-3 text-gray-600 font-semibold uppercase text-sm">Заголовок</th>
                    <th class="text-left px-6 py-3 text-gray-600 font-semibold uppercase text-sm">Цена</th>
                    <th class="text-left px-6 py-3 text-gray-600 font-semibold uppercase text-sm">Склад</th>
                    <th class="text-left px-6 py-3 text-gray-600 font-semibold uppercase text-sm">Действие</th>
                    <th class="text-left px-6 py-3 text-gray-600 font-semibold uppercase text-sm">Продукты</th>
                </tr>
                </thead>
                <tbody v-if="products && products.length">
                <template v-for="product in productsData"
                          :key="product.id">
                    <ProductItem @product_children_got="updateProductChildrenData" @product_deleted="updateProductsData" :product="product"></ProductItem>
                    <template v-if="ProductChildrenData.length > 0" v-for="productChild in ProductChildrenData">
                        <ProductItem @product_deleted="updateProductsData" :product="productChild"></ProductItem>
                    </template>
                </template>
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
import ProductItem from "@/Components/Admin/Product/ProductItem.vue";

export default {
    name: "Index",
    props: {
        products: Array
    },
    data() {
        return {
            ProductChildrenData:[],
            productsData: this.products
        }
    },
    layout: AdminLayout,
    components: {
        Link, ProductItem
    },
    methods: {
        updateProductsData(product) {
            console.log(product)
            this.productsData = this.productsData.filter(productData => productData.id !== product.id)
        },
        updateProductChildrenData(res) {
            console.log(res)
            this.ProductChildrenData = res.data
        }
    }

}


</script>

<style scoped>

</style>
