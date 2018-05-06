<script>
    import Replies from '../components/Replies.vue';
    import SubscribeButton from '../components/SubscribeButton.vue';

    export default {
        props: ['thread'],

        components: {Replies, SubscribeButton},

        data () {
            return {
                repliesCount: this.thread.replies_count,
                locked: this.thread.locked,
                pinned: this.thread.pinned,
                title: this.thread.title,
                body: this.thread.body,
                form: {},
                editing: false
            };
        },

        created () {
            this.resetForm();
        },

        methods: {
            toggleLock () {
                let uri = `/admin/threads/${this.thread.slug}/lock`;

                axios[this.locked ? 'delete' : 'post'](uri)
                .catch(e => console.log(e.response.data));

                this.locked = ! this.locked;
            },

            togglePin() {
                let uri = `/admin/threads/${this.thread.slug}/pin`;

                axios[this.pinned ? 'delete' : 'post'](uri);

                this.pinned = ! this.pinned;
            },

            update () {
                let uri = `/threads/${this.thread.channel.slug}/${this.thread.slug}`;

                axios
                .patch(uri, this.form)
                .then(() => {
                    this.editing = false;
                    this.title = this.form.title;
                    this.body = this.form.body;

                    flash('Your thread has been updated.');
                })
                .catch(error => {
                    flash(error.response.data, 'danger');
                });
            },

            resetForm () {
                this.form = {
                    title: this.thread.title,
                    body: this.thread.body
                };

                this.editing = false;
            }
        }
    }
</script>