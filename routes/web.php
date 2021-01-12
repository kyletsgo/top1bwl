<?php

Route::group(['namespace' => 'Web', 'prefix' => 'page'], function () {
    Route::get('/{folder_name}/{page_id}', 'PageController@showPage');
    Route::post('/save_form', 'PageController@saveForm');
});

Route::group(['middleware' => 'web', 'prefix' => 'backend'], function () {
    Route::auth();

    Route::group(['middleware' => 'auth:web', 'namespace' => 'Backend'], function () {
        Route::post('/logout', function() {
            Auth::logout();
            return redirect('/backend');
        });

        Route::get('/', ['as' => 'backend.index', 'uses' => 'IndexController@index']);

        Route::get('/password', 'PasswordController@index');
        Route::post('/password', 'PasswordController@update');

        Route::get('/menu', 'MenuController@index');
        Route::get('/menu/create', 'MenuController@create');
        Route::post('/menu/store', 'MenuController@store');
        Route::get('/menu/{id}', 'MenuController@edit');
        Route::post('/menu/{id}', 'MenuController@update');
        Route::delete('/menu/{id}', 'MenuController@delete');

        Route::get('/menu/{menuId}/function', 'FunctionController@index');
        Route::get('/menu/{menuId}/function/create', 'FunctionController@create');
        Route::post('/menu/{menuId}/function/store', 'FunctionController@store');
        Route::get('/menu/{menuId}/function/{id}', 'FunctionController@edit');
        Route::post('/menu/{menuId}/function/{id}', 'FunctionController@update');
        Route::delete('/menu/{menuId}/function/{id}', 'FunctionController@delete');

        Route::get('/group', 'GroupController@index');
        Route::get('/group/create', 'GroupController@create');
        Route::post('/group/store', 'GroupController@store');
        Route::get('/group/{id}', 'GroupController@edit');
        Route::post('/group/{id}', 'GroupController@update');
        Route::delete('/group/{id}', 'GroupController@delete');

        // 會員管理
        Route::get('/user', 'UserController@index');
        Route::get('/user/create', 'UserController@createPage');
        Route::post('/user/create', 'UserController@create');
        Route::get('/user/edit/{id}', 'UserController@editPage');
        Route::post('/user/edit/{id}', 'UserController@edit');
        Route::post('/user/delete', 'UserController@delete');
        Route::post('/user/release_auth', 'UserController@releaseAuth');

        // 網站管理
        Route::get('/site_management', 'SiteManagementController@index');
        Route::post('/site_management', 'SiteManagementController@index');
        Route::get('/site_management/create', 'SiteManagementController@createPage');
        Route::post('/site_management/create', 'SiteManagementController@create');
        Route::get('/site_management/edit/{id}', 'SiteManagementController@editPage');
        Route::post('/site_management/edit', 'SiteManagementController@edit');
        Route::post('/site_management/enable_site', 'SiteManagementController@enableSite');

        // 資源管理
        Route::get('/resource_manage/edit', 'ResourceManageController@edit');

        // 網頁管理
        Route::get('/page_manage', 'PageManageController@index');
        Route::post('/page_manage', 'PageManageController@index');
        Route::get('/page_manage/create_select_template', 'PageManageController@selectTemplatePage');
        Route::post('/page_manage/create_page', 'PageManageController@createPage');
        Route::post('/page_manage/create', 'PageManageController@create');
        Route::get('/page_manage/edit/{id}', 'PageManageController@editPage');
        Route::post('/page_manage/edit', 'PageManageController@edit');

        // 推廣表單
        Route::get('/promote_form', 'PromoteFormController@index');

        // 行事曆區
        Route::get('/calendar', 'CalendarController@show');
    });
});
