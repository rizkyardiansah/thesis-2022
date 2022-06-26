$(function () {
  $("#editSkripsi").validate({
    rules: {
      judul: {
        required: true,
        minlength: 20,
        maxlength: 300,
      },
      bidang: {
        required: true,
      },
      sifat: {
        required: true,
      },
      sumber: {
        required: true,
      },
      file_skripsi: {
        required: true,
        extension: "pdf",
        filesize: 10000000,
      },
    },
    messages: {
      file_skripsi: {
        extension: "File harus berekstensi PDF",
        filesize: "File tidak boleh melebihi 10MB",
      },
    },
    errorClass: "text-danger",
    errorElement: "small",
    errorPlacement: function (error, element) {
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

  //BASE_URL didapatkan dari constant.js
  //kalo mau deploy BASE_URL harus diubah
  $("#tinjauSkripsi").on("click", function () {
    const file = $(this).parent().parent().children("input").val();
    const id = $(this).data("id");

    $("#filePreview").modal("show");
    $("#filePreviewLabel").text("Tinjau File Final Skripsi");
    $("#previewContainer iframe").attr(
      "src",
      `${BASE_URL}folderSkripsi/${file}`
    );
    $("#filePreview #formHapus").attr(
      "action",
      `${BASE_URL}mahasiswa/deleteSkripsi/${id}`
    );
    $("#filePreview #formUnduh").attr(
      "action",
      `${BASE_URL}mahasiswa/downloadSkripsi/${id}`
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
