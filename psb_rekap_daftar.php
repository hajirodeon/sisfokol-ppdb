<?php

///////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////
/////// SISFOKOL-PPDB                                           ///////
///////////////////////////////////////////////////////////////////////
/////// Dibuat oleh :                                           ///////
/////// Agus Muhajir, S.Kom                                     ///////
/////// URL 	:                                               ///////
///////     * http://sisfokol.wordpress.com/                    ///////
///////     * http://hajirodeon.wordpress.com/                  ///////
///////     * http://yahoogroup.com/groups/sisfokol/            ///////
///////     * http://yahoogroup.com/groups/linuxbiasawae/       ///////
/////// E-Mail	:                                               ///////
///////     * hajirodeon@yahoo.com                              ///////
///////     * hajirodeon@gmail.com                              ///////
/////// HP/SMS	: 081-829-88-54                                 ///////
///////////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////////


session_start();


//ambil nilai
require("inc/config.php");
require("inc/fungsi.php");
require("inc/koneksi.php");
require("inc/class/paging.php");
$tpl = LoadTpl("template/index.html");


nocache;

//nilai
$filenya = "psb_rekap_daftar.php";
$judul = "Rekap Pendaftar";
$judulku = $judul;


//ketahui tapel aktif
$qtp = mysql_query("SELECT * FROM psb_m_tapel ".
			"WHERE status = 'true'");
$rtp = mysql_fetch_assoc($qtp);
$tp_tapelkd = nosql($rtp['kd']);
$tp_tahun1 = nosql($rtp['tahun1']);
$tp_tahun2 = nosql($rtp['tahun2']);





//isi *START
ob_start();


//js
require("inc/js/jumpmenu.js");



//view //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
echo '<form action="'.$filenya.'" method="post" name="formx">';
echo '<table width="100%" border="0" cellspacing="3" cellpadding="0">
<tr valign="top" align="left">
<td width="25%">';
//ambil data menu
require("inc/menu/psb_menu.php");
echo '</td>

<td align="left">
<big><strong>'.$judul.'</strong></big>
<br>



<table width="100%" border="1" cellspacing="0" cellpadding="3">
<tr bgcolor="'.$warnaheader.'">
<tr bgcolor="green">
<td>
<strong>Jumlah Pendaftar</strong>
</td>';
//pendaftar



//jml. pendaftar
$qku = mysql_query("SELECT psb_siswa_calon.*, psb_siswa_calon.kd AS sckd, ".
						"psb_siswa_calon.nama AS scnama ".
						"FROM psb_siswa_calon ".
						"WHERE psb_siswa_calon.kd_tapel = '$tp_tapelkd' ".
						"AND psb_siswa_calon.nama <> '' ".
						"AND psb_siswa_calon.asal_sekolah <> '' ".
						"AND psb_siswa_calon.alamat <> '' ".
						"AND psb_siswa_calon.tes_fisik <> '' ".
						"AND psb_siswa_calon.pengembalian <> ''");		
$rku = mysql_fetch_assoc($qku);
$tku = mysql_num_rows($qku);

echo '<td bgcolor="gray">
<big>
<strong>'.$tku.'</strong>
</big>
<br>';

//kelamin L
$qku1 = mysql_query("SELECT psb_siswa_calon.*, psb_siswa_calon.kd AS sckd, ".
						"psb_siswa_calon.nama AS scnama ".
						"FROM psb_siswa_calon ".
						"WHERE psb_siswa_calon.kd_tapel = '$tp_tapelkd' ".
						"AND psb_siswa_calon.nama <> '' ".
						"AND psb_siswa_calon.asal_sekolah <> '' ".
						"AND psb_siswa_calon.alamat <> '' ".
						"AND psb_siswa_calon.tes_fisik <> '' ".
						"AND psb_siswa_calon.pengembalian <> '' ".
						"AND psb_siswa_calon.kelamin = 'L'");
$rku1 = mysql_fetch_assoc($qku1);
$tku1 = mysql_num_rows($qku1);


//kelamin P
$qku2 = mysql_query("SELECT psb_siswa_calon.*, psb_siswa_calon.kd AS sckd, ".
						"psb_siswa_calon.nama AS scnama ".
						"FROM psb_siswa_calon ".
						"WHERE psb_siswa_calon.kd_tapel = '$tp_tapelkd' ".
						"AND psb_siswa_calon.nama <> '' ".
						"AND psb_siswa_calon.asal_sekolah <> '' ".
						"AND psb_siswa_calon.alamat <> '' ".
						"AND psb_siswa_calon.tes_fisik <> '' ".
						"AND psb_siswa_calon.pengembalian <> '' ".
						"AND psb_siswa_calon.kelamin = 'P'");
$rku2 = mysql_fetch_assoc($qku2);
$tku2 = mysql_num_rows($qku2);

echo 'L : <strong>'.$tku1.'</strong>.
<br>
P : <strong>'.$tku2.'</strong>.


</td>
</tr>
</table>



</td>
</tr>
</table>

</form>
<br>
<br>
<br>';
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

//isi
$isi = ob_get_contents();
ob_end_clean();

require("inc/niltpl.php");



//diskonek
xclose($koneksi);
exit();
?>