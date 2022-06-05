<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulir Bimbingan Skripsi</title>
</head>
<body onload="window.print()">
    <div>
        <td height="165" colspan="3" align="center">
            <p class="panel-heading">
                <img src="<?= base_url("assets/img/fti.jpg") ?>" width="157" height="62" align="absmiddle"> 
            </p>
        </td>

        <table width="100%" border="0" align="center">
            <tr>
                <td align="center">
                    <h2>FORMULIR BIMBINGAN SKRIPSI</h2>
                </td>
            </tr>

            <tr>
                <table width="90%" border="0" align="center">
                    <tr>
                        <td>Nama</td>
                        <td>:</td>
                        <td><?= $mahasiswa['nama'] ?></td>
                    </tr>
                    <tr>
                        <td>NPM</td>
                        <td>:</td>
                        <td><?= $mahasiswa['npm'] ?></td>
                    </tr>
                    <tr>
                        <td>Program Studi</td>
                        <td>:</td>
                        <td><?= $prodi['nama'] ?></td>
                    </tr>
                    <tr>
                        <td>Judul Skripsi</td>
                        <td>:</td>
                        <td><?= $lastSkripsi['judul'] ?></td>
                    </tr>
                </table>
            </tr>
            <br>
            <br>
            <br>
            <tr>
                <td>
                    <table width="90%" border="1" bordercolor="#000" align="center" cellpadding="3" cellspacing="0">
                        <tr>
                            <th width="5%">No</th>
                            <th width="15%">Tanggal</th>
                            <th width="50%">Materi</th>
                            <th width="20%">Dosen Pembimbing</th>
                            <th width="10%">Status</th>
                        </tr>

                        <?php $counter = 1; ?>
                        <?php foreach($hasilBimbingan as $hb): ?>
                            <tr>
                                <td width="5%" style="text-align: center;"><?= $counter; ?></td>
                                <td width="15%" style="text-align: center;"><?= date_format(date_create($hb['tanggal_bimbingan']), "d-m-Y"); ?></td>
                                <td width="35%" style="text-align: center;"><?= $hb['hasil_bimbingan']; ?></td>
                                <td width="35%" style="text-align: center;"><?= $hb['nama_dosen']; ?></td>
                                <td width="10%" style="text-align: center;"><?= $hb['status'] ;?></td>
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
                    <div style="text-align: right; padding-right: 80px">
                        Jakarta, ........
                    </div>
                </td>
            </tr>
            <br>
            <br>
            <tr>
                <td>
                    <table width="90%" align="center">
                        <tr>
                            <td align="center">Pembimbing Ilmu</td>
                            <td align="center">Pembimbing Agama</td>
                            <td align="center">Mahasiswa</td>
                        </tr>    
                        <tr>
                            <td><br><br><br><br></td>
                            <td><br><br><br><br></td>
                            <td><br><br><br><br></td>
                        </tr>
                        <tr>
                            <td align="center">(................)</td>
                            <td align="center">(................)</td>
                            <td align="center">(................)</td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td>
                    <p><strong>Catatan:</strong></p>
                    <ol>
                        <li>Setiap Pertemuan, wajib mengisi kolom yang tersedia.</li>
                        <li>Lamanya kesempatan pertemuan adalah 6 bulan.</li>
                        <li>Minimal 8 kali pertemuan dengan dosen pembimbing ilmu dan 4 kali pertemuan dengan dosen pembimbing agama.</li>
                        <li>Pada saat pendaftaran sidang skripsi, formulir ini wajib diserahkan ke TU bersama dengan berkas skripsi.</li>
                    </ol>
                </td>
            </tr>
        </table>
    </div>
</body>
</html>