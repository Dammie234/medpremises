<template>
<div class="py-5">
	<!-- BEGIN: Mobile Menu -->
	<frontend-mobile-menu></frontend-mobile-menu>
	<!-- END: Mobile Menu -->
	<!-- BEGIN: Top Bar -->
	<frontend-top-bar page="Laboratories"></frontend-top-bar>
	<!-- END: Top Bar -->
	<!-- BEGIN: Top Menu -->
	<top-nav v-if="token"></top-nav>
	<!-- END: Top Menu -->
	<!-- BEGIN: Content -->
	<div class="content">
		<div class="grid grid-cols-12 gap-6">
			<div class="col-span-12 lg:col-span-6 xl:col-span-6 mt-6 xl:border-r 2xl:pr-6">
				<div class="intro-y block sm:flex items-center h-10">
                    <h2 class="text-lg font-medium truncate mr-5">Laboratories in {{city}}</h2>
                </div>
                <div class="intro-y" v-if="laboratories.length != 0">
                    <div class="grid grid-cols-12 gap-6">
                        <div class="col-span-12 lg:col-span-6" v-for="laboratory in laboratories" :key="laboratory.id">
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
                    </div>
                    
                </div>
			</div>
			<div class="col-span-12 xl:col-span-3 lg:col-span-3 mt-6">
                <laboratory-tests></laboratory-tests>
			</div>
            <div class="col-span-12 xl:col-span-3 lg:col-span-3">
				<hospital></hospital>
			</div>
		</div>
	</div>
	<!-- END: Content -->
	
</div>
</template>
<script>

export default {
    name: 'laboratories',
    data() {
        return {
            token: null,
            facility: '',
            user: '',
            staff: '',
            profile: 'dist/images/profile-12.jpg',
            laboratories: [],
			city: '',
        }
    },
    created(){
        this.login()
        this.getLaboratories()
		this.getLocation()
    },
    methods: {
        login(){
            if (User.loggedIn()) {
               this.token = User.token()
            }
        },
        getLaboratories(){
            axios.get('/api/all-laboratories')
            .then(response => (this.laboratories = response.data))
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