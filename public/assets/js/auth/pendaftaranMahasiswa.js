$(function () {
  const now = new Date();
  $("#pendaftaranMahasiswa").validate({
    rules: {
      prodi: {
        required: true,
      },
      angkatan: {
        required: true,
        digits: true,
        rangelength: [4, 4],
        min: now.getFullYear() - 7,
        max: now.getFullYear() - 3,
      },
      email: {
        required: true,
        email: true,
        maxlength: 120,
      },
      persetujuan: {
        required: true,
      },
    },
    messages: {
      angkatan: {
        rangelength: "Tahun angkatan harus terdiri dari 4 digit",
        min: "Tahun angkatan tidak sesuai",
        max: "Tahun angkatan tidak sesuai",
      },
    },
    errorClass: "text-danger",
    errorElement: "small",
    errorPlacement: function (error, element) {
      if (element.attr("type") != "checkbox") {
        error.insertAfter(element.parent());
      }
    },
    highlight: function (element, errorClass) {
      $(element).addClass(errorClass);
      $(element.form)
        .find("label[for=" + element.id + "]")
        .addClass(errorClass);
    },
    unhighlight: function (element, errorClass) {
      $(element).removeClass(errorClass);
      $(element.form)
        .find("label[for=" + element.id + "]")
        .removeClass(errorClass);
    },
    submitHandler: function (form) {
      form.submit();
    },
  });

  const npm = $("#npm").val();
  switch (npm.substring(0, 3)) {
    case "140":
      $("#prodi option").prop("selected", false);
      $("#prodi option[data-inisial='TI']").prop("selected", true);
      break;
    case "150":
      $("#prodi option").prop("selected", false);
      $("#prodi option[data-inisial='PdSI']").prop("selected", true);
      break;
  }

  $("#persetujuan").on("change", function () {
    if ($("#persetujuan").prop("checked") == true) {
      $("label[for='persetujuan']").removeClass("text-danger");
    }
    if ($("#persetujuan").prop("checked") == false) {
      $("label[for='persetujuan']").addClass("text-danger");
    }
  });

  if ($("#flashdata").data("open") == true) {
    Swal.fire(
      $("#flashdata #title").text(),
      $("#flashdata #text").text(),
      $("#flashdata #icon").text()
    );
  }
});
