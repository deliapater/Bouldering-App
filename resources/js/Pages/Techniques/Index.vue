<template>
    <div>
        <h1 class="text-2xl font-bold mb-4">Techniques</h1>
        <div v-if="loading" class="text-center py-4">Loading...</div>
        <TechniquesList :techniques="techniques"/>
    </div>
</template>

<script>
import { mapGetters } from 'vuex/dist/vuex.cjs.js';
import TechniquesList from '../../Components/Techniques/TechniquesList.vue';

export default {
    components: {
        TechniquesList,
    },
    computed: {
        ...mapGetters('techniques', ['techniques', 'loading']),
    },
    mounted() {
        if (!this.techniques.length) {
            this.$store.dispatch('techniques/fetchTechniques');
        }
    },
};
</script>