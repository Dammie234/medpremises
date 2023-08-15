<template>
<div class="main">
    <!-- BEGIN: Mobile Menu -->
    <mobile-menu></mobile-menu>
    <!-- END: Mobile Menu -->
    <div class="flex">
        <!-- BEGIN: Side Menu -->
        <side-menu page="post"></side-menu>
        <!-- END: Side Menu -->
        <!-- BEGIN: Content -->
        <div class="content">
            <!-- BEGIN: Top Bar -->
            <top-bar title="Posts"></top-bar>
            <!-- END: Top Bar -->
            <div class="grid grid-cols-12 gap-6">
                <div class="intro-y col-span-12 xxl:col-span-12">
                   <div class="intro-y box">
                        <div class="flex items-center p-5 border-b border-gray-200 dark:border-dark-5">
                            <h2 class="font-medium text-base mr-auto">
                                Add Post
                            </h2>
                        </div>
                        <form class="input p-5" @submit.prevent="store" enctype="multipart/form-data">
                            <div class="grid grid-cols-12 gap-x-5" :disabled="loading">
                                <div class="col-span-12 xl:col-span-8">
                                    <div class="grid grid-cols-12 gap-x-5">
                                        <div class="col-span-12 xl:col-span-12 mt-3">
                                            <label for="title" class="form-label">Title</label>
                                            <input id="title" type="text" class="form-control" placeholder="Input delivery full name" v-model="form.title">
                                            <div class="text-danger font-medium text-xs mt-1"  v-if="errors.title">{{ errors.title[0] }}</div>
                                        </div>
                                        <div class="col-span-12 xl:col-span-12 mt-3">
                                            <label for="content" class="form-label">Post Content</label>
                                            <vue-editor v-model="form.content" id="content" :editorToolbar="customToolbar"></vue-editor>
                                            <div class="text-danger font-medium text-xs mt-1"  v-if="errors.content">{{ errors.content[0] }}</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-span-12 xl:col-span-4">
                                    <div class="grid grid-cols-12 gap-x-5">
                                        <div class="col-span-12 xl:col-span-12">
                                            <label for="catergories" class="form-label">Categories</label>
                                            <select data-placeholder="Select your categories" data-header="Categories" v-model="form.categories" class="tom-select w-full" multiple>
                                                <option value="Drugs & Supplements">Drugs & Supplements</option>
                                                <option value="Living Healthy">Living Healthy</option>
                                                <option value="Family & Pregnacy">Family & Pregnacy</option>
                                                <option value="Health Conditions">Health Conditions</option>
                                                <option value="Health Tools">Health Tools</option>
                                                <option value="Physician">Physician</option>
                                                <option value="Patient">Patient</option>
                                                <option value="Laboratory">Laboratory</option>
                                            </select>
                                            <div class="text-danger font-medium text-xs mt-1"  v-if="errors.categories">{{ errors.categories[0] }}</div>
                                        </div>
                                        <div class="col-span-12 xl:col-span-12">
                                            <div class=" mx-auto mt-4">
                                                <div class="border-2 border-dashed shadow-sm border-gray-200 dark:border-dark-5 rounded-md p-5">
                                                    <div class="h-40 relative image-fit cursor-pointer zoom-in mx-auto">
                                                        <img class="rounded-md" v-if="form.featured_image"  :src="form.featured_image">
                                                        <span v-else>No Featured Image Selected</span>
                                                        <!-- <div title="Remove this profile photo?" class="tooltip w-5 h-5 flex items-center justify-center absolute rounded-full text-white bg-theme-6 right-0 top-0 -mr-2 -mt-2"> <i data-feather="x" class="w-4 h-4"></i> </div> -->
                                                    </div>
                                                    <div class="mx-auto cursor-pointer relative mt-5">
                                                        <input type="file" class="form-control" @change="onFileSelected">
                                                    </div>
                                                    <div class="text-danger font-medium text-xs mt-1"  v-if="errors.featured_image">{{ errors.featured_image[0] }}</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="mt-3">
                                <button type="submit" class="btn btn-primary w-20 mt-3">Save</button>
                                <loading v-if="loading == true"></loading>
                            </div>
                        </form>
                   </div>
                </div>
            </div>
            <div class="grid grid-cols-12 gap-6 mt-4">
                <div class="intro-y col-span-12 xxl:col-span-12">
                   <div class="intro-y box">
                        <div class="flex flex-col sm:flex-row items-center p-5 border-b border-slate-200/60">
                            <h2 class="font-medium text-base mr-auto">Posts</h2>

                            <div class="w-full sm:w-auto sm:ml-auto mt-3 sm:mt-0"> 
                                <input  class="form-control mr-0 ml-3" type="text" v-model="search" placeholder="Seach Title">
                            </div>
                        </div>
                        <div class=" p-5">
                            <div class="grid grid-cols-12 gap-x-5">
                                <div class="col-span-12 xl:col-span-12 mt-3">
                                    <div v-if="posts.length != 0">
                                        <div class="overflow-x-auto">
                                            <table class="table table-sm table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th class="whitespace-nowrap">Title</th>
                                                        <th class="whitespace-nowrap">Categories</th>
                                                        <th class="whitespace-nowrap">Date Posted</th>
                                                        <th class="whitespace-nowrap">Likes</th>
                                        
                                                        <th class="whitespace-nowrap">Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr v-for="post in filterSearch" :key="post.id">
                                                        <td>{{ post.title }}</td>
                                                        <td>{{post.categories}}</td>
                                                        <td>{{ post.created_at | moment("from", "now")}}</td>
                                                        <td>{{ post.likes }}</td>
                                                        <td class="whitespace-nowrap">
                                                            <router-link :to="{name: 'post', params:{id: post.id}}" class="btn btn-primary">
                                                                <i class="fa fa-info"></i>
                                                            </router-link>
                                                            <a :href="'/staff/posts/' + post.id + '/edit'" class="btn btn-primary"><i class="fa fa-edit"></i></a>
                                                            <button @click="deletePost(post.id)" class="btn btn-danger">
                                                                <i class="fa fa-trash"></i>
                                                            </button>
                                                        </td>
                                                    </tr>
                                                    
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div v-else>
                                        <div class="alert alert-outline-danger alert-dismissible show flex items-center mb-2" role="alert" > 
                                            <i data-feather="alert-octagon" class="fa fa-exclamation-circle fa-2x mr-2"></i> <strong class="mr-2"> Whoops! </strong>  There are no posts added yet
                                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"> <i data-feather="x" class="fa fa-times w-4 h-4"></i> </button> 
                                        </div>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                   </div>
                </div>
            </div>
        </div>
        <!-- END: Content -->
    </div>
</div>
</template>

<script>
export default {
    name: 'posts',
    data() {
        return {
            id: null,
            token: null,
            posts: [],
            search: '',
            form: {
                user_id: '',
                title: '',
                content: '',
                categories: [],
                featured_image: '',
                token: ''
            },
            loading: false,
            errors: {},
            customToolbar: [
                [{ header: [false, 1, 2, 3, 4, 5, 6] }],
                ["bold", "italic", "underline", "strike"], 
                [
                    { align: "" },
                    { align: "center" },
                    { align: "right" },
                    { align: "justify" }
                ],
                ["blockquote", "code-block"],
                [{ list: "ordered" }, { list: "bullet" }, { list: "check" }],
                [{ indent: "-1" }, { indent: "+1" }], // outdent/indent
                ["link"],
                ["clean"]
            ],
        }
    },
    computed: {
        filterSearch() {
            let str = this.search
            let string = str.charAt(0).toUpperCase() + str.slice(1)
            return this.posts.filter(post => {
                return post.title.match(string)
            })
        }
    },
    created() {
        this.login()
        this.getPosts()
    },
    methods: {
        login(){
            if (!User.loggedIn()) {
                this.$router.push({
                        name: 'logout'
                    })
            }else{
                this.token = User.token()
                this.form.token = User.token()
            }
        },
        onFileSelected(event) {
            let file = event.target.files[0];
            if (file.size > 1048770) {
                Notification.image_validation()
            } else {
                let reader = new FileReader();
                reader.readAsDataURL(file);

                let type = file.type
                let name = file.name
                reader.onload = event => {
                    this.form.featured_image = event.target.result
                };
            }
        },
        getPosts(){
            axios.get('/api/v1/user-posts/' + this.token, {
                headers: {
                    Authorization: 'Bearer ' + this.token,
                    Accept: 'application/json'
                }
           }).then(response => (this.posts = response.data))
            .catch((error) => {
                console.log(error)
                if (error.response.status == 401) {
                    this.$router.push({
                        name: 'logout'
                    })
                }
            })
        },
        store() {
            this.loading = true
            axios.post('/api/posts', this.form)
                .then(() => {
                    this.$router.push({
                        name: 'posts'
                    })
                    this.form = {
                        user_id: '',
                        title: '',
                        content: '',
                        categories: [],
                        featured_image: '',
                        token: ''
                    }
                    this.login()
                    this.getPosts()
                    Toast.fire({
                        icon: 'success',
                        title: 'Post successfully added'
                    })
                })
                .catch(error => this.errors = error.response.data.errors)
                .finally(() => {
                    this.loading = false
                })
        },
        
        deletePost(id) {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    axios.delete('/api/posts/' + id)
                        .then(() => {
                            this.posts = this.posts.filter(post => {
                                return post.id != id
                            })
                        })
                        .catch(() => {
                            this.$router.push({
                                name: 'posts'
                            })
                            this.getPosts()
                        })
                    Swal.fire(
                        'Deleted!',
                        'A post has been deleted.',
                        'success'
                    )
                }
            })
        }
    }
}
</script>

<style scoped>

</style>
