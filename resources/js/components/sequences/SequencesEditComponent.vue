<template>
    <div class="new">
        <div class="new-body">
            <div class="new__header">
                <div class="new__header-form form">
                    <div class="new__header-form-group form-group">
                        <label for="name" class="new__header-form-label label">sequence name</label>
                        <input type="text" name="name" id="name" class="new__header-form-input input" placeholder="Enter name" v-model="sequence.title">
                    </div>
                </div>
            </div>
            <div class="new__content">
                <div class="new__content-header">
                    <div class="new__content-header-import">
                    </div>
                    <div class="new__content-header-actions">
                        <div class="new__content-header-actions-item">
                            {{ sequence.recepients.length }} recipients
                        </div>
                        <div class="new__content-header-actions-item" @click="add = !add">
                            <img src="img/icons/Plus.svg" alt="Add" class="new__content-header-actions-item-icon">
                            Add recepient
                        </div>
                    </div>
                </div>
                <div class="new__content-table">
                    <div class="new__content-table-row">
                        <div class="new__content-table-row-cell">Recipient</div>
                        <div class="new__content-table-row-cell">Status</div>
                        <div class="new__content-table-row-cell">Sent on</div>
                    </div>
                    <div class="new__content-table-row" v-for="(item, index) in sequence.recepients">
                        <div class="new__content-table-row-cell">
                            <span style="color:#6b6dfa">{{ item.name }}</span>
                            <span style="opacity: .7">{{ item.email }}</span>
                        </div>
                        <div class="new__content-table-row-cell feed__table-cell" style="flex-direction: row; align-items: center; justify-content: center; width: auto; margin-right: 0;">
                            <span title="Sent" v-if="item.sent === 1">✔</span>
                            <span title="Sent" v-else></span>
                            <span title="Opened" v-if="item.opened === 1">✔</span>
                            <span title="Opened" v-else></span>
                            <span title="Replied" v-if="item.replied === 1">✔</span>
                            <span title="Replied" v-else></span>
                            <span title="Stage" style="border-radius: 50%; padding: 0; width: 24px; height: 24px; color: #fff; background: #ccc; display: flex; justify-content: center; align-items: center;">
                                {{ item.stage + 1 }}
                            </span>
                        </div>
                        <div class="new__content-table-row-cell" style="align-items: center">
                            {{ convertDate(item.updated_at) }}
                        </div>
                    </div>
                </div>
            </div>
            <div class="new__group">
                <div class="new__group-block">
                    <button class="new__group-block-btn btn2" @click="$emit('close')">Save & close</button>
                </div>
            </div>
            <div class="popup" id="new-sequences" v-if="add">
                <div class="popup-body">
                    <h2 class="popup__title h2">New recepient</h2>
                    <div class="popup__form form">
                        <div class="popup__form-group form-group">
                            <label for="name" class="popup__form-label label">name</label>
                            <input type="text" name="name" id="name" class="popup__form-input input" placeholder="Enter name" v-model="name">
                        </div>
                        <div class="popup__form-group form-group">
                            <label for="name" class="popup__form-label label">email</label>
                            <input type="text" name="name" id="name" class="popup__form-input input" placeholder="Enter name" v-model="email">
                        </div>
                    </div>
                    <div class="popup__group">
                        <button class="popup__group-btn btn" @click="addRecepient">Create</button>
                        <button class="popup__group-btn popup-close btn2" @click="add = !add">Cancel</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "SequencesEditComponent",

    props: [
        'sequence'
    ],

    data(){
        return {
            add: false,
            name: '',
            email: ''
        }
    },

    methods: {
        addRecepient(){
            axios.post('/api/add-recepient', {
                sequence: this.sequence.id,
                name: this.name,
                email: this.email
            })

            this.sequence.recepients.push({name: this.name, email: this.email, stage: 0, updated_at: Date.now()})
            this.add = !this.add
            this.name = ''
            this.email = ''
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
    }
}
</script>

<style scoped>
.new__content-table-row {
    grid-template-columns: 1fr 1fr 1fr;
    height: auto;
}
.new__content-table-row-cell {
    justify-content: center;
    align-items: flex-start;
    padding: 8px;
    flex-direction: column;
}
.new__content-table-row:first-child .new__content-table-row-cell{
    align-items: center;
}
</style>