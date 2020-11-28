<template>
    <div>
        <v-card :to="'/blog/'+blog.id" style="text-decoration: none">
            <v-img :src="blog.images" height="200" class="white--text" >
                <v-card-title
                    class="fill-height align-end"
                    v-text="blog.title" >
                </v-card-title>
            </v-img>

            <v-card-actions>
                <v-icon>mdi-calendar</v-icon>&nbsp;
                <span>{{getHumanDate(blog.updated_at)}}</span>
                <v-spacer></v-spacer>
            </v-card-actions>

        </v-card>    
    </div>

</template>

<script>
import moment from 'moment'

export default {
    name: 'BlogItem',
    props: ['blog'],
    methods: {
        getHumanDate : function (date) {
            return moment(date, 'YYYY-MM-DD').format('DD/MM/YYYY');
        }
    }
}
</script>