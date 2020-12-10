const resource = 'added-products'
import axios from 'axios';

axios.interceptors.response.use(
    res => res,
    err => {
        if (err.response.status === 401) {
            // refresh page if 401 unauthenticated
            location.reload();
        }
        throw err;
    }
);

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
