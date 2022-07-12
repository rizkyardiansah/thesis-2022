$(function () {
  $("#formTambahPembimbing #mahasiswa").on("change", function (e) {
    $("#formTambahPembimbing #pembimbing1").prop("disabled", false);
    $("#formTambahPembimbing #pembimbing2").prop("disabled", false);
    $("#formTambahPembimbing #pembimbingAgama").prop("disabled", false);
    let npm = $(this).val();
    let prodiId = $(this).children("option:selected").data("prodi");

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

  $("#formPembimbingBatch").validate({
    rules: {
      filePembimbing: {
        required: true,
        filesize: 1024000,
      },
    },
    messages: {
      filePembimbing: {
        filesize: "File tidak boleh melebihi 1MB",
      },
    },
    errorClass: "text-danger",
    errorElement: "small",
    errorPlacement: function (error, element) {
      if (element.attr("type") == "file") {
        error.insertAfter(element.parent().parent());
      } else {
        error.insertAfter(element);
      }
    },
    submitHandler: function (form) {
      form.submit();
    },
  });

  jQuery.validator.addMethod(
    "filesize",
    function (value, element, param) {
      return this.optional(element) || element.files[0].size <= param;
    },
    "Ukuran file melebihi batas"
  );

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

  //untuk nampilin nama file
  $("input[type='file']").on("change", function (e) {
    $(`label[for="${e.target.id}"]`).text(e.target.files[0].name);
  });

  if ($("#flashdata").data("open") == true) {
    Swal.fire(
      $("#flashdata #title").text(),
      $("#flashdata #text").text(),
      $("#flashdata #icon").text()
    );
  }

  $("#tablePembimbing").DataTable({
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
        orientation: "landscape",
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
        targets: [0, 1, 3, 5, 6, 7, 8, 9, 10],
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
