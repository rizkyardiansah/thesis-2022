$(function () {
  $("#jadwalSidangSkripsi").DataTable({
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
        targets: [0, 1, 4, 5, 7, 8, 9, 10, 11],
        className: "text-center",
      },
      {
        targets: 11,
        searchable: false,
        orderable: false,
      },
      {
        targets: "_all",
        className: "align-middle",
      },
    ],
  });

  $("#formTambahJadwal #tanggal").daterangepicker({
    singleDatePicker: true,
    drops: "up",
  });

  $("#formTambahJadwal #mahasiswa").on("change", function () {
    const npm = $(this).val();
    console.log(npm);
    $("#formTambahJadwal textarea[name='judul']").prop("hidden", true);
    $(`#formTambahJadwal #judul[data-npm='${npm}']`).prop("hidden", false);

    $("#formTambahJadwal input[name='bidang']").prop("hidden", true);
    $(`#formTambahJadwal #bidang[data-npm='${npm}']`).prop("hidden", false);

    $("#formTambahJadwal input[name='pembimbing1']").prop("hidden", true);
    $(`#formTambahJadwal #pembimbing1[data-npm='${npm}']`).prop(
      "hidden",
      false
    );

    $("#formTambahJadwal input[name='pembimbing2']").prop("hidden", true);
    $(`#formTambahJadwal #pembimbing2[data-npm='${npm}']`).prop(
      "hidden",
      false
    );

    $("#formTambahJadwal input[name='pembimbing_agama']").prop("hidden", true);
    $(`#formTambahJadwal #pembimbing_agama[data-npm='${npm}']`).prop(
      "hidden",
      false
    );
  });

  $("#formTambahJadwal").validate({
    rules: {
      mahasiswa: {
        required: true,
      },
      ruangan: {
        required: true,
        maxlength: 20,
      },
      tanggal: {
        required: true,
      },
      jam: {
        required: true,
        jam: true,
      },
      dosen_penguji: {
        required: true,
      },
    },
    errorClass: "text-danger",
    errorElement: "small",
    submitHandler: function (form) {
      form.submit();
    },
  });

  $("#formUbahJadwal").validate({
    rules: {
      ruangan: {
        required: true,
        maxlength: 20,
      },
      tanggal: {
        required: true,
      },
      jam: {
        required: true,
        jam: true,
      },
      dosen_penguji: {
        required: true,
      },
    },
    errorClass: "text-danger",
    errorElement: "small",
    submitHandler: function (form) {
      form.submit();
    },
  });

  $("#formJadwalBatch").validate({
    rules: {
      fileJadwal: {
        required: true,
      },
    },
    errorPlacement: function (error, element) {
      error.insertAfter(element.parent().parent());
    },
    errorClass: "text-danger",
    errorElement: "small",
    submitHandler: function (form) {
      form.submit();
    },
  });

  jQuery.validator.addMethod(
    "jam",
    function (value, element) {
      return this.optional(element) || /^[0-2][0-9]:[0-5][0-9]$/.test(value);
    },
    "Format jam tidak valid"
  );

  $("#jadwalSidangSkripsi .ubah-jadwal").on("click", function (e) {
    const id = $(this).data("id");
    const parent = $(this).parent().parent();
    const npm = parent.children(".npm").text();
    const nama = parent.children(".nama").text();
    const judul = parent.children(".judul").text();
    const bidang = parent.children(".bidang").data("original-title");
    console.log(bidang);
    const pembimbing1 = parent.children(".pembimbing1").data("original-title");
    const pembimbing2 = parent.children(".pembimbing2").data("original-title");
    const pembimbingAgama = parent
      .children(".pembimbing_agama")
      .data("original-title");
    const tanggal = parent.children(".tanggal").text().split(" ")[0];
    const jam = parent
      .children(".tanggal")
      .text()
      .split(" ")[1]
      .substring(0, 5);
    const ruangan = parent.children(".ruangan").text();
    const dosen_penguji = parent.children(".penguji").data("id");

    $("#ubahJadwal").modal("show");
    $("#formUbahJadwal").attr(
      "action",
      `${BASE_URL}dosen/updateJadwalSidangSkripsi/${id}`
    );

    $("#formUbahJadwal #mahasiswa").val(`${npm} | ${nama}`);
    $("#formUbahJadwal #judul").text(judul);
    $("#formUbahJadwal #bidang").val(bidang);
    $("#formUbahJadwal #pembimbing1").val(pembimbing1);
    if (pembimbing2 == undefined || pembimbing2 == null || pembimbing2 == "") {
      $("#formUbahJadwal #pembimbing2").val("-");
    } else {
      $("#formUbahJadwal #pembimbing2").val(pembimbing2);
    }
    $("#formUbahJadwal #pembimbing_agama").val(pembimbingAgama);
    $("#formUbahJadwal #ruangan").val(ruangan);
    $("#formUbahJadwal #tanggal").daterangepicker({
      singleDatePicker: true,
      drops: "up",
      startDate: moment(tanggal, "DD-MM-YYYY").format("MM/DD/YYYY"),
    });
    $("#formUbahJadwal #jam").val(jam);
    $("#formUbahJadwal #dosen_penguji").val(dosen_penguji);
  });

  $("#jadwalSidangSkripsi #formHapusJadwal").on("submit", function (e) {
    e.preventDefault();
    Swal.fire({
      title: "Apakah anda ingin menghapus jadwal ini?",
      text: "Jadwal yang sudah dihapus tidak dapat dikembalikan",
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

  //untuk sweetalert
  if ($("#flashdata").data("open") == true) {
    Swal.fire(
      $("#flashdata #title").text(),
      $("#flashdata #text").text(),
      $("#flashdata #icon").text()
    );
  }
});
