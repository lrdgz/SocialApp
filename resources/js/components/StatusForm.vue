<template>
    <form @submit.prevent="submit">
        <div class="card-body">
            <textarea v-model="body" class="form-control border-0 bg-light" name="body" placeholder="Que estas pensando Luis"></textarea>
        </div>
        <div class="card-footer">
            <button class="btn btn-primary" id="create-status">Publicar</button>
        </div>
    </form>
</template>

<script>
    export default {
        data(){
            return {
                body: '',
            }
        },
        methods: {
            submit(){
                axios
                    .post('/statuses', {body: this.body})
                    .then(res => { console.log(res.data) })
                    .catch(error => { console.error(error.response.data) })
            }
        }
    }
</script>

<style scoped>

</style>
