<template>
    <div @click="redirectIfGuest">
        <status-list-item
            v-for="status in statuses"
            :status="status"
            :key="status.id"
        ></status-list-item>
    </div>
</template>

<script>
    import StatusListItem from "./StatusListItem";

    export default {
        components: {
            StatusListItem
        },

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

        }
    };
</script>

<style scoped>

</style>
