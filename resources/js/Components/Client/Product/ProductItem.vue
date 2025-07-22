
<template>
    <div class="p-4 border border-gray-200 bg-white">
        <h3>{{product.title}}</h3>
        <img :src="product.preview_image_url" :alt="product.title" class="w-[200px] h-[200px] object-cover">
        <div class="flex items-center justify-between">
            <p>{{product.price}}</p>
            <p>{{product.old_price}}</p>
        </div>
        <div>
            <a href="#" class="block p-4 bg-indigo-600 text-white text-center">Купить</a>
        </div>
    </div>
</template>

<script>
export default {
    name: "ProductItem",
    props:{
        product:Array
    }
}
</script>


<style scoped>

</style>
