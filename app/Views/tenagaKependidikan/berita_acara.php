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
    <title>Berita Acara Ujian Skripsi</title>
    <style>
        /* body {
            font-size: 1.4vh;
        } */

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

        p {
            text-align: justify;
            text-justify: inter-word;
        }

        .container {
            display: inline-block;
            vertical-align: middle;
        }

        .box {
            display: inline-block;
            box-sizing: border-box;
            height: 50px;
            width: 75px;
            border: 1px solid;
            font-size: 24px;
            line-height: 50px;
        }

        input[type='checkbox'] {
            accent-color: #34495e
        }

        @media print {
            .new-page {
                page-break-before: always;
                break-before: page;
            }

            @page {
                size: A4;
            }
        }
    </style>
</head>
<body onload="window.print()">
<?php $counter = 1; ?>
<?php foreach($arrBeritaAcara as $aba): ?>
    <div>
        <td height="165" colspan="3" class="text-center">
            <p class="panel-heading">
                <img src="<?= base_url("assets/img/fti.jpg") ?>" width="157" height="62" align="absmiddle"> 
            </p>
        </td>

        <table width="100%" style="border: 0" class="table-center">
            <tr>
                <td class="text-center">
                    <h4>BERITA ACARA UJIAN SKRIPSI</h4>
                </td>
            </tr>

            <tr>
                <td>
                    <p>
                        Yang bertanda tangan di bawah ini Komisi Penguji Skripsi Program Studi <?= $aba['prodi']['nama'] ?> Program Sarjana Fakultas Teknologi Informasi Universitas YARSI dengan ini menyatakan dengan sebenarnya bahwa pada:
                    </p>
                </td>
            </tr>

            <tr>
                <table width="80%" style="border: 0" class="table-center">
                    <tr width="100%">
                        <td width="20%">Hari/Tanggal</td>
                        <td width="4%">:</td>
                        <?php $tanggal = new DateTime($aba['sidangSkripsi']['tanggal'], new DateTimeZone('Asia/Jakarta')) ?>
                        <td width="76%"><?= $hariDict[$tanggal->format("w")] ?>, <?= $tanggal->format('d') ?> <?= $bulanDict[$tanggal->format("m")] ?> <?= $tanggal->format("Y") ?></td>
                    </tr>
                    <tr width="100%">
                        <td width="20%">Jam</td>
                        <td width="4%">:</td>
                        <td width="76%"><?= $tanggal->format('H:i') ?> WIB</td>
                    </tr>
                    <tr width="100%">
                        <td width="20%">Bertempat di</td>
                        <td width="4%">:</td>
                        <td width="76%"><?= preg_match('#^https?://#i', $aba['sidangSkripsi']['ruangan']) === 1 ? 'Link Zoom' : $aba['sidangSkripsi']['ruangan'] ?></td>
                    </tr>
                </table>
            </tr>

            <tr>
                <td>
                    <p>
                        Telah menyelengarakan Ujian Skripsi terhadap mahasiswa:
                    </p>
                </td>
            </tr>

            <tr>
                <table width="80%" style="border: 0" class="table-center">
                    <tr width="100%">
                        <td width="20%">Nama</td>
                        <td width="4%">:</td>
                        <td width="76%"><?= $aba['mahasiswa']['nama'] ?></td>
                    </tr>
                    <tr width="100%">
                        <td width="20%">NPM</td>
                        <td width="4%">:</td>
                        <td width="76%"><?= $aba['mahasiswa']['npm'] ?></td>
                    </tr>
                    <tr width="100%">
                        <td width="20%">Program Studi</td>
                        <td width="4%">:</td>
                        <td width="76%"><?= $aba['prodi']['nama'] ?> Program Sarjana</td>
                    </tr>
                </table>
            </tr>
          
            <tr>
                <td>
                    <p>
                        Dengan judul : <strong>“<?= $aba['lastSkripsi']['judul'] ?>”</strong>
                    </p>
                </td>
            </tr>

            <tr>
                <td style="height: 150px";>
                    <p style="display: inline-block;">
                        Hasil ujian dengan kualifikasi:
                    </p>
                </td>

                <td>
                    <div class="container">
                        <div class="box text-center"><strong><?= $aba['sidangSkripsi']['grade'] == null ? "-" : $aba['sidangSkripsi']['grade'] ?></strong></div>
                        <div class="box text-center"><strong><?= number_format($aba['sidangSkripsi']['total_nilai'], 2, ".", "") ?></strong></div>
                    </div>
                </td>
            </tr>

            <br><br>

            <tr>
                <td width="100%">
                    <p style="margin-bottom: 0;" class="text-center">Jakarta, <?= $today->format("d") ?> <?= $bulanDict[$today->format("m")] ?> <?= $today->format("Y") ?></p>
                </td>
            </tr>

            <tr>
                <td>
                    <table width="100%" class="table-center">
                        <tr>
                            <td class="text-center">Ketua Komisi Penguji</td>
                        </tr>    
                        <tr>
                            <td><br><br><br><br><br></td>
                        </tr>
                        <tr>
                            <td class="text-center"><strong>(<?= $aba['penguji']['nama'] ?>)</strong></td>
                        </tr>
                    </table>
                </td>
            </tr>

            <br><br>

            <tr>
                <td>
                    <?php $width = ($aba['pembimbingIlmu2'][0]['id_dosen'] == null) ? "33%" : "25%"?>
                    <table width="100%" class="table-center">
                        <tr>
                            <td class="text-center" width="<?= $width ?>">Penguji Murni</td>
                            <?php if ($aba['pembimbingIlmu2'][0]['id_dosen'] == null) : ?>
                                <td class="text-center" width="<?= $width ?>">Pembimbing Ilmu / Penguji</td>
                            <?php else: ?>
                                <td class="text-center" width="<?= $width ?>">Pembimbing Ilmu 1 / Penguji</td>
                                <td class="text-center" width="<?= $width ?>">Pembimbing Ilmu 2 / Penguji</td>
                            <?php endif; ?> 
                            <td class="text-center" width="<?= $width ?>">Pembimbing Agama / Penguji</td>
                        </tr>    
                        <tr>
                            <td><br><br><br><br><br></td>
                            <?php if ($aba['pembimbingIlmu2'][0]['id_dosen'] == null) : ?>
                                <td width="<?= $width ?>"><br><br><br><br><br></td>
                            <?php else: ?>
                                <td width="<?= $width ?>"><br><br><br><br><br></td>
                                <td width="<?= $width ?>"><br><br><br><br><br></td>
                            <?php endif; ?> 
                            <td width="<?= $width ?>"><br><br><br><br><br></td>
                        </tr>
                        <tr>
                            <td class="text-center" width="<?= $width ?>"><strong>(<?= $aba['penguji']['nama'] ?>)</strong></td>
                            <?php if ($aba['pembimbingIlmu2'][0]['id_dosen'] == null) : ?>
                                <td class="text-center" width="<?= $width ?>"><strong>(<?= $aba['pembimbingIlmu1'][0]['nama_dosen'] ?>)</strong></td>
                            <?php else: ?>
                                <td class="text-center" width="<?= $width ?>"><strong>(<?= $aba['pembimbingIlmu1'][0]['nama_dosen'] ?>)</strong></td>
                                <td class="text-center" width="<?= $width ?>"><strong>(<?= $aba['pembimbingIlmu2'][0]['nama_dosen'] ?>)</strong></td>
                            <?php endif; ?> 
                            <td class="text-center" width="<?= $width ?>"><strong>(<?= $aba['pembimbingAgama'][0]['nama_dosen'] ?>)</strong></td>
                        </tr>
                    </table>
                </td>
            </tr>
        </table>
    </div>

    <div class="new-page"></div>

    <div>
        <td height="165" colspan="3" class="text-center">
            <p class="panel-heading">
                <img src="<?= base_url("assets/img/fti.jpg") ?>" width="157" height="62" align="absmiddle"> 
            </p>
        </td>

        <table width="100%" style="border: 0" class="table-center">
            <tr>
                <td class="text-center">
                    <h4>PENILAIAN UJIAN SKRIPSI</h4>
                </td>
            </tr>

            <tr>
                <table width="100%" style="border: 0">
                    <tr width="100%">
                        <td width="20%"><strong>Nama</strong></td>
                        <td width="5%">:</td>
                        <td width="75%"><?= $aba['mahasiswa']['nama'] ?></td>
                    </tr>
                    <tr width="100%">
                        <td width="20%"><strong>NPM</strong></td>
                        <td width="5%">:</td>
                        <td width="75%"><?= $aba['mahasiswa']['npm'] ?></td>
                    </tr>
                    <tr width="100%">
                        <td width="20%"><strong>Program Studi</strong></td>
                        <td width="5%">:</td>
                        <td width="75%"><?= $aba['prodi']['nama'] ?> Program Sarjana</td>
                    </tr>
                </table>
            </tr>

            <tr>
                <td>
                    <p style="margin-bottom: 0"><STRONG>1. PENYAJIAN LISAN</STRONG></p>
                    <table width="100%" style="border: 1px solid; border-collapse: collapse" class="table-center">
                        <tr>
                            <th style="border: 1px solid;width: 5%">NO</th>
                            <th style="border: 1px solid;width: 70%">PERINCIAN ASPEK</th>
                            <th style="border: 1px solid;width: 25%">NILAI (SKALA 0.....4)</th>
                        </tr>
                        <tr width="100%">
                            <td class="text-center" style="border: 1px solid;">1</td>
                            <td style="border: 1px solid;">Penyajian sesuai dengan waktu yang disediakan.</td>
                            <td class="text-center" style="border: 1px solid;"><?= number_format($aba['nilaiPenguji'][0]['nilai_1'], 2, ".", "") ?></td>
                        </tr>
                        <tr width="100%">
                            <td class="text-center" style="border: 1px solid;">2</td>
                            <td style="border: 1px solid;">Relevansi penyajian dengan isi skripsi.</td>
                            <td class="text-center" style="border: 1px solid;"><?= number_format($aba['nilaiPenguji'][0]['nilai_2'], 2, ".", "") ?></td>
                        </tr>
                        <tr width="100%">
                            <td class="text-center" style="border: 1px solid;">3</td>
                            <td style="border: 1px solid;">Cara penyajian (Kelancaran, kejelasan, penampilan/sikap, dll).</td>
                            <td class="text-center" style="border: 1px solid;"><?= number_format($aba['nilaiPenguji'][0]['nilai_3'], 2, ".", "") ?></td>
                        </tr>
                        <tr>
                            <td colspan="3" class="text-center">
                                <?php $totalNilai1Penguji = $aba['nilaiPenguji'][0]['nilai_1'] + $aba['nilaiPenguji'][0]['nilai_2'] + $aba['nilaiPenguji'][0]['nilai_3'] ?>
                                <strong>TOTAL ( 1 + 2 + 3 ) =</strong> <?= number_format($totalNilai1Penguji, 2, ".", "") ?> <strong>NILAI: ( </strong><?= number_format($aba['nilaiPenguji'][0]['nilai_1'], 2, ".", "") ?> + <?= number_format($aba['nilaiPenguji'][0]['nilai_2'], 2, ".", "") ?> + <?= number_format($aba['nilaiPenguji'][0]['nilai_3'], 2, ".", "") ?><strong> ) X 15 = <?= number_format($totalNilai1Penguji * 15, 2, ".", "") ?></strong>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>

            <tr>
                <td>
                    <p style="margin-bottom: 0"><STRONG>2. TEKNIK DAN SISTEMATIKA PENULISAN</STRONG></p>
                    <table width="100%" style="border: 1px solid; border-collapse: collapse" class="table-center">
                        <tr>
                            <th style="border: 1px solid;width: 5%">NO</th>
                            <th style="border: 1px solid;width: 70%">PERINCIAN ASPEK</th>
                            <th style="border: 1px solid;width: 25%">NILAI (SKALA 0.....4)</th>
                        </tr>
                        <tr width="100%">
                            <td class="text-center" style="border: 1px solid;">1</td>
                            <td style="border: 1px solid;">Kesinambungan antara alinea, antar bab dalam susunan skripsi.</td>
                            <td class="text-center" style="border: 1px solid;"><?= number_format($aba['nilaiPenguji'][0]['nilai_4'], 2, ".", "") ?></td>
                        </tr>
                        <tr width="100%">
                            <td class="text-center" style="border: 1px solid;">2</td>
                            <td style="border: 1px solid;">Tata cara penulisan kepustakaan dan catatan kaki.</td>
                            <td class="text-center" style="border: 1px solid;"><?= number_format($aba['nilaiPenguji'][0]['nilai_5'], 2, ".", "") ?></td>
                        </tr>
                        <tr width="100%">
                            <td class="text-center" style="border: 1px solid;">3</td>
                            <td style="border: 1px solid;">Kebersihan dan kerapihan penulisan.</td>
                            <td class="text-center" style="border: 1px solid;"><?= number_format($aba['nilaiPenguji'][0]['nilai_6'], 2, ".", "") ?></td>
                        </tr>
                        <tr>
                           <td colspan="3" class="text-center">
                                <?php $totalNilai2Penguji = $aba['nilaiPenguji'][0]['nilai_4'] + $aba['nilaiPenguji'][0]['nilai_5'] + $aba['nilaiPenguji'][0]['nilai_6'] ?>
                                <strong>TOTAL ( 1 + 2 + 3 ) =</strong> <?= number_format($totalNilai2Penguji, 2, ".", "") ?> <strong>NILAI: ( </strong><?= number_format($aba['nilaiPenguji'][0]['nilai_4'], 2, ".", "") ?> + <?= number_format($aba['nilaiPenguji'][0]['nilai_5'], 2, ".", "") ?> + <?= number_format($aba['nilaiPenguji'][0]['nilai_6'], 2, ".", "") ?><strong> ) X 20 = <?= number_format($totalNilai2Penguji * 20, 2, ".", "") ?></strong>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>

            <tr>
                <td>
                    <p style="margin-bottom: 0"><STRONG>3. ISI TULISAN</STRONG></p>
                    <table width="100%" style="border: 1px solid; border-collapse: collapse;" class="table-center">
                        <tr>
                            <th style="border: 1px solid;width: 5%">NO</th>
                            <th style="border: 1px solid;width: 70%">PERINCIAN ASPEK</th>
                            <th style="border: 1px solid;width: 25%">NILAI (SKALA 0.....4)</th>
                        </tr>
                        <tr width="100%">
                            <td class="text-center" style="border: 1px solid;">1</td>
                            <td style="border: 1px solid;">Kejelasan rumusan penulisan.</td>
                            <td class="text-center" style="border: 1px solid;"><?= number_format($aba['nilaiPenguji'][0]['nilai_7'], 2, ".", "") ?></td>
                        </tr>
                        <tr width="100%">
                            <td class="text-center" style="border: 1px solid;">2</td>
                            <td style="border: 1px solid;">Kesesuaian isi tulisan dengan judul skripsi.</td>
                            <td class="text-center" style="border: 1px solid;"><?= number_format($aba['nilaiPenguji'][0]['nilai_8'], 2, ".", "") ?></td>
                        </tr>
                        <tr width="100%">
                            <td class="text-center" style="border: 1px solid;">3</td>
                            <td style="border: 1px solid;">Kemampuan membuat analisa dan pembahasan.</td>
                            <td class="text-center" style="border: 1px solid;"><?= number_format($aba['nilaiPenguji'][0]['nilai_9'], 2, ".", "") ?></td>
                        </tr>
                        <tr>
                            <td colspan="3" class="text-center">
                                <?php $totalNilai3Penguji = $aba['nilaiPenguji'][0]['nilai_7'] + $aba['nilaiPenguji'][0]['nilai_8'] + $aba['nilaiPenguji'][0]['nilai_9'] ?>
                                <strong>TOTAL ( 1 + 2 + 3 ) =</strong> <?= number_format($totalNilai3Penguji, 2, ".", "") ?> <strong>NILAI: ( </strong><?= number_format($aba['nilaiPenguji'][0]['nilai_7'], 2, ".", "") ?> + <?= number_format($aba['nilaiPenguji'][0]['nilai_8'], 2, ".", "") ?> + <?= number_format($aba['nilaiPenguji'][0]['nilai_9'], 2, ".", "") ?><strong> ) X 25 = <?= number_format($totalNilai3Penguji * 25, 2, ".", "") ?></strong>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>

            <tr>
                <td>
                    <p style="margin-bottom: 0"><STRONG>4. TANYA JAWAB</STRONG></p>
                    <table width="100%" style="border: 1px solid; border-collapse: collapse" class="table-center">
                        <tr>
                            <th style="border: 1px solid;width: 5%">NO</th>
                            <th style="border: 1px solid;width: 70%">PERINCIAN ASPEK</th>
                            <th style="border: 1px solid;width: 25%">NILAI (SKALA 0.....4)</th>
                        </tr>
                        <tr width="100%">
                            <td class="text-center" style="border: 1px solid;">1</td>
                            <td style="border: 1px solid;">Pengetahuan umum yang berhubungan dengan tulisan.</td>
                            <td class="text-center" style="border: 1px solid;"><?= number_format($aba['nilaiPenguji'][0]['nilai_10'], 2, ".", "") ?></td>
                        </tr>
                        <tr width="100%">
                            <td class="text-center" style="border: 1px solid;">2</td>
                            <td style="border: 1px solid;">Pengetahuan khusus tentang isi tulisan.</td>
                            <td class="text-center" style="border: 1px solid;"><?= number_format($aba['nilaiPenguji'][0]['nilai_11'], 2, ".", "") ?></td>
                        </tr>
                        <tr width="100%">
                            <td class="text-center" style="border: 1px solid;">3</td>
                            <td style="border: 1px solid;">Ketepatan menjawab.</td>
                            <td class="text-center" style="border: 1px solid;"><?= number_format($aba['nilaiPenguji'][0]['nilai_12'], 2, ".", "") ?></td>
                        </tr>
                        <tr>
                            <td colspan="3" class="text-center">
                                <?php $totalNilai4Penguji = $aba['nilaiPenguji'][0]['nilai_10'] + $aba['nilaiPenguji'][0]['nilai_11'] + $aba['nilaiPenguji'][0]['nilai_12'] ?>
                                <strong>TOTAL ( 1 + 2 + 3 ) =</strong> <?= number_format($totalNilai4Penguji, 2, ".", "") ?> <strong>NILAI: ( </strong><?= number_format($aba['nilaiPenguji'][0]['nilai_10'], 2, ".", "") ?> + <?= number_format($aba['nilaiPenguji'][0]['nilai_11'], 2, ".", "") ?> + <?= number_format($aba['nilaiPenguji'][0]['nilai_12'], 2, ".", "") ?><strong> ) X 40 = <?= number_format($totalNilai4Penguji * 40, 2, ".", "") ?></strong>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>

            <tr style="margin: auto">
                <div style="width: 100%; margin: 15px auto 5px;" class="text-center">
                    <td>
                        <strong>Nilai Akhir</strong> =
                    </td>
                    <td>
                        <table style="display: inline-block;vertical-align: middle">
                            <tr><td>( <strong><?= number_format($totalNilai1Penguji * 15, 2, ".", "") ?></strong> + <strong><?= number_format($totalNilai2Penguji * 20, 2, ".", "") ?></strong> + <strong><?= number_format($totalNilai3Penguji * 25, 2, ".", "") ?></strong> + <strong><?= number_format($totalNilai4Penguji * 40, 2, ".", "") ?></strong> )</td></tr>
                            <tr><td><hr style="margin-top: 0; margin-bottom: 0;"></td></tr>
                            <tr><td style="text-align: center"><strong>3 X 100</strong></td></tr>
                        </table>
                    </td>
                    <td>
                        = <strong><?= number_format($aba['nilaiPenguji'][0]['nilai_akhir'], 2, ".", "") ?></strong>
                    </td>
                </div>
            </tr>

            <tr>
                <td>
                    <div style="display: inline-block; float: left">
                        <table>
                            <tr><td>Mahasiswa ini dinyatakan: </td></tr>
                            <tr><td style="padding-left: 50px;"><input type="checkbox" <?= $aba['nilaiPenguji'][0]['status'] == 'LULUS' ? "checked": "" ?>><strong>Lulus</strong> dengan kualifikasi: <strong><?= $aba['nilaiPenguji'][0]['status'] == 'LULUS' ? $aba['nilaiPenguji'][0]['grade'] : "-" ?></strong></td></tr>
                            <tr><td style="padding-left: 50px;"><input type="checkbox" <?= $aba['nilaiPenguji'][0]['status'] == 'TIDAK LULUS' ? "checked": "" ?>><strong>Tidak Lulus</strong></td></tr>
                        </table>
                        <table style="border: 1px solid; border-collapse: collapse;">
                            <tr>
                                <th style="border: 1px solid;">Range Nilai Angka</th>
                                <th style="border: 1px solid;">Nilai Huruf</th>
                                <th style="border: 1px solid;">Ket</th>
                            </tr>
                            <tr>
                                <td style="border: 1px solid;" class="text-center">3,76-4,00</td>
                                <td style="border: 1px solid;" class="text-center">A</td>
                                <td style="border: 1px solid;" class="text-center">Lulus</td>
                            </tr>
                            <tr>
                                <td style="border: 1px solid;" class="text-center">3,51-3,75</td>
                                <td style="border: 1px solid;" class="text-center">A-</td>
                                <td style="border: 1px solid;" class="text-center">Lulus</td>
                            </tr>
                            <tr>
                                <td style="border: 1px solid;" class="text-center">3,01-3,50</td>
                                <td style="border: 1px solid;" class="text-center">B+</td>
                                <td style="border: 1px solid;" class="text-center">Lulus</td>
                            </tr>
                            <tr>
                                <td style="border: 1px solid;" class="text-center">2,76-3,00</td>
                                <td style="border: 1px solid;" class="text-center">B</td>
                                <td style="border: 1px solid;" class="text-center">Lulus</td>
                            </tr>
                        </table>
                    </div>
                </td>

                <td>
                    <div style="display: inline-block; float: right;">
                        <table >
                            <tr>
                                <td class="text-center">Jakarta, <?= $today->format("d") ?> <?= $bulanDict[$today->format("m")] ?> <?= $today->format("Y") ?></td>
                            </tr>
                            <tr>
                                <td class="text-center">Ketua Komisi Penguji / Penguji Murni</td>
                            </tr>    
                            <tr>
                                <td><br><br><br><br><br></td>
                            </tr>
                            <tr>
                                <td class="text-center"><strong>(<?= $aba['penguji']['nama'] ?>)</strong></td>
                            </tr>
                        </table>
                    </div>
                </td>
            </tr>
        </table>
    </div>

    <div class="new-page"></div>

    <div>
        <td height="165" colspan="3" class="text-center">
            <p class="panel-heading">
                <img src="<?= base_url("assets/img/fti.jpg") ?>" width="157" height="62" align="absmiddle"> 
            </p>
        </td>

        <table width="100%" style="border: 0" class="table-center">
            <tr>
                <td class="text-center">
                    <h4>PENILAIAN UJIAN SKRIPSI</h4>
                </td>
            </tr>

            <tr>
                <table width="100%" style="border: 0">
                    <tr width="100%">
                        <td width="20%"><strong>Nama</strong></td>
                        <td width="5%">:</td>
                        <td width="75%"><?= $aba['mahasiswa']['nama'] ?></td>
                    </tr>
                    <tr width="100%">
                        <td width="20%"><strong>NPM</strong></td>
                        <td width="5%">:</td>
                        <td width="75%"><?= $aba['mahasiswa']['npm'] ?></td>
                    </tr>
                    <tr width="100%">
                        <td width="20%"><strong>Program Studi</strong></td>
                        <td width="5%">:</td>
                        <td width="75%"><?= $aba['prodi']['nama'] ?> Program Sarjana</td>
                    </tr>
                </table>
            </tr>

            <tr>
                <td>
                    <p style="margin-bottom: 0"><STRONG>1. PENYAJIAN LISAN</STRONG></p>
                    <table width="100%" style="border: 1px solid; border-collapse: collapse" class="table-center">
                        <tr>
                            <th style="border: 1px solid;width: 5%">NO</th>
                            <th style="border: 1px solid;width: 70%">PERINCIAN ASPEK</th>
                            <th style="border: 1px solid;width: 25%">NILAI (SKALA 0.....4)</th>
                        </tr>
                        <tr width="100%">
                            <td class="text-center" style="border: 1px solid;">1</td>
                            <td style="border: 1px solid;">Penyajian sesuai dengan waktu yang disediakan.</td>
                            <td class="text-center" style="border: 1px solid;"><?= number_format($aba['nilaiPembimbing1'][0]['nilai_1'], 2, ".", "") ?></td>
                        </tr>
                        <tr width="100%">
                            <td class="text-center" style="border: 1px solid;">2</td>
                            <td style="border: 1px solid;">Relevansi penyajian dengan isi skripsi.</td>
                            <td class="text-center" style="border: 1px solid;"><?= number_format($aba['nilaiPembimbing1'][0]['nilai_2'], 2, ".", "") ?></td>
                        </tr>
                        <tr width="100%">
                            <td class="text-center" style="border: 1px solid;">3</td>
                            <td style="border: 1px solid;">Cara penyajian (Kelancaran, kejelasan, penampilan/sikap, dll).</td>
                            <td class="text-center" style="border: 1px solid;"><?= number_format($aba['nilaiPembimbing1'][0]['nilai_3'], 2, ".", "") ?></td>
                        </tr>
                        <tr>
                            <td colspan="3" class="text-center">
                                <?php $totalNilai1Pembimbing1 = $aba['nilaiPembimbing1'][0]['nilai_1'] + $aba['nilaiPembimbing1'][0]['nilai_2'] + $aba['nilaiPembimbing1'][0]['nilai_3'] ?>
                                <strong>TOTAL ( 1 + 2 + 3 ) =</strong> <?= number_format($totalNilai1Pembimbing1, 2, ".", "") ?> <strong>NILAI: ( </strong><?= number_format($aba['nilaiPembimbing1'][0]['nilai_1'], 2, ".", "") ?> + <?= number_format($aba['nilaiPembimbing1'][0]['nilai_2'], 2, ".", "") ?> + <?= number_format($aba['nilaiPembimbing1'][0]['nilai_3'], 2, ".", "") ?><strong> ) X 15 = <?= number_format($totalNilai1Pembimbing1 * 15, 2, ".", "") ?></strong>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>

            <tr>
                <td>
                    <p style="margin-bottom: 0"><STRONG>2. TEKNIK DAN SISTEMATIKA PENULISAN</STRONG></p>
                    <table width="100%" style="border: 1px solid; border-collapse: collapse" class="table-center">
                        <tr>
                            <th style="border: 1px solid;width: 5%">NO</th>
                            <th style="border: 1px solid;width: 70%">PERINCIAN ASPEK</th>
                            <th style="border: 1px solid;width: 25%">NILAI (SKALA 0.....4)</th>
                        </tr>
                        <tr width="100%">
                            <td class="text-center" style="border: 1px solid;">1</td>
                            <td style="border: 1px solid;">Kesinambungan antara alinea, antar bab dalam susunan skripsi.</td>
                            <td class="text-center" style="border: 1px solid;"><?= number_format($aba['nilaiPembimbing1'][0]['nilai_4'], 2, ".", "") ?></td>
                        </tr>
                        <tr width="100%">
                            <td class="text-center" style="border: 1px solid;">2</td>
                            <td style="border: 1px solid;">Tata cara penulisan kepustakaan dan catatan kaki.</td>
                            <td class="text-center" style="border: 1px solid;"><?= number_format($aba['nilaiPembimbing1'][0]['nilai_5'], 2, ".", "") ?></td>
                        </tr>
                        <tr width="100%">
                            <td class="text-center" style="border: 1px solid;">3</td>
                            <td style="border: 1px solid;">Kebersihan dan kerapihan penulisan.</td>
                            <td class="text-center" style="border: 1px solid;"><?= number_format($aba['nilaiPembimbing1'][0]['nilai_6'], 2, ".", "") ?></td>
                        </tr>
                        <tr>
                            <td colspan="3" class="text-center">
                                <?php $totalNilai2Pembimbing1 = $aba['nilaiPembimbing1'][0]['nilai_4'] + $aba['nilaiPembimbing1'][0]['nilai_5'] + $aba['nilaiPembimbing1'][0]['nilai_6'] ?>
                                <strong>TOTAL ( 1 + 2 + 3 ) =</strong> <?= number_format($totalNilai2Pembimbing1, 2, ".", "") ?> <strong>NILAI: ( </strong><?= number_format($aba['nilaiPembimbing1'][0]['nilai_4'], 2, ".", "") ?> + <?= number_format($aba['nilaiPembimbing1'][0]['nilai_5'], 2, ".", "") ?> + <?= number_format($aba['nilaiPembimbing1'][0]['nilai_6'], 2, ".", "") ?><strong> ) X 20 = <?= number_format($totalNilai2Pembimbing1 * 20, 2, ".", "") ?></strong>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>

            <tr>
                <td>
                    <p style="margin-bottom: 0"><STRONG>3. ISI TULISAN</STRONG></p>
                    <table width="100%" style="border: 1px solid; border-collapse: collapse;" class="table-center">
                        <tr>
                            <th style="border: 1px solid;width: 5%">NO</th>
                            <th style="border: 1px solid;width: 70%">PERINCIAN ASPEK</th>
                            <th style="border: 1px solid;width: 25%">NILAI (SKALA 0.....4)</th>
                        </tr>
                        <tr width="100%">
                            <td class="text-center" style="border: 1px solid;">1</td>
                            <td style="border: 1px solid;">Kejelasan rumusan penulisan.</td>
                            <td class="text-center" style="border: 1px solid;"><?= number_format($aba['nilaiPembimbing1'][0]['nilai_7'], 2, ".", "") ?></td>
                        </tr>
                        <tr width="100%">
                            <td class="text-center" style="border: 1px solid;">2</td>
                            <td style="border: 1px solid;">Kesesuaian isi tulisan dengan judul skripsi.</td>
                            <td class="text-center" style="border: 1px solid;"><?= number_format($aba['nilaiPembimbing1'][0]['nilai_8'], 2, ".", "") ?></td>
                        </tr>
                        <tr width="100%">
                            <td class="text-center" style="border: 1px solid;">3</td>
                            <td style="border: 1px solid;">Kemampuan membuat analisa dan pembahasan.</td>
                            <td class="text-center" style="border: 1px solid;"><?= number_format($aba['nilaiPembimbing1'][0]['nilai_9'], 2, ".", "") ?></td>
                        </tr>
                        <tr>
                            <td colspan="3" class="text-center">
                                <?php $totalNilai3Pembimbing1 = $aba['nilaiPembimbing1'][0]['nilai_7'] + $aba['nilaiPembimbing1'][0]['nilai_8'] + $aba['nilaiPembimbing1'][0]['nilai_9'] ?>
                                <strong>TOTAL ( 1 + 2 + 3 ) =</strong> <?= number_format($totalNilai3Pembimbing1, 2, ".", "") ?> <strong>NILAI: ( </strong><?= number_format($aba['nilaiPembimbing1'][0]['nilai_7'], 2, ".", "") ?> + <?= number_format($aba['nilaiPembimbing1'][0]['nilai_8'], 2, ".", "") ?> + <?= number_format($aba['nilaiPembimbing1'][0]['nilai_9'], 2, ".", "") ?><strong> ) X 25 = <?= number_format($totalNilai3Pembimbing1 * 25, 2, ".", "") ?></strong>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>

            <tr>
                <td>
                    <p style="margin-bottom: 0"><STRONG>4. TANYA JAWAB</STRONG></p>
                    <table width="100%" style="border: 1px solid; border-collapse: collapse" class="table-center">
                        <tr>
                            <th style="border: 1px solid;width: 5%">NO</th>
                            <th style="border: 1px solid;width: 70%">PERINCIAN ASPEK</th>
                            <th style="border: 1px solid;width: 25%">NILAI (SKALA 0.....4)</th>
                        </tr>
                        <tr width="100%">
                            <td class="text-center" style="border: 1px solid;">1</td>
                            <td style="border: 1px solid;">Pengetahuan umum yang berhubungan dengan tulisan.</td>
                            <td class="text-center" style="border: 1px solid;"><?= number_format($aba['nilaiPembimbing1'][0]['nilai_10'], 2, ".", "") ?></td>
                        </tr>
                        <tr width="100%">
                            <td class="text-center" style="border: 1px solid;">2</td>
                            <td style="border: 1px solid;">Pengetahuan khusus tentang isi tulisan.</td>
                            <td class="text-center" style="border: 1px solid;"><?= number_format($aba['nilaiPembimbing1'][0]['nilai_11'], 2, ".", "") ?></td>
                        </tr>
                        <tr width="100%">
                            <td class="text-center" style="border: 1px solid;">3</td>
                            <td style="border: 1px solid;">Ketepatan menjawab.</td>
                            <td class="text-center" style="border: 1px solid;"><?= number_format($aba['nilaiPembimbing1'][0]['nilai_12'], 2, ".", "") ?></td>
                        </tr>
                        <tr>
                            <td colspan="3" class="text-center">
                                <?php $totalNilai4Pembimbing1 = $aba['nilaiPembimbing1'][0]['nilai_10'] + $aba['nilaiPembimbing1'][0]['nilai_11'] + $aba['nilaiPembimbing1'][0]['nilai_12'] ?>
                                <strong>TOTAL ( 1 + 2 + 3 ) =</strong> <?= number_format($totalNilai4Pembimbing1, 2, ".", "") ?> <strong>NILAI: ( </strong><?= number_format($aba['nilaiPembimbing1'][0]['nilai_10'], 2, ".", "") ?> + <?= number_format($aba['nilaiPembimbing1'][0]['nilai_11'], 2, ".", "") ?> + <?= number_format($aba['nilaiPembimbing1'][0]['nilai_12'], 2, ".", "") ?><strong> ) X 40 = <?= number_format($totalNilai4Pembimbing1 * 40, 2, ".", "") ?></strong>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>

            <tr style="margin: auto">
                <div style="width: 100%; margin: 15px auto 5px;" class="text-center">
                    <td>
                        <strong>Nilai Akhir</strong> =
                    </td>
                    <td>
                        <table style="display: inline-block;vertical-align: middle">
                            <tr><td>( <strong><?= number_format($totalNilai1Pembimbing1 * 15, 2, ".", "") ?></strong> + <strong><?= number_format($totalNilai2Pembimbing1 * 20, 2, ".", "") ?></strong> + <strong><?= number_format($totalNilai3Pembimbing1 * 25, 2, ".", "") ?></strong> + <strong><?= number_format($totalNilai4Pembimbing1 * 40, 2, ".", "") ?></strong> )</td></tr>
                            <tr><td><hr style="margin-top: 0; margin-bottom: 0;"></td></tr>
                            <tr><td style="text-align: center"><strong>3 X 100</strong></td></tr>
                        </table>
                    </td>
                    <td>
                        = <strong><?= number_format($aba['nilaiPembimbing1'][0]['nilai_akhir'], 2, ".", "") ?></strong>
                    </td>
                </div>
            </tr>

            <tr>
                <td>
                    <div style="display: inline-block; float: left">
                        <table>
                            <tr><td>Mahasiswa ini dinyatakan: </td></tr>
                            <tr><td style="padding-left: 50px;"><input type="checkbox" <?= $aba['nilaiPembimbing1'][0]['status'] == 'LULUS' ? "checked": "" ?>><strong>Lulus</strong> dengan kualifikasi: <strong><?= $aba['nilaiPembimbing1'][0]['status'] == 'LULUS' ? $aba['nilaiPembimbing1'][0]['grade'] : "-" ?></strong></td></tr>
                            <tr><td style="padding-left: 50px;"><input type="checkbox" <?= $aba['nilaiPembimbing1'][0]['status'] == 'TIDAK LULUS' ? "checked": "" ?>><strong>Tidak Lulus</strong></td></tr>
                        </table>
                        <table style="border: 1px solid; border-collapse: collapse;">
                            <tr>
                                <th style="border: 1px solid;">Range Nilai Angka</th>
                                <th style="border: 1px solid;">Nilai Huruf</th>
                                <th style="border: 1px solid;">Ket</th>
                            </tr>
                            <tr>
                                <td style="border: 1px solid;" class="text-center">3,76-4,00</td>
                                <td style="border: 1px solid;" class="text-center">A</td>
                                <td style="border: 1px solid;" class="text-center">Lulus</td>
                            </tr>
                            <tr>
                                <td style="border: 1px solid;" class="text-center">3,51-3,75</td>
                                <td style="border: 1px solid;" class="text-center">A-</td>
                                <td style="border: 1px solid;" class="text-center">Lulus</td>
                            </tr>
                            <tr>
                                <td style="border: 1px solid;" class="text-center">3,01-3,50</td>
                                <td style="border: 1px solid;" class="text-center">B+</td>
                                <td style="border: 1px solid;" class="text-center">Lulus</td>
                            </tr>
                            <tr>
                                <td style="border: 1px solid;" class="text-center">2,76-3,00</td>
                                <td style="border: 1px solid;" class="text-center">B</td>
                                <td style="border: 1px solid;" class="text-center">Lulus</td>
                            </tr>
                        </table>
                    </div>
                </td>

                <td>
                    <div style="display: inline-block; float: right;">
                        <table >
                            <tr>
                                <td class="text-center">Jakarta, <?= $today->format("d") ?> <?= $bulanDict[$today->format("m")] ?> <?= $today->format("Y") ?></td>
                            </tr>
                            <tr>
                                <?php if ($aba['pembimbingIlmu2'][0]['id_dosen'] == null) : ?>
                                    <td class="text-center">Pembimbing Ilmu / Penguji</td>
                                <?php else: ?>
                                    <td class="text-center">Pembimbing Ilmu 1 / Penguji</td>
                                <?php endif; ?>
                            </tr>    
                            <tr>
                                <td><br><br><br><br><br></td>
                            </tr>
                            <tr>
                                <td class="text-center"><strong>(<?= $aba['pembimbingIlmu1'][0]['nama_dosen'] ?>)</strong></td>
                            </tr>
                        </table>
                    </div>
                </td>
            </tr>
        </table>
    </div>

    <div class="new-page"></div>
    
    <?php if ($aba['pembimbingIlmu2'][0]['id_dosen'] != null) : ?>
        <div>
            <td height="165" colspan="3" class="text-center">
                <p class="panel-heading">
                    <img src="<?= base_url("assets/img/fti.jpg") ?>" width="157" height="62" align="absmiddle"> 
                </p>
            </td>

            <table width="100%" style="border: 0" class="table-center">
                <tr>
                    <td class="text-center">
                        <h4>PENILAIAN UJIAN SKRIPSI</h4>
                    </td>
                </tr>

                <tr>
                    <table width="100%" style="border: 0">
                        <tr width="100%">
                            <td width="20%"><strong>Nama</strong></td>
                            <td width="5%">:</td>
                            <td width="75%"><?= $aba['mahasiswa']['nama'] ?></td>
                        </tr>
                        <tr width="100%">
                            <td width="20%"><strong>NPM</strong></td>
                            <td width="5%">:</td>
                            <td width="75%"><?= $aba['mahasiswa']['npm'] ?></td>
                        </tr>
                        <tr width="100%">
                            <td width="20%"><strong>Program Studi</strong></td>
                            <td width="5%">:</td>
                            <td width="75%"><?= $aba['prodi']['nama'] ?> Program Sarjana</td>
                        </tr>
                    </table>
                </tr>

                <tr>
                    <td>
                        <p style="margin-bottom: 0"><STRONG>1. PENYAJIAN LISAN</STRONG></p>
                        <table width="100%" style="border: 1px solid; border-collapse: collapse" class="table-center">
                            <tr>
                                <th style="border: 1px solid;width: 5%">NO</th>
                                <th style="border: 1px solid;width: 70%">PERINCIAN ASPEK</th>
                                <th style="border: 1px solid;width: 25%">NILAI (SKALA 0.....4)</th>
                            </tr>
                            <tr width="100%">
                                <td class="text-center" style="border: 1px solid;">1</td>
                                <td style="border: 1px solid;">Penyajian sesuai dengan waktu yang disediakan.</td>
                                <td class="text-center" style="border: 1px solid;"><?= number_format($aba['nilaiPembimbing2'][0]['nilai_1'], 2, ".", "") ?></td>
                            </tr>
                            <tr width="100%">
                                <td class="text-center" style="border: 1px solid;">2</td>
                                <td style="border: 1px solid;">Relevansi penyajian dengan isi skripsi.</td>
                                <td class="text-center" style="border: 1px solid;"><?= number_format($aba['nilaiPembimbing2'][0]['nilai_2'], 2, ".", "") ?></td>
                            </tr>
                            <tr width="100%">
                                <td class="text-center" style="border: 1px solid;">3</td>
                                <td style="border: 1px solid;">Cara penyajian (Kelancaran, kejelasan, penampilan/sikap, dll).</td>
                                <td class="text-center" style="border: 1px solid;"><?= number_format($aba['nilaiPembimbing2'][0]['nilai_3'], 2, ".", "") ?></td>
                            </tr>
                            <tr>
                                <td colspan="3" class="text-center">
                                    <?php $totalNilai1Pembimbing2 = $aba['nilaiPembimbing2'][0]['nilai_1'] + $aba['nilaiPembimbing2'][0]['nilai_2'] + $aba['nilaiPembimbing2'][0]['nilai_3'] ?>
                                    <strong>TOTAL ( 1 + 2 + 3 ) =</strong> <?= number_format($totalNilai1Pembimbing2, 2, ".", "") ?> <strong>NILAI: ( </strong><?= number_format($aba['nilaiPembimbing2'][0]['nilai_1'], 2, ".", "") ?> + <?= number_format($aba['nilaiPembimbing2'][0]['nilai_2'], 2, ".", "") ?> + <?= number_format($aba['nilaiPembimbing2'][0]['nilai_3'], 2, ".", "") ?><strong> ) X 15 = <?= number_format($totalNilai1Pembimbing2 * 15, 2, ".", "") ?></strong>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>

                <tr>
                    <td>
                        <p style="margin-bottom: 0"><STRONG>2. TEKNIK DAN SISTEMATIKA PENULISAN</STRONG></p>
                        <table width="100%" style="border: 1px solid; border-collapse: collapse" class="table-center">
                            <tr>
                                <th style="border: 1px solid;width: 5%">NO</th>
                                <th style="border: 1px solid;width: 70%">PERINCIAN ASPEK</th>
                                <th style="border: 1px solid;width: 25%">NILAI (SKALA 0.....4)</th>
                            </tr>
                            <tr width="100%">
                                <td class="text-center" style="border: 1px solid;">1</td>
                                <td style="border: 1px solid;">Kesinambungan antara alinea, antar bab dalam susunan skripsi.</td>
                                <td class="text-center" style="border: 1px solid;"><?= number_format($aba['nilaiPembimbing2'][0]['nilai_4'], 2, ".", "") ?></td>
                            </tr>
                            <tr width="100%">
                                <td class="text-center" style="border: 1px solid;">2</td>
                                <td style="border: 1px solid;">Tata cara penulisan kepustakaan dan catatan kaki.</td>
                                <td class="text-center" style="border: 1px solid;"><?= number_format($aba['nilaiPembimbing2'][0]['nilai_5'], 2, ".", "") ?></td>
                            </tr>
                            <tr width="100%">
                                <td class="text-center" style="border: 1px solid;">3</td>
                                <td style="border: 1px solid;">Kebersihan dan kerapihan penulisan.</td>
                                <td class="text-center" style="border: 1px solid;"><?= number_format($aba['nilaiPembimbing2'][0]['nilai_6'], 2, ".", "") ?></td>
                            </tr>
                            <tr>
                                <td colspan="3" class="text-center">
                                    <?php $totalNilai2Pembimbing2 = $aba['nilaiPembimbing2'][0]['nilai_4'] + $aba['nilaiPembimbing2'][0]['nilai_5'] + $aba['nilaiPembimbing2'][0]['nilai_6'] ?>
                                    <strong>TOTAL ( 1 + 2 + 3 ) =</strong> <?= number_format($totalNilai2Pembimbing2, 2, ".", "") ?> <strong>NILAI: ( </strong><?= number_format($aba['nilaiPembimbing2'][0]['nilai_4'], 2, ".", "") ?> + <?= number_format($aba['nilaiPembimbing2'][0]['nilai_5'], 2, ".", "") ?> + <?= number_format($aba['nilaiPembimbing2'][0]['nilai_6'], 2, ".", "") ?><strong> ) X 20 = <?= number_format($totalNilai2Pembimbing2 * 20, 2, ".", "") ?></strong>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>

                <tr>
                    <td>
                        <p style="margin-bottom: 0"><STRONG>3. ISI TULISAN</STRONG></p>
                        <table width="100%" style="border: 1px solid; border-collapse: collapse;" class="table-center">
                            <tr>
                                <th style="border: 1px solid;width: 5%">NO</th>
                                <th style="border: 1px solid;width: 70%">PERINCIAN ASPEK</th>
                                <th style="border: 1px solid;width: 25%">NILAI (SKALA 0.....4)</th>
                            </tr>
                            <tr width="100%">
                                <td class="text-center" style="border: 1px solid;">1</td>
                                <td style="border: 1px solid;">Kejelasan rumusan penulisan.</td>
                                <td class="text-center" style="border: 1px solid;"><?= number_format($aba['nilaiPembimbing2'][0]['nilai_7'], 2, ".", "") ?></td>
                            </tr>
                            <tr width="100%">
                                <td class="text-center" style="border: 1px solid;">2</td>
                                <td style="border: 1px solid;">Kesesuaian isi tulisan dengan judul skripsi.</td>
                                <td class="text-center" style="border: 1px solid;"><?= number_format($aba['nilaiPembimbing2'][0]['nilai_8'], 2, ".", "") ?></td>
                            </tr>
                            <tr width="100%">
                                <td class="text-center" style="border: 1px solid;">3</td>
                                <td style="border: 1px solid;">Kemampuan membuat analisa dan pembahasan.</td>
                                <td class="text-center" style="border: 1px solid;"><?= number_format($aba['nilaiPembimbing2'][0]['nilai_9'], 2, ".", "") ?></td>
                            </tr>
                            <tr>
                                <td colspan="3" class="text-center">
                                    <?php $totalNilai3Pembimbing2 = $aba['nilaiPembimbing2'][0]['nilai_7'] + $aba['nilaiPembimbing2'][0]['nilai_8'] + $aba['nilaiPembimbing2'][0]['nilai_9'] ?>
                                    <strong>TOTAL ( 1 + 2 + 3 ) =</strong> <?= number_format($totalNilai3Pembimbing2, 2, ".", "") ?> <strong>NILAI: ( </strong><?= number_format($aba['nilaiPembimbing2'][0]['nilai_7'], 2, ".", "") ?> + <?= number_format($aba['nilaiPembimbing2'][0]['nilai_8'], 2, ".", "") ?> + <?= number_format($aba['nilaiPembimbing2'][0]['nilai_9'], 2, ".", "") ?><strong> ) X 25 = <?= number_format($totalNilai3Pembimbing2 * 25, 2, ".", "") ?></strong>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>

                <tr>
                    <td>
                        <p style="margin-bottom: 0"><STRONG>4. TANYA JAWAB</STRONG></p>
                        <table width="100%" style="border: 1px solid; border-collapse: collapse" class="table-center">
                            <tr>
                                <th style="border: 1px solid;width: 5%">NO</th>
                                <th style="border: 1px solid;width: 70%">PERINCIAN ASPEK</th>
                                <th style="border: 1px solid;width: 25%">NILAI (SKALA 0.....4)</th>
                            </tr>
                            <tr width="100%">
                                <td class="text-center" style="border: 1px solid;">1</td>
                                <td style="border: 1px solid;">Pengetahuan umum yang berhubungan dengan tulisan.</td>
                                <td class="text-center" style="border: 1px solid;"><?= number_format($aba['nilaiPembimbing2'][0]['nilai_10'], 2, ".", "") ?></td>
                            </tr>
                            <tr width="100%">
                                <td class="text-center" style="border: 1px solid;">2</td>
                                <td style="border: 1px solid;">Pengetahuan khusus tentang isi tulisan.</td>
                                <td class="text-center" style="border: 1px solid;"><?= number_format($aba['nilaiPembimbing2'][0]['nilai_11'], 2, ".", "") ?></td>
                            </tr>
                            <tr width="100%">
                                <td class="text-center" style="border: 1px solid;">3</td>
                                <td style="border: 1px solid;">Ketepatan menjawab.</td>
                                <td class="text-center" style="border: 1px solid;"><?= number_format($aba['nilaiPembimbing2'][0]['nilai_12'], 2, ".", "") ?></td>
                            </tr>
                            <tr>
                                <td colspan="3" class="text-center">
                                    <?php $totalNilai4Pembimbing2 = $aba['nilaiPembimbing2'][0]['nilai_10'] + $aba['nilaiPembimbing2'][0]['nilai_11'] + $aba['nilaiPembimbing2'][0]['nilai_12'] ?>
                                    <strong>TOTAL ( 1 + 2 + 3 ) =</strong> <?= number_format($totalNilai4Pembimbing2, 2, ".", "") ?> <strong>NILAI: ( </strong><?= number_format($aba['nilaiPembimbing2'][0]['nilai_10'], 2, ".", "") ?> + <?= number_format($aba['nilaiPembimbing2'][0]['nilai_11'], 2, ".", "") ?> + <?= number_format($aba['nilaiPembimbing2'][0]['nilai_12'], 2, ".", "") ?><strong> ) X 40 = <?= number_format($totalNilai4Pembimbing2 * 40, 2, ".", "") ?></strong>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>

                <tr style="margin: auto">
                    <div style="width: 100%; margin: 15px auto 5px;" class="text-center">
                        <td>
                            <strong>Nilai Akhir</strong> =
                        </td>
                        <td>
                            <table style="display: inline-block;vertical-align: middle">
                                <tr><td>( <strong><?= number_format($totalNilai1Pembimbing2 * 15, 2, ".", "") ?></strong> + <strong><?= number_format($totalNilai2Pembimbing2 * 20, 2, ".", "") ?></strong> + <strong><?= number_format($totalNilai3Pembimbing2 * 25, 2, ".", "") ?></strong> + <strong><?= number_format($totalNilai4Pembimbing2 * 40, 2, ".", "") ?></strong> )</td></tr>
                                <tr><td><hr style="margin-top: 0; margin-bottom: 0;"></td></tr>
                                <tr><td style="text-align: center"><strong>3 X 100</strong></td></tr>
                            </table>
                        </td>
                        <td>
                            = <strong><?= number_format($aba['nilaiPembimbing2'][0]['nilai_akhir'], 2, ".", "") ?></strong>
                        </td>
                    </div>
                </tr>

                <tr>
                    <td>
                        <div style="display: inline-block; float: left">
                            <table >
                                <tr><td>Mahasiswa ini dinyatakan: </td></tr>
                                <tr><td style="padding-left: 50px;"><input type="checkbox" <?= $aba['nilaiPembimbing2'][0]['status'] == 'LULUS' ? "checked": "" ?>><strong>Lulus</strong> dengan kualifikasi: <strong><?= $aba['nilaiPembimbing2'][0]['status'] == 'LULUS' ? $aba['nilaiPembimbing2'][0]['grade'] : "-" ?></strong></td></tr>
                                <tr><td style="padding-left: 50px;"><input type="checkbox" <?= $aba['nilaiPembimbing2'][0]['status'] == 'TIDAK LULUS' ? "checked": "" ?>><strong>Tidak Lulus</strong></td></tr>
                            </table>
                            <table style="border: 1px solid; border-collapse: collapse;">
                                <tr>
                                    <th style="border: 1px solid;">Range Nilai Angka</th>
                                    <th style="border: 1px solid;">Nilai Huruf</th>
                                    <th style="border: 1px solid;">Ket</th>
                                </tr>
                                <tr>
                                    <td style="border: 1px solid;" class="text-center">3,76-4,00</td>
                                    <td style="border: 1px solid;" class="text-center">A</td>
                                    <td style="border: 1px solid;" class="text-center">Lulus</td>
                                </tr>
                                <tr>
                                    <td style="border: 1px solid;" class="text-center">3,51-3,75</td>
                                    <td style="border: 1px solid;" class="text-center">A-</td>
                                    <td style="border: 1px solid;" class="text-center">Lulus</td>
                                </tr>
                                <tr>
                                    <td style="border: 1px solid;" class="text-center">3,01-3,50</td>
                                    <td style="border: 1px solid;" class="text-center">B+</td>
                                    <td style="border: 1px solid;" class="text-center">Lulus</td>
                                </tr>
                                <tr>
                                    <td style="border: 1px solid;" class="text-center">2,76-3,00</td>
                                    <td style="border: 1px solid;" class="text-center">B</td>
                                    <td style="border: 1px solid;" class="text-center">Lulus</td>
                                </tr>
                            </table>
                        </div>
                    </td>

                    <td>
                        <div style="display: inline-block; float: right;">
                            <table >
                                <tr>
                                    <td class="text-center">Jakarta, <?= $today->format("d") ?> <?= $bulanDict[$today->format("m")] ?> <?= $today->format("Y") ?></td>
                                </tr>
                                <tr>
                                    <td class="text-center">Pembimbing Ilmu 2 / Penguji</td>
                                </tr>    
                                <tr>
                                    <td><br><br><br><br><br></td>
                                </tr>
                                <tr>
                                    <td class="text-center"><strong>(<?= $aba['pembimbingIlmu2'][0]['nama_dosen'] ?>)</strong></td>
                                </tr>
                            </table>
                        </div>
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

        <table width="100%" style="border: 0" class="table-center">
            <tr>
                <td class="text-center">
                    <h4>PENILAIAN UJIAN SKRIPSI</h4>
                </td>
            </tr>

            <tr>
                <table width="100%" style="border: 0">
                    <tr width="100%">
                        <td width="20%"><strong>Nama</strong></td>
                        <td width="5%">:</td>
                        <td width="75%"><?= $aba['mahasiswa']['nama'] ?></td>
                    </tr>
                    <tr width="100%">
                        <td width="20%"><strong>NPM</strong></td>
                        <td width="5%">:</td>
                        <td width="75%"><?= $aba['mahasiswa']['npm'] ?></td>
                    </tr>
                    <tr width="100%">
                        <td width="20%"><strong>Program Studi</strong></td>
                        <td width="5%">:</td>
                        <td width="75%"><?= $aba['prodi']['nama'] ?> Program Sarjana</td>
                    </tr>
                </table>
            </tr>

            <tr>
                <td>
                    <p style="margin-bottom: 0"><STRONG>1. PENYAJIAN LISAN</STRONG></p>
                    <table width="100%" style="border: 1px solid; border-collapse: collapse" class="table-center">
                        <tr>
                            <th style="border: 1px solid;width: 5%">NO</th>
                            <th style="border: 1px solid;width: 70%">PERINCIAN ASPEK</th>
                            <th style="border: 1px solid;width: 25%">NILAI (SKALA 0.....4)</th>
                        </tr>
                        <tr width="100%">
                            <td class="text-center" style="border: 1px solid;">1</td>
                            <td style="border: 1px solid;">Penyajian sesuai dengan waktu yang disediakan.</td>
                            <td class="text-center" style="border: 1px solid;"><?= number_format($aba['nilaiPembimbingAgama'][0]['nilai_1'], 2, ".", "") ?></td>
                        </tr>
                        <tr width="100%">
                            <td class="text-center" style="border: 1px solid;">2</td>
                            <td style="border: 1px solid;">Relevansi penyajian dengan isi skripsi.</td>
                            <td class="text-center" style="border: 1px solid;"><?= number_format($aba['nilaiPembimbingAgama'][0]['nilai_2'], 2, ".", "") ?></td>
                        </tr>
                        <tr width="100%">
                            <td class="text-center" style="border: 1px solid;">3</td>
                            <td style="border: 1px solid;">Cara penyajian (Kelancaran, kejelasan, penampilan/sikap, dll).</td>
                            <td class="text-center" style="border: 1px solid;"><?= number_format($aba['nilaiPembimbingAgama'][0]['nilai_3'], 2, ".", "") ?></td>
                        </tr>
                        <tr>
                            <td colspan="3" class="text-center">
                                <?php $totalNilai1PembimbingAgama = $aba['nilaiPembimbingAgama'][0]['nilai_1'] + $aba['nilaiPembimbingAgama'][0]['nilai_2'] + $aba['nilaiPembimbingAgama'][0]['nilai_3'] ?>
                                <strong>TOTAL ( 1 + 2 + 3 ) =</strong> <?= number_format($totalNilai1PembimbingAgama, 2, ".", "") ?> <strong>NILAI: ( </strong><?= number_format($aba['nilaiPembimbingAgama'][0]['nilai_1'], 2, ".", "") ?> + <?= number_format($aba['nilaiPembimbingAgama'][0]['nilai_2'], 2, ".", "") ?> + <?= number_format($aba['nilaiPembimbingAgama'][0]['nilai_3'], 2, ".", "") ?><strong> ) X 15 = <?= number_format($totalNilai1PembimbingAgama * 15, 2, ".", "") ?></strong>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>

            <tr>
                <td>
                    <p style="margin-bottom: 0"><STRONG>2. TEKNIK DAN SISTEMATIKA PENULISAN</STRONG></p>
                    <table width="100%" style="border: 1px solid; border-collapse: collapse" class="table-center">
                        <tr>
                            <th style="border: 1px solid;width: 5%">NO</th>
                            <th style="border: 1px solid;width: 70%">PERINCIAN ASPEK</th>
                            <th style="border: 1px solid;width: 25%">NILAI (SKALA 0.....4)</th>
                        </tr>
                        <tr width="100%">
                            <td class="text-center" style="border: 1px solid;">1</td>
                            <td style="border: 1px solid;">Kesinambungan antara alinea, antar bab dalam susunan skripsi.</td>
                            <td class="text-center" style="border: 1px solid;"><?= number_format($aba['nilaiPembimbingAgama'][0]['nilai_4'], 2, ".", "") ?></td>
                        </tr>
                        <tr width="100%">
                            <td class="text-center" style="border: 1px solid;">2</td>
                            <td style="border: 1px solid;">Tata cara penulisan kepustakaan dan catatan kaki.</td>
                            <td class="text-center" style="border: 1px solid;"><?= number_format($aba['nilaiPembimbingAgama'][0]['nilai_5'], 2, ".", "") ?></td>
                        </tr>
                        <tr width="100%">
                            <td class="text-center" style="border: 1px solid;">3</td>
                            <td style="border: 1px solid;">Kebersihan dan kerapihan penulisan.</td>
                            <td class="text-center" style="border: 1px solid;"><?= number_format($aba['nilaiPembimbingAgama'][0]['nilai_6'], 2, ".", "") ?></td>
                        </tr>
                        <tr>
                            <td colspan="3" class="text-center">
                                <?php $totalNilai2PembimbingAgama = $aba['nilaiPembimbingAgama'][0]['nilai_4'] + $aba['nilaiPembimbingAgama'][0]['nilai_5'] + $aba['nilaiPembimbingAgama'][0]['nilai_6'] ?>
                                <strong>TOTAL ( 1 + 2 + 3 ) =</strong> <?= number_format($totalNilai2PembimbingAgama, 2, ".", "") ?> <strong>NILAI: ( </strong><?= number_format($aba['nilaiPembimbingAgama'][0]['nilai_4'], 2, ".", "") ?> + <?= number_format($aba['nilaiPembimbingAgama'][0]['nilai_5'], 2, ".", "") ?> + <?= number_format($aba['nilaiPembimbingAgama'][0]['nilai_6'], 2, ".", "") ?><strong> ) X 20 = <?= number_format($totalNilai2PembimbingAgama * 20, 2, ".", "") ?></strong>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>

            <tr>
                <td>
                    <p style="margin-bottom: 0"><STRONG>3. ISI TULISAN</STRONG></p>
                    <table width="100%" style="border: 1px solid; border-collapse: collapse;" class="table-center">
                        <tr>
                            <th style="border: 1px solid;width: 5%">NO</th>
                            <th style="border: 1px solid;width: 70%">PERINCIAN ASPEK</th>
                            <th style="border: 1px solid;width: 25%">NILAI (SKALA 0.....4)</th>
                        </tr>
                        <tr width="100%">
                            <td class="text-center" style="border: 1px solid;">1</td>
                            <td style="border: 1px solid;">Kejelasan rumusan penulisan.</td>
                            <td class="text-center" style="border: 1px solid;"><?= number_format($aba['nilaiPembimbingAgama'][0]['nilai_7'], 2, ".", "") ?></td>
                        </tr>
                        <tr width="100%">
                            <td class="text-center" style="border: 1px solid;">2</td>
                            <td style="border: 1px solid;">Kesesuaian isi tulisan dengan judul skripsi.</td>
                            <td class="text-center" style="border: 1px solid;"><?= number_format($aba['nilaiPembimbingAgama'][0]['nilai_8'], 2, ".", "") ?></td>
                        </tr>
                        <tr width="100%">
                            <td class="text-center" style="border: 1px solid;">3</td>
                            <td style="border: 1px solid;">Kemampuan membuat analisa dan pembahasan.</td>
                            <td class="text-center" style="border: 1px solid;"><?= number_format($aba['nilaiPembimbingAgama'][0]['nilai_9'], 2, ".", "") ?></td>
                        </tr>
                        <tr>
                            <td colspan="3" class="text-center">
                                <?php $totalNilai3PembimbingAgama = $aba['nilaiPembimbingAgama'][0]['nilai_7'] + $aba['nilaiPembimbingAgama'][0]['nilai_8'] + $aba['nilaiPembimbingAgama'][0]['nilai_9'] ?>
                                <strong>TOTAL ( 1 + 2 + 3 ) =</strong> <?= number_format($totalNilai3PembimbingAgama, 2, ".", "") ?> <strong>NILAI: ( </strong><?= number_format($aba['nilaiPembimbingAgama'][0]['nilai_7'], 2, ".", "") ?> + <?= number_format($aba['nilaiPembimbingAgama'][0]['nilai_8'], 2, ".", "") ?> + <?= number_format($aba['nilaiPembimbingAgama'][0]['nilai_9'], 2, ".", "") ?><strong> ) X 25 = <?= number_format($totalNilai3PembimbingAgama * 25, 2, ".", "") ?></strong>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>

            <tr>
                <td>
                    <p style="margin-bottom: 0"><STRONG>4. TANYA JAWAB</STRONG></p>
                    <table width="100%" style="border: 1px solid; border-collapse: collapse" class="table-center">
                        <tr>
                            <th style="border: 1px solid;width: 5%">NO</th>
                            <th style="border: 1px solid;width: 70%">PERINCIAN ASPEK</th>
                            <th style="border: 1px solid;width: 25%">NILAI (SKALA 0.....4)</th>
                        </tr>
                        <tr width="100%">
                            <td class="text-center" style="border: 1px solid;">1</td>
                            <td style="border: 1px solid;">Pengetahuan umum yang berhubungan dengan tulisan.</td>
                            <td class="text-center" style="border: 1px solid;"><?= number_format($aba['nilaiPembimbingAgama'][0]['nilai_10'], 2, ".", "") ?></td>
                        </tr>
                        <tr width="100%">
                            <td class="text-center" style="border: 1px solid;">2</td>
                            <td style="border: 1px solid;">Pengetahuan khusus tentang isi tulisan.</td>
                            <td class="text-center" style="border: 1px solid;"><?= number_format($aba['nilaiPembimbingAgama'][0]['nilai_11'], 2, ".", "") ?></td>
                        </tr>
                        <tr width="100%">
                            <td class="text-center" style="border: 1px solid;">3</td>
                            <td style="border: 1px solid;">Ketepatan menjawab.</td>
                            <td class="text-center" style="border: 1px solid;"><?= number_format($aba['nilaiPembimbingAgama'][0]['nilai_12'], 2, ".", "") ?></td>
                        </tr>
                        <tr>
                            <td colspan="3" class="text-center">
                                <?php $totalNilai4PembimbingAgama = $aba['nilaiPembimbingAgama'][0]['nilai_10'] + $aba['nilaiPembimbingAgama'][0]['nilai_11'] + $aba['nilaiPembimbingAgama'][0]['nilai_12'] ?>
                                <strong>TOTAL ( 1 + 2 + 3 ) =</strong> <?= number_format($totalNilai4PembimbingAgama, 2, ".", "") ?> <strong>NILAI: ( </strong><?= number_format($aba['nilaiPembimbingAgama'][0]['nilai_10'], 2, ".", "") ?> + <?= number_format($aba['nilaiPembimbingAgama'][0]['nilai_11'], 2, ".", "") ?> + <?= number_format($aba['nilaiPembimbingAgama'][0]['nilai_12'], 2, ".", "") ?><strong> ) X 40 = <?= number_format($totalNilai4PembimbingAgama * 40, 2, ".", "") ?></strong>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>

            <tr style="margin: auto">
                <div style="width: 100%; margin: 15px auto 5px;" class="text-center">
                    <td>
                        <strong>Nilai Akhir</strong> =
                    </td>
                    <td>
                        <table style="display: inline-block;vertical-align: middle">
                            <tr><td>( <strong><?= number_format($totalNilai1PembimbingAgama * 15, 2, ".", "") ?></strong> + <strong><?= number_format($totalNilai2PembimbingAgama * 20, 2, ".", "") ?></strong> + <strong><?= number_format($totalNilai3PembimbingAgama * 25, 2, ".", "") ?></strong> + <strong><?= number_format($totalNilai4PembimbingAgama * 40, 2, ".", "") ?></strong> )</td></tr>
                            <tr><td><hr style="margin-top: 0; margin-bottom: 0;"></td></tr>
                            <tr><td style="text-align: center"><strong>3 X 100</strong></td></tr>
                        </table>
                    </td>
                    <td>
                        = <strong><?= number_format($aba['nilaiPembimbingAgama'][0]['nilai_akhir'], 2, ".", "") ?></strong>
                    </td>
                </div>
            </tr>

            <tr>
                <td>
                    <div style="display: inline-block; float: left">
                        <table>
                            <tr><td>Mahasiswa ini dinyatakan: </td></tr>
                            <tr><td style="padding-left: 50px;"><input type="checkbox" <?= $aba['nilaiPembimbingAgama'][0]['status'] == 'LULUS' ? "checked": "" ?>><strong>Lulus</strong> dengan kualifikasi: <strong><?= $aba['nilaiPembimbingAgama'][0]['status'] == 'LULUS' ? $aba['nilaiPembimbingAgama'][0]['grade'] : "-" ?></strong></td></tr>
                            <tr><td style="padding-left: 50px;"><input type="checkbox" <?= $aba['nilaiPembimbingAgama'][0]['status'] == 'TIDAK LULUS' ? "checked": "" ?>><strong>Tidak Lulus</strong></td></tr>
                        </table>
                        <table style="border: 1px solid; border-collapse: collapse;">
                            <tr>
                                <th style="border: 1px solid;">Range Nilai Angka</th>
                                <th style="border: 1px solid;">Nilai Huruf</th>
                                <th style="border: 1px solid;">Ket</th>
                            </tr>
                            <tr>
                                <td style="border: 1px solid;" class="text-center">3,76-4,00</td>
                                <td style="border: 1px solid;" class="text-center">A</td>
                                <td style="border: 1px solid;" class="text-center">Lulus</td>
                            </tr>
                            <tr>
                                <td style="border: 1px solid;" class="text-center">3,51-3,75</td>
                                <td style="border: 1px solid;" class="text-center">A-</td>
                                <td style="border: 1px solid;" class="text-center">Lulus</td>
                            </tr>
                            <tr>
                                <td style="border: 1px solid;" class="text-center">3,01-3,50</td>
                                <td style="border: 1px solid;" class="text-center">B+</td>
                                <td style="border: 1px solid;" class="text-center">Lulus</td>
                            </tr>
                            <tr>
                                <td style="border: 1px solid;" class="text-center">2,76-3,00</td>
                                <td style="border: 1px solid;" class="text-center">B</td>
                                <td style="border: 1px solid;" class="text-center">Lulus</td>
                            </tr>
                        </table>
                    </div>
                </td>

                <td>
                    <div style="display: inline-block; float: right;">
                        <table >
                            <tr>
                                <td class="text-center">Jakarta, <?= $today->format("d") ?> <?= $bulanDict[$today->format("m")] ?> <?= $today->format("Y") ?></td>
                            </tr>
                            <tr>
                                <td class="text-center">Pembimbing Agama / Penguji</td>
                            </tr>    
                            <tr>
                                <td><br><br><br><br><br></td>
                            </tr>
                            <tr>
                                <td class="text-center"><strong>(<?= $aba['pembimbingAgama'][0]['nama_dosen'] ?>)</strong></td>
                            </tr>
                        </table>
                    </div>
                </td>
            </tr>
        </table>
    </div>
    <?php $counter++; ?>
    <?php if ($counter <= count($arrBeritaAcara)): ?>
        <div class="new-page"></div>
    <?php endif; ?>
<?php endforeach; ?>
</body>
</html>