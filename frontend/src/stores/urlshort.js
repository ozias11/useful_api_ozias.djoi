import axios from "axios";
import { defineStore } from "pinia";

export const useUrlStore = defineStore('urlStore',{
    state :()=>({
        allUrlsCode:[],
        url:'http://127.0.01:8000/api',
        moduleactivate:[] ,
        token:localStorage.getItem('token')

    }),
    actions:{
        async getAllUrl(){
           try {
                const repon= await axios.get(this.url+'/links',{
                    headers:{
                        'Authorization':`Bearer ${this.token}`
                    }
                }).catch(function (error){
                    if(error.response.status=='401'){
                        alert('Please login before')
                      
                    }
                });
                if(repon){
                    this.allUrlsCode=repon.data;
                   
                   
                }
                
           }catch (error ) {
                console.log(error)
           }
            
           
        },
        async CreacteShortlink(data){
           try {
                const repon= await axios.post(this.url+'/shorten',data,{
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

            this.getAllUrl()
           
        },
        


    }
})