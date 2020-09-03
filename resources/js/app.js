import { InertiaApp } from '@inertiajs/inertia-vue';
import Vue from 'vue';
import Buefy from 'buefy';
import 'buefy/dist/buefy.css';

Vue.use(InertiaApp);
Vue.use(Buefy);

const app = document.getElementById('app');

Vue.prototype.$route = (...args) => route(...args).url();

new Vue({
    render: h => h(InertiaApp, {
        props: {
            initialPage: JSON.parse(app.dataset.page),
            resolveComponent: name => require(`./pages/${name}`).default,
        },
    }),
}).$mount(app);