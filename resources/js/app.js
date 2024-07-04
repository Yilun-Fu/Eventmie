require('./bootstrap');

window.Vue = require('vue');

import BootstrapVue from 'bootstrap-vue';
import 'bootstrap/dist/css/bootstrap.css';
import 'bootstrap-vue/dist/bootstrap-vue.css';

Vue.use(BootstrapVue);

// 注册 Vue 组件
Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('success-alert', require('./components/SuccessAlert.vue').default);

const app = new Vue({
    el: '#app',
    data: {
        showAlert: false,
        alertMessage: '',
    },
    methods: {
        handleUpload(event) {
            event.preventDefault();
            let formData = new FormData(event.target);

            axios.post('/upload', formData)
                .then(response => {
                    this.alertMessage = 'Files uploaded successfully.';
                    this.showAlert = true;
                })
                .catch(error => {
                    this.alertMessage = 'Failed to upload files.';
                    this.showAlert = true;
                });
        }
    }
});
