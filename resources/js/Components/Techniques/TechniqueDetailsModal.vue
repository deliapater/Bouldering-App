<template>
    <v-card>
        <v-card-title>{{ technique.name }}</v-card-title>
        <v-card-subtitle>{{ technique.description }}</v-card-subtitle>
        <v-img
            :src="getImageUrl(technique.image)"
            height="200px"
            class="rounded-lg"
        ></v-img>
        <v-card-subtitle class="text-capitalize"
            >Level: {{ technique.difficulty_level }}</v-card-subtitle
        >
        <v-card-text>{{ technique.description }}</v-card-text>
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
export default {
    props: {
        technique: {
            type: Object,
            required: true,
        },
    },
    methods: {
        closeModal() {
            this.$emit("close");
        },
        getImageUrl(image) {
            return `/images/${image}`;
        },
    },
};
</script>
