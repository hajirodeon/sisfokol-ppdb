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
require("../../inc/class/paging.php");
require("../../inc/cek/psb_adm.php");
$tpl = LoadTpl("../../template/index.html");

nocache;

//nilai
$filenya = "rangking.php";
$judul = "Rangking";
$judulku = "[$adm_session] ==> $judul";
$judulx = $judul;
$page = nosql($_REQUEST['page']);
if ((empty($page)) OR ($page == "0"))
	{
	$page = "1";
	}




$target = "$filenya";



//ketahui tapel aktif
$qtp = mysql_query("SELECT * FROM psb_m_tapel ".
						"WHERE status = 'true'");
$rtp = mysql_fetch_assoc($qtp);
$tp_tapelkd = nosql($rtp['kd']);
$tp_tahun1 = nosql($rtp['tahun1']);
$tp_tahun2 = nosql($rtp['tahun2']);





//isi *START
ob_start();


//pemberian nomor urut rangking
$qpnu = mysql_query("SELECT psb_siswa_calon.*, psb_siswa_calon.kd AS sckd, ".
						"psb_siswa_calon.nama AS scnama, psb_siswa_calon_rangking.* ".
						"FROM psb_siswa_calon, psb_siswa_calon_rangking ".
						"WHERE psb_siswa_calon_rangking.kd_siswa_calon = psb_siswa_calon.kd ".
						"AND psb_siswa_calon_rangking.kd_tapel = '$tp_tapelkd' ".
						"AND psb_siswa_calon.nama <> '' ".
						"AND psb_siswa_calon.asal_sekolah <> '' ".
						"AND psb_siswa_calon.alamat <> '' ".
						"AND psb_siswa_calon_rangking.nil_un <> '0' ".
						"AND psb_siswa_calon_rangking.nil_tertulis <> '0' ".
						"AND psb_siswa_calon.tes_fisik <> '' ".
						"AND psb_siswa_calon.pengembalian <> '' ".
						"ORDER BY psb_siswa_calon.pengembalian DESC, ".
						"psb_siswa_calon.tes_fisik ASC, ".
						"psb_siswa_calon.pengembalian DESC, ".
						"round(psb_siswa_calon_rangking.total,2) DESC, ".
						"round(psb_siswa_calon_rangking.nil_tertulis,2) DESC, ".
						"round(psb_siswa_calon_rangking.nil_un,2) DESC");
$rpnu = mysql_fetch_assoc($qpnu);
$tpnu = mysql_num_rows($qpnu);

do
	{
	//nilai
	$nomex = $nomex + 1;
	$pnu_kd = nosql($rpnu['sckd']);

	//update
	mysql_query("UPDATE psb_siswa_calon_rangking SET no = '$nomex' ".
					"WHERE kd_tapel = '$tp_tapelkd' ".
					"AND kd_siswa_calon = '$pnu_kd'");
	}
while ($rpnu = mysql_fetch_assoc($qpnu));





//query data
$p = new Pager();
$start = $p->findStart($limit);


$sqlcount = "SELECT psb_siswa_calon.*, psb_siswa_calon.kd AS sckd, ".
				"psb_siswa_calon.nama AS scnama, psb_siswa_calon_rangking.* ".
				"FROM psb_siswa_calon, psb_siswa_calon_rangking ".
				"WHERE psb_siswa_calon_rangking.kd_siswa_calon = psb_siswa_calon.kd ".
				"AND psb_siswa_calon_rangking.kd_tapel = '$tp_tapelkd' ".
				"AND psb_siswa_calon.nama <> '' ".
				"AND psb_siswa_calon.asal_sekolah <> '' ".
				"AND psb_siswa_calon.alamat <> '' ".
				"AND psb_siswa_calon_rangking.nil_un <> '0' ".
				"AND psb_siswa_calon_rangking.nil_tertulis <> '0' ".
				"AND psb_siswa_calon.tes_fisik <> '' ".
				"AND psb_siswa_calon.pengembalian <> '' ".
				"ORDER BY psb_siswa_calon.pengembalian DESC, ".
				"psb_siswa_calon.tes_fisik ASC, ".
				"round(psb_siswa_calon_rangking.total,2) DESC, ".
				"round(psb_siswa_calon_rangking.nil_tertulis,2) DESC, ".
				"round(psb_siswa_calon_rangking.nil_un,2) DESC";
$sqlresult = $sqlcount;


$count = mysql_num_rows(mysql_query($sqlcount));
$pages = $p->findPages($count, $limit);
$result = mysql_query("$sqlresult LIMIT ".$start.", ".$limit);
$pagelist = $p->pageList($_GET['page'], $pages, $target);
$data = mysql_fetch_array($result);


//js
require("../../inc/js/swap.js");
require("../../inc/js/jumpmenu.js");
require("../../inc/menu/psb_adm.php");
xheadline($judul);

//view //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
echo '<form action="'.$filenya.'" method="post" name="formx">

<table width="100%" border="1" cellspacing="0" cellpadding="3">
<tr align="center" bgcolor="'.$warnaheader.'">
<td width="5"><strong><font color="'.$warnatext.'">No.</font></strong></td>
<td width="50"><strong><font color="'.$warnatext.'">No. Daftar</font></strong></td>
<td><strong><font color="'.$warnatext.'">Nama</font></strong></td>
<td width="75"><strong><font color="'.$warnatext.'">Nilai UN</font></strong></td>
<td width="75"><strong><font color="'.$warnatext.'">Nilai Tertulis</font></strong></td>
<td width="75"><strong><font color="'.$warnatext.'">Nilai Prestasi</font></strong></td>
<td width="75"><strong><font color="'.$warnatext.'">Nilai Sertifikat</font></strong></td>
<td width="75"><strong><font color="'.$warnatext.'">Tinggi Badan</font></strong></td>
<td width="75"><strong><font color="'.$warnatext.'">Tidak Tindik atau Tatto</font></strong></td>
<td width="75"><strong><font color="'.$warnatext.'">Tidak Buta Warna</font></strong></td>
<td width="75"><strong><font color="'.$warnatext.'">Tidak Cacat Fisik</font></strong></td>
<td width="75"><strong><font color="'.$warnatext.'">Penampilan (periksa rambut,kalung, anting, gelang dan seragam rapi)</font></strong></td>
<td width="75"><strong><font color="'.$warnatext.'">Kesimpulan Akhir Tes Fisik</font></strong></td>
<td width="50"><strong><font color="'.$warnatext.'">Total</font></strong></td>
<td width="50"><strong><font color="'.$warnatext.'">CABUT</font></strong></td>
</tr>';

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
	$d_nama = balikin($data['scnama']);
	$d_nil_un = nosql($data['nil_un']);
	$d_nil_tertulis = nosql($data['nil_tertulis']);
	$d_nil_prestasi = nosql($data['nil_prestasi']);
	$d_nil_sertifikat = nosql($data['nil_sertifikat']);
	$d_total = nosql($data['total']);
	$d_rata = nosql($data['rata']);
	$d_tes_fisik = nosql($data['tes_fisik']);
	$d_kembali = nosql($data['pengembalian']);


	//jika null
	if (empty($d_nil_prestasi))
		{
		$d_nil_prestasi = "0";
		}





	//jika tidak kembali
	if ($d_kembali == "false")
		{
		$d_kembali_ket = "-";
		}
	else if ($d_kembali == "true")
		{
		$warna = "yellow";
		$d_kembali_ket = "CABUT";
		}







	//nilaine...
	$qnile = mysql_query("SELECT * FROM psb_siswa_calon_fisik ".
							"WHERE kd_siswa_calon = '$d_kd'");
	$rnile = mysql_fetch_assoc($qnile);
	$e_nilai1 = nosql($rnile['tinggi_badan']);
	$e_nilai2 = nosql($rnile['tindik_tatto']);
	$e_nilai3 = nosql($rnile['buta_warna']);
	$e_nilai4 = nosql($rnile['cacat_fisik']);
	$e_nilai5 = nosql($rnile['penampilan']);
//		$e_nilaiku = nosql($rnile['nilai']);


	//jika
	if ($e_nilai1 == "true")
		{
		$e_nilai1_ket = "Lulus";
		}
	else
		{
		$e_nilai1_ket = "Tidak Lulus";
		}

	//jika
	if ($e_nilai2 == "true")
		{
		$e_nilai2_ket = "Lulus";
		}
	else
		{
		$e_nilai2_ket = "Tidak Lulus";
		}


	//jika
	if ($e_nilai3 == "true")
		{
		$e_nilai3_ket = "Lulus";
		}
	else
		{
		$e_nilai3_ket = "Tidak Lulus";
		}


	//jika
	if ($e_nilai4 == "true")
		{
		$e_nilai4_ket = "Lulus";
		}
	else
		{
		$e_nilai4_ket = "Tidak Lulus";
		}


	//jika
	if ($e_nilai5 == "true")
		{
		$e_nilai5_ket = "Lulus";
		}
	else
		{
		$e_nilai5_ket = "Tidak Lulus";
		}



	//tes fisik
	$qcku2 = mysql_query("SELECT * FROM psb_siswa_calon_fisik ".
							"WHERE kd_siswa_calon = '$d_kd' ".
							"AND nilai = 'true'");
	$rcku2 = mysql_fetch_assoc($qcku2);
	$tcku2 = mysql_num_rows($qcku2);

	//jika diterima
	if (!empty($tcku2))
		{
		$d_fisik_ket = "LULUS";
		}
	else
		{
		$warna = "red";
		$d_fisik_ket = "TUNGGU HASIL/GAGAL";
		}



	//jika
	if ($e_nilaiku == "true")
		{
		$e_nilaiku_ket = "Lulus";
		}
	else
		{
		$e_nilaiku_ket = "Tidak Lulus";
		}





	echo "<tr valign=\"top\" bgcolor=\"$warna\" onmouseover=\"this.bgColor='$warnaover';\" onmouseout=\"this.bgColor='$warna';\">";
	echo '<td>'.$d_no.'</td>
	<td>'.$d_noreg.'</td>

	<td>'.$d_nama.'</td>

	<td align="right">'.$d_nil_un.'</td>

	<td align="right">'.$d_nil_tertulis.'</td>

	<td align="right">'.$d_nil_prestasi.'</td>

	<td align="right">'.$d_nil_sertifikat.'</td>
	
	<td align="right">'.$e_nilai1_ket.'</td>
	<td align="right">'.$e_nilai2_ket.'</td>
	<td align="right">'.$e_nilai3_ket.'</td>
	<td align="right">'.$e_nilai4_ket.'</td>
	<td align="right">'.$e_nilai5_ket.'</td>
	<td align="right">'.$d_fisik_ket.'</td>

	<td align="right">'.$d_rata.'</td>
	<td align="right">'.$d_kembali_ket.'</td>
	</tr>';
	}
while ($data = mysql_fetch_assoc($result));

echo '</table>
<table width="900" border="0" cellspacing="0" cellpadding="3">
<tr>
<td>
'.$pagelist.' <strong><font color="#FF0000">'.$count.'</font></strong> Data.</td>
</tr>
</table>';


echo '</form>
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
