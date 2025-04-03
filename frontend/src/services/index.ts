import axios from 'axios'
import Cookies from "js-cookie";

export const getAuthToken = () => {
  return Cookies.get("auth_token"); // Obtém o token salvo no cookie
};


const api = axios.create({
  baseURL: process.env.NEXT_PUBLIC_API_URL,
  headers: {
    'Accept': 'application/json',
    'Content-Type': 'application/json',
    'Authorization': `Bearer ${getAuthToken()}`,
  },
})

export default api
