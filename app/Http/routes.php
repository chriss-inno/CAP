<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/',['middleware' => 'auth', 'uses' => 'UserController@showLogin']);

Route::get('home', ['middleware' => 'auth', 'uses' =>'UserController@showHome']);

Route::get('customer-creaditapp/{id}', ['middleware' => 'auth', 'uses' =>'CreditProposalController@getByCustomer']);
Route::get('cap-manage', ['middleware' => 'auth', 'uses' =>'CreditProposalController@manage']);
Route::get('credit-proposal', ['middleware' => 'auth', 'uses' =>'CreditProposalController@index']);
Route::get('proposal/list', ['middleware' => 'auth', 'uses' =>'CreditProposalController@index']);
Route::get('proposal/create/{id}', ['middleware' => 'auth', 'uses' =>'CreditProposalController@create']);
Route::post('credit-proposal',['middleware' => 'auth', 'uses' => 'CreditProposalController@store']);

//Delete application
Route::get('credit-proposal/delete/{id}', ['middleware' => 'auth', 'uses' =>'CreditProposalController@destroy']);
Route::get('credit-proposal/del/{id}', ['middleware' => 'auth', 'uses' =>'CreditProposalController@destroyApp']);
Route::get('customer-creaditapp/credit-proposal/{id}',['middleware' => 'auth', 'uses' => 'CreditProposalController@show']);
Route::post('credit-proposal/{id}',['middleware' => 'auth', 'uses' => 'CreditProposalController@store']);
Route::get('credit-proposal/{id}',['middleware' => 'auth', 'uses' => 'CreditProposalController@show']);
Route::get('credit-proposal/edit/{id}',['middleware' => 'auth', 'uses' => 'CreditProposalController@edit']);
Route::get('credit-proposal/app/{id}',['middleware' => 'auth', 'uses' => 'CreditProposalController@showselected']);
Route::post('cap/edit',['middleware' => 'auth', 'uses' => 'CreditProposalController@storeEdit']);


//Process CA forms
Route::resource('caroposal','CAProposalController');


//Chart routes


Route::get('cap-new', ['middleware' => 'auth', 'uses' =>'CreditProposalController@newApplications']);
Route::get('cap-pending', ['middleware' => 'auth', 'uses' =>'CreditProposalController@pendingApplications']);
Route::get('cap-incomplete', ['middleware' => 'auth', 'uses' =>'CreditProposalController@incompleteApplications']);
Route::get('lasthour', ['middleware' => 'auth', 'uses' =>'CreditProposalController@lasthour']);
Route::get('lastweek', ['middleware' => 'auth', 'uses' =>'CreditProposalController@lastweek']);
Route::get('last24hours', ['middleware' => 'auth', 'uses' =>'CreditProposalController@last24hours']);


//Manage Facility structure
Route::get('facility-structure/{id}', ['middleware' => 'auth', 'uses' =>'facilityStructureController@index']);
Route::post('facility-structure', ['middleware' => 'auth', 'uses' =>'facilityStructureController@store']);

//Process 'proposed-security' form

Route::get('proposed-security/{id}', ['middleware' => 'auth', 'uses' =>'ProposedSecurityContoller@index']);
Route::post('proposed-security', ['middleware' => 'auth', 'uses' =>'ProposedSecurityContoller@store']);

//Process convenant form
Route::get('conventanty/{id}', ['middleware' => 'auth', 'uses' =>'CovenantsContoller@index']);
Route::post('conventanty', ['middleware' => 'auth', 'uses' =>'CovenantsContoller@store']);

//Process PricingRationale form
Route::get('pricingrationale/{id}', ['middleware' => 'auth', 'uses' =>'PricingRationaleController@index']);
Route::post('pricingrationale', ['middleware' => 'auth', 'uses' =>'PricingRationaleController@store']);

//Process PricingRationale form
Route::get('business-activity/{id}', ['middleware' => 'auth', 'uses' =>'BusinessActivitiesController@index']);
Route::post('business-activity', ['middleware' => 'auth', 'uses' =>'BusinessActivitiesController@store']);

//Process EnvironmentController form
Route::get('environment/{id}', ['middleware' => 'auth', 'uses' =>'EnvironmentController@index']);
Route::post('environment', ['middleware' => 'auth', 'uses' =>'EnvironmentController@store']);


//Process SwotAnalysisController form
Route::get('swot-analysis/{id}', ['middleware' => 'auth', 'uses' =>'SwotAnalysisController@index']);
Route::post('swot-analysis', ['middleware' => 'auth', 'uses' =>'SwotAnalysisController@store']);

//Process account-performance
Route::get('account-performance/{id}', ['middleware' => 'auth', 'uses' =>'AccountPerformanceController@index']);
Route::post('account-performance', ['middleware' => 'auth', 'uses' =>'AccountPerformanceController@store']);

//Process account-profile
Route::get('account-profile/{id}', ['middleware' => 'auth', 'uses' =>'AccountProfileController@index']);
Route::post('account-profile', ['middleware' => 'auth', 'uses' =>'AccountProfileController@store']);

//Process form summary
Route::get('summary/{id}',['middleware' => 'auth', 'uses' =>'CAProposalController@showSummry']);

Route::get('process/forms', ['middleware' => 'auth', 'uses' =>'CAProposalController@showAppforms']);
Route::get('processform/{id}', ['middleware' => 'auth', 'uses' =>'processformController@processform']);
Route::get('removeform/{id}', ['middleware' => 'auth', 'uses' =>'processformController@removeform']);
Route::get('formsummary/{id}', ['middleware' => 'auth', 'uses' =>'processformController@formSummary']);

//Credit grading

Route::get('credit-rading/{id}', ['middleware' => 'auth', 'uses' =>'CreditRiskGradingController@index']);
Route::post('credit-grading', ['middleware' => 'auth', 'uses' =>'CreditRiskGradingController@store']);

//Downloadd PDF file
Route::get('download/pdf/{id}', ['middleware' => 'auth', 'uses' =>'processformController@downloadPDF']);
Route::get('download/pdf/report/{id}',['middleware' => 'auth', 'uses' => 'CreditProposalController@report']);
Route::post('download/pdf/report',['middleware' => 'auth', 'uses' => 'CreditProposalController@downloadreport']);
Route::get('download/pdf/st-report/{id}',['middleware' => 'auth', 'uses' => 'CreditProposalController@downloadstreport']);



Route::post('order/confirm/summary/{id}',array('uses'=>'CAProposalController@showSummry'));

//Final recommendations

Route::get('final-recommendations/{id}', ['middleware' => 'auth', 'uses' =>'FinalRecommendationsController@index']);
Route::post('final-recommendations', ['middleware' => 'auth', 'uses' =>'FinalRecommendationsController@store']);


//Process Annexture-I form
Route::get('annexure_i/{id}', ['middleware' => 'auth', 'uses' =>'AnnexureIController@index']);
Route::post('annexure_i', ['middleware' => 'auth', 'uses' =>'AnnexureIController@store']);

//Process Annexture-II form
Route::get('annexure_ii/{id}', ['middleware' => 'auth', 'uses' =>'AnnexureIIController@index']);
Route::post('annexure_ii', ['middleware' => 'auth', 'uses' =>'AnnexureIIController@store']);
//Financial analysis

Route::get('financial-analysis/{id}', ['middleware' => 'auth', 'uses' =>'FinancialAnalysisController@index']);
Route::post('financial-analysis', ['middleware' => 'auth', 'uses' =>'FinancialAnalysisController@store']);

//Authorize application
Route::get('authorize/{id}',['middleware' => 'auth', 'uses' => 'CreditProposalController@authorize']);
Route::get('authorize-manage/{id}',['middleware' => 'auth', 'uses' => 'CreditProposalController@authorizemanage']);

//Currency

Route::post('currency', ['middleware' => 'auth', 'uses' =>'CurrencyController@store']);
Route::get('currency', ['middleware' => 'auth', 'uses' =>'CurrencyController@index']);
Route::get('currency-edit/{id}', ['middleware' => 'auth', 'uses' =>'CurrencyController@edit']);
Route::get('currency-create', ['middleware' => 'auth', 'uses' =>'CurrencyController@create']);
Route::post('currency-edit', ['middleware' => 'auth', 'uses' =>'CurrencyController@update']);
Route::get('currency-delete', ['middleware' => 'auth', 'uses' =>'CurrencyController@destroy']);
Route::get('currency/{id}', ['middleware' => 'auth', 'uses' =>'CurrencyController@edit']);

//Manage department setting
Route::get('department-edit/{id}', ['middleware' => 'auth', 'uses' =>'CreditDepartmentController@edit']);
Route::get('department-delete/{id}', ['middleware' => 'auth', 'uses' =>'CreditDepartmentController@destroy']);
Route::post('department', ['middleware' => 'auth', 'uses' =>'CreditDepartmentController@store']);
Route::post('department-edit', ['middleware' => 'auth', 'uses' =>'CreditDepartmentController@update']);
Route::get('department', ['middleware' => 'auth', 'uses' =>'CreditDepartmentController@index']);
Route::get('dept-create', ['middleware' => 'auth', 'uses' =>'CreditDepartmentController@create']);

//Manage users
Route::resource('users','UserController');
Route::post('changepass',['middleware' => 'auth', 'uses' =>'UserController@changepass']);
Route::get('remove-user/{id}',['middleware' => 'auth', 'uses' =>'UserController@destroy']);
Route::get('edit-user/{id}',['middleware' => 'auth', 'uses' =>'UserController@edit']);
Route::post('edit-user',['middleware' => 'auth', 'uses' =>'UserController@update']);



//Show logout
Route::get('logout',['middleware' => 'auth', 'uses' =>'UserController@showLogout']);

//Show login page
Route::get('login','UserController@showLogin');
Route::post('processLogin','UserController@processLogin');

//Show profile

Route::get('profile', ['middleware' => 'auth', 'uses' =>'UserController@showProfile']);


//Serial Number process
Route::get('serialno',['middleware' => 'auth', 'uses' =>'CASerialNumberController@index']);
Route::post('serialno',['middleware' => 'auth', 'uses' =>'CASerialNumberController@store']);

//Route for tempex
Route::get('tempex', ['middleware' => 'auth', 'uses' =>'TempexController@showForm']);

//Signatories
Route::get('signatories', ['middleware' => 'auth', 'uses' =>'SignatoriesContoller@index']);
Route::get('signatoriespost/{sig}',['middleware' => 'auth', 'uses' =>'SignatoriesContoller@store']);


//Committee
Route::get('committee',['middleware' => 'auth', 'uses' =>'CreditCommiteeController@index']);
Route::get('committee/edit/{id}',['middleware' => 'auth', 'uses' =>'CreditCommiteeController@edit']);
Route::get('committee/create',['middleware' => 'auth', 'uses' =>'CreditCommiteeController@create']);
Route::get('committee/view',['middleware' => 'auth', 'uses' =>'CreditCommiteeController@index']);
Route::get('committee/manage',['middleware' => 'auth', 'uses' =>'CreditCommiteeController@index']);
Route::post('committee',['middleware' => 'auth', 'uses' =>'CreditCommiteeController@store']);
Route::post('committee-edit',['middleware' => 'auth', 'uses' =>'CreditCommiteeController@update']);
Route::get('committee/delete/{id}',['middleware' => 'auth', 'uses' =>'CreditCommiteeController@destroy']);

//Credit Directors
Route::get('directors',['middleware' => 'auth', 'uses' =>'DirectorCommmitteeController@index']);
Route::get('directors/edit/{id}',['middleware' => 'auth', 'uses' =>'DirectorCommmitteeController@edit']);
Route::get('directors/create',['middleware' => 'auth', 'uses' =>'DirectorCommmitteeController@create']);
Route::get('directors/view',['middleware' => 'auth', 'uses' =>'DirectorCommmitteeController@index']);
Route::get('directors/manage',['middleware' => 'auth', 'uses' =>'DirectorCommmitteeController@index']);
Route::post('directors',['middleware' => 'auth', 'uses' =>'DirectorCommmitteeController@store']);
Route::post('directors-edit',['middleware' => 'auth', 'uses' =>'DirectorCommmitteeController@update']);
Route::get('directors/delete/{id}',['middleware' => 'auth', 'uses' =>'DirectorCommmitteeController@destroy']);

//Legal Entity

Route::get('legal-entity',['middleware' => 'auth', 'uses' =>'LegalEntityController@index']);
Route::get('legal-entity/edit/{id}',['middleware' => 'auth', 'uses' =>'LegalEntityController@edit']);
Route::get('legal-entity/create',['middleware' => 'auth', 'uses' =>'LegalEntityController@create']);
Route::get('legal-entity/view',['middleware' => 'auth', 'uses' =>'LegalEntityController@index']);
Route::get('legal-entity/manage',['middleware' => 'auth', 'uses' =>'LegalEntityController@index']);
Route::post('legal-entity',['middleware' => 'auth', 'uses' =>'LegalEntityController@store']);
Route::post('legal-entity-edit',['middleware' => 'auth', 'uses' =>'LegalEntityController@update']);
Route::get('legal-entity/delete/{id}',['middleware' => 'auth', 'uses' =>'LegalEntityController@destroy']);

//Reports
Route::get('reports',['middleware' => 'auth', 'uses' =>'ReportController@index']);
Route::post('reports',['middleware' => 'auth', 'uses' =>'ReportController@generate']);
Route::post('excelExport',['middleware' => 'auth', 'uses' =>'ReportController@excelExport']);
Route::get('excelExport',['middleware' => 'auth', 'uses' =>'ReportController@excelExport']);

//Customers
Route::get('customers',['middleware' => 'auth', 'uses' =>'CustomerController@index']);
Route::get('customers/create',['middleware' => 'auth', 'uses' =>'CustomerController@create']);
Route::post('customers/create',['middleware' => 'auth', 'uses' =>'CustomerController@store']);
Route::post('customers/edit',['middleware' => 'auth', 'uses' =>'CustomerController@update']);
Route::get('customers/edit/{id}',['middleware' => 'auth', 'uses' =>'CustomerController@edit']);
Route::get('customers',['middleware' => 'auth', 'uses' =>'CustomerController@index']);
Route::get('customers/remove/{id}',['middleware' => 'auth', 'uses' =>'CustomerController@destroy']);
Route::get('customers/credit-proposal/create', ['middleware' => 'auth', 'uses' =>'CustomerController@index']);

Route::get('customer/profile/{id}',['middleware' => 'auth', 'uses' =>'CustomerController@showProfile']);

//Emails
Route::get('incomplete','EmailController@incompleteForms');

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);
