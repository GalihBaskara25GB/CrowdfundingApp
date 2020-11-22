<template>
    <div>
        <v-container class="ma-0 pa-0" grid-list-sm>
            <v-subheader>
                All Campaigns
            </v-subheader>
            
            <v-layout wrap>
                <v-flex v-for="(campaign) in campaigns" :key="`campaign-`+campaign.id" xs6>
                    <campaign-item :campaign="campaign" />
                </v-flex>
            </v-layout>
            <v-pagination v-model="page" @input="go" :length="lengthPage" :total-visible="totalVisible"></v-pagination>
        </v-container>
    
    </div>

</template>

<script>
import CampaignItem from '../components/CampaignItem.vue'

    export default {
        data: () => ({
            campaigns: [],
            page: 0,
            lengthPage: 0,
            totalVisible: 1
        }),
        components: {
            'campaign-item': CampaignItem
        },
        created() {
            this.go()
        },
        methods: {
            go() {
                axios.get(`api/campaign?page=`+this.page)
                    .then((response) => {
                        let { data } = response.data
                        this.campaigns = data.campaigns.data
                        this.page = data.campaigns.current_page
                        this.lengthPage = data.campaigns.last_page
                        this.totalVisible = data.campaigns.per_page
                    })
                    .catch((error) => {
                        let { response } = error
                        console.log(response)
                    })
            }

        },
    }
</script>