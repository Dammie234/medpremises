<template>
    <div class="main">
        <!-- BEGIN: Mobile Menu -->
        <mobile-menu></mobile-menu>
        <!-- END: Mobile Menu -->
        <div class="flex">
            <!-- BEGIN: Side Menu -->
            <side-menu page="record"></side-menu>
            <!-- END: Side Menu -->
            <!-- BEGIN: Content -->
            <div class="content">
                <!-- BEGIN: Top Bar -->
                <top-bar title="Death Records"></top-bar>
                <!-- END: Top Bar -->
                
                <div class="grid grid-cols-12 gap-6 mt-4">
                    <div class="intro-y col-span-12 xxl:col-span-12">
                       <div class="intro-y box">
                            <div class="flex flex-col sm:flex-row items-center p-5 border-b border-slate-200/60">
                                <h2 class="font-medium text-base mr-auto">Death Record</h2>

                                 <router-link :to="{name: 'death-records'}" class="btn btn-primary" style="margin-left:20px">Go Back</router-link>
                            </div>
                            <div class=" p-5">
                                <div class="grid grid-cols-12 gap-x-5">
                                    <div class="col-span-12 xl:col-span-12 mt-3">
                                        <div>
                                            <div class="overflow-x-auto">
                                                <table class="table table-xs table-bordered">
                                                    <tr>
                                                        <td>
                                                            <span class="block text-xs uppercase font-semibold">Decedent Legal Name</span>
                                                            <span class="block text-md">{{death.decedent_legal_name}}</span>
                                                        </td>
                                                        <td>
                                                            <span class="block text-xs uppercase font-semibold">Gender</span>
                                                            <span class="block text-md">{{death.gender}}</span>
                                                        </td>
                                                        <td>
                                                            <span class="block text-xs uppercase font-semibold">National Identity Number</span>
                                                            <span class="block text-md">{{death.nin_number}}</span>
                                                        </td>
                                                        <td>
                                                            <span class="block text-xs uppercase font-semibold">Age (Last Birthday)</span>
                                                            <span class="block text-md">{{death.age}}</span>
                                                        </td>
                                                        <td>
                                                            <span class="block text-xs uppercase font-semibold">Age Classification</span>
                                                            <span class="block text-md">{{death.age_class}}</span>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <span class="block text-xs uppercase font-semibold">Date of Birth</span>
                                                            <span class="block text-md">{{death.date_of_birth | moment('MMMM Do YYYY')}}</span>
                                                        </td>
                                                        <td>
                                                            <span class="block text-xs uppercase font-semibold">Birth Place</span>
                                                            <span class="block text-md">{{death.birth_place}}</span>
                                                        </td>
                                                        <td>
                                                            <span class="block text-xs uppercase font-semibold">Residence State</span>
                                                            <span class="block text-md">{{death.state}}</span>
                                                        </td>
                                                        <td>
                                                            <span class="block text-xs uppercase font-semibold">City or Town</span>
                                                            <span class="block text-md">{{death.city}}</span>
                                                        </td>
                                                        <td>
                                                            <span class="block text-xs uppercase font-semibold">Number &amp; Street Name</span>
                                                            <span class="block text-md">{{death.address}}</span>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <span class="block text-xs uppercase font-semibold">Postal Code</span>
                                                            <span class="block text-md">{{death.postal_code}}</span>
                                                        </td>
                                                        <td>
                                                            <span class="block text-xs uppercase font-semibold">Marital Status</span>
                                                            <span class="block text-md">{{death.marital_status}}</span>
                                                        </td>
                                                        <td>
                                                            <span class="block text-xs uppercase font-semibold" v-if="death.marital_status == 'Married'">Surviving Spouse Name</span>
                                                            <span class="block text-md" v-if="death.marital_status == 'Married'">{{death.surviving_spouse_name}}</span>
                                                        </td>
                                                        <td>
                                                            <span class="block text-xs uppercase font-semibold">Father's Name</span>
                                                            <span class="block text-md">{{death.father_name}}</span>
                                                        </td>
                                                        <td>
                                                            <span class="block text-xs uppercase font-semibold">Mother's Name</span>
                                                            <span class="block text-md">{{death.mother_name}}</span>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <span class="block text-xs uppercase font-semibold">Informant Name</span>
                                                            <span class="block text-md">{{death.informant_name}}</span>
                                                        </td>
                                                        <td>
                                                            <span class="block text-xs uppercase font-semibold">Relationship with Decedent</span>
                                                            <span class="block text-md">{{death.relationship_with_decedent}}</span>
                                                        </td>
                                                        <td>
                                                            <span class="block text-xs uppercase font-semibold">Place of Death</span>
                                                            <span class="block text-md" v-if="death.if_death_occured_in_a_hospital">{{death.if_death_occured_in_a_hospital}}</span>
                                                            <span class="block text-md" v-else>{{death.if_death_occurred_somewhere_other_than_hospital}}</span>
                                                        </td>
                                                        <td>
                                                            <span class="block text-xs uppercase font-semibold">Facility Name</span>
                                                            <span class="block text-md">{{death.facility_name}}</span>
                                                        </td>
                                                        <td>
                                                            <span class="block text-xs uppercase font-semibold">Facility Address</span>
                                                            <span class="block text-md">{{death.facility_address}}</span>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <span class="block text-xs uppercase font-semibold">Method of Disposition</span>
                                                            <span class="block text-md">{{death.method_of_disposition}}</span>
                                                        </td>
                                                        <td>
                                                            <span class="block text-xs uppercase font-semibold">Place of Disposition</span>
                                                            <span class="block text-md">{{death.place_of_disposition}}</span>
                                                        </td>
                                                        <td>
                                                            <span class="block text-xs uppercase font-semibold">Address of Disposition</span>
                                                            <span class="block text-md">{{death.address_of_disposition}}</span>
                                                        </td>
                                                        <td>
                                                            <span class="block text-xs uppercase font-semibold">Name &amp; Address of Funeral Facility</span>
                                                            <span class="block text-md">{{death.name_and_address_of_funeral_facility}}</span>
                                                        </td>
                                                        <td>
                                                            <span class="block text-xs uppercase font-semibold">Date Pronounced Dead</span>
                                                            <span class="block text-md">{{death.date_pronounced_dead | moment('Do MMMM YYYY')}}</span>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <span class="block text-xs uppercase font-semibold">Time Pronounced Dead</span>
                                                            <span class="block text-md">{{death.time_pronounced_dead | moment('H:i:s')}}</span>
                                                        </td>
                                                        <td>
                                                            <span class="block text-xs uppercase font-semibold">Actual/Presumed Date of Death</span>
                                                            <span class="block text-md">{{death.actual_date_of_death | moment('Do MMMM YYYY')}}</span>
                                                        </td>
                                                        <td>
                                                            <span class="block text-xs uppercase font-semibold">Actual/Presumed Time of Death</span>
                                                            <span class="block text-md">{{death.actual_time_of_death | moment('H:i:s')}}</span>
                                                        </td>
                                                        <td>
                                                            <span class="block text-xs uppercase font-semibold">Was Medical Examiner or coroner contacted?</span>
                                                            <span class="block text-md"><span v-if="death.medical_examminer_contacted == 1">Yes</span><span v-else>No</span></span>
                                                        </td>
                                                        <td></td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="4">
                                                            <h3 class="font-medium text-xl text-center"><span class="uppercase">Cause of Death</span>(See Instruction and examples)</h3>
                                                            <p class="text-md"><strong>PART I.</strong> Enter the chain of events--diseases, injuries, or complications--that directly caused the death. DO NOT enter terminal events such as cardiac
arrest, respiratory arrest, or ventricular fibrillation without showing the etiology. DO NOT ABBREVIATE. Enter only one cause on a line. Add additional
lines if necessary.</p>
                                                        </td>
                                                        <td>Approximate interval: Onset to death</td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="4">
                                                            <span class="block text-xs uppercase font-semibold">IMMEDIATE CAUSE (Final
                                                                disease or condition resulting in death)</span>
                                                            <span class="block text-md">{{death.immediate_cause_of_death}}</span>
                                                        </td>
                                                        <td>
                                                            <span class="block text-xs uppercase font-semibold">Interval</span>
                                                            <span class="block text-md">{{death.immediate_cause_of_death_interval}}</span>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="4">
                                                            <span class="block text-xs uppercase font-semibold">Sequential list Conditions, if any, leading to the cause listed above</span>
                                                            <span class="block text-md">{{death.sequential_cause_of_death}}</span>
                                                        </td>
                                                        <td>
                                                            <span class="block text-xs uppercase font-semibold">Interval</span>
                                                            <span class="block text-md">{{death.sequential_cause_of_death_interval}}</span>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="4">
                                                            <span class="block text-xs uppercase font-semibold">Underlying Cause (disease or injury that initiated the events resulting in death)</span>
                                                            <span class="block text-md">{{death.underlying_cause_of_death}}</span>
                                                        </td>
                                                        <td>
                                                            <span class="block text-xs uppercase font-semibold">Interval</span>
                                                            <span class="block text-md">{{death.underlying_cause_of_death_interval}}</span>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="4">
                                                            <span class="block text-xs uppercase font-semibold">Last Event that result to death</span>
                                                            <span class="block text-md">{{death.last_event_resulting_in_death}}</span>
                                                        </td>
                                                        <td>
                                                            <span class="block text-xs uppercase font-semibold">Interval</span>
                                                            <span class="block text-md">{{death.last_event_resulting_in_death_interval}}</span>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="4">
                                                            <span class="block text-md"><strong>PART II</strong> Enter other significant conditions contributing to death but not resulting in the underlying cause given in PART I</span>
                                                            <span class="block text-md">{{death.significant_conditions_contibuting_to_death}}</span>
                                                        </td>
                                                        <td>
                                                            <div class="w-full mb-5">
                                                                <span class="block text-xs uppercase font-semibold">Was as Autopsy Performed?</span>
                                                                <span class="block text-md"><span v-if="death.autopsy_performed == 1">Yes</span><span v-else>No</span></span>
                                                            </div>
                                                            <div class="w-full">
                                                                <span class="block text-xs uppercase font-semibold">Were the autopsy findings available to complete the cause of death?</span>
                                                                <span class="block text-md"><span v-if="death.autopsy_findings == 1">Yes</span><span v-else>No</span></span>
                                                            </div>
                                                            
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="2">
                                                            <span class="block text-xs uppercase font-semibold">Did Tobacco use contribute to death?</span>
                                                            <span class="block text-md">{{death.tobacco_to_death}}</span>
                                                        </td>
                                                        <td colspan="2">
                                                            <span class="block text-xs uppercase font-semibold">If Female?</span>
                                                            <span class="block text-md">{{death.pregnancy}}</span>
                                                        </td>
                                                        <td>
                                                            <span class="block text-xs uppercase font-semibold">Manner of Death</span>
                                                            <span class="block text-md">{{death.manner_of_death}}</span>
                                                        </td>
                                                    </tr>
                                                    <tr v-if="death.date_of_injury != NULL">
                                                        <td>
                                                            <span class="block text-xs uppercase font-semibold">Date of Injury</span>
                                                            <span class="block text-md">{{death.date_of_injury | moment('Do MMMMM YYYY')}}</span>
                                                        </td>
                                                        <td>
                                                            <span class="block text-xs uppercase font-semibold">Time of Injury</span>
                                                            <span class="block text-md">{{death.time_of_injury | moment('H:i:s')}}</span>
                                                        </td>
                                                        <td>
                                                            <span class="block text-xs uppercase font-semibold">Place of Injury</span>
                                                            <span class="block text-md">{{death.place_of_injury}}</span>
                                                        </td>
                                                        <td>
                                                            <span class="block text-xs uppercase font-semibold">Injury at Work</span>
                                                            <span class="block text-md"><span v-if="death.injury_at_work == 1">Yes</span><span v-else>No </span></span>
                                                        </td>
                                                        <td>
                                                            <span class="block text-xs uppercase font-semibold">Location of Injury</span>
                                                            <span class="block text-md">{{death.address_of_injury}}</span>
                                                        </td>
                                                    </tr>
                                                    <tr v-if="death.date_of_injury != NULL">
                                                        <td>
                                                            <span class="block text-xs uppercase font-semibold">How Injury Occurred</span>
                                                            <span class="block text-md">{{death.how_injury_occurred}}</span>
                                                        </td>
                                                        <td>
                                                            <span class="block text-xs uppercase font-semibold">If Transportation, Specify?</span>
                                                            <span class="block text-md">{{death.transportation_injury}}</span>
                                                        </td>
                                                        <td></td>
                                                        <td></td>
                                                        <td></td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <span class="block text-xs uppercase font-semibold">Name of Person Completing Cause of Death</span>
                                                            <span class="block text-md">{{death.name_of_person_completing_cause_death}}</span>
                                                        </td>
                                                        <td>
                                                            <span class="block text-xs uppercase font-semibold">Address of Person Completing Cause of Death</span>
                                                            <span class="block text-md">{{death.address_of_person_completing_cause_death}}</span>
                                                        </td>
                                                        <td>
                                                            <span class="block text-xs uppercase font-semibold">Decedent Education</span>
                                                            <span class="block text-md">{{death.decedent_education}}</span>
                                                        </td>
                                                        <td>
                                                            <span class="block text-xs uppercase font-semibold">Decedent of Hispanic Origin</span>
                                                            <span class="block text-md">{{death.decedent_origin}}</span>
                                                        </td>
                                                        <td>
                                                            <span class="block text-xs uppercase font-semibold">Decedent Race</span>
                                                            <span class="block text-md">{{death.decedent_race}}</span>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <span class="block text-xs uppercase font-semibold">Decedent Occupation</span>
                                                            <span class="block text-md">{{death.decedent_occupation}}</span>
                                                        </td>
                                                        <td>
                                                            <span class="block text-xs uppercase font-semibold">Kind of Business/Industry</span>
                                                            <span class="block text-md">{{death.kind_of_business_or_industry}}</span>
                                                        </td>
                                                        <td>
                                                            <span class="block text-xs uppercase font-semibold">Added By</span>
                                                            <span class="block text-md">{{death.staff_name}}</span>
                                                        </td>
                                                        <td>
                                                            <span class="block text-xs uppercase font-semibold">Date Created</span>
                                                            <span class="block text-md">{{death.created_at | moment('Do MMMM YYYY H:i:s')}}</span>
                                                        </td>
                                                        <td></td>
                                                    </tr>
                                                </table>
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
        name: 'death-record',
        data() {
            return {
                id: null,
                token: null,
                death: ''
                
            }
        },
        
        created() {
            this.login()
            this.getDeathRecord()
        },
        methods: {
            login(){
                if (!User.loggedIn()) {
                    this.$router.push({
                            name: 'logout'
                        })
                }else{
                    this.token = User.token()
                }
            },
            
            getDeathRecord(){
                let slug = this.$route.params.slug
                axios.get('/api/v1/death-record/' + slug, {
                    headers: {
                        Authorization: 'Bearer ' + this.token,
                        Accept: 'application/json'
                    }
               }).then(response => (this.death = response.data))
                .catch((error) => {
                    console.log(error)
                    if (error.response.status == 401) {
                        this.$router.push({
                            name: 'logout'
                        })
                    }
                })
            }
            
            
        }
    }
    </script>
    
    <style scoped>
    
    </style>
    