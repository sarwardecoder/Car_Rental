<script setup>
import { router, usePage } from '@inertiajs/vue3';
import { ref } from "vue";
import { useToast } from "vue-toastification";
import LayOut from '../Pages/Components/LayOut.vue';

const page = usePage();
const toast = useToast();

const items = ref(page.props.users);

// Function to handle editing a specific user
const edit = (userId) => {
    router.visit(`/user/edit/${userId}`, {
        onSuccess: () => {
            toast.success("Redirected to edit page.");
        },
        onError: () => {
            toast.error("Failed to redirect.");
        }
    });


};

// deleting a specific user
const deleteUser = (userId) => {
    router.delete(`/user/delete/${userId}`, {
        preserveScroll: true,
        onSuccess: () => {
            toast.success("User deleted successfully.");
            router.reload(); // reloads current page and fetches fresh data
        },
        onError: () => {
            toast.error("Failed to delete user.");
        }
    });
};
</script>

<template>
    <LayOut />
    <div class="container border border-primary border-1 mt-3">
        <div class="row">
            <h1 class="text-secondary text-center">Welcome to your USER Dashboard- <span class="text-primary">{{
                $page.props.auth.user.name }}</span> </h1>
            <h2 class="text-warning text-center m-1">Check all the Rental history here, </h2>
            <h3 class="text-danger text-center mb-3">you can edit almost every details</h3>

            <table class="table border border-2">
                <thead>
                    <tr class="text-primary">
                        <th class="border">Name</th>
                        <th class="border">Email</th>
                        <th class="border">Role</th>
                        <th class="border">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="user in items" :key="user.id">
                        <td class="border text-primary">{{ user.name }}</td>
                        <td class="border text-warning">{{ user.email }}</td>
                        <td class="border text-success">{{ user.role }}</td>
                        <td class="border">
                            <button @click="edit(user.id)" class="btn btn-warning m-1">Edit</button>
                            <button @click="deleteUser(user.id)" class="btn btn-danger m-1">Delete</button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>
