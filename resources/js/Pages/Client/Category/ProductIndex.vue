<template>
    <aside class="w-1/4 bg-gray-600 min-h-screen">
        <nav class="p-4">
            <div>
                <div class="mb-4">
                    <div>
                        <Link :href="route('client.categories.index')"><h3 class="text-xl font-semibold text-gray-800 mb-2">Категории</h3></Link>
                    </div>
                    <div v-if="breadcrumbs.length > 0" class="flex flex-col gap-2">
                        <!-- Хлебные крошки (breadcrumbs) -->
                        <div v-if="breadcrumbs.length > 0" class="flex flex-col gap-2 mb-4">
                            <Link
                                v-for="breadcrumb in breadcrumbs"
                                :key="breadcrumb.id"
                                :href="route('client.categories.products.index', breadcrumb.id)"
                                class="flex items-center text-gray-700 hover:text-gray-900 transition"
                            >
                                <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4 mr-2 text-gray-400" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
                                </svg>
                                {{ breadcrumb.title }}
                            </Link>
                        </div>

                        <!-- Дочерние категории -->
                        <div v-if="categoryChildren.length > 0" class="flex flex-col gap-2">
                            <Link
                                v-for="categoryChild in categoryChildren"
                                :key="categoryChild.id"
                                :href="route('client.categories.products.index', categoryChild.id)"
                                class="text-gray-700 hover:text-gray-900 transition"
                            >
                                {{ categoryChild.title }}
                            </Link>
                        </div>
                    </div>
                </div>
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
        <Breadcrumb :breadcrumbs="breadcrumbs" :current="category.title" />
        <div class="grid grid-cols-3 gap-4">
            <ProductItem v-for="product in productData" :product="product"></ProductItem>
        </div>
    </article>
</template>

<script>
import {Link} from "@inertiajs/vue3";
import MainLayout from "@/Layouts/MainLayout.vue";
import ProductItem from "@/Components/Client/Product/ProductItem.vue";
import Breadcrumb from "@/Pages/Client/Category/Breadcrumb.vue";
import breadcrumb from "./Breadcrumb.vue";

export default {
    name: "ProductIndex",
    computed: {
        breadcrumb() {
            return breadcrumb
        }
    },
    layout: MainLayout,
    components: {Link, ProductItem, Breadcrumb},
    props: {
        products: Array,
        breadcrumbs: Array,
        category: Object,
        params: Array,
        categoryChildren: Array,
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
