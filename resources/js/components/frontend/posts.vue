<template>
<div class="py-5">
	<!-- BEGIN: Mobile Menu -->
	<frontend-mobile-menu></frontend-mobile-menu>
	<!-- END: Mobile Menu -->
	<!-- BEGIN: Top Bar -->
	<frontend-top-bar page="Posts"></frontend-top-bar>
	<!-- END: Top Bar -->
	<!-- BEGIN: Top Menu -->
	<top-nav v-if="token"></top-nav>
	<!-- END: Top Menu -->
	<!-- BEGIN: Content -->
	<div class="content">
		<div class="grid grid-cols-12 gap-6">
			<div class="col-span-12 lg:col-span-6 xl:col-span-6 mt-6">
				<div class="intro-y block sm:flex items-center h-10">
                    <h2 class="text-lg font-medium truncate mr-5">Posts</h2>
                </div>
                <div class="intro-y" v-if="posts.length != 0">
                    <div class="intro-y" v-for="post in posts" :key="post.id">
                        <router-link :to="{name: 'frontend-post', params:{slug: post.slug}}">
                            <div class="box px-4 py-4 mb-3 flex items-center zoom-in">
                                <div class="w-10 h-10 flex-none image-fit rounded-md overflow-hidden"> 
                                <img  :src="post.featured_image"> </div>
                                <div class="ml-4 mr-auto">
                                    <div class="font-medium">{{post.title}}</div>
                                    <div class="text-slate-500 text-xs mt-0.5">{{post.categories}}</div>
                                    <div class="text-slate-500 text-xs mt-0.5">Posted By {{post.name}} </div>
                                    <div class="text-slate-500 text-xs mt-0.5">{{post.created_at | moment("from", "now")}}</div>
                                </div>
                            </div>
                        </router-link>
                    </div>
                    
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
    name: 'posts',
    data() {
        return {
            token: null,
            facility: '',
            user: '',
            staff: '',
            profile: 'dist/images/profile-12.jpg',
            posts: [],
			city: '',
        }
    },
    created(){
        this.login()
        this.getPosts()
		this.getLocation()
    },
    methods: {
        login(){
            if (User.loggedIn()) {
               this.token = User.token()
            }
        },
        getPosts(){
            axios.get('/api/all-posts')
            .then(response => (this.posts = response.data))
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