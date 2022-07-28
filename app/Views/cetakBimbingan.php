<?php 
    $bulanDict = [
        "01" => "Januari",
        "02" => "Februari",
        "03" => "Maret",
        "04" => "April",
        "05" => "Mei",
        "06" => "Juni",
        "07" => "Juli",
        "08" => "Agustus",
        "09" => "September",
        "10" => "Oktober",
        "11" => "November",
        "12" => "December",
    ];

    $hariDict = [
        "0" => "Minggu",
        "1" => "Senin",
        "2" => "Selasa",
        "3" => "Rabu",
        "4" => "Kamis",
        "5" => "Jumat",
        "6" => "Sabtu",
    ];

    $today = new DateTime("now", new DateTimeZone('Asia/Jakarta'))
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulir Bimbingan Skripsi</title>
    <style>
        @media print {
            .new-page {
                page-break-before: always;
            }

            @page {
                size: A4;
            }
        }

        .text-center {
            text-align: center;
        }

        .table-center {
            margin-left: auto;
            margin-right: auto;
        }

        .panel-heading {
            margin-bottom: 0;
        }
    </style>
</head>
<body onload="window.print()">
    <div>
        <td height="165" colspan="3" class="text-center">
            <p class="panel-heading">
                <img src="<?= base_url("assets/img/fti.jpg") ?>" width="157" height="62" align="absmiddle"> 
            </p>
        </td>

        <table width="100%" border="0" class="table-center">
            <tr>
                <td class="text-center">
                    <h4>FORMULIR BIMBINGAN SKRIPSI</h4>
                </td>
            </tr>

            <tr>
                <table width="100%" border="0" class="table-center">
                    <tr>
                        <td width="15%"><strong>Nama</strong></td>
                        <td width="3%" class="text-center">:</td>
                        <td width="82%"><?= $mahasiswa['nama'] ?></td>
                    </tr>
                    <tr>
                        <td width="15%"><strong>NPM</strong></td>
                        <td width="3%" class="text-center">:</td>
                        <td width="82%"><?= $mahasiswa['npm'] ?></td>
                    </tr>
                    <tr>
                        <td width="15%"><strong>Program Studi</strong></td>
                        <td width="3%" class="text-center">:</td>
                        <td width="82%"><?= $prodi['nama'] ?></td>
                    </tr>
                    <tr>
                        <td width="15%"><strong>Judul Skripsi</strong></td>
                        <td width="3%" class="text-center">:</td>
                        <td width="82%"><?= $lastSkripsi['judul'] ?></td>
                    </tr>
                </table>
            </tr>
            <br>
            <br>
            <tr>
                <td>
                    <table width="100%" border="1" bordercolor="#000" class="table-center" cellpadding="3" cellspacing="0">
                        <tr>
                            <th colspan="2" width="40%">PERTEMUAN</th>
                            <th rowspan="2" width="45%">MATERI</th>
                            <th rowspan="2" width="15%">STATUS</th>
                        </tr>
                        <tr>
                            <th>KE</th>
                            <th>TANGGAL</th>
                        </tr>

                        <?php $counter = 1; ?>
                        <?php foreach($hasilBimbinganIlmu1 as $hbi1): ?>
                            <tr>
                                <td width="5%" class="text-center"><?= $counter; ?></td>
                                <td width="15%" class="text-center"><?= date_format(date_create($hbi1['tanggal_bimbingan']), "d-m-Y"); ?></td>
                                <td width="35%" class="text-center"><?= $hbi1['hasil_bimbingan']; ?></td>
                                <td width="10%" class="text-center"><?= $hbi1['status'] ;?></td>
                            </tr>
                            <?php $counter++; ?>
                        <?php endforeach; ?>
                    </table>
                </td>
            </tr>
            <br>
            <br>
            <tr>
                <td >
                    <div style="text-align: right;">
                        Jakarta, <?= $today->format("d") ?> <?= $bulanDict[$today->format("m")] ?> <?= $today->format("Y") ?>
                    </div>
                </td>
            </tr>
            <br>
            <tr>
                <td>
                    <table width="100%">
                        <tr >
                            <?php if ($pembimbingIlmu2[0]['id_dosen'] != null): ?>
                                <td class="text-center" width="50%">Pembimbing Ilmu 1</td>
                            <?php else: ?>
                                <td class="text-center" width="50%">Pembimbing Ilmu</td>
                            <?php endif; ?>
                            <td class="text-center" width="50%">Mahasiswa</td>
                        </tr>    
                            <td class="text-center" width="50%"><br><br><br><br></td>
                            <td class="text-center" width="50%"><br><br><br><br></td>
                        </tr>
                        <tr>
                            <td class="text-center" width="50%"><?= $pembimbingIlmu1[0]['nama_dosen']; ?></td>
                            <td class="text-center" width="50%"><?= $mahasiswa['nama'] ?></td>
                        </tr>
                    </table>
                </td>
            </tr>
            <br>
            <br>
            <tr>
                <td>
                    <p style="margin-bottom: 0"><strong>Catatan:</strong></p>
                    <ol style="margin-top: 5px">
                        <li>Setiap Pertemuan, wajib mengisi kolom yang tersedia.</li>
                        <li>Lamanya kesempatan pertemuan adalah 6 bulan.</li>
                        <li>Minimal 8 kali pertemuan dengan Pembimbing Ilmu dan 4 kali pertemuan dengan Pembimbing Agama.</li>
                        <li>Pada saat pendaftaran sidang skripsi, formulir ini wajib diserahkan ke TU bersama dengan berkas skripsi.</li>
                    </ol>
                </td>
            </tr>
        </table>
    </div>

    <div class="new-page"></div>

    <?php if ($pembimbingIlmu2[0]['id_dosen'] != null): ?>
        <div>
            <td height="165" colspan="3" class="text-center">
                <p class="panel-heading">
                    <img src="<?= base_url("assets/img/fti.jpg") ?>" width="157" height="62" align="absmiddle"> 
                </p>
            </td>

            <table width="100%" border="0" class="table-center">
                <tr>
                    <td class="text-center">
                        <h4>FORMULIR BIMBINGAN SKRIPSI</h4>
                    </td>
                </tr>

                <tr>
                    <table width="100%" border="0" class="table-center">
                        <tr>
                            <td width="15%"><strong>Nama</strong></td>
                            <td width="3%" class="text-center">:</td>
                            <td width="82%"><?= $mahasiswa['nama'] ?></td>
                        </tr>
                        <tr>
                            <td width="15%"><strong>NPM</strong></td>
                            <td width="3%" class="text-center">:</td>
                            <td width="82%"><?= $mahasiswa['npm'] ?></td>
                        </tr>
                        <tr>
                            <td width="15%"><strong>Program Studi</strong></td>
                            <td width="3%" class="text-center">:</td>
                            <td width="82%"><?= $prodi['nama'] ?></td>
                        </tr>
                        <tr>
                            <td width="15%"><strong>Judul Skripsi</strong></td>
                            <td width="3%" class="text-center">:</td>
                            <td width="82%"><?= $lastSkripsi['judul'] ?></td>
                        </tr>
                    </table>
                </tr>
                <br>
                <br>
                <tr>
                    <td>
                        <table width="100%" border="1" bordercolor="#000" class="table-center" cellpadding="3" cellspacing="0">
                            <tr>
                                <th colspan="2" width="40%">PERTEMUAN</th>
                                <th rowspan="2" width="45%">MATERI</th>
                                <th rowspan="2" width="15%">STATUS</th>
                            </tr>
                            <tr>
                                <th>KE</th>
                                <th>TANGGAL</th>
                            </tr>

                            <?php $counter = 1; ?>
                            <?php foreach($hasilBimbinganIlmu2 as $hbi2): ?>
                                <tr>
                                    <td width="5%" class="text-center"><?= $counter; ?></td>
                                    <td width="15%" class="text-center"><?= date_format(date_create($hbi2['tanggal_bimbingan']), "d-m-Y"); ?></td>
                                    <td width="35%" class="text-center"><?= $hbi2['hasil_bimbingan']; ?></td>
                                    <td width="10%" class="text-center"><?= $hbi2['status'] ;?></td>
                                </tr>
                                <?php $counter++; ?>
                            <?php endforeach; ?>
                        </table>
                    </td>
                </tr>
                <br>
                <br>
                <tr>
                    <td >
                        <div style="text-align: right;">
                            Jakarta, <?= $today->format("d") ?> <?= $bulanDict[$today->format("m")] ?> <?= $today->format("Y") ?>
                        </div>
                    </td>
                </tr>
                <br>
                <tr>
                    <td>
                        <table width="100%">
                            <tr >
                                <td class="text-center" width="50%">Pembimbing Ilmu 2</td>
                                <td class="text-center" width="50%">Mahasiswa</td>
                            </tr>    
                                <td class="text-center" width="50%"><br><br><br><br></td>
                                <td class="text-center" width="50%"><br><br><br><br></td>
                            </tr>
                            <tr>
                                <td class="text-center" width="50%"><?= $pembimbingIlmu2[0]['nama_dosen']; ?></td>
                                <td class="text-center" width="50%"><?= $mahasiswa['nama'] ?></td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <br>
                <br>
                <tr>
                    <td>
                        <p style="margin-bottom: 0"><strong>Catatan:</strong></p>
                        <ol style="margin-top: 5px">
                            <li>Setiap Pertemuan, wajib mengisi kolom yang tersedia.</li>
                            <li>Lamanya kesempatan pertemuan adalah 6 bulan.</li>
                            <li>Minimal 8 kali pertemuan dengan Pembimbing Ilmu dan 4 kali pertemuan dengan Pembimbing Agama.</li>
                            <li>Pada saat pendaftaran sidang skripsi, formulir ini wajib diserahkan ke TU bersama dengan berkas skripsi.</li>
                        </ol>
                    </td>
                </tr>
            </table>
        </div>

        <div class="new-page"></div>
    <?php endif; ?>
    
    <div>
        <td height="165" colspan="3" class="text-center">
            <p class="panel-heading">
                <img src="<?= base_url("assets/img/fti.jpg") ?>" width="157" height="62" align="absmiddle"> 
            </p>
        </td>

        <table width="100%" border="0" class="table-center">
            <tr>
                <td class="text-center">
                    <h4>FORMULIR BIMBINGAN SKRIPSI</h4>
                </td>
            </tr>

            <tr>
                <table width="100%" border="0" class="table-center">
                    <tr>
                        <td width="15%"><strong>Nama</strong></td>
                        <td width="3%" class="text-center">:</td>
                        <td width="82%"><?= $mahasiswa['nama'] ?></td>
                    </tr>
                    <tr>
                        <td width="15%"><strong>NPM</strong></td>
                        <td width="3%" class="text-center">:</td>
                        <td width="82%"><?= $mahasiswa['npm'] ?></td>
                    </tr>
                    <tr>
                        <td width="15%"><strong>Program Studi</strong></td>
                        <td width="3%" class="text-center">:</td>
                        <td width="82%"><?= $prodi['nama'] ?></td>
                    </tr>
                    <tr>
                        <td width="15%"><strong>Judul Skripsi</strong></td>
                        <td width="3%" class="text-center">:</td>
                        <td width="82%"><?= $lastSkripsi['judul'] ?></td>
                    </tr>
                </table>
            </tr>
            <br>
            <br>
            <tr>
                <td>
                    <table width="100%" border="1" bordercolor="#000" class="table-center" cellpadding="3" cellspacing="0">
                        <tr>
                            <th colspan="2">PERTEMUAN</th>
                            <th rowspan="2">MATERI</th>
                            <th rowspan="2">STATUS</th>
                        </tr>
                        <tr>
                            <th>KE</th>
                            <th>TANGGAL</th>
                        </tr>

                        <?php $counter = 1; ?>
                        <?php foreach($hasilBimbinganAgama as $hba): ?>
                            <tr>
                                <td width="5%" class="text-center"><?= $counter; ?></td>
                                <td width="15%" class="text-center"><?= date_format(date_create($hba['tanggal_bimbingan']), "d-m-Y"); ?></td>
                                <td width="35%" class="text-center"><?= $hba['hasil_bimbingan']; ?></td>
                                <td width="10%" class="text-center"><?= $hba['status'] ;?></td>
                            </tr>
                            <?php $counter++; ?>
                        <?php endforeach; ?>
                    </table>
                </td>
            </tr>
            <br>
            <br>
            <tr>
                <td >
                    <div style="text-align: right;">
                        Jakarta, <?= $today->format("d") ?> <?= $bulanDict[$today->format("m")] ?> <?= $today->format("Y") ?>
                    </div>
                </td>
            </tr>
            <br>
            <tr>
                <td>
                    <table width="100%">
                        <tr >
                            <td class="text-center" width="50%">Pembimbing Agama</td>
                            <td class="text-center" width="50%">Mahasiswa</td>
                        </tr>    
                            <td class="text-center" width="50%"><br><br><br><br></td>
                            <td class="text-center" width="50%"><br><br><br><br></td>
                        </tr>
                        <tr>
                            <td class="text-center" width="50%"><?= $pembimbingAgama[0]['nama_dosen']; ?></td>
                            <td class="text-center" width="50%"><?= $mahasiswa['nama'] ?></td>
                        </tr>
                    </table>
                </td>
            </tr>
            <br>
            <br>
            <tr>
                <td>
                    <p style="margin-bottom: 0"><strong>Catatan:</strong></p>
                    <ol style="margin-top: 5px">
                        <li>Setiap Pertemuan, wajib mengisi kolom yang tersedia.</li>
                        <li>Lamanya kesempatan pertemuan adalah 6 bulan.</li>
                        <li>Minimal 8 kali pertemuan dengan Pembimbing Ilmu dan 4 kali pertemuan dengan Pembimbing Agama.</li>
                        <li>Pada saat pendaftaran sidang skripsi, formulir ini wajib diserahkan ke TU bersama dengan berkas skripsi.</li>
                    </ol>
                </td>
            </tr>
        </table>
    </div>
</body>
</html>