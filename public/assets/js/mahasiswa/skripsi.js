$(function () {
  $("#formTambahSkripsi").validate({
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
    },
    errorClass: "text-danger",
    errorElement: "small",
    submitHandler: function (form) {
      form.submit();
    },
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

  $("#tableSkripsi").DataTable({
    columnDefs: [
      {
        targets: [0, 2, 3, 4, 5, 6, 7, 8, 9],
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
});
