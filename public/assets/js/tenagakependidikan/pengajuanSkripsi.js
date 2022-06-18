$(function () {
  $("#pengajuanSkripsi .preview").on("click", function () {
    const npm = $(this).parent().parent().children(".npm").text();
    const fileKhs = $(this).parent().parent().children(".file-khs").text();
    const fileKrs = $(this).parent().parent().children(".file-krs").text();
    const filePersetujuan = $(this)
      .parent()
      .parent()
      .children(".file-persetujuan")
      .text();

    $("#previewLabel").text(`Preview File ${npm}`);
    $("#preview iframe.file-khs").attr(
      "src",
      `${BASE_URL}folderKHS/${fileKhs}`
    );
    $("#preview iframe.file-krs").attr(
      "src",
      `${BASE_URL}folderKRS/${fileKrs}`
    );
    $("#preview iframe.file-persetujuan").attr(
      "src",
      `${BASE_URL}folderPersetujuanSkripsi/${filePersetujuan}`
    );
  });

  $("#pengajuanSkripsi tr").each(function (key, val) {
    const status = $(this).children("td.status").text();
    if (status != "-") {
      $(this).children("td.aksi").children("form").prop("hidden", true);
    }
  });

  //untuk sweetalert
  if ($("#flashdata").data("open") == true) {
    Swal.fire(
      $("#flashdata #title").text(),
      $("#flashdata #text").text(),
      $("#flashdata #icon").text()
    );
  }

  $("#pengajuanSkripsi").DataTable({
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
        targets: [0, 1, 3, 4, 5, 8, 9],
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
