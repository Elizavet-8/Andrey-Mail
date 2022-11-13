<template>
    <div class="popup" id="new-sequences">
        <div class="popup-body">
            <h2 class="popup__title h2">New sequence</h2>
            <div class="popup__form form">
                <div class="popup__form-group form-group">
                    <label for="name" class="popup__form-label label">name</label>
                    <input type="text" name="name" id="name" class="popup__form-input input" placeholder="Enter name" v-model="title">
                </div>
            </div>
            <div class="popup__group">
                <button class="popup__group-btn btn" @click="create">Create</button>
                <button class="popup__group-btn popup-close btn2" @click="$emit('close')">Cancel</button>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "SequencesPopupComponent",

    data(){
        return {
            title: ''
        }
    },

    methods: {
        create(){
            axios.post('/api/create-sequences', {
                title: this.title
            }).then((data) => {this.$emit('create', this.title, data.data)})
        }
    }
}
</script>
