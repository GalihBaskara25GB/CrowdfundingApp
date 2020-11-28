<template>
    <v-card>
        <v-toolbar dark color="orange">
            <v-btn icon dark @click.native="close">
                <v-icon>mdi-close</v-icon>
            </v-btn>
            <v-toolbar-title>Login</v-toolbar-title>
        </v-toolbar>
        <v-divider></v-divider>

        <v-container fluid>
            <v-form ref="form" v-model="valid" lazy-validation>
                <v-text-field
                    v-model="email"
                    :rules="emailRules"
                    label="E-mail"
                    required
                    append-icon="mdi-email"
                ></v-text-field>
                <v-text-field
                    v-model="password"
                    :rules="passwordRules"
                    :type="showPassword ? 'text' : 'password'"
                    label="Password"
                    hint="At least 6 characters"
                    @click:append="showPassword = !showPassword"
                    required
                    :append-icon="showPassword ? 'mdi-eye' : 'mdi-eye-off'"
                ></v-text-field>

                <v-col class="d-flex ml-auto" cols="12" sm="3" xsm="12">
                    <v-btn
                        block
                        outlined
                        color="orange lighten-1"
                        :disabled="!valid"
                        @click="submit">
                        Login
                        <v-icon>mdi-lock-open</v-icon>
                    </v-btn>
                </v-col>
                <v-col class="d-flex ml-auto" cols="12" sm="3" xsm="12">
                    <v-btn
                        block
                        color="primary lighten-1"
                        @click="authProvider('google')">
                        Login with Google
                        <v-icon right dark>mdi-google</v-icon>
                    </v-btn>
                </v-col>
            </v-form>
        </v-container>
    </v-card>
</template>

<script>
    import { mapGetters, mapActions } from 'vuex'
    export default {
        name: 'login',
        data() {
            return {
                valid: true,
                email: '',
                emailRules: [
                    v => !!v || 'Email is required',
                    v => /([a-zA-Z0-9_]{1,})(@)([a-zA-Z0-9_]{2,}).([a-zA-Z0-9_]{2,})+/.test(v) || 'Email is not valid'
                ],
                showPassword: false,
                password: '',
                passwordRules: [
                    v => !!v || 'Password is required',
                    v => (v && v.length >= 6) || 'Type at least 6 characters'
                ],
            }
        },
        computed: {
            ...mapGetters({
                user: 'auth/user',
            }),
        },
        methods: {
            ...mapActions({
                setAlert: 'alert/set',
                setAuth: 'auth/set',
            }),
            submit() {
                if (this.$refs.form.validate()) {
                    let formData = {
                        'email': this.email,
                        'password': this.password 
                    }
                    axios.post('/api/auth/login', formData)
                    .then((response) => {
                        let { data } = response.data
                        this.setAuth(data)
                        if (this.user.user.id.length > 0) {
                            this.setAlert({
                                status: true,
                                color: 'success',
                                text: 'Login Success'
                            })
                            this.close()
                        
                        } else {
                            this.setAlert({
                                status: true,
                                color: 'error',
                                text: 'Login Failed'
                            })

                        }
                    })
                    .catch((error) => {
                        let responses = error.response
                        this.setAlert({
                            status: true,
                            color: 'error',
                            text: responses.data.error
                        })
                    })
                }
            },
            close() {
                this.$emit('closed', false)
            },
            authProvider(provider) {
                let url = '/api/auth/social/'+provider
                 axios.get(url)
                .then((response) => {
                    let data = response.data
                    window.location.href = data.url
                    this.close()
                })
                .catch((error) => {
                    let responses = error.response
                    this.setAlert({
                        status: true,
                        color: 'error',
                        text: responses.data.error
                    })
                })
            }
        }
    }
</script>