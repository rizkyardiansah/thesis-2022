$(function () {
  $("#formTambahJadwal #tanggal").daterangepicker({
    singleDatePicker: true,
    drops: "up",
  });

  $("#formTambahJadwal #mahasiswa").on("change", function () {
    const npm = $(this).val();
    $("#formTambahJadwal textarea[name='judul']").prop("hidden", true);
    $(`#formTambahJadwal #judul[data-npm='${npm}']`).prop("hidden", false);

    $("#formTambahJadwal input[name='bidang']").prop("hidden", true);
    $(`#formTambahJadwal #bidang[data-npm='${npm}']`).prop("hidden", false);
  });

  $("#formTambahJadwal").validate({
    rules: {
      mahasiswa: {
        required: true,
      },
      ruangan: {
        required: true,
        maxlength: 200,
      },
      tanggal: {
        required: true,
      },
      jam: {
        required: true,
        jam: true,
      },
      dosen_reviewer: {
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
        maxlength: 200,
      },
      tanggal: {
        required: true,
      },
      jam: {
        required: true,
        jam: true,
      },
      dosen_reviewer: {
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

  $("#jadwalSeminarPrasidang .ubah-jadwal").on("click", function (e) {
    const id = $(this).data("id");
    const parent = $(this).parent().parent();
    const npm = parent.children(".npm").text();
    const nama = parent.children(".nama").text();
    const tanggal = parent.children(".tanggal").text().split(" ")[0];
    const jam = parent
      .children(".tanggal")
      .text()
      .split(" ")[1]
      .substring(0, 5);
    const link_konferensi = parent.children(".link_konferensi").text();
    let ruangan = "";
    if (parent.children(".ruangan").children("a").length > 0) {
      ruangan = parent.children(".ruangan").children("a").attr("href");
    } else {
      ruangan = parent.children(".ruangan").text();
    }
    const dosen_reviewer = parent.children(".dosen_reviewer").data("id");

    $("#ubahJadwal").modal("show");
    $("#formUbahJadwal").attr(
      "action",
      `${BASE_URL}kaprodi/updateJadwalSeminarPrasidang/${id}`
    );

    $("#formUbahJadwal #mahasiswa").val(`${npm} | ${nama}`);
    $("#formUbahJadwal #link_konferensi").val(link_konferensi);
    $("#formUbahJadwal #ruangan").val(ruangan);
    $("#formUbahJadwal #tanggal").daterangepicker({
      singleDatePicker: true,
      drops: "up",
      startDate: moment(tanggal, "DD-MM-YYYY").format("MM/DD/YYYY"),
    });
    $("#formUbahJadwal #jam").val(jam);
    $("#formUbahJadwal #dosen_reviewer").val(dosen_reviewer);
  });

  $("#jadwalSeminarPrasidang #formHapusJadwal").on("submit", function (e) {
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

  $("#jadwalSeminarPrasidang").DataTable({
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
        targets: [0, 1, 4, 5, 7, 8],
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
});
