<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AgentController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\ColorController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\EmailController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\QRCodeController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\SMTPController;
use App\Http\Controllers\UserTimeController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::middleware(['auth', 'role:admin'])->group(function() {
    Route::get('admin/dashboard', [AdminController::class, 'AdminDashboard'])->name('admin.dashboard');
    Route::get('admin/logout',    [AdminController::class, 'AdminLogout'])->name('admin.logout');
    Route::get('admin/profile',[AdminController::class, 'admin_profile']);
    Route::get('admin/profile/change-pass',[AdminController::class, 'admin_profile_edit_pass']);
    Route::post('admin/profile/change-pass/{id}',[AdminController::class, 'admin_profile_edit_pass_id']);
    Route::post('admin_profile/update',[AdminController::class, 'admin_profile_update']);
    Route::get('admin/users',[AdminController::class, 'admin_users_list']);
    Route::get('admin/users/view/{id}',[AdminController::class, 'view'])->name('admin.view');
    Route::get('admin/users/add',[AdminController::class, 'admin_add_users']);
    Route::post('admin/users/add',[AdminController::class, 'admin_add_users_store']);
    Route::get('admin/users/edit/{id}',[AdminController::class, 'admin_add_users_edit']);
    Route::post('admin/users/edit/{id}',[AdminController::class, 'admin_add_users_edit_id_update']);
    Route::get('admin/users/delete/{id}',[AdminController::class, 'admin_delete_soft']);
    Route::post('checkemail',[AdminController::class, 'checkemail']);

    Route::get('admin/email/compose', [EmailController::class, 'email_compose']);
    Route::post('admin/email/compose_post', [EmailController::class, 'email_compose_post']);
    Route::get('admin/email/sent', [EmailController::class, 'email_sent']);
    Route::get('admin/email_sent', [EmailController::class, 'delete_email_sent']);
    Route::get('admin/email/read/{id}', [EmailController::class, 'read_email']);

    // User week start
    Route::get('admin/week',[UserTimeController::class, 'week_list']);
    Route::get('admin/week/add',[UserTimeController::class, 'week_add']);
    Route::post('admin/week/add',[UserTimeController::class, 'week_store']);
    Route::get('admin/week/edit/{id}',[UserTimeController::class, 'week_edit']);
    Route::post('admin/week/edit/{id}',[UserTimeController::class, 'week_update_id']);
    Route::get('admin/week/delete/{id}',[UserTimeController::class, 'week_delete_id']);
    // User week end

    //Week time start
    Route::get('admin/week_time',[UserTimeController::class, 'week_time_list']);
    Route::get('admin/week/add-time',[UserTimeController::class, 'week_add_time']);
    Route::post('admin/week/add-time',[UserTimeController::class, 'week_add_time_store']);
    Route::get('admin/week_time/edit/{id}',[UserTimeController::class, 'week_time_edit']);
    Route::post('admin/week_time/edit/{id}',[UserTimeController::class, 'week_time_update_id']);
    Route::get('admin/week_time/delete/{id}',[UserTimeController::class, 'week_time_delete_id']);
    //Week time end

    // Schedule Start
    Route::get('admin/schedule', [ScheduleController::class, 'admin_schedule_list']);
    Route::post('admin/schedule', [ScheduleController::class, 'admin_schedule_update']);
    // Schedule End

    // Push Notification start
    Route::get('admin/notification', [NotificationController::class, 'notification_index']);
    Route::post('admin/notification_send', [NotificationController::class, 'notification_send']);
    // Push Notification end

    // QRCODE Start
    Route::get('admin/qrcode', [QRCodeController::class, 'list']);
    Route::get('admin/qrcode/add', [QRCodeController::class, 'add_qrcode']);
    Route::post('admin/qrcode/add', [QRCodeController::class, 'store_qrcode']);
    Route::get('admin/qrcode/edit/{id}', [QRCodeController::class, 'edit_qrcode']);
    Route::post('admin/qrcode/edit/{id}', [QRCodeController::class, 'update_qrcode']);
    Route::get('admin/qrcode/delete/{id}',[QRCodeController::class, 'delete_qrcode']);
    // QRCODE End

    // SMTP Start
    Route::get('admin/smtp', [SMTPController::class, 'stmp_list']);
    Route::post('admin/smtp_update', [SMTPController::class, 'smtp_update']);
    // SMTP End

    // Color Start
    Route::get('admin/color', [ColorController::class, 'color_list']);
    Route::get('admin/color/add', [ColorController::class, 'add_color']);
    Route::post('admin/color/add', [ColorController::class, 'insert_color']);
    Route::get('admin/color/edit/{id}', [ColorController::class, 'edit_color']);
    Route::post('admin/color/edit/{id}', [ColorController::class, 'update_color']);
    Route::get('admin/color/delete/{id}', [ColorController::class, 'delete_color']);
    // Color End

    // Order Start
    Route::get('admin/order', [OrderController::class, 'order_list']);
    Route::get('admin/order/add', [OrderController::class, 'order_add']);
    Route::post('admin/order/add', [OrderController::class, 'order_insert']);
    Route::get('admin/order/edit/{id}', [OrderController::class, 'order_edit']);
    Route::post('admin/order/edit/{id}', [OrderController::class, 'order_update']);
    Route::get('admin/order/delete/{id}', [OrderController::class, 'order_delete']);
    // Order End

    //Blog Start
    Route::get('admin/blog', [BlogController::class, 'blog_list']);
    Route::get('admin/blog/add', [BlogController::class, 'blog_add']);
    Route::post('admin/blog/add', [BlogController::class, 'blog_store']);
    Route::get('admin/blog/edit/{id}', [BlogController::class, 'blog_edit']);
    Route::get('admin/blog/view/{id}', [BlogController::class, 'blog_view']);
    Route::post('admin/blog/edit/{id}', [BlogController::class, 'blog_update']);
    Route::get('admin/blog/delete/{id}', [BlogController::class, 'blog_delete']);
    //Blog ENd

    // Pdf start
    Route::get('admin/pdf_demo', [ColorController::class, 'color_pdf_demo']);
    Route::get('admin/pdf_color', [ColorController::class, 'color_pdf_color']);
    // Pdf end

    //Country Start
    Route::get('admin/countries', [LocationController::class, 'country_list']);
    Route::get('admin/countries/add', [LocationController::class, 'country_add']);
    Route::post('admin/countries/add', [LocationController::class, 'country_store']);
    Route::get('admin/countries/edit/{id}', [LocationController::class, 'country_edit']);
    Route::post('admin/countries/edit/{id}', [LocationController::class, 'country_update']);
    Route::get('admin/countries/delete/{id}', [LocationController::class, 'country_delete']);

    Route::get('admin/state', [LocationController::class, 'state_list']);
    Route::get('admin/state/add', [LocationController::class, 'state_add']);
    Route::post('admin/state/add', [LocationController::class, 'state_store']);
    Route::get('admin/state/edit/{id}', [LocationController::class, 'state_edit']);
    Route::post('admin/state/edit/{id}', [LocationController::class, 'state_update']);
    Route::get('admin/state/delete/{id}', [LocationController::class, 'state_delete']);

    Route::get('admin/city', [LocationController::class, 'city_list']);
    Route::get('admin/city/add', [LocationController::class, 'city_add']);
    Route::get('get-states-record/{countryId}', [LocationController::class, 'get_state_name']);
    Route::post('admin/city/add', [LocationController::class, 'city_store']);
    Route::get('admin/city/edit/{id}', [LocationController::class, 'city_edit']);
    Route::post('admin/city/edit/{id}', [LocationController::class, 'city_update']);
    Route::get('admin/city/delete/{id}', [LocationController::class, 'city_delete']);

    Route::get('admin/address', [LocationController::class, 'address_list']);
    Route::get('admin/address/add', [LocationController::class, 'address_add']);
    Route::get('get-states/{countryId}', [LocationController::class, 'get_states']);
    Route::get('get-cities/{stateId}', [LocationController::class, 'get_cities']);
    //Country End

});

Route::middleware(['auth', 'role:agent'])->group(function() {
    Route::get('agent/dashboard', [AgentController::class, 'AgentDashboard'])->name('agent.dashboard');

    Route::get('agent/logout',    [AgentController::class, 'AgentLogout'])->name('agent.logout');
    Route::get('agent/email/inbox',    [AgentController::class, 'agentEmailInbox']);
});

Route::get('set_new_password/{token}', [AdminController::class, 'set_new_password']);
Route::post('set_new_password/{token}', [AdminController::class, 'set_new_password_post']);
Route::get('admin/login', [AdminController::class, 'AdminLogin'])->name('admin.login');
