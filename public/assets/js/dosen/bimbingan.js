$(function () {
  $("#mahasiswaBimbingan").DataTable({
    columnDefs: [
      {
        targets: [0, 1, 5, 7],
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

  //untuk sweetalert
  if ($("#flashdata").data("open") == true) {
    Swal.fire(
      $("#flashdata #title").text(),
      $("#flashdata #text").text(),
      $("#flashdata #icon").text()
    );
  }
});
