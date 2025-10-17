<script setup>
import { useModuleStore } from '@/stores/moduleStore';
import { onMounted, /*reactive*/ } from 'vue';

    const moduelStore = useModuleStore()
    //  const formdata = reactive({
    //     email:'',
    //     password:''
    // })
    // const connexion= async function(){
    // }

    const activatemodule =async function(id){
        await moduelStore.activatemodule(id) 
    }
    const deactivatemodule =async function (id) {
        if(confirm('are you you want de deative this module')){
             await moduelStore.desactivatemodule(id) 
        }   
       
    }
    onMounted(async ()=>{
        await moduelStore.getAllmodule();
        await moduelStore.getActiveModule();
    })
</script>
<template>
    <main class="row " style="margin: 5px;">
        <div class="col-md-3" >
            <h4  class="d-flex justify-content-center " >All module </h4>
        
            <div v-for="moduleselected in moduelStore.allmodules" :key="moduleselected.id" class=" row d-flex mb-3">
                <h5 class="col-md-8">{{moduleselected.name}}</h5>
                <button @click="activatemodule(moduleselected.id)" class="btn btn-primary col-md-2"> activate </button>
            </div>
        </div>
        <div class="col-md-6">
            <!--
            <form class="d-flex justify-content-center mt-3" @submit.prevent="connexion">
                <div  class=""> 
                    <h4 class="mb-3">Using module</h4>
                    <div>
                        <div class="mb-3">
                            <label  class="form-label">Email address</label>
                            <input v-model="formdata.email" type="email" class="form-control"  required placeholder="name@example.com">
                        </div>
                
                        <div class="mb-3">
                            <label  class="form-label">Password</label>
                            <input v-model="formdata.password" type="password" class="form-control" required >
                        </div>
                        <div class="">
                            <button type="submit" class="mb-3 btn btn-primary">Login</button>
                            <p> you don't have account register here <router-link to="/register">register</router-link></p>
                        </div>
                        
                    </div>
                
                </div>
            </form>
            -->
        </div>
        <div class="d-flex  justify-content-end row col-md-3">
            <div >
                <h2> Module activated</h2>
                <div v-for="moduleacti in moduelStore.moduleactivate" :key="moduleacti.id" class="row d-flex mb-3">
                    <h5 class="col-md-7">{{moduleacti.name}}</h5>
                    <button @click="deactivatemodule(moduleacti.id)" class="btn btn-danger col-md-3"> deactivate </button>
                </div>
            </div>
        </div>
    </main>
    
</template>