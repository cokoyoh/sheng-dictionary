window.Vue = require('vue');


import WordDefinition from '../components/WordDefinition'
import Words from '../components/Words'
import Dropdown from '../components/Dropdown'
import Paginator from '../components/Paginator'
import Search from '../components/Search'
import Empty from '../components/Empty'
import NavBar from '../components/NavBar'



Vue.component('word-definition', WordDefinition);
Vue.component('words', Words);
Vue.component('dropdown', Dropdown);
Vue.component('paginator', Paginator);
Vue.component('search', Search);
Vue.component('empty', Empty);
Vue.component('nav-bar', NavBar);



