<script setup>
import { useModuleStore } from '@/stores/moduleStore';
import { useUrlStore } from '@/stores/urlshort';
import { onMounted, reactive, ref} from 'vue';
    const showform=ref(false)
    const title =ref('')
    const urlStore =useUrlStore()
    const moduelStore = useModuleStore()
     const formdata = reactive({
       url:'',
        code:''
     })
    const creaturl= async function(){
        if(formdata.url.trim()==''){
            alert('entrer une url')
        }else{
            document.querySelector('.chargement').innerHTML='<i class="bi bi-arrow-repeat"></i>'
                    document.querySelector('.chargement').setAttribute('disabled','')
                    await urlStore.CreacteShortlink({
                        original_url: formdata.url,
                        custom_code: formdata.code
                    })

                    
            document.querySelector('.chargement').removeAttribute('disabled')
            document.querySelector('.chargement').innerHTML='create'
            formdata.url=''
            formdata.code=''
            }
    }

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
        await urlStore.getAllUrl();
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
            
            <form v-if="showform" class="d-flex justify-content-center mt-3" @submit.prevent="creaturl">
                <div  class=""> 
                    <h4 class="mb-3">Using module {{ title }}<button> <i @click="showform=false; title='yes'" class="bi bi-x-circle "></i></button></h4>
                    <div>
                        <div class="mb-3">
                            <label  class="form-label">url</label>
                            <input v-model="formdata.url" type="text" class="form-control"  required placeholder="https://slas.com">
                        </div>
                
                        <div class="mb-3">
                            <label  class="form-label">Code</label>
                            <input v-model="formdata.code" type="text" class="form-control"  >
                        </div>
                       
                            <button type="submit" class="chargement mb-3 btn btn-primary">create</button>
                        
                        
                    </div>
                
                </div>
                
            </form>
            <div v-if="title=='URL Shortener'" class="d-flex justify-content-center mt-3">
                <div class="">
                    <h5>list of url</h5>
                        
                    <div v-for="urllin in urlStore.allUrlsCode" :key="urllin.id">
                        <h6>code: {{urllin.code}}</h6> 
                        <h6>cliks: {{urllin.clicks}}</h6> 
                        <h6>url: {{urllin.original_url}}</h6> 
                    </div>
                </div>
            </div>
                
        </div>
        <div class="d-flex  justify-content-end row col-md-3">
            <div >
                <h2> Module activated</h2>
                <div v-for="moduleacti in moduelStore.moduleactivate" :key="moduleacti.id" class="row d-flex mb-3">
                    <h5 class="col-md-5">{{moduleacti.name}}</h5>
                    <button @click="showform=true;title=moduleacti.name" style="margin-right: 2px;" class="btn btn-success col-md-3"> use it </button>
              
                    <button @click="deactivatemodule(moduleacti.id)" class="btn btn-danger col-md-3"> deactivate </button>
                </div>
            </div>
        </div>
    </main>
    
</template>