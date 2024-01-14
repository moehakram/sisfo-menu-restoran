                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">Entri Transaksi</h1>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <div class="row">
                                <div class="col-md">
                                    <h6 class="m-0 font-weight-bold text-primary">Belum Bayar</h6>
                                </div>
                                <div class="col-md-4">
                                    <form action="/entri-transaksi" method="post">
                                        <div class="input-group">
                                            <input type="text" class="form-control" name="keyword" autocomplete="off" value="<?= $_POST['keyword']?? '' ?>"
                                                placeholder="Search by id-order, id-admin, nomor-meja ...">
                                            <div class="input-group-append">
                                                <button class="btn btn-primary" type="submit">Search</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-auto" id="dataTable" width="100%"
                                    cellspacing="0">
                                    <thead>
                                        <tr class="text-center">
                                            <th>Nomor Meja</th>
                                            <th>Pemesan</th>
                                            <th>Total Harga</th>
                                            <th class="w-25">Aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        
                                        foreach($data['tx_belumBayar'] as $belumbayar): ?>
                                        <tr>
                                            <td><?= $belumbayar['nom_meja'] ?></td>
                                            <td><?= $belumbayar['pemesan'] ?></td>
                                            <td><?= formatRupiah($belumbayar['total_harga']) ?></td>
                                            <td><a role="button"
                                                    href="/entri-transaksi/bayar?id=<?= $belumbayar['idorder']; ?>"><svg
                                                        xmlns="http://www.w3.org/2000/svg" width="26" height="26"
                                                        fill="blue" class="bi bi-pen-fill" viewBox="0 0 16 16">
                                                        <path
                                                            d="m13.498.795.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001z" />
                                                    </svg></a>
                                                <button class="hapus-order" data-id="<?= $belumbayar['idorder'];?>"><svg
                                                        xmlns="http://www.w3.org/2000/svg" width="26" height="26"
                                                        fill="red" class="bi bi-trash3-fill" viewBox="0 0 16 16">
                                                        <path
                                                            d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5Zm-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5ZM4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06Zm6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528ZM8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5Z" />
                                                    </svg></button>
                                            </td>
                                        </tr>
                                        <?php endforeach; ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Transaksi Terdahulu</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-auto" id="dataTable" width="100%"
                                    cellspacing="0">
                                    <thead>
                                        <tr class="text-center">
                                            <th>No.</th>
                                            <th>Waktu pesan</th>
                                            <th>Nama pemesan</th>
                                            <th>No. Meja</th>
                                            <th>Total Harga</th>
                                            <th>Aksi</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <?php $i=1; foreach($data['tx_terdahulu'] as $terdahulu): ?>
                                        <tr>
                                            <td><?= $i++ ?></td>
                                            <td><?= $terdahulu['waktu_pesan'] ?></td>
                                            <td><?= $terdahulu['pemesan'] ?></td>
                                            <td><?= $terdahulu['nom_meja'] ?></td>
                                            <td><?= formatRupiah($terdahulu['total_harga']) ?></td>
                                            <td><a href="/entri-transaksi/invoice?id=<?= $terdahulu['idorder'] ?>&nama=<?= $terdahulu['pemesan'] ?>"
                                                    class="btn btn-success">Lihat Struk</a>
                                                <button data-id="<?= $terdahulu['idorder'] ?>"
                                                    class="btn btn-danger hapus-orderFix">hapus</button></td>
                                        </tr>

                                        <?php endforeach; ?>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->