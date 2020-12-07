const resource = 'brands'
import axios from 'axios';

export default {
    all() {
        return axios.get(`api/${resource}`)
    }
}
