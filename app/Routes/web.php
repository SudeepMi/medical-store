<?php
use App\Http\Controllers\StockController;

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
Route::get('/test', 'BillController@getBillLayout')->name('index');

Route::get('/', function () {
    if(Auth::check()){
        return redirect()->route('home');
    }
    return view('welcome');
})->name('welcome');
/*
    |--------------------------------------------------------------------------
    | Setup Wizard Routes
    |--------------------------------------------------------------------------
    |
    */
    Route::name('setup_wizard.')->prefix('setup_wizard')->group( function(){
        Route::get('/','WizardController@wizard')->name('index')->middleware('auth');
        Route::post('/save','WizardController@store')->name('save');
     });

Auth::routes();
Route::middleware(['auth','setup'])->group(function () {
    Route::get('/dash', 'HomeController@index')->name('home');
    Route::get('/bill-split', 'SiteController@billSplit')->name('bill.split');
    Route::get('/elements', 'SiteController@elements')->name('elements');
    Route::get('/kot', 'SiteController@kot')->name('kot');

    /*
    |--------------------------------------------------------------------------
    | Basic Routes
    |--------------------------------------------------------------------------
    |
    */
    Route::name('log.')->prefix('logs')->group(function () {
        Route::get ( '/logbook', 'LogController@filter_by' )->name('filter' );
        Route::get ( '/recentActivity', 'LogController@activity' )->name ( 'recent' );
        // Route::post ( '/delete', 'LogController@delete' )->name ('delete');

    });
    /*
    |--------------------------------------------------------------------------
    | Basic Routes
    |--------------------------------------------------------------------------
    |
    */
    Route::get('/faqs','SiteController@faqs')->name('faqs');
    Route::get('/getingstarted','SiteController@get_started')->name('getingstarted');
    Route::get('/contact','SiteController@contact')->name('contact');
    Route::post('/contact/sendmessage','ContactController@sendMsg')->name('contact.sendmessage');
    Route::get('/account-setting', 'SiteController@accountSetting')->name('account.setting');

    Route::post('/change-password', 'SiteController@changePasswordStore')->name('change.password.store');
    Route::post('/change-pin', 'SiteController@changePinStore')->name('change.pin.store');

    Route::get('/form', 'SiteController@form')->name('form');

    /*
    |--------------------------------------------------------------------------
    | Workplace Routes
    |--------------------------------------------------------------------------
    |
    */

    Route::name('workplace.')->prefix('workplace')->group(function () {
        Route::get('/', 'WorkplaceController@index')->name('index');
        Route::get('/edit', 'WorkplaceController@edit')->name('edit')->middleware('admin');
        Route::post('/edit', 'WorkplaceController@update')->name('update');
        Route::post('/object-delete', 'WorkplaceController@deleteObject');
        Route::post('/table-delete', 'WorkplaceController@deleteTable');
        Route::post('/table-merge', 'WorkplaceController@mergeTable')->name('table.merge');
        Route::post('/table-unmerge', 'WorkplaceController@unmergeTable');
        Route::post('/table-booking-check-start', 'WorkplaceController@bookingStartCheck');
        Route::post('/table-booking-check-end', 'WorkplaceController@bookingEndCheck');
        Route::post('/table-booking', 'WorkplaceController@booking')->name('table.booking');
        Route::post('/table-booking-update', 'WorkplaceController@bookingUpdate')->name('table.booking.update');
    });

    /*
    |--------------------------------------------------------------------------
    | Order Routes
    |--------------------------------------------------------------------------
    |
    */

    Route::name('order.')->prefix('order')->group(function () {
        Route::get('/{table?}', 'OrderController@index')->name('index');
        Route::get('/{table?}/bill-split', 'OrderController@splitBill')->name('split.bill');
        Route::post('/add-kot', 'OrderController@addKot')->name('add.kot');
        Route::post('/get-kot-list ', 'OrderController@getKotList')->name('get.kot.list');
        Route::post('/return-kot', 'OrderController@returnKot')->name('return.kot');
        Route::post('/get-bill', 'OrderController@getPayableBill')->name('get.bill');
        Route::post('/pay', 'OrderController@pay')->name('pay');
        Route::post('/check-pin','OrderController@checkPin')->name('check.pin');
        Route::post('/create-foc','OrderController@createFoc')->name('create.foc');
        Route::post('/remove-foc','OrderController@removeFoc')->name('remove.foc');

        Route::post('/apply-discount','OrderController@applyDiscount')->name('apply.discount');
        Route::post('/remove-discount','OrderController@removeDiscount')->name('remove.discount');
        Route::post('/pay-split-bill', 'OrderController@paySplitBill')->name('pay.split.bill');
        //Advance
        Route::post('/add-advance', 'OrderController@addAdvance')->name('add.advance');
        Route::post('/remove-advance', 'OrderController@removeAdvance')->name('remove.advance');





    });

    /*
    |--------------------------------------------------------------------------
    | Floor Routes
    |--------------------------------------------------------------------------
    |
    */

    Route::name('floor.')->prefix('floor')->group(function () {
        Route::get('/create', 'FloorController@create')->name('create');
        Route::post('/store', 'FloorController@store')->name('store');

    });

    /*
    |--------------------------------------------------------------------------
    | Table Routes
    |--------------------------------------------------------------------------
    |
    */

    Route::name('table.')->prefix('table')->group(function () {
        Route::get('/get-occupied-table', 'TableController@getOccupiedTable')->name('get.occupied');
        Route::get('/get-empty-table', 'TableController@getEmptyTable')->name('get.empty');

        Route::get('/get-today-booked-table', 'TableController@getTodayBookedTable')->name('get.today.booked');
        Route::get('/booking-history', 'TableController@bookingHistory')->name('booking.history');
        Route::post('/booking-detail-edit', 'TableController@editBooking');
        Route::post('/change-booking-status', 'TableController@changeStatusBooking');
        Route::post('/check-status', 'TableController@checkStatus');
        Route::post('/move', 'TableController@move');


    });

    /*
    |--------------------------------------------------------------------------
    | Takeaway Routes
    |--------------------------------------------------------------------------
    |
    */

    Route::name('takeaway.')->prefix('takeaway')->group(function () {
        Route::get('/get-occupied-table', 'TableController@getOccupiedTable')->name('get.occupied');
        Route::get('/get-today-booked-table', 'TableController@getTodayBookedTable')->name('get.today.booked');
        Route::get('/booking-history', 'TableController@bookingHistory')->name('booking.history');
        Route::post('/booking-detail-edit', 'TableController@editBooking');
        Route::post('/change-booking-status', 'TableController@changeStatusBooking');
    });

    /*
    |--------------------------------------------------------------------------
    | Menu Routes
    |--------------------------------------------------------------------------
    |
    */
    Route::name('menu.')->prefix('menu')->group(function () {
         /*
        |--------------------------------------------------------------------------
        | Special Menu Items Routes
        |--------------------------------------------------------------------------
        |
        */
        Route::name('special.item.')->prefix('special')->group(function () {

            Route::post('/store', 'MenuItemController@storeSpecialItem')->name('store');
            Route::post('/get-special-item', 'MenuItemController@getSpecialItem')->name('get.special.item');


        });


         /*
        |--------------------------------------------------------------------------
        | Menu Items Routes
        |--------------------------------------------------------------------------
        |
        */
        Route::name('item.')->prefix('item')->group(function () {
            Route::get('/create', 'MenuItemController@create')->name('create');
            Route::post('/store', 'MenuItemController@store')->name('store');
            Route::get('/{slug}/edit', 'MenuItemController@edit')->name('edit');
            Route::post('/update', 'MenuItemController@update')->name('update');
            Route::post('/pics', 'MenuItemController@pics')->name('pics');
            Route::post('/change-status', 'MenuItemController@updateStatus')->name('updatestatus');

        });
         /*
        |--------------------------------------------------------------------------
        | Menu Category Routes
        |--------------------------------------------------------------------------
        |
        */
        Route::name('category.')->prefix('category')->group(function () {
            Route::get('/', 'MenuCategoryController@index')->name('index');
            Route::get('/create', 'MenuCategoryController@create')->name('create');
            Route::post('/store', 'MenuCategoryController@store')->name('store');
            Route::post('/update', 'MenuCategoryController@update')->name('update');
            Route::post('/change-status', 'MenuCategoryController@changeStatus')->name('change-status');
        });

        Route::get('/', 'MenuController@index')->name('index');
        Route::post('/getDetail', 'MenuController@getDetail')->name('getDetail');

    });

    /*
    |--------------------------------------------------------------------------
    | Report Routes
    |--------------------------------------------------------------------------
    |
    */

    Route::name('report.')->prefix('report')->group(function () {
        Route::get('/sales', 'ReportController@sales')->name('sales');
    });

    /*
    |--------------------------------------------------------------------------
    | Stock Routes
    |--------------------------------------------------------------------------
    |
    */

    Route::name('stock.')->prefix('stock')->group(function () {
        /*
        |--------------------------------------------------------------------------
        | Stock Item Routes
        |--------------------------------------------------------------------------
        |
        */
        Route::name('item.')->prefix('item')->group(function () {
          Route::get('/create', 'StockController@create')->name('create');
          Route::post('/store', 'StockController@store')->name('store');
          Route::get('/', 'StockController@item_index')->name('index');
          Route::post('/edit', 'StockController@edit')->name('edit');
          Route::post('/update', 'StockController@update')->name('update');
          Route::post('/delete','StockController@delete')->name('delete');
          Route::get('/purchase','StockController@purchase')->name('purchase');
          Route::post('/purchase','StockController@purchaseStore')->name('purchase.store');
          Route::post('/getDetail', 'StockController@getDetail')->name('detail');
          Route::post('/adjust', 'StockController@adjust')->name('adjust');
          Route::post('/updatestatus', 'StockController@updateStatus')->name('status.update');
          Route::post('/purchaseDetail', "StockController@PurchaseDetail")->name('purchaseDetail');
        });
        /*
        |--------------------------------------------------------------------------
        | Utensils Item Routes
        |--------------------------------------------------------------------------
        |
        */
        Route::name('utensil.')->prefix('utensil')->group(function () {
            Route::get('/create', 'UtensilController@create')->name('create');
            Route::post('/store', 'UtensilController@store')->name('store');
            Route::get('/', 'UtensilController@index')->name('index');
            Route::post('/edit', 'UtensilController@edit')->name('edit');
            Route::post('/update', 'UtensilController@update')->name('update');
            Route::post('/delete','UtensilController@delete')->name('delete');
            Route::post('/getDetail', 'UtensilController@getDetail')->name('detail');
            Route::post('/adjust', 'UtensilController@adjust')->name('adjust');


        });
         Route::get('/', 'SiteController@stock')->name('index');
    });


    /*
    |--------------------------------------------------------------------------
    | User Routes
    |--------------------------------------------------------------------------
    |
    */
    Route::name('user.')->prefix('user')->group(function () {

            Route::get('/create', 'UserController@create')->name('create');
            Route::post('/store', 'UserController@store')->name('store');
            Route::get('/{username}/edit/', 'UserController@edit')->name('edit');
            Route::post('/updtae', 'UserController@update')->name('update');
            Route::get('/', 'UserController@index')->name('index');
            Route::post('/getDetail','UserController@getDetail')->name('details');
            Route::post('/change-status','UserController@ChangeStatus')->name('change-status');

    });

    /*
    |--------------------------------------------------------------------------
    | Vendor Routes
    |--------------------------------------------------------------------------
    |
    */
    Route::name('vendor.')->prefix('vendor')->group(function() {
        Route::get('/','VendorController@index')->name('index');
        Route::get('/create','VendorController@create')->name('create');
        Route::post('/newdebitor','VendorController@store')->name('store');
        Route::post('/getDetail', 'VendorController@detail')->name('details');
        Route::get('{slug}/payments', 'VendorController@PaymentWizard')->name('payments');
        Route::post('/payments/store', 'VendorController@StorePayments')->name('store_payments');
        Route::post('/getPaymentsDetail','VendorController@MakePayment')->name('payment_detail');
        Route::post('/getPurchaseDetail','VendorController@PurchaseDetail')->name('purchase_detail');
    });

    /*
    |--------------------------------------------------------------------------
    | Debtors Routes The one who takes credit
    |--------------------------------------------------------------------------
    |
    */
    Route::name('debtor.')->prefix('debtor')->group(function() {
        Route::get('/','DebitorController@index')->name('index');
        Route::get('/create','DebitorController@create')->name('create');
        Route::post('/store','DebitorController@store')->name('store');

        Route::get('/get-debtors','DebitorController@getDebitors')->name('get.debtors');
        Route::post('/add-debtor','DebitorController@addDebitor')->name('add.debtor');
        Route::get('/check-email','DebitorController@checkEmail')->name('check.email');
        Route::post('/getDetail','DebitorController@getDetail')->name('getDetail');
        Route::get('/get-credit-detail','DebitorController@getCreditDetail')->name('get.credit.detail');
        Route::post('/pay','DebitorController@payCredit')->name('pay.credit');

    });
    /*
    |--------------------------------------------------------------------------
    | Membership Routes The one who takes credit
    |--------------------------------------------------------------------------
    |
    */
    Route::name('membership.')->prefix('membership')->group(function() {
        Route::get('/','MemberController@index')->name('index');
        Route::get('/create','MemberController@create')->name('create');
        Route::post('/store','MemberController@store')->name('store');
        Route::post('/check','OrderController@checkMember')->name('check');
        Route::post('/apply','OrderController@applyMember')->name('apply');

        Route::post('/updatestatus','MemberController@updateStatus')->name('uStatus');
        Route::post('/update','MemberController@update')->name('update');
        Route::get('/edit','MemberController@edit')->name('edit');

        Route::name('threshold.')->prefix('threshold')->group(function() {
            Route::get('/','MemberController@thresholdIndex')->name('index');
            Route::get('/create','MemberController@thresholdCreate')->name('create');
            Route::get('/edit/{slug}','MemberController@thresholdEdit')->name('edit');
            Route::post('/update','MemberController@thresholdUpdate')->name('update');
             Route::post('/updatestatus','MemberController@thresholdStatus')->name('uStatus');
            Route::post('/store','MemberController@thresholdStore')->name('store');
            Route::post('/details','MemberController@thresholdDetails')->name('details');

        });
        Route::name('repeat.')->prefix('repeat')->group(function() {
            Route::get('/','MemberController@repeatIndex')->name('index');

        });
    });
    /*
    |--------------------------------------------------------------------------
    | Tips Routes
    |--------------------------------------------------------------------------
    |
    */
    Route::name('tip.')->prefix('tip')->group( function(){
        Route::get('/','TipsController@index')->name('index');
        Route::get('/distribute','TipsController@create')->name('distribute');
        Route::post('/distribute','TipsController@store')->name('distribute');
        Route::post('/getDetail','TipsController@details')->name('get_details');
        Route::post('/add','TipsController@addTips')->name('add');


    });



    /*
    |--------------------------------------------------------------------------
    | Software Setting Routes
    |--------------------------------------------------------------------------
    |
    */

    Route::name('settings.')->prefix("software-setting")->group(function () {
        Route::get('/', 'SoftwareSettingController@index')->name('index');
        Route::post('/store', 'SoftwareSettingController@store')->name('store');
        Route::post('/update', 'SoftwareSettingController@update')->name('update');
        Route::post('/change-status', 'SoftwareSettingController@status');
    });
    /*
    |--------------------------------------------------------------------------
    | Quick Software Setting Routes
    |--------------------------------------------------------------------------
    |
    */

    Route::name('quick-software-settings.')->prefix("quick-software-setting")->group(function () {
        Route::post('/update', 'SoftwareSettingController@quickUpdate')->name('update');
    });
    /*
    |--------------------------------------------------------------------------
    | Design Invoice Routes
    |--------------------------------------------------------------------------
    |
    */

    Route::name('design.')->middleware('admin')->prefix("design-invoice")->group(function () {
        Route::get('/', 'DesignController@index')->name('index');
        Route::post('/update', 'DesignController@store')->name('store');
    });

    /*
    |--------------------------------------------------------------------------
    | Retails Routes
    |--------------------------------------------------------------------------
    |
    */
    Route::name('retails.')->prefix("retail_items")->group(function () {
        Route::get('/','RetailController@index')->name('index');
        Route::post('/store','RetailController@store')->name('store');
        Route::post('/getDetail', 'RetailController@detail')->name('getDetails');
        Route::post('/updatestatus','RetailController@UpdateStatus')->name('update_status');
    });

    /*
    |--------------------------------------------------------------------------
    | Birthday Notification Routes
    |--------------------------------------------------------------------------
    |
    */
    Route::post('/birthday-notification-form', 'HomeController@notifyForm');
    Route::post('/birthday-notification-send', 'HomeController@sendNotification')->name('email.notification');
});

