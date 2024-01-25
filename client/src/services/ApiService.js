import axios from "axios";

const ApiService = {
    init() {
        axios.defaults.baseURL = 'http://127.0.0.1:8000/api';
        const apiToken = localStorage.getItem('apiToken');

        if (apiToken) {
            axios.defaults.headers.common['Authorization'] = `Bearer ${apiToken}`;
        }
    },
    async makeRequest(route, method, data, component) {
        const url = `${axios.defaults.baseURL}/${route}`;

        try {
            const response = await axios({ url, method, data });
            return { success: true, data: response.data };
        } catch (error) {
            return { success: false, error };
        }
    },

    setAuthToken(token) {
        if (token) {
            axios.defaults.headers.common['Authorization'] = `Bearer ${token}`;
            localStorage.setItem('apiToken', token);
        } else {
            delete axios.defaults.headers.common['Authorization'];
            localStorage.removeItem('apiToken');
        }
    },

    isAuthenticated() {
        return !!localStorage.getItem('apiToken');
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
