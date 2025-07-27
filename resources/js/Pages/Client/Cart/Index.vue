<template>
    <article class="w-full max-w-6xl mx-auto px-8 py-6 bg-white rounded shadow-sm">
        <div>
            <table class="min-w-full bg-white shadow-md rounded-lg overflow-hidden">
                <thead class="bg-gray-100">
                <tr>
                    <th class="text-left px-6 py-3 text-gray-600 font-semibold uppercase text-sm">ID</th>
                    <th class="text-left px-6 py-3 text-gray-600 font-semibold uppercase text-sm">Наименование</th>
                    <th class="text-left px-6 py-3 text-gray-600 font-semibold uppercase text-sm">Изображение</th>
                    <th class="text-left px-6 py-3 text-gray-600 font-semibold uppercase text-sm">Колличество</th>
                    <th class="text-left px-6 py-3 text-gray-600 font-semibold uppercase text-sm">Сумма</th>
                    <th class="text-left px-6 py-3 text-gray-600 font-semibold uppercase text-sm">Действие</th>
                </tr>
                </thead>
                <tbody>
                <tr v-for="cart in cartsData">
                    <td class="px-6 py-4 border-b border-gray-200 text-gray-800">{{ cart.id }}</td>
                    <td class="px-6 py-4 border-b border-gray-200 text-gray-800">{{ cart.product_title }}</td>
                    <td class="px-6 py-4 border-b border-gray-200 text-gray-800">
                        <img :src="cart.product_image" class="w-30">
                    </td>
                    <td class="px-6 py-4 border-b border-gray-200 text-gray-800">
                        <div class="cursor-pointer" @click.prevent="cart.qty >1 ? cart.qty -- : ''; updateCart(cart)">
                            -
                        </div>
                        <input type="number" min="1" :value="cart.qty" class="w-20 border rounded px-2 py-1"/>
                        <div class="cursor-pointer" @click.prevent="cart.qty++; updateCart(cart)">+</div>
                    </td>
                    <td class="px-6 py-4 border-b border-gray-200 text-gray-800">{{ cart.total_sum }}</td>
                    <td class="px-6 py-4 border-b border-gray-200 text-gray-800">
                        <svg @click.prevent="destroyCart(cart)" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-6 text-red-600 cursor-pointer">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m14.74 9-.346 9m-4.788 0L9.26 9m9.968-3.21c.342.052.682.107 1.022.166m-1.022-.165L18.16 19.673a2.25 2.25 0 0 1-2.244 2.077H8.084a2.25 2.25 0 0 1-2.244-2.077L4.772 5.79m14.456 0a48.108 48.108 0 0 0-3.478-.397m-12 .562c.34-.059.68-.114 1.022-.165m0 0a48.11 48.11 0 0 1 3.478-.397m7.5 0v-.916c0-1.18-.91-2.164-2.09-2.201a51.964 51.964 0 0 0-3.32 0c-1.18.037-2.09 1.022-2.09 2.201v.916m7.5 0a48.667 48.667 0 0 0-7.5 0" />
                        </svg>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
    </article>
</template>


<script>
import MainLayout from "@/Layouts/MainLayout.vue";
import {Link} from "@inertiajs/vue3";

export default {
    name: "Index",
    components: {Link},
    layout: MainLayout,

    props: {
        carts: Array
    },
    data() {
        return {
            cartsData: this.carts
        }
    },
    methods: {
        updateCart(cart) {
            axios.patch(route('client.carts.update', cart.id), {qty: cart.qty})
                .then(
                    res => {
                        cart.total_sum = res.data.total_sum
                        this.$page.props.auth.user.carts_total_sum = res.data.carts_total_sum
                    }
                )
        },
        destroyCart(cart){
            axios.delete(route('client.carts.destroy', cart.id))
                .then(
                    res => {
                        this.cartsData = this.cartsData.filter(cartData => cartData.id !== cart.id)
                        this.$page.props.auth.user.carts_total_sum = this.$page.props.auth.user.carts_total_sum - cart.total_sum
                    }
                )
        }
    }
}
</script>

<style scoped>
</style>
