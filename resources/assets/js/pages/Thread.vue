<script>
    import Replies from '../components/Replies.vue';
    import SubscribeButton from '../components/SubscribeButton';

    export default {
        props: ['thread'],

        components: {Replies, SubscribeButton},

        data() {
            return {
                repliesCount: this.thread.replies_count,
                locked: this.thread.locked
            };
        },
        methods: {
            toggleLock() {
                let uri = `/admin/threads/${this.thread.slug}/lock`;

                axios[this.locked ? "delete" : "post"](uri);
                this.locked = !this.locked;
            }
        }
    }
</script>