<template>
    <v-container fluid class="pa-6 mt-20">
        <v-row justify="center">
            <v-col cols="12" sm="8" md="4">
                <v-card>
                    <v-card-title class="text-h5">Login</v-card-title>

                    <v-card-text>
                        <v-form ref="form" v-model="valid">
                           <v-text-field
                            v-model="email"
                            label="Email"
                            type="email"
                            required
                            outlined
                            :rules="[rules.required, rules.email]"
                        />
                        <v-text-field 
                            v-model="password"
                            label="Password"
                            type="password"
                            required
                            outlined
                            :rules="[rules.required]"
                        />
                        <v-btn :disabled="!valid" color="primary" block @click="handleLogin">Login</v-btn>
                    </v-form>
                    <p v-if="errorMessage" class="error">{{ errorMessage }}</p>

                    <v-divider class="my-4"></v-divider>
                    <p class="text-center">
                        Don't have an account?
                        <v-btn
                            text
                            color="primary"
                            to="/register"
                        >
                            Register here
                        </v-btn>
                    </p>
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
            valid: false,
            errorMessage: null,
            rules: {
                required: (value) => !!value || "This field is required.",
                email: (value) =>
                    /.+@.+\..+/.test(value) || "Email must be valid.",
            },
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
                this.errorMessage = error.response?.data?.message || "Invalid credentials. Please try again."
            }
        },
    },
};
</script>
<style scoped>
.error {
    color: red;
    margin-top: 1rem;
    text-align: center;
}
</style>