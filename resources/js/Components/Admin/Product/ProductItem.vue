<template>
    <tr class="border-b border-gray-200">
        <td :class="[product.parent_id ? 'bg-gray-50' : 'bg-white' ,'text-center border-b border-slate-100 dark:border-slate-700 p-4 text-slate-500 dark:text-slate-400']">
            {{ product.id }}
        </td>
        <td  :class="[product.parent_id ? 'bg-gray-50' : 'bg-white' ,'text-center border-b border-slate-100 dark:border-slate-700 p-4 text-slate-500 dark:text-slate-400']">
            <Link :href="route('admin.products.show', product.id)">{{ product.title }}</Link>
        </td>
        <td  :class="[product.parent_id ? 'bg-gray-50' : 'bg-white' ,'text-center border-b border-slate-100 dark:border-slate-700 p-4 text-slate-500 dark:text-slate-400']">
            {{ product.price }}
        </td>
        <td  :class="[product.parent_id ? 'bg-gray-50' : 'bg-white' ,'text-center border-b border-slate-100 dark:border-slate-700 p-4 text-slate-500 dark:text-slate-400']">
            {{ product.qty }}
        </td>
        <td  :class="[product.parent_id ? 'bg-gray-50' : 'bg-white' ,'text-center border-b border-slate-100 dark:border-slate-700 p-4 text-slate-500 dark:text-slate-400']">
            <div class="flex items-center justify-center">
                <Link :href="route('admin.products.children.create', product.id)" class="mr-2">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                         stroke="currentColor" class="size-4 cursor-pointer">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M12 9v6m3-3H9m12 0a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z"/>
                    </svg>
                </Link>
                <Link :href="route('admin.products.edit', product.id)" class="mr-2">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                         stroke="currentColor" class="text-emerald-600 size-4  cursor-pointer">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="m16.862 4.487 1.687-1.688a1.875 1.875 0 1 1 2.652 2.652L6.832 19.82a4.5 4.5 0 0 1-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 0 1 1.13-1.897L16.863 4.487Zm0 0L19.5 7.125"/>
                    </svg>
                </Link>
                <svg @click.prevent="deleteProduct(product)" xmlns="http://www.w3.org/2000/svg" fill="none"
                     viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor"
                     class="text-red-600 size-4 cursor-pointer">
                    <path stroke-linecap="round" stroke-linejoin="round"
                          d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0"/>
                </svg>
            </div>
        </td>
        <td  :class="[product.parent_id ? 'bg-gray-50' : 'bg-white' ,'text-center border-b border-slate-100 dark:border-slate-700 p-4 text-slate-500 dark:text-slate-400']">
            <svg v-if="!product.parent_id && is_closed" @click="getProductChildren" xmlns="http://www.w3.org/2000/svg"
                 fill="none"
                 viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 cursor-pointer mx-auto">
                <path stroke-linecap="round" stroke-linejoin="round" d="m19.5 8.25-7.5 7.5-7.5-7.5"/>
            </svg>
            <svg v-if="!product.parent_id && !is_closed" @click="closeProductChildren"
                 xmlns="http://www.w3.org/2000/svg" fill="none"
                 viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 cursor-pointer mx-auto">
                <path stroke-linecap="round" stroke-linejoin="round" d="m4.5 15.75 7.5-7.5 7.5 7.5"/>
            </svg>
        </td>
    </tr>

</template>

<script>
import axios from "axios";
import {Link} from "@inertiajs/vue3";

export default {
    name: "ProductItem",

    props: {
        product: Object,
    },

    data() {
        return {
            is_closed: true
        }
    },

    components: {
        Link,
    },

    methods: {
        deleteProduct(product) {
            axios.delete(route('admin.products.destroy', product.id))
                .then(res => {
                    this.$emit('product_deleted', product)
                })
        },
        getProductChildren() {
            axios.get(route('admin.products.children.index', this.product.id))
                .then(res => {
                    this.is_closed = false
                    this.product.children = res.data
                });
        },
        closeProductChildren() {
            this.is_closed = true
            this.product.children = null
        }
    },

}
</script>

<style scoped>

</style>
