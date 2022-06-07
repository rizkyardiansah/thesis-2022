$(function () {
  $("#sumberDaya").DataTable({
    columnDefs: [
      {
        targets: [0, 2],
        className: "text-center",
      },
      {
        targets: 2,
        searchable: false,
        orderable: false,
      },
      {
        targets: "_all",
        className: "align-middle",
      },
    ],
  });

  $("#formTambahSumberDaya").validate({
    rules: {
      nama: {
        required: true,
        minlength: 10,
        maxlength: 100,
        "safe-filename": true,
      },
      file_resource: {
        required: true,
        extension: "pdf,xls,xlsx,doc,docx",
        filesize: 10000000,
      },
    },
    messages: {
      nama: {
        "safe-filename": "Nama hanya boleh mengandung huruf dan/atau angka",
      },
      file_resource: {
        extension: "File harus berekstensi PDF, XLS, XLSX, DOC dan DOCX",
        filesize: "File tidak boleh melebihi 10MB",
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

  $("#formUbahSumberDaya").validate({
    rules: {
      nama: {
        required: true,
        minlength: 10,
        maxlength: 100,
        "safe-filename": true,
      },
    },
    messages: {
      nama: {
        "safe-filename": "Nama hanya boleh mengandung huruf dan/atau angka",
      },
    },
    errorClass: "text-danger",
    errorElement: "small",
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

  jQuery.validator.addMethod(
    "safe-filename",
    function (value, element, param) {
      return this.optional(element) || /^[a-zA-Z0-9 ]+$/.test(value);
    },
    "Nama tidak sesuai"
  );

  $(".ubah-resource").on("click", function () {
    const id = $(this).data("id");
    const nama = $(this).parent().parent().children(".nama").text();

    $("#formUbahSumberDaya").attr(
      "action",
      `${BASE_URL}home/updateResource/${id}`
    );

    $("#formUbahSumberDaya #nama").val(nama);
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
