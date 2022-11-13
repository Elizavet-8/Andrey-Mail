<template>
    <div class="feed__table">
        <div class="feed__table-search">
            <input type="text" class="input" placeholder="Search by email" v-model="search">
        </div>
        <div class="feed__table-row">
            <p class="feed__table-cell feed-title">Last activity</p>
            <p class="feed__table-cell feed-title">Recipients</p>
            <p class="feed__table-cell feed-title">Subject</p>
            <p class="feed__table-cell feed-title">Activity totals</p>
            <p class="feed__table-cell feed-download"></p>
        </div>
        <div class="feed__table-row" v-for="recepient in filtered">
            <p class="feed__table-cell">{{ convertDate(recepient.updated_at) }}</p>
            <p class="feed__table-cell">{{ recepient.name }} ({{ recepient.email }})</p>
            <p class="feed__table-cell">{{ recepient.subject }}</p>
            <p class="feed__table-cell">
                <span title="Sent" v-if="recepient.sent === 1">✔</span>
                <span title="Sent" v-else></span>
                <span title="Opened" v-if="recepient.opened === 1">✔</span>
                <span title="Opened" v-else></span>
                <span title="Replied" v-if="recepient.replied === 1">✔</span>
                <span title="Replied" v-else></span>
            </p>
            <p class="feed__table-cell"></p>
        </div>
    </div>
</template>

<script>
export default {
    name: "FeedTableComponent",

    data(){
        return {
            recepients: [],
            search: ''
        }
    },

    methods: {
        getRecepients(){
            axios.get('/api/get-recepients').then((data) => {
                let sort = data.data
                sort.sort((a, b) => a.updated_at < b.updated_at ? 1 : -1)
                this.recepients = sort
            })
        },

        convertDate(timestamp){
            let date = new Date(timestamp)
            let currentDate = new Date()

            currentDate.setDate(currentDate.getDate() - 1)

            if (currentDate >= date){
                let day = date.getDate()
                let month = date.getMonth()
                if (day < 10){
                    day = '0' + day
                }
                if (month < 10){
                    month = '0' + month
                }

                date = day + '.' + month + '.' + date.getFullYear()
            }

            if (currentDate < date){
                let hours = date.getHours()
                let minutes = date.getMinutes()
                if (hours < 10){
                    hours = '0' + hours
                }
                if (minutes < 10){
                    minutes = '0' + minutes
                }

                date = hours + ':' + minutes
            }

            return date
        }
    },

    computed: {
        filtered: function (){
            let search = this.search
            return this.recepients.filter(function (elem) {

                if(search==='') {
                    return true
                }
                else {
                    return elem.email.indexOf(search) > -1
                }
            })
        }
    },

    beforeMount() {
        this.getRecepients()
    }
}
</script>
