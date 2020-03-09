<template>
    <button
        v-if="status.is_liked"
        @click="unlike(status)"
        dusk="unlike-btn"
        class="btn btn-link btn-sm"><strong>
        <i class="fa fa-thumbs-up text-primary mr-1"></i>
        TE GUSTA
    </strong></button>
    <button
        v-else
        @click="like(status)"
        dusk="like-btn"
        class="btn btn-link btn-sm">
        <i class="fa fa-thumbs-up text-primary mr-1"></i>
        ME GUSTA
    </button>
</template>

<script>
    export default {
        props: {
            status: {
                type: Object,
                required: true,
            }
        },
        methods: {
            like(status){

                axios.post(`statuses/${status.id}/likes`)
                    .then( res => {
                        status.is_liked = true;
                        status.likes_count ++;
                    } )
                    .catch( err => {console.error(err.response.data)} );
            },

            unlike(status){

                axios.delete(`statuses/${status.id}/likes`)
                    .then( res => {
                        status.is_liked = false;
                        status.likes_count --;
                    } )
                    .catch( err => {console.error(err.response.data)} );
            },
        }
    }
</script>

<style scoped>

</style>
