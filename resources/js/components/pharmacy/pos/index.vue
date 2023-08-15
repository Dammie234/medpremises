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
                <top-bar title="POS"></top-bar>
                <!-- END: Top Bar -->
                <div class="grid grid-cols-12 gap-6 mt-3" v-if="facility.facility_type == 'Hospital' &&
                    hospital.onsite_pharmacy == true &&
                    prescribed_drugs.length != 0
                    ">
                    <div class="intro-y col-span-12 xxl:col-span-12 xl:col-span-12 box">
                        <div class="flex items-center p-5 border-b border-gray-200 dark:border-dark-5">
                            <h2 class="font-medium text-base mr-auto">
                                Patients with Prescribed Drugs
                            </h2>
                        </div>
                        <div class="overflow-x-auto p-5">
                            <table class="table table-sm table-bordered">
                                <thead>
                                    <tr>
                                        <th>Patient</th>
                                        <th>Drugs</th>
                                        <th>Prescribed By</th>
                                        <th>Prescribed Date</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="patient in prescribed_drugs" :key="patient.id">
                                        <td>{{ patient.name }}</td>
                                        <td v-html="patient.drugs"></td>
                                        <td>{{ patient.staff_name }}</td>
                                        <td>{{ patient.updated_at | moment("from", "now") }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="grid grid-cols-12 gap-6 mt-3" v-if="carts.length != 0">
                    <div class="intro-y col-span-12 xxl:col-span-9 xl:col-span-9">
                        <div class="intro-y box">
                            <div class="flex items-center p-5 border-b border-gray-200 dark:border-dark-5">
                                <h2 class="font-medium text-base mr-auto">Cart</h2>
                            </div>
                            <div class="p-5">
                                <div class="overflow-x-auto">
                                    <table class="table table-sm table-bordered mt-3">
                                        <thead>
                                            <tr>
                                                <th>Name</th>
                                                <th>Usages</th>
                                                <th>Times</th>
                                                <th>Qty</th>
                                                <th>Unit</th>
                                                <th>Total</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr v-for="cart in carts" :key="cart.id">
                                                <td>{{ cart.product_name }}</td>
                                                <td>
                                                    <input type="text" :value="cart.usages" readonly style="width: 35px"
                                                        v-if="cart.product_type == 'Drug'" />
                                                    <button @click.prevent="incrementUsage(cart.id)"
                                                        class="btn btn-success btn-sm" v-if="cart.product_type == 'Drug'">
                                                        +
                                                    </button>
                                                    <button @click.prevent="decrementUsage(cart.id)"
                                                        class="btn btn-danger btn-sm"
                                                        v-if="cart.product_type == 'Drug' && cart.usages >= 2">
                                                        -
                                                    </button>
                                                </td>
                                                <td>
                                                    <input type="text" :value="cart.times" readonly style="width: 35px"
                                                        v-if="cart.product_type == 'Drug'" />
                                                    <button @click.prevent="incrementTimes(cart.id)"
                                                        class="btn btn-success btn-sm" v-if="cart.product_type == 'Drug'">
                                                        +
                                                    </button>
                                                    <button @click.prevent="decrementTimes(cart.id)"
                                                        class="btn btn-danger btn-sm"
                                                        v-if="cart.product_type == 'Drug' && cart.times >= 2">
                                                        -
                                                    </button>
                                                </td>
                                                <td>
                                                    <input type="text" :value="cart.product_qty" readonly
                                                        style="width: 40px" />
                                                    <button @click.prevent="incrementQty(cart.id)"
                                                        class="btn btn-success btn-sm">
                                                        +
                                                    </button>
                                                    <button @click.prevent="decrementQty(cart.id)"
                                                        class="btn btn-danger btn-sm" v-if="cart.product_qty >= 2">
                                                        -
                                                    </button>
                                                </td>
                                                <td>&#8358;{{ cart.product_price | numeral("0,0.00") }}</td>
                                                <td>
                                                    &#8358;{{
                                                        (cart.product_price * cart.product_qty) | numeral("0,0.00")
                                                    }}
                                                </td>

                                                <td>
                                                    <a @click.prevent="removeCart(cart.id)" class="btn btn-danger btn-sm">
                                                        <font color="#fff">x</font>
                                                    </a>
                                                </td>
                                            </tr>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <td colspan="5" class="text-right">
                                                    <strong>Total Quantity:</strong>
                                                </td>
                                                <td>{{ sumQty }}</td>
                                                <td></td>
                                            </tr>
                                            <tr>
                                                <td colspan="5" class="text-right">
                                                    <strong>Total Cost:</strong>
                                                </td>
                                                <td>&#8358;{{ sumTotal | numeral("0,0.00") }}</td>
                                                <td></td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="intro-y col-span-12 xxl:col-span-3 xl:col-span-3">
                        <div class="intro-y box" v-if="facility.facility_type == 'Pharmaceutical Premises'">
                            <div class="flex items-center p-5 border-b border-gray-200 dark:border-dark-5">
                                <h2 class="font-medium text-base mr-auto">Customer</h2>
                            </div>
                            <div class="">
                                <div class="tabs" id="tabs">
                                    <div class="tabs-triggers">
                                        <div class="tabs-trigger" v-for="(item, index) in categories" :key="index"
                                            :class="[index === active ? 'tabs-trigger--active' : '']"
                                            @click="activate(index)">
                                            {{ categories[index] }}
                                        </div>
                                    </div>
                                    <div class="tabs-content" v-if="active === 0">
                                        <form class="input" @submit.prevent="processOrder">
                                            <div class="p-5" :disabled="loading">
                                                <vue-single-select name="maybe" placeholder="pick a customer"
                                                    you-want-to-select-a-post="ok" v-model="form.customer"
                                                    out-of-all-these-posts="makes sense" :options="customers"
                                                    :required="true" a-post-has-an-id="good for search and display"
                                                    the-post-has-a-title="make sure to show these"
                                                    option-label="name"></vue-single-select>
                                                <small class="text-danger font-medium text-xs mt-1" v-if="errors.customer">
                                                    {{ errors.customer[0] }}
                                                </small>
                                                <div class="mt-3">
                                                    <label for="amount" class="form-label">Amount</label>
                                                    <input id="amount" type="text" class="form-control"
                                                        v-model="form.amount" disabled />
                                                    <div class="text-danger font-medium text-xs mt-1" v-if="errors.amount">
                                                        {{ errors.amount[0] }}
                                                    </div>
                                                </div>
                                                <div class="mt-3">
                                                    <label for="pay_by" class="form-label">Pay By</label>
                                                    <select id="pay_by" class="form-select" v-model="form.pay_by">
                                                        <option value="Hand Cash">Hand Cash</option>
                                                        <option value="Cheque">Cheque</option>
                                                        <option value="POS">POS</option>
                                                    </select>
                                                    <div class="text-danger font-medium text-xs mt-1" v-if="errors.pay_by">
                                                        {{ errors.pay_by[0] }}
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="mt-3">
                                                <button type="submit" class="btn btn-primary w-50 mt-3">
                                                    Process Cart
                                                </button>
                                                <loading v-if="loading == true"></loading>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="tabs-content" v-if="active === 1">
                                        <form class="input" @submit.prevent="processOrder">
                                            <div class="p-5" :disabled="loading">
                                                <div>
                                                    <label for="name" class="form-label">Customer</label>
                                                    <input id="name" type="text" class="form-control"
                                                        placeholder="Enter the Customer Name" v-model="form.name" />
                                                    <div class="text-danger font-medium text-xs mt-1" v-if="errors.name">
                                                        {{ errors.name[0] }}
                                                    </div>
                                                </div>
                                                <div class="mt-3">
                                                    <label for="email" class="form-label">Email Address</label>
                                                    <input id="email" type="text" class="form-control"
                                                        placeholder="Enter the Customer Email" v-model="form.email"
                                                        required />
                                                    <div class="text-danger font-medium text-xs mt-1" v-if="errors.email">
                                                        {{ errors.email[0] }}
                                                    </div>
                                                </div>
                                                <div class="mt-3">
                                                    <label for="phone" class="form-label">Phone Number</label>
                                                    <input id="phone" type="text" class="form-control"
                                                        placeholder="Enter the Customer Phone Number"
                                                        v-model="form.phone" />
                                                    <div class="text-danger font-medium text-xs mt-1" v-if="errors.phone">
                                                        {{ errors.phone[0] }}
                                                    </div>
                                                </div>
                                                <div class="mt-3">
                                                    <label for="amount" class="form-label">Amount</label>
                                                    <input id="amount" type="text" class="form-control"
                                                        v-model="form.amount" disabled />
                                                    <div class="text-danger font-medium text-xs mt-1" v-if="errors.amount">
                                                        {{ errors.amount[0] }}
                                                    </div>
                                                </div>
                                                <div class="mt-3">
                                                    <label for="pay_y" class="form-label">Pay By</label>
                                                    <select id="pay_by" class="form-select" v-model="form.pay_by">
                                                        <option value="Hand Cash">Hand Cash</option>
                                                        <option value="Cheque">Cheque</option>
                                                        <option value="POS">POS</option>
                                                    </select>
                                                    <div class="text-danger font-medium text-xs mt-1" v-if="errors.pay_by">
                                                        {{ errors.pay_by[0] }}
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="mt-3">
                                                <button type="submit" class="btn btn-primary w-50">
                                                    Process Cart
                                                </button>
                                                <loading v-if="loading == true"></loading>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="intro-y box" v-else>
                            <form @submit.prevent="processOrderHospital" class="input">
                                <div class="p-5" :disabled="loading">
                                    <div>
                                        <label for="patient">Patient</label>
                                        <vue-single-select name="maybe" placeholder="pick a patient"
                                            you-want-to-select-a-post="ok" v-model="form.patient"
                                            out-of-all-these-posts="makes sense" :options="prescribed_drugs"
                                            :required="true" option-label="name"></vue-single-select>
                                        <small class="text-danger font-medium text-xs mt-1" v-if="errors.customer">
                                            {{ errors.customer[0] }}
                                        </small>
                                    </div>
                                    <div class="mt-3">
                                        <label for="amount" class="form-label">Amount</label>
                                        <input id="amount" type="text" class="form-control" v-model="form.amount"
                                            disabled />
                                        <div class="text-danger font-medium text-xs mt-1" v-if="errors.amount">
                                            {{ errors.amount[0] }}
                                        </div>
                                    </div>
                                    <div class="mt-3">
                                        <label for="">Payment Type</label>
                                        <div class="flex flex-col sm:flex-row mt-2">
                                            <div class="form-check mr-2">
                                                <input id="pay_now" class="form-check-input" type="radio"
                                                    name="payment_type" v-model="form.payment_type" value="Pay Now" />
                                                <label class="form-check-label" for="pay_now">Pay Now</label>
                                            </div>
                                            <div class="form-check">
                                                <input id="invoice" class="form-check-input" type="radio"
                                                    name="payment_type" v-model="form.payment_type"
                                                    value="Add to Invoice" />
                                                <label class="form-check-label" for="invoice">Add to Invoice</label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mt-3" v-if="form.payment_type == 'Pay Now'">
                                        <label for="pay_by" class="form-label">Pay By</label>
                                        <select id="pay_by" class="form-select" v-model="form.pay_by">
                                            <option value="Hand Cash">Hand Cash</option>
                                            <option value="Cheque">Cheque</option>
                                            <option value="POS">POS</option>
                                        </select>
                                        <div class="text-danger font-medium text-xs mt-1" v-if="errors.pay_by">
                                            {{ errors.pay_by[0] }}
                                        </div>
                                    </div>
                                </div>
                                <div class="mt-3 p-5">
                                    <button type="submit" class="btn btn-primary w-50">Process Cart</button>
                                    <loading v-if="loading == true"></loading>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="grid grid-cols-12 gap-6 mt-4">
                    <div class="intro-y col-span-12 xxl:col-span-6 xl:col-span-6">
                        <div class="intro-y box">
                            <div class="flex flex-col sm:flex-row items-center p-5 border-b border-slate-200/60">
                                <h2 class="font-medium text-base mr-auto">Drugs</h2>
                            </div>
                            <div class="p-5">
                                <div class="grid grid-cols-12 gap-x-5">
                                    <div class="col-span-12 xl:col-span-12 mt-3">
                                        <div v-if="drugs.length != 0">
                                            <div class="w-full sm:w-auto sm:ml-auto mt-3 sm:mt-0">
                                                <input class="form-control mr-0 ml-3" type="text" v-model="drug"
                                                    placeholder="Seach Drug Name" />
                                            </div>
                                            <div class="overflow-x-auto">
                                                <table class="table table-sm table-bordered mt-3">
                                                    <thead>
                                                        <tr>
                                                            <th>Name</th>
                                                            <th>Counting</th>
                                                            <th>Total Quantity</th>
                                                            <th>Price</th>

                                                            <th>Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr v-for="drug in searchDrug" :key="drug.id">
                                                            <td>
                                                                <span v-if="drug.total_quantity <= 5"
                                                                    class="text-danger font-medium leading-none">
                                                                    <s>{{ drug.name }}</s></span><span v-else>{{ drug.name
                                                                    }}</span>
                                                            </td>
                                                            <td>
                                                                <span v-if="drug.counting == false"
                                                                    class="red white-text padding-5 medium-small">No</span>
                                                                <span v-else>
                                                                    <span
                                                                        class="green white-text padding-5 medium-small">Yes</span>
                                                                    {{ drug.minimum_counts }}</span>
                                                            </td>

                                                            <td>
                                                                <span v-if="drug.total_quantity <= 5"
                                                                    class="text-danger font-medium leading-none"><s>{{
                                                                        drug.total_quantity }}</s></span>
                                                                <span v-else>{{ drug.total_quantity }}</span>
                                                            </td>
                                                            <td>
                                                                <span v-if="drug.total_quantity <= 5"
                                                                    class="text-danger font-medium leading-none"><s>&#8358;{{
                                                                        drug.price | numeral("0,0.00") }}</s></span>
                                                                <span v-else>&#8358;{{ drug.price | numeral("0,0.00")
                                                                }}</span>
                                                            </td>

                                                            <td>
                                                                <button class="btn btn-primary btn-sm"
                                                                    @click.prevent="addToCart(drug.drug_id, 'Drug')">
                                                                    <i class="fas fa-cart-plus"></i>
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
                                                <strong class="mr-2"> Whoops! </strong> There are no drug added
                                                yet
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
                    <div class="intro-y col-span-12 xxl:col-span-6 xl:col-span-6">
                        <div class="intro-y box">
                            <div class="flex flex-col sm:flex-row items-center p-5 border-b border-slate-200/60">
                                <h2 class="font-medium text-base mr-auto">Items</h2>
                            </div>
                            <div class="p-5">
                                <div class="grid grid-cols-12 gap-x-5">
                                    <div class="col-span-12 xl:col-span-12 mt-3">
                                        <div v-if="items.length != 0">
                                            <div class="w-full sm:w-auto sm:ml-auto mt-3 sm:mt-0">
                                                <input class="form-control mr-0 ml-3" type="text" v-model="item"
                                                    placeholder="Seach Item Name" />
                                            </div>
                                            <div class="overflow-x-auto">
                                                <table class="table table-sm table-bordered mt-3">
                                                    <thead>
                                                        <tr>
                                                            <th>Name</th>

                                                            <th>Total Quantity</th>
                                                            <th>Price</th>

                                                            <th>Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr v-for="item in searchItem" :key="item.id">
                                                            <td>
                                                                <span v-if="item.total_quantity <= 5"
                                                                    class="text-danger font-medium leading-none">
                                                                    <s>{{ item.name }}</s></span><span v-else>{{ item.name
                                                                    }}</span>
                                                            </td>

                                                            <td>
                                                                <span v-if="item.total_quantity <= 5"
                                                                    class="text-danger font-medium leading-none"><s>{{
                                                                        item.total_quantity }}</s></span>
                                                                <span v-else>{{ item.total_quantity }}</span>
                                                            </td>
                                                            <td>
                                                                <span v-if="item.total_quantity <= 5"
                                                                    class="text-danger font-medium leading-none"><s>&#8358;{{
                                                                        item.price | numeral("0,0.00") }}</s></span>
                                                                <span v-else>&#8358;{{ item.price | numeral("0,0.00")
                                                                }}</span>
                                                            </td>

                                                            <td>
                                                                <button class="btn btn-primary btn-sm"
                                                                    @click.prevent="addToCart(item.item_id, 'Item')">
                                                                    <i class="fas fa-cart-plus"></i>
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
                                                <strong class="mr-2"> Whoops! </strong> There are no drug added
                                                yet
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
    name: "pos",
    data() {
        return {
            id: "",
            token: "",
            drugs: [],
            items: [],
            item: "",
            drug: "",
            carts: [],
            form: {
                name: "",
                amount: "",
                email: "",
                pay_by: "",
                phone: "",
                customer: "",
                patient: "",
                payment_type: "",
                token: "",
            },
            errors: {},
            loading: false,
            active: 0,
            categories: ["Existing Customer", "New Customer"],
            customers: [],
            prescribed_drugs: [],
            facility: "",
            hospital: "",
        };
    },
    computed: {
        searchDrug() {
            let str = this.drug;
            let string = str.charAt(0).toUpperCase() + str.slice(1);
            return this.drugs.filter((drug) => {
                return drug.name.match(string);
            });
        },
        searchItem() {
            let str = this.item;
            let string = str.charAt(0).toUpperCase() + str.slice(1);
            return this.items.filter((item) => {
                return item.name.match(string);
            });
        },
        sumQty() {
            let total = 0;
            for (let i = 0; i < this.carts.length; i++) {
                total += parseFloat(this.carts[i].product_qty);
            }
            return total;
        },
        sumTotal() {
            let total = 0;
            for (let i = 0; i < this.carts.length; i++) {
                total +=
                    parseFloat(this.carts[i].product_qty) * parseFloat(this.carts[i].product_price);
            }
            this.form.amount = total;
            return total;
        },
    },
    created() {
        this.login();
        this.getItems();
        this.getDrugs();
        this.getCarts();
        Reload.$on("AfterAdd", () => {
            this.getCarts();
        });
        this.getCustomerSale();
        this.getCustomers();
        this.getPrescribedDrugs();
        this.getHospitalClass();
        this.getFacilitySignature();
    },
    methods: {
        activate(index) {
            this.active = index;
        },
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
        getCustomers() {
            axios
                .get("/api/v1/customers/" + this.id, {
                    headers: {
                        Authorization: "Bearer " + this.token,
                        Accept: "application/json",
                    },
                })
                .then((response) => (this.customers = response.data))
                .catch((error) => {
                    console.log(error);
                    if (error.response.status == 401) {
                        this.$router.push({
                            name: "logout",
                        });
                    }
                });
        },
        getItems() {
            axios
                .get("/api/v1/item-stocks/" + this.id, {
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
        getDrugs() {
            axios
                .get("/api/v1/drug-stocks/" + this.id, {
                    headers: {
                        Authorization: "Bearer " + this.token,
                        Accept: "application/json",
                    },
                })
                .then((response) => (this.drugs = response.data))
                .catch((error) => {
                    console.log(error);
                    if (error.response.status == 401) {
                        this.$router.push({
                            name: "logout",
                        });
                    }
                });
        },
        getPrescribedDrugs() {
            axios
                .get("/api/v1/patient-prescribed-drugs-within-facility/" + this.id, {
                    headers: {
                        Authorization: "Bearer " + this.token,
                        Accept: "application/json",
                    },
                })
                .then((response) => (this.prescribed_drugs = response.data))
                .catch((error) => {
                    console.log(error);
                    if (error.response.status == 401) {
                        this.$router.push({
                            name: "logout",
                        });
                    }
                });
        },
        addToCart(id, type) {
            axios
                .get("/api/v1/add-to-cart/" + id + "/" + type + "/" + this.id, {
                    headers: {
                        Authorization: "Bearer " + this.token,
                        Accept: "application/json",
                    },
                })
                .then(() => {
                    Reload.$emit("AfterAdd");
                    Toast.fire({
                        icon: "success",
                        title: "Cart successfully updated",
                    });
                })
                .catch();
        },
        removeCart(id) {
            axios
                .get("/api/v1/remove-cart/" + id + "/" + this.id, {
                    headers: {
                        Authorization: "Bearer " + this.token,
                        Accept: "application/json",
                    },
                })
                .then(() => {
                    Reload.$emit("AfterAdd");
                    Toast.fire({
                        icon: "success",
                        title: "Cart successfully deleted",
                    });
                })
                .catch();
        },
        incrementQty(id) {
            axios
                .get("/api/v1/increment-qty/" + id + "/" + this.id, {
                    headers: {
                        Authorization: "Bearer " + this.token,
                        Accept: "application/json",
                    },
                })
                .then(() => {
                    Reload.$emit("AfterAdd");
                    Toast.fire({
                        icon: "success",
                        title: "Cart successfully updated",
                    });
                })
                .catch();
        },
        decrementQty(id) {
            axios
                .get("/api/v1/decrement-qty/" + id + "/" + this.id, {
                    headers: {
                        Authorization: "Bearer " + this.token,
                        Accept: "application/json",
                    },
                })
                .then(() => {
                    Reload.$emit("AfterAdd");
                    Toast.fire({
                        icon: "success",
                        title: "Cart successfully updated",
                    });
                })
                .catch();
        },
        incrementUsage(id) {
            axios
                .get("/api/v1/increment-usage/" + id + "/" + this.id, {
                    headers: {
                        Authorization: "Bearer " + this.token,
                        Accept: "application/json",
                    },
                })
                .then(() => {
                    Reload.$emit("AfterAdd");
                    Toast.fire({
                        icon: "success",
                        title: "Cart successfully updated",
                    });
                })
                .catch();
        },
        decrementUsage(id) {
            axios
                .get("/api/v1/decrement-usage/" + id + "/" + this.id, {
                    headers: {
                        Authorization: "Bearer " + this.token,
                        Accept: "application/json",
                    },
                })
                .then(() => {
                    Reload.$emit("AfterAdd");
                    Toast.fire({
                        icon: "success",
                        title: "Cart successfully updated",
                    });
                })
                .catch();
        },
        incrementTimes(id) {
            axios
                .get("/api/v1/increment-times/" + id + "/" + this.id, {
                    headers: {
                        Authorization: "Bearer " + this.token,
                        Accept: "application/json",
                    },
                })
                .then(() => {
                    Reload.$emit("AfterAdd");
                    Toast.fire({
                        icon: "success",
                        title: "Cart successfully updated",
                    });
                })
                .catch();
        },
        decrementTimes(id) {
            axios
                .get("/api/v1/decrement-times/" + id + "/" + this.id, {
                    headers: {
                        Authorization: "Bearer " + this.token,
                        Accept: "application/json",
                    },
                })
                .then(() => {
                    Reload.$emit("AfterAdd");
                    Toast.fire({
                        icon: "success",
                        title: "Cart successfully updated",
                    });
                })
                .catch();
        },
        getHospitalClass() {
            axios
                .get("/api/v1/hospital-class/" + this.id, {
                    headers: {
                        Authorization: "Bearer " + this.token,
                        Accept: "application/json",
                    },
                })
                .then((response) => (this.hospital = response.data))
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
        processOrder() {
            this.loading = true;
            this.form.token = User.token();
            axios
                .patch("/api/process-order/" + this.id, this.form)
                .then(() => {
                    this.$router.push({
                        name: "pharmacy-invoice",
                    });
                    Toast.fire({
                        icon: "success",
                        title: "Order processed successfully",
                    });
                })
                .catch((error) => (this.errors = error.response.data.errors))
                .catch((error) => {
                    this.error = true;
                    console.log(error);
                    if (error.response.status == 401) {
                        Toast.fire({
                            icon: "warning",
                            title: "Stock before processing",
                        });
                    }
                })
                .finally(() => {
                    this.loading = false;
                });
        },
        processOrderHospital() {
            this.loading = true;
            this.form.token = User.token();
            axios
                .patch("/api/process-order/" + this.id, this.form)
                .then(() => {
                    this.$router.push({
                        name: "pos",
                    });

                    Toast.fire({
                        icon: "success",
                        title: "Order processed successfully",
                    });
                })
                .catch((error) => (this.errors = error.response.data.errors))
                .catch((error) => {
                    this.error = true;
                    console.log(error);
                    if (error.response.status == 401) {
                        Toast.fire({
                            icon: "warning",
                            title: "Stock before processing",
                        });
                    }
                })
                .finally(() => {
                    this.loading = false;
                });
        },
        getCustomerSale() {
            axios
                .get("/api/v1/customer-sale/" + this.id, {
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
    },
};
</script>
<style scoped>
.text-danger {
    color: #f00;
}

.success {
    background: #0f0;
    padding: 5px 15px;
    color: #fff;
    margin-top: 3px;
}

.tabs {
    position: relative;
    width: 100%;
    height: 100%;
    background-color: #fff;
}

.tabs-triggers {
    display: flex;
}

.tabs-trigger {
    flex: 1 0 auto;
    margin: 0;
    padding: 1rem;
    background-color: #686963;
    font-weight: bold;
    transition: 100ms linear all;
    cursor: pointer;
}

.tabs-trigger--active {
    background-color: #fff;
    color: #bc4b51;
}

.tabs-content {
    padding: 1rem;
    background-color: #fff;
}
</style>
