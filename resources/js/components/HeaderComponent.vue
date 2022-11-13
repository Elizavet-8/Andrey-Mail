<template>
    <header class="header" v-if="user.info">
        <h2 class="header-title h2">{{ $root.filter }}</h2>
        <div class="header-block">
            <p>{{ user.name }}</p>
            <img :src="user.info.img" :alt="user.name" class="header-img">
            <a class="dropdown-item" href="/logout"
               onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                Logout
            </a>
            <form id="logout-form" action="/logout" method="POST" class="d-none">
                <input type="hidden" name="_token" :value="csrf">
            </form>
        </div>
    </header>
</template>

<script>
export default {
    name: "HeaderComponent",
    data(){
        return {
            user: [],
            csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        }
    },

    methods: {
        getUser(){
            axios.get('/get-user').then((data) => this.user = data.data)
        }
    },

    beforeMount() {
        this.getUser()
    }
}
</script>
