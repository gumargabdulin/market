<template>
    <div>
        <div class="mb-4">
            <Link :href="route('admin.params.index')" class="inline-block py-2 px-3 bg-sky-600 border border-sky-500 text-white">Назад</Link>
        </div>
        <div v-if="success" class="p-4 bg-green-500 mb-4">
            Успешно сохранено!
        </div>
        <div>
            <div class="mb-4">
                <input type="text" v-model="param.title" class="block border border-gray-700 p-2 w-1/4" placeholder="title">
            </div>
            <div class="mb-4">
                <select v-model="param.filter_type" class="w-1/4">
                    <option :value="null" disabled selected>Выберете тип фильтра</option>
                    <option v-for="filterType in filterTypes" :value="filterType.value">{{filterType.title}}</option>
                </select>
            </div>
            <div class="mb-4">
                <a href="#" @click.prevent="updateParam" class="inline-block py-2 block bg-indigo-500 border border-b-indigo-400 p-2" >Обновить</a>
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
        param: Object,
        filterTypes: Array
    },
    data(){
        return {
            success: false
        }
    },
    components: {
        Link
    },
    methods:{
        updateParam(){
            axios.patch( route('admin.params.update', this.param), this.param)
                .then(res => {
                    this.success=true
                })
        }
    },
    watch:{
        param:{
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
