<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?></title>
</head>
<body onload="window.print()">
    <div>
        <td height="165" align="center">
            <p class="panel-heading">
                <img src="<?= base_url("assets/img/fti.jpg") ?>" width="157" height="62" align="absmiddle"> 
            </p>
        </td>


        <table width="100%" border="0" align="center">
            <tr>
                <td align="center">
                    <h2><?= $title ?></h2>
                </td>
            </tr>
            <tr>
                <table width="90%" border="0" align="center">
                    <tr>
                        <td>Kepada Yth.</td>
                    </tr>
                    <tr>
                        <td>Bapak/Ibu <?= $nama_dosen ?></td>
                    </tr>
                    <tr>
                        <td>di tempat</td>
                    </tr>
                </table>
            </tr>
            <br>
            <tr>
                <table width="90%" border="0" align="center">
                    <tr>
                        <td style="padding-bottom: 5px">&emsp;&emsp;Program Studi <?= $nama_prodi ?> Universitas YARSI akan mengadakan <strong><?= $nama_kegiatan ?> Program Studi <?= $nama_prodi ?> Universitas YARSI Tahun <?= date("Y") ?></strong>.</td>
                    </tr>
                    <tr style="padding-bottom: 5px">
                        <td>&emsp;&emsp;Sehubung dengan hal tersebut, kami mengundang Bapak/Ibu untuk dapat hadir dan berpartisipasi sebagai <?= $selaku ?> yang akan diadakan pada:</td>
                    </tr>
                    <tr style="padding-bottom: 5px"></tr>
                    <tr style="padding-bottom: 5px">
                        <td>
                            <table width="40%" border="0" bordercolor="#000" align="center" cellpadding="2" cellspacing="0">
                                <tr>
                                    <td><strong>Tanggal</strong></td>
                                    <td>:</td>
                                    <td><?= $tanggal ?></td>
                                </tr>
                                <tr>
                                    <td><strong>Jam</strong></td>
                                    <td>:</td>
                                    <td><?= $jam ?> WIB</td>
                                </tr>
                                <tr>
                                    <td><strong>Tempat</strong></td>
                                    <td>:</td>
                                    <td><?= $ruangan ?></td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr>
                        <td style="padding-bottom: 5px">
                            &emsp;&emsp;Demikian surat ini disampaikan, atas perhatian dan kerjasamanya diucapkan terimakasih.
                        </td>
                    </tr>
                </table>
            </tr>

           
            <br>
            <br>
            <br>
            
            <br>
            <br>
            <tr>
                <td >
                    <div style="text-align: right; padding-right: 80px">
                        Jakarta, <?= date("d-m-Y") ?>
                    </div>
                    <br><br><br><br>
                    <div style="text-align: right; padding-right: 80px">
                        Kaprodi <?= $inisial_prodi ?>
                    </div>
                </td>
            </tr>
        </table>
    </div>
</body>
</html>