<template>
    <v-app>
        <v-app-bar color="primary" dark>
            <v-app-bar-nav-icon></v-app-bar-nav-icon>
            <v-toolbar-title>Bouldering App</v-toolbar-title>
            <v-spacer></v-spacer>
            <v-btn text to="/">Home</v-btn>
            <v-btn text to="/techniques">Techniques</v-btn>
            <v-btn text to="/profile">Profile</v-btn>
        </v-app-bar>

        <v-container fluid>
            <v-row>
                <v-col cols="12" md="3">
                    <v-navigation-drawer app>
                        <v-list dense>
                            <v-list-item to="/techniques">
                                <v-list-item-title
                                    >Techniques</v-list-item-title
                                >
                            </v-list-item>
                            <v-list-item to="/gear">
                                <v-list-item-title>Gear</v-list-item-title>
                            </v-list-item>
                            <v-list-item to="/settings">
                                <v-list-item-title>Settings</v-list-item-title>
                            </v-list-item>
                        </v-list>
                    </v-navigation-drawer>
                </v-col>

                <v-col cols="12" md="9">
                    <router-view />
                </v-col>
            </v-row>
        </v-container>
    </v-app>
</template>

<script>
export default {
    name: "App",
};
</script>
