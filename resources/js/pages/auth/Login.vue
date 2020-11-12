<template>
    <div>
        <form @submit.prevent="registering ? registerUser() : loginUser()">
            <p v-if="errors.email == 'validation.unique'" class="alert alert-danger">{{error.email_required}}</p>
            <p v-if="errors.password == 'validation.min.string' " class="alert alert-danger">{{error.min_password}}</p>
            <p v-if="message.success !== '' " class="alert alert-success">{{message.success}}</p>
            <p v-if="message.breach !== '' " class="alert alert-danger">{{message.breach}}</p>

            <template v-if="registering">
                <h1>Create an Account</h1>
                <h2>Create an account to continue</h2>
            </template>
            <template v-else>
                <h1>Log in</h1>
            </template>

            <b-field label="Email">
                <b-input type="email" v-model="form.email" required />
            </b-field>

            <b-field label="Password">
                <b-input type="password" v-model="form.password" password-reveal required />
            </b-field>

            <b-field v-if="registering">
                <b-checkbox v-model="form.tos_accept" required>
                    I accept terms and conditions
                </b-checkbox>
            </b-field>

            <div class="actions">
                <b-button native-type="submit" type="is-success" expanded>{{ registering ? 'Sign up' : 'Log in' }}</b-button>
                <h3 v-on:click="refresh" v-if="registering">Already have an account? <a href="#" @click="registering = false">Login</a></h3>
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
    props: {
        inject: ['page'],
        errors: Object,
        message: Object,
    },
    data() {
        return {
            registering: false,
            email: '',
            password: '',
            tos_accept: false,
            error:{
                email_required: 'This user is already registered',
                min_password: 'The password mut be minimun 6 characters.'
            },
            form: {
                email: null,
                password: null,
            }
        }
    },
    computed: {
        csrf_token() {
            let token = document.head.querySelector('meta[name="csrf-token"]')
            return token.content
        }
    },
    methods: {
        refresh: function (event) {
            window.location.reload();
        },
        registerUser() {

            this.$inertia.post('register', this.form).then( () => {
                if(! this.$page.errors) {
                    // close modal and/or reset form
                    this.form.email = ''
                    this.form.password = ''
                }
            })
        },
        loginUser() {
            this.$inertia.post('login', this.form,{
                onSuccess: () => {
                    this.form.reset('');
                },
            })
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
