<template>
    <div>
        <div class="intro-y flex items-center h-10">
            <h2 class="text-lg font-medium truncate mr-5">Medical Laboratories in {{city}}</h2>  
        </div>
        <div class="intro-y" v-if="laboratories.length != 0">
            <div class="intro-y" v-for="laboratory in laboratories" :key="laboratory.id">
                <router-link :to="{name: 'frontend-facility', params:{slug: laboratory.slug}}">
                    <div class="box px-4 py-4 mb-3 flex items-center zoom-in">
                        <div class="w-10 h-10 flex-none image-fit rounded-md overflow-hidden"> 
                        <img  :src="'../../' + laboratory.logo"> </div>
                        <div class="ml-4 mr-auto">
                            <div class="font-medium">{{laboratory.registered_facility_name}}</div>
                            <div class="text-slate-500 text-xs mt-0.5">{{laboratory.physical_location }}<br>{{laboratory.local_government_area}}, {{laboratory.state}}</div>
                            <div class="text-slate-500 text-xs mt-0.5 font-semibold">{{laboratory.phone_number}}</div>
                            <div class="text-slate-500 text-xs mt-0.5" v-if="laboratory.website">{{laboratory.website}}</div>
                            <div class="text-slate-500 text-xs mt-0.5">Opens:{{laboratory.hours_of_operation}}</div>
                        </div>
                        
                    </div>
                </router-link>
            </div>
            <router-link :to="{name: 'frontend-laboratories'}" class="intro-y w-full block text-center rounded-md py-4 border border-dotted border-slate-400 dark:border-darkmode-300 text-slate-500">View More</router-link> 
        </div>
    </div>
</template>
<script>
export default {
    name: 'laboratory',
    data(){
        return {
            laboratories: [],
            city: ''
        }
    },
    created(){
        this.getLaboratories()
        this.getLocation()
    },
    methods: {
        getLaboratories(){
            axios.get('/api/laboratories', )
            .then(response => (this.laboratories = response.data))
            .catch()
        },
        getLocation(){
            axios.get('/api/location', )
            .then(response => (this.city = response.data))
            .catch()
        }
    }
}
</script>