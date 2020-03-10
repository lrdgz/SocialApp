<template>
    <button
        @click="toggle()"
        :class="getBtnClases">
        <i :class="getIconClases"></i>
        {{ getText }}
    </button>
</template>

<script>
    export default {
        props: {
            model: {
                type: Object,
                required: true,
            },
            url: {
                type: String,
                required: true,
            },
        },
        computed: {
            getText(){
               return this.model.is_liked ? 'TE GUSTA' : 'ME GUSTA';
            },

            getBtnClases(){
                return [
                    'btn',
                    'btn-link',
                    'btn-sm',
                    this.model.is_liked ? 'font-weigth-bold' : '',
                ];
            },

            getIconClases(){
                return [
                    this.model.is_liked ? 'fa' : 'far',
                    'fa-thumbs-up', 'text-primary', 'mr-1'
                ];
            },
        },
        methods: {
            toggle(){
                let method = this.model.is_liked ? 'delete' : 'post';
                axios[method](this.url)
                    .then( res => {
                        this.model.is_liked = !this.model.is_liked;
                        if(method == 'post'){
                            this.model.likes_count ++;
                        } else {
                            this.model.likes_count --;
                        }
                    } )
                    .catch( err => {console.error(err.response.data)} );
            }
        }
    }
</script>

<style lang="scss" scoped>
    .comments-like-btn{
        font-size: 0.6em;
        padding-left:0;
        i { display:none; }
    }
</style>
