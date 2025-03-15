<template>
    <div>
        <!-- Navbar -->
        <nav class="navbar navbar-light bg-light px-3 rounded">
            <h1 v-if="customer" class="navbar-brand">Welcome, {{ customer.name }}</h1>
            <div>
                <button class="btn">
                <i class="fas fa-shopping-cart"></i></button>

            <button @click="logout()" class="btn">
                <i class="fa-solid fa-right-from-bracket"></i></button>
            </div>
        </nav>

        <!-- Search Bar -->
        <div class="mt-4 d-flex justify-content-center">
            <input type="text" class="form-control w-50" placeholder="Tìm kiếm sản phẩm..." />
        </div>

        <!-- Product List -->
        <div class="row mt-4">
            <div v-for="product in listProducts" :key="product.id" class="col-lg-3 col-md-4 col-sm-6 mb-4 d-flex">
                <div class="card w-100 shadow-sm border-0 product-card">
                    <img :src='product.image != "" ?
                        apiUrl + `/storage/` + product.image : imgDefault' class="card-img-top" :alt="product.name"
                        style="width: 100%; height: 200px; object-fit: contain; padding: 10px;" />
                    <div class="card-body text-center">
                        <h6 class="card-title text-truncate" style="max-width: 100%;">{{ product.name }}</h6>
                        <p class="card-text text-danger fw-bold mb-1">
                            ${{ (Math.floor(product.price - (product.price * (product.discount / 100)))) }} <span
                                class="text-muted text-decoration-line-through">${{
                                    product.price }}</span>
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script setup>
import { ref, computed, onMounted } from 'vue';
import axios from 'axios';
import api, { API_URL, IMG_DEFAULT } from '@/api';
import { useAuthStore } from "../stores/auth";
import { useRouter } from "vue-router";



const search = ref('');
const listProducts = ref([]);
const apiUrl = API_URL;
const imgDefault = IMG_DEFAULT;
const authStore = useAuthStore();
const router=useRouter();
var customer=null


const fetchProducts = async () => {
    try {
        const response = await api.get('product');
        listProducts.value = response.data;
    } catch (error) {
        console.error('Error fetching products:', error);
    }
};
function logout(){
    // this.customer=null
    authStore.logout(router)
    //router.push({ name: "login" });
}
onMounted(async () => {
    customer =await authStore.getCustomer();
  await fetchProducts(); // Gọi API lấy danh sách sản phẩm
});
</script>

<style>
.product-card {
    transition: transform 0.3s, box-shadow 0.3s;
}

.product-card:hover {
    transform: scale(1.05);
    box-shadow: 0px 10px 20px rgba(0, 0, 0, 0.2);
    cursor: pointer;
}
</style>