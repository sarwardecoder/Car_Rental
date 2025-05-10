<script setup>
import { Offcanvas } from 'bootstrap';
import { onMounted, ref } from 'vue';

let bsOffcanvas = null;
const offcanvasRef = ref(null);


onMounted(() => {
  bsOffcanvas = new Offcanvas(offcanvasRef.value);
});

const showOffCanvas = () => {
  if (bsOffcanvas) {
    bsOffcanvas.show();
  }
}
</script>

<template>


  <!-- <img class="img-fluid rotate-90" src="/public/images/SideBarImage.png"/> -->

  <button v-on:mouseover="showOffCanvas" class="btn btn-primary" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasExample"
    aria-controls="offcanvasExample">
    <h1>Side Bar on the Left</h1>
  </button>

  <div ref="offcanvasRef" class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasExample" aria-labelledby="offcanvasExampleLabel">
    <div class="offcanvas-header">
      <h5 class="offcanvas-title" id="offcanvasExampleLabel">Offcanvas</h5>
      <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
      <div>
        essentials only
      </div>
      <div class="dropdown mt-3">
        <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown">
          Dropdown button
        </button>
        <ul class="dropdown-menu">
          <li><a class="dropdown-item" href="#">Action</a></li>
          <li><a class="dropdown-item" href="#">Another action</a></li>
          <li><a class="dropdown-item" href="#">Settings</a></li>
        </ul>
      </div>
    </div>
  </div>
</template>

<style scoped>
img {
height: 80px;
width: auto;
rotate:40px;
}
</style>