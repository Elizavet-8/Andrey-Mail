<template>
    <aside class="filters" v-if="location === '/'">
        <h1 class="h1 filters-title">Live Feed</h1>
        <div class="filters__list">
            <a href="#" class="filters__list-main" :class="{'filters__list-active': select === 'All'}">All</a>
            <a href="#" class="filters__list-item" :class="{'filters__list-active': select === 'Opened'}">Opened</a>
            <a href="#" class="filters__list-item" :class="{'filters__list-active': select === 'Opened, unreplied'}">Opened, unreplied</a>
            <a href="#" class="filters__list-item" :class="{'filters__list-active': select === 'Replied'}">Replied</a>
            <a href="#" class="filters__list-item" :class="{'filters__list-active': select === 'Unopened'}">Unopened</a>
        </div>
    </aside>
    <aside class="filters" v-else>
        <h1 class="h1 filters-title">Sequences</h1>
        <div class="filters__list">
            <a href="#" class="filters__list-main" :class="{'filters__list-active': select === 'All'}">All</a>
            <a href="#" class="filters__list-item" :class="{'filters__list-active': select === 'Active'}">Active</a>
            <a href="#" class="filters__list-item" :class="{'filters__list-active': select === 'Archive'}">Archive</a>
        </div>
    </aside>
</template>

<script>
export default {
    name: "FiltersComponent",

    data(){
        return{
            select: 'All'
        }
    },

    mounted() {
        let _th = this
        $('.filters__list-item, .filters__list-main').click(function () {
           _th.select = $(this).text()

            _th.$root.filter = _th.select
        })
    },

    computed: {
        location: function () {
            return window.location.pathname
        }
    }
}
</script>
