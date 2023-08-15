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
                                Edit Post
                            </h2>
                        </div>
                        <div class="grid grid-cols-12 gap-x-5">
                            <div class="col-span-12 xl:col-span-8">
                                <form class="input p-5" @submit.prevent="update" >
                                    <div class="grid grid-cols-12 gap-x-5" :disabled="loading">
                                        <div class="col-span-12 xl:col-span-12">
                                            <div class="grid grid-cols-12 gap-x-5">
                                                <div class="col-span-12 xl:col-span-12 mt-3">
                                                    <label for="title" class="form-label">Title</label>
                                                    <input id="title" type="text" class="form-control" placeholder="Input delivery full name" v-model="form.title">
                                                    <div class="text-danger font-medium text-xs mt-1"  v-if="errors.title">{{ errors.title[0] }}</div>
                                                </div>
                                                <div class="col-span-12 xl:col-span-12">
                                                    <label for="catergories" class="form-label">Categories</label>
                                                    <select data-placeholder="Select your categories" data-header="Categories" v-model="categories" class="tom-select w-full" multiple>
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
                                                <div class="col-span-12 xl:col-span-12 mt-3">
                                                    <label for="content" class="form-label">Post Content</label>
                                                    <vue-editor v-model="form.content" id="content" :editorToolbar="customToolbar"></vue-editor>
                                                    <div class="text-danger font-medium text-xs mt-1"  v-if="errors.content">{{ errors.content[0] }}</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mt-3">
                                        <button type="submit" class="btn btn-primary w-20">Save</button>
                                        <loading v-if="loading == true"></loading>
                                    </div>
                                    
                                </form>
                            </div>
                            <div class="col-span-12 xl:col-span-4">
                                <form @submit.prevent="updateFeaturedImage" enctype="multipart/form-data" class="mx-auto mt-4">
                                    <div class="border-2 border-dashed shadow-sm border-gray-200 dark:border-dark-5 rounded-md p-5" :disabled="loading">
                                        <div class="h-40 relative image-fit cursor-pointer zoom-in mx-auto">
                                            <img class="rounded-md" v-if="form.featured_image"  :src="'../../' + form.featured_image">
                                            <img class="rounded-md" v-else :src="images.featured_image">
                                            <!-- <div title="Remove this profile photo?" class="tooltip w-5 h-5 flex items-center justify-center absolute rounded-full text-white bg-theme-6 right-0 top-0 -mr-2 -mt-2"> <i data-feather="x" class="w-4 h-4"></i> </div> -->
                                        </div>
                                        <div class="mx-auto cursor-pointer relative mt-5">
                                            <input type="file" class="form-control" @change="onFileSelected">
                                            <button type="submit" class="btn btn-primary w-full">Change Featured Image</button>
                                            <loading v-if="loading == true"></loading>
                                        </div>
                                        <div class="text-danger font-medium text-xs mt-1"  v-if="image_errors.featured_image">{{ image_errors.featured_image[0] }}</div>
                                    </div>
                                </form>
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
            categories: [],
            form: {
                user_id: '',
                title: '',
                content: '',
                categories: [],
                featured_image: '',
                token: ''
            },
            loading:false,
            images: {
                featured_image: ''
            },
            errors: {},
            image_errors: {},
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
    created() {
        this.login()
        this.getPost()
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
                    this.images.featured_image = event.target.result
                };
            }
        },
        getPost(){
            let id = this.$route.params.id
            axios.get('/api/v1/user-post/' + id, {
                headers: {
                    Authorization: 'Bearer ' + this.token,
                    Accept: 'application/json'
                }
           }).then(response => (this.form = response.data))
            .catch((error) => {
                console.log(error)
                if (error.response.status == 401) {
                    this.$router.push({
                        name: 'logout'
                    })
                }
            })
        },
        update() {
            this.loading = true
            let id = this.$route.params.id
            this.form.categories = this.categories
            axios.patch('/api/update-post/' + id, this.form)
                .then(() => {
                    window.location.href = '/staff/posts/'
                    Toast.fire({
                        icon: 'success',
                        title: 'Post successfully updated'
                    })
                })
                .catch(error => this.errors = error.response.data.errors)
                .finally(() => {
                    this.loading = false
                })
        },
        updateFeaturedImage() {
            this.loading = true
            let id = this.$route.params.id
            axios.patch('/api/update-featured-image/' + id, this.images)
                .then(() => {
                    this.$router.push({
                        name: 'posts'
                    })
                   
                    Toast.fire({
                        icon: 'success',
                        title: 'Post Image successfully updated'
                    })
                })
            .catch(error => this.errors = error.response.data.errors)
            .finally(() => {
                this.loading = false
            })
        }
    }
}
</script>

<style scoped>

</style>
