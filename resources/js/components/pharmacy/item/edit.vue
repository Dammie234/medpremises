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

                <div class="grid grid-cols-12 gap-6">
                    <div class="intro-y col-span-12 xxl:col-span-6 xl:col-span-6">
                        <div class="intro-y box">
                            <div class="flex items-center p-5 border-b border-gray-200 dark:border-dark-5">
                                <h2 class="font-medium text-base mr-auto">Edit Item</h2>
                                <router-link :to="{ name: 'item' }" class="btn btn-primary w-20 text-xs">Go
                                    Back</router-link>
                            </div>
                            <form class="input p-5" @submit.prevent="update">
                                <div class="grid grid-cols-12 gap-x-5" :disabled="loading">
                                    <div class="col-span-12 xl:col-span-12 mt-3">
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
                                    <div class="col-span-12 xl:col-span-12 mt-3">
                                        <label for="name" class="form-label">Name</label>
                                        <input id="name" type="text" class="form-control" placeholder="Input item name"
                                            v-model="form.name" />
                                        <div class="text-danger font-medium text-xs mt-1" v-if="errors.name">
                                            {{ errors.name[0] }}
                                        </div>
                                    </div>

                                    <div class="col-span-12 xl:col-span-12 mt-3">
                                        <label for="nafdac_number" class="form-label">NAFDAC Number</label>
                                        <input id="nafdac_number" type="text" class="form-control"
                                            placeholder="Input drug NAFDAC number" v-model="form.nafdac_number" />
                                        <div class="text-danger font-medium text-xs mt-1" v-if="errors.nafdac_number">
                                            {{ errors.nafdac_number[0] }}
                                        </div>
                                    </div>
                                    <div class="col-span-12 xl:col-span-12 mt-3">
                                        <label for="manufacturer" class="form-label">Manufacturer</label>
                                        <input id="manufacturer" type="text" class="form-control"
                                            placeholder="Input item manufacturer" v-model="form.manufacturer" />
                                        <div class="text-danger font-medium text-xs mt-1" v-if="errors.manufacturer">
                                            {{ errors.manufacturer[0] }}
                                        </div>
                                    </div>
                                    <div class="col-span-12 xl:col-span-12 mt-3">
                                        <label for="shelf_name" class="form-label">Shelf Name (Location on Shelf)</label>
                                        <input id="manufacturer" type="text" class="form-control"
                                            placeholder="Input Shelf Name (Location on Shelf)" v-model="form.shelf_name" />
                                        <div class="text-danger font-medium text-xs mt-1" v-if="errors.shelf_name">
                                            {{ errors.shelf_name[0] }}
                                        </div>
                                    </div>
                                    <div class="col-span-12 xl:col-span-12 mt-3">
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
                                </div>
                            </form>
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
            errors: {},
            deliveries: [],
            search: "",
            loadig: false,
        };
    },
    created() {
        this.login();
        this.getDeliveries();
        this.getItem();
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
        updateDelivery(form, delivery) {
            form.delivery = delivery.id;
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
        getItem() {
            let id = this.$route.params.id;
            axios
                .get("/api/v1/item/" + id, {
                    headers: {
                        Authorization: "Bearer " + this.token,
                        Accept: "application/json",
                    },
                })
                .then((response) => (this.form = response.data))
                .catch((error) => {
                    console.log(error);
                    if (error.response.status == 401) {
                        this.$router.push({
                            name: "logout",
                        });
                    }
                });
        },
        update() {
            this.loading = true;
            let id = this.$route.params.id;
            axios
                .patch("/api/item/" + id, this.form)
                .then(() => {
                    this.$router.push({
                        name: "item",
                    });
                    Toast.fire({
                        icon: "success",
                        title: "Item successfully updated",
                    });
                })
                .catch((error) => (this.errors = error.response.data.errors))
                .finally(() => {
                    this.loading = false;
                });
        },
    },
};
</script>

<style scoped></style>
