$(function () {
  $(".tablist .card[data-toggle='pill']").mouseenter(function () {
    $(this).css("cursor", "pointer");
    $(this).addClass("border-dark");
  });

  $(".tablist .card[data-toggle='pill']").mouseleave(function () {
    $(this).css("cursor", "default");
    $(this).removeClass("border-dark");
  });

  $(".tablist .card[data-toggle='pill']").on("click", function () {
    $(".tablist .card[data-toggle='pill']").removeClass("active");
    $(this).addClass("active");

    $("#penelitian-tabContent .card").removeClass("show");
    $("#penelitian-tabContent .card").removeClass("active");

    const target = $(this).attr("aria-controls");
    $(`#penelitian-tabContent #${target}`).addClass("show");
    $(`#penelitian-tabContent #${target}`).addClass("active");
  });
});
