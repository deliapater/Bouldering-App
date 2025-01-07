<template>
    <v-card class="technique-card pa-4" @click="selectTechniqueHandler">
        <v-card-title>{{ technique.name }}</v-card-title>
        <v-img
            :src="getImageUrl(technique.image)"
            height="200px"
            class="rounded-lg"
        ></v-img>
        <v-card-subtitle class="text-capitalize">{{
                        technique.difficulty_level
                    }}</v-card-subtitle>
        <v-card-text>{{ technique.description }}</v-card-text>
    </v-card>
</template>

<script>
export default {
    props: {
        technique: {
            type: Object,
            required: true,
        },
    },
    methods: {
        selectTechniqueHandler() {
            this.$emit("select", this.technique);
        },
        getImageUrl(image) {
            return `/images/${image}`;
        },
    },
};
</script>
