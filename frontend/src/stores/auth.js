import { ref } from "vue";
import { defineStore } from "pinia";
import api,{API_URL} from "../api";
import { useToast } from "vue-toastification";
import axios from "axios";
import { useRouter } from "vue-router";

const toast = useToast();
const apiUrl = API_URL;

export const useAuthStore = defineStore("auth", {
  

  actions: {
    async login(credentials, router) {
      try {
        const response = await api.post("/login", credentials);
        const token = response.data.token;

        if (token) {
          localStorage.setItem("token", token);

          axios.defaults.headers.common["Authorization"] = `Bearer ${token}`;
           // Xoá dữ liệu cũ trước khi cập nhật mới
          //await this.getCustomer();
          toast.success("Login Success", {
            timeout: 600,
          });
          router.push("/");
        }
      } catch (error) {
        //console.error("Login failed", error);
        toast.error(error, {
          timeout: 5000,
        });
      }
    },

    // async register(customerData) {
    //   try {
    //     const response = await api.post("/register", customerData);
    //     this.token = response.data.token;
    //     localStorage.setItem("token", this.token);
    //     await this.getCustomer();
    //   } catch (error) {
    //     console.error("Registration failed", error);
    //   }
    // },

     async getCustomer () {
      try {
        const token = await localStorage.getItem("token");
        console.log("Token hiện tại:", token); // Lấy token từ localStorage
        if (!token) {
          console.log("Không có token, chưa đăng nhập.");
          return null;
        }
    
        const response = await axios.get(apiUrl+"/api/me", {
          headers: { Authorization: `Bearer ${token}` }, // Đảm bảo gửi token đúng
        });
        // this.customer = response.data; // Cập nhật state customer
        console.log(response.data)
        return response.data;
      } catch (error) {
        console.error("Lỗi khi lấy thông tin khách hàng:", error.response);
        return null;
      }
    },

    async logout(router) {
      try {
        const token = await localStorage.getItem("token"); // Lấy token từ localStorage
        if (!token) {
          console.log("Không có token, chưa đăng nhập.");
          return null;
        }
        await axios.post(apiUrl+"/api/logout", {}, {
          headers: { Authorization: `Bearer ${token}` },
        });
        this.$reset(); // Reset toàn bộ state trong Pinia
        localStorage.removeItem("token");
        delete axios.defaults.headers.common["Authorization"];
        toast.success("Logout Success", {
          timeout: 600,
        });
        router.push("/login");
        setTimeout(() => {
          window.location.reload();
        }, 500);
      } catch (error) {
        console.log("Logout failed");

        toast.error("Logout error", {
          timeout: 600,
        });
      }
    },
  },
});