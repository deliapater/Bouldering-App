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
            <v-col
                v-for="technique in techniques"
                :key="technique.id"
                cols="12"
                sm="6"
                md="4"
            >
                <v-card class="pa-4">
                    <v-img
                        :src="getImageUrl(technique.image)"
                        height="200px"
                        class="rounded-lg"
                    ></v-img>
                    <v-card-title>{{ technique.name }}</v-card-title>
                    <v-card-subtitle class="text-capitalize">{{
                        technique.difficulty_level
                    }}</v-card-subtitle>
                    <v-card-text>{{ technique.description }}</v-card-text>

                    <v-card-actions>
                        <router-link
                            :to="`/techniques/${technique.id}`"
                            class="text-primary"
                        >
                            <v-btn color="primary">View Details</v-btn>
                        </router-link>
                    </v-card-actions>
                </v-card>
            </v-col>
        </v-row>

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
import { mapState, mapActions } from "vuex";

export default {
    name: 'TechniquesList',
    
    computed: {
        ...mapState("techniques", ["techniques", "links", "loading"]),
    },
    methods: {
        ...mapActions("techniques", ["fetchTechniques"]),
        getImageUrl(image) {
            return `/images/${image}`;
        },
    },
    mounted() {
        this.fetchTechniques();
    },
};
</script>
