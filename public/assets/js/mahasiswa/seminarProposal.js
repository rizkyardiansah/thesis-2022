$(function () {
  $("#formPengumpulanVideo").validate({
    rules: {
      link_video: {
        required: true,
        url: true,
      },
    },
    errorClass: "text-danger",
    errorElement: "small",
    submitHandler: function (form) {
      form.submit();
    },
  });

  $("#jadwalSempro .ubah-jadwal").on("click", function (e) {
    const parent = $(this).parent().parent();
    const idSemPro = $(this).data("id");
    const judul = parent.children(".judul").text();
    const idProposal = parent.children(".judul").data("id");
    const link_video = parent.children(".link_video").text();

    $("#pengumpulanVideo").modal("show");
    $("#pengumpulanVideoLabel").text("Ubah Pengumpulan Video SemPro");
    $("#formPengumpulanVideo").attr(
      "action",
      `${BASE_URL}mahasiswa/updateVideoSempro/${idSemPro}`
    );

    $("#formPengumpulanVideo #id_proposal").val(idProposal);
    $("#formPengumpulanVideo #judul").text(judul);
    $("#formPengumpulanVideo #link_video").val(link_video);
  });

  //untuk sweetalert
  if ($("#flashdata").data("open") == true) {
    Swal.fire(
      $("#flashdata #title").text(),
      $("#flashdata #text").text(),
      $("#flashdata #icon").text()
    );
  }

  $("#jadwalSempro").DataTable({
    columnDefs: [
      {
        targets: [0, 2, 3],
        className: "text-center",
      },
      {
        targets: 3,
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
