<template>
    <div @click="redirectIfGuest">
        <div class="card mb-3 border-0 shadow-sm" v-for="status in statuses">
            <div class="card-body d-flex flex-column">
                <div class="d-flex align-items-center mb-3">
                    <img class="rounded mr-3 shadow-sm" width="40px" src="https://aprendible.com/images/default-avatar.jpg" alt="">
                    <div>
                        <h5 class="mb-1" v-text="status.user_name"></h5>
                        <div class="small text-muted" v-text="status.ago"></div>
                    </div>
                </div>
                <p class="card-text text-secondary" v-text="status.body"></p>
            </div>
            <div class="card-footer p-2 d-flex justify-content-between align-items-center">
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
                <div class="mr-2 text-secondary">
                    <i class="fa fa-thumbs-up"></i>
                    <span dusk="likes-count">{{ status.likes_count }}</span>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data(){
            return{
                statuses: [],
            }
        },
        mounted() {
            axios
                .get('/statuses')
                .then( res => { this.statuses = res.data.data } )
                .catch( err => {console.error(err.response.data)} );

            EventBus.$on('status-created', status => {
                this.statuses.unshift(status);
            });
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
    };
</script>

<style scoped>

</style>
