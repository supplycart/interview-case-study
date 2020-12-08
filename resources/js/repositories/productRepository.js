const resource = 'products'
import axios from 'axios';

export default {
    all(queryParam = '') {
        console.log('fetching products');
        return axios.get(`api/${resource}?${queryParam}`)
    }
}
