<script setup>
import { Link, router, usePage } from '@inertiajs/vue3';
import { ref } from "vue";
import { useToast } from "vue-toastification";
import LayOut from "../Components/LayOut.vue";
const page = usePage();
const toast = useToast();

const items = ref(page.props.cars);

// Function to handle New car
const create = () => {
    router.get(`/cars/create`, {
        onSuccess: () => {
            toast.success("Redirected to New Cars page.");
        },
        onError: () => {
            toast.error("Failed to redirect.");
        }
    });
};

// Function to handle editing a specific car
const edit = (carId) => {
    router.visit(`/car/edit/${carId}`, {
        onSuccess: () => {
            toast.success("Redirected to edit page.");
        },
        onError: () => {
            toast.error("Failed to redirect.");
        }
    });
};

// deleting a specific car
const deleteCar = (carId) => {
    router.delete(`/car/delete/${carId}`, {
        preserveScroll: true,
        onSuccess: () => {
            toast.success("Car deleted successfully.");
            router.reload(); // reloads current page and fetches fresh data
        },
        onError: () => {
            toast.error("Failed to delete Car.");
        }
    });
};
</script>

<template>
    <LayOut />
    <div class="container w-75 mt-3">
        <div class="row">
            <h1 class="text-secondary text-center">Welcome to Cars Dashboard- <span class="text-primary">{{
                $page.props.auth.user.name }}</span> </h1>
            <h2 class="text-warning text-center m-1">Create new cars, or update here, </h2>

            <hr class="mt-1">
            <h2 class="text-warning text-center m-1"></h2>
            <!-- Replace this -->
            <!-- <Link onclick="create"> <button class="btn btn-primary m-3 p-2 fs-4 rounded">+ Add a new car </button> </Link> -->

            <!-- With this -->
            <button @click="create" class="btn btn-primary mb-3 p-2 fs-4 rounded">+ Add a new car</button>
            <hr>
            <table class="table border border-2">
                <thead>
                    <tr class="text-primary">
                        <th class="border">Name</th>
                        <th class="border">Brand</th>
                        <th class="border">Model</th>
                        <th class="border">Year</th>
                        <th class="border">Image</th>
                        <th class="border">Car Type</th>
                        <th class="border">Daily Rent Price</th>
                        <th class="border">Availability</th>
                        <th class="border">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="car in items" :key="car.id">
                        <td class="border text-primary">{{ car.name }}</td>
                        <td class="border text-warning">{{ car.brand }}</td>
                        <td class="border text-warning">{{ car.year }}</td>
                        <td class="border text-warning">
                            <img :src="car.image" alt="Car Image" width="100" />
                        </td>
                        <td class="border text-warning">{{ car.CarType }}</td>
                        <td class="border text-warning">{{ car.DailyRentPrice }}</td>
                        <td class="border text-warning">{{ car.Availability }}</td>
                        <td class="border text-warning">{{ car.email }}</td>
                        <td class="border">
                            <button @click="edit(car.id)" class="btn btn-warning m-1">Edit</button>
                            <button @click="deleteCar(car.id)" class="btn btn-danger m-1">
                                Delete
                            </button>

                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>

<style scoped></style>
