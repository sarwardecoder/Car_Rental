<script setup>
import NavMenu from '../Components/NavMenu.vue';
const props = defineProps({
  flash: Object
});
</script>

<template>
    
    <div class="container border border-primary border-1">
        <div class="row">
            
            
            
            <div class="position-relative">
                <NavMenu/>
                <img src="/public/images/hero-banner.png" alt="SwiftRide Hero" class="img-fluid w-100" />
    <!-- <div class="position-absolute top-50 start-50 translate-middle text-white text-center bg-dark bg-opacity-50 p-4 rounded">
        <h2 class="display-4 text-warning">Your Journey, Our Wheels</h2>
      <p class="lead">Classic Rides, Trusted Journeys</p>
    </div> -->
  </div>


    </div>
    </div>
    
</template>

<style scoped>
</style>