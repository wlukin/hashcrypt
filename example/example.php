<?php

require(dirname(__FILE__).'/../lib/HashCryptMd5.php');
require(dirname(__FILE__).'/../lib/HashCryptSha1.php');

for($i=0; $i<20; $i++) $string .= "It works!:) ";
$passwordEncoding = '1234567890';
$passwordDecoding = '1234567890';
$cryptClass = 'HashCryptMd5';

p($string);

//encoding
$stringOFB = $cryptClass::lib()->encodeOFB($string, $passwordEncoding);
$stringCFB = $cryptClass::lib()->encodeCFB($string, $passwordEncoding);

hex($stringOFB);
hex($stringCFB);

//decoding
$stringOFB = $cryptClass::lib()->decodeOFB($stringOFB, $passwordDecoding);
$stringCFB = $cryptClass::lib()->decodeCFB($stringCFB, $passwordDecoding);

p($stringOFB);
p($stringCFB);

function p($s){
    echo "<p>".$s."</p>";
}

function hex($s){
    p(bin2hex($s));
}