$(function () {
  hitungNilaiSidang();

  $("#formPenilaianSidang").validate({
    rules: {
      nilai_1: {
        required: true,
        number: true,
        range: [0, 4],
      },
      nilai_2: {
        required: true,
        number: true,
        range: [0, 4],
      },
      nilai_3: {
        required: true,
        number: true,
        range: [0, 4],
      },
      nilai_4: {
        required: true,
        number: true,
        range: [0, 4],
      },
      nilai_5: {
        required: true,
        number: true,
        range: [0, 4],
      },
      nilai_6: {
        required: true,
        number: true,
        range: [0, 4],
      },
      nilai_7: {
        required: true,
        number: true,
        range: [0, 4],
      },
      nilai_8: {
        required: true,
        number: true,
        range: [0, 4],
      },
      nilai_9: {
        required: true,
        number: true,
        range: [0, 4],
      },
      nilai_10: {
        required: true,
        number: true,
        range: [0, 4],
      },
      nilai_11: {
        required: true,
        number: true,
        range: [0, 4],
      },
      nilai_12: {
        required: true,
        number: true,
        range: [0, 4],
      },
    },
    errorClass: "text-danger",
    errorElement: "small",
    errorPlacement: function (error, element) {
      error.insertAfter(element.parent());
    },
    submitHandler: function (form) {
      form.submit();
    },
  });

  $(".nilai-sidang").on("change", hitungNilaiSidang);

  //untuk sweetalert
  if ($("#flashdata").data("open") == true) {
    Swal.fire(
      $("#flashdata #title").text(),
      $("#flashdata #text").text(),
      $("#flashdata #icon").text()
    );
  }
});

function hitungNilaiSidang() {
  const nilai_1 = parseFloat($("#nilai_1").val());
  const nilai_2 = parseFloat($("#nilai_2").val());
  const nilai_3 = parseFloat($("#nilai_3").val());
  const nilai_4 = parseFloat($("#nilai_4").val());
  const nilai_5 = parseFloat($("#nilai_5").val());
  const nilai_6 = parseFloat($("#nilai_6").val());
  const nilai_7 = parseFloat($("#nilai_7").val());
  const nilai_8 = parseFloat($("#nilai_8").val());
  const nilai_9 = parseFloat($("#nilai_9").val());
  const nilai_10 = parseFloat($("#nilai_10").val());
  const nilai_11 = parseFloat($("#nilai_11").val());
  const nilai_12 = parseFloat($("#nilai_12").val());

  const persentasePenyajian = 15;
  const persentaseSistematika = 20;
  const persentaseTulisan = 25;
  const persentaseTanyaJawab = 40;

  const subtotal1 = (
    (nilai_1 + nilai_2 + nilai_3) *
    persentasePenyajian
  ).toFixed(1);
  const subtotal2 = (
    (nilai_4 + nilai_5 + nilai_6) *
    persentaseSistematika
  ).toFixed(1);
  const subtotal3 = ((nilai_7 + nilai_8 + nilai_9) * persentaseTulisan).toFixed(
    1
  );
  const subtotal4 = (
    (nilai_10 + nilai_11 + nilai_12) *
    persentaseTanyaJawab
  ).toFixed(1);
  $("#subtotal1").val(subtotal1);
  $("#subtotal2").val(subtotal2);
  $("#subtotal3").val(subtotal3);
  $("#subtotal4").val(subtotal4);

  const total = (
    parseFloat(subtotal1) +
    parseFloat(subtotal2) +
    parseFloat(subtotal3) +
    parseFloat(subtotal4)
  ).toFixed(1);
  const nilaiAkhir = (total / 300).toFixed(2);
  const status = nilaiAkhir >= 2.76 ? "LULUS" : "TIDAK LULUS";
  let grade = "";

  if (nilaiAkhir >= 3.76) {
    grade = "A";
  } else if (nilaiAkhir >= 3.51) {
    grade = "A-";
  } else if (nilaiAkhir >= 3.1) {
    grade = "B+";
  } else if (nilaiAkhir >= 2.76) {
    grade = "B";
  }

  $("#total").val(total);
  $("#nilai_akhir").val(nilaiAkhir);
  $("#grade").val(grade);
  $("#status").val(status);
}
