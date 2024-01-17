   <!-- Begin Page Content -->
   <div class="container px-2">
       <!-- Page Heading -->
       <h1 class="h3 mb-2 text-gray-800">Entri Referensi</h1>
       <?php if(!empty($data['pesan'])): ?>
               <div class="alert alert-warning" role="alert">
                   <?= $data['pesan'] ?>
               </div>
            <?php endif ?>

       <!-- DataTales Example -->
       <div class="card shadow mb-4">
        
           <div class="card-header py-3">
               <h6 class="m-0 font-weight-bold text-primary">Referensi Makanan</h6>
               <!-- Button trigger modal -->
               <button type="button" class="btn btn-primary tombolTambahData float-right mb-4 mr-4" data-toggle="modal"
                   data-target="#formModal" data-jenis="makanan">
                   Tambah data
               </button>
             

               <div class="card-body">
                   <!-- makanan  -->
                   <div class="table-responsive">
                       <table class="table table-bordered table-auto" id="dataTable" width="100%" cellspacing="0">
                           <thead>
                               <tr class="text-center">
                                   <th>Nama Makanan</th>
                                   <th>Harga/porsi</th>
                                   <th>Stok</th>
                                   <th>Status</th>
                                   <th>Gambar</th>
                                   <th colspan="2">Aksi</th>
                               </tr>
                           <tbody>
                               <?php
                foreach($data['makanan'] as $makanan): ?>
                               <tr>
                                   <td><?= $makanan->nama ; ?></td>
                                   <td><?= formatRupiah($makanan->harga) ; ?></td>
                                   <td><?= $makanan->stok ; ?></td>
                                   <td><?= $makanan->status ; ?></td>
                                   <td>
                                       <img width="100px"
                                           src="<?= SRC_UPLOAD.'entri-makanan/'.$makanan->gambar; ?>" alt="no">
                                   </td>
                                   <td class="grid grid-cols-2 gap-2">
                                       <button type="button" class="btn btn-warning tampilModalUbah"
                                           data-id="<?= $makanan->id; ?>" data-jenis="makanan" role="button"
                                           data-toggle="modal" data-target="#formModal">Edit</button>
                                       <!-- <a class="btn btn-danger"
                                           href="/entri-referensi/hapus?id=<?= $makanan->id; ?>" role="button">Hapus</a> -->
                                       <button class="btn btn-danger hapus-menu" data-id="<?= $makanan->id; ?>">Hapus</button>
                                   </td>
                               </tr>
                               <?php endforeach;?>

                           </tbody>
                       </table>
                   </div>
                   <!-- /makanan  -->
               </div>
           </div>
       </div>
       <!-- DataTales Example -->
       <div class="card shadow mb-4">
           <div class="card-header py-3">
               <h6 class="m-0 font-weight-bold text-primary">Referensi Minuman</h6>
               <!-- Button trigger modal -->
               <button type="button" class="btn btn-primary tombolTambahData float-right mb-4 mr-4" data-toggle="modal"
                   data-target="#formModal" data-jenis="minuman">
                   Tambah data
               </button>

               <div class="card-body">
                   <div class="table-responsive">
                       <table class="table table-bordered table-auto" id="dataTable" width="100%" cellspacing="0">
                           <thead>
                               <tr class="text-center">
                                   <th>Nama Minuman</th>
                                   <th>Harga/porsi</th>
                                   <th>Stok</th>
                                   <th>Status</th>
                                   <th>Gambar</th>
                                   <th colspan="2">Aksi</th>
                               </tr>
                           <tbody>
                               <?php
               
                foreach($data['minuman'] as $minuman): ?>
                               <tr>
                                   <td><?= $minuman->nama ; ?></td>
                                   <td><?= formatRupiah($minuman->harga) ; ?></td>
                                   <td><?= $minuman->stok ; ?></td>
                                   <td><?= $minuman->status ; ?></td>
                                   <td>
                                       <img width="100px"
                                           src="<?= SRC_UPLOAD .'entri-minuman/'.$minuman->gambar; ?>"
                                           alt="no">
                                   </td>
                                   <td class="grid grid-cols-2 gap-2">
                                       <button type="button" class="btn btn-warning tampilModalUbah"
                                           data-id="<?= $minuman->id; ?>" data-jenis="minuman" role="button"
                                           data-toggle="modal" data-target="#formModal">Edit</button>
                                       <a class="btn btn-danger"
                                           href="/entri-referensi/hapus?id=<?= $minuman->id; ?>&jenis=minuman"
                                           role="button">Hapus</a>
                                   </td>
                               </tr>
                               <?php endforeach;?>

                           </tbody>
                       </table>
                   </div>
               </div>
           </div>
       </div>

       <!-- modal data  -->
       <div class="modal fade" id="formModal" tabindex="-1" aria-labelledby="modalTitle" aria-hidden="true">
           <div class="modal-dialog modal-dialog-centered">
               <div class="modal-content">
                   <div class="modal-header">
                       <h5 class="modal-title" id="modalTitle">Tambah Data</h5>
                       <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                           <span aria-hidden="true">&times;</span>
                       </button>
                   </div>
                   <div class="modal-body shadow">
                       <form action="/entri-referensi/tambahMenu" enctype="multipart/form-data" method="post">
                           <input type="hidden" id="jenis" name="jenis" value="">
                           <input type="hidden" id="id" name="id" value="">
                           <label for="nama">Nama Menu</label>
                           <input type="text" class="form-control" id="nama" name="nama" placeholder="Nama menu">
                           <label for="harga">Harga</label>
                           <input type="number" class="form-control" id="harga" name="harga" placeholder="harga">
                           <label for="stok">Stok</label>
                           <input type="number" class="form-control" id="stok" name="stok" placeholder="stok">
                           <label for="status">Status</label>
                           <select class="form-control" name="status" id="status">
                               <option value=1>Tersedia</option>
                               <option value=2>Tidak Tersedia</option>
                           </select>
                           <label for="gambar">gambar</label>
                           <input type="file" class="form-control" accept="image/jpg, image/png, image/jpeg"
                               name="gambar" id="gambar">

                   </div>
                   <div class="modal-footer">
                       <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                       <button type="submit" class="btn btn-primary">Tambah</button>
                   </div>
                   </form>
               </div>
           </div>
       </div>

       <!-- /modal data  -->