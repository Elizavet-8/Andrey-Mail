<template>
    <div class="feed__stat">
        <div class="feed__stat-item feed-1">
            <span class="feed__stat-item-value">{{ stat.sent }}</span>
            <p class="feed__stat-item-title">Emails sent</p>
        </div>
        <div class="feed__stat-item feed-5">
            <span class="feed__stat-item-value">{{ stat.total }}</span>
            <p class="feed__stat-item-title">Recipients</p>
        </div>
        <div class="feed__stat-item feed-2">
            <span class="feed__stat-item-value">{{ opened }}%</span>
            <p class="feed__stat-item-title">Opened ({{ stat.opened }})</p>
        </div>
        <div class="feed__stat-item feed-6">
            <span class="feed__stat-item-value">{{ replied }}%</span>
            <p class="feed__stat-item-title">Replied ({{ stat.replied }})</p>
        </div>
    </div>
</template>

<script>
export default {
    name: "FeedStatComponent",
    data(){
        return{
            stat: {
                sent: 0,
                total: 0,
                opened: 0,
                replied: 0
            },
            opened: 0,
            replied: 0
        }
    },

    methods: {
        getStat(){
            return axios.get('/api/get-stat').then((data) => {this.stat = data.data; this.getPercents(data.data)})
        },

        getPercents(data){
            if (data.opened !== 0){
                this.opened = 100 * data.opened / data.total
                this.opened = this.opened.toFixed(1)
            }
            if (data.replied !== 0){
                this.replied = 100 * data.replied / data.total
                this.replied = this.replied.toFixed(1)
            }
        }
    },

    mounted() {
        this.getStat()
    }
}
</script>

<style scoped>

</style>
