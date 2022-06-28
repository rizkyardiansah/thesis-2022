$(function () {
  $("#pendaftaranTendik").validate({
    rules: {
      email: {
        required: true,
        email: true,
        maxlength: 120,
      },
      persetujuan: {
        required: true,
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
