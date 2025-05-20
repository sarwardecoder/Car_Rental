<script setup>
import { Link, router, usePage } from '@inertiajs/vue3';
import { ref } from "vue";
import { useToast } from "vue-toastification";
import LayOut from "../Components/LayOut.vue";
import NavMenu from '../Components/NavMenu.vue';
const page = usePage();
const toast = useToast();


const isAdmin = page.props.isAdmin;
const rentals = ref(page.props.rentals);


const user = page.props.user;

// const allRentals = ref(page.props.rentals);
const items = ref([...rentals.value]);

const selectedStatus = ref("");

const filterByStatus = () => {
    if (selectedStatus.value === "") {
        items.value = [...rentals.value];
    } else {
        items.value = rentals.value.filter(r => r.status === selectedStatus.value);
    }
};

//Serial counter
const slCount = 1;


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
const showRental = (rental) => {

    router.visit(`/showRental/${rental}`, {
        onSuccess: () => {
            toast.success("Showing the details of rental car.");
        },
        onError: () => {
            toast.error("Failed to redirect.");
        }
    });
};
// deleting a specific rental
function cancelRental(rentalId) {

    if (confirm('Are you sure you want to cancel this rental?')) {
        router.get(`/rentals/cancel?id=${rentalId}`, {
            preserveScroll: true,

            onSuccess: () => {
                toast.success('rental Cancelled successfully');
                router.reload(); // reloads current page and fetches fresh data

            },
            onError: () => {
                toast.error('Ops! Failed to cancel rental');
            },
        });
    }
}
const updateStatus = (rental) => {
  router.put(`/rentals/${rental}/update-status`, 
  { status: rental.status }, 
    {
      preserveScroll: true,
      onSuccess: () => {
        toast.success('Status updated successfully. from VUE');

      },
      onError: (errors) => {
        toast.error('Failed to update status.');
      }
    }
  );
};



</script>

<template>
    <NavMenu />

    <div class="container w-80 mt-3">
        <div class="row">
           
            <h2 class="text-warning text-center m-1">All your Rental history in one place</h2>

            <hr class="mt-1">
            <h2 class="text-warning text-center m-1"></h2>

            <hr>
           <table class="table border border-1">
  <thead>
    <tr class="text-primary">
      <th class="border rounded">SL</th>
      <th class="border rounded">Car Name</th>
      <th class="border rounded">Start Date</th>
      <th class="border rounded">End Date</th>
      <th class="border rounded">Total Cost ($)</th>
      <th class="border rounded">Booked by</th>
      <th class="border rounded">Status</th>
      <th class="border rounded">Action</th>
    </tr>
  </thead>
  <tbody>
        <tr v-for="(rental, index) in items" :key="rental.id">
        <td class="border rounded text-primary">{{ index + 1 }}</td>
        <td class="border rounded text-dark">{{ rental.car?.name || 'N/A' }}</td>
        <td class="border rounded text-dark">{{ rental.start_date }}</td>
        <td class="border rounded text-dark">{{ rental.end_date }}</td>
        <td class="border rounded text-dark">{{ rental.total_cost }}</td>
        <td class="border rounded text-dark">{{ rental.user?.name ?? 'N/A' }}</td>
        <td class="border rounded text-warning">
    <!-- Admin can click to change -->
  
  <template v-if="isAdmin">
    <select v-model="rental.status" @change="updateStatus(rental.id)">
      <option value="pending">Pending</option>
      <option value="confirmed">Confirmed</option>
      <option value="completed">Completed</option>
      <option value="cancelled">Cancelled</option>
    </select>
  </template>
  <!-- Non-admin just sees status text -->
  <template v-else>
    <span class="badge bg-secondary">{{ rental.status }}</span>
  </template>
</td>

   

      <td class="border rounded">
        <button @click="edit(rental.id)" class="btn btn-warning m-1">Edit</button>
        <button @click="cancelRental(rental.id)" v-if="rental.start_date" class="btn btn-danger m-1">Cancel</button>
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
