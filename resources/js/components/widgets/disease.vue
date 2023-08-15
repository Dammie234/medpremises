<template>
    <div>
        <div class="intro-y flex items-center h-10">
            <h2 class="text-lg font-medium truncate">Diseases &amp; Conditions</h2> 
        </div>
        <div class="intro-y box p-5">
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
                            <td><a :href="disease.url" target="_blank">Learn More</a></td>
                        </tr>
                        
                    </tbody>
                </table>
            </div>
            
            <router-link :to="{name: 'frontend-diseases', params:{letter: 'a'}}" class="intro-y mt-3 w-full block text-center rounded-md py-4 border border-dotted border-slate-400 dark:border-darkmode-300 text-slate-500">View More</router-link> 
        </div>
        
    </div>
</template>
<script>
export default {
    name: 'diseases',
    data(){
        return {
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
        this.getDiseases()
        this.getAllDiseases()
    },
    methods: {
        getDiseases(){
            axios.get('/api/few-diseases', )
            .then(response => (this.diseases = response.data))
            .catch()
        },
        getAllDiseases(){
            axios.get('/api/diseases')
            .then(response => (this.all_diseases = response.data))
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
    