$(function () {
  $("#tableSkripsi").DataTable();

  $("#formTambahSkripsi").validate({
    rules: {
      judul: {
        required: true,
        minlength: 20,
        maxlength: 300,
      },
      sifat: {
        required: true,
      },
      sumber: {
        required: true,
      },
      bidang: {
        required: true,
      },
    },
    errorClass: "text-danger",
    errorElement: "small",
    submitHandler: function (form) {
      form.submit();
    },
  });

  $("#tableSkripsi .ubah-skripsi").on("click", function () {
    const parent = $(this).parent().parent();
    const judul = parent.children(".judul").text();
    const idSkripsi = parent.children(".judul").data("id");
    const idBidang = parent.children(".bidang").data("id");
    const sifat = parent.children(".sifat").text();
    const sumber = parent.children(".sumber").text();

    $("#ubahSkripsi").modal("show");
    $("#formUbahSkripsi").attr(
      "action",
      `${BASE_URL}mahasiswa/updateSkripsi/${idSkripsi}`
    );

    $("#formUbahSkripsi #judul").text(judul);
    $("#formUbahSkripsi #sifat").val(sifat);
    $("#formUbahSkripsi #sumber").val(sumber);
    $("#formUbahSkripsi #bidang").val(idBidang);
  });
  //untuk sweetalert
  if ($("#flashdata").data("open") == true) {
    Swal.fire(
      $("#flashdata #title").text(),
      $("#flashdata #text").text(),
      $("#flashdata #icon").text()
    );
  }
});
