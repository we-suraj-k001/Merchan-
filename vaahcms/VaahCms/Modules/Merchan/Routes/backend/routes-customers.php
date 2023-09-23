<?php

Route::group(
    [
        'prefix' => 'backend/merchan/customers',
        
        'middleware' => ['web', 'has.backend.access'],
        
        'namespace' => 'Backend',
],
function () {
    /**
     * Get Assets
     */
    Route::get('/assets', 'CustomersController@getAssets')
        ->name('vh.backend.merchan.customers.assets');
    /**
     * Get List
     */
    Route::get('/', 'CustomersController@getList')
        ->name('vh.backend.merchan.customers.list');
    /**
     * Update List
     */
    Route::match(['put', 'patch'], '/', 'CustomersController@updateList')
        ->name('vh.backend.merchan.customers.list.update');
    /**
     * Delete List
     */
    Route::delete('/', 'CustomersController@deleteList')
        ->name('vh.backend.merchan.customers.list.delete');


    /**
     * Fill Form Inputs
     */
    Route::any('/fill', 'CustomersController@fillItem')
        ->name('vh.backend.merchan.customers.fill');

    /**
     * Create Item
     */
    Route::post('/', 'CustomersController@createItem')
        ->name('vh.backend.merchan.customers.create');
    /**
     * Get Item
     */
    Route::get('/{id}', 'CustomersController@getItem')
        ->name('vh.backend.merchan.customers.read');
    /**
     * Update Item
     */
    Route::match(['put', 'patch'], '/{id}', 'CustomersController@updateItem')
        ->name('vh.backend.merchan.customers.update');
    /**
     * Delete Item
     */
    Route::delete('/{id}', 'CustomersController@deleteItem')
        ->name('vh.backend.merchan.customers.delete');

    /**
     * List Actions
     */
    Route::any('/action/{action}', 'CustomersController@listAction')
        ->name('vh.backend.merchan.customers.list.actions');

    /**
     * Item actions
     */
    Route::any('/{id}/action/{action}', 'CustomersController@itemAction')
        ->name('vh.backend.merchan.customers.item.action');

    //---------------------------------------------------------

});
