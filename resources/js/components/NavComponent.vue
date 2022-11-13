<template>
    <div>
        <img src="img/icons/SidebarSwitch.svg" class="sidebar-switch-show" @click="show">
        <div class="sidebar">
            <div class="sidebar-body">
                <img src="img/icons/SidebarSwitch.svg" alt="SidebarSwitch" class="sidebar-switch-hide" @click="hide">
                <img src="img/logo.svg" alt="logo" class="sidebar-logo">
                <div class="sidebar__links">
                    <a href="/" class="sidebar__links-item" :class="{'sidebar__links-item-active': current === '/'}"><img src="img/icons/LiveFeed.svg" alt="LiveFeed" class="sidebar__links-item-icon">Live Feed</a>
                    <a href="/sequences" class="sidebar__links-item" :class="{'sidebar__links-item-active': current === '/sequences'}"><img src="img/icons/Sequences.svg" alt="Sequences" class="sidebar__links-item-icon">Sequences</a>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "NavComponent",
    data(){
        return {
            current: ''
        }
    },

    methods:{
        getLink(){
            this.current = location.pathname
        },

        hide(){
            $('.sidebar').css('left', '-250px')
            $('main').css({'margin-left':'50px', 'width': 'calc(100% - 100px)'})
        },

        show(){
            $('.sidebar').css('left', '0')
            $('main').css({'margin-left':'260px', 'width': 'calc(100% - 310px)'})
        }
    },

    beforeMount() {
        this.getLink()
    }
}
</script>
