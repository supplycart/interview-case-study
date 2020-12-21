import Vue from 'vue'
import Card from './Card'
import Button from './Button'
import Child from './Child'
import Checkbox from './Checkbox'
import Pagination from './Pagination'
import Navbar from './Navbar'
import {HasError, AlertError, AlertSuccess} from 'vform'

// Components that are registered globaly.
[
    Card,
    Button,
    Child,
    HasError,
    AlertError,
    Checkbox,
    Pagination,
    AlertSuccess
].forEach(Component => {
    Vue.component(Component.name, Component)
})

