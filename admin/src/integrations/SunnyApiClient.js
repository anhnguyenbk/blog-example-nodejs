const BASE_URL = process.env.VUE_APP_API_URL;

const sunnyApiClient = {
    async get(path) {
        const response = await fetch(`${BASE_URL}/${path}`)
        return await response.json()
    }
}

export default sunnyApiClient