<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('locale/{lang}', function ($locale) {
    Session::put('locale', $locale);
    return redirect()->back();
});


Route::get('/', 'FrontendController@index')->name('home');



Route::get('/login', function () {
    return view('layout.login');
});
Route::post('/login', 'AuthController@loginAction')->name('login');

Route::group(['middleware' => 'auth'], function () {
    Route::get('/logout', 'AuthController@logout')->name('logout');

    //DASHBOARD
    /*Route::get('/', 'HomeController@dashboardReport')->name('dashboardReport');
    Route::get('/dashboardMap', 'HomeController@dashboardMap')->name('dashboardMap');
    Route::get('/charts', 'HomeController@dashboardChart')->name('dashboardChart');
    Route::get('/calendar', 'HomeController@dashboardCalendar')->name('dashboardCalendar');*/

    //users
    Route::get('user_list', 'UserController@getUserList')->name('user_list');
    Route::get('user_list_by_office', 'UserController@userByOffice')->name('user-list-office');
    Route::get('user_list_by_hierarchy', 'UserController@userByHierarchy')->name('user-list-hierarchy');
    Route::get('user_details', 'UserController@userDetails')->name('user-details');
    Route::get('edit_credentials', 'UserController@editCredential')->name('edit-credential');
    Route::post('edit_credentials', 'UserController@editCredentialAction');
    Route::post('check-old-pass/{id}', 'UserController@checkOldPassword')->name('check-old-pass');
    Route::post('check_username', 'UserController@checkUsername')->name('check_username');
    Route::resource('users', 'UserController');

    //Office
    Route::get('district_list', 'OfficeController@getDistrictList')->name('get-district-list');
    Route::get('municipality_list', 'OfficeController@getMunicipalityList')->name('get-municipality-list');
    Route::get('office_list', 'OfficeController@getOfficeList')->name('get-office-list');
    Route::resource('offices', 'OfficeController');

    //HIERARCHIE
    Route::get('hierarchies/tree_view', 'HierarchyController@getTreeView')->name('hierarchies.tree_view');
    Route::get('hierarchies/delete_node/:id', 'HierarchyController@deleteNode')->name('hierarchies.delete_node');
    Route::get('hierarchies/access_level', 'HierarchyController@accessLevel')->name('hierarchies.access_level');
    Route::post('hierarchies/access_level', 'HierarchyController@accessLevelAction');
    Route::get('get_access_level', 'HierarchyController@getAccessLevel')->name('get_access_level');
    Route::resource('hierarchies', 'HierarchyController');

    Route::resource('products', 'ProductController');
    Route::resource('items', 'ItemController');
    Route::get('getCategoryByItem', ['as' => 'getCategoryByItem', 'uses' => 'ItemController@getCategoryByItem']);
    Route::get('getItemByCategory', ['as' => 'getItemByCategory', 'uses' => 'ItemController@getItemByCategory']);

    Route::resource('measurement_units', 'MeasurementUnitController');
    Route::resource('item_categories', 'ItemCategoryController');

    Route::resource('fiscal_years', 'FiscalYearController');

    //commodity_supply
    Route::post('bulk_commidities_supply', 'CommoditySupplyController@bulkSave')->name('bulk_commidities_supply');
    Route::get('get_commodities_supply_report', 'CommoditySupplyController@getCommoditySupplyReport')->name('get_commodities_supply_report');
    Route::get('bulk_excel_commodities_supply', 'CommoditySupplyController@bulkImportExcel')->name('bulk_excel_commodities_supply');
    Route::post('bulk_excel_commodities_supply', 'CommoditySupplyController@bulkImportExcelAction');
    Route::get('commodity/export/', 'CommoditySupplyController@allDataExport')->name('commodity_export');
    Route::resource('commodities_supply', 'CommoditySupplyController');

    //industries
    Route::resource('industries', 'IndustryController');

    //social_functions
    Route::resource('social_functions', 'SocialFunctionController');

    //REPORT INPUT
    //MONTHLY
  /*  Route::get('monthly_progress_report_industries', 'ReportInputController@monthlyProgressReportIndustry')->name('monthly-progress-report-industries');
    Route::post('monthly_progress_report_industries', 'ReportInputController@monthlyProgressReportIndustryAction');
    Route::get('get_monthly_progress_report', 'ReportInputController@getMonthlyProgressReport')->name('get-monthly-progress-report');
    Route::get('monthly_progress_report_industry_import', 'ReportBulkImportController@monthlyProgressReportIndustryImport')->name('monthly_progress_report_industry_import');
    Route::post('monthly_progress_report_industry_import', 'ReportBulkImportController@monthlyProgressReportIndustryImportAction');
    Route::get('monthly_progress_report_industry_export', 'ReportBulkImportController@monthlyProgressReportIndustryExport')->name('monthly_progress_report_industry_export');

    //DISAGGREGATED DATA
    Route::get('disaggregated_data_industry', 'ReportInputController@disaggregatedDataIndustry')->name('disaggregated_data_industry');
    Route::post('disaggregated_data_industry', 'ReportInputController@disaggregatedDataIndustryAction');
    Route::get('get_disaggregated_data', 'ReportInputController@getDisaggregatedData')->name('get_disaggregated_data_report');

    //DISAGGREGATED DATA
    Route::get('corporate_social_responsibility', 'ReportInputController@corporateSocial')->name('corporate_social_responsibility');
    Route::post('corporate_social_responsibility', 'ReportInputController@corporateSocialAction');

    //DISAGGREGATED DATA CLASSIFICATION
    Route::get('disaggregated_data_classification', 'ReportInputController@disaggregatedDataClassification')->name('disaggregated_data_classification');
    Route::post('disaggregated_data_classification', 'ReportInputController@disaggregatedDataClassificationAction');

    //MONTHLY
    Route::get('monthly_progress_report_ocr', 'ReportInputController@monthlyProgressReportOcr')->name('monthly_progress_report_ocr');
    Route::post('monthly_progress_report_ocr', 'ReportInputController@monthlyProgressReportOcrAction');

    //DISAGGREGATED DATA
    Route::get('disaggregated_data_ocr', 'ReportInputController@disaggregatedDataOcr')->name('disaggregated_data_ocr');
    Route::post('disaggregated_data_ocr', 'ReportInputController@disaggregatedDataOcrAction');

    //Indicator_ocr
    Route::resource('indicator_ocr', 'IndicatorOcrController');

    //MONTHLY
    Route::get('monthly_training_report', 'ReportInputController@monthlyTrainingReport')->name('monthly_training_report');
    Route::post('monthly_training_report', 'ReportInputController@monthlyTrainingReportAction');*/

    //areawise training
    Route::get('areawise_training_report', 'ReportInputController@areawiseTrainingReport')->name('areawise_training_report');
    Route::post('areawise_training_report', 'ReportInputController@areawiseTrainingReportAction');

    //demographic training
    Route::get('demographic_wise_training_report', 'ReportInputController@demoGraphicWiseTrainingReport')->name('demographic_wise_training_report');
    Route::post('demographic_wise_training_report', 'ReportInputController@demoGraphicWiseTrainingReportAction');

    //training attendees report
    Route::get('training_attendees_report', 'ReportInputController@trainingAttendeesReport')->name('training_attendees_report');
    Route::post('training_attendees_report', 'ReportInputController@trainingAttendeesReportAction');

    //Training Types
    Route::resource('training_types', 'TrainingTypeController');


    //Department Of Customs Export
    Route::get('department_of_customs/{type}', 'DepartmentOfCustomController@export')->name('department-of-custom');
    Route::post('department_of_customs/{type}', 'DepartmentOfCustomController@exportAction');
    Route::get('department_of_customs_lock', 'DepartmentOfCustomController@updateLockExport')->name('department-of-custom-lock');
    Route::get('dce_excel_insert/{type}', 'DepartmentOfCustomController@excelDataInsert')->name('dce-excel-insert');
    Route::post('dce_excel_insert/{type}', 'DepartmentOfCustomController@excelDataInsertAction');
    Route::get('dce_excel_sample/{type}', 'DepartmentOfCustomController@getSample')->name('dce-excel-sample');

    //Department Of Customs - Permissions for import and export
    Route::get('permission_import_export', 'DepartmentOfCustomController@importExport')->name('permission_import_export');
    Route::post('permission_import_export', 'DepartmentOfCustomController@importExportAction');
    Route::get('permission_import_export_lock', 'DepartmentOfCustomController@importExportUpdateLockExport')->name('permission_import_export_lock');


    //Department of Commerce, Supply and Consumer Right Protection - Market Monitoring

    //API
    // Route::get('dcsc_data_api', 'DepartmentOfCscController@apiData')->name('dcsc_data_api');

    Route::get('dcsc_market_monitoring', 'DepartmentOfCscController@marketMonitoring')->name('dcsc_market_monitoring');
    //Route::post('dcsc_market_monitoring', 'DepartmentOfCscController@marketMonitoringAction');
    Route::get('dcsc_market_monitoring_lock', 'DepartmentOfCscController@updateLock')->name('dcsc_market_monitoring_lock');
    Route::get('dcsc_market_monitoring_excel', 'DepartmentOfCscController@marketMonitoringExcel')->name('dcsc_market_monitoring_excel');
    Route::post('dcsc_market_monitoring_excel', 'DepartmentOfCscController@marketMonitoringExcelAction');
    Route::get('dcsc_market_monitoring_excel_sample/{type}', 'DepartmentOfCscController@getMarketMonitoringSample')->name('dcsc_market_monitoring_excel_sample');
    Route::get('dcsc_market_monitoring_report', 'DepartmentOfCscController@marketMonitoringReport')->name('dcsc-market-monitoring-report');
    Route::get('market_monitoring_import_column', 'DepartmentOfCscController@marketMonitoringImportColumn')->name('market_monitoring_import_column');
    Route::post('market_monitoring_import_column', 'DepartmentOfCscController@marketMonitoringImportColumnAction');


    //Department of Commerce, Supply and Consumer Right Protection - Firm Registration
    Route::get('dcsc_firm_registration', 'DepartmentOfCscController@firmRegistration')->name('dcsc_firm_registration');
    //Route::post('dcsc_firm_registration', 'DepartmentOfCscController@firmRegistrationAction');
    Route::get('dcsc_firm_registration_lock', 'DepartmentOfCscController@updateLockFirmRegistration')->name('dcsc_firm_registration_lock');
    Route::get('dcsc_firm_registration_excel', 'DepartmentOfCscController@firmRegistrationExcel')->name('dcsc_firm_registration_excel');
    Route::post('dcsc_firm_registration_excel', 'DepartmentOfCscController@firmRegistrationExcelAction');
    Route::get('dcsc_firm_registration_excel_sample/{type}', 'DepartmentOfCscController@getfirmRegistrationSample')->name('dcsc_firm_registration_excel_sample');
    Route::get('dcsc_firm_registration_report', 'DepartmentOfCscController@firmRegistrationReport')->name('dcsc_firm_registration_report');
    Route::get('firm_registration_import_column', 'DepartmentOfCscController@firmRegistrationImportColumn')->name('firm_registration_import_column');
    Route::post('firm_registration_import_column', 'DepartmentOfCscController@firmRegistrationImportColumnAction');

//Department of Commerce, Supply and Consumer Right Protection - Permission to Import and Export
    Route::get('dcsc_import_export_registration', 'DepartmentOfCscController@importExportRegistration')->name('dcsc_import_export_registration');

    //Office Of Registration
    Route::get('office_registration', 'OfficeOfRegistrationController@officeRegistration')->name('office_registration');
    Route::post('office_registration', 'OfficeOfRegistrationController@officeRegistrationAction');
    Route::get('office_registration_lock', 'OfficeOfRegistrationController@updateLockOfficeRegistration')->name('office_registration_lock');
    Route::get('office_registration_excel', 'OfficeOfRegistrationController@officeRegistrationExcel')->name('office_registration_excel');
    Route::post('office_registration_excel', 'OfficeOfRegistrationController@officeRegistrationExcelAction');
    Route::get('office_registration_excel_sample', 'OfficeOfRegistrationController@getofficeRegistrationSample')->name('office_registration_excel_sample');
    Route::get('office_registration_company', 'OfficeOfRegistrationController@index')->name('office_registration_company');

    //Department Of Industries
    Route::get('department_of_industries', 'DepartmentOfIndustryController@create')->name('department_of_industries');
    Route::post('department_of_industries', 'DepartmentOfIndustryController@createAction');
    Route::get('department_of_industries_lock', 'DepartmentOfIndustryController@updateLock')->name('department_of_industries_lock');
    Route::get('department_of_industries_excel', 'DepartmentOfIndustryController@excelImport')->name('department_of_industries_excel');
    Route::post('department_of_industries_excel', 'DepartmentOfIndustryController@excelImportAction');
    Route::get('department_of_industries_excel_sample', 'DepartmentOfIndustryController@excelSample')->name('department_of_industries_excel_sample');

    //FDI Approva;
    Route::get('fdi_approval', 'DepartmentOfIndustryController@fdiApprovalCreate')->name('fdi_approval');
    Route::post('fdi_approval', 'DepartmentOfIndustryController@fdiApprovalCreateAction');
    Route::get('fdi_approval_lock', 'DepartmentOfIndustryController@fdiApprovalUpdateLock')->name('fdiApproval_lock');
    Route::get('fdi_approval_excel', 'DepartmentOfIndustryController@fdiApprovalExcelImport')->name('fdiApproval_excel');
    Route::post('fdi_approval_excel', 'DepartmentOfIndustryController@fdiApprovalExcelImportAction');
    Route::get('fdi_approval_excel_sample', 'DepartmentOfIndustryController@fdiApprovalExcelSample')->name('fdiApproval_excel_sample');

    //Repatriation
    Route::get('repatriation_approval', 'DepartmentOfIndustryController@repatriationApprovalCreate')->name('repatriation_approval');
    Route::post('repatriation_approval', 'DepartmentOfIndustryController@repatriationApprovalCreateAction');
    Route::get('repatriation_approval_lock', 'DepartmentOfIndustryController@repatriationApprovalUpdateLock')->name('repatriationApproval_lock');
    Route::get('repatriation_approval_excel', 'DepartmentOfIndustryController@repatriationApprovalExcelImport')->name('repatriationApproval_excel');
    Route::post('repatriation_approval_excel', 'DepartmentOfIndustryController@repatriationApprovalExcelImportAction');
    Route::get('repatriation_approval_excel_sample', 'DepartmentOfIndustryController@repatriationApprovalExcelSample')->name('repatriationApproval_excel_sample');

    //Technology Transfer Agreement Approval
    Route::get('technology_approval', 'DepartmentOfIndustryController@technologyApprovalCreate')->name('technology_approval');
    Route::post('technology_approval', 'DepartmentOfIndustryController@technologyApprovalCreateAction');
    Route::get('technology_approval_lock', 'DepartmentOfIndustryController@technologyApprovalUpdateLock')->name('technologyApproval_lock');
    Route::get('technology_approval_excel', 'DepartmentOfIndustryController@technologyApprovalExcelImport')->name('technologyApproval_excel');
    Route::post('technology_approval_excel', 'DepartmentOfIndustryController@technologyApprovalExcelImportAction');
    Route::get('technology_approval_excel_sample', 'DepartmentOfIndustryController@technologyApprovalExcelSample')->name('technologyApproval_excel_sample');

    //ip_registration
    Route::get('ip_registration', 'DepartmentOfIndustryController@ipRegistrationCreate')->name('ip_registration');
    Route::post('ip_registration', 'DepartmentOfIndustryController@ipRegistrationCreateAction');
    Route::get('ip_registration_lock', 'DepartmentOfIndustryController@ipRegistrationUpdateLock')->name('ip_registration_lock');
    Route::get('ip_registration_excel', 'DepartmentOfIndustryController@ipRegistrationExcelImport')->name('ip_registration_excel');
    Route::post('ip_registration_excel', 'DepartmentOfIndustryController@ipRegistrationExcelImportAction');
    Route::get('ip_registration_excel_sample', 'DepartmentOfIndustryController@ipRegistrationExcelSample')->name('ip_registration_excel_sample');

    //Facility Recommendation
    Route::get('facility_recommendation', 'DepartmentOfIndustryController@facilityRecommendationCreate')->name('facility_recommendation');
    Route::post('facility_recommendation', 'DepartmentOfIndustryController@facilityRecommendationCreateAction');
    Route::get('facility_recommendation_lock', 'DepartmentOfIndustryController@facilityRecommendationUpdateLock')->name('facility_recommendation_lock');
    Route::get('facility_recommendation_excel', 'DepartmentOfIndustryController@facilityRecommendationExcelImport')->name('facility_recommendation_excel');
    Route::post('facility_recommendation_excel', 'DepartmentOfIndustryController@facilityRecommendationExcelImportAction');
    Route::get('facility_recommendation_excel_sample', 'DepartmentOfIndustryController@facilityRecommendationExcelSample')->name('facility_recommendation_excel_sample');


    //IEE Recommendation
    Route::get('iee_related', 'DepartmentOfIndustryController@ieeRelatedCreate')->name('iee_related');
    Route::post('iee_related', 'DepartmentOfIndustryController@ieeRelatedCreateAction');
    Route::get('iee_related_lock', 'DepartmentOfIndustryController@ieeRelatedUpdateLock')->name('iee_related_lock');
    Route::get('iee_related_excel', 'DepartmentOfIndustryController@ieeRelatedExcelImport')->name('iee_related_excel');
    Route::post('iee_related_excel', 'DepartmentOfIndustryController@ieeRelatedExcelImportAction');
    Route::get('iee_related_excel_sample', 'DepartmentOfIndustryController@ieeRelatedExcelSample')->name('iee_related_excel_sample');


    //NEPAL OIL CORPORATION
    Route::get('noc_add', 'NepalOilCorporationController@add')->name('noc_add');
    Route::post('noc_add', 'NepalOilCorporationController@addAction');
    Route::get('noc_import_column', 'NepalOilCorporationController@importColumn')->name('noc_import_column');
    Route::post('noc_import_column', 'NepalOilCorporationController@importColumnAction');
    Route::get('noc_excel_insert', 'NepalOilCorporationController@excelDataInsert')->name('noc-excel-insert');
    Route::post('noc_excel_insert/{type}', 'NepalOilCorporationController@excelDataInsertAction')->name('noc-excel-insert-post');
    Route::get('noc_excel_sample/{type}', 'NepalOilCorporationController@getSample')->name('noc-excel-sample');

    //Food Mgmt Trading Company
    Route::get('food_trading_add/{type}', 'FoodMgmtTradingController@add')->name('food_trading_add');
    Route::post('food_trading_add/{type}', 'FoodMgmtTradingController@addAction');
    Route::get('food_trading_excel_insert/{type}', 'FoodMgmtTradingController@excelDataInsert')->name('food-trading-excel-insert');
    Route::post('food_trading_excel_insert/{type}', 'FoodMgmtTradingController@excelDataInsertAction');
    Route::get('food_trading_excel_sample/{type}', 'FoodMgmtTradingController@getSample')->name('food-trading-excel-sample');

    //National Trading Limited

    Route::get('salt_add/{type}', 'SaltTradingLimitedController@add')->name('salt_trading_add');
    Route::post('salt_add/{type}', 'SaltTradingLimitedController@addAction');
    Route::get('salt_excel_insert/{type}', 'SaltTradingLimitedController@excelDataInsert')->name('salt-trading-excel-insert');
    Route::post('salt_excel_insert/{type}', 'SaltTradingLimitedController@excelDataInsertAction');
    Route::get('salt_excel_sample/{type}', 'SaltTradingLimitedController@getSample')->name('salt-trading-excel-sample');


    //Local Level Product Entry
    Route::get('local_level_add', 'LocalLevelController@add')->name('local_level_add');
    Route::post('local_level_add', 'LocalLevelController@addAction');
    Route::get('local_level_production_excel', 'LocalLevelController@productionExcel')->name('local_level_production_excel');
    Route::post('local_level_production_excel', 'LocalLevelController@productionExcelAction');
    Route::get('local_level_production_excel_sample/{type}', 'LocalLevelController@getProductionSample')->name('local_level_production_excel_sample');

    //Local Level Consumption Entry
    Route::get('local_level_consumption_add', 'ConsumptionController@add')->name('local_level_consumption_add');
    Route::post('local_level_consumption_add', 'ConsumptionController@addAction');
    Route::get('local_level_consumption_excel', 'ConsumptionController@productionExcel')->name('local_level_consumption_excel');
    Route::post('local_level_consumption_excel', 'ConsumptionController@productionExcelAction');
    Route::get('local_level_consumption_excel_sample/{type}', 'ConsumptionController@getProductionSample')->name('local_level_consumption_excel_sample');


    Route::get('local_level_addTraining', 'LocalLevelController@addTraining')->name('local_level_addTraining');
    Route::post('local_level_addTraining', 'LocalLevelController@addTrainingAction');
    Route::get('local_level_training_excel', 'LocalLevelController@trainingExcel')->name('local_level_training_excel');
    Route::post('local_level_training_excel', 'LocalLevelController@trainingExcelAction');
    Route::get('local_level_training_excel_sample/{type}', 'LocalLevelController@getTrainingSample')->name('local_level_training_excel_sample');

    //District Administration office
    Route::get('dao_market_monitoring', 'DistrictAdministrationOffice@marketMonitoring')->name('dao_market_monitoring');
    Route::post('dao_market_monitoring', 'DistrictAdministrationOffice@marketMonitoringAction');
    Route::get('dao_market_monitoring_lock', 'DistrictAdministrationOffice@updateLock')->name('dao_market_monitoring_lock');
    Route::get('dao_market_monitoring_excel', 'DistrictAdministrationOffice@marketMonitoringExcel')->name('dao_market_monitoring_excel');
    Route::post('dao_market_monitoring_excel', 'DistrictAdministrationOffice@marketMonitoringExcelAction');
    Route::get('dao_market_monitoring_excel_sample/{type}', 'DistrictAdministrationOffice@getMarketMonitoringSample')->name('dao_market_monitoring_excel_sample');
    Route::get('dao_market_monitoring_report', 'DistrictAdministrationOffice@marketMonitoringReport')->name('dao-market-monitoring-report');
    Route::get('dao_market_monitoring_import_column', 'DistrictAdministrationOffice@marketMonitoringImportColumn')->name('dao_market_monitoring_import_column');
    Route::post('dao_market_monitoring_import_column', 'DistrictAdministrationOffice@marketMonitoringImportColumnAction');

    //Province and within the province - Home and Small Industries Office - Market Monitoring
    Route::get('hasio_market_monitoring', 'HASIOProvinceController@marketMonitoring')->name('hasio_market_monitoring');
    Route::post('hasio_market_monitoring', 'HASIOProvinceController@marketMonitoringAction');
    Route::get('hasio_market_monitoring_lock', 'HASIOProvinceController@updateLock')->name('hasio_market_monitoring_lock');
    Route::get('hasio_market_monitoring_excel', 'HASIOProvinceController@marketMonitoringExcel')->name('hasio_market_monitoring_excel');
    Route::post('hasio_market_monitoring_excel', 'HASIOProvinceController@marketMonitoringExcelAction');
    Route::get('hasio_market_monitoring_excel_sample/{type}', 'HASIOProvinceController@getMarketMonitoringSample')->name('hasio_market_monitoring_excel_sample');
    Route::get('hasio_market_monitoring_report', 'HASIOProvinceController@marketMonitoringReport')->name('hasio-market-monitoring-report');
    Route::get('hasio_market_monitoring_import_column', 'HASIOProvinceController@marketMonitoringImportColumn')->name('hasio_market_monitoring_import_column');
    Route::post('hasio_market_monitoring_import_column', 'HASIOProvinceController@marketMonitoringImportColumnAction');


    //Province and within the province - Home and Small Industries Office - Firm Registration
    Route::get('hasio_firm_registration', 'HASIOProvinceController@firmRegistration')->name('hasio_firm_registration');
    Route::post('hasio_firm_registration', 'HASIOProvinceController@firmRegistrationAction');
    Route::get('hasio_firm_registration_lock', 'HASIOProvinceController@updateLockFirmRegistration')->name('hasio_firm_registration_lock');
    Route::get('hasio_firm_registration_excel', 'HASIOProvinceController@firmRegistrationExcel')->name('hasio_firm_registration_excel');
    Route::post('hasio_firm_registration_excel', 'HASIOProvinceController@firmRegistrationExcelAction');
    Route::get('hasio_firm_registration_excel_sample/{type}', 'HASIOProvinceController@getfirmRegistrationSample')->name('hasio_firm_registration_excel_sample');
    Route::get('hasio_firm_registration_report', 'HASIOProvinceController@firmRegistrationReport')->name('hasio_firm_registration_report');
    Route::get('hasio_firm_registration_import_column', 'HASIOProvinceController@firmRegistrationImportColumn')->name('hasio_firm_registration_import_column');
    Route::post('hasio_firm_registration_import_column', 'HASIOProvinceController@firmRegistrationImportColumnAction');

    //Province and within the province - Home and Small Industries Office - Training
    Route::get('hasio_addTraining', 'HASIOProvinceController@addTraining')->name('hasio_addTraining');
    Route::post('hasio_addTraining', 'HASIOProvinceController@addTrainingAction');
    Route::get('hasio_training_lock', 'HASIOProvinceController@updateLockTraining')->name('hasio_training_lock');
    Route::get('hasio_training_excel', 'HASIOProvinceController@trainingExcel')->name('hasio_training_excel');
    Route::post('hasio_training_excel', 'HASIOProvinceController@trainingExcelAction');
    Route::get('hasio_training_excel_sample/{type}', 'HASIOProvinceController@getTrainingSample')->name('hasio_training_excel_sample');

    //Province and within the province - Directorate of Industry, Commerce and Consumer Protection - Market Monitoring
    Route::get('icacp_market_monitoring', 'ICACPProvinceController@marketMonitoring')->name('icacp_market_monitoring');
    Route::post('icacp_market_monitoring', 'ICACPProvinceController@marketMonitoringAction');
    Route::get('icacp_market_monitoring_lock', 'ICACPProvinceController@updateLock')->name('icacp_market_monitoring_lock');
    Route::get('icacp_market_monitoring_excel', 'ICACPProvinceController@marketMonitoringExcel')->name('icacp_market_monitoring_excel');
    Route::post('icacp_market_monitoring_excel', 'ICACPProvinceController@marketMonitoringExcelAction');
    Route::get('icacp_market_monitoring_excel_sample/{type}', 'ICACPProvinceController@getMarketMonitoringSample')->name('icacp_market_monitoring_excel_sample');
    Route::get('icacpmarket_monitoring_report', 'ICACPProvinceController@marketMonitoringReport')->name('icacp-market-monitoring-report');
    Route::get('icacp_market_monitoring_import_column', 'ICACPProvinceController@marketMonitoringImportColumn')->name('icacp_market_monitoring_import_column');
    Route::post('icacp_market_monitoring_import_column', 'ICACPProvinceController@marketMonitoringImportColumnAction');

    //Province and within the province - Home and Small Industries Office - Training
    Route::get('icacp_addTraining', 'ICACPProvinceController@addTraining')->name('icacp_addTraining');
    Route::post('icacp_addTraining', 'ICACPProvinceController@addTrainingAction');

    // Home and Small Industry Promotion Center - Training
    Route::get('hipc_addTraining', 'HipcController@addTraining')->name('hipc_addTraining');
    Route::post('hipc_addTraining', 'HipcController@addTrainingAction');


    //Industry And Private Sector
    Route::get('industrial_private_sector_add', 'IndustryAndPrivateSectorController@add')->name('industrial_private_sector_add');
    Route::post('industrial_private_sector_add', 'IndustryAndPrivateSectorController@addAction');


    //report at admin part
    Route::get('admin/report', 'AdminReportController@index')->name('admin_report');
    Route::get('admin/report/DOCSRPMarketMoniter', 'AdminReportController@DOCSRPMarketMoniter')->name('report_DOCSRPMarketMoniter');
    Route::get('admin/report/DOCSRPFirmRegister', 'AdminReportController@DOCSRPFirmRegister')->name('report_DOCSRPFirmRegister');
    Route::get('admin/report/ocr', 'AdminReportController@ocr')->name('report_ocr');
    Route::get('admin/report/doi', 'AdminReportController@doi')->name('report_doi');
    Route::get('admin/report/noc', 'AdminReportController@noc')->name('report_noc');
    Route::get('admin/report/foodManagement/', 'AdminReportController@foodManagement')->name('report_foodManagement');
    Route::get('admin/report/saltTrading/', 'AdminReportController@saltTrading')->name('report_saltTrading');
    Route::get('admin/report/doc/{type}', 'AdminReportController@doc')->name('report_doc');

});

//report at admin part
Route::get('report', 'FrontendController@index')->name('front_admin_report');
Route::get('report/DOCSRPMarketMoniter', 'FrontendController@DOCSRPMarketMoniter')->name('front_report_DOCSRPMarketMoniter');
Route::get('report/DOCSRPFirmRegister', 'FrontendController@DOCSRPFirmRegister')->name('front_report_DOCSRPFirmRegister');
Route::get('report/ocr', 'FrontendController@ocr')->name('front_report_ocr');
Route::get('report/doi', 'FrontendController@doi')->name('front_report_doi');
Route::get('report/noc', 'FrontendController@noc')->name('front_report_noc');
Route::get('report/foodManagement/', 'FrontendController@foodManagement')->name('front_report_foodManagement');
Route::get('report/saltTrading/', 'FrontendController@saltTrading')->name('front_report_saltTrading');
Route::get('report/doc/{type}', 'FrontendController@doc')->name('front_report_doc');


Route::get('/change-languange/{lang}', 'UtilController@changeLanguage')->name('change-lang');
Route::get('/current-fiscal-year', 'UtilController@getCurrentFiscalYear')->name('current-fiscal-year');

//**********************GetProvienceDistrictMunciplity */
Route::get('/get-district-with-province', 'ajaxget@getDistrict')->name('getDistrict');
Route::get('/get-muncipality-with-district', 'ajaxget@getMuncipality')->name('getMuncipality');

//**********************forecast***************************************************************************
Route::get('/forecast', 'ForeCastController@index')->name('ForecastIndex'); // CenralAnalysis
Route::get('/forecast-province', 'ForeCastController@ProvinceAnalysis')->name('ProvinceAnalysis'); // ProvinceAnalysis
Route::get('/forecast-district', 'ForeCastController@DistrictAnalysis')->name('DistrictAnalysis'); // DistrictAnalysis
Route::get('/forecast-production', 'ForeCastController@ProductionAnalysis')->name('ProductionAnalysis'); // ProductionAnalysis
Route::get('/forecast-consumption', 'ForeCastController@ConsumptionAnalysis')->name('ConsumptionAnalysis'); // ConsumptionAnalysis
Route::get('/forecast-import', 'ForeCastController@ImportAnalysis')->name('ImportAnalysis'); // ImportAnalysis
Route::get('/forecast-export', 'ForeCastController@ExportAnalysis')->name('ExportAnalysis'); // ExportAnalysis
Route::get('/forecast-future-predict', 'ForeCastController@FutureAnalysis')->name('FutureAnalysis'); // FutureAnalysis

Route::get('/ajax-get-monthly-data', 'ForeCastController@AjaxgetMonthlyData')->name('AjaxgetMonthlyData'); // FutureAnalysis
Route::get('/ajax-get-comparision-yearly-data', 'ForeCastController@AjaxGetYearlyData')->name('AjaxGetYearlyData'); // comparision yearly based data
Route::get('/ajax-get-comparision-yearly-production-line-chart-data', 'ForeCastController@AjaxGetYearlyLineChartData')->name('AjaxGetYearlyLineChartData'); // comparision yearly based data
