use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SinhVienController;

Route::get('/students', [SinhVienController::class, 'index'])->name('students.index');
Route::get('/students/create', [SinhVienController::class, 'create'])->name('students.create');
Route::post('/students/store', [SinhVienController::class, 'store'])->name('students.store');
Route::get('/students/search', [SinhVienController::class, 'search'])->name('students.search');
