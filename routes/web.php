use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;


<?phP

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

//Route cho User
Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [UserController::class, 'index'])->name('dashboard');
    // Các route khác cho User
});

//Route cho Admin
Route::middleware(['auth', 'admin'])->group(function () {
    Route::get('/admin/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    // Các route khác cho Admin
});
