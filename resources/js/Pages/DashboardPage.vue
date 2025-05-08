<script setup>

import { Link, useForm, usePage} from '@inertiajs/vue3';
import { computed, onMounted, ref } from "vue";
import { useToast } from "vue-toastification";
import NavMenu from '../Components/NavMenu.vue';
const page = usePage();
// console.log(page.props.users);
// const flash = computed(() => usePage().props.flash);
const toast = useToast();

const items = ref(page.props.users);

console.log(items);

</script>

<template>
    <NavMenu/>
    <div class="container border border-primary border-1">
        <div class="row">
            
            <h1 class="text-info text-center">    Welcome- Admin</h1>
            <h2 class="text-warning">   Do your Admin thingy here</h2>
            <h3 class="text-success">   We are here to help</h3>
            <table class="border border-2"  >
               <tr class="border border-2 text-primary" >
                <th>Name</th>
                <th>Email</th>
                <th>Role</th>
            </tr>
            
            <tr class="border border-2" v-for="user in items">
                
                <td class="border border-2 text-primary" >
                    {{ user.name }}
                    
                </td>
                <td class="border border-2 text-warning" >
                    
                    {{ user.email }}
                </td>   
                <td class="border border-2 text-success" >
                        
                        {{ user.role }}</td>    
                    
                </tr>
                <tr class="border border-2">
                                    
                </tr>
                <tr class="border border-2">
                                  
                </tr>
                
            </table>


        </div>
</div>
</template>
