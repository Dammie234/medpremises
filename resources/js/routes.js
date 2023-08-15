
let login = require('./components/auth/login.vue').default;
let staff_login = require('./components/auth/staff_login.vue').default;

let facility_registration = require('./components/auth/facility_registration.vue').default;
let medical_staff_registration = require('./components/auth/medical_staff.vue').default;
let forget = require('./components/auth/forget.vue').default;
let logout = require('./components/auth/logout.vue').default;
let register = require('./components/auth/register.vue').default;
let patient_logout = require('./components/auth/patient_logout.vue').default;


let dashboard = require('./components/dashboard.vue').default;
let patient_dashboard = require('./components/patient/dashboard.vue').default;

let edit_signature = require('./components/facility/edit_signature.vue').default;
let edit_hospital_class = require('./components/facility/edit_hospital_class.vue').default;
let signature = require('./components/facility/signature.vue').default;
let laboratory_tests = require('./components/facility/laboratory_tests.vue').default;
let edit_medical_services = require('./components/facility/edit_medical_services.vue').default;

let delivery = require('./components/pharmacy/delivery/index.vue').default;
let edit_delivery = require('./components/pharmacy/delivery/edit.vue').default;

let medical_staffs = require('./components/hr/medical_staffs.vue').default;
let medical_staff = require('./components/hr/medical_staff.vue').default;
let non_medical_staffs = require('./components/hr/non_medical_staffs.vue').default;


let drug = require('./components/pharmacy/drug/index.vue').default;
let edit_drug = require('./components/pharmacy/drug/edit.vue').default;
let drug_stock = require('./components/pharmacy/drug/stock.vue').default;
let drug_inflow = require('./components/pharmacy/drug/inflow.vue').default;
let drug_inflow_date = require('./components/pharmacy/drug/date_inflow.vue').default;
let drug_inflow_month = require('./components/pharmacy/drug/month_inflow.vue').default;
let drug_outflow = require('./components/pharmacy/drug/outflow.vue').default;
let drug_outflow_month = require('./components/pharmacy/drug/month_outflow.vue').default;
let drug_outflow_today = require('./components/pharmacy/drug/today.vue').default;
let drug_outflow_date = require('./components/pharmacy/drug/date.vue').default;

let item = require('./components/pharmacy/item/index.vue').default;
let edit_item = require('./components/pharmacy/item/edit.vue').default;
let item_stock = require('./components/pharmacy/item/stock.vue').default;
let item_inflow = require('./components/pharmacy/item/inflow.vue').default;
let item_inflow_date = require('./components/pharmacy/item/date_inflow.vue').default;
let item_inflow_month = require('./components/pharmacy/item/month_inflow.vue').default;
let item_outflow = require('./components/pharmacy/item/outflow.vue').default;
let item_outflow_month = require('./components/pharmacy/item/month_outflow.vue').default;
let item_outflow_today = require('./components/pharmacy/item/today.vue').default;
let item_outflow_date = require('./components/pharmacy/item/date.vue').default;

let pos = require('./components/pharmacy/pos/index.vue').default;
let pharmacy_invoice = require('./components/pharmacy/pos/invoice.vue').default;

let edit_profile = require('./components/profile/edit.vue').default;
let profile = require('./components/profile/index.vue').default;
let change_password = require('./components/profile/change_password.vue').default;

let edit_patient_profile = require('./components/patient/profile/edit.vue').default;
let patient_profile = require('./components/patient/profile/index.vue').default;
let change_patient_password = require('./components/patient/profile/change_password.vue').default;

let lab_tests = require('./components/laboratory/laboratory_tests.vue').default;
let lab_pos = require('./components/laboratory/lab_pos.vue').default;
let lab_invoice = require('./components/laboratory/invoice.vue').default;
let lab_patient_orders = require('./components/laboratory/patient_orders.vue').default;
let add_lab_result = require('./components/laboratory/add_lab_result.vue').default;
let lab_results = require('./components/laboratory/lab_results.vue').default;
let lab_result = require('./components/laboratory/lab_result.vue').default;
let lab_results_today = require('./components/laboratory/lab_results_today.vue').default;
let lab_results_date = require('./components/laboratory/lab_results_date.vue').default;
let lab_results_month = require('./components/laboratory/lab_results_month.vue').default;
let lab_prenatals = require('./components/laboratory/prenatal/index.vue').default;
let laboratory_prenatals = require('./components/laboratory/prenatal/laboratory_prenatals.vue').default;
let lab_prenatal = require('./components/laboratory/prenatal/show.vue').default;
let lab_prenatal_tests = require('./components/laboratory/prenatal/tests.vue').default;
let lab_prenatal_pos = require('./components/laboratory/prenatal/lab_pos.vue').default;
let prenatal_lab_results = require('./components/laboratory/prenatal/results.vue').default;

let posts = require('./components/post/index.vue').default;
let edit_post = require('./components/post/edit.vue').default;
let post = require('./components/post/show.vue').default;

let index = require('./components/frontend/index.vue').default;
let frontend_posts = require('./components/frontend/posts.vue').default;
let frontend_post = require('./components/frontend/post.vue').default;
let frontend_facility = require('./components/frontend/facility.vue').default;
let frontend_pharmacies = require('./components/frontend/pharmacies.vue').default;
let frontend_laboratories = require('./components/frontend/laboratories.vue').default;
let frontend_private_hospitals = require('./components/frontend/private_hospitals.vue').default;
let frontend_public_hospitals = require('./components/frontend/public_hospitals.vue').default;
let frontend_diseases = require('./components/frontend/disease.vue').default;
let frontend_laboratory_tests = require('./components/frontend/test.vue').default;

let patient_checkins = require('./components/checkin/index.vue').default;

let patient_checkin_archive = require('./components/checkin_archive/index.vue').default;
let patient_checkin_archive_date = require('./components/checkin_archive/date.vue').default;
let patient_checkin_archive_month = require('./components/checkin_archive/month.vue').default;

let patient_checkouts = require('./components/checkout/index.vue').default;

let vital_signs = require('./components/medical/vital_sign/index.vue').default;

let consultations = require('./components/medical/consultation/index.vue').default;
let medical_history = require('./components/medical/consultation/medical_history.vue').default;
let medical_examination = require('./components/medical/consultation/medical_examination.vue').default;
let medical_diagnostic = require('./components/medical/consultation/medical_diagnostic.vue').default;
let medical_investigation = require('./components/medical/consultation/medical_investigation.vue').default;
let medical_treatment = require('./components/medical/consultation/medical_treatment.vue').default;
let medical_service = require('./components/medical/consultation/medical_service.vue').default;
let medical_prescribed_drug = require('./components/medical/consultation/medical_prescribed_drug.vue').default;
let medical_laboratory_tests = require('./components/medical/consultation/medical_laboratory_tests.vue').default;


let drug_prescription_plan = require('./components/medical/consultation/drug_prescription_plan.vue').default;

let medical_treatment_plan = require('./components/medical/consultation/medical_treatment_plan.vue').default;

let progress_note = require('./components/medical/consultation/progress_note.vue').default;

let nurse_documentation = require('./components/medical/documentation/index.vue').default;
let edit_nurse_documentation = require('./components/medical/documentation/edit.vue').default;

let previous_consultation = require('./components/medical/previous_consultation/index.vue').default;
let show_previous_consultation = require('./components/medical/previous_consultation/show.vue').default;

let unpaid_invoices = require('./components/invoices/unpaid_invoices.vue').default;
let invoices = require('./components/invoices/invoices.vue').default;
let invoice = require('./components/invoices/invoice.vue').default;
let paid_invoice = require('./components/invoices/paid_invoice.vue').default;

let hospital_visits = require('./components/patient/visit/hospital_visits.vue').default;
let hospital_visit = require('./components/patient/visit/hospital_visit.vue').default;

let patient_satisfactory_survey = require('./components/patient/patient_satisfactory_survey/index.vue').default;

let patient_prenatals = require('./components/patient/prenatal/index.vue').default;
let patient_prenatal = require('./components/patient/prenatal/show.vue').default;
let patient_prenatal_visits = require('./components/patient/prenatal/visits/index.vue').default;

let patient_prenatal_first_visit = require('./components/patient/prenatal/visits/first_visit.vue').default;
let patient_prenatal_19_20_visit = require('./components/patient/prenatal/visits/19_20_week.vue').default;
let patient_prenatal_22_visit = require('./components/patient/prenatal/visits/22_week.vue').default;
let patient_prenatal_26_27_visit = require('./components/patient/prenatal/visits/26_27_week.vue').default;
let patient_prenatal_28_visit = require('./components/patient/prenatal/visits/28_week.vue').default;
let patient_prenatal_32_visit = require('./components/patient/prenatal/visits/32_week.vue').default;
let patient_prenatal_34_36_visit = require('./components/patient/prenatal/visits/34_36_week.vue').default;
let patient_prenatal_38_39_visit = require('./components/patient/prenatal/visits/38_39_week.vue').default;
let patient_prenatal_40_41_visit = require('./components/patient/prenatal/visits/40_41_week.vue').default;

let patient_prenatal_admission = require('./components/patient/prenatal/admission.vue').default;

let patient_prenatal_laboratory_results = require('./components/patient/prenatal/laboratory/results.vue').default;
let patient_prenatal_laboratory_result = require('./components/patient/prenatal/laboratory/result.vue').default;

let outpatient_visit = require('./components/medical/outpatient_visit/index.vue').default;

let death_records = require('./components/records/death/index.vue').default;
let create_death_record = require('./components/records/death/create.vue').default;
let edit_death_record = require('./components/records/death/edit.vue').default;
let death_record = require('./components/records/death/show.vue').default;

let make_payment = require('./components/deposit/make_payment.vue').default;
let update_payment = require('./components/deposit/update_payment.vue').default;

let patient_discharge_instruction = require('./components/medical/patient_discharge_instruction/index.vue').default;

let create_discharge_patient = require('./components/medical/discharge_patient/create.vue').default;
let discharged_patients = require('./components/medical/discharge_patient/index.vue').default;
let discharged_patient = require('./components/medical/discharge_patient/show.vue').default;

let edit_discharge_planning_checklist_staff = require('./components/medical/discharge_planning_checklist/index.vue').default;
let edit_discharge_planning_checklist_patient = require('./components/patient/discharge_planning_checklist/index.vue').default;

let create_prenatal = require('./components/medical/prenatal/create.vue').default;
let prenatals = require('./components/medical/prenatal/index.vue').default;
let prenatal = require('./components/medical/prenatal/show.vue').default;
let prenatal_visit = require('./components/medical/prenatal/prenatal_visit/index.vue').default;
let edit_prenatal = require('./components/medical/prenatal/edit.vue').default;

let lactation_interview = require('./components/medical/prenatal/lactation/index.vue').default;

let create_prenatal_first_visit = require('./components/medical/prenatal/prenatal_visit/first_visit/create.vue').default;
let edit_prenatal_first_visit = require('./components/medical/prenatal/prenatal_visit/first_visit/edit.vue').default;
let prenatal_first_visit = require('./components/medical/prenatal/prenatal_visit/first_visit/show.vue').default;

let create_prenatal_19_20_week = require('./components/medical/prenatal/prenatal_visit/19_20_week/create.vue').default;
let edit_prenatal_19_20_week = require('./components/medical/prenatal/prenatal_visit/19_20_week/edit.vue').default;
let prenatal_19_20_week = require('./components/medical/prenatal/prenatal_visit/19_20_week/show.vue').default;

let create_prenatal_22_week = require('./components/medical/prenatal/prenatal_visit/22_week/create.vue').default;
let edit_prenatal_22_week = require('./components/medical/prenatal/prenatal_visit/22_week/edit.vue').default;
let prenatal_22_week = require('./components/medical/prenatal/prenatal_visit/22_week/show.vue').default;

let create_prenatal_26_27_week = require('./components/medical/prenatal/prenatal_visit/26_27_week/create.vue').default;
let edit_prenatal_26_27_week = require('./components/medical/prenatal/prenatal_visit/26_27_week/edit.vue').default;
let prenatal_26_27_week = require('./components/medical/prenatal/prenatal_visit/26_27_week/show.vue').default;

let create_prenatal_28_week = require('./components/medical/prenatal/prenatal_visit/28_week/create.vue').default;
let edit_prenatal_28_week = require('./components/medical/prenatal/prenatal_visit/28_week/edit.vue').default;
let prenatal_28_week = require('./components/medical/prenatal/prenatal_visit/28_week/show.vue').default;

let create_prenatal_32_week = require('./components/medical/prenatal/prenatal_visit/32_week/create.vue').default;
let edit_prenatal_32_week = require('./components/medical/prenatal/prenatal_visit/32_week/edit.vue').default;
let prenatal_32_week = require('./components/medical/prenatal/prenatal_visit/32_week/show.vue').default;

let create_prenatal_34_36_week = require('./components/medical/prenatal/prenatal_visit/34_36_week/create.vue').default;
let edit_prenatal_34_36_week = require('./components/medical/prenatal/prenatal_visit/34_36_week/edit.vue').default;
let prenatal_34_36_week = require('./components/medical/prenatal/prenatal_visit/34_36_week/show.vue').default;

let create_prenatal_38_39_week = require('./components/medical/prenatal/prenatal_visit/38_39_week/create.vue').default;
let edit_prenatal_38_39_week = require('./components/medical/prenatal/prenatal_visit/38_39_week/edit.vue').default;
let prenatal_38_39_week = require('./components/medical/prenatal/prenatal_visit/38_39_week/show.vue').default;

let create_prenatal_40_41_week = require('./components/medical/prenatal/prenatal_visit/40_41_week/create.vue').default;
let edit_prenatal_40_41_week = require('./components/medical/prenatal/prenatal_visit/40_41_week/edit.vue').default;
let prenatal_40_41_week = require('./components/medical/prenatal/prenatal_visit/40_41_week/show.vue').default;

let hospital_patient_satisfactory_survies = require('./components/medical/patient_satisfactory_survey/index.vue').default;
let hospital_patient_satisfactory_survey = require('./components/medical/patient_satisfactory_survey/show.vue').default;

let visitor = require('./components/visitor/index.vue').default;
let visitor_archive = require('./components/visitor_archive/index.vue').default;
let visitor_archive_date = require('./components/visitor_archive/date.vue').default;
let visitor_archive_month = require('./components/visitor_archive/month.vue').default;

let create_prenatal_admission = require('./components/medical/prenatal/admission/create.vue').default;
let prenatal_admissions = require('./components/medical/prenatal/admission/index.vue').default;
let edit_prenatal_admission = require('./components/medical/prenatal/admission/edit.vue').default;
let prenatal_admission = require('./components/medical/prenatal/admission/show.vue').default;

let pregnancy_outcome = require('./components/medical/prenatal/pregnancy_outcome/index.vue').default;

export const routes = [
    { path: '/sign-in', component: login, name: 'login' },
    { path: '/staff/sign-in', component: staff_login, name: 'staff-login' },

    { path: '/facility/sign-up', component: facility_registration, name: 'facility-registration' },
    { path: '/medical-staff/sign-up', component: medical_staff_registration, name: 'medical-staff-registration' },
    { path: '/forgot-password', component: forget, name: 'forgot' },
    { path: '/sign-out', component: logout, name: 'logout' },
    { path: '/patient-sign-out', component: patient_logout, name: 'patient-logout' },

    { path: '/sign-up', component: register, name: 'register' },

    { path: '/dashboard', component: dashboard, name: 'dashboard' },
    { path: '/patient', component: patient_dashboard, name: 'patient-dashboard' },


    { path: '/facility/signature/edit', component: edit_signature, name: 'edit-signature' },
    { path: '/facility/hospital-class/edit', component: edit_hospital_class, name: 'edit-hospital-class' },
    { path: '/facility/signature', component: signature, name: 'signature' },
    { path: '/facility/laboratory-tests', component: laboratory_tests, name: 'laboratory-tests' },
    { path: '/facility/medical-services/edit', component: edit_medical_services, name: 'edit-medical-services' },

    { path: '/pharmacy/delivery', component: delivery, name: 'delivery' },
    { path: '/pharmacy/delivery/edit/:id', component: edit_delivery, name: 'edit-delivery' },

    { path: '/pharmacy/drug', component: drug, name: 'drug' },
    { path: '/pharmacy/drug/edit/:id', component: edit_drug, name: 'edit-drug' },
    { path: '/pharmacy/drug/stock', component: drug_stock, name: 'drug-stock' },
    { path: '/pharmacy/drug/inflows', component: drug_inflow, name: 'drug-inflow' },
    { path: '/pharmacy/drug/outflows', component: drug_outflow, name: 'drug-outflow' },
    { path: '/pharmacy/drug/inflows/dates/:date', component: drug_inflow_date, name: 'drug-inflow-date' },
    { path: '/pharmacy/drug/inflows/months/:month', component: drug_inflow_month, name: 'drug-inflow-month' },
    { path: '/pharmacy/drug/outflows/months/:month', component: drug_outflow_month, name: 'drug-outflow-month' },
    { path: '/pharmacy/drug/outflows/dates/:date', component: drug_outflow_date, name: 'drug-outflow-date' },
    { path: '/pharmacy/drug/outflows/today', component: drug_outflow_today, name: 'drug-outflow-today' },

    { path: '/pharmacy/item', component: item, name: 'item' },
    { path: '/pharmacy/item/edit/:id', component: edit_item, name: 'edit-item' },
    { path: '/pharmacy/item/stock', component: item_stock, name: 'item-stock' },
    { path: '/pharmacy/item/inflows', component: item_inflow, name: 'item-inflow' },
    { path: '/pharmacy/item/inflows/dates/:date', component: item_inflow_date, name: 'item-inflow-date' },
    { path: '/pharmacy/item/inflows/months/:month', component: item_inflow_month, name: 'item-inflow-month' },
    { path: '/pharmacy/item/outflows', component: item_outflow, name: 'item-outflow' },
    { path: '/pharmacy/item/outflows/months/:month', component: item_outflow_month, name: 'item-outflow-month' },
    { path: '/pharmacy/item/outflows/today', component: item_outflow_today, name: 'item-outflow-today' },
    { path: '/pharmacy/item/outflows/dates/:date', component: item_outflow_date, name: 'item-outflow-date' },

    { path: '/pharmacy/pos', component: pos, name: 'pos' },
    { path: '/pharmacy/pos/invoice', component: pharmacy_invoice, name: 'pharmacy-invoice' },

    { path: '/facility/hr/medical-staffs', component: medical_staffs, name: 'medical-staffs' },
    { path: '/facility/hr/medical-staffs/:id', component: medical_staff, name: 'medical-staff' },
    { path: '/facility/hr/non-medical-staffs', component: non_medical_staffs, name: 'non-medical-staffs' },

    { path: '/user/profile/edit', component: edit_profile, name: 'edit-profile' },
    { path: '/user/profile', component: profile, name: 'profile' },
    { path: '/user/change-password', component: change_password, name: 'change-password' },

    { path: '/patient/profile/edit', component: edit_patient_profile, name: 'edit-patient-profile' },
    { path: '/patient/profile', component: patient_profile, name: 'patient-profile' },
    { path: '/patient/change-password', component: change_patient_password, name: 'change-patient-password' },

    { path: '/laboratory/medical-diagnostic-laboratory-tests', component: lab_tests, name: 'lab-tests' },
    { path: '/laboratory/pos', component: lab_pos, name: 'lab-pos' },
    { path: '/laboratory/invoice', component: lab_invoice, name: 'lab-invoice' },
    { path: '/laboratory/orders', component: lab_patient_orders, name: 'lab-patient-orders' },
    { path: '/laboratory/add-result/:id', component: add_lab_result, name: 'add-lab-result' },
    { path: '/laboratory/results', component: lab_results, name: 'lab-results' },
    { path: '/laboratory/results/:id', component: lab_result, name: 'lab-result' },
    { path: '/laboratory/results/today', component: lab_results_today, name: 'lab-results-today' },
    { path: '/laboratory/results/dates/:date', component: lab_results_date, name: 'lab-results-date' },
    { path: '/laboratory/results/months/:month', component: lab_results_month, name: 'lab-results-month' },
    { path: '/laboratory/hospital/prenatals', component: lab_prenatals, name: 'lab-prenatals' },
    { path: '/laboratory/prenatals', component: laboratory_prenatals, name: 'laboratory-prenatals' },

    { path: '/laboratory/prenatals/:key', component: lab_prenatal, name: 'lab-prenatal' },
    { path: '/laboratory/prenatals/tests/:key', component: lab_prenatal_tests, name: 'lab-prenatal-tests' },
    { path: '/laboratory/prenatals/pos/:key', component: lab_prenatal_pos, name: 'lab-prenatal-pos' },
    { path: '/laboratory/prenatals/results/:week/:key', component: prenatal_lab_results, name: 'prenatal-lab-results' },

    { path: '/staff/posts/', component: posts, name: 'posts' },
    { path: '/staff/posts/:id/edit', component: edit_post, name: 'edit-post' },
    { path: '/staff/posts/:id', component: post, name: 'post' },

    { path: '/', component: index, name: 'index' },
    { path: '/posts', component: frontend_posts, name: 'frontend-posts' },
    { path: '/posts/:slug', component: frontend_post, name: 'frontend-post' },
    { path: '/facility/:slug', component: frontend_facility, name: 'frontend-facility' },
    { path: '/pharmacies', component: frontend_pharmacies, name: 'frontend-pharmacies' },
    { path: '/laboratories', component: frontend_laboratories, name: 'frontend-laboratories' },
    { path: '/private-hospitals', component: frontend_private_hospitals, name: 'frontend-private-hospitals' },
    { path: '/public-hospitals', component: frontend_public_hospitals, name: 'frontend-public-hospitals' },
    { path: '/diseases-conditions/:letter', component: frontend_diseases, name: 'frontend-diseases' },
    { path: '/medical-laboratory-tests/:letter', component: frontend_laboratory_tests, name: 'frontend-laboratory-tests' },

    { path: '/medical/patient/checkins', component: patient_checkins, name: 'patient-checkins' },

    { path: '/medical/patient/checkin-archive', component: patient_checkin_archive, name: 'patient-checkin-archive' },
    { path: '/medical/patient/checkin-archive-date/:date', component: patient_checkin_archive_date, name: 'patient-checkin-archive-date' },
    { path: '/medical/patient/checkin-archive-month/:month', component: patient_checkin_archive_month, name: 'patient-checkin-archive-month' },

    { path: '/medical/patient/checkouts', component: patient_checkouts, name: 'patient-checkouts' },

    { path: '/medical/vital-signs', component: vital_signs, name: 'vital-signs' },

    { path: '/medical/consultations', component: consultations, name: 'consultations' },
    { path: '/medical/consultations/medical-history/:key', component: medical_history, name: 'medical-history' },
    { path: '/medical/consultations/medical-examination/:key', component: medical_examination, name: 'medical-examination' },
    { path: '/medical/consultations/medical-diagnostic/:key', component: medical_diagnostic, name: 'medical-diagnostic' },
    { path: '/medical/consultations/medical-investigation/:key', component: medical_investigation, name: 'medical-investigation' },
    { path: '/medical/consultations/medical-treatment/:key', component: medical_treatment, name: 'medical-treatment' },
    { path: '/medical/consultations/medical-service/:key', component: medical_service, name: 'medical-service' },
    { path: '/medical/consultations/medical-prescribed-drug/:key', component: medical_prescribed_drug, name: 'medical-prescribed-drug' },
    { path: '/medical/consultations/medical-laboratory-tests/:key', component: medical_laboratory_tests, name: 'medical-laboratory-tests' },


    { path: '/medical/consultations/medical-treatment-plan/:key', component: medical_treatment_plan, name: 'medical-treatment-plan'},

    { path: '/medical/nurse-documentations/:key', component: nurse_documentation, name: 'nurse-documentation'},
    { path: '/medical/nurse-documentation/:id/:key', component: edit_nurse_documentation, name: 'edit-nurse-documentation'},

    { path: '/medical/consultations/progress-note/:key', component: progress_note, name: 'progress-note'},

    { path: '/medical/consultations/drug-prescription-plan/:key', component: drug_prescription_plan, name: 'drug-prescription-plan'},

    { path: '/medical/previous-consultations/:id', component: previous_consultation, name: 'previous-consultations'},
    { path: '/medical/previous-consultation/:key', component: show_previous_consultation, name: 'show-previous-consultations'},

    { path: '/medical/patient-invoices', component: unpaid_invoices, name: 'unpaid-invoices'},
    { path: '/medical/patient-invoices/:key', component: invoices, name: 'invoices'},
    { path: '/medical/patient-invoice/:key', component: invoice, name: 'invoice'},
    { path: '/medical/paid-invoice/:key', component: paid_invoice, name: 'paid-invoice'},

    { path: '/patient/hospital-visits', component: hospital_visits, name: 'hospital-visits'},
    { path: '/patient/hospital-visits/:key', component: hospital_visit, name: 'hospital-visit'},

    { path: '/patient/patient-satisfactory-survey/:key', component: patient_satisfactory_survey, name: 'patient-satisfactory-survey'},


    { path: '/patient/prenatals', component: patient_prenatals, name: 'patient-prenatals'},
    { path: '/patient/prenatal', component: patient_prenatal, name: 'patient-prenatal'},
    { path: '/patient/prenatal-visits/:key', component: patient_prenatal_visits, name: 'patient-prenatal-visits'},
    { path: '/patient/prenatal-first-visit/:key', component: patient_prenatal_first_visit, name: 'patient-prenatal-first-visit'},
    { path: '/patient/prenatal-19-20-week-visit/:key', component: patient_prenatal_19_20_visit, name: 'patient-prenatal-19-20-visit'},
    { path: '/patient/prenatal-22-week-visit/:key', component: patient_prenatal_22_visit, name: 'patient-prenatal-22-visit'},
    { path: '/patient/prenatal-26-27-week-visit/:key', component: patient_prenatal_26_27_visit, name: 'patient-prenatal-26-27-visit'},
    { path: '/patient/prenatal-28-week-visit/:key', component: patient_prenatal_28_visit, name: 'patient-prenatal-28-visit'},
    { path: '/patient/prenatal-32-week-visit/:key', component: patient_prenatal_32_visit, name: 'patient-prenatal-32-visit'},
    { path: '/patient/prenatal-34-36-week-visit/:key', component: patient_prenatal_34_36_visit, name: 'patient-prenatal-34-36-visit'},
    { path: '/patient/prenatal-38-38-week-visit/:key', component: patient_prenatal_38_39_visit, name: 'patient-prenatal-38-39-visit'},
    { path: '/patient/prenatal-40-41-week-visit/:key', component: patient_prenatal_40_41_visit, name: 'patient-prenatal-40-41-visit'},

    { path: '/patient/prenatal/admission', component: patient_prenatal_admission, name: 'patient-prenatal-admission'},

    { path: '/patient/prenatal-laboratory-results/:week/:key', component: patient_prenatal_laboratory_results, name: 'patient-prenatal-laboratory-results'},
    { path: '/patient/prenatal-laboratory-result/:id', component: patient_prenatal_laboratory_result, name: 'patient-prenatal-laboratory-result'},

    { path: '/medical/consultations/outpatient-visit/:key', component: outpatient_visit, name: 'outpatient-visit'},

    { path: '/medical/records/death', component: death_records, name: 'death-records' },
    { path: '/medical/records/death/create', component: create_death_record, name: 'create-death-record' },
    { path: '/medical/records/death/edit/:slug', component: edit_death_record, name: 'edit-death-record' },
    { path: '/medical/records/death/:slug', component: death_record, name: 'death-record' },

    { path: '/medical/deposit/make-payment/:key', component: make_payment, name: 'make-payment'},
    { path: '/medical/deposit/update-payment/:key', component: update_payment, name: 'update-payment'},

    { path: '/medical/patient-discharge-instruction', component: patient_discharge_instruction, name: 'patient-discharge-instruction'},

    { path: '/medical/discharge-patient/create/:key', component: create_discharge_patient, name: 'discharge-patient-create'},
    { path: '/medical/discharged-patients', component: discharged_patients, name: 'discharged-patients'},
    { path: '/medical/discharged-patient/:key', component: discharged_patient, name: 'discharged-patient'},

    { path: '/patient/discharge-planning-checklist/patient/edit/:key', component: edit_discharge_planning_checklist_patient, name: 'edit-discharge-planning-checklist-patient'},
    { path: '/patient/discharge-planning-checklist/staff/edit/:key', component: edit_discharge_planning_checklist_staff, name: 'edit-discharge-planning-checklist-staff'},

    { path: '/medical/prenatal/create', component: create_prenatal, name: 'create-prenatal'},
    { path: '/medical/prenatals', component: prenatals, name: 'prenatals'},
    { path: '/medical/prenatals/:key', component: prenatal, name: 'prenatal'},
    { path: '/medical/prenatals/visit/:key', component: prenatal_visit, name: 'prenatal-visit'},
    { path: '/medical/prenatals/edit/:key', component: edit_prenatal, name: 'edit-prenatal'},

    { path: '/medical/prenatal/lactation-inteview/:key', component: lactation_interview, name: 'lactation-interview'},

    { path: '/medical/prenatals/visit/first-visit/:key', component: create_prenatal_first_visit, name: 'create-prenatal-first-visit'},
    { path: '/medical/prenatals/visit/first-visit/edit/:key', component: edit_prenatal_first_visit, name: 'edit-prenatal-first-visit'},
    { path: '/medical/prenatals/visit/first-visit/:key', component: prenatal_first_visit, name: 'prenatal-first-visit'},

    { path: '/medical/prenatals/visit/19-20-week/create/:key', component: create_prenatal_19_20_week, name: 'create-prenatal-19-20-week'},
    { path: '/medical/prenatals/visit/19-20-week/edit/:key', component: edit_prenatal_19_20_week, name: 'edit-prenatal-19-20-week'},
    { path: '/medical/prenatals/visit/19-20-week/:key', component: prenatal_19_20_week, name: 'prenatal-19-20-week'},

    { path: '/medical/prenatals/visit/22-week/create/:key', component: create_prenatal_22_week, name: 'create-prenatal-22-week'},
    { path: '/medical/prenatals/visit/22-week/edit/:key', component: edit_prenatal_22_week, name: 'edit-prenatal-22-week'},
    { path: '/medical/prenatals/visit/22-week/:key', component: prenatal_22_week, name: 'prenatal-22-week'},

    { path: '/medical/prenatals/visit/26-27-week/create/:key', component: create_prenatal_26_27_week, name: 'create-prenatal-26-27-week'},
    { path: '/medical/prenatals/visit/26-27-week/edit/:key', component: edit_prenatal_26_27_week, name: 'edit-prenatal-26-27-week'},
    { path: '/medical/prenatals/visit/26-27-week/:key', component: prenatal_26_27_week, name: 'prenatal-26-27-week'},

    { path: '/medical/prenatals/visit/28-week/create/:key', component: create_prenatal_28_week, name: 'create-prenatal-28-week'},
    { path: '/medical/prenatals/visit/28-week/edit/:key', component: edit_prenatal_28_week, name: 'edit-prenatal-28-week'},
    { path: '/medical/prenatals/visit/28-week/:key', component: prenatal_28_week, name: 'prenatal-28-week'},

    { path: '/medical/prenatals/visit/32-week/create/:key', component: create_prenatal_32_week, name: 'create-prenatal-32-week'},
    { path: '/medical/prenatals/visit/32-week/edit/:key', component: edit_prenatal_32_week, name: 'edit-prenatal-32-week'},
    { path: '/medical/prenatals/visit/32-week/:key', component: prenatal_32_week, name: 'prenatal-32-week'},

    { path: '/medical/prenatals/visit/34-36-week/create/:key', component: create_prenatal_34_36_week, name: 'create-prenatal-34-36-week'},
    { path: '/medical/prenatals/visit/34-36-week/edit/:key', component: edit_prenatal_34_36_week, name: 'edit-prenatal-34-36-week'},
    { path: '/medical/prenatals/visit/34-36-week/:key', component: prenatal_34_36_week, name: 'prenatal-34-36-week'},

    { path: '/medical/prenatals/visit/38-39-week/create/:key', component: create_prenatal_38_39_week, name: 'create-prenatal-38-39-week'},
    { path: '/medical/prenatals/visit/38-39-week/edit/:key', component: edit_prenatal_38_39_week, name: 'edit-prenatal-38-39-week'},
    { path: '/medical/prenatals/visit/38-39-week/:key', component: prenatal_38_39_week, name: 'prenatal-38-39-week'},

    { path: '/medical/prenatals/visit/40-41-week/create/:key', component: create_prenatal_40_41_week, name: 'create-prenatal-40-41-week'},
    { path: '/medical/prenatals/visit/40-41-week/edit/:key', component: edit_prenatal_40_41_week, name: 'edit-prenatal-40-41-week'},
    { path: '/medical/prenatals/visit/40-41-week/:key', component: prenatal_40_41_week, name: 'prenatal-40-41-week'},

    { path: '/medical/patient-satisfactory-survies', component: hospital_patient_satisfactory_survies, name: 'hospital-patient-satisfactory-survies'},
    { path: '/medical/patient-satisfactory-survey/:key', component: hospital_patient_satisfactory_survey, name: 'hospital-patient-satisfactory-survey'},

    { path: '/medical/visitors', component: visitor, name: 'visitors'},
    { path: '/medical/visitors/archive', component: visitor_archive, name: 'visitor-archive'},
    { path: '/medical/visitor-archive-date/:date', component: visitor_archive_date, name: 'visitor-archive-date'},
    { path: '/medical/visitor-archive-month/:month', component: visitor_archive_month, name: 'visitor-archive-month'},

    { path: '/medical/prenatals/admission/create', component: create_prenatal_admission, name: 'create-prenatal-admission'},
    { path: '/medical/prenatals/admissions', component: prenatal_admissions, name: 'prenatal-admissions'},
    { path: '/medical/prenatals/admission/edit/:key', component: edit_prenatal_admission, name: 'edit-prenatal-admission'},
    { path: '/medical/prenatals/admission/:key', component: prenatal_admission, name: 'prenatal-admission'},

    {path: '/medical/prenatals/preganancy-maternal-outcome/:key', component: pregnancy_outcome, name: 'pregnancy-outcome'},

  ]
