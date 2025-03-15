import axios from "axios";
const api = axios.create({
  baseURL: "http://127.0.0.1:8000/api", // URL của Laravel API
});

export default api;

export const API_URL = "http://127.0.0.1:8000";

export const IMG_DEFAULT = `${API_URL}/storage/products/default.jpg`;
