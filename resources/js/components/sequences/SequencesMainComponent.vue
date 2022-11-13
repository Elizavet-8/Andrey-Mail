<template>
    <div class="sequences">
        <div class="sequences__header">
            <button class="sequences__header-btn btn" id="popup-new" @click="popup = !popup"><img src="img/icons/Add.svg" alt="Add" class="btn-icon"> New sequences</button>
            <div class="sequences__header-row">
                <div class="sequences__header__tabs" id="horizontal-scroll">
                    <p class="sequences__header__tabs-item" :class="{'sequences__header__tabs-active': tab === 'sequences'}" @click="tab = 'sequences'">sequences</p>
                    <p class="sequences__header__tabs-item" :class="{'sequences__header__tabs-active': tab === 'recepients'}" @click="tab = 'recepients'">recepients</p>
                </div>

                <div class="sequences__header__sort">
                    <p class="sequences__header__sort-title">sort by</p>
                    <div class="sequences__header__sort-group">
                        <dropdown-component class="sequences__header__sort-dd" :list="['Name', 'Last activity']" :default="'Name'"></dropdown-component>
                        <div class="sequences__header__sort-dir">
                            <img src="img/icons/SortDir.svg" alt="Direction" class="sequences__header__sort-dir-img">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <sequences-list-component ref="list" @edit="editSequences" v-if="tab === 'sequences'"></sequences-list-component>
        <recepients-list-component ref="list" v-if="tab === 'recepients'"></recepients-list-component>

        <sequences-popup-component v-if="popup" @close="popup = !popup" @create="createSequence"></sequences-popup-component>

        <sequences-add-component v-if="add" :sequence="sequence" @close="add = !add; $refs.list.getSequences()"></sequences-add-component>

        <sequences-edit-component v-if="edit" :sequence="sequence" @close="edit = !edit; $refs.list.getSequences()"></sequences-edit-component>
    </div>
</template>

<script>
export default {
    name: "SequencesMainComponent",
    data(){
        return {
            popup: false,
            add: false,
            edit: false,
            tab: 'sequences',
            sequence: {
                title: '',
                recipients: [
                    {
                        name: '',
                        email: ''
                    }
                ]
            }
        }
    },

    methods: {
        createSequence(title, id){
            this.popup = !this.popup
            this.add = !this.add
            this.$refs.list.getSequences()
            this.sequence.title = title
            this.sequence.id = id
        },

        editSequences(sequence){
            this.edit = !this.edit
            this.sequence = sequence
        }
    },

    mounted() {
        document.getElementById("horizontal-scroll")
            .addEventListener('wheel', function(event) {
                if (event.deltaMode == event.DOM_DELTA_PIXEL) {
                    var modifier = 1;
                } else if (event.deltaMode == event.DOM_DELTA_LINE) {
                    var modifier = parseInt(getComputedStyle(this).lineHeight);
                } else if (event.deltaMode == event.DOM_DELTA_PAGE) {
                    var modifier = this.clientHeight;
                }
                if (event.deltaY != 0) {
                    this.scrollLeft += modifier * event.deltaY;
                    event.preventDefault();
                }
            });

        let rotate = 0

        $('.sequences__header__sort-dir').click(function (){
            if (rotate === 0){
                $('.sequences__header__sort-dir-img').css('transform', 'scale(1, -1)')
                rotate = 1
            } else {
                $('.sequences__header__sort-dir-img').css('transform', 'scale(1)')
                rotate = 0
            }
        })
    }
}
</script>
