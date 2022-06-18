$(function () {
  $("#formTambahPenelitian").validate({
    rules: {
      judul: {
        required: true,
        minlength: 20,
        maxlength: 255,
      },
      deskripsi: {
        required: true,
        minlength: 20,
        maxlength: 500,
      },
      bidang: {
        required: true,
      },
      jumlah_peneliti: {
        required: true,
        number: true,
        range: [1, 10],
      },
    },
    errorClass: "text-danger",
    errorElement: "small",
    submitHandler: function (form) {
      form.submit();
    },
  });

  $("#formUbahPenelitian").validate({
    rules: {
      judul: {
        required: true,
        minlength: 20,
        maxlength: 255,
      },
      deskripsi: {
        required: true,
        minlength: 20,
        maxlength: 500,
      },
      bidang: {
        required: true,
      },
      jumlah_peneliti: {
        required: true,
        number: true,
        range: [1, 10],
      },
      status: {
        required: true,
      },
    },
    errorClass: "text-danger",
    errorElement: "small",
    submitHandler: function (form) {
      form.submit();
    },
  });

  $(".ubah-penelitian").on("click", function () {
    const parent = $(this).parent().parent();
    const id = $(this).data("id");
    const judul = parent.children(".judul").text();
    const deskripsi = parent.children(".deskripsi").text();
    const id_bidang = parent.children(".bidang").data("id");
    const jumlah_peneliti = parent
      .children(".jumlah_peneliti")
      .text()
      .split(" ")[0];
    const status = parent.children(".status").text();

    $("#formUbahPenelitian").attr(
      "action",
      `${BASE_URL}dosen/updatePenelitian/${id}`
    );
    $("#formUbahPenelitian #judul").text(judul);
    $("#formUbahPenelitian #deskripsi").text(deskripsi);
    $("#formUbahPenelitian #bidang").val(id_bidang);
    $("#formUbahPenelitian #jumlah_peneliti").val(jumlah_peneliti);
    $("#formUbahPenelitian #status").val(status);

    $("#ubahPenelitian").modal("show");
  });

  //untuk sweetalert
  if ($("#flashdata").data("open") == true) {
    Swal.fire(
      $("#flashdata #title").text(),
      $("#flashdata #text").text(),
      $("#flashdata #icon").text()
    );
  }

  $("#daftarPenelitian").DataTable({
    columnDefs: [
      {
        targets: [0, 3, 4, 5, 6],
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
