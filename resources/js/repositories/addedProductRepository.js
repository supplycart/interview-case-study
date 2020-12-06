const resource = 'added-products'
import axios from 'axios';

export default {
    all(ordered = false) {
        return axios.get(`api/${resource}?ordered=${ordered}`)
    },
    store(payload) {
        return axios.post(`api/${resource}`, payload)
    },
    update(payload) {
        return axios.patch(`api/${resource}/${payload.id}`, payload)
    },
    delete(productId) {
        return axios.delete(`api/${resource}/${productId}`)
    },
}
