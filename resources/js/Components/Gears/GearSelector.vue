<template>
    <div>
        <label for="gear">Select Gear</label>
        <v-radio-group
            v-model="selectedGearId"
            :rules="[requiredRule]"
            id="gear"
            :mandatory="true"
        >
            <v-radio
                v-for="gear in gearOptions"
                :key="gear.id"
                :label="gear.name"
                :value="gear.id"
                @click="displayGearDetails(gear)"
            ></v-radio>
        </v-radio-group>

        <div v-if="selectedGear">
            <v-divider></v-divider>
            <v-row>
                <v-col>
                    <strong>Description:</strong>
                    <p>{{ selectedGear.description }}</p>
                </v-col>
                <v-col>
                    <strong>Category:</strong>
                    <p>{{ selectedGear.category }}</p>
                </v-col>
            </v-row>
        </div>

        <div v-if="isAddingNewGear">
            <v-text-field
                v-model="newGear.name"
                label="New Gear Name"
                :rules="[requiredRule]"
            ></v-text-field>
            <v-textarea
                v-model="newGear.description"
                label="Description"
                :rules="[requiredRule]"
            ></v-textarea>
            <v-text-field
                v-model="newGear.category"
                label="Category"
                :rules="[requiredRule]"
            ></v-text-field>
        </div>

        <v-btn @click="addNewGear" v-if="isAddingNewGear">Add Gear</v-btn>
        <v-btn @click="toggleAddNewGear" v-if="!isAddingNewGear">Add New Gear</v-btn>
    </div>
</template>

<script>
import { mapGetters, mapMutations } from "vuex";
export default {
    props: {
        value: {
            type: [Number, String, null],
            required: true
        },
    },
    emits: ["update:value"],
    data() {
        return {
            selectedGearId: this.value,
            selectedGear: null,
            newGear: {
                name: "",
                description: "",
                category: ""
            },
            isAddingNewGear: false,
            requiredRule: (value) => !!value || "This field is required",
        };
    },
    computed: {
        ...mapGetters("techniques", ["gearOptions"]),
    },
    watch: {
        selectedGearId(newValue) {
            this.$emit("update:value", newValue);
        },
    },
    methods: {
        ...mapMutations("techniques", ["SET_GEAR_OPTIONS"]),
        displayGearDetails(gear) {
            this.selectedGear = gear;
        },
        toggleAddNewGear() {
            this.isAddingNewGear = !this.isAddingNewGear;
            this.newGear = { name:"", description: "", category:""};
        },
        addNewGear() {
            if (
                this.newGear.name.trim() &&
                !this.gearOptions.some(
                    (gear) => 
                    gear.name.toLowerCase() === this.newGear.name.toLowerCase()
                )
            ) {
                const newGear = { id: Date.now(), ...this.newGear};
                this.SET_GEAR_OPTIONS([...this.gearOptions, newGear]);
                this.toggleAddNewGear();
            } else {
                this.$store.dispatch("snackbar/show", {
                    message: "Gear already exists or invalid input!",
                    color: "error"
                });
            }
        },
    },
};
</script>
