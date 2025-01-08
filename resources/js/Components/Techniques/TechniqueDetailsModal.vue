<template>
    <v-card>
        <TechniqueCard 
            :technique="selectedTechnique"
            class="ma-4"
            @selected="closeModal"
        />
        <v-card-subtitle>Steps to practice</v-card-subtitle>
        <v-card-text>{{ technique.steps_to_practice }}</v-card-text>
        <v-card-text>
                <strong>Gear:</strong>
                <ul v-if="technique.gear && technique.gear.length">
                    <li v-for="item in technique.gear" :key="item.id">
                        {{ item.name }}
                    </li>
                </ul>
                <p v-else>No gear associated with this technique.</p>
            </v-card-text>
        <v-card-actions>
            <v-btn @click="closeModal">Close</v-btn>
        </v-card-actions>
    </v-card>
</template>

<script>
import TechniqueCard from './TechniqueCard.vue';

export default {
    props: {
        technique: {
            type: Object,
            required: true,
        },
    },
    components: {
        TechniqueCard
    },
    computed: {
        selectedTechnique() {
            return this.$store.getters['techniques/selectedTechnique']
        }
    },
    methods: {
        closeModal() {
            this.$emit("close");
        }
    },
};
</script>
