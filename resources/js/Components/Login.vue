<template>
    <v-container fluid class="pa-6 mt-20">
        <v-row justify="center">
            <v-col cols="12" sm="8" md="4">
                <v-card>
                    <v-card-title class="text-h5">Login</v-card-title>

                    <v-card-text>
                        <v-form @submit.prevent="handleLogin">
                           <v-text-field
                            v-model="email"
                            label="Email"
                            type="email"
                            required
                            outlined
                            :rules="[emailRules]"
                        />
                        <v-text-field 
                            v-model="password"
                            label="Password"
                            type="password"
                            required
                            outlined
                            :rules="[passwordRules]"
                        />
                        <v-btn type="submit" color="primary" block>Login</v-btn>
                    </v-form>
                    <p v-if="errorMessage" class="error">{{ errorMessage }}</p>
                    </v-card-text>
                </v-card>
            </v-col>
        </v-row>
    </v-container>
</template>

<script>
import { mapActions } from 'vuex/dist/vuex.cjs.js';

export default {
    data() {
        return {
            email: "",
            password: "",
            errorMessage: null,
            emailRules: [(v) => !!v || "Email is required", (v) => /.+@.+\..+/.test(v) || "Must be a valid email"],
            passwordRules: [(v) => !!v || "Password is required"]
        };
    },
    methods: {
        ...mapActions("auth", ["login"]),
        async handleLogin() {
            try {
                await this.login({
                    email: this.email,
                    password: this.password
                });
                this.$router.push("/dashboard");
            } catch (error) {
                console.error("Login failed:", error);
                this.errorMessage = "Invalid credentials. Please try again."
            }
        },
    },
};
</script>
<style scoped>
.login-container {
    max-width: 400px;
    margin: 0 auto;
    padding: 1rem;
    border: 1px solid #ddd;
    border-radius: 5px
}

.error {
    color: red;
    margin-top: 1rem;
    text-align: center;
}
</style>