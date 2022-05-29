$(function () {
  $("#editPengajuan").validate({
    rules: {
      file_draft_final: {
        required: true,
        extension: "pdf",
        filesize: 2048000,
      },
      file_form_bimbingan: {
        required: true,
        extension: "pdf",
        filesize: 2048000,
      },
      file_persyaratan_sidang: {
        required: true,
        extension: "pdf",
        filesize: 2048000,
      },
    },
    messages: {
      file_draft_final: {
        extension: "File harus berekstensi PDF",
        filesize: "File tidak boleh melebihi 2MB",
      },
      file_form_bimbingan: {
        extension: "File harus berekstensi PDF",
        filesize: "File tidak boleh melebihi 2MB",
      },
      file_persyaratan_sidang: {
        extension: "File harus berekstensi PDF",
        filesize: "File tidak boleh melebihi 2MB",
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
  $("#tinjauDraftFinal").on("click", function () {
    const file = $(this).parent().parent().children("input").val();
    const id = $(this).data("id");

    $("#filePreview").modal("show");
    $("#filePreviewLabel").text("Tinjau File Draft Final Skripsi");
    $("#previewContainer iframe").attr(
      "src",
      `${BASE_URL}folderDraftFinal/${file}`
    );
    $("#filePreview #formHapus").attr(
      "action",
      `${BASE_URL}mahasiswa/deleteDraftFinal/${id}`
    );
    $("#filePreview #formUnduh").attr(
      "action",
      `${BASE_URL}mahasiswa/downloadDraftFinal/${id}`
    );
  });

  //BASE_URL didapatkan dari constant.js
  //kalo mau deploy BASE_URL harus diubah
  $("#tinjauFormBimbingan").on("click", function () {
    const file = $(this).parent().parent().children("input").val();
    const id = $(this).data("id");

    $("#filePreview").modal("show");
    $("#filePreviewLabel").text("Tinjau File Form Bimbingan Skripsi");
    $("#previewContainer iframe").attr(
      "src",
      `${BASE_URL}folderFormBimbingan/${file}`
    );
    $("#filePreview #formHapus").attr(
      "action",
      `${BASE_URL}mahasiswa/deleteFormBimbingan/${id}`
    );
    $("#filePreview #formUnduh").attr(
      "action",
      `${BASE_URL}mahasiswa/downloadFormBimbingan/${id}`
    );
  });

  //BASE_URL didapatkan dari constant.js
  //kalo mau deploy BASE_URL harus diubah
  $("#tinjauPersyaratanSidang").on("click", function () {
    const file = $(this).parent().parent().children("input").val();
    const id = $(this).data("id");

    $("#filePreview").modal("show");
    $("#filePreviewLabel").text("Tinjau File Persyaratan Sidang Skripsi");
    $("#previewContainer iframe").attr(
      "src",
      `${BASE_URL}folderPersyaratanSidang/${file}`
    );
    $("#filePreview #formHapus").attr(
      "action",
      `${BASE_URL}mahasiswa/deletePersyaratanSidang/${id}`
    );
    $("#filePreview #formUnduh").attr(
      "action",
      `${BASE_URL}mahasiswa/downloadPersyaratanSidang/${id}`
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
