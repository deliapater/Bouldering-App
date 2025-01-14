<template>
    <v-dialog v-model="isOpen" max-height="600px" persistent>
        <v-card>
            <v-card-title>
                <span v-if="formData.id">Edit Technique</span>
                <span v-else>Add Technique</span>
            </v-card-title>
            <v-card-text>
                <v-form ref="form" v-model="isFormValid">
                    <v-text-field
                        v-model="formData.name"
                        label="Technique Name"
                        :rules="[requiredRule]"
                    >
                    </v-text-field>
                    <v-radio-group
                        v-model="formData.difficulty_level"
                        :rules="[requiredRule]"
                        label="Difficulty Level"
                    >
                        <v-radio
                            v-for="level in difficultyItems"
                            :key="level.value"
                            :label="level.text"
                            :value="level.value"
                        ></v-radio>
                    </v-radio-group>
                    <v-textarea
                        v-model="formData.description"
                        label="Description"
                        :rules="[requireRule]"
                    >
                    </v-textarea>
                    <GearSelector
                        :value="formData.gear"
                        @add-gear="handleAddGear"
                    />
                </v-form>
            </v-card-text>
            <v-card-actions>
                <v-btn @click="closeModal">Cancel</v-btn>
                <v-btn :disabled="!isFormValid" @click="saveTechnique"
                    >Save</v-btn
                >
            </v-card-actions>
        </v-card>
    </v-dialog>
</template>
<script>
import GearSelector from "@/Components/Gears/GearSelector.vue";
export default {
    components: {
        GearSelector,
    },
    data() {
        return {
            formData: {
                id: null,
                name: "",
                description: "",
                steps_to_practice: "",
                gear: null,
                difficulty_level: "beginner",
            },
            isFormValid: false,
            difficultyItems: [
                { value: "beginner", text: "Beginner" },
                { value: "intermediate", text: "Intermediate" },
                { value: "advanced", text: "Advanced" },
            ],
            requireRule: (value) => !!value || "This field is required",
        };
    },
    computed: {
        isOpen() {
            return this.$store.getters["techniques/formModalVisible"];
        },
        technique() {
            return (
                this.$store.getters["techniques/selectedTechnique"] || {
                    name: "",
                    description: "",
                    steps_to_practice: "",
                    gear: [],
                }
            );
        },
    },
    methods: {
        closeModal() {
            this.$store.dispatch("techniques/closeFormModal");
        },
        saveTechnique() {
            if (!this.formData.gear || this.formData.gear.length === 0) {
                this.$store.dispatch("snackbar/show", {
                    message: "Please select or add at least one gear!",
                    color: "error",
                });
                return;
            }
            const formattedGear = Array.isArray(this.formData.gear)
                ? this.formData.gear.map((gear) => ({
                    id: gear.id,
                    name: gear.name,
                    description: gear.description,
                    category: gear.category
                }))
                : [{
                    id: this.formData.gear.id,
                    name: this.formData.gear.name,
                    description: this.formData.gear.description,
                    category: this.formData.gear.category
                }];

            this.$store.dispatch("techniques/saveTechnique", {
                ...this.formData,
                gear: formattedGear,
            });
        },
        handleAddGear(selectedGear) {
            if (!this.formData.gear) {
                this.formData.gear = [];
            }
            this.formData.gear.push(selectedGear);
        },
    },
};
</script>
