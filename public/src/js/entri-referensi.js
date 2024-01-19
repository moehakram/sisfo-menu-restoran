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
    });
   

    $('.tampilModalUbah').on('click', function() {
        
        $('#modalTitle').html('Ubah Data');
        $('.modal-footer button[type=submit]').html('Ubah Data');
        $('.modal-body form').attr('action', '/entri-referensi/ubah');
        let imageUrl = ($(this).closest('tr').find('img').attr('src')).split('/');

        const id = $(this).data('id');
            $.ajax({
                url: '/entri-referensi/getUbah',
                data: {id : id, image : imageUrl[imageUrl.length-1]},
                method: 'post',
                dataType: 'json',
                success: function(data) {
                    $('#id').val(data['id']);           
                    $('#nama').val(data['nama']);
                    $('#jenis').val(data['jenis']);          
                    $('#harga').val(data['harga']);
                    $('#stok').val(data['stok']);
                    $('#status').val(data['status']);
            }
        });
            
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
                    type: 'POST',
                    url: '/entri-referensi/hapus',
                    data: { id: idmenu, image: decodeURIComponent(imageUrl) },
                    success: function () {
                        Swal.fire({
                            title: 'Sukses!',
                            text: 'Menu berhasil dihapus.',
                            icon: 'success'
                        }).then(() => {
                            location.reload();
                        });
                    },
                    error: function (error) {
                        console.error('Error:', error);
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
