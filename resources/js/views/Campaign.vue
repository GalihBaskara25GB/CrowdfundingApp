<template>
    <div>
        <v-card v-if="campaign.id">
            <v-img :src="campaign.image" height="200" class="white--text" >
                <v-card-title
                    class="fill-height align-end"
                    v-text="campaign.title" >
                </v-card-title>
            </v-img>
            <v-card-text>
                <v-simple-table dense>
                    <tbody>
                        <tr>
                            <td><v-icon>mdi-home-city</v-icon> Address</td>
                            <td>{{campaign.address}}</td>
                        </tr>
                        <tr>
                            <td><v-icon>mdi-hand-heart</v-icon> Collected</td>
                            <td class="blue--text">Rp. {{campaign.collected.toLocaleString('id-ID')}}</td>
                        </tr>
                        <tr>
                            <td><v-icon>mdi-cash</v-icon> Required</td>
                            <td class="orange--text">Rp. {{campaign.required.toLocaleString('id-ID')}}</td>
                        </tr>
                    </tbody>
                </v-simple-table>

                Descriptions : <br>
                <p class="body-text text-justify">
                    {{ campaign.description }}
                </p>
            </v-card-text>
            <v-card-actions>
                <v-btn block color="primary" @click="donate" :disabled="campaign.collected >= campaign.required">
                    <v-icon>mdi-money</v-icon> &nbsp; Donate
                </v-btn>
            </v-card-actions>

        </v-card>    
    </div>

</template>

<script>
    import { mapGetters, mapMutations, mapActions } from 'vuex'
    export default {
        data: () => ({
            campaign: {},
        }),
        created() {
            this.go()
        },
        computed: {
            ...mapGetters({
                user: 'auth/user',
            }),
        },
        mounted() {
            console.log(this.user)
        },
        methods: {
            go() {
                let { id } = this.$route.params
                let url = '/api/campaign/'+ id
                axios.get(url)
                .then((response) => {
                    let { data } = response.data
                    this.campaign = data.campaign
                })
                .catch((error) => {
                    let { responses } = error
                    console.log(error.responses)
                })
            },
            ...mapMutations({
                tambahTransaksi: 'transaction/insert'
            }),
            ...mapActions({
                setAlert: 'alert/set'
            }),
            donate() {
                if(!this.user.user) {
                    this.setAlert({
                        status: true,
                        color: 'warning',
                        text: 'You Must Login to Donate !!'
                    })
                } else {
                    this.tambahTransaksi()
                    this.setAlert({
                        status: true,
                        color: 'success',
                        text: 'Transaction Success !!'
                    })
                }
            }

        },
    }
</script>