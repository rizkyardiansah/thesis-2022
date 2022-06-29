(function (factory) {
  if (typeof define === "function" && define.amd) {
    define(["jquery", "../jquery.validate"], factory);
  } else if (typeof module === "object" && module.exports) {
    module.exports = factory(require("jquery"));
  } else {
    factory(jQuery);
  }
})(function ($) {
  /*
   * Translated default messages for the jQuery validation plugin.
   * Locale: ID (Indonesia; Indonesian)
   */
  $.extend($.validator.messages, {
    required: "Kolom ini harus diisi.",
    remote: "Harap benarkan kolom ini.",
    email: "Silakan masukkan email dengan format yang benar.",
    url: "Silakan masukkan format URL yang benar.",
    date: "Silakan masukkan format tanggal yang benar.",
    dateISO: "Silakan masukkan format tanggal(ISO) yang benar.",
    number: "Silakan masukkan angka yang benar.",
    digits: "Kolom ini hanya menerima angka.",
    creditcard: "Harap masukkan format kartu kredit yang benar.",
    equalTo: "Harap masukkan nilai yg sama dengan sebelumnya.",
    maxlength: $.validator.format(
      "Masukan tidak boleh lebih dari {0} karakter."
    ),
    minlength: $.validator.format(
      "Masukan tidak boleh kurang dari {0} karakter."
    ),
    rangelength: $.validator.format(
      "Panjang karakter yg diizinkan antara {0} dan {1} karakter."
    ),
    range: $.validator.format("Harap masukkan nilai antara {0} dan {1}."),
    max: $.validator.format(
      "Harap masukkan nilai lebih kecil atau sama dengan {0}."
    ),
    min: $.validator.format(
      "Harap masukkan nilai lebih besar atau sama dengan {0}."
    ),
  });
  return $;
});
