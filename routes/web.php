<?php

use App\Http\Controllers\AdvanceSalaryController;
use App\Http\Controllers\AllowanceController;
use App\Http\Controllers\AllowanceTypeController;
use App\Http\Controllers\AttendanceCheckerController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\AttendancePayDeductionController;
use App\Http\Controllers\BonusController;
use App\Http\Controllers\BranchController;
use App\Http\Controllers\CashAdvanceController;
use App\Http\Controllers\CurrencyController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DeductionController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\EmployeeScheduleController;
use App\Http\Controllers\HolidayController;
use App\Http\Controllers\JobNatureController;
use App\Http\Controllers\JobNatureTypeController;
use App\Http\Controllers\LoanController;
use App\Http\Controllers\MailSettingController;
use App\Http\Controllers\OvertimeController;
use App\Http\Controllers\OvertimePayController;
use App\Http\Controllers\PositionController;
use App\Http\Controllers\PositionLevelController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReportController;

use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\TaxDeductionController;
use App\Http\Controllers\UserListController;
use App\Http\Controllers\ZkTecoController;
use App\Models\CashAdvance;
use App\Models\Currency;
use App\Models\Deduction;
use App\Models\JobNatureType;
use Illuminate\Support\Facades\Route;





Route::get('/', function () {
    return redirect()->route('dashboard');
});

Route::middleware('auth')->group(function () {

    Route::controller(DashboardController::class)->group(function () {
        Route::get('/dashboard', 'index')->name('dashboard');
        Route::get("/zk-check", "deviceCheck");
    });

    Route::resource('department', DepartmentController::class)->except("show");
    Route::post("department/deletebyselection", [DepartmentController::class, 'deletebyselection']);

    Route::resource('employee', EmployeeController::class);
    Route::post("employee/deletebyselection", [EmployeeController::class, 'deletebyselection']);



    Route::resource('schedule', ScheduleController::class)->except("show");
    Route::post("schedule/deletebyselection", [ScheduleController::class, 'deletebyselection']);




    Route::resource("employeeschedule", EmployeeScheduleController::class)->except(["show", "destroy", "create", "store"]);



    Route::controller(ProfileController::class)->group(function () {
        Route::get("user-profile/{id}", "userProfile")->name("user.profile");
        Route::patch("user-profile/{id}", "userProfileUpdate")->name("user.profile.update");
        Route::patch("user-password/{id}", "userPasswordUpdate")->name("user.password.update");
    });



    Route::resource('attendance', AttendanceController::class)->except(["show"]);
    Route::post("attendance/deletebyselection", [AttendanceController::class, 'deletebyselection']);



    // Branch Routes
    Route::resource("/branch", BranchController::class);
    Route::post("/branch/deletebyselection", [BranchController::class, "deleteBySelection"]);
    // Branch Routes


    // JobNature Routes
    Route::resource('/jobnature', JobNatureController::class)->except("show");
    Route::post("jobnature/deletebyselection", [JobNatureController::class, 'deletebyselection']);
    // JobNature Routes


    // JobNature Types Routes
    Route::resource("/jobnature-type", JobNatureTypeController::class)->except(["show"]);
    Route::post("jobnature-type/deletebyselection", [JobNatureTypeController::class, 'deletebyselection']);
    // JobNature Types Routes


    // Position Routes
    Route::resource("/position", PositionController::class)->except(["show"]);
    Route::post("/position/deletebyselection", [PositionController::class, 'deletebyselection']);
    // Position Routes


    // Position Level Routes
    Route::resource('/position-level', PositionLevelController::class)->except(["show"]);
    Route::post("/position-level/deletebyselection", [PositionLevelController::class, "deletebyselection"]);
    // Position Level Routes

    // Allowance Routes
    Route::resource("/allowance", AllowanceController::class)->except(["show"]);
    Route::post("/allowance/deletebyselection", [AllowanceController::class, 'deletebyselection']);
    Route::get("/allowance/eligibilityData/{eligibility}", [AllowanceController::class, "alowanceEligbilityData"]);
    // Allowance Routes

    // Allowance Type Routes
    Route::resource('/allowance-type', AllowanceTypeController::class)->except(["show"]);
    Route::post("/allowance-type/deletebyselection", [AllowanceTypeController::class, 'deletebyselection']);
    // Allowance Type Routes


    // Currency Routes
    Route::resource("/currency", CurrencyController::class)->except(["show"]);
    Route::post("/currency/deletebyselection", [CurrencyController::class, 'deletebyselection']);
    // Currency Routes


    // bounus Routes
    Route::resource("/bonus", BonusController::class)->except(["show"]);
    Route::post("/bonus/deletebyselection", [BonusController::class, 'deletebyselection']);
    // Bonus Routes


    // Loan Routes
    Route::resource("/loan", LoanController::class)->except(["show"]);
    Route::post("/loan/deletebyselection", [LoanController::class, 'deletebyselection']);
    // Loan Routes


    // Deduction Routes
    Route::resource("/deduction", DeductionController::class)->except(["show"]);
    Route::post("/deduction/deletebyselection", [DeductionController::class, 'deletebyselection']);
    // Deduction Routes


    // Tax Deduction Routes
    Route::resource("/tax-deduction", TaxDeductionController::class)->except(["show"]);
    Route::post("/tax-deduction/deletebyselection", [TaxDeductionController::class, 'deletebyselection']);
    // Tax Deduction Routes


    // CashAdvance Routes
    Route::resource("/cash-advance", CashAdvanceController::class)->except(["show"]);
    Route::post("/cash-advance/deletebyselection", [CashAdvanceController::class, 'deletebyselection']);
    // CashAdvance Routes


    // Advance Salary Routes
    Route::resource("/advance-salary", AdvanceSalaryController::class)->except(["show"]);
    Route::post("/advance-salary/deletebyselection", [AdvanceSalaryController::class, 'deletebyselection']);
    // Advance Salary Routes



    // Holiday Routes Start
    Route::resource("/holiday", HolidayController::class)->except(["show"]);
    Route::post("/holiday/deletebyselection", [HolidayController::class, "deletebyselection"]);
    // Holiday Routes Start



    // OvertimePay Route Start
    Route::controller(OvertimePayController::class)->group(function () {
        Route::get("/overtime-pay", "index")->name("overtimepay.index");
        Route::post("/overtime-pay", "storeOrUpdate")->name("overtimepay.storeOrUpdate");
    });
    // OvertimePay Route Start


    // Attendance Pay Deduction Routes
    Route::controller(AttendancePayDeductionController::class)->group(function () {
        Route::get("/attendance-pay-deduction", "index")->name("attendancepaydeduction.index");
        Route::post("/attendance-pay-deduction", "storeOrUpdate")->name("attendancepaydeduction.storeOrUpdate");
    });
    // Attendance Pay Deduction Routes



    // Overtime Routes Start
    Route::resource("/overtime", OvertimeController::class)->except(["show"]);
    Route::post("/overtime/deletebyselection", [OvertimeController::class, "deletebyselection"]);
    // Overtime Routes Start

    Route::controller(ZkTecoController::class)->group(function () {
        Route::get("zkteco-device/index", "index")->name("zkteco_device.index");
        Route::get("zkteco-device/create", "create")->name("zkteco_device.create");
        Route::post("zkteco-device/store", "store")->name("zkteco_device.store");
        Route::get("zkteco-device/{id}", "edit")->name("zkteco_device.edit");
        Route::patch("zkteco-device/{id}", "update")->name("zkteco_device.update");
        Route::delete("zkteco-device/{id}", "destroy")->name("zkteco_device.destroy");
        Route::post("device/deletebyselection", "deleteBySelection");
    });


    Route::resource("user-list", UserListController::class)->except(["show"]);
    Route::post("user-list/deletebyselection", [UserListController::class, 'deletebyselection']);


    Route::controller(SettingController::class)->group(function () {
        Route::get("setting", "index")->name("setting.index");
        Route::post("setting/store", "store")->name("setting.store");
        Route::get("setting/roles", 'roles')->name("setting.roles");
        Route::get("setting/roles/create", 'roleCreate')->name("setting.role.create");
        Route::post("setting/roles/store", 'roleStore')->name("setting.role.store");
        Route::delete("setting/roles/destroy/{id}", 'roleDestroy')->name("setting.role.destroy");
        Route::post("setting/role/deletebyselection", 'deletebyselection');

        Route::get("setting/permissions/{id}", 'permissions')->name("setting.permission.view");
        Route::get("setting/permission/create", 'permissionCreate')->name("setting.permission.create");
        Route::post("setting/permission/store", 'permissionStore')->name("setting.permission.store");
        Route::post("setting/permission/assign", 'permissionAssign')->name("setting.permission.assign");
    });




    Route::resource('/mail-setting', MailSettingController::class)->except(['show', 'edit', 'create', 'update', 'destroy']);

    Route::controller(ReportController::class)->group(function () {

        Route::get("attendance/report", "attendance_report")->name("attendance.report");
    });
});

require __DIR__ . '/auth.php';
