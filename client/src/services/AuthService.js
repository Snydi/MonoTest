import axios from "axios";

export const authClient = axios.create({
    baseURL: "http://127.0.0.1:8000/", //TODO поменять на env значение
    withCredentials: true,
});
export default {
    async registerUser(payload) {
        await authClient.get("/sanctum/csrf-cookie");
        return authClient.post("/api/register", payload);
    },
    async login(payload) {
        await authClient.get("/sanctum/csrf-cookie");
        return authClient.post("/api/login", payload );
    },
    logout() {
        return authClient.post("/logout");
    },

}