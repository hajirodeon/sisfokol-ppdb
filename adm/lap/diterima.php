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
$filenya = "diterima.php";
$judul = "Calon Yang Diterima";
$judulku = "[$adm_session] ==> $judul";
$judulx = $judul;
$page = nosql($_REQUEST['page']);
if ((empty($page)) OR ($page == "0"))
	{
	$page = "1";
	}



//isi *START
ob_start();




//ketahui tapel aktif
$qtp = mysql_query("SELECT * FROM psb_m_tapel ".
			"WHERE status = 'true'");
$rtp = mysql_fetch_assoc($qtp);
$tp_tapelkd = nosql($rtp['kd']);
$tp_tahun1 = nosql($rtp['tahun1']);
$tp_tahun2 = nosql($rtp['tahun2']);
$tp_dayatampung = nosql($rtp['dayatampung']);






//netralkan dulu
mysql_query("UPDATE psb_siswa_calon SET status_diterima = 'false' ".
				"WHERE kd_tapel = '$tp_tapelkd'");





//pemberian nomor urut rangking
$qpnu = mysql_query("SELECT * FROM psb_siswa_calon_rangking ".
						"WHERE kd_tapel = '$tp_tapelkd' ".
						"ORDER BY round(rata) DESC");
$rpnu = mysql_fetch_assoc($qpnu);
$tpnu = mysql_num_rows($qpnu);

do
	{
	//nilai
	$nomex= $nomex + 1;
	$pnu_kd = nosql($rpnu['kd']);
	$pnu_sckd = nosql($rpnu['kd_siswa_calon']);

	//update
	mysql_query("UPDATE psb_siswa_calon_rangking SET no = '$nomex' ".
			"WHERE kd = '$pnu_kd'");
	}
while ($rpnu = mysql_fetch_assoc($qpnu));




//js
require("../../inc/js/jumpmenu.js");
require("../../inc/js/swap.js");
require("../../inc/menu/psb_adm.php");
xheadline($judul);

//view //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
echo '<form action="'.$filenya.'" method="post" name="formx">';

//query data
$p = new Pager();
$start = $p->findStart($limit);

$sqlcount = "SELECT psb_siswa_calon.*, psb_siswa_calon.kd AS sckd, ".
				"psb_siswa_calon.nama AS scnama, psb_siswa_calon_rangking.* ".
				"FROM psb_siswa_calon, psb_siswa_calon_rangking ".
				"WHERE psb_siswa_calon.kd = psb_siswa_calon_rangking.kd_siswa_calon ".
				"AND psb_siswa_calon.kd_tapel = '$tp_tapelkd' ".
	//			"AND psb_siswa_calon.status_diterima = 'true' ".
				"AND psb_siswa_calon.tes_fisik = 'true' ".
				"AND psb_siswa_calon_rangking.nil_tertulis > '0' ".
				"AND psb_siswa_calon_rangking.nil_un > '0' ".
				"ORDER BY round(psb_siswa_calon_rangking.rata) DESC";
$sqlresult = $sqlcount;

$count = mysql_num_rows(mysql_query($sqlcount));
$pages = $p->findPages($count, $limit);
$limit = $tp_dayatampung; //jml. data page maksimal sesuai dengan daya tampung yang ada
$result = mysql_query("$sqlresult LIMIT ".$start.", ".$limit);
$pagelist = $p->pageList($_GET['page'], $pages, $target);
$data = mysql_fetch_array($result);

if ($count != 0)
	{
	echo '[Daya Tampung : <strong>'.$tp_dayatampung.'</strong>].

	<table width="900" border="1" cellspacing="0" cellpadding="3">
	<tr align="center" bgcolor="'.$warnaheader.'">
	<td width="1"><strong><font color="'.$warnatext.'">No.</font></strong></td>
	<td width="50"><strong><font color="'.$warnatext.'">No.Daftar</font></strong></td>
	<td><strong><font color="'.$warnatext.'">Nama</font></strong></td>
	<td width="75"><strong><font color="'.$warnatext.'">Nilai UN</font></strong></td>
	<td width="75"><strong><font color="'.$warnatext.'">Nilai Tertulis</font></strong></td>
	<td width="75"><strong><font color="'.$warnatext.'">Nilai Prestasi</font></strong></td>
	<td width="75"><strong><font color="'.$warnatext.'">Nilai Sertifikat</font></strong></td>
	<td width="50"><strong><font color="'.$warnatext.'">Total</font></strong></td>
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
		$d_nil_sertifikat = nosql($data['nil_sertifikat']);
		$d_nil_prestasi = nosql($data['nil_prestasi']);
		$d_total = nosql($data['total']);
		$d_rata = nosql($data['rata']);



		//set diterima //////////////////////////////////////////////////////////////////////////////////////////////////////////////
		//netralkan dulu
		mysql_query("UPDATE psb_siswa_calon SET status_diterima = 'false' ".
				"WHERE kd = '$d_kd'");

		//diterima
		mysql_query("UPDATE psb_siswa_calon SET status_diterima = 'true' ".
				"WHERE kd = '$d_kd'");
		/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////




		echo "<tr valign=\"top\" bgcolor=\"$warna\" onmouseover=\"this.bgColor='$warnaover';\" onmouseout=\"this.bgColor='$warna';\">";
		echo '<td>'.$d_no.'.</td>
		<td>'.$d_noreg.'</td>

		<td>'.$d_nama.'</td>

		<td>'.$d_nil_un.'</td>

		<td>'.$d_nil_tertulis.'</td>

		<td>'.$d_nil_prestasi.'</td>
		
		<td>'.$d_nil_sertifikat.'</td>

		<td>'.$d_rata.'</td>
		</tr>';
		}
	while ($data = mysql_fetch_assoc($result));

	echo '</table>
	<table width="900" border="0" cellspacing="0" cellpadding="3">
	<tr>
	<td align="right">
	[<a href="diterima_prt.php" title="Print Laporan Calon Yang Diterima"><img src="'.$sumber.'/img/print.gif" width="16" height="16" border="0"></a>]
	'.$pagelist.' <strong><font color="#FF0000">'.$count.'</font></strong> Data.</td>
	</tr>
	</table>';
	}
else
	{
	echo '<p>
	<font color="red"><strong>TIDAK ADA DATA CALON YANG DITERIMA</strong></font>
	</p>';
	}



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
