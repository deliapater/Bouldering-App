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
                    <v-textarea
                        v-model="formData.description"
                        label="Description"
                        :rules="[requireRule]"
                    >
                    </v-textarea>
                    <v-select
                        v-model="formData.gear"
                        :items="gearOptions"
                        item-text="name"
                        item-value="id"
                        label="Gear"
                        multiple
                        chips
                    ></v-select>
                    <v-text-field
                        v-model="newGear"
                        label="Add New Gear"
                        @keyup.enter="addNewGear"
                    ></v-text-field>
                    <v-btn @click="addNewGear">Add Gear</v-btn>
                </v-form>
            </v-card-text>
            <v-card-actions>
                <v-btn @click="closeModal">Cancel</v-btn>
                <v-btn :disabled="!isFormValid" @click="saveTechnique">Save</v-btn>
            </v-card-actions>
        </v-card>
    </v-dialog>    
</template>
<script>
export default {
    computed: {
        isOpen() {
            return this.$store.getters['techniques/formModalVisible'];
        },
        technique() {
            return (
                this.$store.getters['techniques/selectedTechinique'] || {
                    name: '',
                    description: '',
                    steps_to_practice: '',
                    gear: []
                }
            );
        },
        gearOptions() {
            return this.$store.getters['techniques/gearOptions'];
        },
    },
    data() {
        return {
            formData: { ...this.technique},
            newGear: '',
            isFormValid: false,
            requireRule: (value) => !!value || 'This field is required',
        };
    },
    watch: {
        technique: {
            handler(newTechnique) {
                this.formData = { ...newTechnique };
            },
            deep: true,
        },
    },
    methods: {
        closeModal() {
            this.$store.dispatch('techniques/closeFormModal');
        },
        saveTechnique() {
            this.$store.dispatch('techniques/saveTechnique', this.formData);
        },
        addNewGear() {
            if (this.newGear.trim()) {
                this.$store.dispatch('techniques/addGear', { name: this.newGear });
                this.newGear = '';
            }
        },
    }
}
</script>