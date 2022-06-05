$(function () {
  $("#hasilBimbingan").DataTable({
    columnDefs: [
      {
        targets: [0, 1, 3, 4],
        className: "text-center",
      },
      {
        targets: 4,
        searchable: false,
        orderable: false,
      },
      {
        targets: "_all",
        className: "align-middle",
      },
    ],
  });

  if ($("#flashdata").data("open") == true) {
    Swal.fire(
      $("#flashdata #title").text(),
      $("#flashdata #text").text(),
      $("#flashdata #icon").text()
    );
  }
});
