<template>
    <div>
        <form @submit.prevent="submit" v-if="isAuthenticated">
            <div class="card-body">
                <textarea
                    v-model="body"
                    class="form-control border-0 bg-light"
                    name="body"
                    :placeholder="`Que estas pensando ${currentUser.name}?`"
                ></textarea>
            </div>
            <div class="card-footer">
                <button class="btn btn-primary" id="create-status">Publicar</button>
            </div>
        </form>
        <div class="card-body" v-else>
            <a href="/login">Debes hacer login para publicar estados.</a>
        </div>
    </div>
</template>

<script>

    // import auth from '../mixins/auth';

    export default {
        data(){
            return {
                body: '',
            }
        },
        // mixins: [auth],
        methods: {
            submit(){
                axios
                    .post('/statuses', {body: this.body})
                    .then(res => {
                        EventBus.$emit('status-created', res.data.data);
                        this.body = ''
                    })
                    .catch(error => { console.error(error.response.data) })
            }
        }
    };
</script>

<style scoped>

</style>
