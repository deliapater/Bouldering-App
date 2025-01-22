<template>
    <v-app-bar color="primary" dark>
        <v-app-bar-nav-icon></v-app-bar-nav-icon>
            <v-toolbar-title>Bouldering App</v-toolbar-title>
            <v-spacer></v-spacer>
            <v-btn to="/">Home</v-btn>
            <v-btn to="/techniques">Techniques</v-btn>
            <v-btn to="/profile">Profile</v-btn>

            <v-btn v-if="isAuthenticated" text @click="handleLogout" color="red">Logout</v-btn>
            <v-btn v-else text to="/login">Login</v-btn>
    </v-app-bar>
</template>

<script>
import { mapActions, mapGetters } from 'vuex/dist/vuex.cjs.js';

export default {
    name: "Navbar",
    computed: {
        ...mapGetters("auth", ["isAuthenticated"]),
    },
    methods: {
        ...mapActions("auth", ["logout"]),
        handleLogout() {
            this.logout();
        }
    },
};
</script>