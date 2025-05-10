<script setup>

import { router } from '@inertiajs/vue3';
import { Link, useForm, usePage} from '@inertiajs/vue3';
import { computed, handleError, onMounted, ref } from "vue";
import { useToast } from "vue-toastification";
import LayOut from '../Components/LayOut.vue';
const page = usePage();
// console.log(page.props.users);
// const flash = computed(() => usePage().props.flash);
const toast = useToast();
// edit(alert('edit clicked'));

// alert('update clicked');

const items = ref(page.props.users);

const edit=()=>{
    page.put(`'/user/edit/${email}'`,{
        onSuccess: () => {
            flash.value.success && toast.success(flash.value.success);
            flash.value.error && toast.error(flash.value.error);
        },
    }

    )
}

</script>

<template>
    <LayOut/>
    <div class="container border border-primary border-1">
        <div class="row">
            
            <h1 class="text-info text-center">    Welcome- Admin</h1>
            <h2 class="text-warning">   Do your Admin thingy here</h2>
            <h3 class="text-success">   We are here to help</h3>
            <table class="table border border-2"  >
               <tr class="border border-2 text-primary" >
                <th class="border border-2 " >Name</th>
                <th class="border border-2 ">Email</th>
                <th class="border border-2 ">Role</th>
                <th class="border border-2 ">Action</th>
            </tr>
            
            <tr class="border border-2" v-for="user in items">
                
                <td class="border border-2 text-primary" >
                    {{ user.name }}
                    
                </td>
                <td class="border border-2 text-warning" >
                    
                    {{ user.email }}
                </td>   
                <td class="border border-2 text-success" >
                        
                        {{ user.role }}
                    </td>    
                <td class="border border-2 text-success w-25 w-fixed" >
                        
                        
                    <Link href="/user/edit/${email}"><button  class="btn btn-warning w-25 w-fixed p-2 m-1">Edit</button></Link>
                    <button @click="deleteUser" class="btn btn-danger w-25 w-fixed p-2 m-1">Delete</button>
                    </td>    
                    
                </tr>
              
               
                
            </table>


        </div>
</div>
</template>
