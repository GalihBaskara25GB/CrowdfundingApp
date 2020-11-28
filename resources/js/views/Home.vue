<template>
    <div>
        <v-container fluid class="ma-0 pa-0" grid-list-sm>
            <div class="text-right">
                <v-btn small text to="/campaigns" class="blue--text" style="text-decoration: none">
                    All Campaigns <v-icon>mdi-chevron-right</v-icon>
                </v-btn>
            </div>
            
            <v-layout wrap>
                <v-flex v-for="(campaign) in campaigns" :key="`campaign-`+campaign.id" xs6>
                    <campaign-item :campaign="campaign" />
                </v-flex>
            </v-layout>

        </v-container>
    
        <v-divider></v-divider>

        <v-container fluid class="ma-0 pa-0" grid-list-sm>
            <div class="text-right">
                <v-btn small text to="/blogs" class="blue--text" style="text-decoration: none">
                    All Blogs <v-icon>mdi-chevron-right</v-icon>
                </v-btn>
            </div>

            <v-layout wrap>
                
                <v-carousel cycle height="400" hide-delimiter-background show-arrows-on-hover>
                    <v-carousel-item v-for="(blog) in blogs" :key="`blog-`+blog.id" :to="'/blog/'+blog.id">
                        <v-img :src="blog.images" class="fill-height" >
                            <v-container fill-height fluid pa-0 ma-0>
                                <v-layout fill-height align-end>
                                    <v-flex xs-12 mx-2>
                                        <span class="headline white-text" v-text="blog.title"></span>
                                    </v-flex>
                                </v-layout>
                            </v-container>
                        </v-img>
                    </v-carousel-item>
                </v-carousel>

            </v-layout>

        </v-container>

        <v-container fluid>
                <v-footer color="white" padless>
                    <v-col
                        class="text-center"
                        cols="12"
                    >
                        &copy; {{ new Date().getFullYear() }} CrowdfundMe
                    </v-col>
                </v-footer>
        </v-container>
    </div>

</template>

<script>

import CampaignItem from '../components/CampaignItem.vue'

    export default {
        data: () => ({
            campaigns: [],
            blogs: [],
        }),
        components: {
            'campaign-item': CampaignItem
        },
        created() {
            axios.get('api/campaign/random/2')
                .then((response) => {
                    let { data } = response.data
                    this.campaigns = data.campaigns
                })
                .catch((error) => {
                    let { response } = error
                    console.log(response)
                })
            
            axios.get('api/blog/random/5')
                .then((response) => {
                    let { data } = response.data
                    this.blogs = data.blogs
                })
                .catch((error) => {
                    let { response } = error
                    console.log(response)
                })
        },
    }
</script>