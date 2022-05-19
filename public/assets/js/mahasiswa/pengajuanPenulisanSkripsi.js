$(function () {
  $("#formDataPersetujuanSkripsi").validate({
    rules: {
      sks_lulus: {
        required: true,
        number: true,
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
        accept: "pdf",
        filesize: 2048000,
      },
      inputKrs: {
        required: true,
        extension: "pdf",
        filesize: 2048000,
      },
      inputPersetujuanSkripsi: {
        required: true,
        extension: "pdf",
        filesize: 2048000,
      },
    },
    messages: {
      inputKhs: {
        extension: "File harus berekstensi PDF",
        filesize: "File tidak boleh melebihi 2MB",
      },
      inputKrs: {
        extension: "File harus berekstensi PDF",
        filesize: "File tidak boleh melebihi 2MB",
      },
      inputPersetujuanSkripsi: {
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
