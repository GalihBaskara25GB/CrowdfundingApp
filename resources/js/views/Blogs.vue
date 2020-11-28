<template>
    <div>
        <v-container class="ma-0 pa-0" grid-list-sm>
            <v-subheader>
                All Blogs
            </v-subheader>
            
            <v-layout wrap>
                <v-flex v-for="(blog) in blogs" :key="`blog-`+blog.id" xs6>
                    <blog-item :blog="blog" />
                </v-flex>
            </v-layout>
            <v-pagination v-model="page" @input="go" :length="lengthPage" :total-visible="totalVisible"></v-pagination>
        </v-container>
    
    </div>

</template>

<script>
import BlogItem from '../components/BlogItem.vue'

export default {
    data: () => ({
        blogs: [],
        page: 0,
        lengthPage: 0,
        totalVisible: 1
    }),
    components: {
        'blog-item': BlogItem
    },
    created() {
        this.go()
    },
    methods: {
        go() {
            axios.get(`api/blog?page=`+this.page)
                .then((response) => {
                    let { data } = response.data
                    this.blogs = data.blogs.data
                    this.page = data.blogs.current_page
                    this.lengthPage = data.blogs.last_page
                    this.totalVisible = data.blogs.per_page
                })
                .catch((error) => {
                    let { response } = error
                    console.log(response)
                })
        }

    },
}
</script>