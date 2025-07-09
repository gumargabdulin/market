<template>
    <div>
        <div class="mb-4">
            <Link :href="route('admin.products.index')" class="inline-block py-2 px-3 bg-sky-600 border border-sky-500 text-white">Назад</Link>
        </div>
        <div v-if="success" class="p-4 bg-green-500 mb-4">
            Успешно сохранено!
        </div>
        <div>
            <div class="mb-4">
                <input type="text" v-model="entries.product.title" class="block border border-gray-700 p-2 w-1/4" placeholder="title">
            </div>
            <div class="mb-4">
                <textarea type="text" v-model="entries.product.description" class="block border border-gray-700 p-2 w-1/4" placeholder="Описание"></textarea>
            </div>
            <div class="mb-4">
                <textarea type="text" v-model="entries.product.content" class="block border border-gray-700 p-2 w-1/4" placeholder="Контент"></textarea>
            </div>
            <div class="mb-4">
                <input type="number" v-model="entries.product.price" class="block border border-gray-700 p-2 w-1/4" placeholder="Цена">
            </div>
            <div class="mb-4">
                <input type="number" v-model="entries.product.old_price" class="block border border-gray-700 p-2 w-1/4" placeholder="Старая цена">
            </div>
            <div class="mb-4">
                <input type="number" v-model="entries.product.qty" class="block border border-gray-700 p-2 w-1/4" placeholder="Колличество на складе">
            </div>
            <div class="mb-4">
                <select v-model="entries.product.category_id" class="w-1/4">
                    <option :value="null" disabled selected>Выберете категорию</option>
                    <option v-for="category in categories" :value="category.id">{{category.title}}</option>
                </select>
            </div>
            <div class="mb-4">
                <select v-model="entries.product.product_group_id" class="w-1/4">
                    <option :value="null" disabled selected>Выберете группу продуктов</option>
                    <option v-for="product_group in productGroups" :value="product_group.id">{{product_group.title}}</option>
                </select>
            </div>
            <div class="mb-4">
                <input @change="setImages" multiple type="file" class="block border border-gray-700 p-2 w-1/4">
            </div>
            <div>
                <div class="grid grid-cols-3">
                    <div v-for="image in product.images" class="mb-4">
                        <img :src="image.url" :alt="product.title" class="mb-2">
                        <div class="text-center">
                            <a @click.prevent="deleteImage(image)" href="#" class="inline-block px-2 py-1 px-2 text-sm bg-red-400 text-gray-50 border border-red-600">Удалить</a>
                        </div>
                    </div>
                </div>

            </div>
<!--            <div class="mb-4">-->
<!--                <input type="file" v-model="entries.images" class="block border border-gray-700 p-2 w-1/4">-->
<!--            </div>-->
<!--            <div class="mb-4">-->
<!--                <select v-model="entries.params" class="w-1/4">-->
<!--                    <option :value="null" disabled selected>Выберете категорию</option>-->
<!--                    <option v-for="product_group in product_groups" :value="product_group.id">{{product_group.title}}</option>-->
<!--                </select>-->
<!--            </div>-->
            <div class="mb-4">
                <a href="#" @click.prevent="updateProduct" class="inline-block py-2 block bg-indigo-500 border border-b-indigo-400 p-2" >Сохранить</a>
            </div>
        </div>
    </div>
</template>
<script>
import {Link} from "@inertiajs/vue3";
import AdminLayout from "@/Layouts/AdminLayout.vue";

export default {
    name: "Edit",
    layout: AdminLayout,
    props: {
        categories: Array,
        productGroups: Array,
        product: Object
    },
    components: {
        Link
    },
    data() {
      return {
          success: false,
          entries:{
              product:this.product,
              images:null,
              _method: 'patch',
              // params:[]
          }
      }
    },
    methods:{
        updateProduct(){
            axios.post( route('admin.products.update', this.product.id), this.entries, {
                headers:{
                    "Content-Type": "multipart/form-data"
                }
            })
                .then(res => {
                    this.product.images = res.data.images
                    this.$nextTick(() => {
                        this.success = true
                    })

                })
        },
        setImages(e){
            this.entries.images = e.target.files
        },
        deleteImage(image){
            axios.delete(route('admin.images.destroy', image.id))
                .then(
                    res => {
                        this.product.images = this.product.images.filter(productImage => productImage.id !== image.id)
                        this.$nextTick(() => {
                            this.success = true
                        })
                    }
                )
        }
    },
    watch:{
        product:{
            handler(new_val, old_val){
                this.success =  false
            },
            deep:true
        }
    }
}

</script>


<style scoped>

</style>
