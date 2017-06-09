
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue');

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

import DropHeader from './includes/Header.vue';
import DropFooter from './includes/Footer.vue';
import 'vue-awesome/icons';
import Icon from 'vue-awesome/components/Icon';
import Drops from './components/Drops.vue';
import Drop from './components/Drop.vue';
import VueLazyload from 'vue-lazyload';
import VueAnalytics from 'vue-analytics'

Vue.component('Icon', Icon);
Vue.use(VueLazyload, {
  preLoad: 1.3,
  loading: '/images/loading.gif',
  attempt: 1
})
Vue.use(VueAnalytics, {
  id: 'UA-100788423-1'
})

require('vue2-animate/dist/vue2-animate.min.css');

export const EventBus = new Vue();

const app = new Vue({
    el: '#app',
    components: {
        'drop-header': DropHeader,
        'drop-footer': DropFooter,
        'Drops': Drops,
        'Drop': Drop
    },
    props: [],
    data() {
        return {
            results: [],
            errors: [],
            show: true,
            backdrop: '',
            drop: ''
        }
    },
    created() {
        EventBus.$on('addDropBackground', (dropBackground) => {

            this.backdrop = dropBackground;

            this.changeBackground();
        });

        EventBus.$on('expandDrop', (drop) => {

            this.drop = drop;

            this.show = (this.show) ? !this.show : this.show = true;

            this.changeBackground();
        });

        EventBus.$on('goBack', (home) => {

            if(this.show === false) {
                var el = document.getElementsByTagName('body')[0];
                el.style.background = "#E9EFD4 url(/images/hero/pastels.jpg) no-repeat center center fixed";
                el.style.backgroundSize = "cover";
            }

            this.show = home;
        });
    },
    mounted() {},
    methods: {
        changeBackground() {
            var el = document.getElementsByTagName('body')[0];
            el.style.background = "#E9EFD4 url("+this.backdrop+") no-repeat center center fixed";
            el.style.backgroundSize = "cover";
        }
    }
});
