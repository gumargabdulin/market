<template>
    <aside class="w-1/4 bg-gray-600 min-h-screen">
        <nav class="p-4">
            <div>
                <template v-for="param in params">
                    <div v-if="param.filter_type===3" class="mb-4 pb-4 border-b border-gray-700">
                        <div>
                            <h3 class="text-white mb-2">{{ param.title }}</h3>
                        </div>
                        <div class="text-white">
                            {{this.filters.checkbox[param.id]}}
                        </div>
                        <div>
                            <div v-for="value in param.param_values" class="mb-2 flex items-center">
                                <input @change=setFilter(param,value) class="mr-2" type="checkbox" :value="value" :id="value">
                                <label class="text-sm text-gray-300" :for="value">{{ value }}</label>
                            </div>
                        </div>
                    </div>
                    <div v-if="param.filter_type===1" class="mb-4 pb-4 border-b border-gray-700">
                        <div>
                            <h3 class="text-white mb-2">{{ param.title }}</h3>
                        </div>
                        <div>
                            <div class="mb-2 flex items-center">
                                <input v-model="filters.integer.from[param.id]" class="border border-gray-200 p-2" type="text" placeholder="От">
                                <input v-model="filters.integer.to[param.id]" class="border border-gray-200 p-2" type="text" placeholder="До">
                            </div>
                        </div>
                    </div>
                </template>
                <div>
                    <a @click.prevent="getPosts" href="#" class="block px-3 py-2 text-gray-300 bg-indigo-800 border border-indigo-900">Фильтр</a>
                </div>
            </div>
        </nav>
    </aside>
    <article class="w-3/4 bg-gray-100 p-4">
        <div class="mb-4">
            <template v-for="breadcrumb in breadcrumbs">
                <Link :href="route('client.categories.products.index', breadcrumb.id)">{{ breadcrumb.title }}</Link>
                <span> / </span>
            </template>
            <span>{{ category.title }}</span>
        </div>
        <div class="grid grid-cols-3 gap-4">
            <ProductItem v-for="product in productData" :product="product"></ProductItem>
        </div>
    </article>
</template>

<script>
import {Link} from "@inertiajs/vue3";
import MainLayout from "@/Layouts/MainLayout.vue";
import ProductItem from "@/Components/Client/Product/ProductItem.vue";

export default {
    name: "ProductIndex",
    layout: MainLayout,
    components: {Link, ProductItem},
    props: {
        products: Array,
        breadcrumbs: Array,
        category: Object,
        params: Array
    },
    data() {
        return {
            productData:this.products,
            filters:{
                integer:{
                    from:{},
                    to:{},
                },
                select:{},
                checkbox:{}
            }
        }
    },
    methods:{
        setFilter(param,value){
            if(this.filters.checkbox[param.id]){
                this.toggleItem(this.filters.checkbox[param.id], value)
                return
            }
            this.filters.checkbox[param.id]=[]
            this.filters.checkbox[param.id].push(value)
        },
        toggleItem(arr, value){
            let index = arr.indexOf(value)
            index === -1 ? arr.push(value) : arr.splice(index, 1)
        },
        getPosts(){
            this.clean(this.filters.integer.from)
            this.clean(this.filters.integer.to)

            axios.get(route('client.categories.products.index', this.category.id), {
                params:this.filters
            }).then(
                res => {
                    this.productData=res.data
                }
            )
        },
        clean(obj){
            Object.keys(obj).forEach(key =>{
                if(!obj[key]){
                    delete obj[key]
                }
            })
        }
    }

}
</script>


<style scoped>

</style>
