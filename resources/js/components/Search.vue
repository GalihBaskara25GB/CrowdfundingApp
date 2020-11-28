<template>
    <v-card>
        <v-toolbar dark color="orange">
            <v-btn icon darl @click.native="close">
                <v-icon>mdi-close</v-icon>
            </v-btn>
            <v-text-field
                hide-details
                append-icon="mdi-microphone"
                flat
                autofocus
                label="search"
                prepend-inner-icon="mdi-magnify"
                v-model="keyword"
                @input="doSearch"
            >
            </v-text-field>
        </v-toolbar>
        <v-card-text>
            <v-subheader v-if="keyword.length>0">
                Result search "{{ keyword }}"
            </v-subheader>
            <v-alert
                :value="campaigns.length==0 && keyword.length>0"
                color="warning"
                outlined
            >
            It seems nothing found here, try other keyword ;)
            </v-alert>

            <!-- Search result will displayed here -->
            <v-container fluid class="ma-0 pa-0" grid-list-sm>
                <v-layout wrap>
                    <v-flex v-for="(campaign) in campaigns" :key="`campaign-`+campaign.id">
                        <campaign-item :campaign="campaign" @click.native="close" />
                    </v-flex>
                </v-layout>
            </v-container>
        </v-card-text>
    </v-card>

</template>

<script>
import { mapMutations, mapActions } from 'vuex'
export default {
    name: 'search',
    components: {
        CampaignItem: () => import('./CampaignItem')
    },
    data: () => ({
        keyword: '',
        campaigns: [],
    }),
    methods: {
        doSearch() {
            let keyword = this.keyword
            if (keyword.length>0) {
                let url = '/api/campaign/search/'+ keyword
                axios.get(url)
                    .then((response) => {
                        let { data } = response.data
                        this.campaigns = data.campaigns
                    })
                    .catch((error) => {
                        console.log(error)
                })
            } else {
                this.campaigns = []
            }
            
        },
        close() {
            this.keyword = ''
            this.$emit('closed', false)
        },
    },
}
</script>