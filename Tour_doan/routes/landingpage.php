<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\LandingPage\PageController;
use App\Http\Controllers\LandingPage\ThemeController;
use App\Http\Controllers\LandingPage\LanguageController;
use App\Http\Controllers\LandingPage\CategoryNewController;
use App\Http\Controllers\LandingPage\TagController;
use App\Http\Controllers\LandingPage\NewController;
use App\Http\Controllers\LandingPage\SectionController;
use App\Http\Controllers\LandingPage\PageContentController;
use App\Http\Controllers\LandingPage\PictureController;
use App\Http\Controllers\LandingPageController;

Route::middleware(['auth', 'verified'])->group(
    function () {
        Route::group(
            ['prefix' => 'admin/pages'],
            function () {
                Route::get('', [PageController::class, 'index'])->name('pages');
                Route::post('', [PageController::class, 'store'])->name('pages.store');
                Route::put('/update/{id}', [PageController::class, 'update'])->name('pages.update');
                Route::delete('/delete/{id}', [PageController::class, 'delete'])->name('pages.delete');
                Route::post('priorityPage', [PageController::class, 'priorityPage'])->name('pages.priority');
            }
        );



        Route::group(['prefix' => 'admin/themes'], function () {
            Route::get('', [ThemeController::class, 'index'])->name('themes.index');
            Route::post('', [ThemeController::class, 'store'])->name('themes.store');
            Route::post('update/{id}', [ThemeController::class, 'update'])->name('themes.update');
            Route::delete('delete/{id}', [ThemeController::class, 'delete'])->name('themes.delete');
        });
        Route::group(['prefix' => 'admin/languages'], function () {
            Route::get('', [LanguageController::class, 'index'])->name('languages');
            Route::post('store', [LanguageController::class, 'store'])->name('languages.store');
            Route::put('update/{id}', [LanguageController::class, 'update'])->name('languages.update');
            Route::delete('delete/{id}', [LanguageController::class, 'delete'])->name('languages.delete');
        });

        Route::group(['prefix' => 'admin/blogs'], function () {

            Route::group(['prefix' => 'theloai'], function () {
                Route::get('', [CategoryNewController::class, 'index'])->name('theloai.index');
                Route::post('', [CategoryNewController::class, 'store'])->name('theloai.store');
                Route::put('update/{id}', [CategoryNewController::class, 'update'])->name('theloai.update');
                Route::delete('delete/{id}', [CategoryNewController::class, 'delete'])->name('theloai.delete');
            });
            Route::group(['prefix' => 'tags'], function () {
                Route::get('', [TagController::class, 'index'])->name('tag.index');
                Route::post('', [TagController::class, 'store'])->name('tag.store');
                Route::put('update/{id}', [TagController::class, 'update'])->name('tag.update');
                Route::delete('delete/{id}', [TagController::class, 'delete'])->name('tag.delete');
            });
            Route::group(['prefix' => 'tintuc'], function () {
                Route::get('', [NewController::class, 'index'])->name('tintuc.index');
                Route::get('create', [NewController::class, 'create'])->name('tintuc.create');
                Route::get('edit/{id}', [NewController::class, 'edit'])->name('tintuc.edit');
                Route::post('', [NewController::class, 'store'])->name('tintuc.store');
                Route::post('update/{id}', [NewController::class, 'update'])->name('tintuc.update');
                Route::delete('delete/{id}', [NewController::class, 'delete'])->name('tintuc.delete');
                Route::get('{slug}', [NewController::class, 'preview'])->name('tintuc.preview');
            });
        });
        Route::group(['prefix' => 'admin/pages'], function () {
            Route::get('', [PageController::class, 'index'])->name('pages');
            Route::post('', [PageController::class, 'store'])->name('pages.store');
            Route::put('/update/{id}', [PageController::class, 'update'])->name('pages.update');
            Route::delete('/delete/{id}', [PageController::class, 'delete'])->name('pages.delete');
            Route::post('priorityPage', [PageController::class, 'priorityPage'])->name('pages.priority');
            Route::group(['prefix' => '{id}/section'], function () {
                Route::get('', [SectionController::class, 'index'])->name('section.index');
                Route::get('create', [SectionController::class, 'create'])->name('section.create');
                Route::get('edit', [SectionController::class, 'edit'])->name('section.edit');
                Route::post('', [SectionController::class, 'store'])->name('section.store');
                Route::put('update', [SectionController::class, 'update'])->name('section.update');
                Route::delete('delete', [SectionController::class, 'delete'])->name('section.delete');
            });
            Route::group(['prefix' => 'section/{slug}/content'], function () {
                Route::get('', [PageContentController::class, 'index'])->name('content.index');
                Route::get('create', [PageContentController::class, 'createContent'])->name('content.create');
            });
            Route::group(['prefix' => 'section/{id}/content'], function () {
                Route::post('store', [PageContentController::class, 'store'])->name('content.store');
                Route::get('edit', [PageContentController::class, 'edit'])->name('content.edit');
                Route::post('update', [PageContentController::class, 'update'])->name('content.update');
                Route::delete('delete', [PageContentController::class, 'delete'])->name('content.delete');
                Route::post('category_store', [PageContentController::class, 'category_store'])->name('content.category_store');
                Route::get('/images', [PictureController::class, 'list_image'])->name('image.index');
            });


            Route::post('image/selectElement', [PictureController::class, 'selectElement']);
            Route::post('image/selectEmbed', [PictureController::class, 'selectEmbed']);

            Route::group(['prefix' => 'images/{id}'], function () {
                Route::post('store', [PictureController::class, 'store'])->name('image.store');




                Route::post('update', [PictureController::class, 'update'])->name('image.update');
                Route::delete('delete', [PictureController::class, 'delete'])->name('image.delete');
            });
            Route::post(
                'image/priority',
                [PictureController::class, 'priorityImage']
            )->name('image.priority');

            Route::post(
                'section/priority',
                [SectionController::class, 'prioritySection']
            )->name('section.priority');
            Route::post(
                'content/priority',
                [ContentController::class, 'priorityContent']
            )->name('content.priority');
        });

        Route::post('changeActiveSection', [SectionController::class, 'changeActive'])->name('section.changeActive');
        Route::post('editNameImage', [PictureController::class, 'editNameImage']);
    }
);
Route::get('index', LandingPageController::class);