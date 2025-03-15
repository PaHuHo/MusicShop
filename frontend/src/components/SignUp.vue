<script setup>
</script>

<template>
 <div class="container d-flex justify-content-center align-items-center vh-100">
        <div class="col-md-4">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h3 class="text-center">Sign Up</h3>
                    <form>
                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" class="form-control" required>
                        </div>
                        <button type="submit" class="btn btn-primary w-100">Next</button>
                    </form>
                    <div class="text-center mt-3">
                        <p>Have account? <router-link to="/login">Login</router-link></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>