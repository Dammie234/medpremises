<template>
<div class="main">
    <!-- BEGIN: Mobile Menu -->
    <mobile-menu></mobile-menu>
    <!-- END: Mobile Menu -->
    <div class="flex">
        <!-- BEGIN: Side Menu -->
        <side-menu page="patient"></side-menu>
        <!-- END: Side Menu -->
        <!-- BEGIN: Content -->
        <div class="content">
            <!-- BEGIN: Top Bar -->
            <top-bar title="Consultation - Progress Note"></top-bar>
            <!-- END: Top Bar -->
            
            <div class="grid grid-cols-12 gap-6 mt-4">
                <div class="intro-y col-span-12 xxl:col-span-12">
                   <div class="intro-y box">
                        <div class="flex flex-col sm:flex-row items-center p-5 border-b border-slate-200/60">
                            <h2 class="font-medium text-base mr-auto">Progress Note for {{data.patient.name}}</h2>
                        </div>
                        <div class="p-5">
                            <div class="overflow-x-auto">
                                <table class="table table-bordered text-xs">
                                    <thead>
                                        <tr>
                                            <th>Blood Pressure</th>
                                            <th>Weight</th>
                                            <th>Blood Sugar</th>
                                            <th>Other</th>
                                            <th></th>
                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td><span v-if="data.progress_note.blood_pressure">{{data.progress_note.blood_pressure}}</span><span v-else>-</span></td>
                                            <td><span v-if="data.progress_note.weight">{{data.progress_note.weight}}</span><span v-else>-</span></td>
                                            <td><span v-if="data.progress_note.blood_sugar">{{data.progress_note.blood_sugar}}</span><span v-else>-</span></td>
                                            <td><span v-if="data.progress_note.other">{{data.progress_note.other}}</span><span v-else>-</span></td>
                                            <td><span v-if="data.progress_note.blood_pressure">{{data.progress_note.updated_at | moment('from', 'now')}}</span><span v-else>-</span></td>
                                            <td><button class="btn btn-warning" @click="editProgressNote" title="Edit"><i class="fa fa-edit"></i></button></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <button class="btn btn-primary mt-2" @click="addNote">Add Note</button>
                        </div>
                   </div>
                </div>
            </div>
            <div class="grid grid-cols-12 gap-6 mt-4" v-if="edit_progress_note == true">
                <div class="intro-y col-span-12 xxl:col-span-12">
                   <div class="intro-y box">
                        <div class="flex flex-col sm:flex-row items-center p-5 border-b border-slate-200/60">
                            <h2 class="font-medium text-base mr-auto">Edit Progress Note for {{data.patient.name}}</h2>
                        </div>
                        <div class="p-5">
                            <div class="grid grid-cols-12 gap-x-5">
                                <div class="col-span-12 xl:col-span-12 mt-3" >
                                    <form @submit.prevent="submitUpdateProgressNoteTypeA">
                                        <div :disabled="loading">
                                            <div class="grid grid-cols-12 gap-x-5">
                                                <div class="col-span-12 xl:col-span-3 mt-3">
                                                    <label for="blood_pressure" class="form-label">Blood Pressure</label>
                                                    <input type="text" v-model="form.blood_pressure" id="blood_pressure" class="form-control">
                                                </div>
                                                <div class="col-span-12 xl:col-span-2 mt-3">
                                                    <label for="weight" class="form-label">Weight</label>
                                                    <input id="weight" type="text" v-model="form.weight" class="form-control">
                                                </div>
                                                <div class="col-span-12 xl:col-span-3 mt-3">
                                                    <label for="blood_sugar" class="form-label">Blood Sugar</label>
                                                    <input id="blood_sugar" type="text" v-model="form.blood_sugar" class="form-control">
                                                </div>
                                                <div class="col-span-12 xl:col-span-4 mt-3">
                                                    <label for="other" class="form-label">Other</label>
                                                    <input id="other" type="text" v-model="form.other" class="form-control">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="mt-2">
                                            <input type="submit" value="Submit" class="w-20 btn btn-primary">
                                            <button class="w-20 btn btn-secondary" @click="editProgressNote">Close</button>
                                            <loading v-if="loading == true"></loading>
                                        </div>
                                        
                                    </form>
                                </div>
                            </div>
                            
                        </div>
                   </div>
                </div>
            </div>
            <div class="grid grid-cols-12 gap-6 mt-4" v-if="add_note == true">
                <div class="intro-y col-span-12 xxl:col-span-12">
                   <div class="intro-y box">
                        <div class="flex flex-col sm:flex-row items-center p-5 border-b border-slate-200/60">
                            <h2 class="font-medium text-base mr-auto">Add Progress Note for {{data.patient.name}}</h2>
                        </div>
                        <div class="p-5">
                            <div class="grid grid-cols-12 gap-x-5">
                                <div class="col-span-12 xl:col-span-12 mt-3" >
                                    <form @submit.prevent="submitProgressNoteTypeB">
                                        <div :disabled="loading">
                                            <div class="grid grid-cols-12 gap-x-5">
                                                <div class="col-span-12 xl:col-span-12 mt-3">
                                                    <label for="note" class="form-label">Note</label>
                                                    <input type="text" v-model="type_b.note" id="note" class="form-control">
                                                </div>
                                                
                                            </div>
                                        </div>
                                        <div class="mt-2">
                                            <input type="submit" value="Submit" class="w-20 btn btn-primary">
                                            <button class="w-20 btn btn-secondary" @click="addNote">Close</button>
                                            <loading v-if="loading == true"></loading>
                                        </div>
                                        
                                    </form>
                                </div>
                            </div>
                            
                        </div>
                   </div>
                </div>
            </div>
            <div class="grid grid-cols-12 gap-6 mt-4" v-if="edit_note == true">
                <div class="intro-y col-span-12 xxl:col-span-12">
                   <div class="intro-y box">
                        <div class="flex flex-col sm:flex-row items-center p-5 border-b border-slate-200/60">
                            <h2 class="font-medium text-base mr-auto">Edit Progress Note for {{data.patient.name}}</h2>
                        </div>
                        <div class="p-5">
                            <div class="grid grid-cols-12 gap-x-5">
                                <div class="col-span-12 xl:col-span-12 mt-3" >
                                    <form @submit.prevent="submitUpdateProgressNoteTypeB(type_b.id)">
                                        <div :disabled="loading">
                                            <div class="grid grid-cols-12 gap-x-5">
                                                <div class="col-span-12 xl:col-span-12 mt-3">
                                                    <label for="note" class="form-label">Note</label>
                                                    <input type="text" v-model="type_b.note" id="note" class="form-control">
                                                </div>
                                                
                                            </div>
                                        </div>
                                        <div class="mt-2">
                                            <input type="submit" value="Submit" class="w-20 btn btn-primary">
                                            <button class="w-20 btn btn-secondary" @click="editNote(type_b.id)">Close</button>
                                            <loading v-if="loading == true"></loading>
                                        </div>
                                        
                                    </form>
                                </div>
                            </div>
                            
                        </div>
                   </div>
                </div>
            </div>
            <div class="grid grid-cols-12 gap-6 mt-4">
                <div class="intro-y col-span-12 xxl:col-span-12">
                   <div class="intro-y box">
                        <div class="flex flex-col sm:flex-row items-center p-5 border-b border-slate-200/60">
                            <h2 class="font-medium text-base mr-auto">Progress Note for {{data.patient.name}}</h2>
                        </div>
                        <div class="p-5">
                            <div class="overflow-x-auto" v-if="notes.length != 0">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Note</th>
                                            <th></th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="note in notes" :key="note.id">
                                            <td>{{note.note}}</td>
                                            <td>{{note.created_at | moment('from', 'now')}}</td>
                                            <td><button class="btn btn-warning" @click="editNote(note.id)" title="Edit"><i class="fa fa-edit"></i></button><button class="btn btn-danger mx-3" @click="deleteProgressNote(note.id)"><i class="fa fa-trash"></i></button></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div v-else>
                                <div class="alert alert-outline-danger alert-dismissible show flex items-center mb-2" role="alert" > 
                                    <i data-feather="alert-octagon" class="fa fa-exclamation-circle fa-2x mr-2"></i> <strong class="mr-2"> Whoops! </strong>  There are no progress notes
                                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"> <i data-feather="x" class="fa fa-times w-4 h-4"></i> </button> 
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
    name: 'progress-note',
    data() {
        return {
            id: null,
            token: null,
            key: '',
            loading: false,
            errors: {},
            data: {},
            edit_progress_note: false,
            add_note: false,
            edit_note: false,
            form: {
                blood_pressure: '',
                blood_sugar: '',
                weight: '',
                other: '',
                token: ''
            },
            type_b: {
                note: '',
                key: '',
                token: ''
            },
            notes: []
            
        }
    },
    
    created() {
        this.login()
        this.getData()
        this.getNotes()
    },
    methods: {
        login(){
            if (!User.loggedIn()) {
                this.$router.push({
                        name: 'logout'
                    })
            }else{
                this.token = User.token()
                this.key = this.$route.params.key
            }
        },
        addNote(){
            if (this.add_note == false ) {
                this.add_note = true
            } else {
                this.add_note = false                
            }
        },
        editNote(id){
            if (this.edit_note == false) {
                this.edit_note = true
                axios.get('/api/v1/progress-note/' + id, {
                    headers: {
                        Authorization: 'Bearer ' + this.token,
                        Accept: 'application/json'
                    }
            }).then(response => (this.type_b = response.data))
                .catch((error) => {
                    console.log(error)
                    if (error.response.status == 401) {
                        this.$router.push({
                            name: 'logout'
                        })
                    }
                })
            } else {
                this.edit_note = false                
            }
        },
        editProgressNote(){
            if (this.edit_progress_note == false) {
                this.edit_progress_note = true
                axios.get('/api/v1/consultation/' + this.key, {
                    headers: {
                        Authorization: 'Bearer ' + this.token,
                        Accept: 'application/json'
                    }
            }).then(response => (this.form = response.data.progress_note))
                .catch((error) => {
                    console.log(error)
                    if (error.response.status == 401) {
                        this.$router.push({
                            name: 'logout'
                        })
                    }
                })
            } else {
                this.edit_progress_note = false                
            }
        },
        getData(){
            axios.get('/api/v1/consultation/' + this.key, {
                headers: {
                    Authorization: 'Bearer ' + this.token,
                    Accept: 'application/json'
                }
           }).then(response => (this.data = response.data))
            .catch((error) => {
                console.log(error)
                if (error.response.status == 401) {
                    this.$router.push({
                        name: 'logout'
                    })
                }
            })
        },
        getNotes(){
            axios.get('/api/v1/progress-notes/' + this.key, {
                headers: {
                    Authorization: 'Bearer ' + this.token,
                    Accept: 'application/json'
                }
           }).then(response => (this.notes = response.data))
            .catch((error) => {
                console.log(error)
                if (error.response.status == 401) {
                    this.$router.push({
                        name: 'logout'
                    })
                }
            })
        },
        submitUpdateProgressNoteTypeA() {
           this.loading = true
           this.form.token = User.token()
            axios.patch('/api/progress-note-type-a/' + this.key, this.form)
                .then(() => {
                    this.$router.push({
                        path: `/patient/consultations/progress-note/${this.key}`
                    })
                    this.login()
                    this.getData()
                    this.edit_progress_note = false
                    Toast.fire({
                        icon: 'success',
                        title: 'Progress Note successfully updated'
                    })
                })
                .catch(error => this.errors = error.response.data.errors)
                .finally(() => {
                    this.loading =  false
                }) 
        },
        submitProgressNoteTypeB() {
           this.loading = true
           this.type_b.token = User.token()
           this.type_b.key = this.key
            axios.post('/api/progress-note-type-b', this.type_b)
                .then(() => {
                    this.$router.push({
                        path: `/patient/consultations/progress-note/${this.key}`
                    })
                    this.login()
                    this.getData()
                    this.add_note = false
                    this.getNotes()
                    this.type_b = {
                        note: '',
                        key: '',
                        token: ''
                    }
                    Toast.fire({
                        icon: 'success',
                        title: 'Progress Note successfully updated'
                    })
                })
                .catch(error => this.errors = error.response.data.errors)
                .finally(() => {
                    this.loading =  false
                }) 
        },
        submitUpdateProgressNoteTypeB(id) {
           this.loading = true
           this.type_b.token = User.token()
            axios.patch('/api/progress-note-type-b/' + id, this.type_b)
                .then(() => {
                    this.$router.push({
                        path: `/patient/consultations/progress-note/${this.key}`
                    })
                    this.login()
                    this.getData()
                    this.edit_note = false
                    this.getNotes()
                    this.type_b = {
                        note: '',
                        key: '',
                        token: ''
                    }
                    Toast.fire({
                        icon: 'success',
                        title: 'Progress Note successfully updated'
                    })
                })
                .catch(error => this.errors = error.response.data.errors)
                .finally(() => {
                    this.loading =  false
                }) 
        },
        deleteProgressNote(id) {
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
                    axios.delete('/api/progress-note-type-b/' + id)
                        .then(() => {
                            this.notes = this.notes.filter(note => {
                                return note.id != id
                            })
                        })
                        .catch(() => {
                            this.$router.push({
                                path: `/patient/consultations/progress-note/${this.key}`
                            })
                            this.getNotes()
                        })
                    Swal.fire(
                        'Deleted!',
                        'A progress note has been deleted.',
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
