<template>
    <div>
        <label for="gear">Select Gear</label>
        <div v-for="gear in gearOptions" :key="gear.id" class="gear-option">
            <input
                type="radio"
                :id="`gear-${gear.id}`"
                :value="gear"
                v-model="selectedGear"
            />
            <label :for="`gear-${gear.id}`">{{ gear.name }}</label>
        </div>

        <div v-if="selectedGear">
            <p><strong>Description:</strong>{{ selectedGear.description }}</p>
            <p><strong>Category:</strong>{{ selectedGear.category }}</p>
            <v-btn @click="addSelectedGear">Add Gear</v-btn>
        </div>

        <div v-else-if="showNewGearForm">
            <h4>Add New Gear</h4>
            <v-text-field
                v-model="newGear.name"
                label="Gear Name"
                :rules="[requiredRule]"
            ></v-text-field>
            <v-textarea
                v-model="newGear.description"
                label="Gear Description"
                :rules="[requiredRule]"
            ></v-textarea>
            <v-text-field
                v-model="newGear.category"
                label="Gear Category"
                :rules="[requiredRule]"
            ></v-text-field>
            <v-btn @click="addNewGear">Add New Gear</v-btn>
        </div>
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
    emits: ["update:value"],
    data() {
        return {
            selectedGear: null,
            newGear: {
                name: "",
                description: "",
                category: "",
            },
            showNewGearForm: true,
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
<style scoped>
.gear-option {
    margin-bottom: 8px;
}
</style>
