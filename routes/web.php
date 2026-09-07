<?php
use App\Http\Controllers\ProgramController;
use App\Http\Controllers\FacultyController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\Auth\TeacherLoginController;
use App\Http\Controllers\TeacherRegisterController;
use App\Http\Controllers\TeacherDashboardController;
use App\Http\Controllers\SubjectTeacherController;

use App\Http\Controllers\StudentRegisterController;
use App\Http\Controllers\StudentLoginController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\StudentDashboardController;
use App\Models\Faculty;
use App\Models\Program;
use App\Models\Student;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    //return view('welcome');
    return ('Hello World');
});

Route::get('about', function () {

return view('aboutus');

});

Route::get('details/students', function () {

return 'This is a student';

});

Route::get('details/teachers', function () {

return 'This is a teacher';

});

//Route::get('students',[StudentController::class,
//'index']);

Route::get('program',function(){
    return Program::all();
});

Route::get('faculty',function(){
    return Faculty::all();
});

Route::get('students',function(){
    return Students::all();
});

Route::get('faculties',[FacultyController::class,
'index']);

Route::prefix('faculties')->controller(FacultyController::class)->group(function () {
    Route::get('/', 'index');
    Route::view('add', 'faculties.add');
    Route::post('create', 'createFaculty');
    Route::get('edit/{id}', 'editFaculty');
    Route::post('update/{id}', 'updateFaculty');
    Route::post('delete/{id}', 'deleteFaculty');
    // Route::post('getFaculty/{id}', 'getFaculty');
});

Route::get('programs',[ProgramController::class,
'index']);

Route::prefix('programs')->controller(ProgramController::class)->group(function () {
    Route::get('/', 'index');
    Route::get('add', 'add');
    Route::post('create', 'createProgram');
    Route::get('edit/{id}', 'editProgram');
    Route::post('update/{id}', 'updateProgram');
    Route::post('delete/{id}', 'deleteProgram');
    // Route::post('getFaculty/{id}', 'getFaculty');
});

Route::get('/programs/by-faculty/{faculty_id}', [ProgramController::class, 'getByFaculty'])
    ->name('programs.byFaculty');


Route::prefix('students')->controller(StudentController::class)->group(function () {
    Route::get('/', 'index');
    // Route::view('add', 'students.add');
    Route::get('add', 'add');
    Route::post('create', 'createStudent');
    Route::get('edit/{id}', 'edit');
    Route::post('update/{id}', 'update');
    Route::post('delete/{id}', 'deleteStudent');
});

// ---------- รายวิชา (Subjects) ----------
Route::prefix('subjects')->controller(SubjectController::class)->group(function () {
    Route::get('/', 'index');
    Route::get('add', 'add');
    Route::post('store', 'store');
    Route::get('edit/{id}', 'edit');
    Route::post('update/{id}', 'update');

    // รองรับการลบทั้งแบบ GET และ POST
    Route::get('destroy/{id}', 'destroy');
    Route::post('destroy/{id}', 'destroy');
});



Route::get('/register',
    [StudentRegisterController::class, 'showRegisterForm']
)->name('student.register.form');

Route::post('/register',
    [StudentRegisterController::class, 'register']
)->name('student.register');


Route::get('/student/login',
    [StudentLoginController::class, 'showLoginForm']
)->name('student.login.form');

Route::post('/student/login',
    [StudentLoginController::class, 'login']
)->name('student.login');



Route::get('/',
    [HomeController::class, 'index']
)->name('home');


Route::middleware('student')->group(function () {

    Route::get(
        '/student/dashboard',
        [StudentDashboardController::class, 'index']
    )->name('student.dashboard');

    Route::post(
        '/logout',
        [StudentLoginController::class, 'logout']
    )->name('student.logout');

});



Route::prefix('teachers')->controller(TeacherController::class)->group(function () {
    Route::get('/', 'index');
    Route::get('add', 'add');
    Route::post('store', 'store');
    Route::get('edit/{id}', 'edit');
    Route::post('update/{id}', 'update');
    Route::post('delete/{id}', 'destroy');
    // Route::post('getSubject/{id}', 'getSubject');
});


// --- Teacher Login ---
Route::get('/teacher/login', [TeacherLoginController::class, 'showLoginForm'])->name('teacher.login');
Route::post('/teacher/login', [TeacherLoginController::class, 'login'])->name('teacher.login.submit');
Route::get('/teacher/logout', [TeacherLoginController::class, 'logout'])->name('teacher.logout');


// --- ส่วนจัดการข้อมูล: เข้าได้ทั้ง admin จริง และอาจารย์ที่เป็น admin
Route::middleware('is.admin')->group(function () {

Route::get('/teacher/register',[TeacherRegisterController::class, 'showRegisterForm'])->name('teacher.register.form');

Route::post('/teacher/register',[TeacherRegisterController::class, 'register'])->name('teacher.register');

    // Teacher CRUD (ใช้ add() แทน create() ตามที่ Controller เขียนไว้)
    Route::get('/teachers', [TeacherController::class, 'index'])->name('teachers.index');
    Route::get('/teachers/add', [TeacherController::class, 'add'])->name('teachers.add');
    Route::post('/teachers/store', [TeacherController::class, 'store'])->name('teachers.store');
    Route::get('/teachers/{teacher}', [TeacherController::class, 'show'])->name('teachers.show');
    Route::get('/teachers/{teacher}/edit', [TeacherController::class, 'edit'])->name('teachers.edit');
    Route::put('/teachers/{teacher}', [TeacherController::class, 'update'])->name('teachers.update');
    Route::delete('/teachers/{teacher}', [TeacherController::class, 'destroy'])->name('teachers.destroy');

    // Student CRUD
    Route::resource('students', StudentController::class);

    // Subject CRUD
    Route::resource('subjects', SubjectController::class);
    Route::resource('subject-teachers', SubjectTeacherController::class);
    Route::resource('programs', ProgramController::class);
    Route::resource('faculties', FacultyController::class);
});

