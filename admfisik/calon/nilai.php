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
require("../../inc/cek/psb_admfisik.php");
$tpl = LoadTpl("../../template/index.html");

nocache;

//nilai
$filenya = "nilai.php";
$judul = "Nilai-Nilai";
$judulku = "[$wwc_session : $username3_session] ==> $judul";
$judulx = $judul;
$katcari = nosql($_REQUEST['katcari']);
$kunci = cegah2($_REQUEST['kunci']);
$page = nosql($_REQUEST['page']);
if ((empty($page)) OR ($page == "0"))
	{
	$page = "1";
	}





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

$sqlcount = "SELECT psb_siswa_calon.*, psb_siswa_calon.kd AS sckd, ".
		"psb_siswa_calon.nama AS scnama ".
		"FROM psb_siswa_calon ".
		"WHERE psb_siswa_calon.kd_tapel = '$tp_tapelkd' ".
		"ORDER BY psb_siswa_calon.no_daftar DESC";
$sqlresult = $sqlcount;


//kondisi pencarian
if ($_POST['btnCRI'])
	{
	//cek
	if ((empty($katcari)) OR (empty($kunci)))
		{
		//re-direct
		$pesan = "Input Tidak Lengkap. Harap Diulangi...!!";
		pekem($pesan,$filenya);
		exit();
		}
	else
		{
		//no daftar
		if ($katcari == "cr01")
			{
			$sqlcount = "SELECT psb_siswa_calon.*, psb_siswa_calon.kd AS sckd, ".
					"psb_siswa_calon.nama AS scnama ".
					"FROM psb_siswa_calon ".
					"WHERE psb_siswa_calon.no_daftar LIKE '%$kunci%' ".
					"AND psb_siswa_calon.kd_tapel = '$tp_tapelkd' ".
					"AND psb_siswa_calon.nama <> '' ".
					"ORDER BY psb_siswa_calon.no_daftar DESC";
			$sqlresult = $sqlcount;
			}

		//nama
		else if ($katcari == "cr02")
			{
			$sqlcount = "SELECT psb_siswa_calon.*, psb_siswa_calon.kd AS sckd, ".
					"psb_siswa_calon.nama AS scnama ".
					"FROM psb_siswa_calon ".
					"WHERE psb_siswa_calon.nama LIKE '%$kunci%' ".
					"AND psb_siswa_calon.kd_tapel = '$tp_tapelkd'".
					"AND psb_siswa_calon.nama <> '' ".
					"ORDER BY psb_siswa_calon.no_daftar DESC";
			$sqlresult = $sqlcount;
			}

		//asal sekolah
		else if ($katcari == "cr03")
			{
			$sqlcount = "SELECT psb_siswa_calon.*, psb_siswa_calon.kd AS sckd, ".
					"psb_siswa_calon.nama AS scnama ".
					"FROM psb_siswa_calon ".
					"WHERE psb_siswa_calon.asal_sekolah LIKE '%$kunci%' ".
					"AND psb_siswa_calon.kd_tapel = '$tp_tapelkd'".
					"AND psb_siswa_calon.nama <> '' ".
					"ORDER BY psb_siswa_calon.no_daftar DESC";
			$sqlresult = $sqlcount;
			}
		}
	}
else
	{
	$sqlcount = "SELECT psb_siswa_calon.*, psb_siswa_calon.kd AS sckd, ".
			"psb_siswa_calon.nama AS scnama ".
			"FROM psb_siswa_calon ".
			"WHERE psb_siswa_calon.kd_tapel = '$tp_tapelkd'".
			"AND psb_siswa_calon.nama <> '' ".
			"ORDER BY psb_siswa_calon.no_daftar DESC";
	$sqlresult = $sqlcount;
	}



//jika reset
if ($_POST['btnRST'])
	{
	$sqlcount = "SELECT psb_siswa_calon.*, psb_siswa_calon.kd AS sckd, ".
			"psb_siswa_calon.nama AS scnama ".
			"FROM psb_siswa_calon ".
			"WHERE psb_siswa_calon.kd_tapel = '$tp_tapelkd'".
			"AND psb_siswa_calon.nama <> '' ".
			"ORDER BY psb_siswa_calon.no_daftar DESC";
	$sqlresult = $sqlcount;
	}


$count = mysql_num_rows(mysql_query($sqlcount));
$pages = $p->findPages($count, $limit);
$result = mysql_query("$sqlresult LIMIT ".$start.", ".$limit);
$pagelist = $p->pageList($_GET['page'], $pages, $target);
$data = mysql_fetch_array($result);


//js
require("../../inc/js/swap.js");
require("../../inc/menu/psb_admfisik.php");
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


//jumlah lulus test fisik
$qcc1 = mysql_query("SELECT psb_siswa_calon.*, psb_siswa_calon.kd AS sckd, ".
			"psb_siswa_calon.nama AS scnama ".
			"FROM psb_siswa_calon ".
			"WHERE psb_siswa_calon.kd_tapel = '$tp_tapelkd' ".
			"AND psb_siswa_calon.nama <> '' ".
			"AND psb_siswa_calon.tes_fisik = 'true'");
$rcc1 = mysql_fetch_assoc($qcc1);
$tcc1 = mysql_num_rows($qcc1);




//jumlah tidak lulus tes fisik
$qcc2 = mysql_query("SELECT psb_siswa_calon.*, psb_siswa_calon.kd AS sckd, ".
			"psb_siswa_calon.nama AS scnama ".
			"FROM psb_siswa_calon ".
			"WHERE psb_siswa_calon.kd_tapel = '$tp_tapelkd' ".
			"AND psb_siswa_calon.nama <> '' ".
			"AND psb_siswa_calon.tes_fisik = 'false'");
$rcc2 = mysql_fetch_assoc($qcc2);
$tcc2 = mysql_num_rows($qcc2);


echo '<p>
<font color="red"><strong>Warna Kuning</strong></font> : TIDAK LULUS [<strong>'.$tcc2.'</strong>].
<font color="green"><strong>Warna Orange</strong></font> : LULUS TES FISIK [<strong>'.$tcc1.'</strong>].
<table width="700" border="1" cellspacing="0" cellpadding="3">
<tr align="center" bgcolor="'.$warnaheader.'">
<td width="50"><strong><font color="'.$warnatext.'">No.Daftar</font></strong></td>
<td width="200"><strong><font color="'.$warnatext.'">Nama</font></strong></td>
<td><strong><font color="'.$warnatext.'">Sekolah Asal</font></strong></td>
<td width="75"><strong><font color="'.$warnatext.'">Nilai Tes Fisik</font></strong></td>
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
		$d_noreg = nosql($data['no_daftar']);
		$d_tes_fisik = nosql($data['tes_fisik']);
		$d_nama = balikin($data['scnama']);
		$d_asal_sekolah = balikin($data['asal_sekolah']);





		//jika lulus
		if ($d_tes_fisik == "true")
			{
			$d_tes_fisik2 = "LULUS";
			$warna = "green";
			}
		else if ($d_tes_fisik == "false")
			{
			$d_tes_fisik2 = "Gagal";
			$warna = "red";
			}




		echo "<tr valign=\"top\" bgcolor=\"$warna\" onmouseover=\"this.bgColor='$warnaover';\" onmouseout=\"this.bgColor='$warna';\">";
		echo '<td>'.$d_noreg.'</td>
		<td>'.$d_nama.'</td>

		<td>'.$d_asal_sekolah.'</td>

		<td>
		'.$d_tes_fisik2.'
		<br>
		[<a href="nilai_fisik.php?swkd='.$d_kd.'&noregx='.$d_noreg.'&page='.$page.'" title="Nilai Tes Fisik : ['.$d_noreg.']. '.$d_nama.'"><img src="'.$sumber.'/img/edit.gif" width="16" height="16" border="0"></a>]
		<INPUT type="hidden" name="ckd'.$nomer.'" value="'.$d_kd.'">
		</td>
        	</tr>';
		}
	while ($data = mysql_fetch_assoc($result));
	}


echo '</table>
<table width="700" border="0" cellspacing="0" cellpadding="3">
<tr>
<td>
'.$pagelist.' <strong><font color="#FF0000">'.$count.'</font></strong> Data.
</td>
</tr>
</table>
</p>

</form>
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