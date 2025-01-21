<template>
    <v-container fluid class="pa-6 mt-20">
        <v-row justify="center">
            <v-col cols="12" sm="8" md="4">
                <v-card>
                    <v-card-title class="text-h5">Register</v-card-title>

                    <v-card-text>
                        <v-form ref="form" v-model="valid">
                            <v-text-field
                                v-model="name"
                                label="Name"
                                required
                                outlined
                                :rules="[rules.required]"
                            />
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
                                :type="passwordVisible ? 'text' : 'password'"
                                :rules="[rules.required, rules.password]"
                                required
                                outlined
                                append-icon="mdi-eye"
                                @click:append="togglePasswordVisibility"
                            />
                            <v-text-field
                                v-model="password_confirmation"
                                label="Confirm Password"
                                :type="passwordVisible ? 'text' : 'password'"
                                required
                                :rules="[
                                    rules.required,
                                    rules.passwordConfirmationRules,
                                ]"
                                append-icon="mdi-eye"
                                @click:append="togglePasswordVisibility"
                            />
                            <v-btn
                                :disabled="!valid || loading"
                                :loading="loading"
                                color="primary"
                                @click="handleRegister"
                                >Register</v-btn
                            >
                        </v-form>
                        <v-alert
                            v-if="errorMessage"
                            type="error"
                            class="mt-4"
                            >{{ errorMessage }}</v-alert
                        >
                        <v-snackbar
                            v-model="snackbar.visible"
                            :color="snackbar.color"
                            timeout="3000"
                            top
                            >{{ snackbar.message }}</v-snackbar
                        >
                    </v-card-text>
                </v-card>
            </v-col>
        </v-row>
    </v-container>
</template>

<script>
import { mapActions } from "vuex/dist/vuex.cjs.js";

export default {
    data() {
        return {
            name: "",
            email: "",
            password: "",
            password_confirmation: "",
            valid: false,
            loading: false,
            errorMessage: null,
            passwordVisible: false,
            rules: {
                required: (value) => !!value || "This field is required.",
                email: (value) =>
                    /.+@.+\..+/.test(value) || "Email must be valid.",
                password: (value) =>
                    value.length >= 6 ||
                    "Password must be at least 6 characters.",
                passwordConfirmation: (value) =>
                    value === this.password || "Passwords do not match.",
            },
            snackbar: {
                visible: false,
                message: "",
                color: "success",
            },
        };
    },
    methods: {
        ...mapActions("auth", ["register"]),
        togglePasswordVisibility() {
            this.passwordVisible = !this.passwordVisible;
        },

        async handleRegister() {
            this.loading = true;
            try {
                const userData = {
                    name: this.name,
                    email: this.email,
                    password: this.password,
                    password_confirmation: this.password_confirmation,
                };
                const response = await this.register(userData);
                this.snackbar.message =
                    response.message || "Registration successful!";
                this.snackbar.color = "success";
                this.snackbar.visible = true;

                this.$router.push("/login");
            } catch (error) {
                console.error("Registration failed:", error);
                this.snackbar.message =
                    error.response?.data?.message ||
                    "Registration failed. Please try again.";
                this.snackbar.color = "error";
                this.snackbar.visible = true;
            } finally {
                this.loading = false;
            }
        },
    },
};
</script>
