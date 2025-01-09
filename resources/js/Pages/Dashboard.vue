<template>
    <v-container fluid class="pa-6 mt-10">
        <h2 class="text-2xl font-bold mb-4">Welcome to Your Dashboard</h2>
        <p class="text-gray-600">
            Here you can manage your techniques, gear and more.
        </p>

        <v-row class="mt-6">
            <v-col>
                <h3 class="text-xl font-semibold">Your Techniques</h3>
                <TechniquesList />
            </v-col>
        </v-row>
        <v-btn @click="openFormModalBtn">Add Technique</v-btn>
        <TechniqueFormModal />
    </v-container>
</template>

<script>
import TechniqueFormModal from "../Components/Techniques/TechniqueFormModal.vue";
import TechniquesList from "../Components/Techniques/TechniquesList.vue";

export default {
    name: "Dashboard",
    components: {
        TechniquesList,
        TechniqueFormModal
    },
    computed: {
        techniques() {
            return this.$store.getters['techniques/techniques'];
        },
    },
    methods: {
        openFormModalBtn() {
            this.$store.dispatch('techniques/openFormModal');
        }
    }
};
</script>
