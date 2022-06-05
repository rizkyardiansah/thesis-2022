$(function () {
  $("#tableSkripsi").DataTable({
    columnDefs: [
      {
        targets: [0, 2, 3, 4, 5, 6, 7, 8, 9],
        className: "text-center",
      },
      {
        targets: 9,
        searchable: false,
        orderable: false,
      },
      {
        targets: "_all",
        className: "align-middle",
      },
    ],
  });

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

  $("#formUbahSkripsi").validate({
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

  $("#formUploadSkripsi").validate({
    rules: {
      file_skripsi: {
        required: true,
        extension: "pdf",
        filesize: 2048000,
      },
    },
    messages: {
      file_skripsi: {
        extension: "File harus berekstensi PDF",
        filesize: "File tidak boleh melebihi 2MB",
      },
    },
    errorClass: "text-danger",
    errorElement: "small",
    errorPlacement: function (error, element) {
      console.log(element.attr("type") == "file");
      if (element.attr("type") == "file") {
        error.insertAfter(element.parent().parent());
      } else {
        error.insertAfter(element);
      }
    },
    submitHandler: function (form) {
      form.submit();
    },
  });

  jQuery.validator.addMethod(
    "filesize",
    function (value, element, param) {
      return this.optional(element) || element.files[0].size <= param;
    },
    "Ukuran file melebihi batas"
  );

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

  $("#tableSkripsi .upload-skripsi").on("click", function () {
    const idSkripsi = $(this).data("id");
    $("#uploadSkripsi").modal("show");
    $("#formUploadSkripsi").attr(
      "action",
      `${BASE_URL}mahasiswa/uploadFileSkripsi/${idSkripsi}`
    );
  });

  //untuk nampilin nama file
  $("input[type='file']").on("change", function (e) {
    $(`label[for="${e.target.id}"]`).text(e.target.files[0].name);
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
