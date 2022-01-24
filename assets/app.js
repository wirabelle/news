/*
 * Welcome to your app's main JavaScript file!
 *
 * We recommend including the built version of this JavaScript file
 * (and its CSS file) in your base layout (base.html.twig).
 */

// any CSS you import will output into a single css file (app.css in this case)
import './styles/app.css';

// start the Stimulus application
import './bootstrap';

import Vue from 'vue';
import axios from 'axios'
import VueAxios from 'vue-axios'

import NewsIndex from './js/components/news/index'
import NewsShow from './js/components/news/show'

Vue.use(VueAxios, axios)

/**
* Create a fresh Vue Application instance
*/
new Vue({
  el: '#app',
  components: {NewsIndex, NewsShow}
});