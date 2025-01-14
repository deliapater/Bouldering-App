<template>
    <div>
        <label for="gear">Select Gear</label>
        <v-radio-group v-model="selectedGear" row>
            <v-radio
                v-for="gear in gearOptions"
                :key="gear.id"
                :label="gear.name"
                :value="gear"
                class="gear-option"
            ></v-radio>
        </v-radio-group>
        <v-card v-if="selectedGear" class="mt-4" outlined>
            <v-card-title>
                <strong>Selected Gear</strong>
            </v-card-title>
            <v-card-text>
                <p>
                    <strong>Description:</strong>{{ selectedGear.description }}
                </p>
                <p><strong>Category:</strong>{{ selectedGear.category }}</p>
            </v-card-text>
            <v-card-actions>
                <v-btn color="primary" @click="addSelectedGear">Add Gear</v-btn>
            </v-card-actions>
        </v-card>

        <v-btn
            v-if="!selectedGear && !showNewGearForm"
            color="primary"
            class="mt-4"
            @click="showNewGearForm = true"
        >
            Add New Gear
        </v-btn>

        <v-card
            v-else-if="!selectedGear && showNewGearForm"
            class="mt-4"
            outlined
        >
            <v-card-title>
                <strong>Add New Gear</strong>
            </v-card-title>
            <v-card-text>
                <v-text-field
                    v-model="newGear.name"
                    label="Gear Name"
                    :rules="[requiredRule]"
                ></v-text-field>
                <v-text-field
                    v-model="newGear.category"
                    label="Gear Category"
                    :rules="[requiredRule]"
                ></v-text-field>
                <v-textarea
                    v-model="newGear.description"
                    label="Gear Description"
                    :rules="[requiredRule]"
                ></v-textarea>
                <v-card-actions>
                    <v-btn color="primary" @click="addNewGear"
                        >Add New Gear</v-btn
                    >
                </v-card-actions>
            </v-card-text>
        </v-card>
    </div>
</template>

<script>
import { mapGetters, mapMutations, mapActions, mapState } from "vuex";
export default {
    props: {
        value: {
            type: [Number, String, null],
            required: true,
        },
    },
    emits: ["update:value", "add-gear"],
    data() {
        return {
            selectedGear: null,
            newGear: {
                name: "",
                description: "",
                category: "",
            },
            showNewGearForm: false,
            requiredRule: (value) => !!value || "This field is required",
        };
    },
    computed: {
        ...mapGetters("techniques", ["gearOptions"]),
    },
    methods: {
        ...mapMutations("techniques", ["SET_GEAR_OPTIONS"]),
        addSelectedGear() {
            this.$emit("add-gear", this.selectedGear);
            this.selectedGear = null;
        },
        addNewGear() {
            // Validate and add new gear
            if (
                this.newGear.name.trim() &&
                !this.gearOptions.some(
                    (gear) =>
                        gear.name.toLowerCase() ===
                        this.newGear.name.toLowerCase()
                )
            ) {
                const newGear = { id: Date.now(), ...this.newGear };
                this.SET_GEAR_OPTIONS([...this.gearOptions, newGear]);
                this.$emit("add-gear", newGear); // Notify parent of new gear
                this.newGear = { name: "", description: "", category: "" }; // Reset form
                this.showNewGearForm = false;
            } else {
                // Show error if gear exists or input is invalid
                this.$store.dispatch("snackbar/show", {
                    message: "Gear already exists or invalid input!",
                    color: "error",
                });
            }
        },
    },
};
</script>
