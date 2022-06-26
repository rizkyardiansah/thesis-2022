$(function () {
  $("#formTambahPengajuan").validate({
    rules: {
      file_draft_final: {
        required: true,
        extension: "pdf",
        accept: "pdf",
        filesize: 10000000,
      },
      file_form_bimbingan: {
        required: true,
        extension: "pdf",
        filesize: 10000000,
      },
      file_persyaratan_sidang: {
        required: true,
        extension: "pdf",
        filesize: 10000000,
      },
    },
    messages: {
      file_draft_final: {
        extension: "File harus berekstensi PDF",
        filesize: "File tidak boleh melebihi 10MB",
      },
      file_form_bimbingan: {
        extension: "File harus berekstensi PDF",
        filesize: "File tidak boleh melebihi 10MB",
      },
      file_persyaratan_sidang: {
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

  $("#tablePengajuan").DataTable({
    columnDefs: [
      {
        targets: [0, 3, 4, 5, 6, 7],
        className: "text-center",
      },
      {
        targets: 7,
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
