<template>
    <div>
        Redirecting...
    </div>
</template>

<script>
export default {
    name: "YandexComponent",
    data() {
        return {
            token: this.token = /access_token=([^&]+)/.exec(document.location.hash)[1],
            user: [],
        }
    },

    methods: {
        getUser() {
            axios.get('https://login.yandex.ru/info?format=json&oauth_token='+this.token).then((data) => {this.user = data.data; this.loginUser(data.data)})
        },

        loginUser(data){
            axios.post('/yandex-auth', {
                email: data.default_email,
                username: data.display_name,
                img: 'https://avatars.yandex.net/get-yapic/' + data.default_avatar_id + '/islands-200',
                token: this.token
            }).then((data) => {
                if (data.data === 0){
                    alert('Access denied. User account not allowed.')
                    window.location = '/login'
                } else if (data.data === 1) {
                    window.location = '/'
                }
            }).catch(() => {
                alert('Error. Please, try again.')
                window.location = '/login'
            })
        }
    },

    mounted(){
      this.getUser()
    }
}
</script>
