<template>
    <div>
        <form @submit.prevent="registering ? registerUser() : loginUser()">
            <template v-if="registering">
                <h1>Create an Account</h1>
                <h2>Create an account to continue</h2>
            </template>
            <template v-else>
                <h1>Log in</h1>
            </template>

            <b-field label="Email">
                <b-input type="email" v-model="email" required />
            </b-field>

            <b-field label="Password">
                <b-input type="password" v-model="password" password-reveal required />
            </b-field>

            <b-field v-if="registering">
                <b-checkbox v-model="tos_accept" required>
                    I accept terms and conditions
                </b-checkbox>
            </b-field>

            <div class="actions">
                <b-button native-type="submit" type="is-success" expanded>{{ registering ? 'Sign up' : 'Log in' }}</b-button>

                <h3 v-if="registering">Already have an account? <a href="#" @click="registering = false">Login</a></h3>
                <h3 v-else>Dont have an account yet? <a href="#" @click="registering = true">Register here</a></h3>
            </div>
        </form>
    </div>
</template>

<script>
/* Layout */
import Layout from '@/Layouts/general';

export default {
    layout: Layout,
    data() {
        return {
            registering: false,
            email: '',
            password: '',
            tos_accept: false,
        }
    },
    methods: {
        /* test */
        registerUser() {
            // this.$inertia.post(
            //     $route('auth.register'), {
            //         email,
            //         ...
            //     }
            // );
        },
        loginUser() {
            //
        },
    }
}
</script>

<style scoped>
form {
    max-width: 500px;
    width: 90%;
    padding: 20px;
    border-radius: 10px;
    background: #f0f0f0;
    margin: auto;
}

h1, h2 {
    text-align: center;
}

h2 {
    margin-top: 0.5714em;
    margin-bottom: 0.5714em;
    font-size: 1.5em;
}

.actions {
    padding-top: 10px;
}

.actions > h3 {
    font-size: 1em;
    margin: 0;
    margin-top: 15px;
}
</style>
