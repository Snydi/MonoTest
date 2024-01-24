import axios from "axios";

export const authClient = axios.create({
    baseURL: "127.0.0.1:8000/api/", //TODO поменять на env значение
    withCredentials: true,
});
export default {
    async registerUser(payload) {
        await authClient.get("/sanctum/csrf-cookie");
        return authClient.post("/register", payload);
    },
    async login(payload) {
        await authClient.get("/sanctum/csrf-cookie");
        return authClient.post("/login", payload);
    },
    logout() {
        return authClient.post("/logout");
    },

}