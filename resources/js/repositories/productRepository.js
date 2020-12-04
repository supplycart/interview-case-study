const resource = 'products'
import axios from 'axios';

export default {
    all(search = '') {
        return axios.get(`api/${resource}?q=${search}`)
    }
}
