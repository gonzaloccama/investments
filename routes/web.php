<?php

use App\Http\Livewire\Admin\AdministratorComponent;
use App\Http\Livewire\Admin\AssistantComponent;
use App\Http\Livewire\Admin\BankComponent;
use App\Http\Livewire\Admin\BonusComponent;
use App\Http\Livewire\Admin\CurrencyComponent;
use App\Http\Livewire\Admin\DashboardComponent;
use App\Http\Livewire\Admin\InvestmentComponent;
use App\Http\Livewire\Admin\PaymentComponent;
use App\Http\Livewire\Admin\PlanComponent;
use App\Http\Livewire\Admin\TimeComponent;
use App\Http\Livewire\Admin\UpcomingPaymentComponent;
use App\Http\Livewire\Admin\UsersComponent;
use App\Http\Livewire\Reports\ContractComponent;
use App\Http\Middleware\UserActive;
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

Route::get('/clear', function () {
    $output = new \Symfony\Component\Console\Output\BufferedOutput();
    Artisan::call('optimize:clear', array(), $output);
    return $output->fetch();
})->name('/clear');

Route::get('/', function () {
    return redirect(\route('login'));
});

Auth::routes();
Route::get('/login', \App\Http\Livewire\Auth\LoginComponent::class)->name('login');
Route::get('/register', \App\Http\Livewire\Auth\RegisterComponent::class)->name('register');

Route::middleware([UserActive::class])->group(function () {
    /*** ADMINS ***/
    Route::middleware(['auth', 'isAdmin'])->group(function () {
//        Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
        Route::get('/admin/dashboard', DashboardComponent::class)->name('admin.dashboard');

        Route::get('/admin/users', UsersComponent::class)->name('admin.users');
        Route::get('/admin/administrators', AdministratorComponent::class)->name('admin.administrators');
        Route::get('/admin/assistants', AssistantComponent::class)->name('admin.assistants');

        Route::get('/admin/plans', PlanComponent::class)->name('admin.plans');
        Route::get('/admin/times', TimeComponent::class)->name('admin.times');

        Route::get('/admin/banks', BankComponent::class)->name('admin.banks');
        Route::get('/admin/currencies', CurrencyComponent::class)->name('admin.currencies');

        Route::get('/admin/investments', InvestmentComponent::class)->name('admin.investments');
        Route::get('/admin/payments', PaymentComponent::class)->name('admin.payments');
        Route::get('/admin/upcoming-payments', UpcomingPaymentComponent::class)->name('admin.upcoming-payments');
        Route::get('/admin/bonus',BonusComponent::class)->name('admin.bonus');

        //reports
        Route::get('contract-investments', [InvestmentComponent::class, 'printAgreement'])->name('contract.investments');
        Route::get('daily-report', [DashboardComponent::class, 'dailyReport'])->name('daily.report');
    });

    /***  USERS ***/
    Route::middleware(['auth'])->group(function () {
    });
});


