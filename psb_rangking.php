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
$tpl = LoadTpl("template/rangking.html");


nocache;

//nilai
$filenya = "psb_rangking.php";
$judul = "Jurnal Peringkat Sementara/Rangking";
$judulku = $judul;
$page = nosql($_REQUEST['page']);
if ((empty($page)) OR ($page == "0"))
	{
	$page = "1";
	}


$limit = "50";


//ketahui tapel aktif
$qtp = mysql_query("SELECT * FROM psb_m_tapel ".
			"WHERE status = 'true'");
$rtp = mysql_fetch_assoc($qtp);
$tp_tapelkd = nosql($rtp['kd']);
$tp_tahun1 = nosql($rtp['tahun1']);
$tp_tahun2 = nosql($rtp['tahun2']);
$tp_dayatampung = nosql($rtp['dayatampung']);



$target = "$filenya";



//isi *START
ob_start();


//js
require("inc/js/jumpmenu.js");



//view //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
echo '<form action="'.$filenya.'" method="post" name="formx">';
echo '<table width="100%" border="0" cellspacing="3" cellpadding="0">
<tr valign="top" align="left">
<td width="100">';
//ambil data menu
require("inc/menu/psb_menu.php");
echo '</td>

<td align="left">
<big><strong>'.$judul.'</strong></big>
<br>

<table width="100%" border="0" cellspacing="0" cellpadding="3">
<tr bgcolor="'.$warnaheader.'">
<td>
Daya Tampung : 
<b>
'.$tp_dayatampung.'
</b>
</td>
</tr>
</table>';


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
				"AND psb_siswa_calon.tes_fisik = 'true' ".
				"AND psb_siswa_calon.pengembalian <> '' ".
				"ORDER BY round(psb_siswa_calon_rangking.total) DESC, ". 
				"round(psb_siswa_calon_rangking.nil_un) DESC";
$sqlresult = $sqlcount;

$count = mysql_num_rows(mysql_query($sqlcount));
$pages = $p->findPages($count, $limit);
$result = mysql_query("$sqlresult LIMIT ".$start.", ".$limit);
$pagelist = $p->pageList($_GET['page'], $pages, $target);
$data = mysql_fetch_array($result);

if ($count != 0)
	{
	echo '<table width="100%" border="1" cellspacing="0" cellpadding="3">
	<tr align="center" bgcolor="'.$warnaheader.'">
	<td width="50" rowspan="3"><strong><font color="'.$warnatext.'">No. Daftar</font></strong></td>
	<td width="250" rowspan="3"><strong><font color="'.$warnatext.'">Nama Calon Peserta Didik</font></strong></td>
	<td width="75" rowspan="3"><strong><font color="'.$warnatext.'">L/P</font></strong></td>
	<td width="150" rowspan="3"><strong><font color="'.$warnatext.'">Asal Sekolah</font></strong></td>
	<td colspan="1"><strong><font color="'.$warnatext.'">Tes Kesehatan/Tes Fisik</font></strong></td>';
	
	//query
	$q1 = mysql_query("SELECT * FROM psb_m_mapel2 ".
							"WHERE kd_tapel = '$tp_tapelkd' ".
							"ORDER BY no ASC");
	$row1 = mysql_fetch_assoc($q1);
	$t1 = mysql_num_rows($q1);
	$tt1 = $t1 * 3;

	
	echo '<td colspan="'.$tt1.'"><strong><font color="'.$warnatext.'">Nilai Tertulis</font></strong></td>';
	
	//query
	$q2 = mysql_query("SELECT * FROM psb_m_mapel ".
							"WHERE kd_tapel = '$tp_tapelkd' ".
							"ORDER BY no ASC");
	$row2 = mysql_fetch_assoc($q2);
	$t2 = mysql_num_rows($q2);
	$tt2 = $t2 * 3;
	
	
	echo '<td colspan="'.$tt2.'"><strong><font color="'.$warnatext.'">Nilai UN</font></strong></td>';

	//query
	$q3 = mysql_query("SELECT * FROM psb_m_sertifikat ".
							"ORDER BY no ASC");
	$row3 = mysql_fetch_assoc($q3);
	$t3 = mysql_num_rows($q3);
	
	
	echo '<td rowspan="1" colspan="'.$t3.'"><strong><font color="'.$warnatext.'">PRESTASI/SERTIFIKAT</font></strong></td>';
	
	echo '<td width="50" rowspan="3" bgcolor="orange"><strong><font color="'.$warnatext.'">Total</font></strong></td>
	</tr>

	<tr align="center" bgcolor="'.$warnaheader.'">
	<td width="75" rowspan="2"><strong><font color="'.$warnatext.'">Kesimpulan Akhir Tes Fisik</font></strong></td>';

	do 
		{
		$d_kd = nosql($row1['kd']);
		$d_no = nosql($row1['no']);
		$d_mapel = balikin($row1['mapel']);
		$d_bobot = nosql($row1['bobot']);
	
		echo '<td colspan="3">
		<strong><font color="'.$warnatext.'">'.$d_mapel.'</font></strong>
		</td>';	
		}
	while ($row1 = mysql_fetch_assoc($q1));


	do 
		{
		$d_kd = nosql($row2['kd']);
		$d_no = nosql($row2['no']);
		$d_mapel = balikin($row2['mapel']);
		$d_bobot = nosql($row2['bobot']);
	
		echo '<td colspan="3">
		<strong><font color="'.$warnatext.'">'.$d_mapel.'</font></strong>
		</td>';	
		}
	while ($row2 = mysql_fetch_assoc($q2));


	do 
		{
		$d_kd = nosql($row3['kd']);
		$d_no = nosql($row3['no']);
		$d_nama = balikin($row3['nama']);
	
		echo '<td rowspan="2">
		<strong><font color="'.$warnatext.'">'.$d_nama.'</font></strong>
		</td>';	
		}
	while ($row3 = mysql_fetch_assoc($q3));
		
		
	echo '</tr>
	
	<tr align="center" bgcolor="'.$warnaheader.'">';
	
	//query
	$q1 = mysql_query("SELECT * FROM psb_m_mapel2 ".
							"WHERE kd_tapel = '$tp_tapelkd' ".
							"ORDER BY no ASC");
	$row1 = mysql_fetch_assoc($q1);
	$t1 = mysql_num_rows($q1);

	do 
		{
		$d_kd = nosql($row1['kd']);

	
		echo '<td>
		<strong><font color="'.$warnatext.'">Nilai</font></strong>
		</td>
		<td>
		<strong><font color="'.$warnatext.'">Bobot</font></strong>
		</td>
		<td>
		<strong><font color="'.$warnatext.'">Skor</font></strong>
		</td>';
		}
	while ($row1 = mysql_fetch_assoc($q1));
	


	//query
	$q1 = mysql_query("SELECT * FROM psb_m_mapel ".
							"WHERE kd_tapel = '$tp_tapelkd' ".
							"ORDER BY no ASC");
	$row1 = mysql_fetch_assoc($q1);
	$t1 = mysql_num_rows($q1);

	do 
		{
		$d_kd = nosql($row1['kd']);

	
		echo '<td>
		<strong><font color="'.$warnatext.'">Nilai</font></strong>
		</td>
		<td>
		<strong><font color="'.$warnatext.'">Bobot</font></strong>
		</td>
		<td>
		<strong><font color="'.$warnatext.'">Skor</font></strong>
		</td>';
		}
	while ($row1 = mysql_fetch_assoc($q1));
		
	
	
	
	echo '</tr>';

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

		$warnaover = "orange";
		
		
		$d_kd = nosql($data['sckd']);
		$d_no = nosql($data['no']);
		$d_kelkd = nosql($data['kelamin']);
		$d_noreg = nosql($data['no_daftar']);
		$d_nama = balikin($data['scnama']);
		$d_asal_sekolah = balikin($data['asal_sekolah']);
		$d_nil_un = nosql($data['nil_un']);
		$d_nil_tertulis = nosql($data['nil_tertulis']);
		$d_nil_prestasi = nosql($data['nil_prestasi']);
		$d_total = nosql($data['total']);
		$d_rata = nosql($data['rata']);
		$d_fisik = nosql($data['tes_fisik']);
		$d_kembali = nosql($data['pengembalian']);


		//jika null
		if (empty($d_nil_prestasi))
			{
			$d_nil_prestasi = "0";
			}



		//jika lulus fisik
		if ($d_fisik == "true")
			{
			$d_fisik_ket = "LULUS";
			}
		else
			{
			$warna = "red";
			$d_fisik_ket = "TUNGGU HASIL/GAGAL";
			$d_no = "-";
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
		$e_nilaiku = $d_fisik;


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



		//jika
		if ($e_nilaiku == "true")
			{
			$e_nilaiku_ket = "Lulus";
			}
		else 
			{
			$e_nilaiku_ket = "Tidak Lulus";
			}


		
		//kelamin
		if ($d_kelkd == "01")
			{
			$d_kelamin = "L";
			}
		else if ($d_kelkd == "02")
			{
			$d_kelamin = "P";
			}

		echo "<tr valign=\"top\" bgcolor=\"$warna\" onmouseover=\"this.bgColor='$warnaover';\" onmouseout=\"this.bgColor='$warna';\">";
		echo '<td>'.$d_noreg.'</td>

		<td>'.$d_nama.'</td>

		<td>'.$d_kelamin.'</td>
		<td>'.$d_asal_sekolah.'</td>
		<td align="right">
		<b>
		'.$d_fisik_ket.'
		</b>
		</td>';

		//query
		$q1 = mysql_query("SELECT * FROM psb_m_mapel2 ".
								"WHERE kd_tapel = '$tp_tapelkd' ".
								"ORDER BY no ASC");
		$row1 = mysql_fetch_assoc($q1);

		do 
			{
			$d_kdx = nosql($row1['kd']);
			$d_no = nosql($row1['no']);
			$d_mapel = balikin($row1['mapel']);
			$d_bobot = nosql($row1['bobot']);
		

			//nilaine...
			$qnile = mysql_query("SELECT * FROM psb_siswa_calon_tertulis ".
									"WHERE kd_siswa_calon = '$d_kd' ".
									"AND kd_mapel = '$d_kdx'");
			$rnile = mysql_fetch_assoc($qnile);
			$nile_nilai = nosql($rnile['nilai']);
			$nile_total = nosql($rnile['total']);
					
			echo '<td>
			'.$nile_nilai.'
			</td>
			<td>
			'.$d_bobot.'
			</td>
			<td>
			<b>
			'.$nile_total.'
			</b>
			</td>';	
			}
		while ($row1 = mysql_fetch_assoc($q1));


		//query
		$q1 = mysql_query("SELECT * FROM psb_m_mapel ".
								"WHERE kd_tapel = '$tp_tapelkd' ".
								"ORDER BY no ASC");
		$row1 = mysql_fetch_assoc($q1);

		do 
			{
			$d_kdx = nosql($row1['kd']);
			$d_no = nosql($row1['no']);
			$d_mapel = balikin($row1['mapel']);
			$d_bobot = nosql($row1['bobot']);
		
			//nilaine...
			$qnile = mysql_query("SELECT * FROM psb_siswa_calon_un ".
									"WHERE kd_siswa_calon = '$d_kd' ".
									"AND kd_mapel = '$d_kdx'");
			$rnile = mysql_fetch_assoc($qnile);
			$nile_nilai = nosql($rnile['nilai']);
			$nile_total = nosql($rnile['total']);
					
			echo '<td>
			'.$nile_nilai.'
			</td>
			<td>
			'.$d_bobot.'
			</td>
			<td>
			<b>
			'.$nile_total.'
			</b>
			</td>';	
			}
		while ($row1 = mysql_fetch_assoc($q1));



		//query
		$q1 = mysql_query("SELECT * FROM psb_m_sertifikat ".
								"ORDER BY no ASC");
		$row1 = mysql_fetch_assoc($q1);

		do 
			{
			$d_kdx = nosql($row1['kd']);
			$d_no = nosql($row1['no']);
			$d_nama = balikin($row1['nama']);
		
					
			//nilaine...
			$qnile = mysql_query("SELECT * FROM psb_siswa_calon_sertifikat ".
									"WHERE kd_siswa_calon = '$d_kd' ".
									"AND kd_sertifikat = '$d_kdx'");
			$rnile = mysql_fetch_assoc($qnile);
			$nile_nilai = nosql($rnile['nilai']);
					
			echo '<td>
			<b>
			'.$nile_nilai.'
			</b>
			</td>';	
			}
		while ($row1 = mysql_fetch_assoc($q1));


		echo '<td bgcolor="orange"><b><big>'.$d_rata.'</big></b></td>
		</tr>';
		}
	while ($data = mysql_fetch_assoc($result));

	echo '</table>
	<table width="100%" border="0" cellspacing="0" cellpadding="3">
	<tr>
	<td>
	'.$pagelist.'
	<strong><font color="#FF0000">'.$count.'</font></strong> Data.</td>
	</tr>
	</table>';
	}
else
	{
	echo '<p>
	<font color="red"><strong>BELUM ADA DATA</strong></font>
	</p>';
	}


echo '</td>
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