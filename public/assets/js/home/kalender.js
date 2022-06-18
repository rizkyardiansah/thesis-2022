$(document).ready(function () {
  const events = [];

  $("#tableKegiatan tr").each(function () {
    let namaKegiatan = $(this).children(".nama-kegiatan").text();
    let tanggalKegiatan = $(this).children(".tanggal-kegiatan").text();

    let red = Math.floor(Math.random() * 256);
    let green = Math.floor(Math.random() * 256);
    let blue = Math.floor(Math.random() * 256);
    events.push({
      title: namaKegiatan,
      start: tanggalKegiatan.split("_")[0],
      end: moment(tanggalKegiatan.split("_")[1])
        .add(1, "days")
        .format("YYYY-MM-DD"),
      backgroundColor: `rgba(${red},${green},${blue},0.2)`,
      textColor: `rgba(${red},${green},${blue},1)`,
      borderColor: `rgba(${red},${green},${blue},1)`,
    });
  });

  const calendarEl = document.getElementById("calendar");
  const calender = new FullCalendar.Calendar(calendarEl, {
    initialView: "dayGridMonth",
    contentHeight: "auto",
    events: events,
  });
  calender.render();
});
