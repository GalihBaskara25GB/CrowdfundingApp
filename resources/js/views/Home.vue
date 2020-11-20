<template>
    <div>
        <v-container class="ma-0 pa-0" grid-list-sm>
            <div class="text-right">
                <v-btn small text to="/campaigns" class="blue--text">
                    All Campaigns <v-icon>mdi-chevron-right</v-icon>
                </v-btn>
            </div>

            <v-layout wrap>
                <v-flex v-for="(campaign) in campaigns" :key="`category`+campaign.id" xs6>
                    <v-card :to="`category`+campaign.id">
                        <v-img :src="campaign.image" max-height="200" class="white--text" >
                        <v-card-title
                            class="fill-height align-end"
                            v-text="campaign.title" >
                        </v-card-title>
                        </v-img>
                    </v-card>
                </v-flex>
            </v-layout>

        </v-container>
    
        <v-divider></v-divider>

        <v-container class="ma-0 pa-0" grid-list-sm>
            <div class="text-right">
                <v-btn small text to="/blogs" class="blue--text">
                    All Blogs <v-icon>mdi-chevron-right</v-icon>
                </v-btn>
            </div>

            <v-layout wrap>
                <v-flex v-for="(blog) in blogs" :key="`category`+blog.id" xs6>
                    <v-card :to="`category`+blog.id">
                        <v-img :src="blog.images" max-height="300" class="dark--text" >
                        <v-card-title
                            class="fill-height align-end"
                            v-text="blog.title" >
                        </v-card-title>
                        </v-img>
                    </v-card>
                </v-flex>
            </v-layout>

        </v-container>
    </div>

</template>

<script>
    export default {
        data: () => ({
            campaigns: [],
            blogs: [],
        }),
        created() {
            axios.get('api/campaign/random/2')
                .then((response) => {
                    let { data } = response.data
                    this.campaigns = data.campaigns
                    console.log(this.campaigns)
                })
                .catch((error) => {
                    let { response } = error
                    console.log(response)
                })
            
            axios.get('api/blog/random/2')
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