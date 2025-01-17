<template>
    <div class="login-container">
        <h2>Login</h2>
        <form @submit.prevent="handleLogin">
            <div>
                <label>Email</label>
                <input 
                    v-model="email"
                    type="email"
                    id="email"
                    placeholder="Enter your email"
                    required
                />
            </div>
            <div>
                <label for="password">Password</label>
                <input
                    v-model="password"
                    type="password"
                    id="password"
                    placeholder="Enter your password"
                    required
                />
            </div>
            <button type="submit">Login</button>
        </form>
        <p v-if="errorMessage" class="error">{{ errorMessage }}</p>
    </div>
</template>

<script>
import { mapActions } from 'vuex/dist/vuex.cjs.js';

export default {
    data() {
        return {
            email: "",
            password: "",
            errorMessage: null
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
}
</style>