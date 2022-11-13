<template>
    <div class="new__content step-1">
        <div class="new__content-header">
            <div class="new__content-header-import">
                <vue-csv-import
                    v-model="sequence.recipients"
                    :map-fields="['name', 'email']">

                    <template slot="hasHeaders" slot-scope="{headers, toggle}">
                        <label>
                            <input type="checkbox" id="hasHeaders" :value="headers" @change="toggle">
                            File have headers?
                        </label>
                    </template>

                    <template slot="error">
                        File type is invalid
                    </template>

                    <template slot="thead">
                        <tr>
                            <th>Field</th>
                            <th>Column</th>
                        </tr>
                    </template>

                    <template slot="next" slot-scope="{load}">
                        <button @click.prevent="load" class="btn">Load CSV</button>
                    </template>

                    <template slot="submit" slot-scope="{submit}">
                        <button @click.prevent="submit" class="btn">Send</button>
                    </template>
                </vue-csv-import>
            </div>
            <div class="new__content-header-actions">
                <div class="new__content-header-actions-item">
                    {{ sequence.recipients.length }} recipients
                </div>
                <div class="new__content-header-actions-item" @click="clearRows">
                    <img src="img/icons/Del.svg" alt="Delete" class="new__content-header-actions-item-icon">
                    Clear recipients
                </div>
                <div class="new__content-header-actions-item" @click="clearEmptyRows">
                    <img src="img/icons/Del.svg" alt="Delete" class="new__content-header-actions-item-icon">
                    Clear empty columns
                </div>
            </div>
        </div>
        <div class="new__content-table">
            <div class="new__content-table-row">
                <div class="new__content-table-row-cell"></div>
                <div class="new__content-table-row-cell">Name</div>
                <div class="new__content-table-row-cell">Email</div>
                <div class="new__content-table-row-cell" @click="addRow"><img src="img/icons/Plus.svg" alt="Add row" class="new__content-table-row-add"></div>
            </div>
            <div class="new__content-table-row" v-for="(item, index) in sequence.recipients">
                <div class="new__content-table-row-cell">{{ index + 1 }}</div>
                <div class="new__content-table-row-cell"><input type="text" placeholder="Enter name" class="input" v-model="item.name"></div>
                <div class="new__content-table-row-cell"><input type="email" placeholder="Enter email" class="input" v-model="item.email"></div>
                <div class="new__content-table-row-cell"><img src="img/icons/Del.svg" alt="Delete" class="new__content-table-row-cell-del" @click="delRow(index)"></div>
            </div>
        </div>
    </div>
</template>

<script>
import { VueCsvImport } from 'vue-csv-import';

export default {
    name: "SequencesStep1Component",

    props: [
        'sequence'
    ],

    data(){
        return{

        }
    },

    methods: {
        delRow(index){
            this.sequence.recipients.splice(index, 1)
        },

        addRow(){
            this.sequence.recipients.push({name: '', email: ''})
        },

        clearRows(){
            this.sequence.recipients = [{name: '', email: ''}]
        },

        clearEmptyRows(){
            let _th = this
            $(this.sequence.recipients).each(function (i, val) {
                if (val.name === '' && val.email === ''){
                    _th.sequence.recipients.splice(i, 1)
                    _th.clearEmptyRows()
                }
            })
        }
    }
}
</script>
