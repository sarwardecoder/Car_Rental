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
                    class="login d-flex-row justify-content-center align-items-center"
                >
                    <div class="card" style="width: 18rem">
                        <div class="card-body">
                            <h5 class="card-title">Login Here</h5>
                            <h6 class="card-subtitle mb-2 text-body-secondary">
                                Card subtitle
                            </h6>

                            <form @submit.prevent="login">
                                <label for="email">Email:</label>
                                <input
                                    type="email"
                                    id="email"
                                    placeholder="Type your email"
                                />
                                <label for="password">Password:</label>
                                <input
                                    type="password"
                                    id="password"
                                    placeholder="Type your password"
                                />
                                <button class="btn btn-primary m-2">Login</button>
                            </form>
                            <button class="btn btn-dark m-1">
                                <a href="/user/create" class="card-link"
                                    >Don't have one? Create now</a
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
