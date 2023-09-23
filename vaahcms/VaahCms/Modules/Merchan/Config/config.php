<?php

return [
    "name"=> "Merchan",
    "title"=> "Merchan Module ",
    "slug"=> "merchan",
    "thumbnail"=> "https://img.site/p/300/160",
    "is_dev" => env('MODULE_MERCHAN_ENV')?true:false,
    "excerpt"=> "This will contain various cruds like customer and channel",
    "description"=> "This will contain various cruds like customer and channel",
    "download_link"=> "",
    "author_name"=> "vaah",
    "author_website"=> "https://vaah.dev",
    "version"=> "0.0.1",
    "is_migratable"=> true,
    "is_sample_data_available"=> true,
    "db_table_prefix"=> "vh_merchan_",
    "providers"=> [
        "\\VaahCms\\Modules\\Merchan\\Providers\\MerchanServiceProvider"
    ],
    "aside-menu-order"=> null
];
