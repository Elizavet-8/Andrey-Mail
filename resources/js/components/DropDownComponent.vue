<template>
    <div class="dd">
        <span class="dd-value" @click="show = !show"><span>{{ value }}</span> <img src="img/icons/DropdownArrow.svg" alt="DropdownArrow" class="dd-icon"></span>
        <ul class="dd__list" v-show="show">
            <li class="dd__list-item" v-for="item in list" :class="{'dd-active': item === value}" @click="changeValue(item)">{{ item }}</li>
        </ul>
    </div>
</template>

<script>
export default {
    name: "DropDownComponent",
    props: ['list', 'default'],
    data(){
        return {
            show: false,
            value: this.default
        }
    },
    methods: {
        changeValue(val){
            this.value = val
            this.show = !this.show
            this.$emit('dd', this.value)
        }
    }
}
</script>
