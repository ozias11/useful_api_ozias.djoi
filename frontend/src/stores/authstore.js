import axios from "axios";
import { defineStore } from "pinia";

export const useAuthStore = defineStore('authstore',{
    state :()=>({
        selectUser:[],
        url:'http://127.0.01:8000/api',
        alluser:[] ,
        token:null
    }),
    actions:{
        async connexion(credential){
           try {
                const repon= await axios.post(this.url+'/login',credential).catch(function (error){
                    if(error.response.status=='401'){
                        alert('worng credential')
                       localStorage.removeItem('token')
                    }
                });
                if(repon){
                    this.token=repon.data.token;
                    localStorage.setItem('token',this.token)
                   
                }
                
           }catch (error ) {
                console.log(error)
           }
            
           
        }
    }
})