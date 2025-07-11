<template>
    <div>
        <div class="mb-4">
            <Link :href="route('admin.products.index')"
                  class="inline-block py-2 px-3 bg-sky-600 border border-sky-500 text-white">Назад
            </Link>
        </div>
        <div v-if="success" class="p-4 bg-green-500 mb-4">
            Успешно добавлено!
        </div>
        <div>
            <div class="mb-4">
                <input type="text" v-model="entries.product.title" class="block border border-gray-700 p-2 w-1/4"
                       placeholder="title">
            </div>
            <div class="mb-4">
                <input type="text" v-model="entries.product.article" class="block border border-gray-700 p-2 w-1/4"
                       placeholder="Артикул">
            </div>
            <div class="mb-4">
                <textarea type="text" v-model="entries.product.description"
                          class="block border border-gray-700 p-2 w-1/4" placeholder="Описание"></textarea>
            </div>
            <div class="mb-4">
                <textarea type="text" v-model="entries.product.content" class="block border border-gray-700 p-2 w-1/4"
                          placeholder="Контент"></textarea>
            </div>
            <div class="mb-4">
                <input type="number" v-model="entries.product.price" class="block border border-gray-700 p-2 w-1/4"
                       placeholder="Цена">
            </div>
            <div class="mb-4">
                <input type="number" v-model="entries.product.old_price" class="block border border-gray-700 p-2 w-1/4"
                       placeholder="Старая цена">
            </div>
            <div class="mb-4">
                <input type="number" v-model="entries.product.qty" class="block border border-gray-700 p-2 w-1/4"
                       placeholder="Колличество на складе">
            </div>
            <div class="mb-4">
                <select v-model="entries.product.category_id" class="w-1/4">
                    <option :value="null" disabled selected>Выберете категорию</option>
                    <option v-for="category in categories" :value="category.id">{{ category.title }}</option>
                </select>
            </div>
            <div class="mb-4">
                <select v-model="entries.product.product_group_id" class="w-1/4">
                    <option :value="null" disabled selected>Выберете группу продуктов</option>
                    <option v-for="product_group in productGroups" :value="product_group.id">{{ product_group.title }}
                    </option>
                </select>
            </div>
            <div class="mb-4">
                <input ref="image_input" @change="setImages" multiple type="file" class="block border border-gray-700 p-2 w-1/4">
            </div>
            <div class="mb-4 flex">
                <div class="mr-2">
                    <select v-model="paramOption.paramObj" class="border border-gray-700 p-2 pr-8">
                        <option :value="{}" disabled selected>Выберете харкатеристику</option>
                        <option v-for="param in params" :value="param">{{ param.title }}</option>
                    </select>
                </div>
                <div class="mr-2">
                    <input v-model="paramOption.value" type="text" placeholder="Значение"
                           class="block border border-gray-700 p-2">
                </div>
                <div>
                    <a @click.prevent="setParam" href="#"
                       class="inline-block bg-white border border-gray-200 px-2 py-2">+</a>
                </div>
            </div>
            <div class="mb-4">
                <div v-for="paramEntries in entries.params" class="flex items-center mb-2">
                    <div class="mr-2">
                        {{ paramEntries.title }} - {{ paramEntries.value }}
                    </div>
                    <div>
                        <svg @click.prevent="removeParam(paramEntries)" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="cursor-pointer size-6">
                            <path stroke-linecap="round" stroke-linejoin="round" d="m9.75 9.75 4.5 4.5m0-4.5-4.5 4.5M21 12a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                        </svg>
                    </div>
                </div>
            </div>
            <div class="mb-4">
                <a href="#" @click.prevent="storeProduct"
                   class="inline-block py-2 block bg-indigo-500 border border-b-indigo-400 p-2">Создать</a>
            </div>
        </div>
    </div>
</template>
<script>
import {Link} from "@inertiajs/vue3";
import AdminLayout from "@/Layouts/AdminLayout.vue";

export default {
    name: "CreateChild",
    layout: AdminLayout,
    props: {
        categories: Array,
        productGroups: Array,
        params: Array,
        product: Object,
    },
    components: {
        Link
    },
    data() {
        return {
            success: false,
            paramOption: {
                paramObj: {}
            },
            entries: {
                product: this.product,
                images: null,
                params:this.product.params
            }
        }
    },
    methods: {
        storeProduct() {
            this.entries.product.parent_id = this.product.id
            axios.post(route('admin.products.store'), this.entries, {
                headers: {
                    "Content-Type": "multipart/form-data"
                }
            })
                .then(res => {
                    this.product.images = res.data.images
                    this.$refs.image_input.value=null

                    this.$nextTick(() => {
                        this.success = true
                    })
                })
        },
        setImages(e) {
            this.entries.images = e.target.files
        },
        setParam() {
            this.entries.params.push({
                id: this.paramOption.paramObj.id,
                title: this.paramOption.paramObj.title,
                value: this.paramOption.value,
            })
        },
        removeParam(paramEntries){
            this.entries.params = this.entries.params.filter(param => param !== paramEntries)
        }
    },
    watch: {
        product: {
            handler(new_val, old_val) {
                this.success = false
            },
            deep: true
        }
    }
}

</script>


<style scoped>

</style>
