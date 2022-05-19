$(function () {
  $("#kegiatanSkripsi").DataTable();

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

  // $("#formTambahKegiatan").submit(tambahKegiatan);

  // $("#formUbahKegiatan").submit(updateKegiatan);
});

// function tambahKegiatan(e) {
//   e.preventDefault();
//   const namaKegiatan = $("#formTambahKegiatan #namaKegiatan").val();
//   if (namaKegiatan == null || namaKegiatan == "") {
//     return Swal.fire(
//       "Tambah Kegiatan Gagal",
//       "Nama kegiatan tidak boleh kosong",
//       "error"
//     );
//   }
//   const tanggalMulai = $("#formTambahKegiatan #durasiKegiatan")
//     .data("daterangepicker")
//     .startDate.format("YYYY-MM-DD");
//   const tanggalSelesai = $("#formTambahKegiatan #durasiKegiatan")
//     .data("daterangepicker")
//     .endDate.format("YYYY-MM-DD");

//   if (
//     tanggalMulai == moment(Date.now()).format("YYYY-MM-DD") &&
//     tanggalMulai == tanggalSelesai
//   ) {
//     return Swal.fire(
//       "Tambah Kegiatan Gagal",
//       "Durasi Kegiatan kurang tepat",
//       "error"
//     );
//   }

//   $.ajax({
//     type: "Post",
//     url: `${BASE_URL}kalenderskripsi/insert`,
//     data: {
//       nama_kegiatan: namaKegiatan,
//       tanggal_mulai: tanggalMulai,
//       tanggal_selesai: tanggalSelesai,
//     },
//   })
//     .done((result) => {
//       window.location.assign(`${BASE_URL}kalenderskripsi/index`);
//       return Swal.fire(
//         "Tambah Kegiatan Berhasil",
//         "Kegiatan berhasil ditambahkan",
//         "success"
//       );
//     })
//     .fail((error) => {
//       console.log(error);
//       return Swal.fire(
//         "Tambah Kegiatan Gagal",
//         "Terjadi kesalahan server",
//         "error"
//       );
//     });
// }

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

// function updateKegiatan(e) {
//   e.preventDefault();
//   const namaKegiatan = $("#formUbahKegiatan #namaKegiatan").val();
//   if (namaKegiatan == null || namaKegiatan == "") {
//     return Swal.fire(
//       "Tambah Kegiatan Gagal",
//       "Nama kegiatan tidak boleh kosong",
//       "error"
//     );
//   }
//   const tanggalMulai = $("#formUbahKegiatan #durasiKegiatan")
//     .data("daterangepicker")
//     .startDate.format("YYYY-MM-DD");
//   const tanggalSelesai = $("#formUbahKegiatan #durasiKegiatan")
//     .data("daterangepicker")
//     .endDate.format("YYYY-MM-DD");

//   if (
//     tanggalMulai == moment(Date.now()).format("YYYY-MM-DD") &&
//     tanggalMulai == tanggalSelesai
//   ) {
//     return Swal.fire(
//       "Tambah Kegiatan Gagal",
//       "Durasi Kegiatan kurang tepat",
//       "error"
//     );
//   }

//   const id = $("#formUbahKegiatan #id").val();
//   console.log(id, namaKegiatan, tanggalMulai, tanggalSelesai);
//   $.ajax({
//     type: "post",
//     url: `${BASE_URL}kalenderskripsi/update/${id}`,
//     async: false,
//     data: {
//       nama_kegiatan: namaKegiatan,
//       tanggal_mulai: tanggalMulai,
//       tanggal_selesai: tanggalSelesai,
//     },
//   })
//     .done((result) => {
//       window.location.assign(`${BASE_URL}kalenderskripsi/index`);
//       return Swal.fire(
//         "Ubah Kegiatan Berhasil",
//         "Kegiatan berhasil diubah",
//         "success"
//       );
//     })
//     .fail((error) => {
//       console.log(error);
//       return Swal.fire(
//         "Ubah Kegiatan Gagal",
//         "Terjadi kesalahan server",
//         "error"
//       );
//     });
// }

// function hapusKegiatan(id) {
//   Swal.fire({
//     title: "Apakah anda ingin menghapus kegiatan ini?",
//     text: "Kegiatan yang sudah dihapus tidak dapat dikembalikan",
//     icon: "warning",
//     showCancelButton: true,
//     confirmButtonColor: "#3085d6",
//     cancelButtonColor: "#d33",
//     confirmButtonText: "Ya, Hapus!",
//     cancelButtonText: "Batal",
//   }).then((result) => {
//     if (result.isConfirmed) {
//       $.ajax({
//         type: "post",
//         async: false,
//         url: `${BASE_URL}kalenderskripsi/delete/${id}`,
//       })
//         .done((result) => {
//           Swal.fire(
//             "Hapus Kegiatan Berhasil",
//             "Kegiatan Berhasil dihapus",
//             "success"
//           );
//           window.location.assign(`${BASE_URL}kalenderskripsi/index`);
//         })
//         .fail((error) => {
//           console.log(error);
//           return Swal.fire(
//             "Tambah Kegiatan Gagal",
//             "Terjadi kesalahan server",
//             "error"
//           );
//         });
//     }
//   });
// }
