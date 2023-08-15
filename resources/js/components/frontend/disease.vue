<template>
<div class="py-5">
	<!-- BEGIN: Mobile Menu -->
	<frontend-mobile-menu></frontend-mobile-menu>
	<!-- END: Mobile Menu -->
	<!-- BEGIN: Top Bar -->
	<frontend-top-bar page="Diseases & Conditions"></frontend-top-bar>
	<!-- END: Top Bar -->
	<!-- BEGIN: Top Menu -->
	<top-nav v-if="token"></top-nav>
	<!-- END: Top Menu -->
	<!-- BEGIN: Content -->
	<div class="content">
		<div class="grid grid-cols-12 gap-6">
			<div class="col-span-12 xl:col-span-6 lh:col-span-6 mt-6">
				<div class="intro-y block sm:flex items-center h-10">
                    <h2 class="text-lg font-medium truncate mr-5">Diseases &amp; Conditions A - Z Index</h2>
                </div>
                <div class="intro-y block">
                    <a v-for="(letter, index) in letters" :key="index" class="btn btn-outline-dark w-12 inline-block mr-1 mb-2 uppercase"  :href="'/diseases-conditions/' + letter">{{letter}}</a>
                </div>
                <div class="intro-y box p-5">
                    <h2 class="text-lg font-medium truncate uppercase">{{letter}}</h2>
                    <input class="form-control mr-0" type="text" v-model="search" placeholder="Seach Diseases & Conditions">
                    <div class="overflow-x-auto mt-3">
                        <table class="table text-xs">
                       
                            <tbody v-if="search">
                                <tr v-for="(dis, index) in filterSearch" :key="index">
                                    <th>{{dis.name}}</th>
                                    <td><a :href="dis.url" target="_blank" style="color:#00f;">Learn More</a></td>
                                </tr>
                            </tbody>
                            <tbody v-else>
                                <tr v-for="(disease, index) in diseases" :key="index">
                                    <th>{{disease.name}}</th>
                                    <td><a :href="disease.url" target="_blank" style="color:#00f;">Learn More</a></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
			</div>
			<div class="col-span-12 xl:col-span-3 lg:col-span-3 mt-6">
                <laboratory></laboratory>
			</div>
            <div class="col-span-12 xl:col-span-3 lg:col-span-3 mt-6">
				<hospital></hospital>
			</div>
		</div>
	</div>
	<!-- END: Content -->
	
</div>
</template>
<script>

export default {
    name: 'diseases-conditions',
    data() {
        return {
            letter: '',
            letters: ['a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 'n', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z'],
            token: null,
            diseases: [],
            all_diseases: [],
            search: ''
			
        }
    },
    computed: {
        filterSearch() {
            let str = this.search
            let string = str.charAt(0).toUpperCase() + str.slice(1)
            return this.all_diseases.filter(dis => {
               return dis.name.match(string)
            })
        }
    },
    created(){
        this.login()
        this.getDiseaseGroup()
        this.getDiseases()
    },
    methods: {
        login(){
            if (User.loggedIn()) {
               this.token = User.token()
               this.letter = this.$route.params.letter
            }else{
                this.letter = this.$route.params.letter
            }
        },
        getDiseaseGroup(){
            axios.get('/api/diseases-group/' + this.letter)
            .then(response => (this.diseases = response.data))
            .catch()
        },
        getDiseases(){
            axios.get('/api/diseases')
            .then(response => (this.all_diseases = response.data))
            .catch()
        }
    }
}
</script>