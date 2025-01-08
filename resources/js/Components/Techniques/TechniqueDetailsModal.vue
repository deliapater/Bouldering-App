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
                <li
                    v-for="item in technique.gear"
                    :key="item.id"
                    @click="openGearDetails(item)"
                    class="gear-item text-primary"
                >
                    {{ item.name }}
                </li>
            </ul>
            <p v-else>No gear associated with this technique.</p>
        </v-card-text>
        <v-dialog v-model="gearDialogVisible" max-width="400px">
            <v-card v-if="selectedGear">
                <v-card-title>{{ selectedGear.name }}</v-card-title>
                <v-card-subtitle
                    >Category: {{ selectedGear.category }}</v-card-subtitle
                >
                <v-card-text
                    >Description: {{ selectedGear.description }}</v-card-text
                >
                <v-card-actions>
                    <v-btn @click="closeGearDetails">Close</v-btn>
                </v-card-actions>
            </v-card>
        </v-dialog>

        <v-card-actions>
            <v-btn @click="closeModal">Close</v-btn>
        </v-card-actions>
    </v-card>
</template>

<script>
import TechniqueCard from "./TechniqueCard.vue";
import "/resources/css/components/_modal.css";

export default {
    props: {
        technique: {
            type: Object,
            required: true,
        },
    },
    components: {
        TechniqueCard,
    },
    data() {
        return {
            gearDialogVisible: false,
            selectedGear: null,
        };
    },
    computed: {
        selectedTechnique() {
            return this.$store.getters["techniques/selectedTechnique"];
        },
    },
    methods: {
        closeModal() {
            this.$emit("close");
        },
        openGearDetails(gear) {
            this.selectedGear = gear;
            this.gearDialogVisible = true;
        },
        closeGearDetails() {
            this.gearDialogVisible = false;
            this.selectedGear = null;
        },
    },
};
</script>
