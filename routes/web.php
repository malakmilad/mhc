<?php

use Illuminate\Support\Facades\Route;

Auth::routes();
Route::group(['middleware' => ['auth']], function () {
     Route::get('/home', 'HomeController@index')->name('home');
     Route::get('/', 'HomeController@index')->name('home');
     Route::get('/logout', 'UserController@logout')->name('userLogout');
     Route::get('/uploadsheet/{menuid}', 'SheetController@sheet')->name('uploadsheet');
     Route::post('/savesheet', 'SheetController@sheetStore')->name('savesheet');

     // user
     Route::get('/user/{menuid}', 'UserController@index')->name('user.index');

     Route::get('/adduserform/{menuid}', 'UserController@create')->name('user.create');

     Route::post('/addnewuser', 'UserController@store')->name('user.store');

     Route::get('/edituserform/{user}/{menuid}', 'UserController@edit')->name('user.edit');

     Route::post('/updateuser/{user}', 'UserController@update')->name('user.update');

     Route::get('/deleteuser/{user}/{menuid}', 'UserController@destory')->name('user.destory');

     Route::post('/updateprofile/{user}', 'UserController@updateprofile')->name('updateprofile.updateprofile');

     Route::post('/updateprofilelogo/{user}', 'UserController@updateprofilelogo')->name('updateprofile.log');

     Route::get('/profile', 'UserController@show')->name('user.show');





     Route::get('/report', 'ReportController@index')->name('reports.index');


     // sheet
     Route::get('/sheet/{menuid}', 'SheetController@index')->name('sheet.index');

     Route::get('/allsheets/{menuid}', 'SheetController@allsheets')->name('sheet.allsheets');
     Route::get('/allsheetsreport/{menuid}', 'SheetController@allsheetsreport')->name('sheet.allsheetsreport');
     
     Route::get('/addsheetform/{menuid}', 'SheetController@create')->name('sheet.create');

     Route::post('/addnewsheet', 'SheetController@store')->name('sheet.store');

     Route::get('/editsheetform/{sheet}/{menuid}', 'SheetController@edit')->name('sheet.edit');

     Route::post('/updatesheet/{sheet}', 'SheetController@update')->name('sheet.update');

     Route::post('/sheatsearch', 'SheetController@sheatsearch')->name('search.sheatsearch');

     Route::get('/deletesheet/{sheet}/{menuid}', 'SheetController@destory')->name('sheet.destory');
     Route::get('/sheetreport/{menuid}', 'SheetController@report')->name('sheet.report');
     Route::post('/searchreportsheet', 'SheetController@reportsearch')->name('sheet.reportsearch');


     // interest
     Route::get('/interest/{menuid}', 'InterestedController@index')->name('interest.index');

     Route::get('/addinterestform/{menuid}', 'InterestedController@create')->name('interest.create');

     Route::post('/addnewinterest', 'InterestedController@store')->name('interest.store');

     Route::get('/editinterestform/{interest}/{menuid}', 'InterestedController@edit')->name('interest.edit');

     Route::post('/updateinterest/{interest}', 'InterestedController@update')->name('interest.update');

     Route::post('/interestsearch', 'InterestedController@sheatsearch')->name('search.interestsearch');

     Route::get('/deleteinterest/{interest}/{menuid}', 'InterestedController@destory')->name('interest.destory');

     Route::post('/deleteallsheets', 'InterestedController@destoryallsheets')->name('deleteallselectedsheets');
     Route::post('/deleteallsheetsinsheet', 'SheetController@destoryallsheets')->name('sheet.deleteallselectedsheets');


     // group
     Route::get('/group/{menuid}', 'GroupController@index')->name('group.index');

     Route::get('/addgroupform/{menuid}', 'GroupController@create')->name('group.create');

     Route::post('/addnewgroup', 'GroupController@store')->name('group.store');

     Route::get('/editgroupform/{group}/{menuid}', 'GroupController@edit')->name('group.edit');

     Route::post('/updategroup/{group}', 'GroupController@update')->name('group.update');

     Route::get('/deletegroup/{group}/{menuid}', 'GroupController@destory')->name('group.destory');

     //activite
     Route::get('/activites/{menuid}', 'ActiviteController@index')->name('activite.index');

     Route::get('/editactiviteform/{activite}/{menuid}', 'ActiviteController@edit')->name('activite.edit');

     Route::get('/deleteactivite/{activite}/{menuid}', 'ActiviteController@destory')->name('activite.destory');

     Route::get('/addactiviteform/{menuid}', 'ActiviteController@create')->name('activite.create');

     Route::post('/addnewactivite', 'ActiviteController@store')->name('activite.store');

     Route::post('/updateactivite/{activite}', 'ActiviteController@update')->name('activite.update');


     //vehicle
     Route::get('/vehicles/{menuid}', 'VehicleController@index')->name('vehicle.index');

     Route::get('/editvehicleform/{vehicle}/{menuid}', 'VehicleController@edit')->name('vehicle.edit');

     Route::get('/deletevehicle/{vehicle}/{menuid}', 'VehicleController@destory')->name('vehicle.destory');

     Route::get('/addvehicleform/{menuid}', 'VehicleController@create')->name('vehicle.create');

     Route::post('/addnewvehicle', 'VehicleController@store')->name('vehicle.store');

     Route::post('/updatevehicle/{vehicle}', 'VehicleController@update')->name('vehicle.update');


     //company
     Route::get('/companies/{menuid}', 'CompanyController@index')->name('company.index');

     Route::get('/editcompanyform/{company}/{menuid}', 'CompanyController@edit')->name('company.edit');

     Route::get('/deletecompany/{company}/{menuid}', 'CompanyController@destory')->name('company.destory');

     Route::get('/addcompanyform/{menuid}', 'CompanyController@create')->name('company.create');

     Route::post('/addnewcompany', 'CompanyController@store')->name('company.store');

     Route::post('/updatecompany/{company}', 'CompanyController@update')->name('company.update');



     //Disease
     Route::get('/diseases/{menuid}', 'DiseaseController@index')->name('disease.index');

     Route::get('/editdiseaseform/{disease}/{menuid}', 'DiseaseController@edit')->name('disease.edit');

     Route::get('/deletedisease/{disease}/{menuid}', 'DiseaseController@destory')->name('disease.destory');

     Route::get('/adddiseaseform/{menuid}', 'DiseaseController@create')->name('disease.create');

     Route::post('/addnewdisease', 'DiseaseController@store')->name('disease.store');

     Route::post('/updatedisease/{vehicle}', 'DiseaseController@update')->name('disease.update');

     //Disease
     Route::get('/expenses/{menuid}', 'ExpenseController@index')->name('expense.index');

     Route::get('/editexpenseform/{expense}/{menuid}', 'Expenseontroller@edit')->name('expense.edit');

     Route::get('/deleteexpense/{expense}/{menuid}', 'ExpenseController@destory')->name('expense.destory');

     Route::get('/addexpenseform/{menuid}', 'ExpenseController@create')->name('expense.create');

     Route::post('/addnewexpense', 'ExpenseController@store')->name('expense.store');

     Route::post('/updateexpense/{vehicle}', 'ExpenseController@update')->name('expense.update');

     //areas
     Route::get('/areas/{menuid}', 'AreaController@index')->name('area.index');

     Route::get('/editareaform/{area}/{menuid}', 'AreaController@edit')->name('area.edit');

     Route::get('/deletearea/{area}/{menuid}', 'AreaController@destory')->name('area.destory');

     Route::get('/addareaform/{menuid}', 'AreaController@create')->name('area.create');

     Route::post('/addnewarea', 'AreaController@store')->name('area.store');

     Route::post('/updatearea/{area}', 'AreaController@update')->name('area.update');

     //customer
     Route::get('/customer/{menuid}', 'customerController@index')->name('customer.index');

     Route::get('/editcustomerform/{customerType}/{menuid}', 'customerController@edit')->name('customer.edit');

     Route::get('/deletecustomer/{customerType}/{menuid}', 'customerController@destory')->name('customer.destory');

     Route::get('/addcustomerform/{menuid}', 'customerController@create')->name('customer.create');

     Route::post('/addnewcustomer', 'customerController@store')->name('customer.store');

     Route::post('/updatecustomer/{customerType}', 'customerController@update')->name('customer.update');

     //answer
     Route::get('/deleteanswer/{answer}/{menuid}', 'AnswerController@destory')->name('answer.destory');

     Route::get('/addanswerform/{menuid}', 'AnswerController@create')->name('answer.create');

     Route::post('/addnewanswer', 'AnswerController@store')->name('answer.store');
     Route::post('/get_tasks', 'TimeTableController@get_tasks')->name('get_tasks');
     Route::get('/answer/{menuid}', 'AnswerController@index')->name('answer.index');
     Route::get('/reportanswer/{menuid}', 'AnswerController@report')->name('answer.report');
     Route::post('/searchanswer', 'AnswerController@answersearch')->name('answer.answersearch');
     //!vehicle report route
     Route::get('/vehicle','TimeTableController@vehicle_Report')->name('vehicle.report');

     //socails
     Route::get('/socail/{menuid}', 'SocailController@index')->name('socail.index');

     Route::get('/editsocailform/{socail}/{menuid}', 'SocailController@edit')->name('socail.edit');

     Route::get('/deletesocail/{socail}/{menuid}', 'SocailController@destory')->name('socail.destory');

     Route::get('/addsocailform/{menuid}', 'SocailController@create')->name('socail.create');

     Route::post('/addnewsocail', 'SocailController@store')->name('socail.store');

     Route::post('/updatesocail/{socail}', 'SocailController@update')->name('socail.update');

     //TaskTypes
     Route::get('/TaskTypes/{menuid}', 'taskTypesController@index')->name('taskTypes.index');

     Route::get('/editTaskTypesform/{TaskType}/{menuid}', 'taskTypesController@edit')->name('taskTypes.edit');

     Route::get('/deleteTaskTypes/{TaskType}/{menuid}', 'taskTypesController@destory')->name('taskTypes.destory');

     Route::get('/addTaskTypesform/{menuid}', 'taskTypesController@create')->name('taskTypes.create');

     Route::post('/addnewTaskTypes', 'taskTypesController@store')->name('taskTypes.store');

     Route::post('/updateTaskTypes/{TaskType}', 'taskTypesController@update')->name('taskTypes.update');

     //TaskStatus
     Route::get('/TaskStatus/{menuid}', 'taskStatusController@index')->name('taskStatus.index');

     Route::get('/editTaskStatusform/{TaskStatus}/{menuid}', 'taskStatusController@edit')->name('taskStatus.edit');

     Route::get('/deleteTaskStatus/{TaskStatus}/{menuid}', 'taskStatusController@destory')->name('taskStatus.destory');

     Route::get('/addTaskStatusform/{menuid}', 'taskStatusController@create')->name('taskStatus.create');

     Route::post('/addnewTaskStatus', 'taskStatusController@store')->name('taskStatus.store');

     Route::post('/updateTaskStatus/{TaskStatus}', 'taskStatusController@update')->name('taskStatus.update');

     //stages
     Route::get('/stage/{menuid}', 'stageController@index')->name('stage.index');

     Route::get('/editstageform/{Stage}/{menuid}', 'stageController@edit')->name('stage.edit');

     Route::get('/deletestage/{Stage}/{menuid}', 'stageController@destory')->name('stage.destory');

     Route::get('/addstageform/{menuid}', 'stageController@create')->name('stage.create');

     Route::post('/addnewstage', 'stageController@store')->name('stage.store');

     Route::post('/updatestage/{Stage}', 'stageController@update')->name('stage.update');

     //opportunity
     Route::get('/opportunity/{menuid}', 'opportunityController@index')->name('opportunity.index');

     Route::get('/editopportunityform/{opportunity}/{menuid}', 'opportunityController@edit')->name('opportunity.edit');

     Route::get('/deleteopportunity/{opportunity}/{menuid}', 'opportunityController@destory')->name('opportunity.destory');

     Route::get('/addopportunityform/{menuid}', 'opportunityController@create')->name('opportunity.create');

     Route::post('/addnewopportunity', 'opportunityController@store')->name('opportunity.store');

     Route::post('/updateopportunity/{opportunity}', 'opportunityController@update')->name('opportunity.update');
     Route::post('/opportunitysearch', 'opportunityController@opportunitysearch')->name('search.opportunitysearch');
     // menu
     Route::get('/menu/{menuid}', 'MenuController@index')->name('menu.index');

     Route::get('/addmenuform/{menuid}', 'MenuController@create')->name('menu.create');

     Route::post('/addnewmenu', 'MenuController@store')->name('menu.store');

     Route::get('/editmenuform/{menu}/{menuid}', 'MenuController@edit')->name('menu.edit');

     Route::post('/updatemenu/{menu}', 'MenuController@update')->name('menu.update');

     Route::get('/deletemenu/{menu}/{menuid}', 'MenuController@destory')->name('menu.destory');

     // service
     Route::get('/service/{menuid}', 'ServiceController@index')->name('service.index');

     Route::get('/addserviceform/{menuid}', 'ServiceController@create')->name('service.create');

     Route::post('/addnewservice', 'ServiceController@store')->name('service.store');

     Route::get('/editserviceform/{service}/{menuid}', 'ServiceController@edit')->name('service.edit');

     Route::post('/updateservice/{service}', 'ServiceController@update')->name('service.update');

     Route::get('/deleteservice/{service}/{menuid}', 'ServiceController@destory')->name('service.destory');

     // phonetype
     Route::get('/phonetype/{menuid}', 'PhoneTypeController@index')->name('phonetype.index');

     Route::get('/addphonetypeform/{menuid}', 'PhoneTypeController@create')->name('phonetype.create');

     Route::post('/addnewphonetype', 'PhoneTypeController@store')->name('phonetype.store');

     Route::get('/editphonetypeform/{phonetype}/{menuid}', 'PhoneTypeController@edit')->name('phonetype.edit');

     Route::post('/updatephonetype/{phonetype}', 'PhoneTypeController@update')->name('phonetype.update');

     Route::get('/deletephonetype/{phonetype}/{menuid}', 'PhoneTypeController@destory')->name('phonetype.destory');

     // question
     Route::get('/question/{menuid}', 'QuestionController@index')->name('question.index');
     Route::get('/addquestionform/{menuid}', 'QuestionController@create')->name('question.create');
     Route::post('/addnewquestion', 'QuestionController@store')->name('question.store');
     Route::get('/editquestionform/{question}/{menuid}', 'QuestionController@edit')->name('question.edit');
     Route::post('/updatequestion/{question}', 'QuestionController@update')->name('question.update');
     Route::get('/deletequestion/{question}/{menuid}', 'QuestionController@destory')->name('question.destory');

     // timetable
     Route::get('/timetable/{menuid}', 'TimeTableController@index')->name('timetable.index');
     Route::get('/calender/{menuid}', 'calenderController@index')->name('calender.index');
     Route::get('/timetablereport/{menuid}', 'TimeTableController@report')->name('timetable.report');
     Route::get('/timetablecompanyreport/{menuid}', 'TimeTableController@companyreport')->name('timetable.companyreport');
     Route::post('/searchcompanyreporttimetable', 'TimeTableController@companyreportsearch')->name('timetable.companyreportsearch');
   
     Route::get('/clientoperationreport/{menuid}', 'TimeTableController@clientoperationreport')->name('timetable.clientoperationreport');
     Route::post('/searchclientoperationreport', 'TimeTableController@searchclientoperationreport')->name('timetable.searchclientoperationreport');

     Route::post('/searchreporttimetable', 'TimeTableController@reportsearch')->name('timetable.reportsearch');
     Route::get('/reportvehicle/{menuid}', 'TimeTableController@reportvehicle')->name('timetable.reportvehicle');
     Route::post('/searchreporttimetablevehicle', 'TimeTableController@reportsearchvehicle')->name('timetable.reportsearchvehicle');

     Route::get('/timetablecompanyoperations/{menuid}', 'TimeTableController@companyoperations')->name('timetable.companyoperations');
     Route::post('/timetablecompanysearch', 'TimeTableController@companysearch')->name('timetable.companysearch');

     Route::get('/alltimes/{menuid}', 'TimeTableController@alltimes')->name('timetable.alltimes');
     Route::get('/alltimesreport/{menuid}', 'TimeTableController@alltimesreport')->name('timetable.alltimesreport');
     Route::get('/alltimes1/{menuid}', 'TimeTableController@alltimes1')->name('timetable.alltasks');

     Route::get('/addtimetableform/{menuid}', 'TimeTableController@create')->name('timetable.create');
     Route::get('/addtimetableform1/{menuid}/{user_id}', 'TimeTableController@create1')->name('timetable.create1');

     Route::post('/addnewtimetable', 'TimeTableController@store1')->name('timetable.store1');

     Route::get('/edittimetableform/{timetable}/{menuid}', 'TimeTableController@edit')->name('timetable.edit');

     Route::post('/updatetimetable/{timetable}', 'TimeTableController@update')->name('timetable.update');

     Route::get('/deletetimetable/{timetable}/{menuid}', 'TimeTableController@destory')->name('timetable.destory');


     Route::get('/hasdone/{timetable}/{menuid}', 'TimeTableController@funtodone')->name('timetable.funtodone');

     Route::get('/hasundo/{timetable}/{menuid}', 'TimeTableController@funtoundone')->name('timetable.funtoundone');

     Route::post('/searchtimetable', 'TimeTableController@timetablesearch')->name('timetable.timetablesearch');


     Route::post('/searchcompanyoperation', 'TimeTableController@companyoperationssearch')->name('timetable.companyoperationssearch');
     //housing
     Route::get('/housing/{menuid}', 'HousingController@index')->name('housing.index');

     Route::get('/edithousing/{Housing}/{menuid}', 'HousingController@edit')->name('housing.edit');

     Route::get('/deletehousing/{Housing}/{menuid}', 'HousingController@destory')->name('housing.destory');

     Route::get('/addhousing/{menuid}', 'HousingController@create')->name('housing.create');

     Route::post('/addnewhousing', 'HousingController@store')->name('housing.store');

     Route::post('/updatehousing/{Housing}', 'HousingController@update')->name('housing.update');

     //populations

     Route::get('/populations/{menuid}', 'PopulationsController@index')->name('population.index');

     Route::get('/editpopulations/{Population}/{menuid}', 'PopulationsController@edit')->name('population.edit');

     Route::get('/deletepopulations/{Population}/{menuid}', 'PopulationsController@destory')->name('population.destory');

     Route::get('/addpopulations/{menuid}', 'PopulationsController@create')->name('population.create');

     Route::post('/addnewpopulations', 'PopulationsController@store')->name('population.store');

     Route::post('/updatepopulations/{Population}', 'PopulationsController@update')->name('population.update');

     Route::post('/populationsearch', 'PopulationsController@populationsearch')->name('search.populationsearch');

     //client_groups
     Route::get('/client_groups/{menuid}', 'MessageController@index')->name('client_groups.index');

     Route::get('/edit_client_groups/{clientGroup}/{menuid}', 'MessageController@edit')->name('client_groups.edit');

     Route::get('/delete_client_groups/{clientGroup}/{menuid}', 'MessageController@destory')->name('client_groups.destory');

     Route::get('/add_client_groups/{menuid}', 'MessageController@create')->name('client_groups.create');

     Route::post('/store_client_groups', 'MessageController@store')->name('client_groups.store');

     Route::post('/update_client_groups/{clientGroup}', 'MessageController@update')->name('client_groups.update');

     //client_emails
     Route::get('/client_message/{menuid}', 'MessageController@index_message')->name('client_message.index');

     Route::get('/delete_client_message/{Message}/{menuid}', 'MessageController@destory_message_client')->name('client_message.destory');

     Route::get('/add_client_message/{menuid}', 'MessageController@create_message')->name('client_message.create');

     Route::post('/store_client_message', 'MessageController@store_message')->name('client_message.store');

     Route::get('/view_client_message/{Message}/{menuid}', 'MessageController@view_message')->name('client_message.view');

     Route::post('/get_areas', 'HomeController@get_areas')->name('get_areas');

     Route::get('/receiving_permissions/{id}', 'receiving_permissionController@index')->name('receiving_permission.index');
     Route::get('/addreceiving_permission/{menuid}', 'receiving_permissionController@add')->name('receiving_permission.add');
     Route::post('/storereceiving_permission', 'receiving_permissionController@store')->name('receiving_permission.store');
     Route::get('/updatereceiving_permission/{receiving_permission}/{menuid}', 'receiving_permissionController@update')->name('receiving_permission.edit');
     Route::get('/deletereceiving_permission/{receiving_permission}/{menuid}', 'receiving_permissionController@destory')->name('receiving_permission.destory');
     Route::post('/editreceiving_permission', 'receiving_permissionController@edit')->name('receiving_permission.update');
     Route::post('/receiving_permissions/{id}', 'receiving_permissionController@search')->name('receiving_permission.search');
     Route::get('/giving_permissions/{id}', 'giving_permissionController@index')->name('giving_permission.index');
     Route::get('/addgiving_permission/{menuid}', 'giving_permissionController@add')->name('giving_permission.add');
     Route::post('/storegiving_permission', 'giving_permissionController@store')->name('giving_permission.store');
     Route::get('/updategiving_permission/{giving_permission}/{menuid}', 'giving_permissionController@update')->name('giving_permission.edit');
     Route::get('/deletegiving_permission/{giving_permission}/{menuid}', 'giving_permissionController@destory')->name('giving_permission.destory');
     Route::post('/editgiving_permission', 'giving_permissionController@edit')->name('giving_permission.update');
     Route::post('/giving_permissions/{id}', 'giving_permissionController@search')->name('giving_permission.search');
     Route::post('/get_operations', 'receiving_permissionController@get_operations')->name('get_operations');
     Route::post('/get_operations_duduct', 'giving_permissionController@get_operations_duduct')->name('get_operations_duduct');


});    Route::get('/var_assets/{id}', 'VarAssetsController@index')->name('var_assets.index');
Route::get('/add_var_assets/{menuid}', 'VarAssetsController@add')->name('var_assets.add');
Route::get('/add_var_assets_transfer/{var_asset_id}/{menuid}', 'VarAssetsController@addtransfer')->name('var_assets.addtransfer');
Route::post('/transfer_var_assets', 'VarAssetsController@transfer')->name('var_assets.transfer');

Route::get('/add_var_assets_bank/{menuid}', 'VarAssetsController@addbank')->name('var_assets.addbank');

Route::post('/store_var_assets', 'VarAssetsController@store')->name('var_assets.store');
Route::post('/store_var_assetsbank', 'VarAssetsController@storebank')->name('var_assets.storebank');

Route::get('/update_var_assets/{Asset}/{menuid}', 'VarAssetsController@update')->name('var_assets.edit');
Route::get('/delete_var_assets/{Asset}/{menuid}', 'VarAssetsController@destory')->name('var_assets.destory');
Route::post('/edit_var_assets', 'VarAssetsController@edit')->name('var_assets.update');
Route::post('/var_assets/{id}', 'VarAssetsController@search')->name('var_assets.search');
Route::get('/var_assets/show/{id}/{menuid}', 'VarAssetsController@show')->name('var_assets.show');


Route::get("locale/{locale}", function ($locale) {
     Session::put("locale", $locale);
     return redirect()->back();
});