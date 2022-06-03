$(function () {
  $("#tablePengajuan").DataTable();

  $("#formPengajuanPraSidang").validate({
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

  $("#tablePengajuan .ubah-pengajuan").on("click", function (e) {
    const idPengajuan = $(this).data("id");
    $("#pengajuanPraSidang").modal("show");
    $("#pengajuanPraSidangLabel").text("Ubah Pengajuan Seminar Pra Sidang");
    $("#formPengajuanPraSidang").attr(
      "action",
      `${BASE_URL}mahasiswa/updatePengajuanPrasidang/${idPengajuan}`
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
