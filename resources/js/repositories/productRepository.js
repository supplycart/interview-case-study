const resource = 'products'
import axios from 'axios';

export default {
    all(queryParam = '') {
        return axios.get(`api/${resource}?${queryParam}`)
    }
}
