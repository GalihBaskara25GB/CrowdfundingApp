<template>
    <v-card>
        <v-toolbar dark color="orange">
            <v-btn icon dark @click.native="close">
                <v-icon>mdi-close</v-icon>
            </v-btn>
            <v-toolbar-title>Register</v-toolbar-title>
        </v-toolbar>

        <v-container fluid>
            <v-form ref="registerForm" v-model="valid" lazy-validation>
              
              <validation-errors :errors="validationErrors" v-if="validationErrors"></validation-errors>

                <div v-if="showRegisterForm">
                      <v-text-field 
                        v-model="fullName" 
                        :rules="[rules.required]" 
                        label="Full Name" 
                        maxlength="40" 
                        required
                        :append-icon="'mdi-account'"
                      ></v-text-field>
                      <v-text-field 
                        v-model="email" 
                        :rules="emailRules" 
                        label="E-mail" 
                        required
                        :append-icon="'mdi-email'"
                      ></v-text-field>
                  <v-spacer></v-spacer>
                  <v-col class="d-flex ml-auto" cols="12" sm="3" xsm="12">
                      <v-btn 
                        block 
                        :disabled="!valid" 
                        color="orange" 
                        @click="registerSubmit">
                          Get My OTP Codes
                      </v-btn>
                  </v-col>
                </div>

                <div v-if="showVerifyOtp">
                  <v-col cols="12">
                    <p>
                      Hi, {{ fullName }}
                      Check Your Email, we have sent OTP Code to {{ email }}
                    </p>
                  </v-col>
                  
                  <v-text-field 
                    v-model="otpCode" 
                    label="OTP Codes"
                    :rules="[rules.required]" 
                  >
                  </v-text-field>
                  
                  <v-spacer></v-spacer>
                  <v-col class="d-flex ml-auto" cols="12" sm="3" xsm="12">
                      <v-btn 
                        block 
                        :disabled="!valid" 
                        color="orange"
                        outlined 
                        @click="verifyOtp">
                          Verify
                      </v-btn>
                  </v-col>
                  <v-col class="d-flex ml-auto" cols="12" sm="3" xsm="12">
                      <v-btn 
                        block  
                        color="orange"
                        @click="regenerateOtp">
                          Regenerate OTP Code
                      </v-btn>
                  </v-col>
                </div>

                <div v-if="showUpdatePassword">
                  <v-col cols="12">
                    Welcome <b>{{ fullName }}</b>, please set your account password.
                  </v-col>
                  
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
                  
                  <v-text-field
                    v-model="password_confirmation"
                    :rules="[passwordRules, passwordMatch]"
                    :type="showConfirmationPassword ? 'text' : 'password'"
                    label="Password"
                    hint="At least 6 characters"
                    @click:append="showConfirmationPassword = !showConfirmationPassword"
                    required
                    :append-icon="showPassword ? 'mdi-eye' : 'mdi-eye-off'"
                  ></v-text-field>

                  <v-spacer></v-spacer>
                  <v-col class="d-flex ml-auto" cols="12" sm="3" xsm="12">
                      <v-btn 
                        block 
                        :disabled="!valid" 
                        color="orange"
                        outlined 
                        @click="updatePassword">
                          Register
                      </v-btn>
                  </v-col>
                </div>

            </v-form>
        </v-container>
    </v-card>
</template>

<script>
import { mapGetters, mapActions } from 'vuex'
export default {
  name: 'register',
  components: {
    'validation-errors': () => import('./ValidationError'),
  },
  data() {
    return {
      valid: true,
      email: '',
      emailRules: [
          v => !!v || 'Email is required',
          v => /([a-zA-Z0-9_]{1,})(@)([a-zA-Z0-9_]{2,}).([a-zA-Z0-9_]{2,})+/.test(v) || 'Email is not valid'
      ],
      fullName: '',
      email: '',
      password: '',
      password_confirmation: '',
      showPassword: false,
      showConfirmationPassword: false,
      passwordRules: [
          v => !!v || 'Password is required',
          v => (v && v.length >= 6) || 'Type at least 6 characters',
      ],
      rules: {
        required: value => !!value || 'Required.',
        min: v => (v && v.length >= 8) || 'Min 8 characters'
      },
      message: '',
      otpCode: '',
      showRegisterForm: true,
      showVerifyOtp: false,
      showUpdatePassword: false,
      validationErrors: '',
    }
  },
  computed: {
    ...mapGetters({
      user: 'auth/user',
    }),
    passwordMatch() {
      return () => this.password === this.password_confirmation || "Password must match";
    }
  },
  methods: {
    ...mapActions({
      setAlert: 'alert/set',
      setAuth: 'auth/set',
    }),
    reset() {
      this.$refs.registerForm.reset();
    },
    resetValidation() {
      this.$refs.registerForm.resetValidation();
    },

    registerSubmit() {
      if (this.$refs.registerForm.validate()) {
        let formData = {
          'name': this.fullName, 
          'email': this.email
        }
        axios.post('/api/auth/register', formData)
        .then((response) => {
          this.message = response.data.response_message

          if (response.data.response_code == '00') {
            this.setAlert({
                status: true,
                color: 'success',
                text: this.message
            })
            this.showRegisterForm = false
            this.showVerifyOtp = true
            this.showUpdatePassword = false
            this.validationErrors = ''
          
          } else {
            this.setAlert({
                status: true,
                color: 'error',
                text: this.message
            })
          }

        })
        .catch((error) => {
          let errMessages = ''
          let errMessage = 'Something Went Wrong :('
          if (error.response.status == 422 && error.response.status !== undefined){
              errMessage = error.response.data.message;
              this.validationErrors = error.response.data.errors;
          }
          this.setAlert({
              status: true,
              color: 'error',
              text: errMessage
          })
        })
      }
    },

    verifyOtp() {
      if (this.$refs.registerForm.validate()) {
        let formData = {
          'otp_code': this.otpCode
        }

        axios.post('/api/auth/verification', formData)
        .then((response) => {
          this.message = response.data.response_message

          if (response.data.response_code == '00') {
            this.setAlert({
                status: true,
                color: 'success',
                text: this.message
            })
            this.showRegisterForm = false
            this.showVerifyOtp = false
            this.showUpdatePassword = true
          
          } else {
            this.setAlert({
                status: true,
                color: 'error',
                text: this.message
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

    regenerateOtp() {
      let formData = {
        'email': this.email
      }
        axios.post('/api/auth/regenerate-otp', formData)
        .then((response) => {
          let { data } = response.data
          this.message = response.data.response_message

          if (response.data.response_code == '00') {
            this.setAlert({
                status: true,
                color: 'success',
                text: this.message
            })
          
          } else {
            this.setAlert({
                status: true,
                color: 'error',
                text: this.message
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
    },

    updatePassword() {
      if (this.$refs.registerForm.validate()) {
        let formData = {
          'email': this.email,
          'password': this.password,
          'password_confirmation': this.password_confirmation,
        }

        axios.post('/api/auth/update-password', formData)
        .then((response) => {
          let regristrateUser = response.data.data.user
          this.message = response.data.response_message

          if (response.data.response_code == '00') {
            this.setAlert({
                status: true,
                color: 'success',
                text: this.message
            })
            this.showRegisterForm = false
            this.showVerifyOtp = false
            this.showUpdatePassword = false
            this.login(formData.email, formData.password )
            this.close()
          
          } else {
            this.setAlert({
                status: true,
                color: 'error',
                text: this.message
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

    login(email, password) {
      let formData = {
          'email': email,
          'password': password 
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
  }
}
</script>