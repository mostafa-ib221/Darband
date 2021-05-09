<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\CateringController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\DeliveryFeeController;
use App\Http\Controllers\DishController;
use App\Http\Controllers\ExtraController;
use App\Http\Controllers\FoodController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\NewsLetterController;
use App\Http\Controllers\OpenTimeController;
use App\Http\Controllers\OptionController;
use App\Http\Controllers\OrderController;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

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

/*Route::get('/', function () {
    return view('welcome');
});*/
Route::get('/clear-cache', function() {
    $exitCode = Artisan::call('config:clear');
    $exitCode = Artisan::call('cache:clear');
    $exitCode = Artisan::call('config:cache');
    return 'DONE'; //Return anything
});

Route::view('soon', 'soon');

Route::get('/test', function () {
    $timestamp = strtotime('2009-10-22');

    $day = date('D', $timestamp);
    var_dump($day);
});
Route::group(['prefix' => 'session'], function () {
    Route::get('/set', function (Request $request) {
        //$ret = [];
        foreach($request->all() as $key => $value) {
            //$ret[] = [$key, $value];
            $request->session()->put($key, $value);
        }
        //return $ret;
        $request->session()->put('basket', [
            12 => [
                'name' => 'Kale Pache 1',
                'price' => 25.30,
                'no' => 2,
                'extra' => [
                    [
                        'name' => 'Cheshm',
                        'price' => 5,
                        'no' => 1,
                        'priceAll' => 5,
                    ],
                    [
                        'name' => 'Zaban',
                        'price' => 3,
                        'no' => 6,
                        'priceAll' => 6,
                    ],
                ],
                'priceAll' => 61.60,
            ],
            'priceAll' => 61.60,
            'no' => 2
        ]);
        return 'set session';
    });
    Route::get('/get', function (Request $request) {
        return $request->session()->all();
    });
    Route::get('/get/{key}', function (Request $request, $key) {
        return $request->session()->get($key);
    });
    Route::get('/del', function (Request $request) {
        $request->session()->flush();
        return $request->session()->all();
    });
    Route::get('/del/{key}', function (Request $request, $key) {
        $request->session()->forget($key);
        return $request->session()->all();
    });
});

Route::group(['middleware' => ['web']], function() {
    Auth::routes();

    //<editor-fold desc="=========================================== Site ===========================================">
    /*Route::get('/', [HomeController::class, 'index']);
    Route::get('/explore', [HomeController::class, 'explore']);*/
    Route::get('/', [HomeController::class, 'explore']);
    Route::redirect('explore', '/');

    Route::group(['prefix' => 'checkout'], function () {
        Route::get('/', [HomeController::class, 'CheckoutShow']);
        Route::post('/', [HomeController::class, 'CheckoutSave']);
    });

    Route::get('/menu', [HomeController::class, 'MenuShow']);
    Route::get('/order', [HomeController::class, 'OrderShow']);

    Route::group(['prefix' => '/payment/details/{order_no}'], function () {
        Route::get('/', [HomeController::class, 'PaymentDetails']);
        Route::post('/', [HomeController::class, 'PaymentDetailsPay']);
    });

    Route::get('/confirmation/{order_no}', [HomeController::class, 'Confirmation']);

    Route::group(['prefix' => '/catering'], function () {
        Route::get('/', [HomeController::class, 'CateringShow']);
        Route::post('/', [HomeController::class, 'CateringSave']);
    });

    Route::group(['prefix' => 'basket'], function () {
        Route::post('/set', [HomeController::class, 'BasketSet']);
        Route::post('/plus', [HomeController::class, 'BasketAdd']);
        Route::post('/minus', [HomeController::class, 'BasketMinus']);
        Route::post('/get', [HomeController::class, 'BasketGet']);
        Route::post('/options', [HomeController::class, 'BasketOptions']);
        Route::post('/extras', [HomeController::class, 'BasketExtras']);
        Route::post('/comment', [HomeController::class, 'BasketComment']);
        Route::post('/update', [HomeController::class, 'BasketUpdate']);
        Route::post('/del', [HomeController::class, 'BasketDel']);
        Route::post('/clear', [HomeController::class, 'BasketClear']);
    });

    Route::post('newsletter', [NewsLetterController::class, 'store'])->name('news-letter.store');
    //</editor-fold">


    Route::group(['prefix' => 'boss'], function () {
        Route::get('/', function() {return redirect(url('login'));});

        Route::group(['prefix' => 'newsletter'], function () {
            Route::get('/', [NewsLetterController::class, 'index']);
            Route::get('delete/{newsLetter}', [NewsLetterController::class, 'destroy']);
        });

        Route::group(['prefix' => 'news'], function () {
            Route::get('/', [NewsController::class, 'form']);
            Route::post('/', [NewsController::class, 'save']);
            Route::get('/delete/{news}', [NewsController::class, 'delete']);
            Route::post('/{news}', [NewsController::class, 'save']);
        });
        Route::group(['prefix' => 'contact'], function () {
            Route::get('/', [ContactController::class, 'index']);
            Route::post('/', [ContactController::class, 'store']);
        });
        Route::group(['prefix' => 'about'], function () {
            Route::get('/', [AboutController::class, 'index']);
            Route::post('/', [AboutController::class, 'store']);
        });
        Route::group(['prefix' => 'dishes'], function () {
            Route::get('/delete/{dish}', [DishController::class, 'delete']);
            Route::group(['prefix' => 'popular'], function () {
                Route::get('/', [DishController::class, 'popular_index']);
                Route::post('/', [DishController::class, 'popular_store']);
                Route::post('/extras/{kp}', [DishController::class, 'popular_extras']);
                Route::post('/{kp}', [DishController::class, 'popular_store']);
            });
            Route::group(['prefix' => 'other'], function () {
                Route::get('/', [FoodController::class, 'index']);
                Route::post('/', [FoodController::class, 'store']);
                Route::post('/{food}', [FoodController::class, 'store']);
                Route::get('/delete/{food}', [FoodController::class, 'delete']);
            });
            Route::group(['prefix' => 'options'], function () {
                Route::get('/', [OptionController::class, 'index']);
                Route::post('/', [OptionController::class, 'store']);
                Route::post('/{option}', [OptionController::class, 'store']);
                Route::get('/delete/{option}', [OptionController::class, 'delete']);
            });
            Route::group(['prefix' => 'extras'], function () {
                Route::get('/', [ExtraController::class, 'index']);
                Route::post('/', [ExtraController::class, 'store']);
                Route::post('/{extra}', [ExtraController::class, 'store']);
                Route::get('/delete/{extra}', [ExtraController::class, 'delete']);
            });
        });
        Route::group(['prefix' => '/open/times'], function () {
            Route::get('/', [OpenTimeController::class, 'index']);
            Route::post('/', [OpenTimeController::class, 'store']);
            Route::post('/{ot}', [OpenTimeController::class, 'store']);
            Route::get('/delete/{ot}', [OpenTimeController::class, 'delete']);
        });
        /*Route::group(['prefix' => '/live/orders'], function () {
            Route::get('/', [OrderController::class, 'index']);
            Route::get('/get/new/{lastId}', [OrderController::class, 'getNewCount']);
        });*/
        Route::group(['prefix' => 'order'], function () {
            Route::group(['prefix' => 'live'], function () {
                Route::get('/', [OrderController::class, 'index']);
                Route::get('/get/new/{lastId}', [OrderController::class, 'getNewCount']);
            });
            Route::get('/history', [OrderController::class, 'History']);
            Route::get('/confirm/{order}', [OrderController::class, 'Confirm']);
            Route::get('/cancel/{order}', [OrderController::class, 'Cancel']);
        });
        Route::group(['prefix' => 'delivery_fee'], function () {
            Route::get('/', [DeliveryFeeController::class, 'index']);
            Route::post('/', [DeliveryFeeController::class, 'store']);
        });

        Route::group(['prefix' => 'catering'], function () {
            Route::get('/', [CateringController::class, 'index']);
            Route::group(['prefix' => 'reading'], function () {
                Route::get('/show', [CateringController::class, 'readingShow']);
                Route::get('/hide', [CateringController::class, 'readingHide']);
            });
            Route::get('/read/{catering}', [CateringController::class, 'read']);
            Route::get('/delete/{catering}', [CateringController::class, 'delete']);
        });
    });
});
