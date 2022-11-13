/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.use('vue-jquery')

Vue.component('dropdown-component', require('./components/DropDownComponent.vue').default);
Vue.component('header-component', require('./components/HeaderComponent.vue').default);
Vue.component('nav-component', require('./components/NavComponent.vue').default);
Vue.component('filters-component', require('./components/FiltersComponent.vue').default);

/**
 * Auth components
 */

Vue.component('auth-yandex-component', require('./components/auth/YandexComponent.vue').default);
Vue.component('auth-gmail-component', require('./components/auth/GmailComponent.vue').default);

/**
 * Sequences components
 */

Vue.component('sequences-main-component', require('./components/sequences/SequencesMainComponent.vue').default);
Vue.component('sequences-list-component', require('./components/sequences/SequencesListComponent.vue').default);
Vue.component('recepients-list-component', require('./components/sequences/RecepientsListComponent.vue').default);
Vue.component('sequences-add-component', require('./components/sequences/SequencesAddComponent.vue').default);
Vue.component('sequences-step-1-component', require('./components/sequences/SequencesStep1Component.vue').default);
Vue.component('sequences-step-2-component', require('./components/sequences/SequencesStep2Component.vue').default);
Vue.component('sequences-step-3-component', require('./components/sequences/SequencesStep3Component.vue').default);
Vue.component('sequences-popup-component', require('./components/sequences/SequencesPopupComponent.vue').default);

Vue.component('sequences-edit-component', require('./components/sequences/SequencesEditComponent.vue').default);

/**
 * Feed components
 */

Vue.component('feed-main-component', require('./components/feed/FeedMainComponent.vue').default);
Vue.component('feed-stat-component', require('./components/feed/FeedStatComponent.vue').default);
Vue.component('feed-table-component', require('./components/feed/FeedTableComponent.vue').default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

import Store from './store'

const app = new Vue({
    el: '#app',
    data: Store
});
