<?php
error_reporting(0);
require "vendor/autoload.php";

include_once 'cekici.php';
include_once 'fonksiyonlar.php';


use PHPHtmlParser\Dom;
use Stichoza\GoogleTranslate\GoogleTranslate;


$tr = new GoogleTranslate('en');

$cek = new Cekici();
$url = "";
$cek->getData($url);


$dom = new Dom;
$dom->loadFromFile('input.html');
$title = $dom->find('.title-holder');



