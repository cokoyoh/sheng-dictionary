window.Vue = require('vue');


import WordDefinition from '../components/WordDefinition'
import Words from '../components/Words'
import Dropdown from '../components/Dropdown'
import Paginator from '../components/Paginator'



Vue.component('word-definition', WordDefinition);
Vue.component('words', Words);
Vue.component('dropdown', Dropdown);
Vue.component('paginator', Paginator);



