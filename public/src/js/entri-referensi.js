$(function() {
    
    
    $('.tombolTambahData').on('click', function() {
        const jenis = $(this).data('jenis');
        $('#modalTitle').html('Tambah Data ' + jenis);
        $('.modal-footer button[type=submit]').html('Tambah Data');
        $('#id').val();
        $('#nama').val();
        $('#jenis').val(jenis);
        $('#harga').val();
        $('#stok').val();
        $('#formModal').modal('toggle');
    });

    let pathImg;

    $('.tampilModalUbah').on('click', function() {
        pathImg = decodeURIComponent(new URL($(this).closest('tr').find('img').attr('src')).pathname);
        pathImg = pathImg.substring(pathImg.lastIndexOf('/')+1);
        
        $('#modalTitle').html('Ubah Data');
        $('.modal-footer button[type=submit]').html('Ubah Data');
        $('.modal-body form').attr('action', '/entri-referensi/ubah');

        const id = $(this).data('id');
        $.ajax({
            url: '/entri-referensi/getUbah',
            data: {id : id},
            method: 'post',
            dataType: 'json',
            success: function(data) {
                $('#id').val(data['id']);           
                $('#nama').val(data['nama']);
                $('#jenis').val(data['jenis']);          
                $('#harga').val(data['harga']);
                $('#stok').val(data['stok']);
                $('#status').val(data['status']);
                $('#formModal').modal('toggle');
            }
        });
            
    });

    function tambahMenu() {
        const formData = new FormData($('.modal-body form')[0]);        
        $.ajax({
            url: '/entri-referensi/tambahMenu',
            method: 'post',
            data: formData,
            processData: false,
            contentType: false,
            dataType: 'json',
            success: function(response) {
                if (response.status === 'success') {
                    $('#formModal').modal('toggle');
                    Swal.fire({
                        title: 'Sukses!',
                        text: response.pesan,
                        icon: 'success'
                    }).then(() => {
                        location.reload();
                    });
                } else {
                    Swal.fire({
                        text: response.pesan,
                        icon: 'warning'
                    })
                }
            },
            error: function(xhr, status, error) {
                Swal.fire({
                    title: 'Error!',
                    text: 'Terjadi kesalahan saat tambah menu.',
                    icon: 'error'
                });
            }
        });
    }


    function updateMenu() {
        const formData = new FormData($('.modal-body form')[0]);
        
        formData.append('oldImage', pathImg);
        
        $.ajax({
            url: '/entri-referensi/ubah',
            method: 'post',
            data: formData,
            processData: false,
            contentType: false,
            dataType: 'json',
            success: function(response) {
                if (response.status === 'success') {
                    $('#formModal').modal('toggle');
                    Swal.fire({
                        title: 'Sukses!',
                        text: response.pesan,
                        icon: 'success'
                    }).then(() => {
                        location.reload();
                    });
                } else {
                    Swal.fire({
                        text: response.pesan,
                        icon: 'warning'
                    })
                }
            },
            error: function () {
                Swal.fire({
                    title: 'Error!',
                    text: 'Terjadi kesalahan saat update menu.',
                    icon: 'error'
                });
            }
        });
    }
 
$('.modal-body form').submit(function(e) {
    e.preventDefault();
    if (typeof pathImg === 'undefined') {
        tambahMenu();
    } else {
        updateMenu();
    }
});
    
    $('.hapus-menu').on('click', function () {
        let idmenu = $(this).data('id');
        let imageUrl = new URL($(this).closest('tr').find('img').attr('src')).pathname;
        Swal.fire({
            title: 'Kamu yakin ingin hapus?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, hapus'
        }).then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    method: 'POST',
                    url: '/entri-referensi/hapus',
                    data: { id: idmenu, pathImage: decodeURIComponent(imageUrl) },
                    dataType: 'json',                    
                    success: function (respon) {
                        Swal.fire({
                            title: respon.status + '!',
                            text: respon.pesan,
                            icon: respon.status
                        }).then(() => {
                            location.reload();
                        });
                    },
                    error: function () {
                        Swal.fire({
                            title: 'Error!',
                            text: 'Terjadi kesalahan saat menghapus menu.',
                            icon: 'error'
                        });
                    }
                });
            }
        });
    });
});
