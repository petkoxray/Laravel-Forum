<template>
    <li class="dropdown" v-if="notifications.length">
        <a href="" class="dropdown-toggle" data-toggle="dropdown">
            <span class="glyphicon-bell"></span>
        </a>

        <ul class="dropdown-menu">
            <li v-for="notification in notifications">
                <a :href="notification.data.link" v-text="notification.data.message"
                   @click="markAsRead(notification)"></a>
            </li>
        </ul>
    </li>
</template>

<script>
    export default {
        name: "UserNotifications",
        data() {
            return {
                notifications: false
            }
        },
        created() {
          axios.get('/profiles/' + window.App.user.username + '/notifications')
              .then(response => this.notifications = response.data);
        },
        methods: {
            markAsRead(notification) {
                axios.delete('/profiles/' + window.App.user.username + '/notifications/' + notification.id);
            }
        }
    }
</script>

<style scoped>

</style>