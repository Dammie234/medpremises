<template>
  <div>
    <nav class="side-nav">
      <router-link
        :to="{ name: 'dashboard' }"
        class="intro-x flex items-center pl-5 pt-4"
        v-if="user.role == 'Facility Manager'"
      >
        <img alt="Facility Logo" class="w-6" :src="'../../../../' + facility.logo" />
        <span class="hidden xl:block text-white text-md ml-3">
          {{ facility.registered_facility_name }}
        </span>
      </router-link>
      <router-link
        :to="{ name: 'dashboard' }"
        class="intro-x flex items-center pl-5 pt-4"
        v-else
      >
        <img
          alt="Facility Logo"
          class="w-6"
          :src="'../../../../' + staff_facility.logo"
        />
        <span class="hidden xl:block text-white text-md ml-3">
          {{ staff_facility.registered_facility_name }}
        </span>
      </router-link>

      <div class="side-nav__devider my-6"></div>

      <ul>
        <li v-if="page && page == 'dashboard'">
          <router-link :to="{ name: 'dashboard' }" class="side-menu side-menu--active">
            <div class="side-menu__icon"><i class="fa fa-home"></i></div>
            <div class="side-menu__title">Dashboard</div>
          </router-link>
        </li>
        <li v-else>
          <router-link :to="{ name: 'dashboard' }" class="side-menu">
            <div class="side-menu__icon"><i class="fa fa-home"></i></div>
            <div class="side-menu__title">Dashboard</div>
          </router-link>
        </li>

        <li
          v-if="
            (facility.facility_type == 'Pharmaceutical Premises' &&
              user.role == 'Facility Manager') ||
            (facility.facility_type == 'Pharmaceutical Premises' &&
              user.job_type == 'Pharmacist') ||
            (facility.facility_type == 'Hospital' &&
              user.role == 'Facility Manager' &&
              hospital.onsite_pharmacy == true) ||
            (facility.facility_type == 'Hospital' && user.job_type == 'Pharmacist')
          "
        >
          <a
            v-if="page && page == 'pharmacy'"
            href="javascript:;"
            class="side-menu side-menu--active"
          >
            <div class="side-menu__icon"><i class="fa fa-tablets"></i></div>
            <div class="side-menu__title" @click="openPharmacy">
              Pharmacy
              <div class="side-menu__sub-icon"><i class="fa fa-chevron-down"></i></div>
            </div>
          </a>
          <a v-else href="javascript:;" class="side-menu">
            <div class="side-menu__icon"><i class="fa fa-tablets"></i></div>
            <div class="side-menu__title" @click="openPharmacy">
              Pharmacy
              <div class="side-menu__sub-icon"><i class="fa fa-chevron-down"></i></div>
            </div>
          </a>
          <ul style="display: block" class="" v-if="pharmacy == true">
            <li>
              <router-link :to="{ name: 'delivery' }" class="side-menu">
                <div class="side-menu__icon"><i class="fa fa-truck"></i></div>
                <div class="side-menu__title">Delivery</div>
              </router-link>
            </li>
            <li>
              <router-link :to="{ name: 'drug' }" class="side-menu">
                <div class="side-menu__icon"><i class="fa fa-tablets"></i></div>
                <div class="side-menu__title">Drug</div>
              </router-link>
            </li>
            <li>
              <router-link :to="{ name: 'drug-stock' }" class="side-menu">
                <div class="side-menu__icon"><i class="fa fa-tablets"></i></div>
                <div class="side-menu__title">Drug Stocks</div>
              </router-link>
            </li>
            <li>
              <router-link :to="{ name: 'drug-inflow' }" class="side-menu">
                <div class="side-menu__icon"><i class="fa fa-tablets"></i></div>
                <div class="side-menu__title">Drug Stock Inflows</div>
              </router-link>
            </li>
            <li>
              <router-link :to="{ name: 'drug-outflow-today' }" class="side-menu">
                <div class="side-menu__icon"><i class="fa fa-tablets"></i></div>
                <div class="side-menu__title">Today Drug Sales</div>
              </router-link>
            </li>
            <li>
              <router-link :to="{ name: 'drug-outflow' }" class="side-menu">
                <div class="side-menu__icon"><i class="fa fa-tablets"></i></div>
                <div class="side-menu__title">Drug Stock Outflows</div>
              </router-link>
            </li>
            <li>
              <router-link :to="{ name: 'item' }" class="side-menu">
                <div class="side-menu__icon">
                  <img
                    src="https://img.icons8.com/external-smashingstocks-detailed-outline-smashing-stocks/20/ffffff/external-groceries-shopping-and-commerce-smashingstocks-detailed-outline-smashing-stocks-2.png"
                  />
                </div>
                <div class="side-menu__title">Item</div>
              </router-link>
            </li>
            <li>
              <router-link :to="{ name: 'item-stock' }" class="side-menu">
                <div class="side-menu__icon">
                  <img
                    src="https://img.icons8.com/external-smashingstocks-detailed-outline-smashing-stocks/20/ffffff/external-groceries-shopping-and-commerce-smashingstocks-detailed-outline-smashing-stocks-2.png"
                  />
                </div>
                <div class="side-menu__title">Item Stock</div>
              </router-link>
            </li>
            <li>
              <router-link :to="{ name: 'item-inflow' }" class="side-menu">
                <div class="side-menu__icon">
                  <img
                    src="https://img.icons8.com/external-smashingstocks-detailed-outline-smashing-stocks/20/ffffff/external-groceries-shopping-and-commerce-smashingstocks-detailed-outline-smashing-stocks-2.png"
                  />
                </div>
                <div class="side-menu__title">Item Inflows</div>
              </router-link>
            </li>
            <li>
              <router-link :to="{ name: 'item-outflow-today' }" class="side-menu">
                <div class="side-menu__icon">
                  <img
                    src="https://img.icons8.com/external-smashingstocks-detailed-outline-smashing-stocks/20/ffffff/external-groceries-shopping-and-commerce-smashingstocks-detailed-outline-smashing-stocks-2.png"
                  />
                </div>
                <div class="side-menu__title">Today Item Sales</div>
              </router-link>
            </li>
            <li>
              <router-link :to="{ name: 'item-outflow' }" class="side-menu">
                <div class="side-menu__icon">
                  <img
                    src="https://img.icons8.com/external-smashingstocks-detailed-outline-smashing-stocks/20/ffffff/external-groceries-shopping-and-commerce-smashingstocks-detailed-outline-smashing-stocks-2.png"
                  />
                </div>
                <div class="side-menu__title">Item Outflows</div>
              </router-link>
            </li>
            <li>
              <router-link :to="{ name: 'pos' }" class="side-menu">
                <div class="side-menu__icon"><i class="fas fa-cart-plus"></i></div>
                <div class="side-menu__title">POS</div>
              </router-link>
            </li>
          </ul>
        </li>
        <li v-if="user.job_type == 'Pharmacy Attendants'">
          <a
            v-if="page && page == 'pharmacy'"
            href="javascript:;"
            class="side-menu side-menu--active"
          >
            <div class="side-menu__icon"><i class="fa fa-tablets"></i></div>
            <div class="side-menu__title" @click="openPharmacy">
              Pharmacy
              <div class="side-menu__sub-icon"><i class="fa fa-chevron-down"></i></div>
            </div>
          </a>
          <a v-else href="javascript:;" class="side-menu">
            <div class="side-menu__icon"><i class="fa fa-tablets"></i></div>
            <div class="side-menu__title" @click="openPharmacy">
              Pharmacy
              <div class="side-menu__sub-icon"><i class="fa fa-chevron-down"></i></div>
            </div>
          </a>
          <ul style="display: block" class="" v-if="pharmacy == true">
            <li>
              <router-link :to="{ name: 'drug-outflow-today' }" class="side-menu">
                <div class="side-menu__icon"><i class="fa fa-tablets"></i></div>
                <div class="side-menu__title">Today Drug Sales</div>
              </router-link>
            </li>

            <li>
              <router-link :to="{ name: 'item-outflow-today' }" class="side-menu">
                <div class="side-menu__icon">
                  <img
                    src="https://img.icons8.com/external-smashingstocks-detailed-outline-smashing-stocks/20/ffffff/external-groceries-shopping-and-commerce-smashingstocks-detailed-outline-smashing-stocks-2.png"
                  />
                </div>
                <div class="side-menu__title">Today Item Sales</div>
              </router-link>
            </li>

            <li>
              <router-link :to="{ name: 'pos' }" class="side-menu">
                <div class="side-menu__icon"><i class="fas fa-cart-plus"></i></div>
                <div class="side-menu__title">POS</div>
              </router-link>
            </li>
          </ul>
        </li>
        <li
          v-if="
            (user.job_type == 'Receptionist' ||
              user.job_type == 'Nurse' ||
              user.job_type == 'Medical Officer' ||
              user.role == 'Facility Manager') &&
            facility.facility_type == 'Hospital'
          "
        >
          <a
            v-if="page && page == 'patient'"
            href="javascript:;"
            class="side-menu side-menu--active"
          >
            <div class="side-menu__icon">
              <img src="https://img.icons8.com/ios/30/000000/medical-doctor.png" />
            </div>
            <div class="side-menu__title" @click="openMedical">
              Medical
              <div class="side-menu__sub-icon"><i class="fa fa-chevron-down"></i></div>
            </div>
          </a>
          <a v-else href="javascript:;" class="side-menu">
            <div class="side-menu__icon">
              <img src="https://img.icons8.com/ios/30/ffffff/medical-doctor.png" />
            </div>
            <div class="side-menu__title" @click="openMedical">
              Medical
              <div class="side-menu__sub-icon"><i class="fa fa-chevron-down"></i></div>
            </div>
          </a>
          <ul style="display: block" class="" v-if="medical == true">
            <li v-if="user.job_type == 'Receptionist' || user.role == 'Facility Manager'">
              <router-link :to="{ name: 'patient-checkins' }" class="side-menu">
                <div class="side-menu__icon">
                  <img
                    src="https://img.icons8.com/external-basicons-solid-edtgraphics/20/ffffff/external-Check-in-airport-basicons-solid-edtgraphics.png"
                  />
                </div>
                <div class="side-menu__title">Patient Checkins</div>
              </router-link>
            </li>
            <li v-if="user.job_type == 'Receptionist' || user.role == 'Facility Manager'">
              <router-link :to="{ name: 'patient-checkouts' }" class="side-menu">
                <div class="side-menu__icon">
                  <img
                    src="https://img.icons8.com/ios-filled/20/ffffff/hotel-chekc-out.png"
                  />
                </div>
                <div class="side-menu__title">Patient Checkouts</div>
              </router-link>
            </li>
            <li v-if="user.job_type == 'Receptionist' || user.role == 'Facility Manager'">
              <router-link :to="{ name: 'patient-checkin-archive' }" class="side-menu">
                <div class="side-menu__icon">
                  <img
                    src="https://img.icons8.com/external-basicons-solid-edtgraphics/20/ffffff/external-Check-in-airport-basicons-solid-edtgraphics.png"
                  />
                </div>
                <div class="side-menu__title">Patient Checkin Archive</div>
              </router-link>
            </li>
            <li v-if="user.job_type == 'Receptionist' || user.role == 'Facility Manager'">
              <router-link :to="{ name: 'visitors' }" class="side-menu">
                <div class="side-menu__icon">
                  <img
                    src="https://img.icons8.com/external-ddara-lineal-ddara/20/ffffff/external-company-visit-visitor-business-christmas-ddara-lineal-ddara.png"
                  />
                </div>
                <div class="side-menu__title">Patient Visitors</div>
              </router-link>
            </li>
            <li v-if="user.job_type == 'Receptionist' || user.role == 'Facility Manager'">
              <router-link :to="{ name: 'visitor-archive' }" class="side-menu">
                <div class="side-menu__icon">
                  <img
                    src="https://img.icons8.com/external-ddara-lineal-ddara/20/ffffff/external-company-visit-visitor-business-christmas-ddara-lineal-ddara.png"
                  />
                </div>
                <div class="side-menu__title">Patient Visitors Archive</div>
              </router-link>
            </li>
            <li
              v-if="
                user.job_type == 'Nurse' ||
                user.job_type == 'Medical Officer' ||
                user.role == 'Facility Manager'
              "
            >
              <router-link :to="{ name: 'vital-signs' }" class="side-menu">
                <div class="side-menu__icon">
                  <img
                    src="https://img.icons8.com/external-line512-zulfa-mahendra/20/ffffff/external-pulse-rate-online-pharmacy-line512-zulfa-mahendra.png"
                  />
                </div>
                <div class="side-menu__title">Vital Sign</div>
              </router-link>
            </li>
            <li
              v-if="user.job_type == 'Medical Officer' || user.role == 'Facility Manager'"
            >
              <router-link :to="{ name: 'consultations' }" class="side-menu">
                <div class="side-menu__icon">
                  <img
                    src="https://img.icons8.com/external-line512-zulfa-mahendra/20/ffffff/external-consultation-online-pharmacy-line512-zulfa-mahendra.png"
                  />
                </div>
                <div class="side-menu__title">Consultations</div>
              </router-link>
            </li>
            <li
              v-if="user.job_type == 'Medical Officer' || user.role == 'Facility Manager'"
            >
              <router-link :to="{ name: 'discharged-patients' }" class="side-menu">
                <div class="side-menu__icon">
                  <img src="https://img.icons8.com/ios-glyphs/20/ffffff/recovery.png" />
                </div>
                <div class="side-menu__title">Discharged Patients</div>
              </router-link>
            </li>
            <li v-if="user.role == 'Facility Manager' || user.job_type == 'Receptionist'">
              <router-link
                :to="{ name: 'hospital-patient-satisfactory-survies' }"
                class="side-menu"
              >
                <div class="side-menu__icon">
                  <img src="https://img.icons8.com/ios/20/ffffff/customer-survey.png" />
                </div>
                <div class="side-menu__title">Patient Satisfactory Survies</div>
              </router-link>
            </li>
            <li v-if="user.role == 'Facility Manager' || user.job_type == 'Receptionist'">
              <router-link :to="{ name: 'unpaid-invoices' }" class="side-menu">
                <div class="side-menu__icon">
                  <img
                    src="https://img.icons8.com/fluency-systems-regular/20/ffffff/file-invoice-dollar.png"
                  />
                </div>
                <div class="side-menu__title">Patient Invoices</div>
              </router-link>
            </li>
          </ul>
        </li>
        <li
          v-if="
            (facility.facility_type == 'Laboratory' && user.role == 'Facility Manager') ||
            (facility.facility_type == 'Hospital' &&
              user.role == 'Facility Manager' &&
              hospital.onsite_laboratory == true)
          "
        >
          <a
            v-if="page && page == 'lab'"
            href="javascript:;"
            class="side-menu side-menu--active"
          >
            <div class="side-menu__icon">
              <img
                src="https://img.icons8.com/external-nawicon-glyph-nawicon/30/000000/external-laboratory-back-to-school-nawicon-glyph-nawicon.png"
              />
            </div>
            <div class="side-menu__title" @click="openLab">
              Laboratory
              <div class="side-menu__sub-icon"><i class="fa fa-chevron-down"></i></div>
            </div>
          </a>
          <a href="javascript:;" v-else class="side-menu">
            <div class="side-menu__icon">
              <img
                src="https://img.icons8.com/external-nawicon-glyph-nawicon/30/ffffff/external-laboratory-back-to-school-nawicon-glyph-nawicon.png"
              />
            </div>
            <div class="side-menu__title" @click="openLab">
              Laboratory
              <div class="side-menu__sub-icon"><i class="fa fa-chevron-down"></i></div>
            </div>
          </a>
          <ul style="display: block" v-if="lab == true">
            <li>
              <router-link :to="{ name: 'lab-tests' }" class="side-menu">
                <div class="side-menu__icon">
                  <img src="https://img.icons8.com/ios/20/ffffff/lab-items.png" />
                </div>
                <div class="side-menu__title">
                  Medical Diagnostic &amp; Laboratory Tests
                </div>
              </router-link>
            </li>
            <li>
              <router-link :to="{ name: 'lab-pos' }" class="side-menu">
                <div class="side-menu__icon"><i class="fas fa-cart-plus"></i></div>
                <div class="side-menu__title">Laboratory Test POS</div>
              </router-link>
            </li>
            <li>
              <router-link :to="{ name: 'lab-patient-orders' }" class="side-menu">
                <div class="side-menu__icon">
                  <img src="https://img.icons8.com/windows/20/ffffff/test-results.png" />
                </div>
                <div class="side-menu__title">Customer Orders</div>
              </router-link>
            </li>
            <li>
              <router-link :to="{ name: 'lab-results' }" class="side-menu">
                <div class="side-menu__icon">
                  <img src="https://img.icons8.com/ios/20/ffffff/lab-items.png" />
                </div>
                <div class="side-menu__title">Customer Results</div>
              </router-link>
            </li>
            <li>
              <router-link :to="{ name: 'lab-results-today' }" class="side-menu">
                <div class="side-menu__icon">
                  <img src="https://img.icons8.com/ios/20/ffffff/lab-items.png" />
                </div>
                <div class="side-menu__title">Customer Results Today</div>
              </router-link>
            </li>
            <li v-if="facility.facility_type == 'Hospital'">
              <router-link :to="{ name: 'lab-prenatals' }" class="side-menu">
                <div class="side-menu__icon">
                  <img
                    src="https://img.icons8.com/external-wanicon-lineal-wanicon/20/ffffff/external-pregnancy-medical-wanicon-lineal-wanicon.png"
                  />
                </div>
                <div class="side-menu__title">Prenatals/Antenatals</div>
              </router-link>
            </li>
            <li v-if="facility.facility_type == 'Laboratory'">
              <router-link :to="{ name: 'laboratory-prenatals' }" class="side-menu">
                <div class="side-menu__icon">
                  <img
                    src="https://img.icons8.com/external-wanicon-lineal-wanicon/20/ffffff/external-pregnancy-medical-wanicon-lineal-wanicon.png"
                  />
                </div>
                <div class="side-menu__title">Prenatals</div>
              </router-link>
            </li>
          </ul>
        </li>
        <li
          v-if="facility.facility_type == 'Laboratory' && user.job_type == 'Receptionist'"
        >
          <a
            v-if="page && page == 'lab'"
            href="javascript:;"
            class="side-menu side-menu--active"
          >
            <div class="side-menu__icon">
              <img
                src="https://img.icons8.com/external-nawicon-glyph-nawicon/30/000000/external-laboratory-back-to-school-nawicon-glyph-nawicon.png"
              />
            </div>
            <div class="side-menu__title" @click="openLab">
              Laboratory
              <div class="side-menu__sub-icon"><i data-feather="chevron-down"></i></div>
            </div>
          </a>
          <a href="javascript:;" v-else class="side-menu">
            <div class="side-menu__icon">
              <img
                src="https://img.icons8.com/external-nawicon-glyph-nawicon/30/ffffff/external-laboratory-back-to-school-nawicon-glyph-nawicon.png"
              />
            </div>
            <div class="side-menu__title" @click="openLab">
              Laboratory
              <div class="side-menu__sub-icon"><i class="fa fa-chevron-down"></i></div>
            </div>
          </a>
          <ul style="display: block" v-if="lab == true">
            <li>
              <router-link :to="{ name: 'lab-tests' }" class="side-menu">
                <div class="side-menu__icon">
                  <img src="https://img.icons8.com/ios/20/fffffff/lab-items.png" />
                </div>
                <div class="side-menu__title">
                  Medical Diagnostic &amp; Laboratory Tests
                </div>
              </router-link>
            </li>
            <li>
              <router-link :to="{ name: 'lab-pos' }" class="side-menu">
                <div class="side-menu__icon"><i class="fas fa-cart-plus"></i></div>
                <div class="side-menu__title">Laboratory Test POS</div>
              </router-link>
            </li>
            <li>
              <router-link :to="{ name: 'lab-patient-orders' }" class="side-menu">
                <div class="side-menu__icon">
                  <img src="https://img.icons8.com/windows/20/ffffff/test-results.png" />
                </div>
                <div class="side-menu__title">Customer Orders</div>
              </router-link>
            </li>
            <li v-if="facility.facility_type == 'Hospital'">
              <router-link :to="{ name: 'lab-prenatals' }" class="side-menu">
                <div class="side-menu__icon">
                  <img
                    src="https://img.icons8.com/external-wanicon-lineal-wanicon/20/ffffff/external-pregnancy-medical-wanicon-lineal-wanicon.png"
                  />
                </div>
                <div class="side-menu__title">Prenatals/Antenatals</div>
              </router-link>
            </li>
            <li v-if="facility.facility_type == 'Laboratory'">
              <router-link :to="{ name: 'laboratory-prenatals' }" class="side-menu">
                <div class="side-menu__icon">
                  <img
                    src="https://img.icons8.com/external-wanicon-lineal-wanicon/20/ffffff/external-pregnancy-medical-wanicon-lineal-wanicon.png"
                  />
                </div>
                <div class="side-menu__title">Prenatals/Antenatals</div>
              </router-link>
            </li>
          </ul>
        </li>
        <li
          v-if="
            (user.role == 'Facility Manager' || user.role == 'Medical Staff') &&
            facility.facility_type == 'Hospital'
          "
        >
          <router-link
            v-if="page && page == 'instruction'"
            :to="{ name: 'patient-discharge-instruction' }"
            class="side-menu side-menu--active"
          >
            <div class="side-menu__icon"><i class="fa fa-file"></i></div>
            <div class="side-menu__title">Patient Discharge Instructions</div>
          </router-link>
          <router-link
            v-else
            :to="{ name: 'patient-discharge-instruction' }"
            class="side-menu"
          >
            <div class="side-menu__icon"><i class="fa fa-file"></i></div>
            <div class="side-menu__title">Patient Discharge Instructions</div>
          </router-link>
        </li>

        <li
          v-if="
            (user.job_type == 'Receptionist' ||
              user.job_type == 'Nurse' ||
              user.job_type == 'Medical Officer' ||
              user.role == 'Facility Manager') &&
            facility.facility_type == 'Hospital'
          "
        >
          <a
            v-if="page && page == 'prenatal'"
            href="javascript:;"
            class="side-menu side-menu--active"
          >
            <div class="side-menu__icon">
              <img
                src="https://img.icons8.com/external-wanicon-lineal-wanicon/30/000000/external-pregnancy-medical-wanicon-lineal-wanicon.png"
              />
            </div>
            <div class="side-menu__title" @click="openPrenatal">
              Prenatal/Antenatal
              <div class="side-menu__sub-icon"><i class="fa fa-chevron-down"></i></div>
            </div>
          </a>
          <a v-else href="javascript:;" class="side-menu">
            <div class="side-menu__icon">
              <img
                src="https://img.icons8.com/external-wanicon-lineal-wanicon/30/ffffff/external-pregnancy-medical-wanicon-lineal-wanicon.png"
              />
            </div>
            <div class="side-menu__title" @click="openPrenatal">
              Prenatal/Antenatal
              <div class="side-menu__sub-icon"><i class="fa fa-chevron-down"></i></div>
            </div>
          </a>
          <ul style="display: block" class="" v-if="prenatal == true">
            <li>
              <router-link :to="{ name: 'create-prenatal' }" class="side-menu">
                <div class="side-menu__icon">
                  <img src="https://img.icons8.com/ios/30/ffffff/plus-2-math.png" />
                </div>
                <div class="side-menu__title">Register</div>
              </router-link>
            </li>
            <li>
              <router-link :to="{ name: 'prenatals' }" class="side-menu">
                <div class="side-menu__icon">
                  <img
                    src="https://img.icons8.com/sf-regular/30/ffffff/positive-dynamic.png"
                  />
                </div>
                <div class="side-menu__title">All Prenatals/Antenatals</div>
              </router-link>
            </li>
            <li>
              <router-link :to="{ name: 'create-prenatal-admission' }" class="side-menu">
                <div class="side-menu__icon">
                  <img
                    src="https://img.icons8.com/external-coronavirus-icons-berkahicon/30/ffffff/external-admission-coronavirus-treatment-coronavirus-icons-berkahicon-3.png"
                  />
                </div>
                <div class="side-menu__title">Prenatal/Antenatal Admission</div>
              </router-link>
            </li>
            <li>
              <router-link :to="{ name: 'prenatal-admissions' }" class="side-menu">
                <div class="side-menu__icon">
                  <img
                    src="https://img.icons8.com/external-tal-revivo-bold-tal-revivo/30/ffffff/external-patient-carrying-hospital-bed-isolated-on-a-white-background-hospital-bold-tal-revivo.png"
                  />
                </div>
                <div class="side-menu__title">Admitted Prenatals/Antenatals</div>
              </router-link>
            </li>
          </ul>
        </li>
        <li
          v-if="
            (user.job_type == 'Receptionist' ||
              user.job_type == 'Nurse' ||
              user.job_type == 'Medical Officer' ||
              user.role == 'Facility Manager') &&
            facility.facility_type == 'Hospital'
          "
        >
          <a
            v-if="page && page == 'record'"
            href="javascript:;"
            class="side-menu side-menu--active"
          >
            <div class="side-menu__icon">
              <img src="https://img.icons8.com/ios/30/000000/big-data.png" />
            </div>
            <div class="side-menu__title" @click="openRecord">
              Data Records
              <div class="side-menu__sub-icon"><i class="fa fa-chevron-down"></i></div>
            </div>
          </a>
          <a v-else href="javascript:;" class="side-menu">
            <div class="side-menu__icon">
              <img src="https://img.icons8.com/ios/30/ffffff/big-data.png" />
            </div>
            <div class="side-menu__title" @click="openRecord">
              Data Records
              <div class="side-menu__sub-icon"><i class="fa fa-chevron-down"></i></div>
            </div>
          </a>
          <ul style="display: block" class="" v-if="record == true">
            <li
              v-if="
                user.job_type == 'Nurse' ||
                user.job_type == 'Medical Officer' ||
                user.role == 'Facility Manager'
              "
            >
              <router-link :to="{ name: 'death-records' }" class="side-menu">
                <div class="side-menu__icon">
                  <img src="https://img.icons8.com/ios/20/ffffff/skull.png" />
                </div>
                <div class="side-menu__title">Death</div>
              </router-link>
            </li>
          </ul>
        </li>
        <li class="side-nav__devider my-6"></li>
        <li v-if="user.role == 'Facility Manager' || user.role == 'Medical Staff'">
          <a
            v-if="page && page == 'post'"
            href="/staff/posts"
            class="side-menu side-menu--active"
          >
            <div class="side-menu__icon">
              <img src="https://img.icons8.com/ios/30/null/news.png" />
            </div>
            <div class="side-menu__title">Post</div>
          </a>
          <a v-else href="/staff/posts" class="side-menu">
            <div class="side-menu__icon">
              <img src="https://img.icons8.com/ios/30/ffffff/news.png" />
            </div>
            <div class="side-menu__title">Post</div>
          </a>
        </li>

        <li v-if="user.role == 'Facility Manager'">
          <a
            v-if="page && page == 'hr'"
            href="javascript:;"
            class="side-menu side-menu--active"
          >
            <div class="side-menu__icon">
              <img
                src="https://img.icons8.com/external-smashingstocks-detailed-outline-smashing-stocks/30/null/external-human-resources-content-marketing-smashingstocks-detailed-outline-smashing-stocks-2.png"
              />
            </div>
            <div class="side-menu__title" @click="openHR">
              Human Resource
              <div class="side-menu__sub-icon"><i class="fa fa-chevron-down"></i></div>
            </div>
          </a>
          <a v-else href="javascript:;" class="side-menu">
            <div class="side-menu__icon">
              <img
                src="https://img.icons8.com/external-smashingstocks-detailed-outline-smashing-stocks/30/ffffff/external-human-resources-content-marketing-smashingstocks-detailed-outline-smashing-stocks-2.png"
              />
            </div>
            <div class="side-menu__title" @click="openHR">
              Human Resource
              <div class="side-menu__sub-icon"><i class="fa fa-chevron-down"></i></div>
            </div>
          </a>
          <ul style="display: block" v-if="hr && hr == true">
            <li>
              <router-link :to="{ name: 'medical-staffs' }" class="side-menu">
                <div class="side-menu__icon">
                  <img src="https://img.icons8.com/ios/20/ffffff/medical-doctor.png" />
                </div>
                <div class="side-menu__title">Medical Staff</div>
              </router-link>
            </li>
            <li>
              <router-link :to="{ name: 'non-medical-staffs' }" class="side-menu">
                <div class="side-menu__icon">
                  <img src="https://img.icons8.com/ios/20/ffffff/staff.png" />
                </div>
                <div class="side-menu__title">Non Medical Staff</div>
              </router-link>
            </li>
          </ul>
        </li>
        <li>
          <a href="/" class="side-menu">
            <div class="side-menu__icon">
              <img
                src="https://img.icons8.com/external-lylac-kerismaker/30/ffffff/external-Frontend-web-development-lylac-kerismaker.png"
              />
            </div>
            <div class="side-menu__title">Front Page</div>
          </a>
        </li>
      </ul>
    </nav>
  </div>
</template>
<script>
export default {
  name: "side-menu",
  props: ["page"],
  data() {
    return {
      id: "",
      token: "",
      pharmacy: false,
      hr: false,
      lab: false,
      user: "",
      facility: "",
      hospital: "",
      staff_facility: "",
      staff: "",
      medical: false,
      record: false,
      prenatal: false,
      logo: "dist/images/logo-white.png",
    };
  },
  created() {
    this.login();
    this.getUser();
    this.getFacilitySignature();
    this.getMedicalStaffFacility();
    this.getHospitalClass();
    this.getStaff();
  },
  methods: {
    login() {
      if (User.loggedIn()) {
        this.id = User.id();
        this.token = User.token();
      }
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
    getHospitalClass() {
      axios
        .get("/api/v1/hospital-class/" + this.id, {
          headers: {
            Authorization: "Bearer " + this.token,
            Accept: "application/json",
          },
        })
        .then((response) => (this.hospital = response.data))
        .catch((error) => {
          console.log(error);
          if (error.response.status == 401) {
            this.$router.push({
              name: "logout",
            });
          }
        });
    },
    getFacilitySignature() {
      axios
        .get("/api/v1/facility-details/" + this.id, {
          headers: {
            Authorization: "Bearer " + this.token,
            Accept: "application/json",
          },
        })
        .then((response) => (this.facility = response.data))
        .catch((error) => {
          console.log(error);
          if (error.response.status == 401) {
            this.$router.push({
              name: "logout",
            });
          }
        });
    },
    getMedicalStaffFacility() {
      axios
        .get("/api/v1/medical-staff-facility/" + this.id, {
          headers: {
            Authorization: "Bearer " + this.token,
            Accept: "application/json",
          },
        })
        .then((response) => (this.staff_facility = response.data))
        .catch((error) => {
          console.log(error);
          if (error.response.status == 401) {
            this.$router.push({
              name: "logout",
            });
          }
        });
    },
    getStaff() {
      axios
        .get("/api/v1/staff/" + this.id, {
          headers: {
            Authorization: "Bearer " + this.token,
            Accept: "application/json",
          },
        })
        .then((response) => (this.staff = response.data.biodata))
        .catch((error) => {
          console.log(error);
          if (error.response.status == 401) {
            this.$router.push({
              name: "logout",
            });
          }
        });
    },
    openPharmacy() {
      if (this.pharmacy == false) {
        this.pharmacy = true;
      } else {
        this.pharmacy = false;
      }
    },
    openPrenatal() {
      if (this.prenatal == false) {
        this.prenatal = true;
      } else {
        this.prenatal = false;
      }
    },
    openMedical() {
      if (this.medical == false) {
        this.medical = true;
      } else {
        this.medical = false;
      }
    },
    openRecord() {
      if (this.record == false) {
        this.record = true;
      } else {
        this.record = false;
      }
    },
    openHR() {
      if (this.hr == false) {
        this.hr = true;
      } else {
        this.hr = false;
      }
    },
    openLab() {
      if (this.lab == false) {
        this.lab = true;
      } else {
        this.lab = false;
      }
    },
  },
};
</script>
