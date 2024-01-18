<?php

use App\Middleware\{MustLoginMiddleware, MustNotLoginMiddleware, Role};


$router->get('/', 'CustomerController@index');
$router->get("/home", "CustomerController@home", [MustLoginMiddleware::class]);
$router->get("/pesan-menu", "CustomerController@pesanMenu", [MustLoginMiddleware::class]);
$router->post("/getdata", "CustomerController@getMenu", [MustLoginMiddleware::class]);
$router->post("/checkout", "CustomerController@postCheckout", [MustLoginMiddleware::class]);
$router->get("/checkout", "CustomerController@checkout", [MustLoginMiddleware::class]);
$router->get("/getTableNumbers", "CustomerController@getMeja", [MustLoginMiddleware::class]);

$router->get("/user/register", "UserController@register", [MustNotLoginMiddleware::class]);
$router->post("/user/register", "UserController@postRegister", [MustNotLoginMiddleware::class]);

$router->get("/user/login", "UserController@login", [MustNotLoginMiddleware::class]);
$router->post("/user/login", "UserController@postLogin", [MustNotLoginMiddleware::class]);

$router->get("/user/logout", "UserController@logout", [MustLoginMiddleware::class]);

$router->get("/user/profile", "UserController@updateProfile", [MustLoginMiddleware::class]);
$router->post("/user/profile", "UserController@postUpdateProfile", [MustLoginMiddleware::class]);

$router->get("/user/password", "UserController@updatePassword", [MustLoginMiddleware::class]);
$router->post("/user/password", "UserController@postupdatePassword", [MustLoginMiddleware::class]);

$router->get("/entri-referensi", "EntriReferensiController@index", [MustLoginMiddleware::class, Role::ADMIN]);
$router->post("/entri-referensi/tambahMenu", "EntriReferensiController@tambahMenu", [MustLoginMiddleware::class, Role::ADMIN]);
$router->post("/entri-referensi/getUbah", "EntriReferensiController@getUbah", [MustLoginMiddleware::class, Role::ADMIN]);
$router->post("/entri-referensi/ubah", "EntriReferensiController@editMenu", [MustLoginMiddleware::class, Role::ADMIN]);
$router->get("/entri-referensi/hapus", "EntriReferensiController@hapus", [MustLoginMiddleware::class, Role::ADMIN]);

$router->get("/entri-order", "EntriOrderanController@index", [MustLoginMiddleware::class, Role::ADMIN]);
$router->post("/entri-order/getdata", "EntriOrderanController@getMenu", [MustLoginMiddleware::class, Role::ADMIN]);
$router->post("/entri-order/checkout", "EntriOrderanController@postCheckout", [MustLoginMiddleware::class, Role::ADMIN]);
$router->get("/entri-order/checkout", "EntriOrderanController@checkout", [MustLoginMiddleware::class, Role::ADMIN]);

$router->get("/entri-pegawai", "EntriPegawaiController@index", [MustLoginMiddleware::class, Role::ADMIN]);
$router->post("/entri-pegawai/tambah", "EntriPegawaiController@tambahPegawai", [MustLoginMiddleware::class, Role::ADMIN]);
$router->get("/entri-pegawai/hapus", "EntriPegawaiController@hapus", [MustLoginMiddleware::class, Role::ADMIN]);
$router->post("/entri-pegawai/getUbah", "EntriPegawaiController@getUbah", [MustLoginMiddleware::class, Role::ADMIN]);
$router->post("/entri-pegawai/ubah", "EntriPegawaiController@ubah", [MustLoginMiddleware::class, Role::ADMIN]);

$router->get("/entri-transaksi", "EntriTransaksiController@index", [MustLoginMiddleware::class, Role::ADMIN]);
$router->post("/entri-transaksi", "EntriTransaksiController@search", [MustLoginMiddleware::class, Role::ADMIN]);
$router->get("/entri-transaksi/bayar", "EntriTransaksiController@finalcheckout", [MustLoginMiddleware::class, Role::ADMIN]);
$router->post("/entri-transaksi/bayar", "EntriTransaksiController@bayarOrder", [MustLoginMiddleware::class, Role::ADMIN]);
$router->post("/entri-transaksi/hapus", "EntriTransaksiController@hapusOrder", [MustLoginMiddleware::class, Role::ADMIN]);
$router->post("/entri-transaksi/selesai", "EntriTransaksiController@statusSelesai", [MustLoginMiddleware::class, Role::ADMIN]);

$router->get("/entri-transaksi/invoice", "EntriTransaksiController@viewInvoice", [MustLoginMiddleware::class, Role::ADMIN]);

$router->get("/generate-laporan", "GenerateLaporanController@index", [MustLoginMiddleware::class, Role::ADMIN]);
$router->get("/generate-laporan/print", "GenerateLaporanController@printLaporan", [MustLoginMiddleware::class, Role::ADMIN]);



$router->get('/:name', function() {
    $GLOBALS['response']->redirect("/");
});