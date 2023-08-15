<template>
    <div>
        <div class="intro-y flex items-center h-10">
            <h2 class="text-lg font-medium truncate">Medical Diagnostics &amp; Laboratory Tests</h2> 
        </div>
        <div class="intro-y box p-5">
            <input class="form-control mr-0" type="text" v-model="search" placeholder="Seach Medical Diagnostics & Laboratory Tests">
            <div class="overflow-x-auto mt-3">
                <table class="table text-xs">
                     <tbody v-if="search">
                        <tr v-for="(test, index) in filterSearch" :key="index">
                            <th>{{test.test_name}}</th>
                            <td><a :href="test.url" target="_blank" style="color:#00f;">Learn More</a></td>
                        </tr>
                    </tbody>
                    <tbody v-else>
                        <tr v-for="(test, index) in all_tests" :key="index">
                            <th>{{test.test_name}}</th>
                            <td><a :href="test.url" target="_blank">Learn More</a></td>
                        </tr>
                        
                    </tbody>
                </table>
            </div>
            
            <router-link :to="{name: 'frontend-laboratory-tests', params:{letter: 'a'}}" class="intro-y mt-3 w-full block text-center rounded-md py-4 border border-dotted border-slate-400 dark:border-darkmode-300 text-slate-500">View More</router-link> 
        </div>
        
    </div>
</template>
<script>
export default {
    name: 'laboratory-tests',
    data(){
        return {
            tests: [],
            all_tests: [],
            search: ''
        }
    },
    computed: {
        filterSearch() {
            let str = this.search
            let string = str.charAt(0).toUpperCase() + str.slice(1)
            return this.all_tests.filter(test => {
               return test.test_name.match(string)
            })
        }
    },
    created(){
        this.getTests()
        this.getLaboratoryTests()
    },
    methods: {
        getTests(){
            axios.get('/api/few-laboratory-tests', )
            .then(response => (this.tests = response.data))
            .catch()
        },
        getLaboratoryTests(){
            axios.get('/api/laboratory-tests')
            .then(response => (this.all_tests = response.data))
            .catch()
        }
    }
}
</script>
<style lang="css" scoped>
a{
        color: #00f;
    }
</style>
    