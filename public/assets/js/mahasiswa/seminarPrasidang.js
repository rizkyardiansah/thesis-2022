$(function () {
  $(".hasil-prasidang").on("click", function () {
    const parent = $(this).parent().parent();
    const komentar = parent.children(".komentar").text();
    console.log("komentar");
    $("#hasilPrasidang #komentar").text(komentar);
  });

  //untuk sweetalert
  if ($("#flashdata").data("open") == true) {
    Swal.fire(
      $("#flashdata #title").text(),
      $("#flashdata #text").text(),
      $("#flashdata #icon").text()
    );
  }

  $("#jadwalSeminarPrasidang").DataTable({
    columnDefs: [
      {
        targets: [0, 2, 4, 6, 7],
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
