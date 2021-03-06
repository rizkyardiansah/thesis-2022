$(function () {
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

  $("#jadwalPengujiSempro .buat-nilai").on("click", function () {
    const idSempro = $(this).data("id");
    const status = $(this).parent().parent().children(".status").text();
    const komentar = $(this).parent().parent().children(".komentar").text();
    $("#penilaianSempro").modal("show");
    $("#formPenilaianSempro #komentar").text(komentar);
    $(`#formPenilaianSempro input[type="radio"]`).prop("checked", false);
    $(`#formPenilaianSempro input[value="${status}"]`).prop("checked", true);
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

  $("#jadwalPengujiSempro").DataTable({
    dom:
      "<'row mt-3'<'col-sm-12 col-md-4'B><'col-sm-12 col-md-4'l><'col-sm-12 col-md-4'f>>" +
      "<'row'<'col-sm-12'tr>>" +
      "<'row'<'col-sm-12 col-md-5'i><'col-sm-12 col-md-7'p>>",
    buttons: [
      // {
      //   extend: "copyHtml5",
      //   className: "btn-dark",
      //   exportOptions: {
      //     columns: ":visible",
      //   },
      // },
      {
        extend: "excelHtml5",
        className: "btn-dark",
        exportOptions: {
          columns: ":visible",
        },
      },
      // {
      //   extend: "csvHtml5",
      //   className: "btn-dark",
      //   exportOptions: {
      //     columns: ":visible",
      //   },
      // },
      {
        extend: "pdfHtml5",
        className: "btn-dark",
        orientation: "landscape",
        exportOptions: {
          columns: ":visible",
        },
      },
      {
        extend: "colvis",
        className: "btn-dark",
      },
    ],
    columnDefs: [
      {
        targets: [0, 1, 4, 5, 6, 7, 8, 9, 11, 12],
        className: "text-center",
      },
      {
        targets: 12,
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
