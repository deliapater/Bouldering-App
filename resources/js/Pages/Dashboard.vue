<template>
  <DashboardLayout>
    <Container>
      <h2 class="text-2xl font-bold mb-4">Welcome to Your Dashboard</h2>
      <p class="text-gray-600">Here you can manage your techniqyes, gear and more.</p>
    </Container>
  </DashboardLayout>
</template>
  
  <script>
import DashboardLayout from '../Layouts/DashboardLayout.vue';
import Container from '../Components/Container.vue';

  export default {
    name: 'Dashboard',
    components: {
      DashboardLayout,
      Container
    }
  };
  </script>  