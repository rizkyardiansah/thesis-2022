$(function () {
  $("#jadwalSidangSkripsi").DataTable();

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
