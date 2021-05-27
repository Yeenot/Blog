require('./bootstrap');
import moment from 'moment'

window.Vue = require('vue').default;
Vue.prototype.moment = moment;

// Dataset of modules
const root = document.getElementById('app')
const dataset = root.dataset;
var page = dataset.vuePage;
var data = JSON.parse(dataset.vueProps);

// Get page script
var config = require(`^resources/js/pages/${page}.js`)(data);

// Vue instance
var _defaultConfig = {
    el: '#app'
};

const app = new Vue(Object.assign({}, _defaultConfig, config));