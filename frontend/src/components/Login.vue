<script setup>
import { ref } from "vue";
import { useAuthStore } from "@/stores/auth";
import { useRouter } from "vue-router";

const router=useRouter()
const authStore = useAuthStore();
const formDataLogin={
    email:'',
    password:''
}

async function login(){
    authStore.login(formDataLogin,router); 
};
</script>

<template>
    <div class="container d-flex justify-content-center align-items-center vh-100">
        <div class="col-md-4">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h3 class="text-center">Login</h3>
                    <form>
                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input v-model="formDataLogin.email" type="email" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Password</label>
                            <input v-model="formDataLogin.password" type="password" class="form-control" required>
                        </div>
                        <button @click.prevent="login" type="submit" class="btn btn-primary w-100">Login</button>

                    </form>
                    <div class="text-center mt-3">
                        <p>Don't have account? <router-link to="/signup">Sign Up</router-link></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>