
<template>
    <div class="p-4 border border-gray-200 bg-white">
        <Link :href="route('client.products.show', product.id)"><h3>{{product.title}}</h3></Link>
        <img :src="product.preview_image_url" :alt="product.title" class="w-[200px] h-[200px] object-cover">
        <div class="flex items-center justify-between">
            <p>{{product.price}}</p>
            <p>{{product.old_price}}</p>
        </div>
        <div>
            <CreateOrUpdateCart :product="product"></CreateOrUpdateCart>
        </div>
    </div>
</template>

<script>
import {Link} from "@inertiajs/vue3";
import CreateOrUpdateCart from "@/Components/Client/Cart/CreateOrUpdateCart.vue";
export default {
    name: "ProductItem",
    props:{
        product:Array
    },
    components:{
        Link, CreateOrUpdateCart
    }
}
</script>


<style scoped>

</style>
