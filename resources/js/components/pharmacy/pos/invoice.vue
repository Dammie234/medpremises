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
                <top-bar title="Pharmacy Invoice"></top-bar>
                <!-- END: Top Bar -->
                <div class="intro-y flex flex-col sm:flex-row items-center mt-8">
                    <h2 class="text-lg font-medium mr-auto">Pharmacy Invoice</h2>
                    <div class="w-full sm:w-auto flex mt-4 sm:mt-0">
                        <button class="btn btn-primary shadow-md mr-2" @click="print">Print</button>
                        <div class="dropdown ml-auto sm:ml-0">
                            <button class="dropdown-toggle btn px-2 box" aria-expanded="false" data-tw-toggle="dropdown">
                                <span class="w-5 h-5 flex items-center justify-center">
                                    <i class="w-4 h-4" data-feather="plus"></i>
                                </span>
                            </button>
                            <div class="dropdown-menu w-40">
                                <ul class="dropdown-content">

                                    <li>
                                        <a href="" class="dropdown-item">
                                            <i data-feather="file" class="w-4 h-4 mr-2"></i> Export PDF
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- BEGIN: Invoice -->
                <div class="intro-y box overflow-hidden mt-5" id="printMe">
                    <div class="border-b border-slate-200/60 dark:border-darkmode-400 text-center sm:text-left">
                        <div class="px-5 py-10 sm:px-20 sm:py-20">
                            <div class="text-primary font-semibold text-3xl">INVOICE</div>
                            <div class="mt-2">
                                Receipt <span class="font-medium">#{{ sale.invoice_number }}</span>
                            </div>
                            <div class="mt-1">{{ sale.created_at | moment("MMM Do, YYYY") }}</div>
                        </div>
                        <div class="flex flex-col lg:flex-row px-5 sm:px-20 pt-5 pb-5 sm:pb-10">
                            <div>
                                <div class="text-base text-slate-500">Customer Details</div>
                                <div class="text-lg font-medium text-primary mt-2">{{ sale.name }}</div>
                                <div class="mt-1">{{ sale.email }}</div>
                                <div class="mt-1">{{ sale.phone }}</div>
                            </div>
                            <div class="lg:text-right mt-10 lg:mt-0 lg:ml-auto">
                                <div class="text-base text-slate-500">Payment to</div>
                                <div class="text-lg font-medium text-primary mt-2">
                                    {{ facility.registered_facility_name }}
                                </div>
                                <div class="mt-1">
                                    {{ facility.physical_location + ", " + facility.postal_code }}
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="px-5 sm:px-16 py-10 sm:py-20">
                        <div class="overflow-x-auto">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th class="border-b-2 dark:border-darkmode-400 whitespace-nowrap">
                                            DESCRIPTION
                                        </th>
                                        <th class="border-b-2 dark:border-darkmode-400 text-center">
                                            USAGES
                                        </th>
                                        <th class="border-b-2 dark:border-darkmode-400 text-center">TIMES</th>
                                        <th class="border-b-2 dark:border-darkmode-400 text-center">QTY</th>
                                        <th class="border-b-2 dark:border-darkmode-400 text-center">PRICE</th>
                                        <th class="border-b-2 dark:border-darkmode-400 text-center">
                                            SUBTOTAL
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="cart in carts" :key="cart.id">
                                        <td class="border-b dark:border-darkmode-400">
                                            <div class="font-medium">{{ cart.product_name }}</div>
                                        </td>
                                        <td class="text-center border-b dark:border-darkmode-400 w-32"
                                            v-if="cart.product_type == 'Drug'">
                                            {{ cart.usages }}
                                        </td>
                                        <td class="text-center border-b dark:border-darkmode-400 w-32" v-else>
                                            -
                                        </td>
                                        <td class="text-center border-b dark:border-darkmode-400 w-32">
                                            <span v-if="cart.product_type == 'Drug'">{{ cart.times }}</span><span
                                                v-else>-</span>
                                        </td>
                                        <td class="text-center border-b dark:border-darkmode-400 w-32">
                                            {{ cart.product_qty }}
                                        </td>
                                        <td class="text-center border-b dark:border-darkmode-400 w-32">
                                            &#8358;{{ cart.product_price | numeral("0,0.00") }}
                                        </td>
                                        <td class="text-center border-b dark:border-darkmode-400 w-32 font-medium">
                                            &#8358;{{ cart.sub_total | numeral("0,0.00") }}
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="px-5 sm:px-20 pb-10 sm:pb-20 flex flex-col-reverse sm:flex-row">
                        <div class="text-center sm:text-left mt-10 sm:mt-0">
                            <div class="mt-1">
                                <router-link :to="{ name: 'pos' }" class="btn btn-primary">Continue Shopping</router-link>
                                <button @click.prevent="confirmPayment" class="btn btn-success">
                                    Confirm Payment
                                </button>
                                <loading v-if="loading"></loading>
                            </div>
                        </div>
                        <div class="text-center sm:text-right sm:ml-auto">
                            <div class="text-base text-slate-500">Total Amount</div>
                            <div class="text-xl text-primary font-medium mt-2">
                                &#8358;{{ sale.amount | numeral("0,0.00") }}
                            </div>
                        </div>
                    </div>
                </div>
                <!-- END: Invoice -->
            </div>
            <!-- END: Content -->
        </div>
    </div>
</template>
<script>
export default {
    name: "invoice",
    data() {
        return {
            token: "",
            id: "",
            sale: "",
            facility: "",
            carts: [],
            loading: false,
        };
    },
    created() {
        this.login();
        this.getCustomerSale();
        this.getFacilitySignature();
        this.getCarts();
    },
    methods: {
        login() {
            if (!User.loggedIn()) {
                this.$router.push({
                    name: "logout",
                });
            } else {
                this.token = User.token();
                this.id = User.id();
            }
        },
        print() {
            // Pass the element id here
            this.$htmlToPaper("printMe");
        },
        getCustomerSale() {
            axios
                .get("/api/v1/customer-sale/" + this.id, {
                    headers: {
                        Authorization: "Bearer " + this.token,
                        Accept: "application/json",
                    },
                })
                .then((response) => (this.sale = response.data))
                .catch((error) => {
                    console.log(error);
                    if (error.response.status == 401) {
                        this.$router.push({
                            name: "logout",
                        });
                    }
                });
        },
        getFacilitySignature() {
            axios
                .get("/api/v1/facility-details/" + this.id, {
                    headers: {
                        Authorization: "Bearer " + this.token,
                        Accept: "application/json",
                    },
                })
                .then((response) => (this.facility = response.data))
                .catch((error) => {
                    console.log(error);
                    if (error.response.status == 401) {
                        this.$router.push({
                            name: "logout",
                        });
                    }
                });
        },
        getCarts() {
            axios
                .get("/api/v1/carts/" + this.id, {
                    headers: {
                        Authorization: "Bearer " + this.token,
                        Accept: "application/json",
                    },
                })
                .then((response) => (this.carts = response.data))
                .catch((error) => {
                    console.log(error);
                    if (error.response.status == 401) {
                        this.$router.push({
                            name: "logout",
                        });
                    }
                });
        },
        confirmPayment() {
            this.loading = true;
            axios
                .get("/api/v1/confirm-payment/" + this.id, {
                    headers: {
                        Authorization: "Bearer " + this.token,
                        Accept: "application/json",
                    },
                })
                .then(() => {
                    Toast.fire({
                        icon: "success",
                        title: "Payment confirmed successfully",
                    });
                    this.$router.push({
                        name: "pos",
                    });
                })
                .catch()
                .finally(() => {
                    this.loading = false;
                });
        },
    },
};
</script>
