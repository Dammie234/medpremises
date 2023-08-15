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
                <top-bar title="Item Stock Outflow Archive"></top-bar>
                <!-- END: Top Bar -->

                <div class="grid grid-cols-12 gap-6 mt-4">
                    <div class="intro-y col-span-12 xxl:col-span-12 xl:col-span-12">
                        <div class="intro-y box">
                            <div class="flex flex-col sm:flex-row items-center p-5 border-b border-slate-200/60">
                                <h2 class="font-medium text-base mr-auto">
                                    Item Stock Outflow Archive for {{ month | moment("MMMM, YYYY") }}
                                </h2>
                                <div class="w-full sm:w-auto sm:ml-auto xl:w-auto xl:ml-auto mt-3 sm:mt-0"
                                    v-if="stocks.length != 0">
                                    <label class="form-check-label ml-0" for="date">Search Item By Name</label>
                                    <input id="date" class="form-control mr-0" type="date" v-model="date"
                                        @change="archiveDate" />
                                </div>
                                <div class="w-full sm:w-auto sm:ml-auto xl:w-auto mt-3 xl:ml-auto sm:mt-0">
                                    <label class="form-check-label ml-0" for="month">
                                        Search Outflow Item Archive</label>
                                    <input id="month" class="form-control mr-0 ml-3" type="month" v-model="new_month"
                                        @change="archiveMonth" />
                                </div>
                            </div>
                            <div class="p-5">
                                <div class="grid grid-cols-12 gap-x-5">
                                    <div class="col-span-12 xl:col-span-12" v-if="stocks.length > 5">
                                        <input class="form-control mr-0 ml-3" id="item" type="text" v-model="search"
                                            placeholder="Search Item By Name" />
                                    </div>
                                    <div class="col-span-12 xl:col-span-12 mt-3">
                                        <div v-if="stocks.length != 0">
                                            <div class="overflow-x-auto">
                                                <table class="table table-sm table-bordered">
                                                    <thead>
                                                        <tr class="text-xs uppercase">
                                                            <th>Name</th>
                                                            <th>Added By</th>
                                                            <th>Sold At</th>
                                                            <th>Quantity</th>
                                                            <th>Purchase Price</th>
                                                            <th>Selling Price</th>
                                                            <th>Profit</th>
                                                            <th>Total Profit</th>
                                                            <th>Total</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <tr v-for="stock in filterSearch" :key="stock.id">
                                                            <td>{{ stock.name }}</td>

                                                            <td>
                                                                {{ stock.added_by }}
                                                            </td>
                                                            <td>
                                                                {{ stock.created_at | moment("MMMM Do YYYY, h:mm:ss a") }}
                                                            </td>

                                                            <td>
                                                                {{ stock.qty }}
                                                            </td>
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
                                                                    ((stock.price - stock.purchase_price) * stock.qty)
                                                                    | numeral("0,0.00")
                                                                }}
                                                            </td>
                                                            <td>
                                                                &#8358;{{ (stock.price * stock.qty) | numeral("0,0.00") }}
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                    <tfoot>
                                                        <tr>
                                                            <td colspan="7" class="text-right">Total:</td>
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
                                                outflow archive
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
    name: "item outflows archive",
    data() {
        return {
            id: null,
            token: null,
            stocks: [],
            search: "",
            month: "",
            new_month: "",
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
                total += stock.qty * stock.price;
            });
            return total;
        },
        computeProfit() {
            let stocks = this.stocks;
            let total = 0;
            stocks.forEach((stock) => {
                total += stock.qty * (stock.price - stock.purchase_price);
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
                this.month = this.$route.params.month;
            }
        },
        archiveDate() {
            let date = this.date;
            this.$router.push({
                path: `/pharmacy/item/inflows/dates/${date}`,
            });
        },
        archiveMonth() {
            let month = this.new_month;
            this.$router.push({
                path: `/pharmacy/item/outflows/months/${month}`,
            });
            this.getStock();
        },
        getStock() {
            let month = this.$route.params.month;
            axios
                .get("/api/v1/item-outflows/" + this.id + "/" + month, {
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
</style>
