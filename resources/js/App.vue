<template>
    <div id="app">
        <header class="bg-gray-800 text-white shadow">
            <div class="container mx-auto px-4 py-4 flex justify-between items-center">
                <h1 class="text-lg font-bold">Bouldering App</h1>
                <nav>
                    <ul class="flex space-x-4">
                        <li><router-link to="/" class="hover:underline">Home</router-link></li>
                        <li><router-link to="/techniques" class="hover:underline">Techniques</router-link></li>
                        <li><router-link to="/profile" class="hover:underline">Profile</router-link></li>
                    </ul>
                </nav>
            </div>
        </header>
        <div class="flex flex-col lg:flex-row">
            <aside class="bg-gray-100 w-full lg:w-1/4 p-4">
                <ul class="space-y-2">
                    <li><router-link to="/techniques" class="block hover:bg-gray-200 rounded">Techniques</router-link></li>
                    <li><router-link to="/gear" class="block hover:bg-gray-200 rounded">Gear</router-link></li>
                    <li><router-link to="/settings" class="block hover:bg-gray-200 rounded">Settings</router-link></li>
                </ul>
            </aside>

            <main class="flex-1 bg-white p-6">
                <router-view />
            </main>
        </div>
    </div>
</template>

<script>
export default {
    name: 'App'
}
</script>