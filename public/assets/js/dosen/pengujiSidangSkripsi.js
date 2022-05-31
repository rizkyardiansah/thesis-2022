$(function () {
  $("#jadwalPengujiSidang").DataTable();

  $("#formPenilaianSempro").validate({
    rules: {
      komentar: {
        required: true,
        maxlength: 300,
      },
      status: {
        required: true,
      },
    },
    errorClass: "text-danger",
    errorElement: "small",
    errorPlacement: function (error, element) {
      if (element.attr("name") == "status") {
        error.insertAfter(element.parent().parent());
      } else {
        error.insertAfter(element);
      }
    },
    submitHandler: function (form) {
      form.submit();
    },
  });

  $("#jadwalPengujiSidang .buat-nilai").on("click", function () {
    const idSempro = $(this).data("id");

    $("#penilaianSempro").modal("show");
    $("#formPenilaianSempro").attr(
      "action",
      `${BASE_URL}dosen/insertPenilaianSempro/${idSempro}`
    );
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
