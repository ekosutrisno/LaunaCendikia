$(function () {

   $('[data-toggle="tooltip"]').tooltip()

   $('.tombolTambahData').on('click', function () {
      $('#formModalLabel').html('Tambah Data Anggota')
      $('.modal-footer button[type=submit]').html('Tambah Data');
   });

   $('.tampilModalUbah').on('click', function () {

      $('#formModalLabel').html('Ubah Data Anggota')
      $('.modal-footer button[type=submit]').html('Ubah Data');
      $('.modal-body form').attr('action', 'http://localhost/websitelc/public/anggota/ubah')

      const id = $(this).data('id');
      $.ajax({


         url: 'http://localhost/websitelc/public/anggota/getUbah',
         data: {
            id: id
         },
         method: 'post',
         dataType: 'json',
         success: function (data) {

            $('#nama').val(data.nama);
            $('#nis').val(data.nis);
            $('#email').val(data.email);
            $('#kelas').val(data.kelas);
            $('#id').val(data.id);
         }
      });

   });
});