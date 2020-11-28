<template>
    <div>
        <v-card v-if="blog.id">
            <v-img :src="blog.images" height="400"></v-img>
            <v-card-title
                v-text="blog.title"
                 class="dark--text">
            </v-card-title>
            <v-card-text>
                <span>
                CrowdfundMe &times;&nbsp;
                <span>{{getHumanDate(blog.updated_at)}}</span>
                </span>
                <br><br>
                <p class="body-text text-justify">
                    {{ blog.body }}
                </p>
            </v-card-text>
        </v-card>    
    </div>

</template>

<script>
import { mapMutations, mapActions } from 'vuex'
import moment from 'moment'

export default {
    data: () => ({
        blog: {},
    }),
    created() {
        this.go()
    },
    methods: {
        go() {
            let { id } = this.$route.params
            let url = '/api/blog/'+ id
            axios.get(url)
                .then((response) => {
                    let { data } = response.data
                    this.blog = data.blog
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
        getHumanDate : function (date) {
            return moment(date, 'YYYY-MM-DD').format('DD/MM/YYYY');
        }

    },
}
</script>

