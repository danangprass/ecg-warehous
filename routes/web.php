<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductLinkController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\UserController;
use App\Livewire\EmployeeTransaction;
use App\Livewire\RolePermissionTable;
use App\Livewire\TransactionTable;
use App\Livewire\UserTable;

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

Route::get('/', [TransactionController::class, 'formRepair'])->middleware(['auth']);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// useless routes
// Just to demo sidebar dropdown links active states.
Route::get('/buttons/text', function () {
    return view('buttons-showcase.text');
})->middleware(['auth'])->name('buttons.text');

Route::get('/buttons/icon', function () {
    return view('buttons-showcase.icon');
})->middleware(['auth'])->name('buttons.icon');

Route::get('/buttons/text-icon', function () {
    return view('buttons-showcase.text-icon');
})->middleware(['auth'])->name('buttons.text-icon');

require __DIR__ . '/auth.php';


Route::get('/form-repair', [TransactionController::class, 'formRepair'])->middleware(['auth', 'verified', 'permission:form-repair'])->name('form-repair');
Route::post('/save-repair', [TransactionController::class, 'storeFormRepait'])->middleware(['auth', 'verified', 'permission:form-repair'])->name('save-repair');
Route::get('/form-add-stock', [TransactionController::class, 'formAddStock'])->middleware(['auth', 'verified', 'permission:stock-storage'])->name('form-add-stock');
Route::get('/form-add-stock-warehouse', [TransactionController::class, 'formAddStockWarehouse'])->middleware(['auth', 'verified', 'permission:warehouse-storage'])->name('form-add-stock-warehouse');
Route::get('/form-edit-stock-warehouse', [TransactionController::class, 'formEditStockWarehouse'])->middleware(['auth', 'verified', 'permission:warehouse-storage'])->name('form-edit-stock-warehouse');

Route::get('/form-modif', [TransactionController::class, 'formModif'])->middleware(['auth', 'verified', 'permission:form-modif'])->name('form-modif');
Route::post('/save-modif', [TransactionController::class, 'storeFormModif'])->middleware(['auth', 'verified', 'permission:form-modif'])->name('save-modif');
Route::get('/stock-storage', [ProductController::class, 'myIndex'])->middleware(['auth', 'verified', 'permission:stock-storage'])->name('stock-storage');
Route::post('/save-stock-storage', [ProductController::class, 'saveStockStorage'])->middleware(['auth', 'verified', 'permission:stock-storage'])->name('save-stock-storage');

Route::get('/warehouse-storage', [ProductController::class, 'index'])->middleware(['auth', 'verified', 'permission:warehouse-storage'])->name('warehouse-storage');
Route::post('/save-warehouse-storage', [ProductController::class, 'saveWarehouseStorage'])->middleware(['auth', 'verified', 'permission:warehouse-storage'])->name('save-warehouse-storage');
Route::put('/update-warehouse-storage', [ProductController::class, 'updateWarehouseStorage'])->middleware(['auth', 'verified', 'permission:warehouse-storage'])->name('update-warehouse-storage');

Route::get('/transaction', TransactionTable::class)->middleware(['auth', 'verified', 'permission:transaction'])->name('transaction');
// Route::get('/transaction', [TransactionController::class, 'index'])->middleware(['auth', 'verified', 'permission:transaction'])->name('transaction');

Route::get('/information', [UserController::class, 'information'])->middleware(['auth', 'verified', 'permission:information'])->name('information');

Route::get('/employee-list', UserTable::class)->middleware(['auth', 'verified', 'permission:employee-list'])->name('employee-list');
// Route::get('/employee-list', [UserController::class, 'index'])->middleware(['auth', 'verified', 'permission:employee-list'])->name('employee-list');
Route::get('/employee-create', [UserController::class, 'create'])->middleware(['auth', 'verified', 'permission:employee-list'])->name('employee-create');
Route::post('/employee-store', [UserController::class, 'store'])->middleware(['auth', 'verified', 'permission:employee-list'])->name('employee-store');
Route::get('/employee-edit/{user}', [UserController::class, 'edit'])->middleware(['auth', 'verified', 'permission:employee-list'])->name('employee-edit');
Route::get('/employee-stock/{user}', [UserController::class, 'stock'])->middleware(['auth', 'verified', 'permission:employee-list'])->name('employee-stock');
// Route::get('/employee-transaction/{user}', [UserController::class, 'transaction'])->middleware(['auth', 'verified', 'permission:employee-list'])->name('employee-transaction');
Route::get('/employee-transaction/{user}',EmployeeTransaction::class)->middleware(['auth', 'verified', 'permission:employee-list'])->name('employee-transaction');
Route::patch('/employee-update/{user}', [UserController::class, 'update'])->middleware(['auth', 'verified', 'permission:employee-list'])->name('employee-update');
Route::delete('/employee-delete/{user}', [UserController::class, 'destroy'])->middleware(['auth', 'verified', 'permission:employee-list'])->name('employee-delete');
Route::get('/employee-list-reimburse/{user}/{amount}', [TransactionController::class, 'reimburse'])->middleware(['auth', 'verified', 'permission:employee-list'])->name('employee-list-reimburse');
Route::get('/employee-list-bonus/{user}/{amount}', [TransactionController::class, 'fee'])->middleware(['auth', 'verified', 'permission:employee-list'])->name('employee-list-bonus');



Route::get('/role-list', RolePermissionTable::class)->middleware(['auth', 'verified', 'permission:role-list'])->name('role-list');
Route::get('/role-create', [RoleController::class, 'create'])->middleware(['auth', 'verified', 'permission:role-add'])->name('role-create');
Route::post('/role-store', [RoleController::class, 'store'])->middleware(['auth', 'verified', 'permission:role-add'])->name('role-store');
Route::get('/role-edit/{role}', [RoleController::class, 'edit'])->middleware(['auth', 'verified', 'permission:role-edit'])->name('role-edit');
Route::patch('/role-update/{role}', [RoleController::class, 'update'])->middleware(['auth', 'verified', 'permission:role-edit'])->name('role-update');