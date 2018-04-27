<template>
    <div class="row">
        <div class="col-md-4 col-md-offset-5">

            <img :src="avatar" width="200" height="200" class="mr-1">

            <h1 v-text="user.name"></h1>

            <form v-if="canUpdate" method="POST" enctype="multipart/form-data">
                <image-upload name="avatar" class="mr-1" @loaded="onLoad"></image-upload>
            </form>
        </div>
    </div>
</template>

<script>
    import ImageUpload from './ImageUpload.vue';

    export default {
        props: ['user'],

        components: {ImageUpload},

        data() {
            return {
                avatar: this.user.avatar_path
            };
        },

        computed: {
            canUpdate() {
                return this.authorize(user => user.id === this.user.id);
            }
        },

        methods: {
            onLoad(avatar) {
                this.avatar = avatar.src;

                this.persist(avatar.file);
            },

            persist(avatar) {
                let data = new FormData();

                data.append('avatar', avatar);

                axios.post(`/users/${this.user.name}/avatar`, data)
                    .then(() => flash('Avatar uploaded!'));
            }
        }
    }
</script>