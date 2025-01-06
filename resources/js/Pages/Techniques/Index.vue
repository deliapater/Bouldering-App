<template>
    <v-container fluid class="pa-6 mt-10">
        <h1 class="text-2xl font-bold mb-4">Techniques</h1>

        <v-row v-if="loading" justify="center">
            <v-progress-circular
                indeterminate
                color="primary"
                size="ma-5"
            ></v-progress-circular>
        </v-row>

        <TechniquesList :techniques="techniques" />
    </v-container>
</template>

<script>
import { mapGetters } from "vuex/dist/vuex.cjs.js";
import TechniquesList from "../../Components/Techniques/TechniquesList.vue";

export default {
    components: {
        TechniquesList,
    },
    computed: {
        ...mapGetters("techniques", ["techniques", "loading"]),
    },
    mounted() {
        if (!this.techniques.length) {
            this.$store.dispatch("techniques/fetchTechniques");
        }
    },
};
</script>
