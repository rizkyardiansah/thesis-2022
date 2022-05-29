$(function () {
  $("#editPengajuan").validate({
    rules: {
      file_draft: {
        required: true,
        extension: "pdf",
        filesize: 2048000,
      },
      lembar_persetujuan: {
        required: true,
        extension: "pdf",
        filesize: 2048000,
      },
    },
    messages: {
      file_draft: {
        extension: "File harus berekstensi PDF",
        filesize: "File tidak boleh melebihi 2MB",
      },
      lembar_persetujuan: {
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
  $("#tinjauDraft").on("click", function () {
    const file = $(this).parent().parent().children("input").val();
    const id = $(this).data("id");

    $("#filePreview").modal("show");
    $("#filePreviewLabel").text("Tinjau File Draft Skripsi");
    $("#previewContainer iframe").attr("src", `${BASE_URL}folderDraft/${file}`);
    $("#filePreview #formHapus").attr(
      "action",
      `${BASE_URL}mahasiswa/deleteDraft/${id}`
    );
    $("#filePreview #formUnduh").attr(
      "action",
      `${BASE_URL}mahasiswa/downloadDraft/${id}`
    );
  });

  //BASE_URL didapatkan dari constant.js
  //kalo mau deploy BASE_URL harus diubah
  $("#tinjauPersetujuan").on("click", function () {
    const file = $(this).parent().parent().children("input").val();
    const id = $(this).data("id");

    $("#filePreview").modal("show");
    $("#filePreviewLabel").text(
      "Tinjau File Lembar Persetujuan Seminar Prasidang"
    );
    $("#previewContainer iframe").attr(
      "src",
      `${BASE_URL}folderLembarPersetujuanPrasidang/${file}`
    );
    $("#filePreview #formHapus").attr(
      "action",
      `${BASE_URL}mahasiswa/deleteLembarPersetujuan/${id}`
    );
    $("#filePreview #formUnduh").attr(
      "action",
      `${BASE_URL}mahasiswa/downloadLembarPersetujuan/${id}`
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
