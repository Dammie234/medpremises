<template>
  <div class="login" style="margin: -5px">
    <div class="container">
      <div class="block xl:grid grid-cols-2 gap-4">
        <!-- BEGIN: Login Info -->
        <div class="hidden xl:flex flex-col">
          <router-link :to="{ name: 'index' }" class="-intro-x flex items-center pt-5">
            <img alt="MedPremises" class="w-40 mt-5" :src="'../../' + logo" />
          </router-link>
          <div class="my-auto">
            <img class="-intro-x w-1/2 -mt-16" :src="'../' + illustration" />
            <div class="-intro-x text-white font-medium text-3xl leading-tight mt-10">
              A few more clicks to
              <br />
              create your account.
            </div>
            <div
              class="-intro-x mt-5 text-lg text-white text-opacity-70 dark:text-gray-500"
            >
              Create your account to manage all patients in one place.
            </div>
          </div>
        </div>
        <!-- END: Login Info -->
        <!-- BEGIN: Login Form -->

        <div class="flex py-5 my-5">
          <div
            class="my-auto mx-auto xl:ml-5 bg-white xl:bg-transparent px-5 4 py-3 rounded-md shadow-md xl:shadow-none w-full xl:w-auto"
          >
            <h2 class="intro-x font-bold text-2xl xl:text-3xl text-center xl:text-left">
              Medical Staff Registration
            </h2>
            <div v-if="error == true" class="">
              <div
                class="alert alert-outline-danger alert-dismissible show flex items-center mb-2"
                role="alert"
                v-for="(error, index) in errors"
                :key="index"
              >
                <i
                  data-feather="alert-octagon"
                  class="fa fa-exclamation-circle fa-2x mr-2"
                ></i>
                <strong class="mr-2">Whoops!</strong> {{ error }}
                <button
                  type="button"
                  class="btn-close"
                  data-bs-dismiss="alert"
                  aria-label="Close"
                >
                  <i data-feather="x" class="fa fa-times w-4 h-4"></i>
                </button>
              </div>
            </div>
            <div class="intro-x mt-2 text-gray-500 xl:hidden text-center">
              Create your account to manage all patients in one place.
            </div>
            <form @submit.prevent="register" enctype="multipart/form-data">
              <!-- BEGIN: Wizard Layout -->
              <div class="intro-y box py-5 mt-5" :disabled="loading">
                <div
                  class="relative before:hidden before:lg:block before:absolute before:w-[69%] before:h-[3px] before:top-0 before:bottom-0 before:mt-4 before:bg-slate-100 before:dark:bg-darkmode-400 flex flex-col lg:flex-row justify-center px-5"
                >
                  <div
                    class="intro-x lg:text-center flex items-center lg:block flex-1 z-10"
                  >
                    <button
                      class="w-10 h-10 rounded-full btn"
                      :class="biodata && biodata == true ? 'btn-primary' : 'bg-slate-100'"
                      @click="biodataTab"
                      type="button"
                    >
                      1
                    </button>

                    <div
                      class="lg:w-32 font-medium lg:mt-3 ml-3 lg:mx-auto"
                      :class="biodata && biodata == true ? 'text-base' : 'text-slate-600'"
                    >
                      Biodata
                    </div>
                  </div>
                  <div
                    class="intro-x lg:text-center flex items-center mt-5 lg:mt-0 lg:block flex-1 z-10"
                  >
                    <button
                      class="w-10 h-10 rounded-full btn"
                      :class="
                        education && education == true ? 'btn-primary' : 'bg-slate-100'
                      "
                      type="button"
                      @click="educationTab"
                    >
                      2
                    </button>

                    <div
                      class="lg:w-32 font-medium lg:mt-3 ml-3 lg:mx-auto"
                      :class="
                        education && education == true ? 'text-base' : 'text-slate-600'
                      "
                      type="button"
                    >
                      Education
                    </div>
                  </div>
                  <div
                    class="intro-x lg:text-center flex items-center mt-5 lg:mt-0 lg:block flex-1 z-10"
                  >
                    <button
                      class="w-10 h-10 rounded-full btn"
                      :class="
                        qualification && qualification == true
                          ? 'btn-primary'
                          : 'bg-slate-100'
                      "
                      type="button"
                      @click="qualificationTab"
                    >
                      3
                    </button>

                    <div
                      class="lg:w-32 font-medium lg:mt-3 ml-3 lg:mx-auto"
                      :class="
                        qualification && qualification == true
                          ? 'text-base'
                          : 'text-slate-600'
                      "
                      type="button"
                    >
                      Professional Qualification
                    </div>
                  </div>
                  <div
                    class="intro-x lg:text-center flex items-center mt-5 lg:mt-0 lg:block flex-1 z-10"
                  >
                    <button
                      class="w-10 h-10 rounded-full btn"
                      type="button"
                      :class="
                        experience && experience == true ? 'btn-primary' : 'bg-slate-100'
                      "
                      @click="experienceTab"
                    >
                      4
                    </button>

                    <div
                      class="lg:w-32 font-medium lg:mt-3 ml-3 lg:mx-auto"
                      :class="
                        experience && experience == true ? 'text-base' : 'text-slate-600'
                      "
                    >
                      Professional Experience
                    </div>
                  </div>
                </div>
                <div
                  class="px-5 mt-5 pt-5 border-t border-slate-200/60"
                  v-if="biodata && biodata == true"
                >
                  <div class="font-medium text-base">Biodata Settings</div>
                  <div class="grid grid-cols-12 gap-4 gap-y-5 mt-5">
                    <div class="intro-y col-span-12 sm:col-span-12">
                      <label for="name" class="form-label">Full Name</label>
                      <input
                        id="name"
                        type="text"
                        class="form-control"
                        placeholder="Enter your full name"
                        v-model="form.name"
                      />
                      <div
                        class="text-danger font-medium text-xs mt-1"
                        v-if="errors.name"
                      >
                        {{ errors.name[0] }}
                      </div>
                    </div>
                    <div class="intro-y col-span-12 sm:col-span-4">
                      <label for="practice_type" class="form-label">Practice Type</label>
                      <select
                        class="form-select sm:mr-2"
                        aria-label="Default select example"
                        v-model="form.practice_type"
                      >
                        <option
                          v-for="(practice, index) in practice_types"
                          :key="index"
                          :value="practice"
                        >
                          {{ practice }}
                        </option>
                      </select>
                      <div
                        class="text-danger font-medium text-xs mt-1"
                        v-if="errors.practice_type"
                      >
                        {{ errors.practice_type[0] }}
                      </div>
                    </div>
                    <div class="intro-y col-span-12 sm:col-span-4">
                      <label for="job_type" class="form-label">Job Type</label>
                      <v-select
                        :options="jobs"
                        label="job_type"
                        @input="(job) => updateJob(form, job)"
                      ></v-select>
                      <div
                        class="text-danger font-medium text-xs mt-1"
                        v-if="errors.job_type"
                      >
                        {{ errors.job_type[0] }}
                      </div>
                    </div>
                    <div class="intro-y col-span-12 sm:col-span-4">
                      <label for="employment_type" class="form-label"
                        >Employment Type</label
                      >
                      <select
                        id="employment_type"
                        class="form-select"
                        aria-label="Select employment type"
                        v-model="form.employment_type"
                      >
                        <option
                          v-for="(employment, index) in employment_types"
                          :key="index"
                          :value="employment"
                        >
                          {{ employment }}
                        </option>
                      </select>
                      <div
                        class="text-danger font-medium text-xs mt-1"
                        v-if="errors.employment_type"
                      >
                        {{ errors.employment_type[0] }}
                      </div>
                    </div>
                    <div
                      class="intro-y col-span-12 sm:col-span-4"
                      v-if="form.job_type != 'Pharmacist'"
                    >
                      <label for="mdcn_number" class="form-label">MDCN Number</label>
                      <input
                        id="mdcn_number"
                        type="text"
                        class="form-control"
                        placeholder="Your MDCN / Folio Number"
                        v-model="form.mdcn_number"
                      />
                      <div
                        class="text-danger font-medium text-xs mt-1"
                        v-if="errors.mdcn_number"
                      >
                        {{ errors.mdcn_number[0] }}
                      </div>
                    </div>
                    <div
                      class="intro-y col-span-12 sm:col-span-4"
                      v-if="form.job_type == 'Pharmacist'"
                    >
                      <label for="pcn_number" class="form-label">PCN Number</label>
                      <input
                        id="pcn_number"
                        type="text"
                        class="form-control"
                        placeholder="Your PCN Number"
                        v-model="form.pcn_number"
                      />
                      <div
                        class="text-danger font-medium text-xs mt-1"
                        v-if="errors.pcn_number"
                      >
                        {{ errors.pcn_number[0] }}
                      </div>
                    </div>
                    <div class="intro-y col-span-12 sm:col-span-4">
                      <label for="nin_number" class="form-label">NIN Number</label>
                      <input
                        id="nin_number"
                        type="text"
                        class="form-control"
                        placeholder="Your NIN Number"
                        v-model="form.nin_number"
                      />
                      <div
                        class="text-danger font-medium text-xs mt-1"
                        v-if="errors.nin_number"
                      >
                        {{ errors.nin_number[0] }}
                      </div>
                    </div>
                    <div class="intro-y col-span-12 sm:col-span-4">
                      <label for="gender" class="form-label">Gender</label>
                      <select id="gender" class="form-select" v-model="form.gender">
                        <option></option>
                        <option>Male</option>
                        <option>Female</option>
                      </select>
                      <div
                        class="text-danger font-medium text-xs mt-1"
                        v-if="errors.gender"
                      >
                        {{ errors.gender[0] }}
                      </div>
                    </div>
                    <div class="intro-y col-span-12 sm:col-span-4">
                      <label for="date_of_birth" class="form-label">Date of Birth</label>
                      <input
                        id="date_of_birth"
                        type="date"
                        class="form-control"
                        v-model="form.date_of_birth"
                      />
                      <div
                        class="text-danger font-medium text-xs mt-1"
                        v-if="errors.date_of_birth"
                      >
                        {{ errors.date_of_birth[0] }}
                      </div>
                    </div>
                    <div class="intro-y col-span-12 sm:col-span-4">
                      <label for="marital_status" class="form-label"
                        >Marital Status</label
                      >
                      <select
                        id="marital_status"
                        class="form-select"
                        aria-label="Default select example"
                        v-model="form.marital_status"
                      >
                        <option
                          v-for="(status, index) in statuses"
                          :key="index"
                          :value="status"
                        >
                          {{ status }}
                        </option>
                      </select>
                      <div
                        class="text-danger font-medium text-xs mt-1"
                        v-if="errors.marital_status"
                      >
                        {{ errors.marital_status[0] }}
                      </div>
                    </div>
                    <div class="intro-y col-span-12 sm:col-span-4">
                      <label for="religion" class="form-label">Religion</label>
                      <select
                        id="religion"
                        class="form-select"
                        aria-label="Default select example"
                        v-model="form.religion"
                      >
                        <option
                          v-for="(religion, index) in religions"
                          :key="index"
                          :value="religion"
                        >
                          {{ religion }}
                        </option>
                      </select>
                      <div
                        class="text-danger font-medium text-xs mt-1"
                        v-if="errors.religion"
                      >
                        {{ errors.religion[0] }}
                      </div>
                    </div>
                    <div class="intro-y col-span-12 sm:col-span-14">
                      <label for="address" class="form-label">Address</label>

                      <vue-google-autocomplete
                        ref="address"
                        id="map"
                        classname="form-control"
                        placeholder="Search Address, mouse down and press enter once found"
                        v-on:placechanged="getAddress"
                        v-on:error="handleError"
                        types=""
                        country="ng"
                      >
                      </vue-google-autocomplete>
                      <div
                        class="text-danger font-medium text-xs mt-1"
                        v-if="errors.address"
                      >
                        {{ errors.address[0] }}
                      </div>
                    </div>

                    <div class="intro-y col-span-12 sm:col-span-6">
                      <label for="mobile_phone" class="form-label"
                        >Mobile Phone Number</label
                      >
                      <input
                        id="mobile_phone"
                        type="text"
                        class="form-control"
                        placeholder="Enter valid mobile phone number"
                        v-model="form.mobile_phone"
                      />
                      <div
                        class="text-danger font-medium text-xs mt-1"
                        v-if="errors.mobile_phone"
                      >
                        {{ errors.mobile_phone[0] }}
                      </div>
                    </div>
                    <div class="intro-y col-span-12 sm:col-span-6">
                      <label for="email" class="form-label">Email Address</label>
                      <input
                        id="email"
                        type="email"
                        class="form-control"
                        placeholder="Enter valid email address"
                        v-model="form.email"
                      />
                      <div
                        class="text-danger font-medium text-xs mt-1"
                        v-if="errors.email"
                      >
                        {{ errors.email[0] }}
                      </div>
                    </div>
                    <div class="intro-y col-span-12 sm:col-span-6">
                      <label for="password" class="form-label">Password</label>
                      <input
                        id="password"
                        type="password"
                        class="form-control"
                        placeholder="Enter strong password"
                        v-model="form.password"
                      />
                      <div
                        class="text-danger font-medium text-xs mt-1"
                        v-if="errors.password"
                      >
                        {{ errors.password[0] }}
                      </div>
                    </div>
                    <div class="intro-y col-span-12 sm:col-span-6">
                      <label for="confirm_password" class="form-label"
                        >Confirm Password</label
                      >
                      <input
                        id="confirm_password"
                        type="password"
                        class="form-control"
                        placeholder="Enter password again"
                        v-model="form.password_confirmation"
                      />
                    </div>
                    <div class="intro-y col-span-12 sm:col-span-6">
                      <label for="profile_picture" class="form-label"
                        >Profile Picture</label
                      >
                      <input
                        id="profile_picture"
                        type="file"
                        class="form-control"
                        @change="onFileSelected"
                      />
                      <div
                        class="text-danger font-medium text-xs mt-1"
                        v-if="errors.profile_picture"
                      >
                        {{ errors.profile_picture[0] }}
                      </div>
                    </div>
                    <div class="intro-y col-span-12 sm:col-span-6 pt-5">
                      <img
                        v-if="form.profile_picture"
                        :src="form.profile_picture"
                        style="height: 40px; width: 40px"
                      />
                    </div>
                    <div
                      class="intro-y col-span-12 flex items-center justify-center sm:justify-end mt-5"
                    >
                      <button
                        type="button"
                        class="btn btn-primary w-24 ml-2"
                        @click="educationTab"
                      >
                        Next
                      </button>
                    </div>
                  </div>
                </div>
                <div
                  class="px-5 sm:px-20 mt-10 pt-10 border-t border-slate-200/60 dark:border-darkmode-400"
                  v-if="education && education == true"
                >
                  <div class="font-medium text-base">
                    Education Settings (Add tertiary institution only)
                  </div>
                  <div class="grid grid-cols-12 gap-4 gap-y-5 mt-5">
                    <div class="intro-y col-span-12 sm:col-span-12">
                      <label for="school_name" class="form-label">School Name</label>
                      <input
                        id="school_name"
                        type="text"
                        class="form-control"
                        placeholder="Enter name of institution"
                        v-model="form.school_name"
                      />
                      <div
                        class="text-danger font-medium text-xs mt-1"
                        v-if="errors.school_name"
                      >
                        {{ errors.school_name[0] }}
                      </div>
                    </div>
                    <div class="intro-y col-span-12 sm:col-span-6">
                      <label for="education_from" class="form-label"
                        >Education From</label
                      >
                      <input
                        id="education_from"
                        type="number"
                        class="form-control"
                        placeholder="Enter addmitted year"
                        v-model="form.education_from"
                      />
                      <div
                        class="text-danger font-medium text-xs mt-1"
                        v-if="errors.education_from"
                      >
                        {{ errors.education_from[0] }}
                      </div>
                    </div>
                    <div class="intro-y col-span-12 sm:col-span-6">
                      <label for="education_to" class="form-label">Education To</label>
                      <input
                        id="education_to"
                        type="number"
                        class="form-control"
                        placeholder="Enter name of institution"
                        v-model="form.education_to"
                      />
                      <div
                        class="text-danger font-medium text-xs mt-1"
                        v-if="errors.education_to"
                      >
                        {{ errors.education_to[0] }}
                      </div>
                    </div>
                    <div class="intro-y col-span-12 sm:col-span-12">
                      <label for="school_address" class="form-label"
                        >School Address</label
                      >
                      <input
                        id="school_address"
                        type="text"
                        class="form-control"
                        placeholder="Enter name of institution"
                        v-model="form.school_address"
                      />
                      <div
                        class="text-danger font-medium text-xs mt-1"
                        v-if="errors.school_address"
                      >
                        {{ errors.school_address[0] }}
                      </div>
                    </div>
                    <div class="intro-y col-span-12 sm:col-span-6">
                      <label for="studied_course" class="form-label"
                        >Studied Course</label
                      >
                      <input
                        id="studied_course"
                        type="text"
                        class="form-control"
                        placeholder="Enter name of institution"
                        v-model="form.studied_course"
                      />
                      <div
                        class="text-danger font-medium text-xs mt-1"
                        v-if="errors.studied_course"
                      >
                        {{ errors.studied_course[0] }}
                      </div>
                    </div>
                    <div class="intro-y col-span-12 sm:col-span-6">
                      <label for="graduated_with" class="form-label"
                        >Graduated Course</label
                      >
                      <input
                        id="graduated_with"
                        type="text"
                        class="form-control"
                        placeholder="Enter your Hons/Degree"
                        v-model="form.graduated_with"
                      />
                      <div
                        class="text-danger font-medium text-xs mt-1"
                        v-if="errors.graduated_with"
                      >
                        {{ errors.graduated_with[0] }}
                      </div>
                    </div>
                    <div
                      class="intro-y col-span-12 flex items-center justify-center sm:justify-end mt-5"
                    >
                      <button
                        type="button"
                        class="btn btn-secondary w-24"
                        @click="biodataTab"
                      >
                        Previous
                      </button>
                      <button
                        type="button"
                        class="btn btn-primary w-24 ml-2"
                        @click="qualificationTab"
                      >
                        Next
                      </button>
                    </div>
                  </div>
                </div>
                <div
                  class="px-5 sm:px-20 mt-10 pt-10 border-t border-slate-200/60 dark:border-darkmode-400"
                  v-if="qualification && qualification == true"
                >
                  <div class="font-medium text-base">
                    Professional Qualification Settings. (Enter last qualification)
                  </div>
                  <div class="grid grid-cols-12 gap-4 gap-y-5 mt-5">
                    <div class="intro-y col-span-12 sm:col-span-12">
                      <label for="qualification" class="form-label">Qualification</label>
                      <input
                        id="qualification"
                        type="text"
                        class="form-control"
                        placeholder="Enter your qualification"
                        v-model="form.qualification"
                      />
                      <div
                        class="text-danger font-medium text-xs mt-1"
                        v-if="errors.qualification"
                      >
                        {{ errors.qualification[0] }}
                      </div>
                    </div>
                    <div class="intro-y col-span-12 sm:col-span-6 md:col-span-6">
                      <label for="year" class="form-label">Year</label>
                      <input
                        id="year"
                        type="text"
                        class="form-control"
                        placeholder="Enter year"
                        v-model="form.year"
                      />
                      <div
                        class="text-danger font-medium text-xs mt-1"
                        v-if="errors.year"
                      >
                        {{ errors.year[0] }}
                      </div>
                    </div>
                    <div class="intro-y col-span-12 sm:col-span-6 md:col-span-6">
                      <label for="licensing_body" class="form-label"
                        >Licensing Body</label
                      >
                      <input
                        id="licensing_body"
                        type="text"
                        class="form-control"
                        placeholder="Enter your Hons/Degree"
                        v-model="form.licensing_body"
                      />
                      <div
                        class="text-danger font-medium text-xs mt-1"
                        v-if="errors.licensing_body"
                      >
                        {{ errors.licensing_body[0] }}
                      </div>
                    </div>

                    <div
                      class="intro-y col-span-12 flex items-center justify-center sm:justify-end mt-5"
                    >
                      <button
                        type="button"
                        class="btn btn-secondary w-24"
                        @click="educationTab"
                      >
                        Previous
                      </button>
                      <button
                        type="button"
                        class="btn btn-primary w-24 ml-2"
                        @click="experienceTab"
                      >
                        Next
                      </button>
                    </div>
                  </div>
                </div>
                <div
                  class="px-5 sm:px-20 mt-10 pt-10 border-t border-slate-200/60 dark:border-darkmode-400"
                  v-if="experience && experience == true"
                >
                  <div class="font-medium text-base">
                    Professional Experience Settings (Add last job)
                  </div>
                  <div class="grid grid-cols-12 gap-4 gap-y-5 mt-5">
                    <div class="intro-y col-span-12 sm:col-span-12">
                      <label for="facility_name" class="form-label"
                        >Facility Name (Hospital/Pharmaceutical/Laboratory Name)</label
                      >
                      <input
                        id="facility_name"
                        type="text"
                        class="form-control"
                        placeholder="Enter name of hospital/pharaceutical centre/laboratory centre"
                        v-model="form.facility_name"
                      />
                      <div
                        class="text-danger font-medium text-xs mt-1"
                        v-if="errors.facility_name"
                      >
                        {{ errors.facility_name[0] }}
                      </div>
                    </div>
                    <div class="intro-y col-span-12 sm:col-span-12">
                      <label for="facility_address" class="form-label">Address</label>
                      <input
                        id="facility_address"
                        type="text"
                        class="form-control"
                        placeholder="Enter address, city, state"
                        v-model="form.facility_address"
                      />
                      <div
                        class="text-danger font-medium text-xs mt-1"
                        v-if="errors.facility_address"
                      >
                        {{ errors.facility_address[0] }}
                      </div>
                    </div>
                    <div class="intro-y col-span-12 sm:col-span-6">
                      <label for="facility_from" class="form-label">From</label>
                      <input
                        id="facility_from"
                        type="number"
                        class="form-control"
                        placeholder="Enter employment year"
                        v-model="form.facility_from"
                      />
                      <div
                        class="text-danger font-medium text-xs mt-1"
                        v-if="errors.facility_from"
                      >
                        {{ errors.facility_from[0] }}
                      </div>
                    </div>
                    <div class="intro-y col-span-12 sm:col-span-6">
                      <label for="facility_to" class="form-label">To</label>
                      <input
                        id="facility_to"
                        type="text"
                        class="form-control"
                        placeholder="Enter employment year"
                        v-model="form.facility_to"
                      />
                      <div
                        class="text-danger font-medium text-xs mt-1"
                        v-if="errors.facility_to"
                      >
                        {{ errors.facility_to[0] }}
                      </div>
                    </div>

                    <div
                      class="intro-y col-span-12 flex items-center justify-center sm:justify-end mt-5"
                    >
                      <button
                        type="button"
                        class="btn btn-secondary w-24"
                        @click="qualificationTab"
                      >
                        Previous
                      </button>
                      <button class="btn btn-primary w-24 ml-2" type="submit">
                        Submit
                      </button>
                      <loading v-if="loading === true"></loading>
                    </div>
                  </div>
                </div>
              </div>
              <!-- END: Wizard Layout -->
            </form>
          </div>
        </div>
        <!-- END: Login Form -->
      </div>
    </div>
  </div>
</template>

<script>
import VueGoogleAutocomplete from "vue-google-autocomplete";
export default {
  name: "medical-staff-registration",
  components: { VueGoogleAutocomplete },
  created() {
    if (User.loggedIn()) {
      this.$router.push({
        name: "home",
      });
    }
  },

  data() {
    return {
      logo: "dist/images/logo-white.png",
      illustration: "dist/images/illustration.svg",
      biodata: true,
      education: false,
      experience: false,
      qualification: false,
      loading: false,
      practice_types: [
        "Medical",
        "Surgical",
        "Obstetrics & Gynecology",
        "Pediatrics",
        "Dental",
      ],
      jobs: [],
      employment_types: ["Full Staff", "Specialist", "Consultant"],
      statuses: ["Single", "Married", "Divorced", "Seperated", "Widow"],
      religions: [
        "Babism",
        "Baha i Faith",
        "Buddhism",
        "Celtic Polytheism",
        "Christianity",
        "Heathenism",
        "Hellenism",
        "Hinduism",
        "Italio-Roman Neopaganism",
        "Judaism",
        "Kemetism",
        "Muslim",
        "Semitic neopaganism",
        "Slavic neopaganism",
        "Sikhism",
        "Taoism",
        "Traditional (African)",
        "Wicca",
      ],
      address: {},
      form: {
        name: "",
        practice_type: "",
        job_type: "",
        employment_type: "",
        mdcn_number: "",
        pcn_number: "",
        nin_number: "",
        gender: "",
        date_of_birth: "",
        marital_status: "",
        religion: "",
        address: "",
        city: "",
        state: "",
        postal_code: "",
        url: "",
        country: "",
        local_government_area: "",
        gps_coordinate_longtitude: "",
        gps_coordinate_latitude: "",
        mobile_phone: "",
        profile_picture: "",
        email: "",
        password: "",
        confirm_password: "",
        school_name: "",
        education_from: "",
        education_to: "",
        school_address: "",
        studied_course: "",
        graduated_with: "",
        qualification: "",
        year: "",
        licensing_body: "",
        facility_name: "",
        facility_address: "",
        facility_from: "",
        facility_to: "",
      },
      errors: [],
      error: false,
    };
  },
  mounted() {
    // To demonstrate functionality of exposed component functions
    // Here we make focus on the user input
    this.$refs.address.blur();
  },
  created() {
    this.getJobs();
  },
  methods: {
    updateJob(form, job) {
      form.job_type = job.job_type;
    },

    biodataTab() {
      (this.biodata = true), (this.education = false);
      this.qualification = false;
      this.experience = false;
    },
    educationTab() {
      (this.biodata = false), (this.education = true), (this.qualification = false);
      this.experience = false;
    },
    qualificationTab() {
      (this.biodata = false), (this.education = false), (this.qualification = true);
      this.experience = false;
    },
    experienceTab() {
      (this.biodata = false), (this.education = false), (this.qualification = false);
      this.experience = true;
    },
    getJobs() {
      axios
        .get("/api/jobs")
        .then(({ data }) => (this.jobs = data))
        .catch();
    },
    getAddress(address, placeResultData, id) {
      this.address = address;
      this.form.address = placeResultData.formatted_address;
      this.form.city = placeResultData.address_components[3].long_name;
      this.form.state = placeResultData.address_components[5].long_name;
      this.form.local_government_area = placeResultData.address_components[4].long_name;
      this.form.country = address.country;
      this.form.postal_code = address.postal_code;
      this.form.gps_coordinate_latitude = address.latitude;
      this.form.gps_coordinate_longtitude = address.longitude;
      this.form.url = placeResultData.url;
    },
    handleError(error) {
      alert(error);
    },
    register() {
      this.loading = true;
      axios
        .post("/api/auth/staff-registration", this.form)
        .then((res) => {
          Toast.fire({
            icon: "success",
            title: "Registration Successful. Check mail to verify account.",
          });
          this.$router.push({
            name: "staff-login",
          });
        })
        .catch((error) => {
          this.error = true;
          console.log(error);
          if (error.response.status == 401) {
            this.errors.push(error.response.data.error);
          }
        })
        .finally(() => {
          this.loading = true;
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
          this.form.profile_picture = event.target.result;
        };
        console.log(event.target.result);
      }
    },
  },
};
</script>

<style scoped>
html body {
  -webkit-font-smoothing: antialiased;
  overflow-x: hidden;
  padding: 0px !important;
  font-family: Roboto;
  font-size: 0.875rem;
  line-height: 1.25rem;
  --tw-text-opacity: 1;
  color: rgba(45, 55, 72, var(--tw-text-opacity));
}
</style>
