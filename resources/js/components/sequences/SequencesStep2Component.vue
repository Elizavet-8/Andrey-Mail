<template>
    <div class="new__content step-2">
        <div class="new__content-sidebar">
            <div class="new__content-sidebar-item" v-for="(item, index) in stages" @click="stage = index" :class="{'new__content-sidebar-item-active': index === stage}">
                <img src="img/icons/Mail.svg" alt="Mail" class="new__content-sidebar-item-icon">
                <p class="new__content-sidebar-item-title">Stage {{ index + 1 }}</p>
                <img src="img/icons/Del.svg" alt="Delete" class="new__content-sidebar-item-delete" @click="delStage(index)">
            </div>
            <div class="new__content-sidebar-item" @click="addStage">
                <img src="img/icons/Add.svg" alt="Add" class="new__content-sidebar-item-icon">
                <p class="new__content-sidebar-item-title">Add another stage</p>
            </div>
        </div>
        <div class="new__content-email">
            <div class="new__content-email-block" v-for="cstage in stages[stage]">
                <div class="new__content-email-block-header">
                    <h3 class="new__content-email-block-header-title h3">{{ stage + 1 }}. Email</h3>
                </div>
                <div class="new__content-email-block-action">
                    <p class="new__content-email-block-action-text" v-if="stage !== 0">If stage {{ stage }} not replied in</p>
                    <input type="number" class="new__content-email-block-action-input input" placeholder="Time" v-if="stage !== 0" v-model="cstage.actionTime">
                    <dropdown-component class="new__content-email-block-action-dd" v-if="stage !== 0" :list="['Day', 'Week']" :default="cstage.action" @dd="changeAction"></dropdown-component>
                </div>
                <div class="new__content-email-block-body">
                    <input type="text" class="new__content-email-block-body-input input" placeholder="Subject" v-model="cstage.subject" v-if="stage === 0">
                    <vue-editor class="new__content-email-block-body-wysiwyg" v-model="cstage.content"></vue-editor>
                    <p class="new__content-email-block-body-variables">Variables:
                        <span @click="cstage.content = cstage.content + '{{name}}'">name</span>,
                        <span @click="cstage.content = cstage.content + '{{senderSignature}}'">sender signature</span>
                    </p>
                </div>
                <button class="new__content-email-block-btn btn3" @click="sendMyself(stage)">Send myself a test email</button>
            </div>
            <button class="new__content-email-btn btn" id="popup-new" @click="addStage"><img src="img/icons/Add.svg" alt="Add" class="btn-icon"> Add another stage</button>
        </div>
    </div>
</template>

<script>
import { VueEditor } from "vue2-editor";

let watch;
export default {
    name: "SequencesStep2Component",

    props: [
        'sequence'
    ],

    data(){
        return {
            stages: [
                [{
                    action: 'Day',
                    actionTime: 0,
                    subject: '',
                    content: ''
                }]
            ],
            currentStage: 0,
            stage: 0
        }
    },

    methods: {
        delStage(index){
            this.stages.splice(index, 1)
        },

        addStage(){
            this.stages.push([{actionTime: 0,action: 'Day', subject: '', content: ''}])
        },

        changeAction(val){
            this.stages[this.stage][0].action = val
        },

        sendMyself(stage){
            axios.post('/api/send-myself', {
                stage: this.stages[stage]
            })
        }
    },

    watch: {
        stages: function () {
            this.sequence.stages = this.stages
        }
    }
}
</script>
