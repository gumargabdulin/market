<template>
    <section class="w-full border-b bg-grey-50 p-4">
        <header>
            Market Admin
        </header>
    </section>
    <section class="flex">
        <aside class="w-1/4 bg-indigo-50 min-h-screen">
            <nav>

            </nav>
        </aside>
        <article class="w-3/4 bg-gray-100">
            <slot/>
        </article>
    </section>
    <section>
        <footer>

        </footer>
    </section>
</template>
<script>
export default {
    name: "AdminLayout"
}
</script>


<style scoped>

</style>
