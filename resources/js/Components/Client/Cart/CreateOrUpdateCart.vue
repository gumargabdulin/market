<template>
    <div class="flex items-center gap-4">
        <div v-if="product.cart.qty">
            <div class="cursor-pointer" @click.prevent="cart.qty >1 ? cart.qty -- : ''; updateCart()">-</div>
            <input type="number" min="1" :value="cart.qty" class="w-20 border rounded px-2 py-1"/>
            <div class="cursor-pointer" @click.prevent="cart.qty++; updateCart()">+</div>
        </div>
        <button v-if="!product.cart.qty" @click.prevent="storeCarts" type="submit"
                class="bg-green-600 hover:bg-green-700 text-white font-semibold py-2 px-6 rounded">Купить
        </button>
    </div>
</template>

<script>
export default {
    name: "CreateOrUpdateCart",
    props: {
        product: Object
    },
    data() {
        return {
            cart: {
                qty: this.product.cart.qty ?? 1,
                product_id: this.product.id
            },
            cartId: null,
        }
    },
    methods: {
        storeCarts() {
            axios.post(route('client.carts.store'), this.cart)
                .then(
                    res => {
                        this.product.cart = res.data
                    }
                )
        },
        updateCart() {
            axios.patch(route('client.carts.update', this.product.cart.id), this.cart)
                .then(
                    res => {
                        console.log(res.data)
                        this.$page.props.auth.user.carts_total_sum = res.data.carts_total_sum
                    }
                )
        }
    }
}
</script>


<style scoped>

</style>
