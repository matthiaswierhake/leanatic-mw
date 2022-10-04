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
import axios from "axios";

globalThis.__VUE_OPTIONS_API__ = true;
globalThis.__VUE_PROD_DEVTOOLS__ = false;

import { createApp } from 'vue'

const app = createApp({
  delimiters: ['[{', '}]'],

  data() {
      return {
        polling: null,
        items: [],
        color:"text-bg-success",

      }
  },
  methods: {
    getData(){
      axios.get("https://localhost/dashboardApi")
        .then(response => {
          this.items = [...response.data].slice(0, 10);
        })
    },
    pollData () {
      this.polling = setInterval(() => {
        this.getData();
      }, 500)
    }
  },

  beforeDestroy () {
    clearInterval(this.polling)
  },
  created () {
    this.pollData()
  },

  mounted() {
    this.getData();
  },

})

app.mount('#app')
