$(function () {
  $("#formTambahPembimbing #mahasiswa").on("change", function (e) {
    $("#formTambahPembimbing #pembimbing1").prop("disabled", false);
    $("#formTambahPembimbing #pembimbing2").prop("disabled", false);
    $("#formTambahPembimbing #pembimbingAgama").prop("disabled", false);
    let npm = $(this).val();
    let prodiId = $(this).children("option:selected").data("prodi");
    console.log(npm, prodiId);

    $("#formTambahPembimbing #pembimbing1 option")
      .hide()
      .prop("selected", false);
    $("#formTambahPembimbing #pembimbing1 option[value='none']").prop(
      "selected",
      true
    );
    $(
      `#formTambahPembimbing #pembimbing1 option[data-prodi="${prodiId}"]`
    ).show();

    $("#formTambahPembimbing #pembimbing2 option")
      .hide()
      .prop("selected", false);
    $("#formTambahPembimbing #pembimbing2 option[value='none']").prop(
      "selected",
      true
    );
    $(
      `#formTambahPembimbing #pembimbing2 option[data-prodi="${prodiId}"]`
    ).show();

    $("#formTambahPembimbing #pembimbingAgama option")
      .hide()
      .prop("selected", false);
    $("#formTambahPembimbing #pembimbingAgama option[value='none']").prop(
      "selected",
      true
    );
    $(
      `#formTambahPembimbing #pembimbingAgama option[data-prodi="${prodiId}"]`
    ).show();

    $(`#formTambahPembimbing textarea#judul`).prop("hidden", true);
    $(`#formTambahPembimbing #judul[data-npm="${npm}"]`).prop("hidden", false);

    $(`#formTambahPembimbing input[name="bidang"]`).prop("hidden", true);
    $(`#formTambahPembimbing #bidang[data-npm="${npm}"]`).prop("hidden", false);

    $(`#formTambahPembimbing input[name="dosen_usulan1"]`).prop("hidden", true);
    $(`#formTambahPembimbing #dosen_usulan1[data-npm="${npm}"]`).prop(
      "hidden",
      false
    );

    $(`#formTambahPembimbing input[name="dosen_usulan2"]`).prop("hidden", true);
    $(`#formTambahPembimbing #dosen_usulan2[data-npm="${npm}"]`).prop(
      "hidden",
      false
    );
  });

  $("#tablePembimbing").DataTable();

  $("#formTambahPembimbing").validate({
    rules: {
      mahasiswa: {
        required: true,
      },
      pembimbing1: {
        required: true,
      },
      pembimbingAgama: {
        required: true,
      },
    },
    errorClass: "text-danger",
    errorElement: "small",
    submitHandler: function (form) {
      form.submit();
    },
  });

  $("#tablePembimbing .ubah-pembimbing").on("click", function (e) {
    const parent = $(this).parent().parent();
    const npm = parent.children(".npm").text();
    const namaMahasiswa = parent.children(".nama_mahasiswa").text();
    const judul = parent.children(".judul").text();
    const namaBidang = parent.children(".bidang").data("nama");
    const idProdi = parent.children(".prodi").data("id");
    const idPembimbing1 = parent.children(".pembimbing1").data("id");
    const idPembimbing2 = parent.children(".pembimbing2").data("id");
    const idPembimbingAgama = parent.children(".pembimbingAgama").data("id");

    $("#ubahPembimbing").modal("show");

    $("#formUbahPembimbing #npm").val(npm);
    $("#formUbahPembimbing #nama_mahasiswa").val(namaMahasiswa);
    $("#formUbahPembimbing #judul").text(judul);
    $("#formUbahPembimbing #bidang").val(namaBidang);

    $(`#formUbahPembimbing #pembimbing1 option`).hide();
    $(
      `#formUbahPembimbing #pembimbing1 option[data-prodi="${idProdi}"]`
    ).show();
    $("#formUbahPembimbing #pembimbing1").val(idPembimbing1);

    $(`#formUbahPembimbing #pembimbing2 option`).hide();
    $(
      `#formUbahPembimbing #pembimbing2 option[data-prodi="${idProdi}"]`
    ).show();
    $("#formUbahPembimbing #pembimbing2").val(idPembimbing2);

    $(`#formUbahPembimbing #pembimbingAgama option`).hide();
    $(
      `#formUbahPembimbing #pembimbingAgama option[data-prodi="${idProdi}"]`
    ).show();
    $("#formUbahPembimbing #pembimbingAgama").val(idPembimbingAgama);
  });

  $("#tablePembimbing #formHapusPembimbing").on("submit", function (e) {
    e.preventDefault();
    Swal.fire({
      title: "Apakah anda ingin menghapus pembimbing skripsi ini?",
      text: "Pembimbing yang sudah dihapus tidak dapat dikembalikan",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#3085d6",
      cancelButtonColor: "#d33",
      confirmButtonText: "Ya, Hapus!",
      cancelButtonText: "Batal",
    }).then((result) => {
      if (result.isConfirmed) {
        e.target.submit();
      }
    });
  });

  if ($("#flashdata").data("open") == true) {
    Swal.fire(
      $("#flashdata #title").text(),
      $("#flashdata #text").text(),
      $("#flashdata #icon").text()
    );
  }
});
