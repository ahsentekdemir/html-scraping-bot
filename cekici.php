<?php
require "vendor/autoload.php";
include __DIR__."/curl.php";
include __DIR__."/simple_html_dom.php";
include __DIR__."/func.php";

use PHPHtmlParser\Dom;

class Cekici extends curl {

    public function prepare_header($client){
        parent::setUseragent("okhttp/4.5.0");
        // parent::addHeader("");
    }

    public function getData($product_link){
        $data = parent::get($product_link);
        if(!$data or empty($data)){
            return false;
        }
        $data = str_get_html($data);
        $data = preg_replace('/<script\b[^>]*>(.*?)<\/script>/is', "", $data);
        $dom = new Dom;
        $file = fopen("input.html", "w+");
        fwrite($file, $data);
        $data = str_get_html($data);
 
        $file_read = fopen("input.html", "r");
        
    }

}