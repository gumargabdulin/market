<template>
    <article class="w-3/4 bg-gray-100 p-4">
      <Breadcrumb :breadcrumbs="breadcrumbs" :current="product.title"/>
        <div class="flex">
            <div>
                <div style="width: 100px">
                    <div v-for="image in product.images">
                        <img :src="image.url" :alt="product.title">
                    </div>
                </div>
                <img :src="product.preview_image_url" :alt="product.title">
            </div>
            <div>
                <div>
                    <h3>{{ product.title }}</h3>
                </div>
                <div >
                    <span class="mr-3">{{product.price}}</span>
                    <span>{{product.old_price}}</span>
                </div>
                <div>
                    <p>{{product.discription}}</p>
                </div>
                <div>
                    <input type="number" value="1">
                    <button type="submit"
                            class="bg-green-600 hover:bg-green-700 text-white font-semibold py-2 px-4 rounded">
                        Купить
                    </button>
                </div>
            </div>
        </div>
        <div>
            <h3>Описание</h3>
            <p>{{product.content}}</p>
        </div>
    </article>
</template>

<script>
import MainLayout from "@/Layouts/MainLayout.vue";
import {Link} from "@inertiajs/vue3";
import Breadcrumb from "@/Pages/Client/Category/Breadcrumb.vue";

export default {
    name: "Show",
    components: {Link, Breadcrumb},
    layout: MainLayout,

    props: {
        product: Object,
        breadcrumbs: Array
    }
}
</script>


<style scoped>

</style>
