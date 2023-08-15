<template>
    <div>
        <div class="intro-y flex items-center h-10">
            <h2 class="text-lg font-medium truncate mr-5">Pharmacies in {{city}}</h2>  </div>
        <div class="intro-y" v-if="pharmacies.length != 0">
            <div class="intro-y" v-for="pharmacy in pharmacies" :key="pharmacy.id">
                <router-link :to="{name: 'frontend-facility', params:{slug: pharmacy.slug}}">
                    <div class="box px-4 py-4 mb-3 flex items-center zoom-in">
                        <div class="w-10 h-10 flex-none image-fit rounded-md overflow-hidden"> 
                        <img  :src="'../../' + pharmacy.logo"> </div>
                        <div class="ml-4 mr-auto">
                            <div class="font-medium">{{pharmacy.registered_facility_name}}</div>
                            <div class="text-slate-500 text-xs mt-0.5">{{pharmacy.physical_location }}<br>{{pharmacy.local_government_area}}, {{pharmacy.state}}</div>
                            <div class="text-slate-500 text-xs mt-0.5 font-semibold">{{pharmacy.phone_number}}</div>
                            <div class="text-slate-500 text-xs mt-0.5" v-if="pharmacy.website">{{pharmacy.website}}</div>
                            <div class="text-slate-500 text-xs mt-0.5">Opens:{{pharmacy.hours_of_operation}}</div>
                        </div>
                        
                    </div>
                </router-link>
            </div>
            <router-link :to="{name: 'frontend-pharmacies'}" class="intro-y w-full block text-center rounded-md py-4 border border-dotted border-slate-400 dark:border-darkmode-300 text-slate-500">View More</router-link> 
        </div>
    </div>
</template>
<script>
export default {
    name: 'pharmacy',
    data(){
        return {
            pharmacies: [],
            city: ''
        }
    },
    created(){
        this.getPharmacies()
        this.getLocation()
    },
    methods: {
        getPharmacies(){
            axios.get('/api/pharmacies', )
            .then(response => (this.pharmacies = response.data))
            .catch()
        },
        getLocation(){
            axios.get('/api/location', )
            .then(response => (this.city = response.data))
            .catch()
        },
    }
}
</script>