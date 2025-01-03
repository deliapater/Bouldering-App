<template>
    <Container>
        <h2 class="text-2xl font-bold mb-4">Welcome to Your Dashboard</h2>
        <p class="text-gray-600">
            Here you can manage your techniques, gear and more.
        </p>
        <h3 class="text-xl font-semibold mt-6">Your Techniques</h3>
        <TechniquesList />
    </Container>
</template>

<script>
import Container from "../Components/Container.vue";
import TechniquesList from "../Components/Techniques/TechniquesList.vue";

export default {
    name: "Dashboard",
    components: {
        Container,
        TechniquesList,
    },
};
</script>
