$(function() {
    
    
    $('.tombolTambahPegawai').on('click', function() {
        const jenis = $(this).data('jenis');
        $('#modalTitle').html('Tambah Data ');
        $('.modal-footer button[type=submit]').html('Tambah Data');
        $('#id').val('');
        $('#nama').val('');
        $('#jabtan').val(jenis);
        $('#gaji').val('');
    });
   

    $('.tampilModalUbahPegawai').on('click', function() {
        
        $('#modalTitle').html('Ubah Data');
        $('.modal-footer button[type=submit]').html('Ubah Data');
        $('.modal-body form').attr('action', '/entri-pegawai/ubah');
        
        const id = $(this).data('id');
            $.ajax({
                url: '/entri-pegawai/getUbah',
                data: {id : id},
                method: 'post',
                dataType: 'json',
                success: function(data) {
                    $('#id').val(data['212360_id']);           
                    $('#nama').val(data['212360_nama']);
                    $('#jabatan').val(data['212360_jabatan']);          
                    $('#gaji').val(data['212360_gaji']);         
            }
        });
            
    });


    $('.hapus-pegawai').on('click', function () {
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
                window.location.href = "/entri-pegawai/hapus?id=" + idmenu;
            }
        })
    });
    

  

});
