<script setup>
import { Link, router, usePage } from '@inertiajs/vue3';
import { ref } from "vue";
import { useToast } from "vue-toastification";
import LayOut from "../Components/LayOut.vue";
const page = usePage();
const toast = useToast();
//Serial counter
const slCount = 1;

const items = ref(page.props.rentals);


// Function to handle New rental
const create = () => {
    router.get(`/rentals/create`, {
        onSuccess: () => {
            toast.success("Redirected to New rentals page.");
            router.reload(); // reloads current page and fetches fresh data
        },
        onError: () => {
            toast.error("Failed to redirect.");
        }
    });
};

// Function to handle edit a specific rental

const edit = (rental) => {

    router.visit(`/rentals/${rental}/edit`, {
        onSuccess: () => {
            toast.success("Redirected to edit page.");
        },
        onError: () => {
            toast.error("Failed to redirect.");
        }
    });
};

//show 1 rental
const showrental=(rental)=> {

  router.visit(`/showrental/${rental}`,{
        onSuccess: () => {
            toast.success("Showing favorite rentalS.");
        },
        onError: () => {
            toast.error("Failed to redirect.");
        }
    });
};
// deleting a specific rental
function deleteRental(rentalId) {

    if (confirm('Are you sure you want to delete this rental?')) {
        router.get(`/rentals/delete?id=${rentalId}`, {
            preserveScroll: true,

            onSuccess: () => {
                toast.success('rental deleted successfully');
                router.reload(); // reloads current page and fetches fresh data

            },
            onError: () => {
                toast.error('Ops! Failed to delete rental');
            },
        });
    }
}


</script>

<template>
    <LayOut />
    <div class="container w-80 mt-3">
        <div class="row">
            <h1 class="text-secondary text-center">Welcome to rentals Dashboard- <span class="text-primary">{{
                $page.props.auth.user.name }}</span> </h1>
            <h2 class="text-warning text-center m-1">Create new rentals, or update here, </h2>

            <hr class="mt-1">
            <h2 class="text-warning text-center m-1"></h2>

            <button @click="create" class="btn btn-primary mb-3 p-2 fs-4 rounded">+ Add a new rental</button>
            <hr>
            <table class="table border border-1">
                <thead>
                    <tr class="text-primary">
                        <th class="border rounded">Sl</th>
                        <th class="border rounded">Name</th>
                        <th class="border rounded">Brand</th>
                        <th class="border rounded">Model</th>
                        <th class="border rounded">Year</th>
                        <th class="border rounded">Image</th>
                        <th class="border rounded">rental Type</th>
                        <th class="border rounded">Daily Rent Price</th>
                        <th class="border rounded">Availability</th>
                        <th class="border rounded">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="rental in items" :key="rental.id">
                        <td class="border rounded text-primary">{{ slCount++ }}</td>
                        <td class="border rounded text-primary">{{ rental.name }}</td>
                        <td class="border rounded text-dark">{{ rental.brand }}</td>
                        <td class="border rounded text-dark">{{ rental.model }}</td>
                        <td class="border rounded text-dark">{{ rental.year }}</td>


                        <!-- <td class="border rounded text-dark d-flex justify-content-center">
                            <img :src="'storage/' + rental.image" alt="rental Image" width="100" class="rounded" />
                        </td> -->
                        <td class="border rounded text-dark d-flex justify-content-center">
                            <!-- <img :src="'storage/' + rental.image" alt="rental Image" width="100" class="rounded" /> -->

                            <button @click="showRental(rental.id)" class="btn p-0 border-0 bg-transparent">
                                <img :src="'storage/' + rental.image" alt="Show Rental" class="img-fluid rounded"
                                    style="width: 120px; " 
                                />

                            </button>
                        </td>


                        <td class="border rounded text-warning">{{ rental.rental_type }}</td>
                        <td class="border rounded text-warning">{{ rental.daily_rent_price }}</td>
                        <td class="border rounded text-warning">{{ rental.availability == 1 ? "Yes" : "No" }}</td>
                        <td class="border rounded">
                            <button @click="edit(rental.id)" class="btn btn-warning m-1">Edit</button>
                            <button @click="deleteRental(rental.id)" class="btn btn-danger m-1">
                                Delete
                            </button>

                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>

<style scoped>
.btn:hover {
    transform: scale(1.02) rotate(3deg);
    transition: transform 0.3s ease-in-out;
    cursor: pointer;
}
</style>
