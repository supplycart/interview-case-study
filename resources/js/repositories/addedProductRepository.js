const resource = 'products'
import axios from 'axios';

export default {
    all() {
        return axios.get(`api/${resource}`)
    },
    store(payload) {
        return axios.post(`api/${resource}`, payload)
    },
    update(payload) {
        return axios.patch(`api/${resource}`, payload)
    }
}
