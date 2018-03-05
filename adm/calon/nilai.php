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
$filenya = "nilai.php";
$judul = "Calon : Nilai-Nilai";
$judulku = "[$adm_session] ==> $judul";
$judulx = $judul;
$katcari = nosql($_REQUEST['katcari']);
$kunci = cegah2($_REQUEST['kunci']);
$page = nosql($_REQUEST['page']);
if ((empty($page)) OR ($page == "0"))
	{
	$page = "1";
	}


$limit = "100";




//ketahui tapel aktif
$qtp = mysql_query("SELECT * FROM psb_m_tapel ".
			"WHERE status = 'true'");
$rtp = mysql_fetch_assoc($qtp);
$tp_tapelkd = nosql($rtp['kd']);
$tp_tahun1 = nosql($rtp['tahun1']);
$tp_tahun2 = nosql($rtp['tahun2']);




//isi *START
ob_start();



//query
$p = new Pager();
$start = $p->findStart($limit);


$sqlcount = "SELECT DISTINCT (psb_siswa_calon.kd) AS sckd ".
				"FROM psb_siswa_calon, psb_siswa_calon_un ".
				"WHERE  psb_siswa_calon.kd_tapel = '$tp_tapelkd' ".
				"AND psb_siswa_calon.nama <> '' ".
				"AND psb_siswa_calon.asal_sekolah <> '' ".
				"AND psb_siswa_calon.alamat <> '' ".
				"AND psb_siswa_calon_un.kd_siswa_calon = psb_siswa_calon.kd ".
				"ORDER BY psb_siswa_calon.no_daftar DESC";
$sqlresult = $sqlcount;


//kondisi pencarian
if ($_POST['btnCRI'])
	{
	$keahkd = nosql($_POST['keahkd']);

	//cek
	if ((empty($katcari)) OR (empty($kunci)))
		{
		//re-direct
		$pesan = "Input Tidak Lengkap. Harap Diulangi...!!";
		$ke = "$filenya";
		pekem($pesan,$ke);
		exit();
		}
	else
		{
		//no daftar
		if ($katcari == "cr01")
			{
			$sqlcount = "SELECT DISTINCT (psb_siswa_calon.kd) AS sckd ".
							"FROM psb_siswa_calon, psb_siswa_calon_un ".
							"WHERE  psb_siswa_calon.kd_tapel = '$tp_tapelkd' ".
							"AND psb_siswa_calon.nama <> '' ".
							"AND psb_siswa_calon.asal_sekolah <> '' ".
							"AND psb_siswa_calon.alamat <> '' ".
							"AND psb_siswa_calon_un.kd_siswa_calon = psb_siswa_calon.kd ".
							"AND psb_siswa_calon.no_daftar LIKE '%$kunci%' ".
							"ORDER BY psb_siswa_calon.no_daftar DESC";
			$sqlresult = $sqlcount;
			}

		//nama
		else if ($katcari == "cr02")
			{
			$sqlcount = "SELECT DISTINCT (psb_siswa_calon.kd) AS sckd ".
							"FROM psb_siswa_calon, psb_siswa_calon_un ".
							"WHERE  psb_siswa_calon.kd_tapel = '$tp_tapelkd' ".
							"AND psb_siswa_calon.nama <> '' ".
							"AND psb_siswa_calon.asal_sekolah <> '' ".
							"AND psb_siswa_calon.alamat <> '' ".
							"AND psb_siswa_calon_un.kd_siswa_calon = psb_siswa_calon.kd ".
							"AND psb_siswa_calon.nama LIKE '%$kunci%' ".
							"ORDER BY psb_siswa_calon.no_daftar DESC";
			$sqlresult = $sqlcount;
			}

		//asal sekolah
		else if ($katcari == "cr03")
			{
			$sqlcount = "SELECT DISTINCT (psb_siswa_calon.kd) AS sckd ".
							"FROM psb_siswa_calon, psb_siswa_calon_un ".
							"WHERE  psb_siswa_calon.kd_tapel = '$tp_tapelkd' ".
							"AND psb_siswa_calon.nama <> '' ".
							"AND psb_siswa_calon.asal_sekolah <> '' ".
							"AND psb_siswa_calon.alamat <> '' ".
							"AND psb_siswa_calon_un.kd_siswa_calon = psb_siswa_calon.kd ".
							"AND psb_siswa_calon.asal_sekolah LIKE '%$kunci%' ".
							"ORDER BY psb_siswa_calon.no_daftar DESC";
			$sqlresult = $sqlcount;
			}
		}
	}
else
	{
	$sqlcount = "SELECT DISTINCT (psb_siswa_calon.kd) AS sckd ".
					"FROM psb_siswa_calon, psb_siswa_calon_un ".
					"WHERE  psb_siswa_calon.kd_tapel = '$tp_tapelkd' ".
					"AND psb_siswa_calon.nama <> '' ".
					"AND psb_siswa_calon.asal_sekolah <> '' ".
					"AND psb_siswa_calon.alamat <> '' ".
					"AND psb_siswa_calon_un.kd_siswa_calon = psb_siswa_calon.kd ".
					"ORDER BY psb_siswa_calon.no_daftar DESC";
	$sqlresult = $sqlcount;
	}



//jika reset
if ($_POST['btnRST'])
	{
	$keahkd = nosql($_POST['keahkd']);

	$sqlcount = "SELECT DISTINCT (psb_siswa_calon.kd) AS sckd ".
					"FROM psb_siswa_calon, psb_siswa_calon_un ".
					"WHERE  psb_siswa_calon.kd_tapel = '$tp_tapelkd' ".
					"AND psb_siswa_calon.nama <> '' ".
					"AND psb_siswa_calon.asal_sekolah <> '' ".
					"AND psb_siswa_calon.alamat <> '' ".
					"AND psb_siswa_calon_un.kd_siswa_calon = psb_siswa_calon.kd ".
					"ORDER BY psb_siswa_calon.no_daftar DESC";
	$sqlresult = $sqlcount;
	}


$count = mysql_num_rows(mysql_query($sqlcount));
$pages = $p->findPages($count, $limit);
$result = mysql_query("$sqlresult LIMIT ".$start.", ".$limit);
$target = "$filenya?keahkd=$keahkd";
$pagelist = $p->pageList($_GET['page'], $pages, $target);
$data = mysql_fetch_array($result);


//js
require("../../inc/js/swap.js");
require("../../inc/js/jumpmenu.js");
require("../../inc/menu/psb_adm.php");
xheadline($judul);

//view //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
echo '<form action="'.$filenya.'" method="post" name="formx">
<p>
	<select name="katcari">
	<option value="" selected></option>
	<option value="cr01">No.pendaftaran</option>
	<option value="cr02">Nama</option>
	<option value="cr03">Sekolah Asal</option>
	</select>
	<input name="kunci" type="text" value="" size="20">
	<input name="btnCRI" type="submit" value="CARI">
	<input name="btnRST" type="submit" value="RESET">
	</p>';



	//rata
	$qcc = mysql_query("SELECT * FROM psb_m_rumus ".
							"WHERE kd_tapel = '$tp_tapelkd'");
	$rcc = mysql_fetch_assoc($qcc);
	$tcc = mysql_num_rows($qcc);
	$cc_p_tertulis = nosql($rcc['persen_tertulis']);
	$cc_p_prestasi = nosql($rcc['persen_prestasi']);
	$cc_p_sertifikat = nosql($rcc['persen_sertifikat']);
	$cc_p_un = nosql($rcc['persen_un']);


	echo '<p>
	<font color="red"><strong>Warna Merah</strong></font> : Syarat Tidak Lengkap/Tidak Terpenuhi.
	<br>
	<font color="yellow"><strong>Warna Kuning</strong></font> : Syarat Umum Lengkap/Terpenuhi.
	<br>
	<font color="violet"><strong>Warna Violet</strong></font> : Tidak Lulus Tes Fisik.
	<br>

	<table width="100%" border="1" cellspacing="0" cellpadding="3">
	<tr align="center" bgcolor="'.$warnaheader.'">
	<td width="50"><strong><font color="'.$warnatext.'">No.Daftar</font></strong></td>
	<td width="200"><strong><font color="'.$warnatext.'">Nama</font></strong></td>
	<td><strong><font color="'.$warnatext.'">Sekolah Asal</font></strong></td>
	<td width="75">
	<strong>
	<font color="'.$warnatext.'">
	UN
	</font>
	</strong>
	<br>
	'.$cc_p_un.'%
	</td>
	<td width="75">
	<strong>
	<font color="'.$warnatext.'">
	Fisik
	</font>
	</strong>
	</td>
	<td width="75">
	<strong>
	<font color="'.$warnatext.'">
	Tertulis
	</font>
	</strong>
	<br>
	'.$cc_p_tertulis.'%
	</td>

	<td width="75">
	<strong>
	<font color="'.$warnatext.'">
	Prestasi
	</font>
	</strong>
	<br>
	'.$cc_p_prestasi.'%
	</td>

	<td width="75">
	<strong>
	<font color="'.$warnatext.'">
	Sertifikat
	</font>
	</strong>
	<br>
	'.$cc_p_sertifikat.'%
	</td>


	<td width="50"><strong><font color="'.$warnatext.'">Jumlah</font></strong></td>
	<td width="50"><strong><font color="'.$warnatext.'">RATA</font></strong></td>
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

			$nomer = $nomer + 1;
			$xx = md5("$x$nomer");
			$d_kd = nosql($data['sckd']);



			//detail e
			$qdt = mysql_query("SELECT DATE_FORMAT(tgl_lahir, '%d') AS ltgl, ".
						"DATE_FORMAT(tgl_lahir, '%m') AS lbln, ".
						"DATE_FORMAT(tgl_lahir, '%Y') AS lthn, ".
						"psb_siswa_calon.* ".
						"FROM psb_siswa_calon ".
						"WHERE kd = '$d_kd'");
			$rdt = mysql_fetch_assoc($qdt);
			$d_noreg = nosql($rdt['no_daftar']);
			$d_username = nosql($rdt['username']);
			$d_status = nosql($rdt['status_diterima']);
			$d_nama = balikin($rdt['nama']);
			$d_asal_sekolah = balikin($rdt['asal_sekolah']);
			$d_tgl_daftar = $rdt['tgl_daftar'];





			//nilai UN ////////////////////////////////////////////////////////////////////////////////////
			//rata2 akhir
//			$qc1 = mysql_query("SELECT AVG(rata) AS rataku ".
			$qc1 = mysql_query("SELECT SUM(total) AS rataku, ".
									"psb_siswa_calon_un.postdate AS postdateku ".
									"FROM psb_siswa_calon_un ".
									"WHERE kd_siswa_calon = '$d_kd'");
			$rc1 = mysql_fetch_assoc($qc1);
			$nil_un = round($rc1['rataku'],2);
			$nil_un_postdate = $rc1['postdateku'];


			//jika null
			if (empty($nil_un))
				{
				$qc1 = mysql_query("SELECT SUM(nilai) AS rataku ".
							"FROM psb_siswa_calon_un ".
							"WHERE kd_siswa_calon = '$d_kd'");
				$rc1 = mysql_fetch_assoc($qc1);
				$nil_un = round($rc1['rataku'],2);
				}






			//nilai tertulis ////////////////////////////////////////////////////////////////////////////////////
			//skor
			$qcku = mysql_query("SELECT SUM(total) AS nilku ".
									"FROM psb_siswa_calon_tertulis ".
									"WHERE kd_siswa_calon = '$d_kd'");
			$rcku = mysql_fetch_assoc($qcku);
			$nil_tertulis = round(nosql($rcku['nilku']),2);


			//waktu modifikasi
			$qcc3 = mysql_query("SELECT * FROM psb_siswa_calon_tertulis ".
									"WHERE kd_siswa_calon = '$d_kd'");
			$rcc3 = mysql_fetch_assoc($qcc3);
			$tcc3 = mysql_num_rows($qcc3);
			$cc3_postdate = $rcc3['postdate'];



			//nilai fisik ////////////////////////////////////////////////////////////////////////////////////			
			//nilaine...
			$qnile = mysql_query("SELECT * FROM psb_siswa_calon_fisik ".
						"WHERE kd_siswa_calon = '$d_kd'");
			$rnile = mysql_fetch_assoc($qnile);
			$e_nilai1 = nosql($rnile['tinggi_badan']);
			$e_nilai2 = nosql($rnile['tindik_tatto']);
			$e_nilai3 = nosql($rnile['buta_warna']);
			$e_nilai4 = nosql($rnile['cacat_fisik']);
			$e_nilai5 = nosql($rnile['penampilan']);
			

			
			
			//nilai akhir fisik
			$qcku2 = mysql_query("SELECT * FROM psb_siswa_calon_fisik ".
									"WHERE kd_siswa_calon = '$d_kd' ".
									"AND tinggi_badan = 'true' ".
									"AND tindik_tatto = 'true' ".
									"AND buta_warna = 'true' ".
									"AND cacat_fisik = 'true' ".
									"AND penampilan = 'true'");
			$rcku2 = mysql_fetch_assoc($qcku2);
			$tcku2xx = mysql_num_rows($qcku2);
				
				
			//jika lulus
			if ($tcku2xx != 0)
				{
				//gak lulus
				mysql_query("UPDATE psb_siswa_calon_fisik SET nilai = 'true' ".
								"WHERE kd_siswa_calon = '$d_kd'");
					
				//calon
				mysql_query("UPDATE psb_siswa_calon SET tes_fisik = 'true' ".
								"WHERE kd = '$d_kd'");			
				}
			else 
				{
				//lulus
				mysql_query("UPDATE psb_siswa_calon_fisik SET nilai = 'false' ".
								"WHERE kd_siswa_calon = '$d_kd'");
					
				//calon
				mysql_query("UPDATE psb_siswa_calon SET tes_fisik = 'false' ".
								"WHERE kd = '$d_kd'");						
				}


			
			/*				
			//jika lulus semua, berarti memang lulus
			if (($e_nilai1 == "true") AND ($e_nilai2 == "true") AND ($e_nilai3 == "true") AND ($e_nilai4 == "true") AND ($e_nilai5 == "true"))
				{
				//update lulus
				mysql_query("UPDATE psb_siswa_calon_fisik SET nilai = 'true' ".
								"WHERE kd_siswa_calon = '$d_kd'");
				}
			*/
			
			//tes fisik
			$qcku2 = mysql_query("SELECT * FROM psb_siswa_calon_fisik ".
									"WHERE kd_siswa_calon = '$d_kd' ".
									"AND nilai = 'true'");
			$rcku2 = mysql_fetch_assoc($qcku2);
			$tcku2 = mysql_num_rows($qcku2);

			//jika diterima
			if (!empty($tcku2))
				{
				$nil_fisik = "LULUS";
				$nil_fisik2 = "true";
				}
			else
				{
				$nil_fisik = "GAGAL";
				$nil_fisik2 = "false";
				}




			//nilai prestasi ////////////////////////////////////////////////////////////////////////////////////
			$qcku3 = mysql_query("SELECT SUM(psb_m_prestasi.skor) AS nilku, ".
									"psb_siswa_calon_prestasi.postdate AS postdateku ".
									"FROM psb_m_prestasi, psb_siswa_calon_prestasi ".
									"WHERE psb_siswa_calon_prestasi.kd_prestasi = psb_m_prestasi.kd ".
									"AND psb_siswa_calon_prestasi.kd_siswa_calon = '$d_kd'");
			$rcku3 = mysql_fetch_assoc($qcku3);
			$nil_prestasix = round(nosql($rcku3['nilku']),2);
			$nil_prestasix_postdateku = $rcku3['postdateku'];



			//nilai sertifikat ////////////////////////////////////////////////////////////////////////////////////
			$qcku4 = mysql_query("SELECT SUM(psb_siswa_calon_sertifikat.nilai) AS nilku, ".
										"psb_siswa_calon_sertifikat.postdate AS postdateku ".
										"FROM psb_m_sertifikat, psb_siswa_calon_sertifikat ".
										"WHERE psb_siswa_calon_sertifikat.kd_sertifikat = psb_m_sertifikat.kd ".
										"AND psb_siswa_calon_sertifikat.kd_siswa_calon = '$d_kd'");
			$rcku4 = mysql_fetch_assoc($qcku4);
			$nil_sertifikat = round(nosql($rcku4['nilku']),2);
			$nil_sertifikat_postdateku = $rcku4['postdateku'];





			//jika ada yang kosong
			if (empty($tcku2))
				{
				$warna = "violet";
				}
			else if ((empty($nil_un)) OR (empty($cku_tertulis)))
				{
				$warna = "red";
				}
			else
				{
				$warna = "yellow";
				}




			//jika diterima
			if (($nil_tertulis >= 5) AND ($d_status == "true"))
				{
				$d_status2 = "IYA, DITERIMA";
				$warna = "orange";
				}
//			else if (($nil_tertulis < 5) AND ($d_status == "false"))
			else
				{
				$d_status2 = "Belum Diterima";
				}


			echo "<tr valign=\"top\" bgcolor=\"$warna\" onmouseover=\"this.bgColor='$warnaover';\" onmouseout=\"this.bgColor='$warna';\">";
			echo '<td>'.$d_noreg.'</td>
			<td>'.$d_nama.'</td>

			<td>'.$d_asal_sekolah.'</td>

			<td>
			[<a href="nilai_un.php?swkd='.$d_kd.'&noregx='.$d_noreg.'&page='.$page.'" title="Nilai Raport : ['.$d_noreg.']. '.$d_nama.'"><img src="'.$sumber.'/img/edit.gif" width="16" height="16" border="0"></a>]
			<br>
			[<strong>'.$nil_un.'</strong>]. 
			<br>
			[Modifikasi : '.$nil_un_postdate.']
			</td>

			<td>
			[<a href="nilai_fisik.php?swkd='.$d_kd.'&noregx='.$d_noreg.'&page='.$page.'" title="Nilai Tes Fisik : ['.$d_noreg.']. '.$d_nama.'"><img src="'.$sumber.'/img/preview.gif" width="16" height="16" border="0"></a>]
			<br>
			[<strong>'.$nil_fisik.'</strong>]
			</td>

			<td>
			[<a href="nilai_tertulis.php?swkd='.$d_kd.'&noregx='.$d_noreg.'&page='.$page.'" title="Nilai Tes Tertulis : ['.$d_noreg.']. '.$d_nama.'"><img src="'.$sumber.'/img/edit.gif" width="16" height="16" border="0"></a>]
			<br>
			[<strong>'.$nil_tertulis.'</strong>]. 
			<br>
			[Modifikasi : '.$cc3_postdate.']
			</td>


			<td>
			[<a href="nilai_prestasi.php?swkd='.$d_kd.'&noregx='.$d_noreg.'&page='.$page.'" title="Nilai Tes Tertulis : ['.$d_noreg.']. '.$d_nama.'"><img src="'.$sumber.'/img/edit.gif" width="16" height="16" border="0"></a>]
			<br>
			[<strong>'.$nil_prestasix.'</strong>]
			<br>
			[Modifikasi : '.$nil_prestasix_postdateku.']
			</td>

			<td>
			[<a href="nilai_sertifikat.php?swkd='.$d_kd.'&noregx='.$d_noreg.'&page='.$page.'" title="Nilai Tes Tertulis : ['.$d_noreg.']. '.$d_nama.'"><img src="'.$sumber.'/img/edit.gif" width="16" height="16" border="0"></a>]
			<br>
			[<strong>'.$nil_sertifikat.'</strong>]
			<br>
			[Modifikasi : '.$nil_sertifikat_postdateku.']
			</td>';


			//total nilai
//			$total_nilai = round($nil_un + $nil_tertulis + $nil_prestasix + $nil_sertifikat,2);




			//rata
			$qcc = mysql_query("SELECT * FROM psb_m_rumus ".
									"WHERE kd_tapel = '$tp_tapelkd'");
			$rcc = mysql_fetch_assoc($qcc);
			$tcc = mysql_num_rows($qcc);
			$cc_p_tertulis = nosql($rcc['persen_tertulis']);
			$cc_p_prestasi = nosql($rcc['persen_prestasi']);
			$cc_p_sertifikat = nosql($rcc['persen_sertifikat']);
			$cc_p_un = nosql($rcc['persen_un']);

			$nil2_tertulis = round(($cc_p_tertulis * $nil_tertulis)/100,2);
			$nil2_prestasi = round(($cc_p_prestasi * $nil_prestasix)/100,2);
			$nil2_sertifikat = round(($cc_p_sertifikat * $nil_sertifikat)/100,2);
			$nil2_un = round(($cc_p_un * $nil_un)/100,2);
			$nil2_rata = round($nil2_tertulis + $nil2_prestasi + $nil2_sertifikat + $nil2_un,2);

			
			$total_nilai = round($nil_tertulis + $nil_prestasix + $nil_sertifikat + $nil_un,2);
			




			//entri ke table rangking ///////////////////////////////////////////////////////////////////////////
			$qcc = mysql_query("SELECT * FROM psb_siswa_calon_rangking ".
									"WHERE kd_tapel = '$tp_tapelkd' ".
									"AND kd_siswa_calon = '$d_kd'");
			$rcc = mysql_fetch_assoc($qcc);
			$tcc = mysql_num_rows($qcc);

			//jika ada
			if ($tcc != 0)
				{
				mysql_query("UPDATE psb_siswa_calon_rangking SET nil_fisik = '$nil_fisik2', ".
								"nil_un = '$nil2_un', ".
								"nil_tertulis = '$nil2_tertulis', ".
								"nil_prestasi = '$nil2_prestasi', ".
								"nil_sertifikat = '$nil2_sertifikat', ".
								"total = '$total_nilai', ".
								"rata = '$nil2_rata', ".
								"postdate = '$today' ".
								"WHERE kd_tapel = '$tp_tapelkd' ".
								"AND kd_siswa_calon = '$d_kd'");
				}
			else
				{
				mysql_query("INSERT INTO psb_siswa_calon_rangking(kd, kd_tapel, kd_siswa_calon, ".
								"nil_fisik, nil_un, nil_tertulis, nil_prestasi, nil_sertifikat, total, rata, postdate) VALUES ".
								"('$xx', '$tp_tapelkd', '$d_kd', ".
								"'$nil_fisik2', '$nil2_un', '$nil2_tertulis', '$nil2_prestasi', '$nil2_sertifikat', '$total_nilai', '$nil2_rata', '$today')");
				}


			echo '<td align="right"><strong>'.$total_nilai.'</strong></td>
			<td align="right"><strong>'.$nil2_rata.'</strong></td>
			</tr>';
			}
		while ($data = mysql_fetch_assoc($result));
		}


	echo '</table>
	<table width="100%" border="0" cellspacing="0" cellpadding="3">
	<tr>
	<td align="right">'.$pagelist.' <strong><font color="#FF0000">'.$count.'</font></strong> Data.</td>
	</tr>
	</table>
	</p>';


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