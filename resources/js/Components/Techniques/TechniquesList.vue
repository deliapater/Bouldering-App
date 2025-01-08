<template>
    <v-container>
        <div v-if="loading" class="text-center py-4">
            <v-progress-circular
                indeterminate
                color="primary"
                size="64"
                class="mx-auto"
            ></v-progress-circular>
            <span>Loading techniques...</span>
        </div>

        <v-row v-else>
            <v-col v-for="technique in techniques" :key="technique.id" cols="12" sm="4">
                <TechniqueCard 
                    :technique="technique"
                    @select="openDetails"
                />
            </v-col>
        </v-row>

        <v-dialog v-model="detailsVisible" max-width="600px" @click:outside="closeDetails">
            <TechniqueDetailsModal 
                v-if="selectedTechnique"
                :technique="selectedTechnique"
                @close="closeDetails"
            />
        </v-dialog>

        <v-row class="mt-4">
            <v-col cols="12" class="d-flex justify-space-between">
                <v-btn
                    v-if="links?.prev"
                    @click="fetchTechniques(links.prev)"
                    color="secondary"
                    outlined
                >
                    Previous
                </v-btn>
                <v-btn
                    v-if="links?.next"
                    @click="fetchTechniques(links.next)"
                    color="secondary"
                    outlined
                >
                    Next
                </v-btn>
            </v-col>
        </v-row>
    </v-container>
</template>

<script>
import { mapState, mapActions, mapGetters } from "vuex";
import TechniqueCard from "./TechniqueCard.vue";
import TechniqueDetailsModal from "./TechniqueDetailsModal.vue";

export default {
    name: 'TechniquesList',
    components: {
        TechniqueCard,
        TechniqueDetailsModal
    },
    computed: {
        ...mapGetters("techniques", ["techniques"]),
        ...mapState("techniques", ["selectedTechnique", "detailsVisible", "loading", "links"]),
    },
    methods: {
        ...mapActions("techniques", ["fetchTechniques", "selectTechnique", "updateDetailsVisible"]),
        openDetails(technique) {
            this.selectTechnique(technique);
            this.updateDetailsVisible(true);
        },
        closeDetails() {
            this.updateDetailsVisible(false);
        }
    },
    mounted() {
        this.fetchTechniques();
    },
};
</script>