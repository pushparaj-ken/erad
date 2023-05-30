<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	http://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There area two reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router what URI segments to use if those provided
| in the URL cannot be matched to a valid route.
|
*/

$route['default_controller'] = "Frontend";
$route['404_override'] = 'frontend/pageNotFound';

/*********** GENERAL ROUTES *******************/

$route['admin'] = 'admin/login/loginMe';
$route['admin/login'] = 'admin/login/loginMe';
$route['admin/loginMe'] = 'admin/login/loginMe';
$route['admin/dashboard'] = 'admin/common_controller/index';
$route['admin/logout'] = 'admin/user/logout';
$route['admin/userListing'] = 'admin/user/userListing';
$route['admin/userListing/(:num)'] = "admin/user/userListing/$1";
$route['admin/addNew'] = "admin/user/addNew";
$route['admin/generate_report_template'] = "admin/common_controller/generate_report_template";


$route['admin/addNewUser'] = "admin/user/addNewUser";
$route['admin/editOld'] = "admin/user/editOld";
$route['admin/editOld/(:num)'] = "admin/user/editOld/$1";
$route['admin/editUser'] = "admin/user/editUser";
$route['admin/deleteUser'] = "admin/user/deleteUser";
$route['admin/loadChangePass'] = "admin/user/loadChangePass";
$route['admin/changePassword'] = "admin/user/changePassword";
$route['admin/pageNotFound'] = "admin/user/pageNotFound";
$route['admin/checkEmailExists'] = "admin/user/checkEmailExists";
$route['admin/forgotPassword'] = "admin/login/forgotPassword";
$route['admin/resetPasswordUser'] = "admin/login/resetPasswordUser";
$route['admin/resetPasswordConfirmUser'] = "admin/login/resetPasswordConfirmUser";
$route['admin/resetPasswordConfirmUser/(:any)'] = "admin/login/resetPasswordConfirmUser/$1";
$route['admin/resetPasswordConfirmUser/(:any)/(:any)'] = "admin/login/resetPasswordConfirmUser/$1/$2";
$route['admin/createPasswordUser'] = "admin/login/createPasswordUser";


/*********** RAD ADMIN AND SUPER ADMIN ROUTES ***********/

$route['admin/category'] = "admin/common_controller/category";
$route['admin/sub-category'] = "admin/common_controller/sub_category";
$route['admin/child-category'] = "admin/common_controller/child_category";
$route['admin/form-fields'] = "admin/common_controller/form_fields";
$route['admin/condition-master'] = "admin/common_controller/condition_master";
$route['admin/condition-option-master'] = "admin/common_controller/condition_option_master";
$route['admin/get-condition/(:any)'] = "admin/common_controller/get_condition/$1";
$route['admin/answer-report-master'] = "admin/common_controller/answer_report_master";
$route['admin/add-select-options/(:any)/(:any)'] = "admin/common_controller/add_select_options/$1/$2";
$route['admin/add-checkbox-options/(:any)/(:any)'] = "admin/common_controller/add_checkbox_options/$1/$2";
$route['admin/add-radio-options/(:any)/(:any)'] = "admin/common_controller/add_radio_options/$1/$2";
$route['admin/add-segment-options/(:any)'] = "admin/common_controller/add_segment_options/$1";
$route['admin/form-templates'] = "admin/common_controller/templates_form";
$route['admin/admin-form-template/(:any)'] = "admin/common_controller/admin_form_template/$1";
$route['admin/view-form-template/(:any)'] = 'admin/common_controller/view_form_template/$1';
$route['admin/get-value/(:any)'] = 'admin/common_controller/get_value/$1';
$route['admin/get-generator/(:any)'] = 'admin/common_controller/get_generator/$1';
$route['admin/get-segment/(:any)'] = 'admin/common_controller/get_segment/$1';
$route['admin/hide-show-section/(:any)/(:any)'] = 'admin/common_controller/hide_show_section/$1/$2';
$route['admin/finding-option/(:any)/(:any)'] = 'admin/common_controller/finding_option/$1/$2';
$route['admin/select-finding-option/(:any)/(:any)'] = 'admin/common_controller/select_finding_option/$1/$2';
$route['admin/add-collapse/(:any)/(:any)'] = 'admin/common_controller/add_collapse/$1/$2';
$route['admin/segment-section/(:any)/(:any)'] = 'admin/common_controller/segment_section/$1/$2';
$route['admin/select-options/(:any)'] = "admin/common_controller/select_options/$1";


$route['admin/admin-assign-form-template/(:any)'] = "admin/common_controller/admin_assign_form_template/$1";

$route['admin/insert'] = "admin/common_controller/insert";
$route['admin/update'] = "admin/common_controller/update";
$route['admin/update_data_post'] = "admin/common_controller/update_data_post";
$route['admin/insert_data_option'] = "admin/common_controller/insert_data_option";
$route['admin/insert_data_super_admin'] = "admin/common_controller/insert_data_super_admin";
$route['admin/update_data_option'] = "admin/common_controller/update_data_option";
$route['admin/update_data_post_template_field'] = "admin/common_controller/update_data_post_template_field";
$route['admin/update_data_admin_option'] = "admin/common_controller/update_data_admin_option";
$route['admin/update_data_option_scribe'] = "admin/common_controller/update_data_option_scribe";
$route['admin/update_data_scribe'] = "admin/common_controller/update_data_scribe";
$route['admin/insert_data_scribe_main'] = "admin/common_controller/insert_data_scribe_main";
$route['admin/insert_data_scribe_option'] = "admin/common_controller/insert_data_scribe_option";
$route['admin/update_data_scribe_main'] = "admin/common_controller/update_data_scribe_main";

$route['admin/insert_hide_items'] = "admin/common_controller/insert_hide_items";
$route['admin/update_hide_items'] = "admin/common_controller/update_hide_items";
$route['admin/insert_collapse_items'] = "admin/common_controller/insert_collapse_items";
$route['admin/update_collapse_items'] = "admin/common_controller/update_collapse_items";
$route['admin/edit_collapse'] = "admin/common_controller/edit_collapse";

$route['admin/insert_segment_items'] = "admin/common_controller/insert_segment_items";

$route['admin/insert_template'] = "admin/common_controller/insert_template";
$route['admin/get_answer_value'] = "admin/common_controller/get_answer_value";
$route['admin/copy-record'] = "admin/common_controller/copy_record";


$route['admin/group-master'] = "admin/common_controller/group_master";
$route['admin/main-title'] = "admin/common_controller/main_title";
$route['admin/form-templates-assign'] = "admin/common_controller/form_template_assign";
$route['admin/edit_assigned_template'] = "admin/common_controller/edit_assigned_template";

$route['admin/assigned-template-admin'] = "admin/common_controller/assigned_template_admin";
$route['admin/assigned-template-admin-scribe'] = "admin/common_controller/assigned_template_admin_scribe";
$route['admin/view-assigned-template-list/(:any)'] = "admin/common_controller/view_assigned_template_list/$1";

$route['admin/insert-template-data'] = "admin/common_controller/insert_template_data";

// $route['admin/reports'] = "admin/common_controller/reports";
$route['admin/answer-master'] = "admin/common_controller/answer_master";
$route['admin/post/get-title/(:any)'] = "admin/common_controller/get_title/$1";
$route['admin/post/get-condition-option/(:any)'] = "admin/common_controller/get_conditionoption/$1";
$route['admin/collapse_option/(:any)'] = "admin/common_controller/collapse_option/$1";


// ADMIN ROLE
$route['admin/form-for-me'] = "admin/common_controller/form_for_me";
$route['admin/template-for-me/(:any)'] = "admin/common_controller/template_for_me/$1";
$route['admin/admin-view-form-template/(:any)'] = "admin/common_controller/admin_view_form_template/$1";


$route['admin/scribe-change-template-report'] = "admin/common_controller/scribe_change_template_report";
$route['admin/search'] = "admin/common_controller/search_form";
$route['admin/condition-form'] = "admin/common_controller/condition_form";


$route['admin/change-template-request'] = "admin/common_controller/change_template_request";
$route['admin/scribe-change-template-request'] = "admin/common_controller/scribe_change_template_request";
$route['admin/view-template-change/(:any)'] = "admin/common_controller/view_template_changes/$1";
$route['admin/approve-change-template'] = "admin/common_controller/approve_change_template";
$route['admin/view-template-change-scribe/(:any)'] = "admin/common_controller/view_template_changes_scribe/$1";
$route['admin/approve-change-template-admin'] = "admin/common_controller/approve_change_template_admin";
$route['admin/approve-change-template-scribe'] = "admin/common_controller/approve_change_template_scribe";
$route['admin/get_record/(:any)/(:any)'] = "admin/common_controller/get_record/$1/$2";
$route['admin/delete_assign_template'] = "admin/common_controller/delete_assign_template";
$route['admin/instant-click-master'] = "admin/common_controller/instant_click_master";
$route['admin/copy-click'] = "admin/common_controller/copy_click";
$route['admin/insta-click-search'] = "admin/common_controller/insta_click_search";

$route['admin/document/(:any)'] = "admin/common_controller/document/$1"; 

$route['admin/add-collapse-main/(:any)/(:any)'] = 'admin/common_controller/add_collapse_main/$1/$2';
$route['admin/add-collapse-sub/(:any)/(:any)'] = 'admin/common_controller/add_collapse_sub/$1/$2';
$route['admin/edit_collapse_main'] = "admin/common_controller/edit_collapse_main";
$route['admin/edit_collapse_sub'] = "admin/common_controller/edit_collapse_sub";
$route['admin/insert_collapse_items_main'] = "admin/common_controller/insert_collapse_items_main";
$route['admin/update_collapse_items_main'] = "admin/common_controller/update_collapse_items_main";$route['admin/insert_collapse_items_sub'] = "admin/common_controller/insert_collapse_items_sub";
$route['admin/update_collapse_items_sub'] = "admin/common_controller/update_collapse_items_sub";
$route['admin/petct-template'] = "admin/common_controller/petct_template";
$route['admin/edit-petct-template'] = "admin/common_controller/edit_petct_template";

$route['admin/add-petct-select-options/(:any)/(:any)'] = "admin/common_controller/add_petct_select_options/$1/$2";  
$route['admin/gettitle'] = "admin/common_controller/gettitle";  

$route['admin/collapse-join'] = "admin/common_controller/collapse_join";  
$route['admin/collapse-main'] = "admin/common_controller/collapse_main";  
$route['admin/collapse-sub'] = "admin/common_controller/collapse_sub";  
$route['admin/collapse-child'] = "admin/common_controller/collapse_child";  
$route['admin/insert_data_collapse_main'] = "admin/common_controller/insert_data_collapse_main"; 
$route['admin/edit-collapse-join'] = "admin/common_controller/edit_collapse_join"; 

$route['admin/get_answer_search'] = "admin/common_controller/get_answer_search";
$route['admin/get_collapse_id'] = "admin/common_controller/get_collapse_id";
$route['admin/main-answer-heading'] = "admin/common_controller/main_answer_heading";
$route['admin/insert_main_answer_data'] = "admin/common_controller/insert_main_answer_data";
$route['admin/record'] = "admin/common_controller/record";

// Cron Jobs
$route['cron-job'] = "cron/cron_job";


// FRONTEND CONTROLLER //

$route['/'] = "frontend/index";
$route['index'] = "frontend/login";
$route['logout'] = 'frontend/logout';
$route['forms'] = 'frontend/forms';

