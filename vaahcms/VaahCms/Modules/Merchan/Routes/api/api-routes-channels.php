<?php

/*
 * API url will be: <base-url>/public/api/merchan/channels
 */
Route::group(
    [
        'prefix' => 'merchan/channels',
        'namespace' => 'Backend',
    ],
function () {

    /**
     * Get Assets
     */
    Route::get('/assets', 'ChannelsController@getAssets')
        ->name('vh.backend.merchan.api.channels.assets');
    /**
     * Get List
     */
    Route::get('/', 'ChannelsController@getList')
        ->name('vh.backend.merchan.api.channels.list');
    /**
     * Update List
     */
    Route::match(['put', 'patch'], '/', 'ChannelsController@updateList')
        ->name('vh.backend.merchan.api.channels.list.update');
    /**
     * Delete List
     */
    Route::delete('/', 'ChannelsController@deleteList')
        ->name('vh.backend.merchan.api.channels.list.delete');


    /**
     * Create Item
     */
    Route::post('/', 'ChannelsController@createItem')
        ->name('vh.backend.merchan.api.channels.create');
    /**
     * Get Item
     */
    Route::get('/{id}', 'ChannelsController@getItem')
        ->name('vh.backend.merchan.api.channels.read');
    /**
     * Update Item
     */
    Route::match(['put', 'patch'], '/{id}', 'ChannelsController@updateItem')
        ->name('vh.backend.merchan.api.channels.update');
    /**
     * Delete Item
     */
    Route::delete('/{id}', 'ChannelsController@deleteItem')
        ->name('vh.backend.merchan.api.channels.delete');

    /**
     * List Actions
     */
    Route::any('/action/{action}', 'ChannelsController@listAction')
        ->name('vh.backend.merchan.api.channels.list.action');

    /**
     * Item actions
     */
    Route::any('/{id}/action/{action}', 'ChannelsController@itemAction')
        ->name('vh.backend.merchan.api.channels.item.action');



});
