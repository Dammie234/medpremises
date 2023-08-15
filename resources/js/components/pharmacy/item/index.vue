<template>
    <div class="main">
        <!-- BEGIN: Mobile Menu -->
        <mobile-menu></mobile-menu>
        <!-- END: Mobile Menu -->
        <div class="flex">
            <!-- BEGIN: Side Menu -->
            <side-menu page="pharmacy"></side-menu>
            <!-- END: Side Menu -->
            <!-- BEGIN: Content -->
            <div class="content">
                <!-- BEGIN: Top Bar -->
                <top-bar title="Item"></top-bar>
                <!-- END: Top Bar -->

                <div class="grid grid-cols-12 gap-6" v-if="add_item == true">
                    <div class="intro-y col-span-12 xxl:col-span-12">
                        <div class="intro-y box">
                            <div class="flex items-center p-5 border-b border-gray-200 dark:border-dark-5">
                                <h2 class="font-medium text-base mr-auto">Add Item</h2>
                            </div>
                            <form class="input p-5" @submit.prevent="store">
                                <div class="grid grid-cols-12 gap-x-5" :disabled="loading">
                                    <div class="col-span-12 xl:col-span-3 mt-3">
                                        <label for="category" class="form-label">Category</label>
                                        <select id="category" class="form-select" v-model="form.category">
                                            <option v-for="(category, index) in categories" :key="index" :value="category">
                                                {{ category }}
                                            </option>
                                        </select>
                                        <div class="text-danger font-medium text-xs mt-1" v-if="errors.category">
                                            {{ errors.category[0] }}
                                        </div>
                                    </div>
                                    <div class="col-span-12 xl:col-span-6 mt-3">
                                        <label for="name" class="form-label">Name</label>
                                        <input id="name" type="text" class="form-control" placeholder="Input item name"
                                            v-model="form.name" />
                                        <div class="text-danger font-medium text-xs mt-1" v-if="errors.name">
                                            {{ errors.name[0] }}
                                        </div>
                                    </div>

                                    <div class="col-span-12 xl:col-span-3 mt-3">
                                        <label for="nafdac_number" class="form-label">NAFDAC Number</label>
                                        <input id="nafdac_number" type="text" class="form-control"
                                            placeholder="Input item NAFDAC number" v-model="form.nafdac_number" />
                                        <div class="text-danger font-medium text-xs mt-1" v-if="errors.nafdac_number">
                                            {{ errors.nafdac_number[0] }}
                                        </div>
                                    </div>
                                    <div class="col-span-12 xl:col-span-6 mt-3">
                                        <label for="manufacturer" class="form-label">Manufacturer</label>
                                        <input id="manufacturer" type="text" class="form-control"
                                            placeholder="Input item manufacturer" v-model="form.manufacturer" />
                                        <div class="text-danger font-medium text-xs mt-1" v-if="errors.manufacturer">
                                            {{ errors.manufacturer[0] }}
                                        </div>
                                    </div>
                                    <div class="col-span-12 xl:col-span-3 mt-3">
                                        <label for="shelf_name" class="form-label">Shelf Name (Location on Shelf)</label>
                                        <input id="manufacturer" type="text" class="form-control"
                                            placeholder="Input Shelf Name (Location on Shelf)" v-model="form.shelf_name" />
                                        <div class="text-danger font-medium text-xs mt-1" v-if="errors.shelf_name">
                                            {{ errors.shelf_name[0] }}
                                        </div>
                                    </div>
                                    <div class="col-span-12 xl:col-span-3 mt-3">
                                        <label for="delivery" class="form-label">Item Delivery</label>
                                        <v-select :options="deliveries" label="delivery_name"
                                            @input="(delivery) => updateDelivery(form, delivery)"></v-select>
                                        <div class="text-danger font-medium text-xs mt-1" v-if="errors.delivery">
                                            {{ errors.delivery[0] }}
                                        </div>
                                    </div>
                                </div>
                                <div class="mt-3">
                                    <button type="submit" class="btn btn-primary w-20">Save</button>
                                    <loading v-if="loading == true"></loading>
                                    <button class="btn btn-secondary" @click="addItem">Close</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="grid grid-cols-12 gap-6 mt-4">
                    <div class="intro-y col-span-12 xxl:col-span-12">
                        <div class="intro-y box">
                            <div class="grid grid-cols-12 gap-x-5 p-5 border-b border-slate-200/60">
                                <div class="col-span-12 xl:col-span-4">
                                    <h2 class="font-medium text-base mr-auto">Items</h2>
                                </div>
                                <div class="col-span-12 xl:col-span-8">
                                    <div class="flex flex-col sm:flex-row gap-x-5">
                                        <div class="w-full" v-if="items.length > 5">
                                            <select v-model="category" class="form-control" id="">
                                                <option value="">Select By Category</option>
                                                <option v-for="(cat, index) in categories" :key="index" :value="cat">
                                                    {{ cat }}
                                                </option>
                                            </select>
                                        </div>
                                        <div class="w-full" v-if="items.length > 5">
                                            <input class="form-control" type="text" v-model="shelf" @keyup="onChangeShelf"
                                                placeholder="Seach Shelf Name" />
                                        </div>
                                        <div class="w-full" v-if="items.length > 5">
                                            <input class="form-control" type="text" v-model="search"
                                                placeholder="Seach Item Name" />
                                        </div>
                                        <button class="btn btn-primary w-60 text-xs" @click="addItem">
                                            Add Item
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <div class="p-5">
                                <div class="grid grid-cols-12 gap-x-5">
                                    <div class="col-span-12 xl:col-span-12 mt-3">
                                        <div v-if="error == true" class="">
                                            <div class="alert alert-outline-danger alert-dismissible show flex items-center mb-2"
                                                role="alert" v-for="(error, index) in err" :key="index">
                                                <i data-feather="alert-octagon"
                                                    class="fa fa-exclamation-circle fa-2x mr-2"></i>
                                                <strong class="mr-2">Whoops!</strong> {{ error }}
                                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                                    aria-label="Close">
                                                    <i data-feather="x" class="fa fa-times w-4 h-4"></i>
                                                </button>
                                            </div>
                                        </div>
                                        <div v-if="items.length != 0">
                                            <div class="overflow-x-auto">
                                                <table class="table table-sm table-bordered">
                                                    <thead>
                                                        <tr>
                                                            <th></th>
                                                            <th>Name</th>
                                                            <th>NAFDAC Number</th>
                                                            <th>Category</th>
                                                            <th>Manufacturer</th>
                                                            <th>Shelf Name</th>
                                                            <th>Delivery</th>
                                                            <th>Modified By</th>
                                                            <th>Modified</th>
                                                            <th>Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr v-for="(item, index) in filterSearch" :key="index">
                                                            <td>{{ index + 1 }}</td>
                                                            <td>{{ item.name }}</td>
                                                            <td>{{ item.nafdac_number }}</td>
                                                            <td>{{ item.category }}</td>
                                                            <td>{{ item.manufacturer }}</td>
                                                            <td>{{ item.shelf_name }}</td>

                                                            <td>{{ item.delivery_name }}</td>
                                                            <td>{{ item.added_by }}</td>
                                                            <td>{{ item.updated_at | moment("from", "now") }}</td>
                                                            <td class="whitespace-nowrap">
                                                                <router-link :to="{
                                                                    name: 'edit-item',
                                                                    params: { id: item.unique_id },
                                                                }" class="btn btn-primary">
                                                                    <i class="fa fa-edit"></i>
                                                                </router-link>
                                                                <button @click="deleteItem(item.unique_id)"
                                                                    class="btn btn-danger">
                                                                    <i class="fa fa-trash"></i>
                                                                </button>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <div v-else>
                                            <div class="alert alert-outline-danger alert-dismissible show flex items-center mb-2"
                                                role="alert">
                                                <i data-feather="alert-octagon"
                                                    class="fa fa-exclamation-circle fa-2x mr-2"></i>
                                                <strong class="mr-2"> Whoops! </strong> There are no items
                                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                                    aria-label="Close">
                                                    <i data-feather="x" class="fa fa-times w-4 h-4"></i>
                                                </button>
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
    name: "item",
    data() {
        return {
            id: null,
            token: null,
            categories: [
                "Personal hygiene",
                "Toileteries",
                "Food and beverages",
                "Skin care items",
                "Feminine products",
                "Masculine products",
                "Beauty items",
                "Seasonal products",
                "Household cleaning items",
                "Diet and nutrition items",
                "Dairy",
                "Others",
            ],
            form: {
                category: null,
                delivery: null,
                nafdac_number: null,
                name: null,
                manufacturer: null,
                shelf_name: null,
                user_id: null,
            },
            category: "",
            shelf: "",
            errors: {},
            items: [],
            loading: false,
            deliveries: [],
            search: "",
            add_item: false,
            err: [],
            error: false,
        };
    },
    computed: {
        filterSearch() {
            if (this.category) {
                return this.items.filter((item) => {
                    return item.category.match(this.category);
                });
            } else if (this.shelf) {
                return this.items.filter((item) => {
                    return item.shelf_name.match(this.shelf);
                });
            } else {
                let str = this.search;
                let string = str.charAt(0).toUpperCase() + str.slice(1);
                return this.items.filter((item) => {
                    return item.name.match(string);
                });
            }
        },
    },
    created() {
        this.login();
        this.getDeliveries();
        this.getItems();
    },
    methods: {
        login() {
            if (!User.loggedIn()) {
                this.$router.push({
                    name: "logout",
                });
            } else {
                this.token = User.token();
                this.form.user_id = User.id();
                this.id = User.id();
            }
        },
        onChangeShelf() {
            this.category = "";
        },
        addItem() {
            if (!this.add_item) {
                this.add_item = true;
            } else {
                this.add_item = false;
            }
        },
        updateDelivery(form, delivery) {
            form.delivery = delivery.id;
        },
        store() {
            this.loading = true;
            axios
                .post("/api/item", this.form)
                .then(() => {
                    this.$router.push({
                        name: "item",
                    });
                    this.form = {
                        category: "",
                        delivery: "",
                        nafdac_number: "",
                        name: "",
                        manufacturer: "",
                        shelf_name: "",
                        user_id: "",
                    };
                    this.getItems();
                    this.getDeliveries();
                    this.login();
                    this.add_item = false;
                    Toast.fire({
                        icon: "success",
                        title: "Item successfully added",
                    });
                })
                .catch((error) => (this.errors = error.response.data.errors))
                .finally(() => {
                    this.loading = false;
                });
        },
        getItems() {
            axios
                .get("/api/v1/items/" + this.id, {
                    headers: {
                        Authorization: "Bearer " + this.token,
                        Accept: "application/json",
                    },
                })
                .then((response) => (this.items = response.data))
                .catch((error) => {
                    console.log(error);
                    if (error.response.status == 401) {
                        this.$router.push({
                            name: "logout",
                        });
                    }
                });
        },
        getDeliveries() {
            axios
                .get("/api/v1/deliveries/" + this.id, {
                    headers: {
                        Authorization: "Bearer " + this.token,
                        Accept: "application/json",
                    },
                })
                .then((response) => (this.deliveries = response.data))
                .catch((error) => {
                    console.log(error);
                    if (error.response.status == 401) {
                        this.$router.push({
                            name: "logout",
                        });
                    }
                });
        },
        deleteItem(id) {
            Swal.fire({
                title: "Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, delete it!",
            }).then((result) => {
                if (result.isConfirmed) {
                    axios
                        .delete("/api/item/" + id)
                        .then(() => {
                            this.items = this.items.filter((item) => {
                                return item.id != id;
                            });
                            this.$router.push({
                                name: "item",
                            });
                            this.getItems();
                            Swal.fire("Deleted!", "An item has been deleted.", "success");
                        })

                        .catch((error) => {
                            this.error = true;
                            console.log(error);
                            if (error.response.status == 401) {
                                this.err.push(error.response.data.error);
                            }
                            Swal.fire(
                                "Not Deleted!",
                                "You can not delete this item because the total quantity is not zero..",
                                "error"
                            );
                        });
                }
            });
        },
    },
};
</script>

<style scoped></style>
