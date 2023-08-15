<template>
    <div>
        <div class="2xl:border-l -mb-10 pb-10">
            <div class="2xl:pl-6 grid grid-cols-12 gap-x-6 xl:gap-x-0 gap-y-6">
            
                <!-- BEGIN: Private Private -->
                <div class="col-span-12 xl:col-span-12 mt-6" v-if="private_hospitals.length != 0">
                    <div class="intro-x flex items-center h-10">
                        <h2 class="text-lg font-medium truncate mr-5">Private Hospitals in {{city}}</h2> 
                    </div>
                    
                    <div class="" v-if="private_hospitals.length != 0">
                        <div class="intro-x" v-for="hospital in private_hospitals" :key="hospital.id">
                            <router-link :to="{name: 'frontend-facility', params:{slug: hospital.slug}}">
                                <div class="box px-4 py-4 mb-3 flex items-center zoom-in">
                                    <div class="w-10 h-10 flex-none image-fit rounded-md overflow-hidden"> 
                                    <img  :src="'../../' + hospital.logo"> </div>
                                    <div class="ml-4 mr-auto">
                                        <div class="font-medium">{{hospital.registered_facility_name}}</div>
                                        <div class="text-slate-500 text-xs mt-0.5">{{hospital.physical_location }}<br>{{hospital.local_government_area}}, {{hospital.state}}</div>
                                        <div class="text-slate-500 text-xs mt-0.5">{{hospital.phone_number}}</div>
                                        <div class="text-slate-500 text-xs mt-0.5" v-if="hospital.website">{{hospital.website}}</div>
                                        <div class="text-slate-500 text-xs mt-0.5">Opens:{{hospital.hours_of_operation}}</div>
                                    </div>
                                    
                                </div>
                            </router-link>
                        </div> 
                        <router-link :to="{name: 'frontend-private-hospitals'}" class="intro-x w-full block text-center rounded-md py-3 border border-dotted border-slate-400 dark:border-darkmode-300 text-slate-500">View More</router-link> 
                    </div>
                </div>
                <!-- END: Private Private -->
                <!-- BEGIN: Private Private -->
                <div class="col-span-12 xl:col-span-12 mt-6" v-if="public_hospitals.length != 0">
                    <div class="intro-x flex items-center h-10">
                        <h2 class="text-lg font-medium truncate mr-5">Public Hospitals in {{city}}</h2> 
                    </div>
                    
                    <div class="" v-if="public_hospitals.length != 0">
                        <div class="intro-x" v-for="hospital in public_hospitals" :key="hospital.id">
                            <a href="#">
                                <div class="box px-4 py-4 mb-3 flex items-center zoom-in">
                                    <div class="w-10 h-10 flex-none image-fit rounded-md overflow-hidden"> 
                                    <img  :src="'../../' + hospital.logo"> </div>
                                    <div class="ml-4 mr-auto">
                                        <div class="font-medium">{{hospital.registered_facility_name}}</div>
                                        <div class="text-slate-500 text-xs mt-0.5">{{hospital.physical_location }}<br>{{hospital.local_government_area}}, {{hospital.state}}</div>
                                        <div class="text-slate-500 text-xs mt-0.5">{{hospital.phone_number}}</div>
                                        <div class="text-slate-500 text-xs mt-0.5" v-if="hospital.website">{{hospital.website}}</div>
                                        <div class="text-slate-500 text-xs mt-0.5">Opens:{{hospital.hours_of_operation}}</div>
                                    </div>
                                    
                                </div>
                            </a>
                        </div> 
                        <router-link :to="{name: 'frontend-public-hospitals'}" class="intro-x w-full block text-center rounded-md py-3 border border-dotted border-slate-400 dark:border-darkmode-300 text-slate-500">View More</router-link> 
                    </div>
                </div>
                <!-- END: Private Private -->
            </div>
        </div>
    </div>
</template>
<script>
export default {
    name: 'hospital',
    data(){
        return {
            city: '',
            public_hospitals: [],
			private_hospitals: [],
        }
    },
    created(){
        this.getLocation()
        this.getPrivateHospitals()
        this.getPublicHospitals()
    },
    methods: {
        getLocation(){
            axios.get('/api/location', )
            .then(response => (this.city = response.data))
            .catch()
        },
        getPrivateHospitals(){
            axios.get('/api/private-hospitals', )
            .then(response => (this.private_hospitals = response.data))
            .catch()
        },
		getPublicHospitals(){
            axios.get('/api/public-hospitals', )
            .then(response => (this.public_hospitals = response.data))
            .catch()
        },
    }
}
</script>