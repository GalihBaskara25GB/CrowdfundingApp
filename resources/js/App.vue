<template>
    <!-- App.vue -->
    <v-app>

        <!-- Alert Transactions -->
        <Alert />

        <!-- Dialog -->
        <keep-alive>
            <v-dialog v-model="dialog" fullscreen hide-overlay persistent transition="scale-transition">
                <component :is="currentComponent" @closed="setDialogStatus"></component>
            </v-dialog>
        </keep-alive>

        <!-- Sidebar -->
        <v-navigation-drawer app v-model="drawer">
            <v-list>
                <v-list-item v-if="!guest">
                    <v-list-item-avatar>
                        <v-img :src="user.user.foto"></v-img>
                    </v-list-item-avatar>
                    <v-list-item-content>
                        <v-list-item-title>{{ user.user.name }}</v-list-item-title>
                    </v-list-item-content>
                </v-list-item>

                <div class="pa-2" v-if="guest">
                    <v-btn tile block color="amber" class="mb-1" @click="setDialogComponent('login')">
                        <v-icon left>mdi-lock</v-icon> Login
                    </v-btn>
                    <v-btn tile block outlined class="mb-1" @click="setDialogComponent('register')">
                        <v-icon left>mdi-account</v-icon> Register
                    </v-btn>
                </div>

                <v-divider></v-divider>

                <v-list-item 
                    v-for="(item, index) in menus"
                    :key="`menu-`+index"
                    :to="item.route"
                    style="text-decoration: none"
                >
                    <v-list-item-icon>
                        <v-icon left>{{ item.icon }}</v-icon>
                    </v-list-item-icon>

                    <v-list-item-content>
                        <v-list-item-title>{{ item.title }}</v-list-item-title>
                    </v-list-item-content>
                </v-list-item>

            </v-list>

            <template v-slot:append v-if="!guest">
                <div class="pa-2" v-if="!guest">
                    <v-btn tile outlined block color="red" dark @click="logout">
                        <v-icon left>mdi-lock</v-icon> Logout
                    </v-btn>
                </div>
            </template>

        </v-navigation-drawer>

        <v-app-bar app color="orange" dark v-if="isHome">
            <v-app-bar-nav-icon @click.stop="drawer = !drawer"></v-app-bar-nav-icon>
            <v-toolbar-title>Crowdfund Me</v-toolbar-title>
            <v-spacer></v-spacer>
            
            <v-btn tile icon>
                <v-badge color="dark" overlap>
                    <template v-slot:badge v-if="transactions > 0">
                        <span>{{ transactions }}</span>
                    </template>
                    <v-icon>mdi-cash-multiple</v-icon>
                </v-badge>
            </v-btn>

            <v-text-field
                slot="extension"
                hide-details
                append-icon="mdi-microphone"
                flat
                label="search"
                prepend-inner-icon="mdi-magnify"
                solo-inverted
                @click="setDialogComponent('search')"
            >
            </v-text-field>
        </v-app-bar>

        <v-app-bar app color="orange" dark v-else>
            <v-btn tile icon @click.stop="$router.go(-1)">
                <v-badge color="dark" overlap>
                    <v-icon dark>mdi-arrow-left</v-icon>
                </v-badge>
            </v-btn>
            <v-toolbar-title>Crowdfund Me</v-toolbar-title>
            <v-spacer></v-spacer>
            <v-btn tile icon>
                <v-badge color="dark" overlap>
                    <template v-slot:badge v-if="transactions > 0">
                        <span>{{ transactions }}</span>
                    </template>
                    <v-icon>mdi-cash-multiple</v-icon>
                </v-badge>
            </v-btn>
        </v-app-bar>

        <!-- Sizes your content based upon application components -->
        <v-main>

            <!-- Provides the application the proper gutter -->
            <v-container fluid>

                <!-- If using vue-router -->
                <v-slide-y-transition>
                    <router-view></router-view>
                </v-slide-y-transition>
            </v-container>
        </v-main>

    </v-app>
</template>

<script>
import { mapActions, mapGetters } from 'vuex'

export default {
    name: 'App',
    components: {
        Alert: () => import('./components/Alert'), 
        Search: () => import('./components/Search'),
        Login: () => import('./components/Login'),
        Register: () => import('./components/Register'),
    },
    data: () => ({
            drawer: true,
            menus: [
                    { title: 'Home', icon: 'mdi-home', route: '/' },
                    { title: 'Campaigns', icon: 'mdi-hand-heart', route: '/campaigns' },
                    { title: 'Blogs', icon: 'mdi-newspaper', route: '/blogs' },
                ],
    }),
    computed: {
        isHome() {
            return (this.$route.path === '/' || this.$route.path === '/home')
        },
        ...mapGetters({
            transactions: 'transaction/transactions',
            guest: 'auth/guest',
            user: 'auth/user',
            dialogStatus: 'dialog/status',
            currentComponent: 'dialog/component',
        }),
        dialog: {
            get() {
                return this.dialogStatus
            },
            set(value) {
                this.setDialogStatus(value)
            }
        }
    },
    methods: {
        ...mapActions({
            setDialogStatus: 'dialog/setStatus',
            setDialogComponent: 'dialog/setComponent',
            setAuth: 'auth/set',
            setAlert: 'alert/set',
            checkToken: 'auth/checkToken',
        }),
        logout() {
            let config = {
                headers: {
                    'Authorization': 'Bearer ' + this.user.token,
                }
            }
            axios.post('/api/auth/logout', {}, config)
            .then((response) => {
                this.setAuth({})
                this.setAlert({
                    status: true,
                    color: 'success',
                    text: response.data.response_message
                })
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
    mounted() {
        if (!this.user == undefined) {
            this.checkToken(this.user)
        }
    }
}
</script>

<style>
  .body-text {
    font-size: 1.2em;
  }
</style>