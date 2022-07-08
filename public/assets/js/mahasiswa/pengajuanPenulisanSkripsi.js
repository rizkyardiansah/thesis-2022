$(function () {
  $("#formDataPersetujuanSkripsi").validate({
    rules: {
      sks_lulus: {
        required: true,
        digits: true,
        min: 1,
        max: 140,
      },
      pembimbing_akademik: {
        required: true,
      },
      mk_sedang_diambil: {
        required: true,
        maxlength: 150,
      },
      mk_akan_diambil: {
        required: true,
        maxlength: 150,
      },
      inputKhs: {
        required: true,
        extension: "pdf",
        filesize: 10000000,
      },
      inputKrs: {
        required: true,
        extension: "pdf",
        filesize: 10000000,
      },
      inputPersetujuanSkripsi: {
        required: true,
        extension: "pdf",
        filesize: 10000000,
      },
    },
    messages: {
      inputKhs: {
        extension: "File harus berekstensi PDF",
        filesize: "File tidak boleh melebihi 10MB",
      },
      inputKrs: {
        extension: "File harus berekstensi PDF",
        filesize: "File tidak boleh melebihi 10MB",
      },
      inputPersetujuanSkripsi: {
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
  $("#tinjauKhs").on("click", function () {
    const file = $(this).parent().parent().children("input").val();
    const npm = $(this).data("npm");

    $("#filePreview").modal("show");
    $("#filePreviewLabel").text("Tinjau File KHS");
    $("#previewContainer iframe").attr("src", `${BASE_URL}folderKHS/${file}`);
    $("#filePreview #formHapus").attr(
      "action",
      `${BASE_URL}mahasiswa/deleteKhs/${npm}`
    );
    $("#filePreview #formUnduh").attr(
      "action",
      `${BASE_URL}mahasiswa/downloadKhs/${npm}`
    );
  });

  //BASE_URL didapatkan dari constant.js
  //kalo mau deploy BASE_URL harus diubah
  $("#tinjauKrs").on("click", function () {
    const file = $(this).parent().parent().children("input").val();
    const npm = $(this).data("npm");

    $("#filePreview").modal("show");
    $("#filePreviewLabel").text("Tinjau File KRS");
    $("#previewContainer iframe").attr("src", `${BASE_URL}folderKRS/${file}`);
    $("#filePreview #formHapus").attr(
      "action",
      `${BASE_URL}mahasiswa/deleteKrs/${npm}`
    );
    $("#filePreview #formUnduh").attr(
      "action",
      `${BASE_URL}mahasiswa/downloadKrs/${npm}`
    );
  });

  //BASE_URL didapatkan dari constant.js
  //kalo mau deploy BASE_URL harus diubah
  $("#tinjauPersetujuan").on("click", function () {
    const file = $(this).parent().parent().children("input").val();
    const npm = $(this).data("npm");

    $("#filePreview").modal("show");
    $("#filePreviewLabel").text("Tinjau File Persetujuan Penulisan Skripsi");
    $("#previewContainer iframe").attr(
      "src",
      `${BASE_URL}folderPersetujuanSkripsi/${file}`
    );
    $("#filePreview #formHapus").attr(
      "action",
      `${BASE_URL}mahasiswa/deletePersetujuanSkripsi/${npm}`
    );
    $("#filePreview #formUnduh").attr(
      "action",
      `${BASE_URL}mahasiswa/downloadPersetujuanSkripsi/${npm}`
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
