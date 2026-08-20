<?php

use App\Http\Controllers\Admin\AdminAuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\EducationController;
use App\Http\Controllers\Admin\ExperienceController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\ProjectController;
use App\Http\Controllers\Admin\SkillController;
use App\Http\Controllers\Admin\SocialLinkController;
use App\Http\Controllers\PortfolioController;
use Illuminate\Support\Facades\Route;

// Public portfolio
Route::get('/', [PortfolioController::class, 'index']);
Route::get('robots.txt', [PortfolioController::class, 'robots']);
Route::get('sitemap.xml', [PortfolioController::class, 'sitemap']);
Route::get('cv', [PortfolioController::class, 'downloadCv'])->name('cv.download');

// Admin auth (guest-ish — redirect to dashboard if already admin)
Route::prefix('admin')->group(function () {
    Route::get('login', [AdminAuthController::class, 'showLogin'])->name('admin.login');
    Route::post('login', [AdminAuthController::class, 'login'])->name('admin.login.submit');
    Route::post('logout', [AdminAuthController::class, 'logout'])->name('admin.logout');
});

// Protected admin area
Route::middleware('admin')->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');

    Route::resource('experiences', ExperienceController::class)->except(['show']);
    Route::resource('projects', ProjectController::class)->except(['show']);
    Route::resource('skills', SkillController::class)->except(['show']);
    Route::resource('educations', EducationController::class)->except(['show']);
    Route::resource('social-links', SocialLinkController::class)->except(['show']);
});