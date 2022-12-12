<?php

use App\Http\Controllers\Admin\PermisionsController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\FileManagerController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\ManagerFileController;
use App\Http\Controllers\TemplateController;
use App\Http\Controllers\Tour\CategoryHotspotController;
use App\Http\Controllers\Tour\CategoryPanoController;
use App\Http\Controllers\Tour\ContentController;
use App\Http\Controllers\Tour\FontController;
use App\Http\Controllers\Tour\HotspotController;
use App\Http\Controllers\Tour\IconController;
use App\Http\Controllers\Tour\ImageController;
use App\Http\Controllers\Tour\InforTourController;
use App\Http\Controllers\Tour\MapController;
use App\Http\Controllers\Tour\PanoController;
use App\Http\Controllers\Tour\SettingController;
use App\Http\Controllers\Tour\SettingDisplayController;
use App\Http\Controllers\Tour\SettingColorController;
use App\Http\Controllers\Tour\TourController;
use App\Http\Controllers\Tour\readXmlController;
use App\Http\Controllers\Tour\SoundController;
use App\Http\Controllers\Tour\VoiceContentController;
use App\Http\Controllers\Tour\VoiceInforController;

use App\Http\Controllers\web\PageController;

use App\Models\CategoryHotspot;
use App\Models\SettingTour;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Services\ConfigService\ConfigRepository;
use Google\Service\Texttospeech\Voice;

$config = resolve(ConfigRepository::class);

// App middleware list
$middleware = $config->getMiddleware();

/**
 * If ACL ON add "fm-acl" middleware to array
 */
if ($config->getAcl()) {
    $middleware[] = 'fm-acl';
}
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

Route::get('/', function () {
    return redirect('/index');
});
Route::get('/test', function () {
    return Inertia::render('Index');
});
Route::get('/route', function () {
    return Inertia::render('Index');
})->name('route');

Route::get('/dashboard', function () {

    return Inertia::render('Dashboard');
})->middleware(['auth'])->name('dashboard');
Route::group(
    [
        'middleware' => $middleware,
        'prefix'     => 'manager-file',
    ],
    function () {
        Route::get('content', [ManagerFileController::class, 'index'])
            ->name('manager-file.index');
    }
);
Route::group([
    'middleware' => $middleware,
    'prefix'     => $config->getRoutePrefix(),
], function () {
    Route::get('', [FileManagerController::class, 'index'])
        ->name('fm.index');
    Route::get('initialize', [FileManagerController::class, 'initialize'])
        ->name('fm.initialize');

    Route::get('content', [FileManagerController::class, 'content'])
        ->name('fm.content');

    Route::get('tree', [FileManagerController::class, 'tree'])
        ->name('fm.tree');

    Route::get('select-disk', [FileManagerController::class, 'selectDisk'])
        ->name('fm.select-disk');

    Route::post('upload', [FileManagerController::class, 'upload'])
        ->name('fm.upload');

    Route::post('delete', [FileManagerController::class, 'delete'])
        ->name('fm.delete');

    Route::post('paste', [FileManagerController::class, 'paste'])
        ->name('fm.paste');

    Route::post('rename', [FileManagerController::class, 'rename'])
        ->name('fm.rename');

    Route::get('download',  [FileManagerController::class, 'download'])
        ->name('fm.download');

    Route::get('thumbnails', [FileManagerController::class, 'thumbnails'])
        ->name('fm.thumbnails');

    Route::get('preview', [FileManagerController::class, 'preview'])
        ->name('fm.preview');

    Route::get('url', [FileManagerController::class, 'url'])
        ->name('fm.url');

    Route::post('create-directory', [FileManagerController::class, 'createDirectory'])
        ->name('fm.create-directory');

    Route::post('create-file',  [FileManagerController::class, 'createFile'])
        ->name('fm.create-file');

    Route::post('update-file', [FileManagerController::class, 'updateFile'])
        ->name('fm.update-file');

    Route::get('stream-file', [FileManagerController::class, 'streamFile'])
        ->name('fm.stream-file');

    Route::post('zip', [FileManagerController::class, 'zip'])
        ->name('fm.zip');

    Route::post('unzip',  [FileManagerController::class, 'unzip'])
        ->name('fm.unzip');

    // Route::get('properties', 'FileManagerController@properties');

    // Integration with editors
    Route::get('ckeditor', [FileManagerController::class, 'ckeditor'])
        ->name('fm.ckeditor');

    Route::get('tinymce', [FileManagerController::class, 'tinymce'])
        ->name('fm.tinymce');

    Route::get('tinymce5',  [FileManagerController::class, 'tinymce5'])
        ->name('fm.tinymce5');

    Route::get('summernote', [FileManagerController::class, 'summernote'])
        ->name('fm.summernote');

    Route::get('fm-button',  [FileManagerController::class, 'fmButton'])
        ->name('fm.fm-button');
});
Route::middleware(['auth'])->group(
    function () use ($middleware, $config) {

        Route::prefix('page')->as('page.')->group(function () {
            Route::get('', [PageController::class, 'index'])->name('index');
        });

        Route::prefix('permissions')->as('permissions.')->group(function () {
            Route::get('', [PermisionsController::class, 'index'])->name('index');
            Route::post('', [PermisionsController::class, 'store'])->name('store');
            Route::put('/update/{id}', [PermisionsController::class, 'update'])->name('update');
            Route::delete('/delete/{id}', [PermisionsController::class, 'delete'])->name('delete');
        });

        Route::prefix('roles')->as('roles.')->group(function () {
            Route::get('', [RoleController::class, 'index'])->name('index');
            Route::post('', [RoleController::class, 'store'])->name('store');
            Route::put('/update/{id}', [RoleController::class, 'update'])->name('update');
            Route::delete('/delete/{id}', [RoleController::class, 'delete'])->name('delete');
        });

        Route::prefix('users')->as('users.')->group(function () {
            Route::get('', [UserController::class, 'index'])->name('index');

            Route::post('', [UserController::class, 'store'])->name('store');
            Route::put('/update/{id}', [UserController::class, 'update'])->name('update');
            Route::delete('/delete/{id}', [UserController::class, 'destroy'])->name('destroy');
            // Route::post('import/user',  [UserController::class, 'import'])->name('import');
        });

        Route::prefix('templates')->as('template.')->group(function () {
            Route::get('', [TemplateController::class, 'index'])->name('index');
            Route::get('{id}/edit', [TemplateController::class, 'edit'])->name('edit');
            Route::post('', [TemplateController::class, 'store'])->name('store');
            Route::post('/update/{id}', [TemplateController::class, 'update'])->name('update');
            Route::delete('/delete/{id}', [TemplateController::class, 'destroy'])->name('destroy');
        });

        Route::prefix('tours')->as('tour.')->group(function () {

            Route::get('cloneTour/{id}', [TourController::class, 'cloneTOur'])->name('clone');
            Route::get('', [TourController::class, 'index'])->name('index');
            Route::post('', [TourController::class, 'store'])->name('store');
            Route::get('content/{id}', [TourController::class, 'content'])->name('content');
            Route::post('/update/{id}', [TourController::class, 'update'])->name('update');
            Route::delete('/delete/{id}', [TourController::class, 'delete'])->name('delete');
            Route::prefix('/{id}/panos')->as('pano.')->group(function () {
                Route::get('', [PanoController::class, 'index'])->name('index');
                Route::post('/update', [PanoController::class, 'update'])->name('update');
            });

            Route::prefix('{id}/template')->as('template.')->group(function () {
                Route::get('', [TemplateController::class, 'TemplateTour'])->name('index');
                Route::post('', [TemplateController::class, 'storeTemplate'])->name('storeTemplate');
            });
            Route::prefix('/{id}/icons')->as('icon.')->group(function () {
                Route::get('', [IconController::class, 'index'])->name('index');
                Route::post('/', [IconController::class, 'store'])->name('store');
                Route::post('/update', [IconController::class, 'update'])->name('update');
                Route::delete('/delete', [IconController::class, 'delete'])->name('delete');
            });
            Route::delete('/deleteAll', [IconController::class, 'deleteAll'])->name('icon.deleteAll');


            Route::prefix('/{id}/setting')->as('setting.')->group(function () {
                Route::get('', [SettingController::class, 'index'])->name('index');
                Route::post('/', [SettingController::class, 'store'])->name('store');
                Route::delete('/delete', [SettingController::class, 'delete'])->name('delete');
            });
            Route::prefix('/{id}/setting-display')->as('setting-display.')->group(function () {
                Route::get('', [SettingDisplayController::class, 'index'])->name('index');
                Route::post('/', [SettingDisplayController::class, 'store'])->name('store');
                // Route::delete('/delete', [SettingDisplayController::class, 'delete'])->name('delete');
            });
            Route::prefix('/{id}/setting-color')->as('setting-color.')->group(function () {
                Route::get('', [SettingColorController::class, 'index'])->name('index');
                Route::post('/', [SettingColorController::class, 'store'])->name('store');
                // Route::delete('/delete', [SettingDisplayController::class, 'delete'])->name('delete');
            });
            Route::prefix('/{id}/font')->as('font.')->group(function () {
                Route::get('', [FontController::class, 'index'])->name('index');
                Route::post('/', [FontController::class, 'store'])->name('store');
                Route::delete('/delete', [FontController::class, 'delete'])->name('delete');
            });
            Route::prefix('/{id}/map')->as('map.')->group(function () {
                Route::get('', [MapController::class, 'index'])->name('index');
                Route::post('/', [MapController::class, 'store'])->name('store');
                Route::delete('/delete', [MapController::class, 'delete'])->name('delete');
            });
            Route::prefix('/{name}/panos')->as('pano.')->group(function () {
                Route::prefix('/{id}/hotspots')->as('hotspot.')->group(function () {
                    Route::get('', [HotspotController::class, 'index'])->name('index');
                });
            });
            Route::prefix('hotspot/{id}/contents')->as('content.')->group(function () {
                Route::get('', [ContentController::class, 'index'])->name('index');
                Route::post('', [ContentController::class, 'store'])->name('store');
                Route::post('update', [ContentController::class, 'update'])->name('update');
                Route::delete('delete', [ContentController::class, 'delete'])->name('delete');
            });
            Route::prefix('/{id}/hotspots')->as('hotspot.')->group(function () {
                Route::post('/', [HotspotController::class, 'store'])->name('store');
                Route::post('/update', [HotspotController::class, 'update'])->name('update');
                Route::delete('/delete', [HotspotController::class, 'delete'])->name('delete');
                Route::prefix('/action')->as('action.')->group(function () {
                    Route::post('/update', [HotspotController::class, 'saveDataAction'])->name('update');
                });
                Route::post('/clearAction', [HotspotController::class, 'clearAction'])->name('clearAction');
            });

            Route::prefix('/{id}/category-pano')->as('category-pano.')->group(function () {
                Route::get('', [CategoryPanoController::class, 'index'])->name('index');
                Route::post('/', [CategoryPanoController::class, 'store'])->name('store');
                Route::put('/update', [CategoryPanoController::class, 'update'])->name('update');
                Route::delete('/delete', [CategoryPanoController::class, 'delete'])->name('delete');
            });
            Route::prefix('/{id}/voice')->as('voice.')->group(function () {
                Route::get('', [VoiceContentController::class, 'index'])->name('index');
                Route::post('', [VoiceContentController::class, 'store'])->name('store');
                Route::post('/update', [VoiceContentController::class, 'update'])->name('update');
                Route::delete('/delete', [VoiceContentController::class, 'delete'])->name('delete');
            });

            Route::prefix('/{id}/infor')->as('infor.')->group(function () {
                Route::get('', [InforTourController::class, 'index'])->name('index');
                Route::post('', [InforTourController::class, 'store'])->name('store');
                Route::post('/update', [InforTourController::class, 'update'])->name('update');
                Route::delete('/delete', [InforTourController::class, 'delete'])->name('delete');
                Route::prefix('/{slug}/images')->as('images.')->group(function () {
                    Route::get('', [ImageController::class, 'index'])->name('index');
                    Route::post('', [ImageController::class, 'store'])->name('store');
                    Route::post('/update', [ImageController::class, 'update'])->name('update');
                });
                Route::prefix('/{slug}/voices')->as('voices.')->group(function () {
                    Route::get('', [VoiceInforController::class, 'index'])->name('index');
                    Route::post('', [VoiceInforController::class, 'store'])->name('store');
                    Route::post('/update', [VoiceInforController::class, 'update'])->name('update');
                });
                Route::delete('image/delete', [ImageController::class, 'delete'])->name('image.delete');
                Route::delete('voice/delete', [VoiceInforController::class, 'delete'])->name('voice.delete');
            });


            Route::prefix('/{id}/sounds')->as('sound.')->group(function () {
                Route::get('', [SoundController::class, 'index'])->name('index');
                Route::post('/', [SoundController::class, 'store'])->name('store');
                Route::post('/update', [SoundController::class, 'update'])->name('update');
                Route::delete('/delete', [SoundController::class, 'delete'])->name('delete');
            });
            Route::post('selectVoice', [VoiceInforController::class, 'selectVoice'])->name('voice.selectVoice');

            Route::post('imagePrority', [ImageController::class, 'priorityImage'])->name('image.priority');
            Route::post('inforPrority', [InforTourController::class, 'inforPrority'])->name('infor.priority');
            Route::post('soundPrority', [SoundController::class, 'prioritySound'])->name('sound.priority');
        });
        Route::prefix('category-hotspot')->as('category-hotspot.')->group(function () {
            Route::get('', [CategoryHotspotController::class, 'index'])->name('index');
            Route::post('/', [CategoryHotspotController::class, 'store'])->name('store');
            Route::put('/{id}/update', [CategoryHotspotController::class, 'update'])->name('update');
            Route::delete('/delete/{id}', [CategoryHotspotController::class, 'delete'])->name('delete');
        });

        Route::post('pano/selectCategory', [PanoController::class, 'selectCategory']);
        Route::prefix('tour_editor')->as('tour_editor.')->group(function () {
            Route::get('/{id}', [readXmlController::class, 'index'])->name('index');
            Route::post('/{id}', [readXmlController::class, 'editTour'])->name('editTour');
            // Route::post('/{id}/update', [readXmlController::class, 'update'])->name('update');
            // Route::delete('/delete/{id}', [readXmlController::class, 'delete'])->name('delete');
        });
        Route::get('/tourxml', [readXmlController::class, 'editorTour'])->name('tourxml');
        Route::post('pano/sort', [PanoController::class, 'priorityPano'])->name('pano.sort');
        Route::post('category-pano/sort', [CategoryPanoController::class, 'priorityCategoryPano'])->name('category-pano.sort');

        Route::prefix('languages')->as('language.')->group(function () {
            Route::get('', [LanguageController::class, 'index'])->name('index');
            Route::post('update', [LanguageController::class, 'update'])->name('update');
        });
    }
);






Route::group(
    [
        'middleware' => ['lang'],
        'prefix'     => $config->getRoutePrefix(),
    ],
    function () {
        // Route::get('/{code}', [readXmlController::class, 'preview'])
        //     ->name('tour360.index');
        // Route::get('/{code}/map', [readXmlController::class, 'map_preview'])
        //     ->name('tour360.map_preview');
    }
);

Route::get('language/{language}', function ($language) {
    Session()->put('locale', $language);

    return redirect()->back();
})->name('language');
Route::get('tour/{code}', [TourController::class, 'tour'])->name('tour.preview');
Route::get('tour/{code}/map', [readXmlController::class, 'map_preview'])
    ->name('tour360.map_preview');
Route::get('tour/{code}/hotspot/{scene}', [TourController::class, 'ListHotSpot'])->name('tour.hotspot');
require __DIR__ . '/auth.php';
require __DIR__ . '/landingpage.php';
