<template>
    <div>
        <div class="mb-4">
            <Link :href="route('admin.categories.index')" class="inline-block py-2 px-3 bg-sky-600 border border-sky-500 text-white">Назад</Link>
        </div>
        <div>
            <div class="mb-4">
                <input type="text" v-model="category.title" class="block border border-gray-700 p-2 w-1/4" placeholder="title">
            </div>
            <div class="mb-4">
                <select v-model="category.parent_id" class="w-1/4">
                    <option :value="null" disabled selected>Выберете категорию</option>
                    <option v-for="category in categories" :value="category.id">{{category.title}}</option>
                </select>
            </div>
            <div class="mb-4">
                <a href="#" @click.prevent="storeCategory" class="inline-block py-2 block bg-indigo-500 border border-b-indigo-400 p-2" >Создать</a>
            </div>
        </div>
    </div>
</template>
<script>
import {Link} from "@inertiajs/vue3";
import AdminLayout from "@/Layouts/AdminLayout.vue";

export default {
    name: "Create",
    layout: AdminLayout,
    props: {
        categories: Array
    },
    components: {
        Link
    },
    data() {
      return {
        category:{
            parent_id:null
        }
      }
    },
    methods:{
        storeCategory(){
            axios.post(route('admin.categories.store'), this.category)
                .then(res => {
                    this.categories.push(res.data)
                    this.category={
                        parent_id: null
                    }
                })
        }
    }
}

</script>


<style scoped>

</style>
