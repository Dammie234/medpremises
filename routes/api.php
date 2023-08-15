<?php

Route::group([

    'middleware' => 'api',
    'prefix' => 'auth'

], function () {

    Route::post('login', 'AuthController@login');
    Route::post('patient-login', 'AuthController@patientLogin');
    Route::post('facility_registration', 'AuthController@facilityRegistration');
    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::post('me', 'AuthController@me');
    Route::post('staff-registration', 'AuthController@staffRegistration');
    Route::post('change-password', 'AuthController@changePassword');
    Route::post('patient-registration', 'AuthController@patientRegistration');
});


Route::group([
    'middleware' => 'auth:api-patient',
    'prefix' => 'v1'
], function () {
    Route::get('/patient/{id}', 'HomeController@user');
    Route::get('/biodata/{id}', 'HomeController@biodata');
    Route::get('/patient-next-of-kin/{id}', 'HomeController@getNextOfKin');
    Route::get('/patients/{patient_id}', 'HomeController@patients');
    Route::get('/spouse-information/{patient_id}', 'HomeController@spouseInformation');

    Route::get('/patient-previous-consultations/{patient_id}', 'MedicalConsultationController@previousConsultations');
    Route::get('/patient-id/{patient_id}', 'MedicalConsultationController@patientById');
    Route::get('/patient-consultation/{key}', 'MedicalConsultationController@consultation');
    Route::get('/conducted-patient-medical-laboratory-test/{key}', 'MedicalConsultationController@conductedPatientMedicalLaboratoryTests');
    Route::get('/patient-admission-facility-detail/{key}', 'MedicalConsultationController@admissionFacilityDetail');
    Route::get('/patient-medical-treatment-plan-types/{key}', 'MedicalConsultationController@planTypes');

    Route::get('/patient-outpatient-visits/{key}', 'OutpatientVisitController@index');

    Route::get('/patient-nurse-documentations/{key}', 'NurseDocumentationController@index');

    Route::get('/patient-drug-prescription-plan/{key}', 'DrugPrescriptionPlanController@index');

    Route::get('/patient-hospital-sale/{key}', 'InvoiceController@getHospitalSale');

    Route::get('/patient-discharged/{key}', 'PatientDischargeController@show');
    Route::get('/patient-discharge-planning-checklist/{key}', 'PatientDischargeController@checklist');

    Route::get('/patient-prenatal/{patient_id}', 'PrenatalController@patientPrenatal');
    Route::get('/patient-prenatal-admission/{patient_id}', 'PrenatalController@patientPrenatalAdmission');

    Route::get('/patient-prental-medical-test-results/{key}/{week}', 'PrenatalMedicalLaboratoryTestController@prenatalMedicalTestResults');

    Route::get('/prenatal-medical-laboratory-test/{id}', 'LaboratoryController@patientOrderMedicalLaboratoryTest');

    Route::get('/patient-visits/{key}', 'VisitorController@patientVisits');

});



Route::group([

    'middleware' => 'auth:api',
    'prefix' => 'v1'

], function () {
    Route::get('/user/{id}', 'HomeController@user');
    Route::get('/facility-details/{id}', 'HomeController@facilityDetails');
    Route::get('/hospital-class/{id}', 'HomeController@hospitalClass');
    Route::get('/next-of-kin/{id}', 'HomeController@getNextOfKin');
    Route::get('/medical-services/{id}', 'HomeController@medicalServices');
    Route::get('/get-spouse-information/{id}', 'HomeController@spouseInformation');

    Route::get('/deliveries/{id}', 'DeliveryController@index');
    Route::get('/delivery/{id}', 'DeliveryController@show');

    Route::get('/drugs/{id}', 'DrugController@index');
    Route::get('/drug/{id}', 'DrugController@show');

    Route::get('/items/{id}', 'ItemController@index');
    Route::get('/item/{id}', 'ItemController@show');

    Route::get('/drug-stocks/{id}', 'StockController@drugs');
    Route::get('/item-stocks/{id}', 'StockController@items');
    Route::get('/drug-inflows/{id}', 'StockController@drugInflows');
    Route::get('/item-inflows/{id}', 'StockController@itemInflows');
    Route::get('/drug-inflows/{id}/{date}', 'StockController@drugInflowMonth');
    Route::get('/item-inflows/{id}/{date}', 'StockController@itemInflowMonth');
    Route::get('/drug-outflows/{id}', 'StockController@drugOutflows');
    Route::get('/drug-outflows/{id}/{date}', 'StockController@drugOutflowMonth');
    Route::get('/item-outflows/{id}', 'StockController@itemOutflows');
    Route::get('/item-outflows/{id}/{date}', 'StockController@itemOutflowMonth');
    Route::get('/drug-outflows-today/{id}', 'StockController@drugOutflowToday');
    Route::get('/item-outflows-today/{id}', 'StockController@itemOutflowToday');
    Route::get('/drug-outflows-date/{id}/{date}', 'StockController@drugOutflowDate');
    Route::get('/item-outflows-date/{id}/{date}', 'StockController@itemOutflowDate');
    Route::get('/monthly-drug-sales/{id}', 'StockController@monthlyDrugSales');
    Route::get('/monthly-item-sales/{id}', 'StockController@monthlyItemSales');
    Route::get('/monthly-inflows/{id}/{type}', 'StockController@monthlyInflows');

    Route::get('/add-to-cart/{id}/{type}/{user_id}', 'POSController@addToCart');
    Route::get('/carts/{user_id}', 'POSController@carts');
    Route::get('/remove-cart/{id}/{user_id}', 'POSController@removeCart');
    Route::get('/increment-qty/{id}/{user_id}', 'POSController@incrementQty');
    Route::get('/decrement-qty/{id}/{user_id}', 'POSController@decrementQty');
    Route::get('/increment-usage/{id}/{user_id}', 'POSController@incrementUsage');
    Route::get('/decrement-usage/{id}/{user_id}', 'POSController@decrementUsage');
    Route::get('/increment-times/{id}/{user_id}', 'POSController@incrementTimes');
    Route::get('/decrement-times/{id}/{user_id}', 'POSController@decrementTimes');
    Route::get('/customer-sale/{user_id}', 'POSController@getCustomerSale');
    Route::get('/confirm-payment/{user_id}', 'POSController@confirmPayment');
    Route::get('/patient-prescribed-drugs-within-facility/{user_id}', 'POSController@patientPrescribedDrugsWithinFacility');

    Route::get('/medical-staffs/{id}', 'HRController@medicalStaffs');
    Route::get('/unemployed-medical-staffs/{name}', 'HRController@unemployedMedicalStaffs');
    Route::get('/non-medical-staffs/{id}', 'HRController@nonMedicalStaffs');


    Route::get('/medical-staff/{user_id}', 'HomeController@medicalStaff');
    Route::get('/medical-staff-facility/{id}', 'HomeController@medicalStaffFacility');
    Route::get('/staff/{id}', 'HomeController@staff');
    // Route::get('/add-education/{user_id}', 'HomeController@addEducation');
    Route::get('/laboratory-medical-tests/{id}', 'LaboratoryController@laboratoryMedicalTest');
    Route::get('/medical-laboratory-tests', 'LaboratoryController@medicalLaboratoryTests');
    Route::get('/lab-customer-sale/{id}', 'LaboratoryController@getCustomerSale');
    Route::get('/confirm-lab-payment/{id}', 'LaboratoryController@confirmPayment');
    Route::get('/patient-medical-laboratory-tests/{id}', 'LaboratoryController@patientMedicalLaboratoryTests');
    Route::get('/patient-order-medical-laboratory-tests/{id}', 'LaboratoryController@patientOrderMedicalLaboratoryTests');
    Route::get('/patient-order-medical-laboratory-test/{id}', 'LaboratoryController@patientOrderMedicalLaboratoryTest');
    Route::get('/customers/{id}', 'LaboratoryController@getCustomers');
    Route::get('/patient-medical-laboratory-tests-date/{date}/{id}', 'LaboratoryController@patientMedicalLaboratoryTestsDate');
    Route::get('/hospital-medical-investigation', 'LaboratoryController@getHospitalMedicalInvestigation');

    Route::get('/user-posts/{id}', 'PostController@userPosts');
    Route::get('/user-post/{id}', 'PostController@show');

    Route::get('/patient-checkins/{id}', 'PatientCheckinController@index');
    Route::get('/all-patients', 'PatientCheckinController@patients');
    Route::get('/patient-checkin/{key}', 'PatientCheckinController@patientCheckin');
    Route::get('/verify-patient-checkin/{key}', 'PatientCheckinController@verifyPatientCheckin');
    Route::get('/patient-checkins-archive/{id}', 'PatientCheckinController@patientCheckinArchive');
    Route::get('/patient-checkins-archive-date/{date}/{id}', 'PatientCheckinController@patientCheckinArchiveByDate');


    Route::get('/vital-signs/{id}', 'VitalSignController@index');

    Route::get('/consultation/{key}', 'MedicalConsultationController@consultation');
    Route::get('/facility-services/{key}', 'MedicalConsultationController@getFacilityServices');
    Route::get('/previous-consultations/{patient_id}', 'MedicalConsultationController@previousConsultations');
    Route::get('/conducted-patient-medical-laboratory-tests/{key}', 'MedicalConsultationController@conductedPatientMedicalLaboratoryTests');
    Route::get('/admission-facility-detail/{key}', 'MedicalConsultationController@admissionFacilityDetail');
    Route::get('/medical-treatment-plan-types/{key}', 'MedicalConsultationController@planTypes');
    Route::get('/medical-treatment-plan-type/{key}/{id}', 'MedicalConsultationController@planType');
    Route::get('/progress-notes/{key}', 'MedicalConsultationController@patientProgressNotes');
    Route::get('/progress-note/{id}', 'MedicalConsultationController@patientProgressNote');

    Route::get('/patient-by-id/{patient_id}', 'MedicalConsultationController@patientById');

    Route::get('/nurse-documentations/{key}', 'NurseDocumentationController@index');
    Route::get('/nurse-documentation/{id}', 'NurseDocumentationController@show');

    Route::get('/drug-prescription-plan/{key}', 'DrugPrescriptionPlanController@index');
    Route::get('/show-drug-prescription-plan/{id}', 'DrugPrescriptionPlanController@show');

    Route::get('/patient-invoices/{key}', 'InvoiceController@patientInvoices');
    Route::get('/patient-unpaid-invoices/{id}', 'InvoiceController@patientUnpaidInvoices');
    Route::get('/hospital-sale/{key}', 'InvoiceController@getHospitalSale');
    Route::get('/confirm-hospital-payment/{key}', 'InvoiceController@confirmPayment');

    Route::get('/outpatient-visits/{key}', 'OutpatientVisitController@index');
    Route::get('/outpatient-visit/{id}', 'OutpatientVisitController@show');

    Route::get('/death-records/{id}', 'DeathRecordController@index');
    Route::get('/get-patients', 'DeathRecordController@getPatients');
    Route::get('/get-patient-details/{patient_id}', 'DeathRecordController@getPatientDetails');
    Route::get('/death-record/{slug}', 'DeathRecordController@show');

    Route::get('/patient-checkouts/{id}', 'PatientCheckoutController@index');

    Route::get('/patient-discharge-instructions/{id}', 'PatientDischargeInstructionController@index');
    Route::get('/patient-discharge-instruction/{id}', 'PatientDischargeInstructionController@show');

    Route::get('/discharged-patients/{id}', 'PatientDischargeController@index');
    Route::get('/discharged-patient/{key}', 'PatientDischargeController@show');
    Route::get('/discharge-planning-checklist/{key}', 'PatientDischargeController@checklist');

    Route::get('/prenatals/{id}', 'PrenatalController@index');
    Route::get('/prenatal/{key}', 'PrenatalController@show');
    Route::get('/fetch-prenatals', 'PrenatalController@fetchPrenatals');
    Route::get('/get-admitted-prenatals/{id}', 'PrenatalController@admittedPrenatals');
    Route::get('/prenatal-admission/{key}', 'PrenatalController@prenatalAdmission');
    Route::get('/prenatal-admission-sign/{key}', 'PrenatalController@prenatalAdmissionSign');
    Route::get('/admission-spouse-information/{key}', 'PrenatalController@admissionSpouseInformation');

    Route::get('/fetch-tests/{key}', 'PrenatalMedicalLaboratoryTestController@fetchTests');
    Route::get('/prental-medical-test-results/{key}/{week}', 'PrenatalMedicalLaboratoryTestController@prenatalMedicalTestResults');
    Route::get('/check-prenatal-medical-laboratory-tests/{key}', 'PrenatalMedicalLaboratoryTestController@checkPrenatalMedicalLaboratoryTests');

    Route::get('/visitors/{id}', 'VisitorController@index');
    Route::get('/visitor-archive/{id}', 'VisitorController@visitorArchive');
    Route::get('/visitor-archive-date/{date}/{id}', 'VisitorController@visitorArchiveByDate');
    Route::get('/patient-satisfactory-survies/{id}', 'PatientSatisfactorySurveyController@index');
    Route::get('/patient-satisfactory-survey/{key}', 'PatientSatisfactorySurveyController@show');

});


Route::get('/check-prenatal-medical-laboratory-tests/{key}', 'PrenatalMedicalLaboratoryTestController@checkPrenatalMedicalLaboratoryTests');

Route::get('/fetch-user/{email}', 'AuthController@fetchUser');
Route::get('/user-logout/{id}', 'AuthController@userLogout');

Route::get('/add-laboratory-test/{id}/{test_id}/{price}', 'LaboratoryController@storeLaboratoryTest');
Route::patch('/update-medical-laboratory-test/{id}', 'LaboratoryController@updateMedicalLaboratoryTest');

Route::get('/non-medical-jobs', 'HomeController@nonMedicalJobs');
Route::get('/jobs', 'HomeController@jobs');
Route::get('/states', 'HomeController@states');
Route::get('/add-education/{id}', 'HomeController@addEducation');
Route::get('/subtract-education/{id}', 'HomeController@subtractEducation');
Route::get('/add-qualification/{id}', 'HomeController@addQualification');
Route::get('/subtract-qualification/{id}', 'HomeController@subtractQualification');
Route::get('/add-experience/{id}', 'HomeController@addExperience');
Route::get('/subtract-experience/{id}', 'HomeController@subtractExperience');
Route::get('/update-medical-service/{user_id}/{id}/{price}', 'HomeController@updateMedicalService');

Route::patch('/update-password/{id}', 'HomeController@updatePassword');
Route::patch('/update-patient-password/{id}', 'HomeController@updatePassword');

Route::patch('/update-facility-manager/{id}', 'HomeController@updateFacililtyManager');
Route::patch('/update-ownership-picture/{id}', 'HomeController@updateOwnershipPicture');
Route::patch('/update-profile-picture/{id}', 'HomeController@updateProfilePicture');
Route::patch('/update-patient-profile-picture/{id}', 'HomeController@updateProfilePicture');
Route::patch('/update-facility-signature/{id}', 'HomeController@updateFacilitySignature');
Route::patch('/update-biodata/{id}', 'HomeController@updateBiodata');
Route::patch('/update-patient-biodata/{id}', 'HomeController@updateBiodata');
Route::patch('/update-education/{id}', 'HomeController@updateEducation');
Route::patch('/update-qualification/{id}', 'HomeController@updateQualification');
Route::patch('/update-kin/{id}', 'HomeController@updateKin');
Route::patch('/update-hospital-class/{id}', 'HomeController@updateHospitalClass');
Route::patch('/spouse-information/{id}', 'HomeController@updateSpouse');


Route::post('/delivery', 'DeliveryController@store');
Route::patch('/delivery/{id}', 'DeliveryController@update');
Route::delete('/delivery/{id}', 'DeliveryController@destroy');

Route::post('/drug', 'DrugController@store');
Route::patch('/drug/{id}', 'DrugController@update');
Route::delete('/drug/{id}', 'DrugController@destroy');

Route::post('/item', 'ItemController@store');
Route::patch('/item/{id}', 'ItemController@update');
Route::delete('/item/{id}', 'ItemController@destroy');

Route::post('/stock', 'StockController@store');
Route::delete('/delete-stock-inflow/{id}/{user_id}', 'StockController@deleteStockInflow');

Route::patch('/process-order/{user_id}', 'POSController@processOrder');
Route::patch('/process-lab-order/{id}', 'LaboratoryController@processLabOrder');

Route::get('/employ-medical-staff/{user_id}/{id}', 'HRController@employMedicalStaff');
Route::post('/employ-non-medical-staff', 'HRController@employNonMedicalStaff');
Route::get('/generate-pin/{id}', 'HRController@generatePIN');

Route::post('/posts', 'PostController@store');
Route::patch('/update-post/{id}', 'PostController@updatePost');
Route::patch('/update-featured-image/{id}', 'PostController@updateFeaturedImage');
Route::delete('/posts/{id}', 'PostController@destroy');


Route::get('/posts', 'FrontendController@posts');
Route::get('/location', 'FrontendController@getLocation');
Route::get('/pharmacies', 'FrontendController@pharmacies');
Route::get('/all-pharmacies', 'FrontendController@allPharmacies');
Route::get('/laboratories', 'FrontendController@laboratories');
Route::get('/all-laboratories', 'FrontendController@allLaboratories');
Route::get('/private-hospitals', 'FrontendController@privateHospitals');
Route::get('/all-private-hospitals', 'FrontendController@allPrivateHospitals');
Route::get('/public-hospitals', 'FrontendController@publicHospitals');
Route::get('/all-public-hospitals', 'FrontendController@allPublicHospitals');
Route::get('/drugs', 'FrontendController@drugs');
Route::get('/laboratory-centres', 'FrontendController@laboratoryCentres');
Route::get('/medical-services', 'FrontendController@medicalServices');
Route::get('/all-posts', 'FrontendController@allPosts');
Route::get('/all-posts/{slug}', 'FrontendController@post');
Route::get('/facility-details-by-slug/{slug}', 'FrontendController@facilityDetailsBySlug');
Route::get('/few-diseases', 'FrontendController@fewDiseases');
Route::get('/diseases-group/{letter}', 'FrontendController@diseasesGroup');
Route::get('/diseases', 'FrontendController@diseases');
Route::get('/laboratory-tests', 'FrontendController@laboratoryTests');
Route::get('/laboratory-tests-group/{letter}', 'FrontendController@laboratoryTestsGroup');
Route::get('/few-laboratory-tests', 'FrontendController@fewLaboratoryTests');

Route::get('/make-consultation/{patient_id}/{key}/{id}', 'MedicalConsultationController@makeConsultation');
Route::get('/end-medical-consultation/{key}', 'MedicalConsultationController@endMedicalConsultation');

Route::post('/patient-checkins', 'PatientCheckinController@store');

Route::post('/vital-signs', 'VitalSignController@store');

Route::patch('/medical-history/{key}', 'MedicalConsultationController@updateMedicalHistory');
Route::patch('/medical-examination/{key}', 'MedicalConsultationController@updateMedicalExamination');
Route::patch('/medical-diagnostic/{key}', 'MedicalConsultationController@updateMedicalDiagnostic');
Route::patch('/medical-investigation/{key}', 'MedicalConsultationController@updateMedicalInvestigation');
Route::patch('/medical-treatment/{key}', 'MedicalConsultationController@updateMedicalTreatment');
Route::patch('/medical-prescribed-drug/{key}', 'MedicalConsultationController@updateMedicalPrescribedDrug');
Route::patch('/medical-treatment-plan/{key}', 'MedicalConsultationController@updateMedicalTreatmentPlan');
Route::patch('/progress-note-type-a/{key}', 'MedicalConsultationController@updateProgressNoteTypeA');
Route::post('/progress-note-type-b', 'MedicalConsultationController@storePatientProgressNoteTypeB');
Route::patch('/progress-note-type-b/{id}', 'MedicalConsultationController@updatePatientProgressNoteTypeB');
Route::delete('/progress-note-type-b/{id}', 'MedicalConsultationController@destroyPatientProgressNoteTypeB');

Route::post('/short-term-goal', 'MedicalConsultationController@storeShortTermGoal');
Route::patch('/short-term-goal/{key}/{id}/{user_id}', 'MedicalConsultationController@updateShortTermGoal');

Route::post('/nurse-documentation', 'NurseDocumentationController@store');
Route::patch('/nurse-documentation/{id}', 'NurseDocumentationController@update');
Route::delete('/nurse-documentation/{id}', 'NurseDocumentationController@destroy');

Route::post('/drug-prescription-plan', 'DrugPrescriptionPlanController@store');
Route::post('/add-to-plan', 'DrugPrescriptionPlanController@addToPlan');
Route::patch('/drug-prescription-plan/{id}', 'DrugPrescriptionPlanController@update');
Route::delete('/drug-prescription-plan/{id}', 'DrugPrescriptionPlanController@destroy');

Route::patch('/process-hospital-order/{id}', 'InvoiceController@processOrder');
Route::patch('/update-patient-deposit/{key}', 'InvoiceController@updatePatientDeposit');

Route::post('/outpatient-visit', 'OutpatientVisitController@store');
Route::patch('/outpatient-visit/{id}', 'OutpatientVisitController@update');
Route::delete('/outpatient-visit/{id}', 'OutpatientVisitController@destroy');

Route::post('/death-record', 'DeathRecordController@store');
Route::patch('/death-record/{slug}', 'DeathRecordController@update');

Route::post('/patient-checkout', 'PatientCheckoutController@store');

Route::post('/patient-discharge-instruction', 'PatientDischargeInstructionController@store');
Route::patch('/patient-discharge-instruction/{id}', 'PatientDischargeInstructionController@update');
Route::delete('/patient-discharge-instruction/{id}', 'PatientDischargeInstructionController@destroy');

Route::post('/discharge-patient', 'PatientDischargeController@store');
Route::patch('/discharge-planning-checklist/{key}', 'PatientDischargeController@updateDischargePlanningChecklist');
Route::patch('/discharge-patient-planning-checklist/{key}', 'PatientDischargeController@updateDischargePlanningChecklist');

Route::post('/prenatal', 'PrenatalController@store');
Route::patch('/prenatal/{key}', 'PrenatalController@updatePrenatal');
Route::patch('/prenatal-behavioural-risk/{key}', 'PrenatalController@updatePrenatalBehaviouralRisk');
Route::patch('/prenatal-psychological-risk/{key}', 'PrenatalController@updatePrenatalPsychologicalRisk');
Route::patch('/prenatal-medical-risk/{key}', 'PrenatalController@updatePrenatalMedicalRisk');
Route::patch('/prenatal-obstetric-risk/{key}', 'PrenatalController@updatePrenatalObstetricRisk');
Route::patch('/prenatal-obstetric-history/{key}', 'PrenatalController@updatePrenatalObstetricHistory');
Route::patch('/prenatal-medication/{key}', 'PrenatalController@updatePrenatalMedication');
Route::patch('/prenatal-admission-sign/{key}', 'PrenatalController@updatePrenatalAdmissionSign');
Route::patch('/prenatal-family-history/{key}', 'PrenatalController@updatePrenatalFamilyHistory');
Route::patch('/prenatal-investigation/{key}', 'PrenatalController@updatePrenatalInvestigation');
Route::post('/lactation-interview', 'PrenatalController@storeLactationInterview');
Route::patch('/lactation-interview/{key}', 'PrenatalController@updateLactationInterview');
Route::post('/prenatal-admission', 'PrenatalController@storePrenatalAdmission');
Route::patch('/prenatal-admission/{key}', 'PrenatalController@updatePrenatalAdmission');

Route::post('/first-prenatal-visit', 'PrenatalVisitController@storePrenatalFirstVisit');
Route::patch('/first-prenatal-visit/{key}', 'PrenatalVisitController@updateFirstPrenatal');
Route::post('/prenatal-19-or-20-week', 'PrenatalVisitController@store19Or20Week');
Route::patch('/prenatal-19-or-20-week/{key}', 'PrenatalVisitController@update19Or20Week');
Route::post('/prenatal-22-week', 'PrenatalVisitController@store22Week');
Route::patch('/prenatal-22-week/{key}', 'PrenatalVisitController@update22Week');
Route::post('/prenatal-26-27-week', 'PrenatalVisitController@store26Or27Week');
Route::patch('/prenatal-26-27-week/{key}', 'PrenatalVisitController@update26Or27Week');
Route::post('/prenatal-28-week', 'PrenatalVisitController@store28Week');
Route::patch('/prenatal-28-week/{key}', 'PrenatalVisitController@update28Week');
Route::post('/prenatal-32-week', 'PrenatalVisitController@store32Week');
Route::patch('/prenatal-32-week/{key}', 'PrenatalVisitController@update32Week');
Route::post('/prenatal-34-36-week', 'PrenatalVisitController@store34Or36Week');
Route::patch('/prenatal-34-36-week/{key}', 'PrenatalVisitController@update34Or36Week');
Route::post('/prenatal-38-39-week', 'PrenatalVisitController@store38Or39Week');
Route::patch('/prenatal-38-39-week/{key}', 'PrenatalVisitController@update38Or39Week');
Route::post('/prenatal-40-41-week', 'PrenatalVisitController@store40Or41Week');
Route::patch('/prenatal-40-41-week/{key}', 'PrenatalVisitController@update40Or41Week');

Route::post('/visitor', 'VisitorController@store');
Route::get('/visitor/{id}', 'VisitorController@checkoutVisitor');

Route::post('/patient-satisfactory-survey', 'PatientSatisfactorySurveyController@store');
Route::get('/approve-survey/{key}', 'PatientSatisfactorySurveyController@approveSurvey');