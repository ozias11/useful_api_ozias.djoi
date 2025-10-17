import axios from "axios";
import { defineStore } from "pinia";

export const useModuleStore = defineStore('moduleStore',{
    state :()=>({
        allmodules:[],
        url:'http://127.0.01:8000/api',
        moduleactivate:[] ,
        token:localStorage.getItem('token')

    }),
    actions:{
        async getAllmodule(){
           try {
                const repon= await axios.get(this.url+'/modules/all',{
                    headers:{
                        'Authorization':`Bearer ${this.token}`
                    }
                }).catch(function (error){
                    if(error.response.status=='401'){
                        alert('Please login before')
                      
                    }
                });
                if(repon){
                    this.allmodules=repon.data;
                   
                   
                }
                
           }catch (error ) {
                console.log(error)
           }
            
           
        },
        async getActiveModule(){
           try {
                const repon= await axios.get(this.url+'/modules',{
                    headers:{
                        'Authorization':`Bearer ${this.token}`
                    }
                }).catch(function (error){
                    if(error.response.status=='401'){
                        alert('please log before')
                      
                    }
                });
                if(repon){
                 this.moduleactivate=repon.data
                }
                
           }catch (error ) {
                console.log(error)
           }

            
           
        },
        async activatemodule(id) {
            try {
                const repon= await axios.post(this.url+`/modules/${id}/activate`,null,{
                    headers:{
                        'Authorization':`Bearer ${this.token}`
                    }
                }).catch(function (error){
                    if(error.response.status=='401'){
                        alert('please log before')
                      
                    }
                });
                if(repon){
                 this.moduleactivate=repon.data
                }
                 this.getActiveModule()
                
           }catch (error ) {
                console.log(error)
           } 
        },
        async desactivatemodule(id) {
            try {
                const repon= await axios.post(this.url+`/modules/${id}/deactivate`,null,{
                    headers:{
                        'Authorization':`Bearer ${this.token}`
                    }
                }).catch(function (error){
                    if(error.response.status=='401'){
                        alert('please log before')
                      
                    }
                });
                if(repon){
                 this.moduleactivate=repon.data
                }
                 this.getActiveModule()
                
           }catch (error ) {
                console.log(error)
           } 
        }


    }
})