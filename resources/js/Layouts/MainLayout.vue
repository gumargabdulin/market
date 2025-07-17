<template>
    <section class="w-full border-b bg-grey-50 p-4">
        <header>
            Market Admin
        </header>
    </section>
    <section class="flex">
        <slot/>
    </section>
    <section>
        <footer>

        </footer>
    </section>
</template>
<script>
import {Link} from "@inertiajs/vue3";

export default {
    name: "MainLayout",

    components:{
        Link
    }
}
</script>


<style scoped>

</style>
