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

                <top-bar title="Drug Stock Inflow Archive"></top-bar>
                <!-- END: Top Bar -->

                <div class="grid grid-cols-12 gap-6 mt-4">
                    <div class="intro-y col-span-12 xxl:col-span-12 xl:col-span-12">
                        <div class="intro-y box">
                            <div class="grid grid-cols-12 gap-x-5 p-5 border-b border-slate-200/60">
                                <div class="col-span-12 xl:col-span-4">
                                    <h2 class="font-medium text-base mr-auto">
                                        Drug Stock Inflow Archive for {{ month | moment("MMMM, YYYY") }}
                                    </h2>
                                </div>
                                <div class="col-span-12 xl:col-span-8">
                                    <div class="flex flex-col sm:flex-row gap-x-5">
                                        <div class="w-full flex flex-col">
                                            <label class="form-check-label ml-0" for="date">Search Drug Inflow By
                                                Date</label>
                                            <input id="date" class="form-control" type="date" v-model="date"
                                                @change="archiveDate" placeholder="Search Drug Sells By Date" />
                                        </div>
                                        <div class="w-full flex flex-col">
                                            <label class="form-check-label ml-0" for="month">
                                                Search Drug Inflow By Month</label>
                                            <input id="month" class="form-control mr-0 ml-3" type="month"
                                                v-model="new_month" @change="archiveMonth"
                                                placeholder="Search Inflow Drug Archive" />
                                        </div>
                                        <div class="w-full" v-if="stocks.length != 0">
                                            <label class="form-check-label ml-0" for="drug">
                                                Search Drug Inflow Stock By Name</label>
                                            <input class="form-control" id="drug" type="text" v-model="search"
                                                placeholder="Search Drug By Name" />
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="p-5">
                                <div class="grid grid-cols-12 gap-x-5">
                                    <div class="col-span-12 xl:col-span-12 mt-3">
                                        <div v-if="stocks.length != 0">
                                            <div class="overflow-x-auto">
                                                <table class="table table-xs table-bordered">
                                                    <thead>
                                                        <tr class="text-xs uppercase">
                                                            <th></th>
                                                            <th>Name</th>
                                                            <th>Counting</th>
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
                                                        <tr class="text-xs" v-for="(stock, index) in filterSearch"
                                                            :key="index">
                                                            <td>{{ index + 1 }}</td>
                                                            <td>{{ stock.name }}</td>
                                                            <td>
                                                                <span v-if="stock.counting == false"
                                                                    class="red white-text padding-5 medium-small">No</span>
                                                                <span v-else>
                                                                    <span
                                                                        class="green white-text padding-5 medium-small">Yes</span>
                                                                    {{ stock.minimum_counts }}</span>
                                                            </td>

                                                            <td>
                                                                {{ stock.mfg_date | moment("MM/YY") }}
                                                            </td>
                                                            <td>{{ stock.exp_date | moment("MM/YY") }}</td>
                                                            <td>
                                                                {{ stock.added_by }}
                                                            </td>
                                                            <td>
                                                                {{ stock.created_at | moment("MMMM Do YYYY, h:mm:ss a") }}
                                                            </td>

                                                            <td>
                                                                {{ stock.total_quantity }}
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
                                                            <td colspan="11" class="text-right">Total:</td>
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
                                                <strong class="mr-2"> Whoops! </strong> There are no drug stock
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
    name: "month-inflow",
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
                if (stock.counting) {
                    total += stock.total_quantity * stock.price - stock.price;
                }
                total += stock.total_quantity * stock.price;
            });
            return total;
        },
        computeProfit() {
            let stocks = this.stocks;
            let total = 0;
            stocks.forEach((stock) => {
                if (stock.counting) {
                    total +=
                        stock.total_quantity * (stock.price - stock.purchase_price) -
                        (stock.price - stock.purchase_price);
                }
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
                this.month = this.$route.params.month;
            }
        },
        archiveMonth() {
            let month = this.new_month;
            document.location.href = `/pharmacy/drug/inflows/months/${month}`;
        },
        archiveDate() {
            let date = this.date;
            this.$router.push({
                path: `/pharmacy/drug/inflows/dates/${date}`,
            });
        },

        getStock() {
            this.month = this.$route.params.month;
            axios
                .get("/api/v1/drug-inflows/" + this.id + "/" + this.month, {
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
