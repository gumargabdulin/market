<template>
    <article class="w-full max-w-6xl mx-auto px-8 py-6 bg-white rounded shadow-sm">
        <Breadcrumb :breadcrumbs="breadcrumbs" :current="product.title" />

        <div class="flex flex-wrap gap-10 mt-6">
            <!-- Галерея -->
            <div class="flex gap-4">
                <div class="flex flex-col gap-2 w-24">
                    <img
                        v-for="image in product.images"
                        :key="image.id"
                        @click="selectedImage = image"
                        :src="image.url"
                        :alt="product.title"
                        class="w-full h-20 object-cover border cursor-pointer hover:ring-2 ring-green-500"
                    />
                </div>
                <div>
                    <img
                        :src="selectedImage.url"
                        :alt="product.title"
                        class="w-[400px] h-[400px] object-cover border rounded"
                    />
                </div>
            </div>

            <!-- Информация о продукте -->
            <div class="flex flex-col justify-between min-w-[300px] flex-1 gap-4">
                <div>
                    <h1 class="text-2xl font-bold text-gray-800 mb-2">{{ product.title }}</h1>

                    <div class="flex items-center gap-3 mb-4">
                        <span class="text-2xl text-green-600 font-semibold">{{ product.price }} ₽</span>
                        <span
                            v-if="product.old_price"
                            class="line-through text-gray-500 text-lg"
                        >
                            {{ product.old_price }} ₽
                        </span>
                    </div>

                    <p class="text-gray-700 mb-6">{{ product.discription }}</p>
                </div>

                <!-- Параметры товара -->
                <div
                    v-if="paramProducts.length > 0"
                    class="bg-gray-50 border rounded px-4 py-3"
                >
                    <h3 class="text-lg font-semibold text-gray-700 mb-2">Характеристики:</h3>
                    <div class="flex flex-col gap-2">
                        <div
                            v-for="paramProduct in paramProducts"
                            :key="paramProduct.title"
                        >
                            <div class="text-sm font-medium text-gray-600 mb-1">
                                {{ paramProduct.title }}
                            </div>
                            <div class="flex flex-wrap gap-2">
                                <Link
                                    v-for="paramItem in paramProduct.data"
                                    :key="paramItem.id"
                                    :href="route('client.products.show', paramItem.product_id)"
                                    class="px-3 py-1 rounded bg-gray-200 hover:bg-gray-300 text-sm text-gray-700"
                                >
                                    {{ paramItem.value }}
                                </Link>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Купить -->
                <div class="flex items-center gap-3">
                    <input
                        type="number"
                        min="1"
                        value="1"
                        class="w-20 border rounded px-2 py-1"
                    />
                    <button
                        type="submit"
                        class="bg-green-600 hover:bg-green-700 text-white font-semibold py-2 px-6 rounded"
                    >
                        Купить
                    </button>
                </div>
            </div>

            <!-- Варианты группы -->
            <div class="w-48">
                <h3 class="text-lg font-medium mb-2 text-gray-700">Другие варианты</h3>
                <div class="flex flex-col gap-3">
                    <Link
                        v-for="groupProduct in product.group_products"
                        :key="groupProduct.id"
                        :href="route('client.products.show', groupProduct.id)"
                        class="block border rounded hover:shadow p-2"
                    >
                        <img
                            :src="groupProduct.preview_image_url"
                            :alt="groupProduct.title"
                            class="w-full h-20 object-cover mb-1 rounded"
                        />
                        <div class="text-sm text-gray-700">{{ groupProduct.title }}</div>
                        <div class="flex items-center gap-2 text-sm">
                            <span class="text-green-600 font-medium">{{ groupProduct.price }} ₽</span>
                            <span
                                v-if="groupProduct.old_price"
                                class="line-through text-gray-500"
                            >
                                {{ groupProduct.old_price }} ₽
                            </span>
                        </div>
                    </Link>
                </div>
            </div>
        </div>

        <!-- Описание -->
        <div class="mt-10">
            <h2 class="text-xl font-semibold text-gray-800 mb-2">Описание</h2>
            <p class="text-gray-700 leading-relaxed">{{ product.content }}</p>
        </div>
    </article>
</template>




<script>
import MainLayout from "@/Layouts/MainLayout.vue";
import { Link } from "@inertiajs/vue3";
import Breadcrumb from "@/Pages/Client/Category/Breadcrumb.vue";

export default {
    name: "Show",
    components: { Link, Breadcrumb },
    layout: MainLayout,

    props: {
        product: Object,
        breadcrumbs: Array,
        paramProducts: Array
    },
    data() {
        return {
            selectedImage: { url: this.product.preview_image_url }
        }
    }
}
</script>

<style scoped>
/* Всё через Tailwind, кастомных стилей не нужно */
</style>
