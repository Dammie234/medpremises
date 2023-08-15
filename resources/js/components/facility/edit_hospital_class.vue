<template>
<div class="main">
    <!-- BEGIN: Mobile Menu -->
    <mobile-menu></mobile-menu>
    <!-- END: Mobile Menu -->
    <div class="flex">
        <!-- BEGIN: Side Menu -->
        <side-menu page="dashboard"></side-menu>
        <!-- END: Side Menu -->
        <!-- BEGIN: Content -->
        <div class="content">
            <!-- BEGIN: Top Bar -->
            <top-bar title="Hospital Setting"></top-bar>
            <!-- END: Top Bar -->
            <div class="intro-y flex items-center mt-8">
                <h2 class="text-lg font-medium mr-auto">
                    Hospital Setting
                </h2>
            </div>
            <div class="grid grid-cols-12 gap-6">
                <!-- BEGIN: Profile Menu -->
                <div class="col-span-12 lg:col-span-3 xxl:col-span-3 flex lg:block flex-col-reverse">
                    <setting page="Profile Setting"></setting>
                </div>
                <!-- END: Profile Menu -->
                <div class="col-span-12 lg:col-span-9 xxl:col-span-9">
                    
                    <!-- BEGIN: Personal Information -->
                    <div class="intro-y box mt-5">
                        <div class="flex items-center p-5 border-b border-gray-200 dark:border-dark-5">
                            <h2 class="font-medium text-base mr-auto">
                                Hospital Class
                            </h2>
                        </div>
                        <form @submit.prevent="updateHospitalClass">
                            <div class="p-5" :disabled="loading">
                                <div class="grid grid-cols-12 gap-5 pb-4">
                                    <div class="col-span-12 lg:col-span-2"></div>
                                    <div class="col-span-12 lg:col-span-2"></div>
                                    <div class="col-span-12 lg:col-span-2 border-bottom pb-3">
                                        <div class="form-check mt-2" v-if="form.medical && form.medical == true">
                                            <input id="medical" class="form-check-input" v-model="form.medical" type="checkbox" name="medical" value="true" checked>
                                            <label class="form-check-label" for="medical">Medical</label>
                                        </div>
                                        <div class="form-check mt-2" v-else>
                                            <input id="medical" v-model="form.medical" class="form-check-input" type="checkbox" name="medical" value="false">
                                            <label class="form-check-label" for="medical">Medical</label> 
                                        </div>
                                    </div>
                                    <div class="col-span-12 lg:col-span-6 border-bottom pb-3">
                                        <div class="grid grid-cols-12 gap-5">
                                            <div class="col-span-12 lg:col-span-4">
                                                <div class="form-check mb-2" v-if="form.cardiology && form.cardiology == true" >
                                                    <input id="cardiology" class="form-check-input" type="checkbox" v-model="form.cardiology" value="true">
                                                    <label class="form-check-label" for="cardiology">Cardiology</label>
                                                </div>
                                                <div class="form-check mb-2" v-else>
                                                    <input id="cardiology" class="form-check-input" type="checkbox" v-model="form.cardiology" value="false">
                                                    <label class="form-check-label" for="cardiology">Cardiology</label>
                                                </div>
                                            </div>
                                            <div class="col-span-12 lg:col-span-4">
                                                <div class="form-check mb-2" v-if="form.gastroenterology && form.gastroenterology == true" >
                                                    <input id="gastroenterology" class="form-check-input" type="checkbox" v-model="form.gastroenterology" value="true">
                                                    <label class="form-check-label" for="gastroenterology">Gastroenterology</label>
                                                </div>
                                                <div class="form-check mb-2" v-else>
                                                    <input id="gastroenterology" class="form-check-input" type="checkbox" v-model="form.gastroenterology" value="false">
                                                    <label class="form-check-label" for="gastroenterology">Gastroenterology</label>
                                                </div>
                                            </div>
                                            <div class="col-span-12 lg:col-span-4">
                                                <div class="form-check mb-2" v-if="form.nephrology && form.nephrology == true" >
                                                    <input id="nephrology" class="form-check-input" type="checkbox" v-model="form.nephrology" value="true">
                                                    <label class="form-check-label" for="nephrology">Nephrology</label>
                                                </div>
                                                <div class="form-check mb-2" v-else>
                                                    <input id="nephrology" class="form-check-input" type="checkbox" v-model="form.nephrology" value="false">
                                                    <label class="form-check-label" for="nephrology">Nephrology</label>
                                                </div>
                                            </div>
                                            <div class="col-span-12 lg:col-span-4">
                                                <div class="form-check mb-2" v-if="form.dermatology && form.dermatology == true" >
                                                    <input id="dermatology" class="form-check-input" type="checkbox" v-model="form.dermatology" value="true">
                                                    <label class="form-check-label" for="dermatology">Dermatology</label>
                                                </div>
                                                <div class="form-check mb-2" v-else>
                                                    <input id="dermatology" class="form-check-input" type="checkbox" v-model="form.dermatology" value="false">
                                                    <label class="form-check-label" for="dermatology">Dermatology</label>
                                                </div>
                                            </div>
                                            <div class="col-span-12 lg:col-span-4">
                                                <div class="form-check mb-2" v-if="form.hematology && form.hematology == true" >
                                                    <input id="hematology" class="form-check-input" type="checkbox" v-model="form.hematology" value="true">
                                                    <label class="form-check-label" for="hematology">Hematology</label>
                                                </div>
                                                <div class="form-check mr-4 mb-2" v-else>
                                                    <input id="hematology" class="form-check-input" type="checkbox" v-model="form.hematology" value="false">
                                                    <label class="form-check-label" for="hematology">Hematology</label>
                                                </div>
                                            </div>
                                            <div class="col-span-12 lg:col-span-4">
                                                <div class="form-check mb-2" v-if="form.endocrinology && form.endocrinology == true" >
                                                    <input id="endocrinology" class="form-check-input" type="checkbox" v-model="form.endocrinology" value="true">
                                                    <label class="form-check-label" for="endocrinology">Endocrinology</label>
                                                </div>
                                                <div class="form-check mb-2" v-else>
                                                    <input id="endocrinology" class="form-check-input" type="checkbox" v-model="form.endocrinology" value="false">
                                                    <label class="form-check-label" for="endocrinology">Endocrinology</label>
                                                </div>
                                            </div>
                                            <div class="col-span-12 lg:col-span-4">
                                                <div class="form-check mb-2" v-if="form.geriatrics && form.geriatrics == true" >
                                                    <input id="geriatrics" class="form-check-input" type="checkbox" v-model="form.geriatrics" value="true">
                                                    <label class="form-check-label" for="geriatrics">Geriatrics</label>
                                                </div>
                                                <div class="form-check mb-2" v-else>
                                                    <input id="geriatrics" class="form-check-input" type="checkbox" v-model="form.geriatrics" value="false">
                                                    <label class="form-check-label" for="geriatrics">Geriatrics</label>
                                                </div>
                                            </div>
                                            <div class="col-span-12 lg:col-span-4">
                                                <div class="form-check mb-2" v-if="form.pulmonology && form.pulmonology == true" >
                                                    <input id="pulmonology" class="form-check-input" type="checkbox" v-model="form.pulmonology" value="true">
                                                    <label class="form-check-label" for="pulmonology">Pulmonology</label>
                                                </div>
                                                <div class="form-check mb-2" v-else>
                                                    <input id="pulmonology" class="form-check-input" type="checkbox" v-model="form.pulmonology" value="false">
                                                    <label class="form-check-label" for="pulmonology">Pulmonology</label>
                                                </div>
                                            </div>
                                            <div class="col-span-12 lg:col-span-4">
                                                <div class="form-check mr-4 mb-2" v-if="form.psychiatry && form.psychiatry == true" >
                                                    <input id="psychiatry" class="form-check-input" type="checkbox" v-model="form.psychiatry" value="true">
                                                    <label class="form-check-label" for="psychiatry">Psychiatry</label>
                                                </div>
                                                <div class="form-check mr-4 mb-2" v-else>
                                                    <input id="psychiatry" class="form-check-input" type="checkbox" v-model="form.psychiatry" value="false">
                                                    <label class="form-check-label" for="psychiatry">Psychiatry</label>
                                                </div>
                                            </div>
                                            <div class="col-span-12 lg:col-span-4">
                                                <div class="form-check mb-2" v-if="form.neurology && form.neurology == true" >
                                                    <input id="neurology" class="form-check-input" type="checkbox" v-model="form.neurology" value="true">
                                                    <label class="form-check-label" for="neurology">Neurology</label>
                                                </div>
                                                <div class="form-check mb-2" v-else>
                                                    <input id="neurology" class="form-check-input" type="checkbox" v-model="form.neurology" value="false">
                                                    <label class="form-check-label" for="neurology">Neurology</label>
                                                </div>
                                            </div>
                                            <div class="col-span-12 lg:col-span-4">
                                                <div class="form-check mb-2" v-if="form.infectious_diseases && form.infectious_diseases == true" >
                                                    <input id="infectious_diseases" class="form-check-input" type="checkbox" v-model="form.infectious_diseases" value="true">
                                                    <label class="form-check-label" for="infectious_diseases">Infectious Diseases</label>
                                                </div>
                                                <div class="form-check mb-2" v-else>
                                                    <input id="infectious_diseases" class="form-check-input" type="checkbox" v-model="form.infectious_diseases" value="false">
                                                    <label class="form-check-label" for="infectious_diseases">Infectious Diseases</label>
                                                </div>
                                            </div>
                                            <div class="col-span-12 lg:col-span-4">
                                                <div class="form-check mr-4 mb-2" v-if="form.nuclear_medicine && form.nuclear_medicine == true" >
                                                    <input id="nuclear_medicine" class="form-check-input" type="checkbox" v-model="form.nuclear_medicine" value="true">
                                                    <label class="form-check-label" for="nuclear_medicine">Nuclear Medicine</label>
                                                </div>
                                                <div class="form-check mr-4 mb-2" v-else>
                                                    <input id="nuclear_medicine" class="form-check-input" type="checkbox" v-model="form.nuclear_medicine" value="false">
                                                    <label class="form-check-label" for="nuclear_medicine">Nuclear Medicine</label>
                                                </div>
                                            </div>
                                            <div class="col-span-12 lg:col-span-4">
                                                <div class="form-check mr-4 mb-2" v-if="form.family_medicine && form.family_medicine == true" >
                                                    <input id="family_medicine" class="form-check-input" type="checkbox" v-model="form.nuclear_medicine" value="true">
                                                    <label class="form-check-label" for="family_medicine">Family Medicine</label>
                                                </div>
                                                <div class="form-check mr-4 mb-2" v-else>
                                                    <input id="family_medicine" class="form-check-input" type="checkbox" v-model="form.family_medicine" value="false">
                                                    <label class="form-check-label" for="family_medicine">Family Medicine</label>
                                                </div>
                                            </div>    
                                        </div>
                                    </div>
                                </div>
                                <div class="grid grid-cols-12 gap-5 pb-4">
                                    <div class="col-span-12 lg:col-span-2"></div>
                                    <div class="col-span-12 lg:col-span-2">
                                        <div class="form-check mt-2" v-if="form.out_patient && form.out_patient == true">
                                            <input id="out_patient" class="form-check-input" v-model="form.out_patient" type="checkbox" name="out_patient" value="true" checked>
                                            <label class="form-check-label" for="out_patient">Out Patient</label>
                                        </div>
                                        <div class="form-check mt-2" v-else>
                                            <input id="out_patient" v-model="form.out_patient" class="form-check-input" type="checkbox" name="out_patient" value="false">
                                            <label class="form-check-label" for="out_patient">Out Patient</label> 
                                        </div>
                                    </div>
                                    <div class="col-span-12 lg:col-span-2 border-bottom pb-3">
                                        <div class="form-check mt-2" v-if="form.surgical && form.surgical == true">
                                            <input id="surgical" class="form-check-input" v-model="form.surgical" type="checkbox" name="surgical" value="true" checked>
                                            <label class="form-check-label" for="surgical">Surgical</label>
                                        </div>
                                        <div class="form-check mt-2" v-else>
                                            <input id="surgical" v-model="form.surgical" class="form-check-input" type="checkbox" name="surgical" value="false">
                                            <label class="form-check-label" for="surgical">Surgical</label> 
                                        </div>
                                    </div>
                                    <div class="col-span-12 lg:col-span-6 border-bottom pb-3">
                                        <div class="grid grid-cols-12 gap-5">
                                            <div class="col-span-12 lg:col-span-4">
                                                <div class="form-check mb-2" v-if="form.ophthalmology && form.ophthalmology == true" >
                                                    <input id="ophthalmology" class="form-check-input" type="checkbox" v-model="form.ophthalmology" value="true">
                                                    <label class="form-check-label" for="ophthalmology">Ophthalmology</label>
                                                </div>
                                                <div class="form-check mb-2" v-else>
                                                    <input id="ophthalmology" class="form-check-input" type="checkbox" v-model="form.ophthalmology" value="false">
                                                    <label class="form-check-label" for="ophthalmology">Ophthalmology</label>
                                                </div>
                                            </div>
                                            <div class="col-span-12 lg:col-span-4">
                                                <div class="form-check mb-2" v-if="form.general_surgery && form.general_surgery == true" >
                                                    <input id="general_surgery" class="form-check-input" type="checkbox" v-model="form.general_surgery" value="true">
                                                    <label class="form-check-label" for="general_surgery">General Surgery</label>
                                                </div>
                                                <div class="form-check mb-2" v-else>
                                                    <input id="general_surgery" class="form-check-input" type="checkbox" v-model="form.general_surgery" value="false">
                                                    <label class="form-check-label" for="general_surgery">General Surgery</label>
                                                </div>
                                            </div>
                                            <div class="col-span-12 lg:col-span-4">
                                                <div class="form-check mb-2" v-if="form.cardiothoracic_surgery && form.cardiothoracic_surgery == true" >
                                                    <input id="cardiothoracic_surgery" class="form-check-input" type="checkbox" v-model="form.cardiothoracic_surgery" value="true">
                                                    <label class="form-check-label" for="cardiothoracic_surgery">Cardiothoracic Surgery</label>
                                                </div>
                                                <div class="form-check mb-2" v-else>
                                                    <input id="cardiothoracic_surgery" class="form-check-input" type="checkbox" v-model="form.cardiothoracic_surgery" value="false">
                                                    <label class="form-check-label" for="cardiothoracic_surgery">Cardiothoracic Surgery</label>
                                                </div>
                                            </div>
                                            <div class="col-span-12 lg:col-span-4">
                                                <div class="form-check mb-2" v-if="form.neuro_surgery && form.neuro_surgery == true" >
                                                    <input id="neuro_surgery" class="form-check-input" type="checkbox" v-model="form.neuro_surgery" value="true">
                                                    <label class="form-check-label" for="neuro_surgery">Neuro-Surgery</label>
                                                </div>
                                                <div class="form-check mb-2" v-else>
                                                    <input id="neuro_surgery" class="form-check-input" type="checkbox" v-model="form.neuro_surgery" value="false">
                                                    <label class="form-check-label" for="neuro_surgery">Neuro Surgery</label>
                                                </div>
                                            </div>
                                            <div class="col-span-12 lg:col-span-4">
                                                <div class="form-check mb-2" v-if="form.orthopedic_surgery && form.orthopedic_surgery == true" >
                                                    <input id="orthopedic_surgery" class="form-check-input" type="checkbox" v-model="form.orthopedic_surgery" value="true">
                                                    <label class="form-check-label" for="orthopedic_surgery">Orthopedic Surgery</label>
                                                </div>
                                                <div class="form-check mb-2" v-else>
                                                    <input id="orthopedic_surgery" class="form-check-input" type="checkbox" v-model="form.orthopedic_surgery" value="false">
                                                    <label class="form-check-label" for="orthopedic_surgery">Orthopedic Surgery</label>
                                                </div>
                                            </div>
                                            <div class="col-span-12 lg:col-span-4">
                                                <div class="form-check mb-2" v-if="form.plastic_surgery && form.plastic_surgery == true" >
                                                    <input id="plastic_surgery" class="form-check-input" type="checkbox" v-model="form.plastic_surgery" value="true">
                                                    <label class="form-check-label" for="plastic_surgery">Plastic Surgery</label>
                                                </div>
                                                <div class="form-check mb-2" v-else>
                                                    <input id="plastic_surgery" class="form-check-input" type="checkbox" v-model="form.plastic_surgery" value="false">
                                                    <label class="form-check-label" for="plastic_surgery">Plastic Surgery</label>
                                                </div>
                                            </div>
                                            <div class="col-span-12 lg:col-span-4">
                                                <div class="form-check mb-2" v-if="form.urology && form.urology == true" >
                                                    <input id="urology" class="form-check-input" type="checkbox" v-model="form.urology" value="true">
                                                    <label class="form-check-label" for="urology">Urology</label>
                                                </div>
                                                <div class="form-check mb-2" v-else>
                                                    <input id="urology" class="form-check-input" type="checkbox" v-model="form.urology" value="false">
                                                    <label class="form-check-label" for="urology">Urology</label>
                                                </div>
                                            </div>
                                            
                                            <div class="col-span-12 lg:col-span-4">
                                                <div class="form-check mb-2" v-if="form.anesthesia && form.anesthesia == true" >
                                                    <input id="anesthesia" class="form-check-input" type="checkbox" v-model="form.anesthesia" value="true">
                                                    <label class="form-check-label" for="anesthesia">Anesthesia</label>
                                                </div>
                                                <div class="form-check mb-2" v-else>
                                                    <input id="anesthesia" class="form-check-input" type="checkbox" v-model="form.anesthesia" value="false">
                                                    <label class="form-check-label" for="anesthesia">Anesthesia</label>
                                                </div>
                                            </div>
                                            <div class="col-span-12 lg:col-span-4">
                                                <div class="form-check mb-2" v-if="form.oncology && form.oncology == true" >
                                                    <input id="oncology" class="form-check-input" type="checkbox" v-model="form.oncology" value="true">
                                                    <label class="form-check-label" for="anesthesia">Oncology / Radiotheraphy</label>
                                                </div>
                                                <div class="form-check mb-2" v-else>
                                                    <input id="oncology" class="form-check-input" type="checkbox" v-model="form.oncology" value="false">
                                                    <label class="form-check-label" for="oncology">Oncology / Radiotheraphy</label>
                                                </div>
                                            </div>
                                            <div class="col-span-12 lg:col-span-4">
                                                <div class="form-check mb-2" v-if="form.radiology && form.radiology == true" >
                                                    <input id="radiology" class="form-check-input" type="checkbox" v-model="form.radiology" value="true">
                                                    <label class="form-check-label" for="radiology">Radiology</label>
                                                </div>
                                                <div class="form-check mb-2" v-else>
                                                    <input id="radiology" class="form-check-input" type="checkbox" v-model="form.radiology" value="false">
                                                    <label class="form-check-label" for="radiology">Radiology</label>
                                                </div>
                                            </div>
                                            <div class="col-span-12 lg:col-span-4">
                                                <div class="form-check mb-2" v-if="form.vascular_surgery && form.vascular_surgery == true" >
                                                    <input id="vascular_surgery" class="form-check-input" type="checkbox" v-model="form.vascular_surgery" value="true">
                                                    <label class="form-check-label" for="vascular_surgery">Vascular Surgery</label>
                                                </div>
                                                <div class="form-check mb-2" v-else>
                                                    <input id="vascular_surgery" class="form-check-input" type="checkbox" v-model="form.vascular_surgery" value="false">
                                                    <label class="form-check-label" for="vascular_surgery">Vascular Surgery</label>
                                                </div>
                                            </div>
                                            <div class="col-span-12 lg:col-span-4">
                                                <div class="form-check mb-2" v-if="form.pediatric_surgery && form.pediatric_surgery == true" >
                                                    <input id="pediatric_surgery" class="form-check-input" type="checkbox" v-model="form.pediatric_surgery" value="true">
                                                    <label class="form-check-label" for="pediatric_surgery">Pediatric Surgery</label>
                                                </div>
                                                <div class="form-check mb-2" v-else>
                                                    <input id="pediatric_surgery" class="form-check-input" type="checkbox" v-model="form.pediatric_surgery" value="false">
                                                    <label class="form-check-label" for="pediatric_surgery">Pediatric Surgery</label>
                                                </div>
                                            </div>
                                            <div class="col-span-12 lg:col-span-4">
                                                <div class="form-check mb-2" v-if="form.pathology && form.pathology == true" >
                                                    <input id="pathology" class="form-check-input" type="checkbox" v-model="form.pathology" value="true">
                                                    <label class="form-check-label" for="pathology">Pathology</label>
                                                </div>
                                                <div class="form-check mb-2" v-else>
                                                    <input id="pathology" class="form-check-input" type="checkbox" v-model="form.pathology" value="false">
                                                    <label class="form-check-label" for="pathology">Pathology</label>
                                                </div>
                                            </div>
                                            <div class="col-span-12 lg:col-span-6">
                                                <div class="form-check mb-2" v-if="form.otorhinolaryngology && form.otorhinolaryngology == true" >
                                                    <input id="otorhinolaryngology" class="form-check-input" type="checkbox" v-model="form.otorhinolaryngology" value="true">
                                                    <label class="form-check-label" for="otorhinolaryngology">Otorhinolaryngology / ENT</label>
                                                </div>
                                                <div class="form-check mb-2" v-else>
                                                    <input id="otorhinolaryngology" class="form-check-input" type="checkbox" v-model="form.otorhinolaryngology" value="false">
                                                    <label class="form-check-label" for="otorhinolaryngology">Otorhinolaryngology  / ENT</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="grid grid-cols-12 gap-5 pb-4">
                                    <div class="col-span-12 lg:col-span-2"><h5  class="font-medium text-base mr-auto">Type of Services</h5></div>
                                    <div class="col-span-12 lg:col-span-2"></div>
                                    <div class="col-span-12 lg:col-span-2 border-bottom pb-3">
                                        <div class="form-check mt-2" v-if="form.obstetrics_gynecology && form.obstetrics_gynecology == true">
                                            <input id="obstetrics_gynecology" class="form-check-input" v-model="form.obstetrics_gynecology" type="checkbox" name="obstetrics_gynecology" value="true" checked>
                                            <label class="form-check-label" for="obstetrics_gynecology">Obstetrics &amp; Gynecology</label>
                                        </div>
                                        <div class="form-check mt-2" v-else>
                                            <input id="obstetrics_gynecology" v-model="form.obstetrics_gynecology" class="form-check-input" type="checkbox" name="obstetrics_gynecology" value="false">
                                            <label class="form-check-label" for="obstetrics_gynecology">Obstetrics &amp; Gynecology</label> 
                                        </div>
                                    </div>
                                    <div class="col-span-12 lg:col-span-6 border-bottom pb-3">
                                        <div class="grid grid-cols-12 gap-5">
                                            <div class="col-span-12 lg:col-span-3">
                                                <div class="form-check mb-2" v-if="form.obstetrics && form.obstetrics == true" >
                                                    <input id="obstetrics" class="form-check-input" type="checkbox" v-model="form.obstetrics" value="true">
                                                    <label class="form-check-label" for="obstetrics">Obstetrics</label>
                                                </div>
                                                <div class="form-check mb-2" v-else>
                                                    <input id="obstetrics" class="form-check-input" type="checkbox" v-model="form.obstetrics" value="false">
                                                    <label class="form-check-label" for="obstetrics">Obstetrics</label>
                                                </div>
                                            </div>
                                            <div class="col-span-12 lg:col-span-3">
                                                <div class="form-check mb-2" v-if="form.gynecology && form.gynecology == true" >
                                                    <input id="gynecology" class="form-check-input" type="checkbox" v-model="form.gynecology" value="true">
                                                    <label class="form-check-label" for="gynecology">Gynecology</label>
                                                </div>
                                                <div class="form-check mb-2" v-else>
                                                    <input id="gynecology" class="form-check-input" type="checkbox" v-model="form.gynecology" value="false">
                                                    <label class="form-check-label" for="gynecology">Gynecology</label>
                                                </div>
                                            </div>
                                            <div class="col-span-12 lg:col-span-6">
                                                <div class="form-check mb-2" v-if="form.fertility_reproductive_techniques && form.fertility_reproductive_techniques == true" >
                                                    <input id="fertility_reproductive_techniques" class="form-check-input" type="checkbox" v-model="form.fertility_reproductive_techniques" value="true">
                                                    <label class="form-check-label" for="fertility_reproductive_techniques">Fertility Reproductive Techniques</label>
                                                </div>
                                                <div class="form-check mb-2" v-else>
                                                    <input id="fertility_reproductive_techniques" class="form-check-input" type="checkbox" v-model="form.fertility_reproductive_techniques" value="false">
                                                    <label class="form-check-label" for="fertility_reproductive_techniques">Fertility Reproductive Techniques</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="grid grid-cols-12 gap-5 pb-4">
                                    <div class="col-span-12 lg:col-span-2"></div>
                                    <div class="col-span-12 lg:col-span-2"></div>
                                    <div class="col-span-12 lg:col-span-2 border-bottom pb-3">
                                        <div class="form-check mt-2" v-if="form.pediatrics && form.pediatrics == true">
                                            <input id="pediatrics" class="form-check-input" v-model="form.pediatrics" type="checkbox" name="pediatrics" value="true" checked>
                                            <label class="form-check-label" for="pediatrics">Pediatrics</label>
                                        </div>
                                        <div class="form-check mt-2" v-else>
                                            <input id="pediatrics" v-model="form.pediatrics" class="form-check-input" type="checkbox" name="pediatrics" value="false">
                                            <label class="form-check-label" for="pediatrics">Pediatrics</label> 
                                        </div>
                                    </div>
                                    <div class="col-span-12 lg:col-span-6 border-bottom pb-3">
                                        <div class="grid grid-cols-12 gap-5">
                                            <div class="col-span-12 lg:col-span-4">
                                                <div class="form-check mb-2" v-if="form.p_gastroenterology && form.p_gastroenterology == true" >
                                                    <input id="p_gastroenterology" class="form-check-input" type="checkbox" v-model="form.p_gastroenterology" value="true">
                                                    <label class="form-check-label" for="p_gastroenterology">Gastroenterology</label>
                                                </div>
                                                <div class="form-check mb-2" v-else>
                                                    <input id="p_gastroenterology" class="form-check-input" type="checkbox" v-model="form.p_gastroenterology" value="false">
                                                    <label class="form-check-label" for="p_gastroenterology">Gastroenterology</label>
                                                </div>
                                            </div>
                                            <div class="col-span-12 lg:col-span-4">
                                                <div class="form-check mb-2" v-if="form.p_pulmonology && form.p_pulmonology == true" >
                                                    <input id="p_pulmonology" class="form-check-input" type="checkbox" v-model="form.p_pulmonology" value="true">
                                                    <label class="form-check-label" for="p_pulmonology">Pulmonology</label>
                                                </div>
                                                <div class="form-check mb-2" v-else>
                                                    <input id="p_pulmonology" class="form-check-input" type="checkbox" v-model="form.p_pulmonology" value="false">
                                                    <label class="form-check-label" for="p_pulmonology">Pulmonology</label>
                                                </div>
                                            </div>
                                            <div class="col-span-12 lg:col-span-4">
                                                <div class="form-check mb-2" v-if="form.p_nephrology && form.p_nephrology == true" >
                                                    <input id="p_nephrology" class="form-check-input" type="checkbox" v-model="form.p_nephrology" value="true">
                                                    <label class="form-check-label" for="p_nephrology">Nephrology</label>
                                                </div>
                                                <div class="form-check mb-2" v-else>
                                                    <input id="p_nephrology" class="form-check-input" type="checkbox" v-model="form.p_nephrology" value="false">
                                                    <label class="form-check-label" for="p_nephrology">Nephrology</label>
                                                </div>
                                            </div>
                                            <div class="col-span-12 lg:col-span-4">
                                                <div class="form-check mb-2" v-if="form.p_neonatology && form.p_neonatology == true" >
                                                    <input id="p_neonatology" class="form-check-input" type="checkbox" v-model="form.p_neonatology" value="true">
                                                    <label class="form-check-label" for="p_neonatology">Neonatology</label>
                                                </div>
                                                <div class="form-check mb-2" v-else>
                                                    <input id="p_neonatology" class="form-check-input" type="checkbox" v-model="form.p_neonatology" value="false">
                                                    <label class="form-check-label" for="p_neonatology">Neonatology</label>
                                                </div>
                                            </div>
                                            <div class="col-span-12 lg:col-span-4">
                                                <div class="form-check mb-2" v-if="form.p_oncology && form.p_oncology == true" >
                                                    <input id="p_oncology" class="form-check-input" type="checkbox" v-model="form.p_oncology" value="true">
                                                    <label class="form-check-label" for="p_oncology">Oncology</label>
                                                </div>
                                                <div class="form-check mb-2" v-else>
                                                    <input id="p_oncology" class="form-check-input" type="checkbox" v-model="form.p_oncology" value="false">
                                                    <label class="form-check-label" for="p_oncology">Oncology</label>
                                                </div>
                                            </div>
                                            <div class="col-span-12 lg:col-span-4">
                                                <div class="form-check mb-2" v-if="form.p_endocrinology && form.p_endocrinology == true" >
                                                    <input id="p_endocrinology" class="form-check-input" type="checkbox" v-model="form.p_endocrinology" value="true">
                                                    <label class="form-check-label" for="p_endocrinology">Endocrinology</label>
                                                </div>
                                                <div class="form-check mb-2" v-else>
                                                    <input id="p_endocrinology" class="form-check-input" type="checkbox" v-model="form.p_endocrinology" value="false">
                                                    <label class="form-check-label" for="p_endocrinology">Endocrinology</label>
                                                </div>
                                            </div>
                                            <div class="col-span-12 lg:col-span-4">
                                                <div class="form-check mb-2" v-if="form.child_psychiatry && form.child_psychiatry == true" >
                                                    <input id="child_psychiatry" class="form-check-input" type="checkbox" v-model="form.child_psychiatry" value="true">
                                                    <label class="form-check-label" for="child_psychiatry">Child Psychiatry</label>
                                                </div>
                                                <div class="form-check mb-2" v-else>
                                                    <input id="child_psychiatry" class="form-check-input" type="checkbox" v-model="form.child_psychiatry" value="false">
                                                    <label class="form-check-label" for="child_psychiatry">Child Psychiatry</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="grid grid-cols-12 gap-5 pb-4">
                                    <div class="col-span-12 lg:col-span-2"></div>
                                    <div class="col-span-12 lg:col-span-2 border-bottom pb-3"></div>
                                    <div class="col-span-12 lg:col-span-2 border-bottom pb-3">
                                        <div class="form-check mt-2" v-if="form.dental && form.dental == true">
                                            <input id="dental" class="form-check-input" v-model="form.dental" type="checkbox" name="dental" value="true" checked>
                                            <label class="form-check-label" for="dental">Dental</label>
                                        </div>
                                        <div class="form-check mt-2" v-else>
                                            <input id="dental" v-model="form.dental" class="form-check-input" type="checkbox" name="dental" value="false">
                                            <label class="form-check-label" for="dental">Dental</label> 
                                        </div>
                                    </div>
                                    <div class="col-span-12 lg:col-span-6 border-bottom pb-3">
                                        <div class="grid grid-cols-12 gap-5">
                                            <div class="col-span-12 lg:col-span-6">
                                                <div class="form-check mb-2" v-if="form.oral_and_maxilo_facial_surgery && form.oral_and_maxilo_facial_surgery == true" >
                                                    <input id="oral_and_maxilo_facial_surgery" class="form-check-input" type="checkbox" v-model="form.oral_and_maxilo_facial_surgery" value="true">
                                                    <label class="form-check-label" for="oral_and_maxilo_facial_surgery">Oral and Maxilo Facial Surgery</label>
                                                </div>
                                                <div class="form-check mb-2" v-else>
                                                    <input id="oral_and_maxilo_facial_surgery" class="form-check-input" type="checkbox" v-model="form.oral_and_maxilo_facial_surgery" value="false">
                                                    <label class="form-check-label" for="oral_and_maxilo_facial_surgery">Oral and Maxilo Facial Surgery</label>
                                                </div>
                                            </div>
                                            <div class="col-span-12 lg:col-span-4">
                                                <div class="form-check mb-2" v-if="form.periodontics && form.periodontics == true" >
                                                    <input id="periodontics" class="form-check-input" type="checkbox" v-model="form.periodontics" value="true">
                                                    <label class="form-check-label" for="periodontics">Periodontics</label>
                                                </div>
                                                <div class="form-check mb-2" v-else>
                                                    <input id="periodontics" class="form-check-input" type="checkbox" v-model="form.periodontics" value="false">
                                                    <label class="form-check-label" for="periodontics">Periodontics</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="grid grid-cols-12  pb-4">
                                    <div class="col-span-12 lg:col-span-2"></div>
                                    <div class="col-span-12 lg:col-span-2">
                                        
                                    </div>
                                    <div class="col-span-12 lg:col-span-2">
                                        <div class="form-check mt-2" v-if="form.accident_and_emergency && form.accident_and_emergency == true">
                                            <input id="accident_and_emergency" class="form-check-input" v-model="form.accident_and_emergency" type="checkbox" name="accident_and_emergency" value="true" checked>
                                            <label class="form-check-label" for="accident_and_emergency">Accident &amp; Emergency</label>
                                        </div>
                                        <div class="form-check mt-2" v-else>
                                            <input id="accident_and_emergency" v-model="form.accident_and_emergency" class="form-check-input" type="checkbox" name="accident_and_emergency" value="false">
                                            <label class="form-check-label" for="accident_and_emergency">Accident &amp; Emergency</label> 
                                        </div>
                                    </div>
                                    <div class="col-span-12 lg:col-span-6 border-bottom pb-3">                                                                   
                                        <div class="form-inline">
                                            <label for="acc_number_of_beds" class="form-label sm:w-40">Number of Beds</label>
                                            <input id="acc_number_of_beds" v-model="form.acc_number_of_beds" type="number" class="form-control" >
                                        </div>
                                    </div>
                                </div>
                                <div class="grid grid-cols-12  pb-4">
                                    <div class="col-span-12 lg:col-span-2"></div>
                                    <div class="col-span-12 lg:col-span-2">
                                        <div class="form-check mt-2" v-if="form.in_patient && form.in_patient == true">
                                            <input id="in_patient" class="form-check-input" v-model="form.in_patient" type="checkbox" name="in_patient" value="true" checked>
                                            <label class="form-check-label" for="in_patient">In Patient</label>
                                        </div>
                                        <div class="form-check mt-2" v-else>
                                            <input id="in_patient" v-model="form.in_patient" class="form-check-input" type="checkbox" name="in_patient" value="false">
                                            <label class="form-check-label" for="in_patient">In Patient</label> 
                                        </div>
                                    </div>
                                    <div class="col-span-12 lg:col-span-2 border-bottom pb-3">
                                        <div class="form-check mt-2" v-if="form.admission_facilities && form.admission_facilities == true">
                                            <input id="admission_facilities" class="form-check-input" v-model="form.admission_facilities" type="checkbox" name="admission_facilities" value="true" checked>
                                            <label class="form-check-label" for="admission_facilities">Admission Facilities</label>
                                        </div>
                                        <div class="form-check mt-2" v-else>
                                            <input id="admission_facilities" v-model="form.admission_facilities" class="form-check-input" type="checkbox" name="admission_facilities" value="false">
                                            <label class="form-check-label" for="admission_facilities">Admission Facilities</label> 
                                        </div>
                                    </div>
                                    <div class="col-span-12 lg:col-span-6 border-bottom pb-3">                                                                   
                                        <div class="form-inline">
                                            <label for="adm_number_of_beds" class="form-label sm:w-40">Number of Beds</label>
                                            <input id="adm_number_of_beds" v-model="form.adm_number_of_beds" type="number" class="form-control" >
                                        </div>
                                    </div>
                                </div>
                                <div class="grid grid-cols-12  pb-4">
                                    <div class="col-span-12 lg:col-span-2"></div>
                                    <div class="col-span-12 lg:col-span-2 border-bottom pb-3"></div>
                                    <div class="col-span-12 lg:col-span-2 border-bottom pb-3">
                                        <div class="form-check mt-2" v-if="form.intensive_care_unit && form.intensive_care_unit == true">
                                            <input id="intensive_care_unit" class="form-check-input" v-model="form.intensive_care_unit" type="checkbox" name="intensive_care_unit" value="true" checked>
                                            <label class="form-check-label" for="intensive_care_unit">Intensive Care Unit</label>
                                        </div>
                                        <div class="form-check mt-2" v-else>
                                            <input id="intensive_care_unit" v-model="form.intensive_care_unit" class="form-check-input" type="checkbox" name="intensive_care_unit" value="false">
                                            <label class="form-check-label" for="intensive_care_unit">Intensive Care Unit</label> 
                                        </div>
                                    </div>
                                    <div class="col-span-12 lg:col-span-6 border-bottom pb-3">                                                                   
                                        <div class="form-inline">
                                            <label for="icu_number_of_beds" class="form-label sm:w-40">Number of Beds</label>
                                            <input id="icu_number_of_beds" v-model="form.icu_number_of_beds" type="number" class="form-control" >
                                        </div>
                                    </div>
                                </div>
                                <div class="grid grid-cols-12 pb-4">
                                    <div class="col-span-12 lg:col-span-3 border-bottom pb-3">
                                        <h5  class="font-medium text-base mr-auto">Specific Clinical Service</h5>
                                    </div>
                                    <div class="col-span-12 lg:col-span-9 border-bottom pb-3">
                                        <div class="grid grid-cols-12 gap-5">
                                            <div class="col-span-12 lg:col-span-4">
                                                <div class="form-check mb-2" v-if="form.antenatal_care && form.antenatal_care == true" >
                                                    <input id="antenatal_care" class="form-check-input" type="checkbox" v-model="form.antenatal_care" value="true">
                                                    <label class="form-check-label" for="antenatal_care">Antenatal Care</label>
                                                </div>
                                                <div class="form-check mb-2" v-else>
                                                    <input id="antenatal_care" class="form-check-input" type="checkbox" v-model="form.antenatal_care" value="false">
                                                    <label class="form-check-label" for="antenatal_care">Antenatal Care</label>
                                                </div>
                                            </div>
                                            <div class="col-span-12 lg:col-span-4">
                                                <div class="form-check mb-2" v-if="form.immunization && form.immunization == true" >
                                                    <input id="immunization" class="form-check-input" type="checkbox" v-model="form.immunization" value="true">
                                                    <label class="form-check-label" for="immunization">Immunization</label>
                                                </div>
                                                <div class="form-check mb-2" v-else>
                                                    <input id="immunization" class="form-check-input" type="checkbox" v-model="form.immunization" value="false">
                                                    <label class="form-check-label" for="immunization">Immunization</label>
                                                </div>
                                            </div>
                                            <div class="col-span-12 lg:col-span-4">
                                                <div class="form-check mb-2" v-if="form.hiv_aids_services && form.hiv_aids_services == true" >
                                                    <input id="hiv_aids_services" class="form-check-input" type="checkbox" v-model="form.hiv_aids_services" value="true">
                                                    <label class="form-check-label" for="hiv_aids_services">HIV/AIDS Services</label>
                                                </div>
                                                <div class="form-check mb-2" v-else>
                                                    <input id="hiv_aids_services" class="form-check-input" type="checkbox" v-model="form.hiv_aids_services" value="false">
                                                    <label class="form-check-label" for="hiv_aids_services">HIV/AIDS Services</label>
                                                </div>
                                            </div>
                                            <div class="col-span-12 lg:col-span-4">
                                                <div class="form-check mb-2" v-if="form.tuberculosis && form.tuberculosis == true" >
                                                    <input id="tuberculosis" class="form-check-input" type="checkbox" v-model="form.tuberculosis" value="true">
                                                    <label class="form-check-label" for="tuberculosis">Tuberculosis</label>
                                                </div>
                                                <div class="form-check mb-2" v-else>
                                                    <input id="tuberculosis" class="form-check-input" type="checkbox" v-model="form.tuberculosis" value="false">
                                                    <label class="form-check-label" for="tuberculosis">Tuberculosis</label>
                                                </div>
                                            </div>
                                            <div class="col-span-12 lg:col-span-4">
                                                <div class="form-check mb-2" v-if="form.non_communicable_diseases && form.non_communicable_diseases == true" >
                                                    <input id="non_communicable_diseases" class="form-check-input" type="checkbox" v-model="form.non_communicable_diseases" value="true">
                                                    <label class="form-check-label" for="non_communicable_diseases">Non Communicable Diseases</label>
                                                </div>
                                                <div class="form-check mb-2" v-else>
                                                    <input id="non_communicable_diseases" class="form-check-input" type="checkbox" v-model="form.non_communicable_diseases" value="false">
                                                    <label class="form-check-label" for="non_communicable_diseases">Non Communicable Diseases</label>
                                                </div>
                                            </div>
                                            <div class="col-span-12 lg:col-span-4">
                                                <div class="form-check mb-2" v-if="form.family_planning && form.family_planning == true" >
                                                    <input id="family_planning" class="form-check-input" type="checkbox" v-model="form.family_planning" value="true">
                                                    <label class="form-check-label" for="family_planning">Family Planning</label>
                                                </div>
                                                <div class="form-check mb-2" v-else>
                                                    <input id="family_planning" class="form-check-input" type="checkbox" v-model="form.family_planning" value="false">
                                                    <label class="form-check-label" for="family_planning">Family Planning</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="grid grid-cols-12 pb-4">
                                    <div class="col-span-12 lg:col-span-3 border-bottom pb-3">
                                        <h5  class="font-medium text-base mr-auto">Human Resources</h5>
                                    </div>
                                    <div class="col-span-12 lg:col-span-9 border-bottom pb-3">
                                        <div class="grid grid-cols-12 gap-5">
                                            <div class="col-span-12 lg:col-span-6">
                                                <div class="form-inline">
                                                    <label for="number_of_medical_doctors" class="form-label sm:w-40">Number of Medical Officer</label>
                                                    <input id="number_of_medical_doctors" v-model="form.number_of_medical_doctors" type="number" class="form-control" >
                                                </div>
                                            </div>
                                            <div class="col-span-12 lg:col-span-6">
                                                <div class="form-inline">
                                                    <label for="number_of_pharmacisits" class="form-label sm:w-40">Number of Pharmacists</label>
                                                    <input id="number_of_pharmacisits" v-model="form.number_of_pharmacisits" type="number" class="form-control" >
                                                </div>
                                            </div>
                                            <div class="col-span-12 lg:col-span-6">
                                                <div class="form-inline">
                                                    <label for="number_of_dentists" class="form-label sm:w-40">Number of Dentists</label>
                                                    <input id="number_of_dentists" v-model="form.number_of_dentists" type="number" class="form-control" >
                                                </div>
                                            </div>
                                            <div class="col-span-12 lg:col-span-6">
                                                <div class="form-inline">
                                                    <label for="number_of_pharmacy_technicians" class="form-label sm:w-40">Number of Pharmacy Technicians</label>
                                                    <input id="number_of_pharmacy_technicians" v-model="form.number_of_pharmacy_technicians" type="number" class="form-control" >
                                                </div>
                                            </div>
                                            <div class="col-span-12 lg:col-span-6">
                                                <div class="form-inline">
                                                    <label for="number_of_nurses_single" class="form-label sm:w-40">Number of Nurses (Single)</label>
                                                    <input id="number_of_nurses_single" v-model="form.number_of_nurses_single" type="number" class="form-control" >
                                                </div>
                                            </div>
                                            <div class="col-span-12 lg:col-span-6">
                                                <div class="form-inline">
                                                    <label for="number_of_laboratory_technicians" class="form-label sm:w-40">Number of Laboratory Technicians</label>
                                                    <input id="number_of_laboratory_technicians" v-model="form.number_of_laboratory_technicians" type="number" class="form-control" >
                                                </div>
                                            </div>
                                            <div class="col-span-12 lg:col-span-6">
                                                <div class="form-inline">
                                                    <label for="number_of_midwives_single" class="form-label sm:w-40">Number of Midwives (Single)</label>
                                                    <input id="number_of_midwives_single" v-model="form.number_of_midwives_single" type="number" class="form-control" >
                                                </div>
                                            </div>
                                            <div class="col-span-12 lg:col-span-6">
                                                <div class="form-inline">
                                                    <label for="number_of_laboratory_scientists" class="form-label sm:w-40">Number of Laboratory Scientists</label>
                                                    <input id="number_of_laboratory_scientists" v-model="form.number_of_laboratory_scientists" type="number" class="form-control" >
                                                </div>
                                            </div>
                                            <div class="col-span-12 lg:col-span-6">
                                                <div class="form-inline">
                                                    <label for="number_of_nurse_midwife_double" class="form-label sm:w-40">Number of Nurse / Midwife (Double)</label>
                                                    <input id="number_of_nurse_midwife_double" v-model="form.number_of_nurse_midwife_double" type="number" class="form-control" >
                                                </div>
                                            </div>
                                            <div class="col-span-12 lg:col-span-6">
                                                <div class="form-inline">
                                                    <label for="number_of_health_record_officers" class="form-label sm:w-40">Number of Health Records / Health Information Mgt. Officers</label>
                                                    <input id="number_of_health_record_officers" v-model="form.number_of_health_record_officers" type="number" class="form-control" >
                                                </div>
                                            </div>
                                            <div class="col-span-12 lg:col-span-6">
                                                <div class="form-inline">
                                                    <label for="number_of_community_health_officer" class="form-label sm:w-40">Number of Community Health Officer</label>
                                                    <input id="number_of_community_health_officer" v-model="form.number_of_community_health_officer" type="number" class="form-control" >
                                                </div>
                                            </div>
                                            <div class="col-span-12 lg:col-span-6">
                                                <div class="form-inline">
                                                    <label for="number_of_community_health_extension_worker" class="form-label sm:w-40">Number of Community Health Extension Worker</label>
                                                    <input id="number_of_community_health_extension_worker" v-model="form.number_of_community_health_extension_worker" type="number" class="form-control" >
                                                </div>
                                            </div>
                                            <div class="col-span-12 lg:col-span-6">
                                                <div class="form-inline">
                                                    <label for="number_of_dental_technicians" class="form-label sm:w-40">Number of Dental Technicians</label>
                                                    <input id="number_of_dental_technicians" v-model="form.number_of_dental_technicians" type="number" class="form-control" >
                                                </div>
                                            </div>
                                            <div class="col-span-12 lg:col-span-6">
                                                <div class="form-inline">
                                                    <label for="number_of_junior_community_health_extension_worker" class="form-label sm:w-40">Number of Junior Community Health Extension Workers</label>
                                                    <input id="number_of_junior_community_health_extension_worker" v-model="form.number_of_junior_community_health_extension_worker" type="number" class="form-control" >
                                                </div>
                                            </div>
                                            <div class="col-span-12 lg:col-span-6">
                                                <div class="form-inline">
                                                    <label for="number_of_environmental_health_officers" class="form-label sm:w-40">Number of Environmental Health Extension Officers</label>
                                                    <input id="number_of_environmental_health_officers" v-model="form.number_of_environmental_health_officers" type="number" class="form-control" >
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="grid grid-cols-12 pb-4">
                                    <div class="col-span-12 lg:col-span-3 border-bottom pb-3">
                                        <h5  class="font-medium text-base mr-auto">Pharmacy</h5>
                                    </div>
                                    <div class="col-span-12 lg:col-span-9 border-bottom pb-3">
                                        <div class="form-check mt-2" v-if="form.onsite_pharmacy && form.onsite_pharmacy == true">
                                            <input id="onsite_pharmacy" class="form-check-input" v-model="form.onsite_pharmacy" type="checkbox" name="onsite_pharmacy" value="true" checked>
                                            <label class="form-check-label" for="onsite_pharmacy">Onsite Pharmacy</label>
                                        </div>
                                        <div class="form-check mt-2" v-else>
                                            <input id="onsite_pharmacy" v-model="form.onsite_pharmacy" class="form-check-input" type="checkbox" name="onsite_pharmacy" value="false">
                                            <label class="form-check-label" for="onsite_pharmacy">Onsite Pharmacy</label> 
                                        </div>
                                    </div>
                                </div>
                                <div class="grid grid-cols-12  pb-4">
                                    <div class="col-span-12 lg:col-span-3 border-bottom pb-3">
                                        <h5  class="font-medium text-base mr-auto">Laboratory</h5>
                                    </div>
                                    <div class="col-span-12 lg:col-span-9 border-bottom pb-3">
                                        <div class="form-check mt-2" v-if="form.onsite_laboratory && form.onsite_laboratory == true">
                                            <input id="onsite_laboratory" class="form-check-input" v-model="form.onsite_laboratory" type="checkbox" name="onsite_laboratory" value="true" checked>
                                            <label class="form-check-label" for="onsite_laboratory">Onsite Laboratory</label>
                                        </div>
                                        <div class="form-check mt-2" v-else>
                                            <input id="onsite_laboratory" v-model="form.onsite_laboratory" class="form-check-input" type="checkbox" name="onsite_laboratory" value="false">
                                            <label class="form-check-label" for="onsite_laboratory">Onsite Laboratory</label> 
                                        </div>
                                    </div>
                                </div>
                                <div class="grid grid-cols-12  pb-4">
                                    <div class="col-span-12 lg:col-span-3 border-bottom pb-3">
                                        <h5  class="font-medium text-base mr-auto">Imaging / Radio-Diagnostic Center</h5>
                                    </div>
                                    <div class="col-span-12 lg:col-span-9 border-bottom pb-3">
                                        <div class="form-check mt-2" v-if="form.onsite_imaging_center && form.onsite_imaging_center == true">
                                            <input id="onsite_imaging_center" class="form-check-input" v-model="form.onsite_imaging_center" type="checkbox" name="onsite_imaging_center" value="true" checked>
                                            <label class="form-check-label" for="onsite_imaging_center">Onsite Imaging / Radio-Diagnostic Center</label>
                                        </div>
                                        <div class="form-check mt-2" v-else>
                                            <input id="onsite_imaging_center" v-model="form.onsite_imaging_center" class="form-check-input" type="checkbox" name="onsite_imaging_center" value="false">
                                            <label class="form-check-label" for="onsite_imaging_center">Onsite Imaging / Radio-Diagnostic Center</label> 
                                        </div>
                                    </div>
                                </div>
                                <div class="grid grid-cols-12  pb-4">
                                    <div class="col-span-12 lg:col-span-3 border-bottom pb-3">
                                        <h5  class="font-medium text-base mr-auto">Mortuary</h5>
                                    </div>
                                    <div class="col-span-12 lg:col-span-9 border-bottom pb-3">
                                        <div class="form-check mt-2" v-if="form.mortuary_services && form.mortuary_services == true">
                                            <input id="mortuary_services" class="form-check-input" v-model="form.mortuary_services" type="checkbox" name="mortuary_services" value="true" checked>
                                            <label class="form-check-label" for="mortuary_services">Mortuary Services</label>
                                        </div>
                                        <div class="form-check mt-2" v-else>
                                            <input id="mortuary_services" v-model="form.mortuary_services" class="form-check-input" type="checkbox" name="mortuary_services" value="false">
                                            <label class="form-check-label" for="mortuary_services">Mortuary Services</label> 
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="flex justify-end mt-4">
                                <button type="submit" class="btn btn-primary w-20 mr-auto">Save</button>
                                <loading v-if="loading == true"></loading>
                            </div>
                        </form>
                    </div>
                    <!-- END: Personal Information -->
                </div>
                
            </div>
        </div>
        <!-- END: Content -->
    </div>
</div>
</template>

<script>
export default {
    name: 'edit-hospital-class',
    data() {
        return {
            id: null,
            token: null,
            user: '',
            facility: '',
            form: {
                out_patient: '',
                medical: '',
                cardiology: '',
                gastroenterology: '',
                nephrology: '',
                dermatology: '',
                hematology: '',
                endocrinology: '',
                geriatrics: '',
                psychiatry: '',
                pulmonology: '',
                neurology: '',
                infectious_diseases: '',
                nuclear_medicine: '',
                family_medicine: '',
                surgical: '',
                ophthalmology: '',
                general_surgery: '',
                cardiothoracic_surgery: '',
                neuro_surgery: '',
                orthopedic_surgery: '',
                urology: '',
                otorhinolaryngology: '',
                anesthesia: '',
                oncology: '',
                radiology: '',
                vascular_surgery: '',
                pediatric_surgery: '',
                plastic_surgery: '',
                pathology: '',
                obstetrics_gynecology: '',
                obstetrics: '',
                gynecology: '',
                fertility_reproductive_techniques: '',
                pediatrics: '',
                p_gastroenterology: '',
                p_pulmonology: '',
                p_nephrology: '',
                p_neonatology: '',
                child_psychiatry: '',
                p_oncology: '',
                p_endocrinology: '',
                dental: '',
                oral_and_maxilo_facial_surgery: '',
                periodontics: '',
                in_patient: '',
                accident_and_emergency: '',
                acc_number_of_beds: '',
                admission_facilities: '',
                adm_number_of_beds: '',
                intensive_care_unit: '',
                icu_number_of_beds: '',
                antenatal_care: '',
                immunization: '',
                hiv_aids_services: '',
                tuberculosis: '',
                non_communicable_diseases: '',
                family_planning: '',
                number_of_medical_doctors: '',
                number_of_dentists: '',
                number_of_nurses_single: '',
                number_of_midwives_single: '',
                number_of_nurse_midwife_double: '',
                number_of_community_health_officer: '',
                number_of_junior_community_health_extension_worker: '',
                number_of_environmental_health_officers: '',
                number_of_pharmacisits: '',
                number_of_pharmacy_technicians: '',
                number_of_laboratory_scientists: '',
                number_of_laboratory_technicians: '',
                number_of_health_record_officers: '',
                number_of_community_health_extension_worker: '',
                number_of_dental_technicians: '',
                onsite_pharmacy: '',
                onsite_laboratory: '',
                onsite_imaging_center: '',
                mortuary_services: ''
            },
            errors: {},
            loading:false
            
        }
    },
    created() {
        this.login()
        this.getUser()
        this.getFacilitySignature()
        this.getHospitalClass()

    },
    methods: {
        login(){
            if (!User.loggedIn()) {
                this.$router.push({
                        name: 'logout'
                    })
            }else{
                this.id = User.id()
                this.token = User.token()
            }
        },
        getUser(){
            axios.get('/api/v1/user/' + this.token, {
                headers: {
                    Authorization: 'Bearer ' + this.token,
                    Accept: 'application/json'
                }
           }).then(response => (this.user = response.data))
            .catch((error) => {
                console.log(error)
                if (error.response.status == 401) {
                    this.$router.push({
                        name: 'logout'
                    })
                }
            })
        },
        
        getFacilitySignature(){
            axios.get('/api/v1/facility-details/' + this.token, {
                headers: {
                    Authorization: 'Bearer ' + this.token,
                    Accept: 'application/json'
                }
           }).then(response => (this.facility = response.data))
            .catch((error) => {
                console.log(error)
                if (error.response.status == 401) {
                    this.$router.push({
                        name: 'logout'
                    })
                }
            })
        },
        getHospitalClass(){
            axios.get('/api/v1/hospital-class/' + this.token, {
                headers: {
                    Authorization: 'Bearer ' + this.token,
                    Accept: 'application/json'
                }
           }).then(response => (this.form = response.data))
            .catch((error) => {
                console.log(error)
                if (error.response.status == 401) {
                    this.$router.push({
                        name: 'logout'
                    })
                }
            })
        },
        
        updateHospitalClass() {  
            this.loading = true
            axios.patch('/api/update-hospital-class/' + this.token, this.form)
                .then(res => {
                    //User.responseAfterLogin(res)
                    Toast.fire({
                        icon: 'success',
                        title: 'Hospital Setting Updated'
                    })
                    this.$router.push({
                        name: 'edit-medical-services'
                    })
                    
                    //document.location.href = "/login"
                })
                .catch(error => this.errors = error.response.data.errors)
                .finally(() => {
                    this.loading =  false
                }) 
        }
    }
}
</script>

<style scoped>
.border-bottom{
    border-bottom: 1px solid #aaa;
}
</style>
