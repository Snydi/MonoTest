import axios from "axios";

const ApiService = {
    baseURL: "http://127.0.0.1:8000/api",

    async makeRequest(route, method, data, component) {
        const url = `${this.baseURL}/${route}`;

        try {
            const response = await axios({ url, method, data });
            return { success: true, data: response.data };
        } catch (error) {
            return { success: false, error };
        }
    },

    handleSuccessMessage(message, component) {
        component.message = message;
        component.showApiSuccessMessage = true;
        setTimeout(() => {
            component.showApiSuccessMessage = false;
        }, 5000);
    },

    handleErrorMessage(error, component) {
        if (error.response) {
            const fields = Object.keys(error.response.data.errors);
            component.errors = fields.map((key) => error.response.data.errors[key]);
        } else {
            component.errors = ["Сетевая ошибка"];
        }

        component.showApiErrorMessage = true;
        setTimeout(() => {
            component.showApiErrorMessage = false;
            component.errors = [];
        }, 5000);
    },
};

export default ApiService;
