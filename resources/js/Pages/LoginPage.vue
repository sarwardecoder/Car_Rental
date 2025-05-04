<script setup>
import { Link, useForm, usePage } from "@inertiajs/inertia-vue3";
import { computed } from "vue";
import { useToast } from "vue-toastification";
const flash = computed(() => usePage().props.flash);
const toast = useToast();

const form = useForm({
    email: "",
    password: "",
});

const login = () => {
    form.post("/login", {
        onSuccess: () => {
            flash.value.success && toast.success(flash.value.success);
            flash.value.error && toast.error(flash.value.error);
        },
    });
};
</script>

<template>
    <!-- <h1>User logged in from Login Pg vue</h1> -->

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div
                    class="login d-flex-row justify-content-center"
                >
                    <div class="card -center border border-info border-2 mt-3" style="width: 20rem">
                        <div class="card-body">
                            <h5 class="card-title text-center">Login Here</h5>
                            

                            <form @submit.prevent="login">
                                <label class="m-1" for="email">Email:</label>
                                <input
                                class="mb-2"
                                    type="email"
                                    id="email"
                                    placeholder="Type your email"
                                />
                                <label class="m-1"  for="password">Password:</label>
                                <input
                                class="mb-3" 
                                    type="password"
                                    id="password"
                                    placeholder="Type your password"
                                />
                                <button class="btn btn-primary m-2 pt-2">Login</button>
                            </form>
                            <button class="btn btn-dark m-1">
                                <a href="/user/create" class="card-link"
                                    >Not a User? Create now</a
                                >
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<style scoped></style>
