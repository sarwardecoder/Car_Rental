<script setup>

import { ref } from 'vue'
import { router } from '@inertiajs/vue3'
import axios from 'axios'


const props = defineProps({
  car: Object,
  carId: Number
});

const startDate = ref('')
const endDate = ref('')
const available = ref(null)
const totalCost = ref(null)

const checkAvailability = async () => {
  if (startDate.value && endDate.value) {
    const res = await axios.post('/check-availability', {
      car_id: props.carId,
      start_date: startDate.value,
      end_date: endDate.value
    })
    available.value = res.data.available
    totalCost.value = res.data.total_cost
  }
}

const rentCar = () => {
  router.post(`'/cars/${car}/book'`, {
    car_id: props.carId,
    start_date: startDate.value,
    end_date: endDate.value
  })
}
</script>

<template>
  <div class="container-fluid vh-100">
    <div class="row h-100">
      <!-- Left Side: Image -->
      <div class="col-md-6 d-flex align-items-center justify-content-center bg-light">
        <img :src="'http://127.0.0.1:8000/storage/' + car.image" alt="Car Image" class="img-fluid rounded shadow" />
        <!-- <div v-else class="text-muted">No image available</div> -->
      </div>
      <!-- Right Side: Car Details -->
      <div class="col-md-6 d-flex-reverse align-items-center justify-content-center bg-light">
        <h2 class="mb-4">{{ car.name }}</h2>
        <ul class="list-group">
          <li class="list-group-item">
            <strong>Brand:</strong> {{ car.brand }}
          </li>
          <li class="list-group-item">
            <strong>Model:</strong> {{ car.model }}
          </li>
          <li class="list-group-item">
            <strong>Year:</strong> {{ car.year }}
          </li>
          <li class="list-group-item">
            <strong>Car Type:</strong> {{ car.car_type }}
          </li>
          <li class="list-group-item">
            <strong>Daily Rent:</strong> ${{ car.daily_rent_price }}
          </li>
          <li class="list-group-item">
            <strong>Available:</strong> {{ car.availability ? 'Yes' : 'No' }}
          </li>
          <li class="list-group-item">
            <div>
              <label for="Start_Date">Start Date</label>
              <input id="Start_Date" type="date" v-model="startDate" @change="checkAvailability" />
              <label for="End_Date">End Date</label>
              <input id="End_Date" type="date" v-model="endDate" @change="checkAvailability" />

              <div v-if="available === false" class="text-danger">Car unavailable for these dates.</div>
              <div v-if="available && totalCost" class="text-success">Total: ${{ totalCost }}</div>

              <button @click="rentCar" :disabled="available" class="btn btn-primary text-white px-4 py-2 ms-1 rounded">
                Book Now
              </button>
            </div>
          </li>

        </ul>
      </div>
    </div>

  </div>
</template>


<style scoped>
.card {
  position: absolute !important;
  top: 15%;
  left: 40%;
}

.card form label {
  padding: 2px 2px;
  display: flex;
}

.card form input {
  display: flex;
  border: 1px solid rgb(8, 42, 43);
  border-radius: 8px;
  padding: 5px 8px;
  width: 100%;
}

div h2 {
  text-transform: capitalize;
  margin: 20% 1%;
  padding: 5px 5px;
}
input{
  margin: 2px;
}
label{
  margin: 2px;
  font-weight: bold;
}
</style>