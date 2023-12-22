import config from "../config.js";

class HTTP{
    #endpoint;
    #body = {};
    #customHeaders = {};

    async post(endpoint, body = {}, customHeaders={}){
        this.#endpoint = endpoint;
        body.fetchApi = true;
        this.#body = body;
        this.#customHeaders = customHeaders;
        return await this.#fetchData('POST');
    }
    
    async get(endpoint, customHeaders={}){
        this.#endpoint = endpoint;
        this.#customHeaders = customHeaders;
        return await this.#fetchData('POST');
    }
    
    async #fetchData(method = 'GET'){
        const configRequest = {method}
        const headers = {...this.#customHeaders};
        const formData = new FormData();
        configRequest.headers = headers;

        if(Object.keys(this.#body).length > 0){
            for(const i in this.#body){
                if(i){
                    formData.append(i, this.#body[i])
                }
            }
            configRequest.body = formData;
        }
        const fetching = await fetch(`${config[0].URL_BASE}${this.#endpoint}`, configRequest) 
        const response = await fetching.json();
        return response;
    }
}

export const http = new HTTP;