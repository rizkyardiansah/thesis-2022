$(function () {
  $("#pengajuanSkripsi").DataTable();

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
});
