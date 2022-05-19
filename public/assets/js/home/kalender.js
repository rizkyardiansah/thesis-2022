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
// document.addEventListener("DOMContentLoaded", function () {
//   var calendarEl = document.getElementById("calendar");
//   var calendar = new FullCalendar.Calendar(calendarEl, {
//     initialView: "dayGridMonth",
//     contentHeight: "auto",
//     events: [
//       {
//         title: "Pengumpulan Proposal Skripsi beserta persyaratannya",
//         url: "http://google.com/",
//         start: moment("14-02-2022", "DD-MM-YYYY").format("YYYY-MM-DD"),
//         end: moment("19-02-2022", "DD-MM-YYYY")
//           .add(1, "days")
//           .format("YYYY-MM-DD"),
//         backgroundColor: "rgba(58,87,232,0.2)",
//         textColor: "rgba(58,87,232,1)",
//         borderColor: "rgba(58,87,232,1)",
//       },
//       {
//         title: "Seminar Proposal Skripsi",
//         start: moment("21-02-2022", "DD-MM-YYYY").format("YYYY-MM-DD"),
//         end: moment("01-03-2022", "DD-MM-YYYY")
//           .add(1, "days")
//           .format("YYYY-MM-DD"),
//         backgroundColor: "rgba(108,117,125,0.2)",
//         textColor: "rgba(108,117,125,1)",
//         borderColor: "rgba(108,117,125,1)",
//       },
//       {
//         title: "Pengumuman Pembimbing Skripsi",
//         start: moment("04-03-2022", "DD-MM-YYYY").format("YYYY-MM-DD"),
//         backgroundColor: "rgba(8,130,12,0.2)",
//         textColor: "rgba(8,130,12,1)",
//         borderColor: "rgba(8,130,12,1)",
//       },
//       {
//         title: "Revisi dan Fiksasi Proposal",
//         start: moment("07-03-2022", "DD-MM-YYYY").format("YYYY-MM-DD"),
//         end: moment("11-03-2022", "DD-MM-YYYY")
//           .add(1, "days")
//           .format("YYYY-MM-DD"),
//         backgroundColor: "rgba(8,130,12,0.2)",
//         textColor: "rgba(8,130,12,1)",
//         borderColor: "rgba(8,130,12,1)",
//       },
//       {
//         title: "Penguatan Skripsi",
//         start: moment("03-03-2022", "DD-MM-YYYY").format("YYYY-MM-DD"),
//         end: moment("20-03-2022", "DD-MM-YYYY")
//           .add(1, "days")
//           .format("YYYY-MM-DD"),
//         backgroundColor: "rgba(58,87,232,0.2)",
//         textColor: "rgba(58,87,232,1)",
//         borderColor: "rgba(58,87,232,1)",
//       },
//       {
//         title: "Pengumpulan Draft Seminar Pra Sidang",
//         start: moment("09-05-2022", "DD-MM-YYYY").format("YYYY-MM-DD"),
//         end: moment("13-05-2022", "DD-MM-YYYY")
//           .add(1, "days")
//           .format("YYYY-MM-DD"),
//         backgroundColor: "rgba(58,87,232,0.2)",
//         textColor: "rgba(58,87,232,1)",
//         borderColor: "rgba(58,87,232,1)",
//       },
//       {
//         title: "Seminar Pra Sidang",
//         start: moment("19-05-2022", "DD-MM-YYYY").format("YYYY-MM-DD"),
//         end: moment("03-06-2022", "DD-MM-YYYY")
//           .add(1, "days")
//           .format("YYYY-MM-DD"),
//         backgroundColor: "rgba(58,87,232,0.2)",
//         textColor: "rgba(58,87,232,1)",
//         borderColor: "rgba(58,87,232,1)",
//       },
//       {
//         title: "Masa Bimbingan Skripsi",
//         start: moment("08-03-2022", "DD-MM-YYYY").format("YYYY-MM-DD"),
//         end: moment("15-07-2022", "DD-MM-YYYY")
//           .add(1, "days")
//           .format("YYYY-MM-DD"),
//         backgroundColor: "rgba(235,153,27,0.2)",
//         textColor: "rgba(235,153,27,1)",
//         borderColor: "rgba(235,153,27,1)",
//       },
//       {
//         title: "Pengumpulan Draft Sidang Skripsi beserta persyaratannya",
//         start: moment("13-06-2022", "DD-MM-YYYY").format("YYYY-MM-DD"),
//         end: moment("17-06-2022", "DD-MM-YYYY")
//           .add(1, "days")
//           .format("YYYY-MM-DD"),
//         backgroundColor: "rgba(235,153,27,0.2)",
//         textColor: "rgba(235,153,27,1)",
//         borderColor: "rgba(235,153,27,1)",
//       },
//       {
//         title: "Sidang Skripsi",
//         start: moment("20-06-2022", "DD-MM-YYYY").format("YYYY-MM-DD"),
//         end: moment("20-06-2022", "DD-MM-YYYY")
//           .add(1, "days")
//           .format("YYYY-MM-DD"),
//         backgroundColor: "rgba(58,87,232,0.2)",
//         textColor: "rgba(58,87,232,1)",
//         borderColor: "rgba(58,87,232,1)",
//       },
//       {
//         title: "Masa Revisi Setelah Sidang",
//         start: moment("01-07-2022", "DD-MM-YYYY").format("YYYY-MM-DD"),
//         end: moment("14-07-2022", "DD-MM-YYYY")
//           .add(1, "days")
//           .format("YYYY-MM-DD"),
//         backgroundColor: "rgba(58,87,232,0.2)",
//         textColor: "rgba(58,87,232,1)",
//         borderColor: "rgba(58,87,232,1)",
//       },
//       {
//         title: "Pengumpulan Revisi dan Lembar Pengesahan",
//         start: moment("14-07-2022", "DD-MM-YYYY").format("YYYY-MM-DD"),
//         end: moment("15-07-2022", "DD-MM-YYYY")
//           .add(1, "days")
//           .format("YYYY-MM-DD"),
//         backgroundColor: "rgba(58,87,232,0.2)",
//         textColor: "rgba(58,87,232,1)",
//         borderColor: "rgba(58,87,232,1)",
//       },
//     ],
//   });
//   calendar.render();
// });
