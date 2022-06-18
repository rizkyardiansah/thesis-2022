$(function () {
  $("#formTambahHasilBimbingan #tanggalBimbingan").daterangepicker({
    singleDatePicker: true,
  });

  $("#formTambahHasilBimbingan").validate({
    rules: {
      pembimbing: {
        required: true,
      },
      tanggalBimbingan: {
        required: true,
      },
      materi: {
        required: true,
        maxlength: 150,
      },
    },
    errorClass: "text-danger",
    errorElement: "small",
    submitHandler: function (form) {
      form.submit();
    },
  });

  $("#formUbahHasilBimbingan").validate({
    rules: {
      pembimbing: {
        required: true,
      },
      tanggalBimbingan: {
        required: true,
      },
      materi: {
        required: true,
        maxlength: 150,
      },
    },
    errorClass: "text-danger",
    errorElement: "small",
    submitHandler: function (form) {
      form.submit();
    },
  });

  $(".ubah-catatan").on("click", function () {
    $("#ubahCatatan").modal("show");
    const idCatatan = $(this).data("id");
    const parent = $(this).parent().parent();
    const tanggal = moment(
      parent.children(".tanggal").text(),
      "DD-MM-YYYY"
    ).format("MM/DD/YYYY");
    console.log(tanggal);
    const hasil = parent.children(".hasil").text();
    const idPembimbing = parent.children(".dosen").data("id");

    $("#formUbahHasilBimbingan #pembimbing").val(idPembimbing);
    $("#formUbahHasilBimbingan #tanggalBimbingan").daterangepicker({
      singleDatePicker: true,
      startDate: tanggal,
    });
    $("#formUbahHasilBimbingan #materi").text(hasil);

    $("#formUbahHasilBimbingan").attr(
      "action",
      `${BASE_URL}mahasiswa/updateHasilBimbingan/${idCatatan}`
    );
  });

  $("#tableBimbingan #formHapusCatatan").on("submit", function (e) {
    e.preventDefault();
    Swal.fire({
      title: "Apakah anda ingin menghapus Catatan ini?",
      text: "Catatan yang sudah dihapus tidak dapat dikembalikan",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#3085d6",
      cancelButtonColor: "#d33",
      confirmButtonText: "Ya, Hapus!",
      cancelButtonText: "Batal",
    }).then((result) => {
      if (result.isConfirmed) {
        e.target.submit();
      }
    });
  });

  //untuk sweetalert
  if ($("#flashdata").data("open") == true) {
    Swal.fire(
      $("#flashdata #title").text(),
      $("#flashdata #text").text(),
      $("#flashdata #icon").text()
    );
  }

  $("#tableBimbingan").DataTable({
    columnDefs: [
      {
        targets: [0, 1, 5, 6],
        className: "text-center",
      },
      {
        targets: 6,
        searchable: false,
        orderable: false,
      },
      {
        targets: "_all",
        className: "align-middle",
      },
    ],
  });
});
