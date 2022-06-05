$(function () {
  $("#proposalMahasiswa").DataTable({
    columnDefs: [
      {
        targets: [0, 2, 3, 4, 5, 6, 7, 9],
        className: "text-center",
      },
      {
        targets: 9,
        searchable: false,
        orderable: false,
      },
      {
        targets: "_all",
        className: "align-middle",
      },
    ],
  });

  $("#formTambahProposal").validate({
    rules: {
      judul: {
        required: true,
        minlength: 20,
        maxlength: 300,
      },
      sifat: {
        required: true,
      },
      sumber: {
        required: true,
      },
      bidang: {
        required: true,
      },
      dosen_usulan1: {
        required: true,
      },
      dosen_usulan2: {
        required: true,
      },
    },
    errorClass: "text-danger",
    errorElement: "small",
    submitHandler: function (form) {
      form.submit();
    },
  });

  $("#proposalMahasiswa .ubah-proposal").on("click", function (e) {
    const parent = $(this).parent().parent();
    const idProposal = $(this).data("id");
    const judul = parent.children(".judul").text();
    const idBidang = parent.children(".bidang").data("id");
    const sifat = parent.children(".sifat").text();
    const sumber = parent.children(".sumber").text();
    const idDosen_usulan1 = parent.children(".dosen_usulan1").data("id");
    const idDosen_usulan2 = parent.children(".dosen_usulan2").data("id");

    $("#tambahProposal").modal("show");
    $("#tambahProposalLabel").text("Ubah Proposal");
    $("#formTambahProposal").attr(
      "action",
      `${BASE_URL}mahasiswa/updateProposal/${idProposal}`
    );

    $("#formTambahProposal #judul").val(judul);
    $("#formTambahProposal #sifat").val(sifat);
    $("#formTambahProposal #sumber").val(sumber);
    $("#formTambahProposal #bidang").val(idBidang);
    $("#formTambahProposal #dosen_usulan1").val(idDosen_usulan1);
    $("#formTambahProposal #dosen_usulan2").val(idDosen_usulan2);
    $("#formTambahProposal #file_proposal")
      .parent()
      .parent()
      .parent()
      .children(".alert-proposal")
      .show();
  });

  //untuk nampilin nama file
  $("input[type='file']").on("change", function (e) {
    $(`label[for="${e.target.id}"]`).text(e.target.files[0].name);
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
