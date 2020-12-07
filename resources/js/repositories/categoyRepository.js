const resource = 'categories'
import axios from 'axios';

export default {
    all() {
        return axios.get(`api/${resource}`)
    }
}
