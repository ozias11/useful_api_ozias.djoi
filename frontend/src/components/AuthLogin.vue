<script setup>
import { useAuthStore } from '@/stores/authstore';
import { reactive } from 'vue';

    const authStore =useAuthStore()
    const formdata = reactive({
        email:'',
        password:''
    })
    const connexion= async function(){
        if(formdata.password.trim()==''|| formdata.email.trim()==''){
            alert('all field are required')
        }else{
            document.querySelector('button').innerHTML='<i class="bi bi-arrow-repeat"></i>'
            await authStore.connexion({
                email:formdata.email,
                password:formdata.password
            })

            if(typeof localStorage.getItem('token')=='string'){
                alert('cest bon')
            }
            document.querySelector('button').innerHTML='Login'
        }
    }

</script>

<template>
    <form class="d-flex justify-content-center mt-3" @submit.prevent="connexion">
        <div  class="row col-md-3"> 
            <h4>Sign in</h4>
            <div>
                <div class="mb-3">
                    <label  class="form-label">Email address</label>
                    <input v-model="formdata.email" type="email" class="form-control"  required placeholder="name@example.com">
                </div>
        
                <div class="mb-3">
                    <label  class="form-label">Password</label>
                    <input v-model="formdata.password" type="password" class="form-control" required >
                </div>
                <div class="mb-3 ">
                    <button type="submit" class="chargement btn btn-primary">Login</button>
                    <p> you don't have account register here <a href="#">register</a></p>
                </div>
                
            </div>
        
       </div>
        
    </form>
</template>