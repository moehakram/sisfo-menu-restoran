<!-- Begin Page Content -->
<section>
<div class="container" data-aos="fade-up">
    <!-- Page Heading -->
    <h1 class="h3 my-3 text-gray-800">Daftar Pesanan</h1>
    <p class="mb-4">Selamat datang di halaman daftar pesanan. Berikut adalah rincian pesanan yang telah Anda buat.</p>

    <!-- Notifikasi -->
    <div class="row">
        <div class="col-md-6 mb-4">
            <div class="card shadow">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Notifikasi</h6>
                </div>
                <div class="card-body">
                    <!-- Container Notifikasi -->
                    <div class="container px-4">
                        <!-- Notifikasi Berhasil -->
                        <div class="alert alert-success" role="alert">
                            <h4 class="alert-heading">Selamat!</h4>
                            <p>Selamat, pesanan Anda telah berhasil diterima. Kami akan segera menyiapkan pesanan Anda.</p>
                            <hr>
                            <p class="mb-0">Terima kasih atas kepercayaan Anda.</p>
                        </div>
                        <!-- /Notifikasi Berhasil -->
                    </div>
                    <!-- /Container Notifikasi -->
                </div>
            </div>
        </div>
        <!-- /Notifikasi -->
        
        <!-- Menu Yang Dipesan -->
        <div class="col-md-6">
            <div class="card">
                <h5 class="card-header">Menu Yang Dipesan</h5>
                <div class="card-body px-3">
                    <!-- Tabel Pesanan -->
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr class="text-center">
                                <th>No.</th>
                                <th>Menu</th>
                                <th>Jumlah</th>
                                <th>Harga per Porsi</th>
                                <th>SubTotal Harga</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i=1; $total=0; foreach($data['pesanan'] as $pesanan ) : ?>
                            <tr class="text-center">
                                <td><?= $i++ ?></td>
                                <td><?= $pesanan->menuNama ?></td>
                                <td><?= $pesanan->jumlah ?></td>
                                <td><?= $pesanan->menuHarga ?></td>
                                <td><?= $pesanan->subTotal ?></td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                        <tfoot class="text-center">
                            <tr>
                                <th colspan="4">Total Harga</th>
                                <td><?= $data['order']->totalHarga ?></td>
                            </tr>
                            <tr>
                                <th colspan="4">Nomor Meja</th>
                                <td><?= $data['order']->noMeja ?></td>
                            </tr>
                        </tfoot>
                    </table>
                    <!-- /Tabel Pesanan -->
                </div>
            </div>
        </div>
        <!-- /Menu Yang Dipesan -->
    </div>
    <!-- /Row -->
    </div>
</section>
<!-- /.container-fluid -->
