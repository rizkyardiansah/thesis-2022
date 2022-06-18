$(function () {
  //untuk sweetalert
  if ($("#flashdata").data("open") == true) {
    Swal.fire(
      $("#flashdata #title").text(),
      $("#flashdata #text").text(),
      $("#flashdata #icon").text()
    );
  }

  $("#daftarPengajuan").DataTable({
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
        targets: [0, 1, 3, 5, 6, 7, 8, 9],
        className: "text-center",
      },
      {
        targets: 10,
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
