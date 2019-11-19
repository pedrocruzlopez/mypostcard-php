<?php
/**
 * Created by PhpStorm.
 * User: pedrocruzdev
 * Date: 11/16/19
 * Time: 21:09
 */


require 'includes/config.php';



/**
 *  Get the list of the Design store
 * @param String $url URL of the endpoint
 * @return json the data retrieved
 */
function get_list($url)
{

    $handle = curl_init();
    curl_setopt($handle, CURLOPT_URL, $url);
    curl_setopt($handle, CURLOPT_RETURNTRANSFER, true);
    $data = curl_exec($handle);
    curl_close($handle);

    return $data;

}

/**
 *  Displays site url provided in config.
 */
function site_url()
{
    return config('site_url');
}

/**
 *  Displays site url provided in config.
 */

function page_title()
{
    return config('name');
}

/**
 * Displays site version.
 */
function site_version()
{
    echo config('version');
}


/**
 * Retrieve and convert the Design list
 * @return mixed
 */
function get_list_array(){
    $data_string = get_list(config('design_list_endpoint'));
    $data = json_decode($data_string);
    $list = $data->content;
    return $list;
}

/**
 * Get the add on prices
 * @param $id Id of the product
 * @return array Array with 4 elements, each element contains the different prices
 */

function get_add_on_prices($id){
    $data_str = get_list(config('design_price_endpoint').$id);
    $data = json_decode($data_str);
    $res = [];
    array_push($res, floatval($data->products[0]->product_options->XXL->price));
    array_push($res, floatval($data->products[0]->product_options->Envelope->price));
    array_push($res, floatval($data->products[0]->product_options->Premium->price));
    array_push($res, floatval($data->products[0]->product_options->XL->price));
    return $res;
}


/**
 * Main function
 */

function init()
{
    require config('template_path') . '/index.php';
}

init();

