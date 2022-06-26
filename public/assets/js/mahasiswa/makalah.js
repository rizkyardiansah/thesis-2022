$(function () {
  $("#formUploadMakalah").validate({
    rules: {
      judul: {
        required: true,
        minlength: 20,
        maxlength: 255,
      },
      deskripsi: {
        required: true,
        minlength: 20,
        maxlength: 255,
      },
      kata_kunci: {
        required: true,
        minlength: 20,
        maxlength: 70,
      },
      bidang: {
        required: true,
      },
      file_makalah: {
        required: true,
        extension: "pdf",
        filesize: 10000000,
      },
    },
    messages: {
      file_makalah: {
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
  $("#tinjauMakalah").on("click", function () {
    const file = $(this).parent().parent().children("input").val();
    const id = $(this).data("id");

    $("#filePreview").modal("show");
    $("#filePreviewLabel").text("Tinjau File Makalah");
    $("#previewContainer iframe").attr(
      "src",
      `${BASE_URL}folderMakalah/${file}`
    );
    $("#filePreview #formHapus").attr(
      "action",
      `${BASE_URL}mahasiswa/deleteMakalah/${id}`
    );
    $("#filePreview #formUnduh").attr(
      "action",
      `${BASE_URL}home/downloadMakalah/${id}`
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
