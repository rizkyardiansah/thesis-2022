$(function () {
  $("#formRegister").validate({
    rules: {
      namaLengkap: {
        required: true,
        minlength: 2,
        maxlength: 70,
      },
      npm: {
        number: true,
        required: true,
        minlength: 10,
        maxlength: 10,
      },
      angkatan: {
        required: true,
      },
      fakultas: {
        required: true,
      },
      emailMhs: {
        required: true,
        email: true,
        maxlength: 70,
      },
      katasandi: {
        required: true,
        minlength: 8,
        maxlength: 12,
      },
      katasandiUlangi: {
        required: true,
        minlength: 8,
        maxlength: 12,
        equalTo: "#katasandi",
      },
      prodi: {
        required: true,
      },
    },
    messages: {
      npm: {
        minlength: "Masukan harus terdiri dari 10 karakter",
        maxlength: "Masukan harus terdiri dari 10 karakter",
      },
      katasandiUlangi: {
        equalTo: "Kata sandi tidak sama",
      },
    },
    errorClass: "text-danger",
    errorElement: "small",
    submitHandler: function (form) {
      form.submit();
    },
  });

  $("#formRegister #fakultas").on("change", function (e) {
    $("#formRegister #prodi").prop("disabled", false);
    let fakultasId = e.target.value;

    $("#formRegister #prodi option").hide().prop("selected", false);
    $("#formRegister #prodi option[value='none']").prop("selected", true);
    $(`#formRegister #prodi option[data-fakultas="${fakultasId}"]`).show();
  });

  if ($("#flashdata").data("open") == true) {
    Swal.fire(
      $("#flashdata #title").text(),
      $("#flashdata #text").text(),
      $("#flashdata #icon").text()
    );
  }
});
