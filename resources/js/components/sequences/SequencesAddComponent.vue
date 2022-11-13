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
                <div class="new__header-stage">
                    <div class="new__header-stage-item" v-for="(item, index) in stepTitles" :class="{'new__header-stage-item-active': step === index}">
                        <span class="new__header-stage-item-number">{{ index + 1 }}</span>
                        <p class="new__header-stage-item-title">{{ item }}</p>
                    </div>
                </div>
            </div>
            <sequences-step-1-component :sequence="sequence" v-if="step === 0"></sequences-step-1-component>
            <sequences-step-2-component :sequence="sequence" v-show="step === 1"></sequences-step-2-component>
            <sequences-step-3-component :sequence="sequence" v-if="step === 2"></sequences-step-3-component>
            <div class="new__group">
                <button class="new__group-btn btn3" v-if="step !== 0" @click="step --">Back</button>
                <div class="new__group-block">
                    <button class="new__group-block-btn btn2" @click="save">Save & close</button>
                    <button class="new__group-block-btn btn" @click="step ++" v-if="step !== 2">Next: {{ stepTitles[step + 1] }}</button>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "SequencesAddComponent",

    props: [
        'sequence'
    ],

    data(){
        return {
            step: 0,
            stepTitles: [
                'Add recipients',
                'Edit stages',
                'Confirm'
            ]
        }
    },

    methods: {
        save(){
            axios.post('/api/save-sequence', this.sequence).then((data) => {if (data.data === 1)this.$emit('close')})
        }
    }
}
</script>