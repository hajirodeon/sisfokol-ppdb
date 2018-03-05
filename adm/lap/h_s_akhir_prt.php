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

require("../../inc/config.php");
require("../../inc/fungsi.php");
require("../../inc/koneksi.php");
require("../../inc/cek/psb_adm.php");
require("../../inc/class/paging.php");
$tpl = LoadTpl("../../template/print.html");

nocache;

//nilai
$filenya = "h_s_akhir_prt.php";
$judul = "Hasil Seleksi Akhir";
$judulku = "[$adm_session] ==> $judul";
$judulx = $judul;
$ke = "h_s_akhir.php";
$diload = "window.print();location.href='$ke';";



//isi *START
ob_start();







//ketahui tapel aktif
$qtp = mysql_query("SELECT * FROM psb_m_tapel ".
			"WHERE status = 'true'");
$rtp = mysql_fetch_assoc($qtp);
$tp_tapelkd = nosql($rtp['kd']);
$tp_tahun1 = nosql($rtp['tahun1']);
$tp_tahun2 = nosql($rtp['tahun2']);







//query data
$p = new Pager();
$start = $p->findStart($limit);

$sqlcount = "SELECT psb_siswa_calon.*, psb_siswa_calon.kd AS sckd, ".
				"psb_siswa_calon.nama AS scnama, psb_siswa_calon_rangking.* ".
				"FROM psb_siswa_calon, psb_siswa_calon_rangking ".
				"WHERE psb_siswa_calon.kd = psb_siswa_calon_rangking.kd_siswa_calon ".
				"AND psb_siswa_calon_rangking.kd_tapel = '$tp_tapelkd' ".
				"AND psb_siswa_calon.nama <> '' ".
				"AND psb_siswa_calon.asal_sekolah <> '' ".
				"AND psb_siswa_calon.alamat <> '' ".
				"AND psb_siswa_calon_rangking.nil_tertulis >= '0' ".
				"AND psb_siswa_calon_rangking.nil_un >= '0' ".
				"ORDER BY round(psb_siswa_calon_rangking.rata) DESC";
$sqlresult = $sqlcount;

$count = mysql_num_rows(mysql_query($sqlcount));
$pages = $p->findPages($count, $limit);
$result = mysql_query("$sqlresult LIMIT ".$start.", ".$limit);
$pagelist = $p->pageList($_GET['page'], $pages, $target);
$data = mysql_fetch_array($result);





//js
require("../../inc/js/swap.js");

//view //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
echo '<table width="100%" border="0" cellspacing="3" cellpadding="0">
<tr valign="top">
<td>
<h1><strong>'.$sek_nama.'</strong></h1>
'.$sek_alamat.'.

'.$sek_kontak.'
</td>
</tr>
</table>
<hr>


<table width="100%" border="0" cellspacing="3" cellpadding="0">
<tr align="center">
<td><h1><strong>'.$judul.'</strong></h1></td>
</tr>
</table>


<table width="990" border="1" cellspacing="0" cellpadding="3">
<tr align="center" bgcolor="'.$warnaheader.'">
<td width="50"><strong><font color="'.$warnatext.'">No.Daftar</font></strong></td>
<td><strong><font color="'.$warnatext.'">Nama</font></strong></td>
<td width="100"><strong><font color="'.$warnatext.'">Sekolah Asal</font></strong></td>
<td width="75"><strong><font color="'.$warnatext.'">Nilai UN</font></strong></td>
<td width="75"><strong><font color="'.$warnatext.'">Nilai Tertulis</font></strong></td>
<td width="50"><strong><font color="'.$warnatext.'">Total</font></strong></td>
</tr>';

if ($count != 0)
	{
	do
		{
		if ($warna_set ==0)
			{
			$warna = $warna01;
			$warna_set = 1;
			}
		else
			{
			$warna = $warna02;
			$warna_set = 0;
			}

		$d_kd = nosql($data['sckd']);
		$d_no = nosql($data['no']);
		$d_noreg = nosql($data['no_daftar']);
		$d_tes = balikin($data['no_tes']);
		$d_nama = balikin($data['scnama']);
		$d_sekolah = balikin($data['asal_sekolah']);
		$d_nil_un = nosql($data['nil_un']);
		$d_nil_tertulis = nosql($data['nil_tertulis']);
		$d_total = nosql($data['total']);
		$d_rata = nosql($data['rata']);


		echo "<tr valign=\"top\" bgcolor=\"$warna\" onmouseover=\"this.bgColor='$warnaover';\" onmouseout=\"this.bgColor='$warna';\">";
		echo '<td>'.$d_noreg.'</td>

		<td>'.$d_nama.'</td>

		<td>'.$d_sekolah.'</td>

		<td>'.$d_nil_un.'</td>

		<td>'.$d_nil_tertulis.'</td>


		<td>'.$d_rata.'</td>
		</tr>';
		}
	while ($data = mysql_fetch_assoc($result));
	}


echo '</table>
<br>
<br>
<br>';
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

//isi
$isi = ob_get_contents();
ob_end_clean();

require("../../inc/niltpl.php");



//diskonek
xclose($koneksi);
exit();
?>
