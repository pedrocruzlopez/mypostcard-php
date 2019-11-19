<?php

function config($key = '')
{
    $config = [
        'name' => 'My Postcard - Code Challenge',
        'site_url' => '',
        'template_path' => 'templates',
        'content_path' => 'content',
        'version' => 'v1.0',
        'design_list_endpoint' => 'https://appdsapi-6aa0.kxcdn.com/content.php?lang=de&json=1&search_text=berlin&currencyiso=EUR',
        'design_price_endpoint' => 'https://www.mypostcard.com/mobile/product_prices.php?json=1&type=get_postcard_products&currencyiso=EUR&store_id='
    ];
    return isset($config[$key]) ? $config[$key] : null;
}