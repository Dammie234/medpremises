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
                <top-bar title="Facility Setting"></top-bar>
                <!-- END: Top Bar -->
                <div class="intro-y flex items-center mt-8">
                    <h2 class="text-lg font-medium mr-auto">Facility Setting</h2>
                </div>
                <div class="grid grid-cols-12 gap-6">
                    <!-- BEGIN: Profile Menu -->
                    <div class="col-span-12 lg:col-span-4 xxl:col-span-3 flex lg:block flex-col-reverse">
                        <setting page="Profile Setting"></setting>
                    </div>
                    <!-- END: Profile Menu -->
                    <div class="col-span-12 lg:col-span-8 xxl:col-span-9">
                        <!-- BEGIN: Display Information -->
                        <div class="intro-y box lg:mt-5">
                            <div class="flex items-center p-5 border-b border-gray-200 dark:border-dark-5">
                                <h2 class="font-medium text-base mr-auto">Personal Information</h2>
                            </div>
                            <div class="p-5">
                                <div class="flex flex-col-reverse xl:flex-row flex-col">
                                    <form @submit.prevent="updateFacilityManager" class="flex-1 mt-6 xl:mt-0">
                                        <div class="grid grid-cols-12 gap-x-5" :disabled="loading">
                                            <div class="col-span-12 xxl:col-span-6">
                                                <div>
                                                    <label for="name" class="form-label">Display Name</label>
                                                    <input id="name" type="text" class="form-control"
                                                        placeholder="Input text" v-model="user.name" disabled />
                                                </div>
                                                <div class="mt-3">
                                                    <label for="email" class="form-label">Email Address</label>
                                                    <input id="email" type="email" class="form-control" v-model="user.email"
                                                        disabled />
                                                </div>
                                                <div class="mt-3">
                                                    <label for="nin_number" class="form-label">NIN Number</label>
                                                    <input id="nin_number" type="text" class="form-control"
                                                        v-model="user.nin_number" disabled />
                                                </div>
                                                <div class="mt-3">
                                                    <label for="role" class="form-label">Role</label>
                                                    <input id="role" type="text" class="form-control" v-model="user.role"
                                                        disabled />
                                                </div>
                                                <div class="mt-3" v-if="form.facility_type == 'Hospital'">
                                                    <label for="mdcn_number" class="form-label">MDCN Number</label>
                                                    <input id="mdcn_number" type="text" required class="form-control"
                                                        v-model="user.mdcn_number" />
                                                    <div class="text-danger font-medium text-xs mt-1"
                                                        v-if="user_errors.mdcn_number">
                                                        {{ user_errors.mdcn_number[0] }}
                                                    </div>
                                                </div>
                                                <div class="mt-3" v-if="form.facility_type == 'Pharmaceutical Premises'">
                                                    <label for="pcn_number" class="form-label">PCN Number</label>
                                                    <input id="pcn_number" type="text" required class="form-control"
                                                        v-model="user.pcn_number" />
                                                    <div class="text-danger font-medium text-xs mt-1"
                                                        v-if="user_errors.pcn_number">
                                                        {{ user_errors.pcn_number[0] }}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-primary w-20 mt-3" v-if="form.facility_type == 'Hospital' ||
                                            form.facility_type == 'Pharmaceutical Premises'
                                            ">
                                            Save
                                        </button>
                                        <loading v-if="loading == true"></loading>
                                    </form>
                                    <form @submit.prevent="updateOwnershipPicture" class="w-52 mx-auto xl:mr-0 xl:ml-6"
                                        enctype="multipart/form-data">
                                        <div class="border-2 border-dashed shadow-sm border-gray-200 dark:border-dark-5 rounded-md p-5"
                                            :disabled="loading">
                                            <div class="h-40 relative image-fit cursor-pointer zoom-in mx-auto">
                                                <img class="rounded-md" alt="Rubick Tailwind HTML Admin Template"
                                                    v-if="images.ownership_picture" :src="images.ownership_picture" />
                                                <img class="rounded-md" alt="Rubick Tailwind HTML Admin Template" v-else
                                                    :src="'../../' + form.ownership_picture" />
                                                <div title="Remove this profile photo?"
                                                    class="tooltip w-5 h-5 flex items-center justify-center absolute rounded-full text-white bg-theme-6 right-0 top-0 -mr-2 -mt-2">
                                                    <i data-feather="x" class="w-4 h-4"></i>
                                                </div>
                                            </div>
                                            <div class="mx-auto cursor-pointer relative mt-5">
                                                <input type="file" class="form-control" @change="onFileSelectedPicture" />
                                                <button type="submit" class="btn btn-primary w-full">
                                                    Change Photo
                                                </button>
                                                <loading v-if="loading == true"></loading>
                                                <div class="text-danger font-medium text-xs mt-1"
                                                    v-if="ownership_errors.ownership_picture">
                                                    {{ ownership_errors.ownership_picture[0] }}
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- END: Display Information -->
                        <!-- BEGIN: Personal Information -->
                        <div class="intro-y box mt-5">
                            <div class="flex items-center p-5 border-b border-gray-200 dark:border-dark-5">
                                <h2 class="font-medium text-base mr-auto">Facility Signature</h2>
                            </div>
                            <form @submit.prevent="updateFacilitySignature" class="p-5">
                                <div class="grid grid-cols-12 gap-x-5" :disabled="loading">
                                    <div class="col-span-12 xl:col-span-6">
                                        <div>
                                            <label for="national_facility_id" class="form-label">National Facility
                                                ID</label>
                                            <input id="national_facility_id" type="text" class="form-control"
                                                placeholder="Input text" v-model="form.national_facility_id" disabled />
                                        </div>
                                        <div class="mt-3">
                                            <label for="state_facility_id" class="form-label">State Facility ID</label>
                                            <input id="state_facility_id" type="text" class="form-control"
                                                placeholder="Input text" v-model="form.state_facility_id" disabled />
                                        </div>
                                        <div class="mt-3">
                                            <label for="cac_registration_number" class="form-label">CAC Registration
                                                Number</label>
                                            <input id="cac_registration_number" type="text" class="form-control"
                                                placeholder="Input text" v-model="form.cac_registration_number" disabled />
                                        </div>
                                        <div class="mt-3">
                                            <label for="date_of_commencement_of_operation" class="form-label">Date of
                                                Commencement of Operation</label>
                                            <input id="date_of_commencement_of_operation" type="date" class="form-control"
                                                placeholder="Input text" v-model="form.date_of_commencement_of_operation" />
                                            <div class="text-danger font-medium text-xs mt-1"
                                                v-if="errors.date_of_commencement_of_operation">
                                                {{ errors.date_of_commencement_of_operation[0] }}
                                            </div>
                                        </div>
                                        <div class="mt-3">
                                            <label for="registered_facility_name" class="form-label">Registered Facility
                                                Name</label>
                                            <input id="registered_facility_name" type="text" class="form-control"
                                                placeholder="Input text" v-model="form.registered_facility_name" disabled />
                                        </div>
                                        <div class="mt-3">
                                            <label for="ward" class="form-label">Ward</label>
                                            <input id="ward" type="text" class="form-control" placeholder="Input Ward"
                                                v-model="form.ward" />
                                            <div class="text-danger font-medium text-xs mt-1" v-if="errors.ward">
                                                {{ errors.ward[0] }}
                                            </div>
                                        </div>
                                        <div class="mt-3">
                                            <label for="facility_type" class="form-label">Facility Type</label>
                                            <input id="facility_type" type="text" class="form-control"
                                                v-model="form.facility_type" disabled />
                                            <div class="text-danger font-medium text-xs mt-1" v-if="errors.facility_type">
                                                {{ errors.facility_type[0] }}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-span-12 xl:col-span-6">
                                        <div class="">
                                            <label for="lga_serial_number" class="form-label">LGA Serial Number</label>
                                            <input id="lga_serial_number" type="text" class="form-control"
                                                placeholder="Input LGA Serial Number" v-model="form.lga_serial_number" />
                                            <div class="text-danger font-medium text-xs mt-1"
                                                v-if="errors.lga_serial_number">
                                                {{ errors.lga_serial_number[0] }}
                                            </div>
                                        </div>
                                        <div class="mt-3">
                                            <label for="physical_location" class="form-label">Physical Location</label>
                                            <vue-google-autocomplete ref="address" id="map" required
                                                classname="form-control"
                                                placeholder="Search Address, mouse down and press enter once found"
                                                v-on:placechanged="getAddress" v-on:error="handleError" types=""
                                                country="ng">
                                            </vue-google-autocomplete>
                                            <div class="text-danger font-medium text-xs mt-1"
                                                v-if="errors.physical_location">
                                                {{ errors.physical_location[0] }}
                                            </div>
                                        </div>

                                        <div class="mt-3">
                                            <label for="phone_number" class="form-label">Phone Number</label>
                                            <input id="phone_number" type="text" class="form-control"
                                                placeholder="Input Phone Number" v-model="form.phone_number" />
                                            <div class="text-danger font-medium text-xs mt-1" v-if="errors.phone_number">
                                                {{ errors.phone_number[0] }}
                                            </div>
                                        </div>
                                        <div class="mt-3">
                                            <label for="website" class="form-label">Website</label>
                                            <input id="website" type="text" class="form-control" placeholder="Input Website"
                                                v-model="form.website" />
                                            <div class="text-danger font-medium text-xs mt-1" v-if="errors.website">
                                                {{ errors.website[0] }}
                                            </div>
                                        </div>
                                        <div class="mt-3">
                                            <label for="days_of_operation" class="form-label">Days of Operation</label>
                                            <multiselect v-model="form.days" :options="options" :multiple="true"
                                                :close-on-select="false" :clear-on-select="false" :preserve-search="true"
                                                placeholder="Pick some" label="name" track-by="name"
                                                :preselect-first="true">
                                                <template slot="selection" slot-scope="{ values, isOpen }">
                                                    <span class="multiselect__single"
                                                        v-if="values.length &amp;&amp; !isOpen">
                                                        {{ values.length }} options selected
                                                    </span>
                                                </template>
                                            </multiselect>
                                            <div class="text-danger font-medium text-xs mt-1"
                                                v-if="errors.days_of_operation">
                                                {{ errors.days_of_operation[0] }}
                                            </div>
                                        </div>
                                        <div class="mt-3">
                                            <label for="hours_of_operation" class="form-label">Hours of Operation</label>
                                            <select id="hours_of_operation" class="form-select"
                                                v-model="form.hours_of_operation">
                                                <option value=""></option>
                                                <option value="24 Hours">24 Hours</option>
                                                <option value="Period Range">Period Range</option>
                                            </select>
                                            <div class="text-danger font-medium text-xs mt-1"
                                                v-if="errors.hours_of_operation">
                                                {{ errors.hours_of_operation[0] }}
                                            </div>
                                        </div>
                                        <div class="mt-3" v-if="form.hours_of_operation == 'Period Range'">
                                            <label for="specify_period" class="form-label">Specify Period</label>
                                            <input id="specify_period" type="text" class="form-control"
                                                placeholder="Input Period" v-model="form.specify_period" />
                                            <div class="text-danger font-medium text-xs mt-1" v-if="errors.specify_period">
                                                {{ errors.specify_period[0] }}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-span-12 xl:col-span-12 mt-4" v-if="form.facility_type == 'Hospital'">
                                        <div class="grid grid-cols-12">
                                            <div class="col-span-12 xl:col-span-3">
                                                <h4 class="mt-5 pt-5">Hospital/Clinic Level</h4>
                                            </div>
                                            <div class="col-span-12 xl:col-span-9">
                                                <div class="grid grid-cols-12 gap-x-5">
                                                    <div class="col-span-12 xl:col-span-4">
                                                        <div class="form-check mt-3" v-if="form.hospital_level && form.hospital_level == 'Primary'
                                                            ">
                                                            <input id="hospital_level" class="form-check-input"
                                                                v-model="form.hospital_level" type="radio"
                                                                name="vertical_radio_button" value="Primary" checked />
                                                            <label class="form-check-label"
                                                                for="hospital_level">Primary</label>
                                                        </div>
                                                        <div class="form-check mt-3" v-else>
                                                            <input id="hospital_level" v-model="form.hospital_level"
                                                                class="form-check-input" type="radio"
                                                                name="vertical_radio_button" value="Primary" />
                                                            <label class="form-check-label"
                                                                for="hospital_level">Primary</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-span-12 xl:col-span-4">
                                                        <div class="">
                                                            <label for="hospital_level_type" class="form-label">Primary
                                                                Level Type</label>
                                                            <select id="hospital_level_type" class="form-select"
                                                                v-model="form.hospital_level_type">
                                                                <option value=""></option>
                                                                <option value="Health Post">Health Post</option>
                                                                <option value="Primary Health Clinic">
                                                                    Primary Health Clinic
                                                                </option>
                                                                <option value="Primary Health Center">
                                                                    Primary Health Center
                                                                </option>
                                                            </select>
                                                            <div class="text-danger font-medium text-xs mt-1"
                                                                v-if="errors.hospital_level_type">
                                                                {{ errors.state[0] }}
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-span-12 xl:col-span-4"></div>
                                                </div>
                                                <div class="grid grid-cols-12 mt-3">
                                                    <div class="col-span-12 xl:col-span-4">
                                                        <div class="form-check" v-if="form.hospital_level && form.hospital_level == 'Secondary'
                                                            ">
                                                            <input id="hospital_level" class="form-check-input"
                                                                v-model="form.hospital_level" type="radio"
                                                                name="hospital_level" value="Secondary" checked />
                                                            <label class="form-check-label"
                                                                for="hospital_level">Secondary</label>
                                                        </div>
                                                        <div class="form-check" v-else>
                                                            <input id="hospital_level" class="form-check-input"
                                                                v-model="form.hospital_level" type="radio"
                                                                name="hospital_level" value="Secondary" />
                                                            <label class="form-check-label"
                                                                for="hospital_level">Secondary</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-span-12 xl:col-span-4"></div>
                                                    <div class="col-span-12 xl:col-span-4"></div>
                                                </div>
                                                <div class="grid grid-cols-12 mt-3 gap-x-5">
                                                    <div class="col-span-12 xl:col-span-4">
                                                        <div class="form-check mt-4" v-if="form.hospital_level && form.hospital_level == 'Tertiary'
                                                            ">
                                                            <input id="hospital_level" v-model="form.hospital_level"
                                                                class="form-check-input" type="radio" name="hospital_level"
                                                                value="Tertiary" checked />
                                                            <label class="form-check-label"
                                                                for="hospital_level">Tertiary</label>
                                                        </div>
                                                        <div class="form-check mt-4" v-else>
                                                            <input id="hospital_level" v-model="form.hospital_level"
                                                                class="form-check-input" type="radio" name="hospital_level"
                                                                value="Tertiary" />
                                                            <label class="form-check-label"
                                                                for="hospital_level">Tertiary</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-span-12 xl:col-span-4">
                                                        <div class="">
                                                            <label for="tertiary_level_type" class="form-label">Tertiary
                                                                Level Type</label>
                                                            <select id="tertiary_level_type" class="form-select"
                                                                v-model="form.tertiary_level_type">
                                                                <option value=""></option>
                                                                <option value="Teaching Hospital">
                                                                    Teaching Hospital
                                                                </option>
                                                                <option value="Speacialized Hospital">
                                                                    Speacialized Hospital
                                                                </option>
                                                            </select>
                                                            <div class="text-danger font-medium text-xs mt-1"
                                                                v-if="errors.tertiary_level_type">
                                                                {{ errors.tertiary_level_type[0] }}
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-span-12 xl:col-span-4">
                                                        <div class="" v-if="form.tertiary_level_type &&
                                                            form.tertiary_level_type == 'Speacialized Hospital'
                                                            ">
                                                            <label for="specialized_hospital_type"
                                                                class="form-label">Specialized Level Type</label>
                                                            <select id="specialized_hospital_type" class="form-select"
                                                                v-model="form.specialized_hospital_type">
                                                                <option value=""></option>
                                                                <option value="Ophthalmological Center">
                                                                    Ophthalmological Center
                                                                </option>
                                                                <option value="Otorhinolaryngology">
                                                                    Otorhinolaryngology
                                                                </option>
                                                                <option value="Orthopedic">Orthopedic</option>
                                                                <option value="Neuro-Psychiatric">
                                                                    Neuro-Psychiatric
                                                                </option>
                                                            </select>
                                                            <div class="text-danger font-medium text-xs mt-1"
                                                                v-if="errors.specialized_hospital_type">
                                                                {{ errors.specialized_hospital_type[0] }}
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-span-12 xl:col-span-12 mt-4">
                                        <div class="grid grid-cols-12">
                                            <div class="col-span-12 xl:col-span-3">
                                                <h4 class="mt-3">Ownership Details</h4>
                                                <div class="text-danger font-medium text-xs mt-1"
                                                    v-if="errors.ownership_type">
                                                    {{ errors.ownership_type[0] }}
                                                </div>
                                            </div>
                                            <div class="col-span-12 xl:col-span-9">
                                                <div class="grid grid-cols-12">
                                                    <div class="col-span-12 xl:col-span-4">
                                                        <div class="form-check" v-if="form.ownership_type && form.ownership_type == 'Public'
                                                            ">
                                                            <input id="public" class="form-check-input" type="radio"
                                                                name="ownership_type" v-model="form.ownership_type"
                                                                value="Public" checked />
                                                            <label class="form-check-label" for="public">Public</label>
                                                        </div>
                                                        <div class="form-check" v-else>
                                                            <input id="ownership_type" class="form-check-input" type="radio"
                                                                v-model="form.ownership_type" name="ownership_type"
                                                                value="Public" />
                                                            <label class="form-check-label"
                                                                for="ownership_type">Public</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-span-12 xl:col-span-8">
                                                        <div class="">
                                                            <div class="flex flex-col sm:flex-row mt-2">
                                                                <div class="form-check mr-4" v-if="form.public_type &&
                                                                    form.public_type == 'Local Governement'
                                                                    ">
                                                                    <input id="public_type" class="form-check-input"
                                                                        type="radio" name="public_type"
                                                                        v-model="form.public_type" value="Local Government"
                                                                        checked />
                                                                    <label class="form-check-label" for="public_type">Local
                                                                        Government</label>
                                                                </div>
                                                                <div class="form-check mr-4" v-else>
                                                                    <input id="public_type" class="form-check-input"
                                                                        type="radio" name="public_type"
                                                                        v-model="form.public_type"
                                                                        value="Local Government" />
                                                                    <label class="form-check-label" for="public_type">Local
                                                                        Government</label>
                                                                </div>
                                                                <div class="form-check mr-4" v-if="form.public_type &&
                                                                    form.public_type == 'State Governement'
                                                                    ">
                                                                    <input id="public_type" class="form-check-input"
                                                                        type="radio" name="public_type"
                                                                        v-model="form.public_type" value="State Government"
                                                                        checked />
                                                                    <label class="form-check-label" for="public_type">State
                                                                        Government</label>
                                                                </div>
                                                                <div class="form-check mr-4" v-else>
                                                                    <input id="public_type" class="form-check-input"
                                                                        type="radio" name="public_type"
                                                                        v-model="form.public_type"
                                                                        value="State Government" />
                                                                    <label class="form-check-label" for="public_type">State
                                                                        Government</label>
                                                                </div>
                                                            </div>
                                                            <div class="flex flex-col sm:flex-row mt-2">
                                                                <div class="form-check mr-4" v-if="form.public_type &&
                                                                    form.public_type == 'Federal Governement'
                                                                    ">
                                                                    <input id="public_type" class="form-check-input"
                                                                        type="radio" name="public_type"
                                                                        v-model="form.public_type"
                                                                        value="Federal Government" checked />
                                                                    <label class="form-check-label"
                                                                        for="public_type">Federal Government</label>
                                                                </div>
                                                                <div class="form-check mr-4" v-else>
                                                                    <input id="public_type" class="form-check-input"
                                                                        type="radio" name="public_type"
                                                                        v-model="form.public_type"
                                                                        value="Federal Government" />
                                                                    <label class="form-check-label"
                                                                        for="public_type">Federal Government</label>
                                                                </div>
                                                                <div class="form-check mr-4" v-if="form.public_type &&
                                                                    form.public_type ==
                                                                    'Military & Paramilitary formations'
                                                                    ">
                                                                    <input id="public_type" class="form-check-input"
                                                                        type="radio" name="public_type"
                                                                        v-model="form.public_type"
                                                                        value="Military & Paramilitary formations"
                                                                        checked />
                                                                    <label class="form-check-label"
                                                                        for="public_type">Military & Paramilitary
                                                                        formations</label>
                                                                </div>
                                                                <div class="form-check mr-4" v-else>
                                                                    <input id="public_type" class="form-check-input"
                                                                        type="radio" name="public_type"
                                                                        v-model="form.public_type"
                                                                        value="Military & Paramilitary formations" />
                                                                    <label class="form-check-label"
                                                                        for="public_type">Military & Paramilitary
                                                                        formations</label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="grid grid-cols-12 mt-4">
                                                    <div class="col-span-12 xl:col-span-4">
                                                        <div class="form-check" v-if="form.ownership_type && form.ownership_type == 'Private'
                                                            ">
                                                            <input id="private" class="form-check-input" type="radio"
                                                                name="ownership_type" v-model="form.ownership_type"
                                                                value="Private" checked />
                                                            <label class="form-check-label" for="private">Private</label>
                                                        </div>
                                                        <div class="form-check" v-else>
                                                            <input id="ownership_type" class="form-check-input" type="radio"
                                                                name="ownership_type" v-model="form.ownership_type"
                                                                value="Private" />
                                                            <label class="form-check-label"
                                                                for="ownership_type">Private</label>
                                                        </div>
                                                    </div>
                                                    <div class="col-span-12 xl:col-span-8">
                                                        <div class="flex flex-col sm:flex-row mt-2">
                                                            <div class="form-check mr-4" v-if="form.private_type && form.private_type == 'For Profit'
                                                                ">
                                                                <input id="private_type" class="form-check-input"
                                                                    type="radio" name="private_type"
                                                                    v-model="form.private_type" value="For Profit"
                                                                    checked />
                                                                <label class="form-check-label" for="private_type">For
                                                                    Profit</label>
                                                            </div>
                                                            <div class="form-check mr-4" v-else>
                                                                <input id="private_type" class="form-check-input"
                                                                    type="radio" name="private_type"
                                                                    v-model="form.private_type" value="For Profit" />
                                                                <label class="form-check-label" for="private_type">For
                                                                    Profit</label>
                                                            </div>
                                                            <div class="form-check mr-4" v-if="form.private_type &&
                                                                form.private_type == 'Not For Profit'
                                                                ">
                                                                <input id="private_type" class="form-check-input"
                                                                    type="radio" name="private_type"
                                                                    v-model="form.private_type" value="Not For Profit"
                                                                    checked />
                                                                <label class="form-check-label" for="private_type">Not For
                                                                    Profit</label>
                                                            </div>
                                                            <div class="form-check mr-4" v-else>
                                                                <input id="private_type" class="form-check-input"
                                                                    type="radio" name="private_type"
                                                                    v-model="form.private_type" value="Not For Profit" />
                                                                <label class="form-check-label" for="private_type">Not For
                                                                    Profit</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-span-12 xl:col-span-12 mt-4">
                                        <div class="">
                                            <label for="facility_uniqueness" class="form-label">What make your facility
                                                unique from others?</label>
                                            <vue-editor v-model="form.facility_uniqueness" id="facility_uniqueness"
                                                :editorToolbar="customToolbar"></vue-editor>
                                            <div class="text-danger font-medium text-xs mt-1"
                                                v-if="errors.facility_uniqueness">
                                                {{ errors.facility_uniqueness[0] }}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-span-12 xl:col-span-12 mt-4">
                                        <div class="grid grid-cols-12 mt-4 gap-5">
                                            <div class="col-span-12 xl:col-span-4">
                                                <div class="mt-3">
                                                    <label for="operational_status" class="form-label">Operational
                                                        Status</label>
                                                    <select id="operational_status" class="form-select"
                                                        v-model="form.operational_status">
                                                        <option value=""></option>
                                                        <option value="Operational">Operational</option>
                                                        <option value="Closed (Temporary)">Closed (Temporary)</option>
                                                        <option value="Pending Operation">Pending Operation</option>
                                                        <option value="Closed (Permanent)">Closed (Permanent)</option>
                                                        <option value="Unknown">Unknown</option>
                                                    </select>
                                                    <div class="text-danger font-medium text-xs mt-1"
                                                        v-if="errors.operational_status">
                                                        {{ errors.operational_status[0] }}
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-span-12 xl:col-span-4">
                                                <div class="mt-3">
                                                    <label for="license_status" class="form-label">License Status</label>
                                                    <select id="license_status" class="form-select"
                                                        v-model="form.license_status">
                                                        <option value=""></option>
                                                        <option value="Licensed">Licensed</option>
                                                        <option value="Not Licensed">Not Licensed</option>
                                                        <option value="Unknown">Unknown</option>
                                                    </select>
                                                    <div class="text-danger font-medium text-xs mt-1"
                                                        v-if="errors.license_status">
                                                        {{ errors.license_status[0] }}
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-span-12 xl:col-span-4"></div>
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
import VueGoogleAutocomplete from "vue-google-autocomplete";
export default {
    name: "edit-signature",
    components: { VueGoogleAutocomplete },
    data() {
        return {
            id: null,
            token: null,
            user: "",
            facility: "",
            user_errors: {},
            images: {
                ownership_picture: "",
            },
            ownership_errors: {},
            customToolbar: [
                ["bold", "italic", "underline", "strike"],
                [{ align: "" }, { align: "center" }, { align: "right" }, { align: "justify" }],
                ["blockquote", "code-block"],
                [{ list: "ordered" }, { list: "bullet" }, { list: "check" }],
                [{ indent: "-1" }, { indent: "+1" }], // outdent/indent
                ["link"],
                ["clean"],
            ],
            form: {
                facility_id: "",
                national_facility_id: "",
                state_facility_id: "",
                cac_registration_number: "",
                date_of_commencement_of_operation: "",
                state: "",
                local_government_area: "",
                ward: "",
                facility_type: "",
                lga_serial_number: "",
                physical_location: "",
                gps_coordinate_longtitude: "",
                gps_coordinate_latitude: "",
                postal_code: "",
                city: "",
                url: "",
                country: "",
                phone_number: "",
                website: "",
                logo: "",
                new_logo: "",
                days: [],
                hours_of_operation: "",
                specify_period: "",
                hospital_level: "",
                primary_level_type: "",
                tertiary_level_type: "",
                specialized_hospital_type: "",
                ownership_type: "",
                public_type: "",
                private_type: "",
                ownership_detail: "",
                ownership_picture: "",
                new_ownership_picture: "",
                facility_uniqueness: "",
                operational_status: "",
                regulatory_status: "",
                license_status: "",
            },
            address: {},
            errors: {},
            loading: false,
            options: [
                {
                    name: "Sunday",
                },
                {
                    name: "Monday",
                },
                {
                    name: "Tuesday",
                },
                {
                    name: "Wednesday",
                },
                {
                    name: "Thursday",
                },
                {
                    name: "Friday",
                },
                {
                    name: "Saturday",
                },
            ],
        };
    },
    created() {
        this.login();
        this.getUser();
        this.getFacilitySignature();
    },
    mounted() {
        this.$refs.address.blur();
    },
    methods: {
        login() {
            if (!User.loggedIn()) {
                this.$router.push({
                    name: "logout",
                });
            } else {
                this.id = User.id();
                this.token = User.token();
                this.form.facility_id = User.id();
            }
        },
        getAddress(address, placeResultData, id) {
            this.address = address;
            this.form.physical_location = placeResultData.formatted_address;
            this.form.city = placeResultData.address_components[3].long_name;
            this.form.state = placeResultData.address_components[5].long_name;
            this.form.local_government_area = placeResultData.address_components[4].long_name;
            this.form.country = address.country;
            this.form.postal_code = address.postal_code;
            this.form.gps_coordinate_latitude = address.latitude;
            this.form.gps_coordinate_longtitude = address.longitude;
            this.form.url = placeResultData.url;
            console.log(address);
        },
        handleError(error) {
            alert(error);
        },
        getUser() {
            axios
                .get("/api/v1/user/" + this.id, {
                    headers: {
                        Authorization: "Bearer " + this.token,
                        Accept: "application/json",
                    },
                })
                .then((response) => (this.user = response.data))
                .catch((error) => {
                    console.log(error);
                    if (error.response.status == 401) {
                        this.$router.push({
                            name: "logout",
                        });
                    }
                });
        },
        onFileSelected(event) {
            let file = event.target.files[0];
            if (file.size > 1048770) {
                Notification.image_validation();
            } else {
                let reader = new FileReader();
                reader.readAsDataURL(file);

                let type = file.type;
                let name = file.name;
                reader.onload = (event) => {
                    this.form.logo = event.target.result;
                };
            }
        },
        onFileSelectedPicture(event) {
            let file = event.target.files[0];
            if (file.size > 1048770) {
                Notification.image_validation();
            } else {
                let reader = new FileReader();
                reader.readAsDataURL(file);

                let type = file.type;
                let name = file.name;
                reader.onload = (event) => {
                    this.images.ownership_picture = event.target.result;
                };
            }
        },
        getFacilitySignature() {
            axios
                .get("/api/v1/facility-details/" + this.token, {
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
        updateFacilityManager() {
            this.loading = true;
            axios
                .patch("/api/update-facility-manager/" + this.token, this.user)
                .then((res) => {
                    //User.responseAfterLogin(res)
                    Toast.fire({
                        icon: "success",
                        title: "Personal Information Updated",
                    });
                    this.$router.push({
                        name: "edit-signature",
                    });
                    this.getUser();
                    this.getFacilitySignature();
                    //document.location.href = "/login"
                })
                .catch((error) => (this.user_errors = error.response.data.errors))
                .finally(() => {
                    this.loading = false;
                });
        },
        updateOwnershipPicture() {
            this.loading = true;
            axios
                .patch("/api/update-ownership-picture/" + this.token, this.images)
                .then((res) => {
                    //User.responseAfterLogin(res)
                    Toast.fire({
                        icon: "success",
                        title: "Ownership Picture Updated",
                    });
                    this.$router.push({
                        name: "edit-signature",
                    });
                    this.getUser();
                    this.getFacilitySignature();
                    this.images = {
                        ownership_picture: "",
                    };
                    //document.location.href = "/login"
                })
                .catch((error) => (this.user_errors = error.response.data.errors))
                .finally(() => {
                    this.loading = false;
                });
        },
        updateFacilitySignature() {
            this.loading = true;
            axios
                .patch("/api/update-facility-signature/" + this.token, this.form)
                .then((res) => {
                    //User.responseAfterLogin(res)
                    Toast.fire({
                        icon: "success",
                        title: "Facility Signature Updated",
                    });
                    this.$router.push({
                        name: "edit-signature",
                    });
                    this.getUser();
                    this.getFacilitySignature();
                    //document.location.href = "/login"
                })
                .catch((error) => (this.errors = error.response.data.errors))
                .finally(() => {
                    this.loading = false;
                });
        },
    },
};
</script>

<style scoped></style>
