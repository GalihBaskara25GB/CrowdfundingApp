<template>
    <div>
        <v-card :to="'/campaign/'+campaign.id" style="text-decoration: none">
            <v-img :src="campaign.image" height="200" class="white--text" >
                <v-card-title
                    class="fill-height align-end"
                    v-text="campaign.title" >
                </v-card-title>
            </v-img>
            
            <v-card-actions>
                <v-progress-linear v-model="progress" color="blue-grey" height="7"></v-progress-linear>
            </v-card-actions>

            <v-card-actions>
                <v-icon>mdi-cash</v-icon>
                <span>Rp. {{campaign.required.toLocaleString('id-ID')}}</span>
                <v-spacer></v-spacer>
                <span>{{ progress }}%</span>
            </v-card-actions>

        </v-card>    
    </div>

</template>

<script>
    export default {
        name: 'CampaignItem',
        props: ['campaign'],
        computed: {
            progress() {
                return Math.floor(this.campaign.collected / this.campaign.required * 100)
            },
        }
    }
</script>