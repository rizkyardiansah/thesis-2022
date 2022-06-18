$(function () {
  $("#formTambahKegiatan #durasiKegiatan").daterangepicker();
  $("#formUbahKegiatan #durasiKegiatan").daterangepicker();

  $("#formTambahKegiatan").validate({
    errorClass: "text-danger",
    errorElement: "small",
    submitHandler: function (form) {
      form.submit();
    },
  });
  $("#formUbahKegiatan").validate({
    errorClass: "text-danger",
    errorElement: "small",
    submitHandler: function (form) {
      form.submit();
    },
  });

  $("#kegiatanSkripsi .ubah-kegiatan").on("click", function (e) {
    const id = $(this).data("id");
    const namaKegiatan = $(this)
      .parent()
      .parent()
      .children(".nama-kegiatan")
      .text();
    const tanggalKegiatan = $(this)
      .parent()
      .parent()
      .children(".tanggal-kegiatan")
      .text();
    const tanggalMulai = moment(
      tanggalKegiatan.split(" - ")[0],
      "DD/MMM/YYYY"
    ).format("MM-DD-YYYY");
    const tanggalSelesai = moment(
      tanggalKegiatan.split(" - ")[1],
      "DD/MMM/YYYY"
    ).format("MM-DD-YYYY");

    $("#formUbahKegiatan").attr(
      "action",
      `${BASE_URL}fakultas/updateKalender/${id}`
    );
    $("#formUbahKegiatan #id").val(id);
    $("#formUbahKegiatan #namaKegiatan").val(namaKegiatan);
    $("#formUbahKegiatan #durasiKegiatan").daterangepicker({
      startDate: tanggalMulai,
      endDate: tanggalSelesai,
    });
    $("#ubahKegiatan").modal("show");
    console.log(id);
  });

  $("#kegiatanSkripsi #formHapusKegiatan").on("submit", function (e) {
    e.preventDefault();
    Swal.fire({
      title: "Apakah anda ingin menghapus kegiatan ini?",
      text: "Kegiatan yang sudah dihapus tidak dapat dikembalikan",
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

  if ($("#flashdata").data("open") == true) {
    Swal.fire(
      $("#flashdata #title").text(),
      $("#flashdata #text").text(),
      $("#flashdata #icon").text()
    );
  }

  $("#kegiatanSkripsi").DataTable({
    columnDefs: [
      {
        targets: [0, 2, 3],
        className: "text-center",
      },
      {
        targets: 3,
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

function ubahKegiatan(id) {
  $("#ubahKegiatan").modal("show");

  $.ajax({
    type: "get",
    async: false,
    url: `${BASE_URL}kalenderskripsi/getbyid/${id}`,
    dataType: "json",
  })
    .done((result) => {
      $("#ubahKegiatan #id").val(result.id);
      $("#ubahKegiatan #namaKegiatan").val(result.nama_kegiatan);
      $("#ubahKegiatan #durasiKegiatan").daterangepicker({
        startDate: moment(result.tanggal_mulai).format("MM/DD/YYYY"),
        endDate: moment(result.tanggal_selesai).format("MM/DD/YYYY"),
      });
    })
    .fail((error) => {
      console.log(error);
    });
}
