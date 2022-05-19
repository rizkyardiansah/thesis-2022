// Call the dataTables jQuery plugin
$(document).ready(function () {
  $("#repositorySkripsi").DataTable({
    dom: '<"row align-items-center"<"col-md-6" l><"col-md-6" f>><"table-responsive border-bottom my-3" rt><"row align-items-center" <"col-md-6" i><"col-md-6" p>><"clear">',
    //columnDefs: [{ width: "10%", targets: 1 }],
  });
  $("#proposalMahasiswa").DataTable({
    dom: '<"row align-items-center"<"col-md-6" l><"col-md-6" f>><"table-responsive border-bottom my-3" rt><"row align-items-center" <"col-md-6" i><"col-md-6" p>><"clear">',
    //columnDefs: [{ width: "10%", targets: 1 }],
  });

  $("#kegiatanSkripsi").DataTable({
    dom: '<"row align-items-center"<"col-md-6" l><"col-md-6" f>><"table-responsive border-bottom my-3" rt><"row align-items-center" <"col-md-6" i><"col-md-6" p>><"clear">',
  });
});
