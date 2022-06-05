$(function () {
  $("#jadwalSidangSkripsi").DataTable({
    columnDefs: [
      {
        targets: [0, 2, 4, 5, 6, 7, 8],
        className: "text-center",
      },
      {
        targets: 8,
        searchable: false,
        orderable: false,
      },
      {
        targets: "_all",
        className: "align-middle",
      },
    ],
  });

  $(".hasil-prasidang").on("click", function () {
    const parent = $(this).parent().parent();
    const komentar1 = parent.children(".komentar1").text();
    const komentar2 = parent.children(".komentar2").text();
    $("#hasilPrasidang #komentar1").text(komentar1);
    $("#hasilPrasidang #komentar2").text(komentar2);
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
