$(function () {
  $("#formUploadMakalah").validate({
    rules: {
      judul: {
        required: true,
        minlength: 20,
        maxlength: 255,
      },
      deskripsi: {
        required: true,
        minlength: 20,
        maxlength: 255,
      },
      kata_kunci: {
        required: true,
        minlength: 20,
        maxlength: 70,
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

    const fileMakalah = new FileReader();
    fileMakalah.readAsDataURL(e.target.files[0]);

    fileMakalah.onload = function (e) {
      $("#previewContainer iframe").attr("src", e.target.result);
    };
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
