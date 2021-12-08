<?php

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

function createStdClass($keyValues = []) {
    $cls = new \stdClass();
    foreach($keyValues as $key => $value) {
        $cls->$key = $value;
    }
    return $cls;
}

function generateRandomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}

function deleteImage($imageUrl){
    unlink(public_path() .$imageUrl);
    return "ok";
}

// Currency

function rupiah($angka){
    $hasil_rupiah = "Rp " . number_format($angka,2,',','.');
    return $hasil_rupiah;
}

// DateTime

function getDateMonth($date){
    $date = date('d-m-Y', strtotime($date));
    return $date;
}

function getDateName($date){
    $date = Carbon::parse($date)->locale('id')->isoFormat('LL');
    return $date;
}

function getDateFullName($date){
    $date = Carbon::parse($date)->locale('id')->isoFormat('dddd, D MMMM Y');
    return $date;
}

// String Text

function slug($slug){
    $slug = Str::slug($slug, '-');
    return $slug;
}

function title($title){
    $converted = Str::title($title);
    return $converted;
}

function upperText($text){
    $string = Str::upper($text);
    return $string;
}

function countText($text){
    $string = Str::wordCount($text);
    return $string;
}

function urlCurrent(){
    $current = url()->current();
    return $current;
}

function urlPrevious(){
    $previous = url()->previous();
    return $previous;
}



