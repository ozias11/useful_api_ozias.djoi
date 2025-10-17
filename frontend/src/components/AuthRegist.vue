<script setup>
import { useAuthStore } from '@/stores/authstore';
import { reactive } from 'vue';
import { useRouter } from 'vue-router';

    const router =useRouter()
    const authStore =useAuthStore()
    const formdata = reactive({
        name:'',
        email:'',
        confpass:'',
        password:''
    })
    const register= async function(){
        if(formdata.name.trim()=='' || formdata.confpass.trim()==''|| formdata.password.trim()==''|| formdata.email.trim()==''){
            alert('all field are required')
        }else{
            if(formdata.confpass != formdata.password){
                alert("password doesn't match")
            }else{
                if(formdata.password.length<8){
                    alert("low password")
                }else{
                    document.querySelector('button').innerHTML='<i class="bi bi-arrow-repeat"></i>'
                    document.querySelector('button').setAttribute('disabled','')
                    await authStore.register({
                        email:formdata.email,
                        password:formdata.password,
                        name:formdata.name
                    })

                    if(typeof localStorage.getItem('state')=='string'){
                        router.push("/login")
                    }
                    document.querySelector('button').removeAttribute('disabled')
                    document.querySelector('button').innerHTML='register' 
                }
            }
           
        }
    }

</script>

<template>
    <form class="d-flex justify-content-center mt-3" @submit.prevent="register">
        <div  class="row col-md-3 "> 
            <h4 class="mb-3">Sign Up</h4>
            <div>
                <div class="mb-3">
                    <label  class="form-label">Name</label>
                    <input v-model="formdata.name" type="text" class="form-control"  required placeholder="">
                </div>

                <div class="mb-3">
                    <label  class="form-label">Email address</label>
                    <input v-model="formdata.email" type="email" class="form-control"  required placeholder="name@example.com">
                </div>
        
                <div class="mb-3">
                    <label  class="form-label">Password</label>
                    <input v-model="formdata.password" type="password" class="form-control" required >
                </div>
                 <div class="mb-3">
                    <label  class="form-label">Confirme password</label>
                    <input v-model="formdata.confpass" type="password" class="form-control" required >
                </div>
                <div >
                    <button type="submit" class="mb-3 btn btn-primary">Register</button>
                    <p> already have account? <router-link to="/login"> login</router-link></p>
                </div>
                
            </div>
        
       </div>
        
    </form>
</template>