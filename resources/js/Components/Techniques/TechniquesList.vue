<template>
    <div>
        <div v-if="loading" class="text-center py-4">
            <span>Loading techniques...</span>
        </div>

        <div v-else>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                <div v-for="technique in techniques" :key="technique.id" class="bg-white p-4 rounded-lg shadow-md">
                    <img :src="getImageUrl(technique.image)" alt="" class="w-full h-48 object-cover rounded-md" >
                    <h3 class="text-xl font-semibold mt-2">{{ technique.name }}</h3> 
                    <p class="text-gray-600 capitalize">{{ technique.difficulty_level }}</p>
                    <p class="text-gray-500">{{ technique.description }}</p>
                    <div class="mt-4">
                        <inertia-link :href="`/techniques/${technique.id}`" class="text-blue-600 hover:text-blue-800">View Details</inertia-link>
                    </div>
                </div>
            </div>

            <div class="mt-4">
                <div class="flex justify-between items-center">
                    <button
                    v-if="links.prev"
                    @click="fetchTechniques(links.prev)"
                    class="px-4 py-2 bg-gray-200 rounded-md">
                     Previous   
                    </button>

                    <button
                    v-if="links.next"
                    @click="fetchTechniques(links.next)"
                    class="px-4 py-2 bg-gray-200 rounded-md">
                     Next   
                    </button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import { mapState, mapActions } from 'vuex';

export default {
    computed: {
        ...mapState('techniques', ['techniques', 'links', 'loading']),
    },
    methods: {
        ...mapActions('techniques', ['fetchTechniques']),
        getImageUrl(image) {
            return `/images/${image}`;
        }
    },
    mounted() {
        this.fetchTechniques();
    }
}
</script>