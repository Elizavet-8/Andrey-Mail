<template>
    <div class="sequences__list">
        <div class="sequences__list-item" v-for="sequence in filtered">
            <h3 class="sequences__list-item-title h3">{{ sequence.title }}</h3>
            <div class="sequences__list-item-row">
                <button class="sequences__list-item-btn btn" v-if="$root.filter !== 'Archive'" @click="editSequence(sequence)"><img src="img/icons/Recipients.svg" alt="Edit" class="btn-icon">Edit Recipients</button>
                <div v-else></div>
                <button class="sequences__list-item-btn btn3" @click="delSequence(sequence.id)" v-if="$root.filter !== 'Archive'">Delete</button>
                <div v-else></div>
                <div class="sequences__list-item-stat">
                    <div class="sequences__list-item-stat-col">
                        <p class="sequences__list-item-stat-col-title">Active</p>
                        <p class="sequences__list-item-stat-col-value">{{ getActive(sequence) }}</p>
                    </div>
                    <div class="sequences__list-item-stat-col">
                        <p class="sequences__list-item-stat-col-title">Exited</p>
                        <p class="sequences__list-item-stat-col-value">{{ getExited(sequence) }}</p>
                    </div>
                    <div class="sequences__list-item-stat-col">
                        <p class="sequences__list-item-stat-col-title">Total</p>
                        <p class="sequences__list-item-stat-col-value">{{ sequence.recepients.length }}</p>
                    </div>
                </div>
                <div class="sequences__list-item-stat">
                    <div class="sequences__list-item-stat-col">
                        <img src="img/icons/Eye.svg" alt="Watch" class="sequences__list-item-stat-col-icon">
                        <p class="sequences__list-item-stat-col-value">{{ getWatch(sequence) }}%</p>
                    </div>
                    <div class="sequences__list-item-stat-col">
                        <img src="img/icons/ReplyBlack.svg" alt="Reply" class="sequences__list-item-stat-col-icon">
                        <p class="sequences__list-item-stat-col-value">{{ getReply(sequence) }}%</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "SequencesListComponent",

    data(){
        return {
            sequences: []
        }
    },

    methods: {
        getSequences(){
            axios.get('/api/get-sequences').then((data) => this.sequences = data.data)
        },

        delSequence(id){
            axios.post('/api/del-sequence', {id: id}).then(this.getSequences)
        },

        getWatch(sequence){
            let i = 0
            let total = 0

            if (sequence.recepients.length > 0){
                $(sequence.recepients).each(function () {
                    if (this.opened === 1) i++
                })

                total = 100 * i / sequence.recepients.length
            }
            
            total = total.toFixed(1)
            
            return total
        },

        getReply(sequence){
            let i = 0
            let total = 0

            if (sequence.recepients.length > 0){
                $(sequence.recepients).each(function () {
                    if (this.replied === 1) i++
                })
                
                total = 100 * i / sequence.recepients.length
            }
            
            total = total.toFixed(1)

            return total
        },

        getActive(sequence){
            let i = 0
            $(sequence.recepients).each(function () {
                if (this.active === 1) i++
            })
            return i
        },

        getExited(sequence){
            let i = 0
            $(sequence.recepients).each(function () {
                if (this.exited === 1) i++
            })
            return i
        },

        editSequence(sequence){
            this.$emit('edit', sequence)
        }
    },

    computed: {
        filtered: function () {
            let sequences = this.sequences
            if (this.$root.filter === 'All') {
                return sequences.filter(e => e.archive === 0)
            } else if (this.$root.filter === 'Archive'){
                return sequences.filter(e => e.archive === 1)
            } else if (this.$root.filter === 'Active'){
                return sequences.filter(e => e.archive === 0 && e.active === 1)
            }
        }
    },

    beforeMount() {
        this.getSequences()
    }
}
</script>
