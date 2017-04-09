<?php

 function base_url($link="",$atRoot=FALSE, $atCore=FALSE, $parse=FALSE){
  include __DIR__.'/../config/config.php';
  if ($config['base_url'] == '') {
    if (isset($_SERVER['HTTP_HOST'])) {
        $http = isset($_SERVER['HTTPS']) && strtolower($_SERVER['HTTPS']) !== 'off' ? 'https' : 'http';
        $hostname = $_SERVER['HTTP_HOST'];
        $dir =  str_replace(basename($_SERVER['SCRIPT_NAME']), '', $_SERVER['SCRIPT_NAME']);
        $core = preg_split('@/@', str_replace($_SERVER['DOCUMENT_ROOT'], '', realpath(dirname(__FILE__))), NULL, PREG_SPLIT_NO_EMPTY);
        $core = $core[0];
        $tmplt = $atRoot ? ($atCore ? "%s://%s/%s/" : "%s://%s/") : ($atCore ? "%s://%s/%s/" : "%s://%s%s");
        $end = $atRoot ? ($atCore ? $core : $hostname) : ($atCore ? $core : $dir);
        $base_url = sprintf( $tmplt, $http, $hostname, $end );
    }
    else $base_url = 'http://localhost/';
      
    if ($parse) {
        $base_url = parse_url($base_url);
        if (isset($base_url['path'])) if ($base_url['path'] == '/') $base_url['path'] = '';
    }

    return ($link == '') ? $base_url : $base_url.$link;
  }else {
    return($link == '') ? $config['base_url'].'/'.$link : $config['base_url'].$link;;
  }
}

function redirect($link)
{
    return header('Location:'.$link);
}

function public_path($file)
{
    return "public/$file";
}
