<template>
    <v-alert
        type="warning"
        v-if="validationErrors"
        dismissible
        dense
    >
        <ul>
            <li v-for="(validationError, index) in validationErrors" :key="index">
                {{ validationError }}
            </li>
        </ul>
    </v-alert> 
</template>

<script>
    import { mapGetters, mapActions } from 'vuex'
    export default {
        name: 'validation-errors',
        data(){
            return {
                
            }
        },
        props: ['errors'],
        computed: {
            validationErrors(){
                let errors = Object.values(this.errors)
                errors = errors.flat()
                return errors
            }
        }
    }
</script>