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
                <top-bar title="Item Inflows Archive"></top-bar>
                <!-- END: Top Bar -->

                <div class="grid grid-cols-12 gap-6 mt-4">
                    <div class="intro-y col-span-12 xxl:col-span-12">
                        <div class="intro-y box">
                            <div class="grid grid-cols-12 gap-x-5 p-5 border-b border-slate-200/60">
                                <div class="col-span-12 xl:col-span-4">
                                    <h2 class="font-medium text-base mr-auto">
                                        Item Inflows for {{ date | moment("Do MMMM, YYYY") }}
                                    </h2>
                                </div>
                                <div class="col-span-12 xl:col-span-8">
                                    <div class="flex flex-col sm:flex-row gap-x-5">
                                        <div class="w-full flex flex-col">
                                            <label class="form-check-label mb-2" for="drug">Search Inflow Item Archive By
                                                Date</label>
                                            <input id="month" class="form-control" type="date" v-model="new_date"
                                                @change="archiveDate" placeholder="Search Inflow Drug Archive" />
                                        </div>
                                        <div class="w-full flex flex-col">
                                            <label class="form-check-label mb-2" for="month">
                                                Search Inflow Item Archive By Month</label>
                                            <input id="month" class="form-control" type="month" v-model="month"
                                                @change="archiveMonth" placeholder="Search Inflow Drug Archive" />
                                        </div>
                                        <div class="w-full flex flex-col" v-if="stocks.length > 5">
                                            <label class="form-check-label mb-2" for="month">
                                                Search Item By Name</label>
                                            <input class="form-control" type="text" v-model="search"
                                                placeholder="Seach Item Name" />
                                        </div>
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
                                                        <tr class="text-xs uppercase">
                                                            <th></th>
                                                            <th>Name</th>

                                                            <th>Mfg. Date</th>
                                                            <th>Exp. Date</th>
                                                            <th>Added By</th>
                                                            <th>Added At</th>

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
                                                            <td>{{ stock.name }}</td>

                                                            <td>{{ stock.mfg_date | moment("MM/YY") }}</td>
                                                            <td>{{ stock.exp_date | moment("MM/YY") }}</td>
                                                            <td>{{ stock.added_by }}</td>
                                                            <td>
                                                                {{ stock.created_at | moment("MMMM Do YYYY, h:mm:ss a") }}
                                                            </td>

                                                            <td>{{ stock.total_quantity }}</td>
                                                            <td>
                                                                &#8358;{{ stock.purchase_price | numeral("0,0.00") }}
                                                            </td>
                                                            <td>&#8358;{{ stock.price | numeral("0,0.00") }}</td>
                                                            <td>
                                                                &#8358;{{
                                                                    (stock.price - stock.purchase_price) | numeral("0,0.00")
                                                                }}
                                                            </td>
                                                            <td>
                                                                &#8358;{{
                                                                    ((stock.price - stock.purchase_price) *
                                                                        stock.total_quantity)
                                                                    | numeral("0,0.00")
                                                                }}
                                                            </td>
                                                            <td>
                                                                &#8358;{{
                                                                    (stock.price * stock.total_quantity) | numeral("0,0.00")
                                                                }}
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
                                                <strong class="mr-2"> Whoops! </strong> There are no item stock
                                                inflow archive
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
    name: "item-inflows",
    data() {
        return {
            id: null,
            token: null,
            stocks: [],
            search: "",
            month: "",
            new_date: "",
            date: "",
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
        this.getStock();
    },
    methods: {
        login() {
            if (!User.loggedIn()) {
                document.location.href = "/";
            } else {
                this.id = User.id();
                this.token = User.token();
                this.date = this.$route.params.date;
            }
        },
        archiveDate() {
            let date = this.new_date;
            this.$router.push({
                path: `/pharmacy/item/inflows/dates/${date}`,
            });
            this.getStock();
        },
        archiveMonth() {
            this.$router.push({
                path: `/pharmacy/item/inflows/months/${this.month}`,
            });
        },
        getStock() {
            this.date = this.$route.params.date;
            axios
                .get("/api/v1/item-inflows/" + this.id + "/" + this.date, {
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
