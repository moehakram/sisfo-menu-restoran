$(function() {
    
    
    $('.tombolTambahData').on('click', function() {
        const jenis = $(this).data('jenis');
        $('#modalTitle').html('Tambah Data ' + jenis);
        $('.modal-footer button[type=submit]').html('Tambah Data');
        $('#id').val('');
        $('#nama').val('');
        $('#jenis').val(jenis);
        $('#harga').val('');
        $('#stok').val('');
    });
   

    $('.tampilModalUbah').on('click', function() {
        
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
                    $('#id').val(data['213049_id']);           
                    $('#nama').val(data['213049_menu_nama']);
                    $('#jenis').val(data['213049_menu_jenis']);          
                    $('#harga').val(data['213049_menu_harga']);
                    $('#stok').val(data['213049_menu_stok']);
                    $('#status').val(data['213049_idstatus']);          
            }
        });
            
    });


    $('.hapus-menu').on('click', function () {
        let idmenu = $(this).data('id');
        Swal.fire({
            title: 'Kamu yakin ingin hapus?',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Yes, hapus'
        }).then((result) => {
            if (result.isConfirmed) {
                window.location.href = "/entri-referensi/hapus?id=" + idmenu;
            }
        })
    });
    

  

});
