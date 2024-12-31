<template>
    <div class="dashboard-layout">
        <header class="bg-gray-800 text-white shadow">
            <div class="container mx-auto px-4 py-4 flex justify-between items-center">
                <h1 class="text-lg font-bold">Bouldering App</h1>
                <nav>
                    <ul class="flex space-x-4">
                        <li><interia-link href="/" class="hover:underline"></interia-link>Home</li>
                        <li><interia-link href="/techniques" class="hover:underline"></interia-link>Techniques</li>
                        <li><interia-link href="/profile" class="hover:underline"></interia-link>Profile</li>
                    </ul>
                </nav>
            </div>
        </header>
        <div class="flex flex-col lg:flex-row">
            <aside class="bg-gray-100 w-full lg:w-1/4 p-4">
                <ul class="space-y-2">
                    <li><inertia-link href="/techniques" class="block hover:bg-gray-200 rounded">Techniques</inertia-link></li>
                    <li><inertia-link href="/gear" class="block hover:bg-gray-200 rounded">Gear</inertia-link></li>
                    <li><inertia-link href="/settings" class="block hover:bg-gray-200 rounded">Settings</inertia-link></li>
                </ul>
            </aside>

            <main class="flex-1 bg-white p-6">
                <slot />
            </main>
        </div>
    </div>
</template>

<script>
    export default {
        name: 'DashboardLayout'
    }
</script>

<style scoped>
.dashboard-layout header {
    position: sticky;
    top: 0;
    z-index: 10;
}
</style>