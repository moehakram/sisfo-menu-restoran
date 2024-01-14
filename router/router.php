<?php

use App\Middleware\{MustLoginMiddleware, MustNotLoginMiddleware, Role};


$router->get('/', 'HomeController@index');

// $router->get('/dashboard', 'HomeController@dashboard', [MustLoginMiddleware::class, Role::ADMIN]);

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
$router->post("/entri-referensi/ubah", "EntriReferensiController@ubah", [MustLoginMiddleware::class, Role::ADMIN]);
$router->get("/entri-referensi/hapus", "EntriReferensiController@hapus", [MustLoginMiddleware::class, Role::ADMIN]);

$router->get("/entri-order", "EntriOrderController@index", [MustLoginMiddleware::class, Role::ADMIN]);
$router->post("/entri-order/getdata", "EntriOrderController@getData", [MustLoginMiddleware::class, Role::ADMIN]);
$router->post("/entri-order/checkout", "EntriOrderController@postCheckout", [MustLoginMiddleware::class, Role::ADMIN]);
$router->get("/entri-order/checkout", "EntriOrderController@checkout", [MustLoginMiddleware::class, Role::ADMIN]);

$router->get("/home", "CustomerController@index", [MustLoginMiddleware::class]);
$router->get("/pesan-menu", "CustomerController@index", [MustLoginMiddleware::class]);
$router->get("/pesan-meja", "ReservasiController@pesanMeja", [MustLoginMiddleware::class]);
$router->post("/pesan-meja", "ReservasiController@bookingMeja", [MustLoginMiddleware::class]);
$router->post("/getdata", "PesanController@getData", [MustLoginMiddleware::class]);
$router->post("/checkout", "ReservasiController@postCheckout", [MustLoginMiddleware::class]);
$router->get("/checkout", "ReservasiController@checkout", [MustLoginMiddleware::class]);
$router->get("/getTableNumbers", "PesananController@meja", [MustLoginMiddleware::class]);

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