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
                <top-bar title="Item Stock"></top-bar>
                <!-- END: Top Bar -->

                <div class="grid grid-cols-12 gap-6" v-if="add_stock">
                    <div class="intro-y col-span-12 xxl:col-span-12">
                        <div class="intro-y box">
                            <div class="flex items-center p-5 border-b border-gray-200 dark:border-dark-5">
                                <h2 class="font-medium text-base mr-auto">Add Item Stock</h2>
                            </div>
                            <form class="input p-5" @submit.prevent="store">
                                <div class="grid grid-cols-12 gap-x-5" :disabled="loading">
                                    <div class="col-span-12 xl:col-span-4 mt-3">
                                        <label for="item" class="form-label">Item</label>
                                        <v-select :options="items" label="name" required
                                            @input="(item) => updateItem(form, item)"></v-select>
                                        <div class="text-danger font-medium text-xs mt-1" v-if="errors.item">
                                            {{ errors.item[0] }}
                                        </div>
                                    </div>
                                    <div class="col-span-12 xl:col-span-2 mt-3">
                                        <label for="pack" class="form-label">Number of Pieces</label>
                                        <input id="pack" type="number" class="form-control"
                                            placeholder="Enter the Number of Pieces" v-model="form.pack" />
                                        <div class="text-danger font-medium text-xs mt-1" v-if="errors.pack">
                                            {{ errors.pack[0] }}
                                        </div>
                                    </div>
                                    <div class="col-span-12 xl:col-span-3 mt-3">
                                        <label for="purchase_price" class="form-label">Purchase Price of Each Piece</label>
                                        <input id="purchase_price" type="number" class="form-control"
                                            placeholder="Input the item purchase price" v-model="form.purchase_price" />
                                        <div class="text-danger font-medium text-xs mt-1" v-if="errors.purchase_price">
                                            {{ errors.purchase_price[0] }}
                                        </div>
                                    </div>
                                    <div class="col-span-12 xl:col-span-3 mt-3">
                                        <label for="price" class="form-label">Selling Price of Each Piece</label>
                                        <input id="price" type="number" class="form-control"
                                            placeholder="Input the item price" v-model="form.price" />
                                        <div class="text-danger font-medium text-xs mt-1" v-if="errors.price">
                                            {{ errors.price[0] }}
                                        </div>
                                    </div>

                                    <div class="col-span-12 xl:col-span-3 mt-3">
                                        <label for="mfg_date" class="form-label">Mfg. Date</label>
                                        <input id="mfg_date" type="date" class="form-control" placeholder=""
                                            v-model="form.mfg_date" />
                                        <div class="text-danger font-medium text-xs mt-1" v-if="errors.mfg_date">
                                            {{ errors.mfg_date[0] }}
                                        </div>
                                    </div>
                                    <div class="col-span-12 xl:col-span-3 mt-3">
                                        <label for="exp_date" class="form-label">Exp. Date</label>
                                        <input id="exp_date" type="date" class="form-control" placeholder=""
                                            v-model="form.exp_date" />
                                        <div class="text-danger font-medium text-xs mt-1" v-if="errors.exp_date">
                                            {{ errors.exp_date[0] }}
                                        </div>
                                    </div>
                                </div>
                                <div class="mt-3" v-if="parseInt(form.price) > parseInt(form.purchase_price)">
                                    <button type="submit" class="btn btn-primary w-20">Save</button>
                                    <loading v-if="loading == true"></loading>
                                </div>
                            </form>
                            <div class="p-5">
                                <div class="grid grid-cols-12">
                                    <div class="col-span-12 xl:col-span-12 mb-3 text-white text-center bg-danger p-3"
                                        v-if="parseInt(form.price) < parseInt(form.purchase_price)">
                                        <strong>Whoops!</strong> The purchase price must be less than the
                                        actual price.
                                    </div>
                                    <div class="col-span-12 xl:col-span-4" v-if="form.item_name != ''">
                                        <p><small>Item Name</small><br />{{ form.item_name }}</p>
                                    </div>
                                    <div class="col-span-12 xl:col-span-2" v-if="form.pack != ''">
                                        <p><small>Pieces</small><br />{{ form.pack }}</p>
                                    </div>
                                    <div class="col-span-12 xl:col-span-2" v-if="form.pack != ''">
                                        <p><small>Total Quantity</small><br />{{ form.pack }}</p>
                                    </div>
                                    <div class="col-span-12 xl:col-span-2" v-if="form.pack != '' && form.price != ''">
                                        <p>
                                            <small>Price For Each Quantity</small><br />&#8358;{{
                                                form.price | numeral("0,0.00")
                                            }}
                                        </p>
                                    </div>
                                    <div class="col-span-12 xl:col-span-2 mb-3" v-if="form.pack != '' &&
                                            form.price != '' &&
                                            form.purchase_price != '' &&
                                            parseInt(form.price) > parseInt(form.purchase_price)
                                            ">
                                        <p>
                                            <small>Profit Per Quantity</small><br />&#8358;{{
                                                (form.price - form.purchase_price) | numeral("0,0.00")
                                            }}
                                        </p>
                                    </div>
                                    <div class="col-span-12 xl:col-span-2 mb-3" v-if="form.pack != '' &&
                                            form.price != '' &&
                                            form.purchase_price != '' &&
                                            parseInt(form.price) > parseInt(form.purchase_price)
                                            ">
                                        <p>
                                            <small>Total Profit </small><br />&#8358;{{
                                                ((form.price - form.purchase_price) * form.pack)
                                                | numeral("0,0.00")
                                            }}
                                        </p>
                                    </div>
                                    <div class="col-span-12 xl:col-span-2" v-if="form.pack != '' && form.price != ''">
                                        <p>
                                            <small>Total</small><br />&#8358;{{
                                                (form.pack * form.price) | numeral("0,0.00")
                                            }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="grid grid-cols-12 gap-6 mt-4">
                    <div class="intro-y col-span-12 xxl:col-span-12">
                        <div class="intro-y box">
                            <div class="grid grid-cols-12 gap-x-5 p-5 border-b border-slate-200/60">
                                <div class="col-span-12 xl:col-span-8">
                                    <h2 class="font-medium text-base mr-auto">Item Stock</h2>
                                </div>
                                <div class="col-span-12 xl:col-span-4">
                                    <div class="flex flex-col sm:flex-row gap-x-5">
                                        <div class="w-full">
                                            <input v-if="stocks.length > 5" class="form-control" type="text"
                                                v-model="search" placeholder="Seach Item Name" />
                                        </div>
                                        <button class="btn btn-primary w-60 text-xs" @click="addStock">
                                            Add Stock
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <div class="p-5">
                                <div class="grid grid-cols-12 gap-x-5">
                                    <div class="col-span-12 xl:col-span-12 mt-3">
                                        <div v-if="stocks.length != 0">
                                            <div class="overflow-x-auto">
                                                <table class="table table-sm table-bordered">
                                                    <thead>
                                                        <tr>
                                                            <th></th>
                                                            <th>Name</th>

                                                            <th>Mfg. Date</th>
                                                            <th>Exp. Date</th>
                                                            <th>Added By</th>
                                                            <th>Modified At</th>

                                                            <th>Total Quantity</th>
                                                            <th>Purchase Price</th>
                                                            <th>Selling Price</th>
                                                            <th>Profit</th>
                                                            <th>Total Profit</th>
                                                            <th>Total</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr v-for="(stock, index) in filterSearch" :key="index">
                                                            <td>{{ index + 1 }}</td>
                                                            <td>
                                                                <span v-if="stock.total_quantity <= 5"
                                                                    class="text-danger font-medium leading-none"><s>{{
                                                                        stock.name }}</s></span><span v-else>{{ stock.name
    }}</span>
                                                            </td>

                                                            <td>
                                                                <span v-if="stock.total_quantity <= 5"
                                                                    class="text-danger font-medium leading-none"><s>{{
                                                                        stock.mfg_date | moment("MM/YY") }}</s></span><span
                                                                    v-else>{{
                                                                        stock.mfg_date | moment("MM/YY")
                                                                    }}</span>
                                                            </td>
                                                            <td>
                                                                <span v-if="stock.total_quantity <= 5"
                                                                    class="text-danger font-medium leading-none"><s>{{
                                                                        stock.exp_date | moment("MM/YY") }}</s></span><span
                                                                    v-else>{{
                                                                        stock.exp_date | moment("MM/YY")
                                                                    }}</span>
                                                            </td>
                                                            <td>
                                                                <span v-if="stock.total_quantity <= 5"
                                                                    class="text-danger font-medium leading-none"><s>{{
                                                                        stock.added_by }}</s></span><span v-else>{{
        stock.added_by }}</span>
                                                            </td>
                                                            <td>
                                                                <span v-if="stock.total_quantity <= 5"
                                                                    class="text-danger font-medium leading-none">
                                                                    <s>{{
                                                                        stock.updated_at | moment("from", "now")
                                                                    }}</s></span>
                                                                <span v-else>{{
                                                                    stock.updated_at | moment("from", "now")
                                                                }}</span>
                                                            </td>

                                                            <td>
                                                                <span v-if="stock.total_quantity <= 5"
                                                                    class="text-danger font-medium leading-none"><s>{{
                                                                        stock.total_quantity }}</s></span><span v-else>{{
        stock.total_quantity }}</span>
                                                            </td>
                                                            <td>
                                                                <span v-if="stock.total_quantity <= 5"
                                                                    class="text-danger font-medium leading-none"><s>&#8358;{{
                                                                        stock.purchase_price | numeral("0,0.00")
                                                                    }}</s></span><span v-else>&#8358;{{
    stock.purchase_price | numeral("0,0.00")
}}</span>
                                                            </td>
                                                            <td>
                                                                <span v-if="stock.total_quantity <= 5"
                                                                    class="text-danger font-medium leading-none"><s>&#8358;{{
                                                                        stock.price | numeral("0,0.00") }}</s></span><span
                                                                    v-else>&#8358;{{ stock.price | numeral("0,0.00")
                                                                    }}</span>
                                                            </td>
                                                            <td>
                                                                <span v-if="stock.total_quantity <= 5"
                                                                    class="text-danger font-medium leading-none"><s>&#8358;{{
                                                                        (stock.price - stock.purchase_price)
                                                                        | numeral("0,0.00")
                                                                    }}</s></span><span v-else>&#8358;{{
    (stock.price - stock.purchase_price)
    | numeral("0,0.00")
}}</span>
                                                            </td>
                                                            <td>
                                                                <span v-if="stock.total_quantity <= 5"
                                                                    class="text-danger font-medium leading-none"><s>&#8358;{{
                                                                        ((stock.price - stock.purchase_price) *
                                                                            stock.total_quantity)
                                                                        | numeral("0,0.00")
                                                                    }}</s></span><span v-else>&#8358;{{
    ((stock.price - stock.purchase_price) *
        stock.total_quantity)
    | numeral("0,0.00")
}}</span>
                                                            </td>
                                                            <td>
                                                                <span v-if="stock.total_quantity <= 5"
                                                                    class="text-danger font-medium leading-none"><s>&#8358;{{
                                                                        (stock.price * stock.total_quantity)
                                                                        | numeral("0,0.00")
                                                                    }}</s></span><span v-else>&#8358;{{
    (stock.price * stock.total_quantity)
    | numeral("0,0.00")
}}</span>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                    <tfoot>
                                                        <tr>
                                                            <td colspan="10" class="text-right">Total:</td>
                                                            <td>&#8358;{{ computeProfit | numeral("0,0.00") }}</td>
                                                            <td>&#8358;{{ computeTotal | numeral("0,0.00") }}</td>
                                                        </tr>
                                                    </tfoot>
                                                </table>
                                            </div>
                                        </div>
                                        <div v-else>
                                            <div class="alert alert-outline-danger alert-dismissible show flex items-center mb-2"
                                                role="alert">
                                                <i data-feather="alert-octagon"
                                                    class="fa fa-exclamation-circle fa-2x mr-2"></i>
                                                <strong class="mr-2"> Whoops! </strong> There are no item stocks
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
    name: "item-stocks",
    data() {
        return {
            id: null,
            token: null,
            loading: false,
            add_stock: false,
            form: {
                item: "",
                item_name: "",
                stock_type: "Item",
                pack: "",
                price: "",
                purchase_price: "",
                mfg_date: "",
                exp_date: "",
                user_id: "",
            },
            errors: {},
            items: [],
            stocks: [],
            search: "",
        };
    },
    computed: {
        filterSearch() {
            let str = this.search;
            let string = str.charAt(0).toUpperCase() + str.slice(1);
            return this.stocks.filter((stock) => {
                return stock.name.match(string);
            });
        },
        computeTotal() {
            let stocks = this.stocks;
            let total = 0;
            stocks.forEach((stock) => {
                total += stock.total_quantity * stock.price;
            });
            return total;
        },
        computeProfit() {
            let stocks = this.stocks;
            let total = 0;
            stocks.forEach((stock) => {
                total += stock.total_quantity * (stock.price - stock.purchase_price);
            });
            return total;
        },
    },
    created() {
        this.login();
        this.getItems();
        this.getStock();
    },
    methods: {
        login() {
            if (!User.loggedIn()) {
                document.location.href = "/";
            } else {
                this.id = User.id();
                this.token = User.token();
                this.form.user_id = User.id();
            }
        },
        addStock() {
            if (!this.add_stock) {
                this.add_stock = true;
            } else {
                this.add_stock = false;
            }
        },
        updateItem(form, item) {
            form.item = item.id;
            form.item_name = item.name;
        },
        store() {
            this.loading = true;
            axios
                .post("/api/stock", this.form)
                .then(() => {
                    this.$router.push({
                        name: "item-stock",
                    });
                    this.form = {};
                    this.getItems();
                    this.getStock();

                    this.login();
                    this.add_stock = false;
                    Toast.fire({
                        icon: "success",
                        title: "Stock successfully updated",
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
        getStock() {
            axios
                .get("/api/v1/item-stocks/" + this.id, {
                    headers: {
                        Authorization: "Bearer " + this.token,
                        Accept: "application/json",
                    },
                })
                .then((response) => (this.stocks = response.data))
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
</style>
