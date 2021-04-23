<?php
use App\Mail\TestEmail;

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

// Authentications
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
// end of Authentications


// admin routing 
Route::group(['prefix' => 'admin'], function(){

	// admin log-on auth
	Route::get('/login','Admin\Dashboard\DashboardController@index')->name('admin.login');
	Route::post('/login','Admin\Dashboard\DashboardController@formSubmit')->name('admin.login.submit');
	Route::post('/logout','Auth\LoginController@adminlogout')->name('admin.logout');
	// end of admin log-on auth

	// dashboard panel
	Route::get('/dashboard','AdminController@index')->name('admin.dashboard');
		// admin change password 
		Route::get('/change-password','Admin\Dashboard\ChangePassword\ChangePasswordController@showPage')->name('admin.changePassword');
		Route::get('/change-password-submit','Admin\Dashboard\ChangePassword\ChangePasswordController@submitPassPage')->name('admin.changePasswordSubmit');
		// end of admin change password
		// unique visitors show 
		Route::get('/visitors-count','Admin\Dashboard\Visitors\VisitorController@showCountVisitors')->name('admin.showCountVisitors');
		// end of unique visitors

		// master wood
		Route::get('/master-wood','Admin\Dashboard\MasterWood\MasterWoodController@index')->name('admin.master-wood');
		// end of master-wood

		// pick-up-footprint (outside post to post)
		Route::get('/pick-a-footprint','Admin\Dashboard\PickUpFootPrint\PickUpFootPrintController@showPage')->name('admin.show-pick-a-footprint');
		Route::get('/get-posts-in-pick-a-footprint','Admin\Dashboard\PickUpFootPrint\PickUpFootPrintController@showAllPosts')->name('admin.get-posts-in-pick-a-footprint');
		Route::post('/insert-pick-a-footprint','Admin\Dashboard\PickUpFootPrint\PickUpFootPrintController@insertPickAFootprint')->name('admin.insert-pick-a-footprint');
		Route::get('/view-pick-a-footprint','Admin\Dashboard\PickUpFootPrint\PickUpFootPrintController@showViewPage')->name('admin.view-pick-a-footprint');
		Route::get('/all-data-on-view-pick-a-footprint','Admin\Dashboard\PickUpFootPrint\PickUpFootPrintController@allDataOnShowViewPage')->name('admin.all-data-on-view-pick-a-footprint');
		Route::get('/del-pick-up-footprint','Admin\Dashboard\PickUpFootPrint\PickUpFootPrintController@delParticularData')->name('admin.del-pick-up-footprint');
			// all show --- master width
			Route::get('/show-width-pick-a-footprint','Admin\Dashboard\PickUpFootPrint\PickUpFootPrintController@masterWidthShow')->name('admin.show-width-pick-a-footprint');
			// all show --- master width
			Route::get('/show-height-pick-a-footprint','Admin\Dashboard\PickUpFootPrint\PickUpFootPrintController@masterHeightShow')->name('admin.show-height-pick-a-footprint');
			// all show --- edit Page
			Route::get('/get-all-footprint-data','Admin\Dashboard\PickUpFootPrint\PickUpFootPrintController@getAllFootprintData')->name('admin.get-all-footprint-data');
			Route::POST('/edit-page-pick-a-footprint','Admin\Dashboard\PickUpFootPrint\PickUpFootPrintController@editModalPartFx')->name('admin.edit-page-pick-a-footprint');
			// master height
			Route::get('/master-height','Admin\Dashboard\MasterHeight\MasterHeightController@index')->name('admin.master-height');
			Route::get('/master-height-show','Admin\Dashboard\MasterHeight\MasterHeightController@showPageData')->name('admin.master-height-show');
			Route::post('/master-height-submit','Admin\Dashboard\MasterHeight\MasterHeightController@submitData')->name('admin.master-height-submit');
			Route::get('/master-height-action-change','Admin\Dashboard\MasterHeight\MasterHeightController@changeActionData')->name('admin.master-height-action-change');
			Route::get('/master-height-action-del','Admin\Dashboard\MasterHeight\MasterHeightController@changeActionDel')->name('admin.master-height-action-del');
			Route::get('/master-height-action-get-edit','Admin\Dashboard\MasterHeight\MasterHeightController@getActionEdit')->name('admin.master-height-action-get-edit');
			Route::post('/master-height-action-edit/{my_data}','Admin\Dashboard\MasterHeight\MasterHeightController@changeActionEdit')->name('admin.master-height-action-edit');
			// master width
			Route::get('/master-width','Admin\Dashboard\MasterWidth\MasterWidthController@index')->name('admin.master-width');
			Route::get('/master-width-show','Admin\Dashboard\MasterWidth\MasterWidthController@showPageData')->name('admin.master-width-show');
			Route::post('/master-width-submit','Admin\Dashboard\MasterWidth\MasterWidthController@submitData')->name('admin.master-width-submit');
			Route::get('/master-width-action-change','Admin\Dashboard\MasterWidth\MasterWidthController@changeActionData')->name('admin.master-width-action-change');
			Route::get('/master-width-action-del','Admin\Dashboard\MasterWidth\MasterWidthController@changeActionDel')->name('admin.master-width-action-del');
			Route::get('/master-width-action-get-edit','Admin\Dashboard\MasterWidth\MasterWidthController@getActionEdit')->name('admin.master-width-action-get-edit');
			Route::post('/master-width-action-edit/{my_data}','Admin\Dashboard\MasterWidth\MasterWidthController@changeActionEdit')->name('admin.master-width-action-edit');
			// Master Overhead Shades 
			Route::get('/master-overhead-shades','Admin\Dashboard\MasterOverheadShades\MasterOverShadeController@index')->name('admin.master-overhead-shades-show');
			Route::get('/master-overhead-shades-show','Admin\Dashboard\MasterOverheadShades\MasterOverShadeController@showP')->name('admin.master-overhead-shades-show-actual-data');
			Route::post('/master-overhead-shades-add','Admin\Dashboard\MasterOverheadShades\MasterOverShadeController@addP')->name('admin.master-overhead-shades-show-actual-submit');
			Route::get('/master-overhead-shades-action-change-show','Admin\Dashboard\MasterOverheadShades\MasterOverShadeController@actionP')->name('admin.master-overhead-shades-show-action-change-data');
			Route::get('/master-overhead-shades-action-get-edit','Admin\Dashboard\MasterOverheadShades\MasterOverShadeController@showEditP')->name('admin.master-overhead-shades-action-get-edit');
			Route::post('/master-overhead-shades-action-edit/{my_data}','Admin\Dashboard\MasterOverheadShades\MasterOverShadeController@updateP')->name('admin.master-overhead-shades-action-edit');
			Route::get('/master-overhead-shades-action-del','Admin\Dashboard\MasterOverheadShades\MasterOverShadeController@removeP')->name('admin.master-overhead-shades-action-del');
			// master post length
			Route::get('/master-post-length','Admin\Dashboard\MasterPostLength\MasterPostLengthController@index')->name('admin.master-post-length-show');
			Route::get('/master-post-length-show','Admin\Dashboard\MasterPostLength\MasterPostLengthController@showP')->name('admin.master-post-length-show-actual-data');
			Route::post('/master-post-length-add','Admin\Dashboard\MasterPostLength\MasterPostLengthController@addP')->name('admin.master-post-length-show-actual-submit');
			Route::get('/master-post-length-action-change-show','Admin\Dashboard\MasterPostLength\MasterPostLengthController@actionP')->name('admin.master-post-length-show-action-change-data');
			Route::get('/master-post-length-action-get-edit','Admin\Dashboard\MasterPostLength\MasterPostLengthController@showEditP')->name('admin.master-post-length-action-get-edit');
			Route::post('/master-post-length-action-edit/{my_data}','Admin\Dashboard\MasterPostLength\MasterPostLengthController@updateP')->name('admin.master-post-length-action-edit');
			Route::get('/master-post-length-action-del','Admin\Dashboard\MasterPostLength\MasterPostLengthController@removeP')->name('admin.master-post-length-action-del');
			// posts
			Route::get('/add-posts','Admin\Dashboard\PillerPost\PillerPostController@showPage')->name('admin.add-posts');
			Route::get('/admin-submit-piller-posts','Admin\Dashboard\PillerPost\PillerPostController@submitPiller')->name('admin.submit-piller-posts');
			Route::get('/admin-show-piller-post','Admin\Dashboard\PillerPost\PillerPostController@showPillerPosts')->name('admin.show-piller-post');
			Route::get('/admin-piller-action-change','Admin\Dashboard\PillerPost\PillerPostController@pillerActionChange')->name('admin.piller-action-change');
			Route::get('/admin-piller-action-del','Admin\Dashboard\PillerPost\PillerPostController@changeActionDel')->name('admin.piller-action-del');
			Route::get('/admin-piller-action-get-edit','Admin\Dashboard\PillerPost\PillerPostController@getActionEdit')->name('admin.piller-action-get-edit');
			Route::get('/admin-piller-action-edit','Admin\Dashboard\PillerPost\PillerPostController@changeActionEdit')->name('admin.piller-action-edit');
			// Pick Overhead Shades
			Route::get('/pick-overhead-shades-height-width-first-load','Admin\Dashboard\PickOverheadShades\PickOverheadShadesController@showActualData')->name('admin.pick-overhead-shades-height-width-first-load');
			Route::get('/pick-overhead-shades-post-first-load','Admin\Dashboard\PickOverheadShades\PickOverheadShadesController@showPostLoadfx')->name('admin.pick-overhead-shades-post-first-load');

			Route::get('/add-pick-overhead-shades','Admin\Dashboard\PickOverheadShades\PickOverheadShadesController@showPage')->name('admin.add-pick-overhead-shades');
			Route::post('/admin-submit-pick-overhead-shades','Admin\Dashboard\PickOverheadShades\PickOverheadShadesController@submitOverheadShades')->name('admin.submit-pick-overhead-shades');
			Route::get('/admin-show-pick-overhead-shades','Admin\Dashboard\PickOverheadShades\PickOverheadShadesController@showOverheadShades')->name('admin.show-pick-overhead-shades');
			Route::get('/admin-pick-overhead-shades-change','Admin\Dashboard\PickOverheadShades\PickOverheadShadesController@changeActionOverheadShades')->name('admin.change-action-pick-overhead-shades');

			Route::get('/admin-pick-overhead-shades-del','Admin\Dashboard\PickOverheadShades\PickOverheadShadesController@delActionOverheadShades')->name('admin.del-action-pick-overhead-shades');
			Route::get('/admin-pick-overhead-shades-edit-view','Admin\Dashboard\PickOverheadShades\PickOverheadShadesController@viewEditActionOverheadShades')->name('admin.view-edit-action-pick-overhead-shades');
			Route::post('/admin-pick-overhead-shades-edit/{id}','Admin\Dashboard\PickOverheadShades\PickOverheadShadesController@editActionOverheadShades')->name('admin.edit-action-pick-overhead-shades');
			// 3D view
			Route::get('/panel-for-3D-view','Admin\Dashboard\Video3D\Video3DController@showPage')->name('admin.panel-for-3d-view');
			Route::get('/get-data-for-3D-view','Admin\Dashboard\Video3D\Video3DController@getDataPageFx')->name('admin.get-data-for-3D-view');
			Route::get('/get-table-data-for-3D-view','Admin\Dashboard\Video3D\Video3DController@getTableDataPageFx')->name('admin.get-table-data-for-3D-view');
			Route::post('/submit-3D-data','Admin\Dashboard\Video3D\Video3DController@submit_video3D_fx')->name('admin.submit-3D-data');
			Route::get('/change-action-data-for-3D-view','Admin\Dashboard\Video3D\Video3DController@getChangeActionFx')->name('admin.change-action-data-for-3D-view');
			Route::get('/del-action-data-for-3D-view','Admin\Dashboard\Video3D\Video3DController@delActionFx')->name('admin.del-action-data-for-3D-view');
			Route::get('/edit-view-action-data-for-3D-view','Admin\Dashboard\Video3D\Video3DController@editViewChangeActionFx')->name('admin.edit-view-action-data-for-3D-view');
			Route::post('/edit-action-data-for-3D-view/{id}','Admin\Dashboard\Video3D\Video3DController@editActionFx')->name('admin.edit-action-data-for-3D-view');
			// Pick Post Length 
			Route::get('/pick-master-post-length-height-width-first-load','Admin\Dashboard\PickPostLength\PickPostLengthController@showMasterPostLength')->name('admin.pick-master-post-length-height-width-first-load');

			Route::get('/add-pick-post-length','Admin\Dashboard\PickPostLength\PickPostLengthController@showPage')->name('admin.add-pick-post-length');
			Route::post('/admin-submit-pick-post-length','Admin\Dashboard\PickPostLength\PickPostLengthController@submitOverheadShades')->name('admin.submit-pick-post-length');
			Route::get('/admin-show-pick-post-length','Admin\Dashboard\PickPostLength\PickPostLengthController@showOverheadShades')->name('admin.show-pick-post-length');
			Route::get('/admin-pick-post-length-change','Admin\Dashboard\PickPostLength\PickPostLengthController@overheadShadesActionChange')->name('admin.pick-post-length-action-change');

			Route::get('/admin-pick-post-length-del','Admin\Dashboard\PickPostLength\PickPostLengthController@delActionChange')->name('admin.pick-post-length-action-del');
			Route::get('/admin-pick-post-length-view-edit','Admin\Dashboard\PickPostLength\PickPostLengthController@viewEditActionChange')->name('admin.pick-post-length-action-view-edit');
			Route::post('/admin-pick-post-length-edit/{id}','Admin\Dashboard\PickPostLength\PickPostLengthController@editActionChange')->name('admin.pick-post-length-action-edit');
			// Pick Post Slap
			Route::get('/add-pick-post-slap','Admin\Dashboard\PickPostMountBracket\PickPostMountBracketController@showPage')->name('admin.add-pick-post-slap');
			Route::post('/admin-submit-pick-post-slap','Admin\Dashboard\PickPostMountBracket\PickPostMountBracketController@submitOverheadShades')->name('admin.submit-pick-post-slap');
			Route::get('/admin-show-pick-post-slap','Admin\Dashboard\PickPostMountBracket\PickPostMountBracketController@showOverheadShades')->name('admin.show-pick-post-slap');
			Route::get('/admin-pick-post-slap-change','Admin\Dashboard\PickPostMountBracket\PickPostMountBracketController@overheadShadesActionChange')->name('admin.pick-post-slap-action-change');

			Route::get('/admin-pick-post-slap-del','Admin\Dashboard\PickPostMountBracket\PickPostMountBracketController@delActionChange')->name('admin.pick-post-slap-action-del');
			Route::get('/admin-pick-post-slap-view-edit','Admin\Dashboard\PickPostMountBracket\PickPostMountBracketController@viewEditActionChange')->name('admin.pick-post-slap-action-view-edit');
			Route::post('/admin-pick-post-slap-edit/{id}','Admin\Dashboard\PickPostMountBracket\PickPostMountBracketController@editActionChange')->name('admin.pick-post-slap-action-edit');
			// Pick canopy
			Route::get('/add-pick-canopy','Admin\Dashboard\PickCanopy\PickCanopyController@showPage')->name('admin.add-pick-canopy');
			Route::post('/admin-submit-pick-canopy','Admin\Dashboard\PickCanopy\PickCanopyController@submitOverheadShades')->name('admin.submit-pick-canopy');
			Route::get('/admin-show-pick-canopy','Admin\Dashboard\PickCanopy\PickCanopyController@showOverheadShades')->name('admin.show-pick-canopy');
			Route::get('/admin-pick-canopy-change','Admin\Dashboard\PickCanopy\PickCanopyController@overheadShadesActionChange')->name('admin.pick-canopy-action-change');

			Route::get('/admin-pick-canopy-del','Admin\Dashboard\PickCanopy\PickCanopyController@changeActionDel')->name('admin.pick-canopy-action-del');
			Route::get('/admin-pick-canopy-view-edit','Admin\Dashboard\PickCanopy\PickCanopyController@getActionEdit')->name('admin.pick-canopy-action-view-edit');
			Route::post('/admin-pick-canopy-edit/{id}','Admin\Dashboard\PickCanopy\PickCanopyController@changeActionEdit')->name('admin.pick-canopy-action-edit');
			// Pick Louvered Panel
			Route::get('/add-pick-panel','Admin\Dashboard\PickLouveredPanel\PickLouveredPanelController@showPage')->name('admin.add-pick-panel');
			Route::post('/admin-submit-pick-panel','Admin\Dashboard\PickLouveredPanel\PickLouveredPanelController@submitOverheadShades')->name('admin.submit-pick-panel');
			Route::get('/admin-show-pick-panel','Admin\Dashboard\PickLouveredPanel\PickLouveredPanelController@showOverheadShades')->name('admin.show-pick-panel');
			Route::get('/admin-pick-panel-change','Admin\Dashboard\PickLouveredPanel\PickLouveredPanelController@overheadShadesActionChange')->name('admin.pick-panel-action-change');

			Route::get('/admin-pick-panel-del','Admin\Dashboard\PickLouveredPanel\PickLouveredPanelController@changeActionDel')->name('admin.pick-panel-action-del');
			Route::get('/admin-pick-panel-view-edit','Admin\Dashboard\PickLouveredPanel\PickLouveredPanelController@getActionEdit')->name('admin.pick-panel-action-view-edit');
			Route::post('/admin-pick-panel-edit/{id}','Admin\Dashboard\PickLouveredPanel\PickLouveredPanelController@changeActionEdit')->name('admin.pick-panel-action-edit');
			// combination panel
			Route::get('/combination-panel','Admin\Dashboard\CombinationPanel\CombinationController@index')->name('admin.combination-panel');
			Route::get('/combination-panel-show','Admin\Dashboard\CombinationPanel\CombinationController@showActualData')->name('admin.combination-panel-show');
			Route::post('/combination-panel-add','Admin\Dashboard\CombinationPanel\CombinationController@addActualData')->name('admin.combination-panel-add');
			Route::get('/combination-panel-show-tbl','Admin\Dashboard\CombinationPanel\CombinationController@show_l_panel_data_fx')->name('admin.combination-panel-show-tbl');
			Route::get('/combination-panel-edit','Admin\Dashboard\CombinationPanel\CombinationController@edit_combination_panel')->name('admin.combination-panel-edit');
			Route::post('/combination-panel-edit-submit/{my_data}','Admin\Dashboard\CombinationPanel\CombinationController@submit_combination_panel')->name('admin.combination-panel-edit-submit');
			Route::get('/combination-panel-action-change','Admin\Dashboard\CombinationPanel\CombinationController@edit_combination_action_change')->name('admin.combination-panel-action-change');
			Route::get('/combination-panel-del','Admin\Dashboard\CombinationPanel\CombinationController@del_combination_panel')->name('admin.combination-panel-del');

			// Pick Final Product
			Route::get('/add-final-product','Admin\Dashboard\FinalProduct\FinalProductController@showPage')->name('admin.add-final-product');
			Route::post('/admin-submit-final-product','Admin\Dashboard\FinalProduct\FinalProductController@submitOverheadShades')->name('admin.submit-final-product');
			Route::get('/admin-show-final-product','Admin\Dashboard\FinalProduct\FinalProductController@showOverheadShades')->name('admin.show-final-product');
			Route::get('/admin-final-product-change','Admin\Dashboard\FinalProduct\FinalProductController@overheadShadesActionChange')->name('admin.final-product-action-change');

			Route::get('/admin-final-product-del','Admin\Dashboard\FinalProduct\FinalProductController@delActionFx')->name('admin.final-product-action-del');
			Route::get('/admin-final-product-view-edit','Admin\Dashboard\FinalProduct\FinalProductController@viewEditActionFx')->name('admin.final-product-action-view-edit');
			Route::post('/admin-final-product-edit/{id}','Admin\Dashboard\FinalProduct\FinalProductController@editActionFx')->name('admin.final-product-action-edit');
				// choose footprint
				Route::get('/choose-footprint-final-product','Admin\Dashboard\FinalProduct\FinalProductController@choose_footprint_fx')->name('admin.choose-footprint-final-product');
				// choose Posts length
				Route::get('/choose-post-length-final-product','Admin\Dashboard\FinalProduct\FinalProductController@choose_post_length_fx')->name('admin.choose-post-length-final-product');
				// choose Posts length
				Route::get('/choose-overhead-shades-final-product','Admin\Dashboard\FinalProduct\FinalProductController@choose_overhead_shades_fx')->name('admin.choose-overhead-shades-final-product');
		// end of pick-up-footprint (outside post to post)

		// dashboard all panel counts
			Route::get('/dashboard-all-count','AdminController@dashboard_all_count_fx')->name('admin.final-total-product-lists');
		// end of dashboard all panel counts
		/// order details
		Route::get('/order-details','Admin\Dashboard\Payment\PaymentController@showpage')->name('admin.order-details');
		Route::get('/order-details-data','Admin\Dashboard\Payment\PaymentController@showActionPage')->name('admin.order-details-actual');
		Route::get('/order-details-change-status','Admin\Dashboard\Payment\PaymentController@changeAction')->name('admin.order-details-change-status');
		/// order details
		
	// end of dashboard panel
});
// end of admin routing

// user panel routing
Route::group(['prefix' => '/'], function(){
	// first page
	Route::get('/','Front\MainHomeController@index')->name('satirtha.home');
	Route::get('/get-master-width-choose','Front\MainHomeController@choose_master_width_fx')->name('satirtha.choose-master-width');
	Route::get('/get-master-height-choose','Front\MainHomeController@choose_master_height_fx')->name('satirtha.choose-master-height');
	Route::get('/get-master-post-choose','Front\MainHomeController@choose_master_post_fx')->name('satirtha.choose-master-post');

	Route::get('/get-master-width-change','Front\MainHomeController@change_master_width_fx')->name('satirtha.change-master-width');
	Route::get('/get-master-height-change','Front\MainHomeController@change_master_height_fx')->name('satirtha.change-master-height');

	Route::get('/choose-master-post-wish-price-frame','Front\MainHomeController@choose_master_post_wish_price_fx')->name('satirtha.choose-master-post-wish-price-frame');

	// second page
	Route::get('/show-second-page-data','Front\MainHomeController@show_overheads_fx2')->name('satirtha.show-second-page-data');
	Route::get('/choose-second-page-data','Front\MainHomeController@choose_overheads_fx2')->name('satirtha.choose-second-page-data');

	// third page
	Route::get('/show-third-page-data','Front\MainHomeController@show_3d_video_fx3')->name('satirtha.show-third-page-data');

	// fourth page
	Route::get('/show-fourth-page-data','Front\MainHomeController@show_pick_post_length_fx4')->name('satirtha.show-fourth-page-data');
	Route::get('/choose-fourth-page-data','Front\MainHomeController@choose_pick_post_length_fx4')->name('satirtha.choose-fourth-page-data');

	// fifth page
	Route::get('/show-fifth-page-data','Front\MainHomeController@show_pick_post_mount_fx5')->name('satirtha.show-fifth-page-data');
	Route::get('/choose-fifth-page-data','Front\MainHomeController@choose_pick_post_mount_fx5')->name('satirtha.choose-pick-slap-fx5');

	// sixth page
	Route::get('/show-sixth-page-data','Front\MainHomeController@show_pick_canopy_fx6')->name('satirtha.show-sixth-page-data');

	// seventh page
	Route::get('/show-seventh-page-data','Front\MainHomeController@show_pick_lpanel_fx7')->name('satirtha.show-seventh-page-data');

	// final page
	Route::get('/show-final-page-data','Front\MainHomeController@showFinalPage')->name('satirtha.show-final-page-data');

	// payment page
	Route::get('/payment','Front\PaymentHomeController@showPage')->name('satirtha.show-payment');
	Route::get('/payment-submit-panel','Front\PaymentHomeController@getDataFx')->name('satirtha.payment-submit-panel');
	Route::get('/payment-load-price-panel','Front\PaymentHomeController@get_final_pricelist')->name('satirtha.payment-load-price-panel');
	Route::get('/BeforeCheckoutFinalProduct','Front\BeforeCheckoutFinalProductController@saveData')->name('satirtha.BeforeCheckoutFinalProduct');

	// generate pdf
	Route::get('/generate-pdf','Front\BeforeCheckoutFinalProductController@generate_pdf')->name('satirtha.generate-pdf');
	
	Route::get('/generate-last-pdf','Front\BeforeCheckoutFinalProductController@generate_pdf_load')->name('satirtha.generate-last-pdf');
	
	// mail sending
	Route::get('/send-my-mail','SendMailCOntroller@index')->name('satirtha.send-my-mail');
	Route::get('/email-form','SendMailCOntroller@show_send_mail_form_fx')->name('satirtha.email-form');


	/// paypal pay
	Route::get('/paypal-payment', 'PayPalController@index');
	// route for processing payment
	Route::post('paypal', 'PayPalController@payWithpaypal');
	// route for check status of the payment
	Route::get('status', 'PayPalController@getPaymentStatus');

	/// end of paypal pay
	/// back to home 
	Route::get('back-to-home-page','Front\backtohome\BackToHomeController@index')->name('satirtha.backToHomePage');
	Route::get('back-to-home-page-forget-session','Front\backtohome\BackToHomeController@forget_s_fx')->name('satirtha.forget-new-session-back-to-home');
	Route::get('show-page-loading-after-back','Front\backtohome\BackToHomeController@showPageRequest')->name('satirtha.show-page-loading-after-back');
	// back to home session panel show
	Route::get('main_pass_load_back_home_panel_session','Front\backtohome\BackToHomeController@backingRequestQuery')->name('satirtha.main_pass_load_back_home_panel_session');

	/// back to thank you
	Route::get('/thank-you','Front\backtohome\BackToHomeController@show_thankyou_fx')->name('satirtha.show-thank-you-page');
	/// thank you --- order details
	Route::get('/payment-order-admin','Front\backtohome\BackToHomeController@payment_order_admin_fx')->name('satirtha.payment-order-admin');

	/// error page --- order details
	Route::get('/error-page','Front\backtohome\BackToHomeController@show_errorpage_fx')->name('satirtha.show-error-page');


});
