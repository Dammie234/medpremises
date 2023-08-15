<template>
<div class="py-5">
	<!-- BEGIN: Mobile Menu -->
	<frontend-mobile-menu></frontend-mobile-menu>
	<!-- END: Mobile Menu -->
	<!-- BEGIN: Top Bar -->
	<frontend-top-bar page="Post"></frontend-top-bar>
	<!-- END: Top Bar -->
	<!-- BEGIN: Top Menu -->
	<top-nav v-if="token"></top-nav>
	<!-- END: Top Menu -->
	<!-- BEGIN: Content -->
	<div class="content">
		<div class="grid grid-cols-12 gap-6">
			<div class="col-span-12 lg:col-span-6 xl:col-span-6 mt-6">
				
                <div class="intro-y box p-5 mt-12 sm:mt-5">
                   <div class="intro-y block sm:flex items-center h-10">
                        <h2 class="text-lg font-medium truncate mr-5">{{post.title}}</h2>
                    </div> 
                    <div class="w-full h-64 my-5 image-fit">
                        <img  :src="'../../' + post.featured_image" data-action="zoom" class="w-full rounded-md">
                    </div>
                    <div v-html="post.content"></div>
                </div>
			</div>
			<div class="col-span-12 lg:col-span-3 xl:col-span-3 mt-6">
				<pharmacy></pharmacy>
                <laboratory class="mt-6"></laboratory>
			</div>
            <div class="col-span-12 lg:col-span-3 xl:col-span-3">
				<hospital></hospital>
			</div>
		</div>
	</div>
	<!-- END: Content -->
	
</div>
</template>
<script>

export default {
    name: 'post',
    data() {
        return {
            token: null,
            facility: '',
            user: '',
            staff: '',
            profile: 'dist/images/profile-12.jpg',
            post: '',
			city: '',
        }
    },
    created(){
        this.login()
        this.getPost()
		this.getLocation()
    },
    methods: {
        login(){
            if (User.loggedIn()) {
               this.token = User.token()
            }
        },
        getPost(){
            let slug = this.$route.params.slug
            axios.get('/api/all-posts/' + slug)
            .then(response => (this.post = response.data))
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