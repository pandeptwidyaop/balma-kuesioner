<?php

/**
 * SION FW
 *
 * FILE index.php
 * Framework ini dibuat berdasarkan kebutuhan kepanitiaan yang menggunakan sion sebagai pendukung kegiatan.
 * Hanya mendukung koneksi database dengan driver ODBC
 * Untuk server sion saat Framework ini dibuat masih menggunakan
 * Apache 2.2 dan PHP 5.3 makanya nggak bisa makek Framework lain (Laravel, CI) :P .
 * Dibuat dan dikembakan oleh Pande mengatasnamakan PROGRESS
 * Untuk para penerus, silakan kembangan FW ini
 */

require_once __DIR__.'/autoload.php';

use core\Route;

$kernel = new Route($_GET);
$controller = $kernel->getController();
$controller->ExecuteAction();
