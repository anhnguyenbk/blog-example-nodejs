import axios from 'axios';

const BASE_URL = process.env.VUE_APP_API_URL;

const sunnyApiClient = {
    async get(path) {
        const response = await fetch(`${BASE_URL}/${path}`)
        return await response.json()
    },

    async put(path, requestBody) {
        var res = await axios.put(`${BASE_URL}/${path}`, requestBody);
        return res;
    },

    async post(path, requestBody) {
        return await axios.post(`${BASE_URL}/${path}`, requestBody);
    },

    async delete(path) {
      var res = await axios.delete(`${BASE_URL}/${path}`)
      return res;
    }
}

export default sunnyApiClient