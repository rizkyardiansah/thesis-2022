$(function () {
  //validasi form pada menu data diri
  $("#formDataDiri").validate({
    rules: {
      namaLengkap: {
        required: true,
        minlength: 2,
        maxlength: 70,
      },
    },
    errorClass: "text-danger",
    errorElement: "small",
    submitHandler: function (form) {
      form.submit();
    },
  });

  $("#formDataPersetujuanSkripsi").validate({
    rules: {
      sks_lulus: {
        required: true,
        number: true,
        min: 1,
        max: 140,
      },
      pembimbing_akademik: {
        required: true,
      },
      mk_sedang_diambil: {
        required: true,
      },
      mk_akan_diambil: {
        required: true,
      },
    },
    messages: {
      sks_lulus: {
        min: "SKS harus lebih dari 1",
        max: "SKS harus kurang dari 140",
        number: "Masukan harus berupa angka",
      },
    },
    errorClass: "text-danger",
    errorElement: "small",
    submitHandler: function (form) {
      form.submit();
    },
  });

  const isVerified = $("#alertStatusPersetujuan")
    .attr("class")
    .includes("alert-success");
  if (isVerified == true) {
    $("#formDataPersetujuanSkripsi #sks_lulus").prop("disabled", true);
    $("#formDataPersetujuanSkripsi #pembimbing_akademik").prop(
      "disabled",
      true
    );
    $("#formDataPersetujuanSkripsi #mk_sedang_diambil").prop("disabled", true);
    $("#formDataPersetujuanSkripsi #mk_akan_diambil").prop("disabled", true);
    $("#formDataPersetujuanSkripsi button[type='submit']").prop(
      "disabled",
      true
    );
    $("#hapusKrs").prop("disabled", true);
    $("#hapusKhs").prop("disabled", true);
    $("#hapusPersetujuanSkripsi").prop("disabled", true);
  }

  //untuk sweetalert
  if ($("#flashdata").data("open") == true) {
    Swal.fire(
      $("#flashdata #title").text(),
      $("#flashdata #text").text(),
      $("#flashdata #icon").text()
    );
  }

  //untuk nampilin nama file
  $("input[type='file']").on("change", function (e) {
    $(`label[for="${e.target.id}"]`).text(e.target.files[0].name);
  });

  //untuk melakukan reload dan pindah menu sekaligus
  if (window.location.hash != null && window.location.hash != "") {
    $("#penelitian-tabContent .tab-pane").removeClass("show active");
    $(`${window.location.hash}`).addClass("show active");
  } else if (window.location.hash == null || window.location.hash == "") {
    $("#penelitian-tabContent .tab-pane").removeClass("show active");
    $("#dd-content").addClass("show active");
  }

  $("#menu-profil-tab a[role='tab']").on("click", function (e) {
    $(".konten .card-header").text(e.target.innerText);
    window.location.hash = e.target.getAttribute("href");
  });
});
