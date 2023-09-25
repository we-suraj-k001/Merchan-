<?php

Route::group(
    [
        'prefix' => 'backend/merchan/channels',

        'middleware' => ['web', 'has.backend.access'],

        'namespace' => 'Backend',
],
function () {
    /**
     * Get Assets
     */
    Route::get('/assets', 'ChannelsController@getAssets')
        ->name('vh.backend.merchan.channels.assets');
    /**
     * Get List
     */
    Route::get('/', 'ChannelsController@getList')
        ->name('vh.backend.merchan.channels.list');
    /**
     * Update List
     */
    Route::match(['put', 'patch'], '/', 'ChannelsController@updateList')
        ->name('vh.backend.merchan.channels.list.update');
    /**
     * Delete List
     */
    Route::delete('/', 'ChannelsController@deleteList')
        ->name('vh.backend.merchan.channels.list.delete');


    /**
     * Fill Form Inputs
     */
    Route::any('/fill', 'ChannelsController@fillItem')
        ->name('vh.backend.merchan.channels.fill');

    /**
     * Create Item
     */
    Route::post('/', 'ChannelsController@createItem')
        ->name('vh.backend.merchan.channels.create');
    /**
     * Get Item
     */
    Route::get('/{id}', 'ChannelsController@getItem')
        ->name('vh.backend.merchan.channels.read');
    /**
     * Update Item
     */
    Route::match(['put', 'patch'], '/{id}', 'ChannelsController@updateItem')
        ->name('vh.backend.merchan.channels.update');
    /**
     * Delete Item
     */
    Route::delete('/{id}', 'ChannelsController@deleteItem')
        ->name('vh.backend.merchan.channels.delete');

    /**
     * List Actions
     */
    Route::any('/action/{action}', 'ChannelsController@listAction')
        ->name('vh.backend.merchan.channels.list.actions');

    /**
     * Item actions
     */
    Route::any('/{id}/action/{action}', 'ChannelsController@itemAction')
        ->name('vh.backend.merchan.channels.item.action');

    //---------------------------------------------------------
    /**
     * Search Customers
     */
    Route::post('/search/customers', 'ChannelsController@searchCustomers')
        ->name('vh.backend.merchan.channels.customer.search');

});
