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
$filenya = "daftar.php";
$judul = "Data Pendaftar";
$judulku = "[$adm_session] ==> $judul";
$judulx = $judul;
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

$sqlcount = "SELECT DISTINCT (psb_siswa_calon.kd) AS sckd ".
			"FROM psb_siswa_calon ".
			"WHERE  psb_siswa_calon.kd_tapel = '$tp_tapelkd' ".
			"AND psb_siswa_calon.asal_sekolah <> '' ".
			"AND psb_siswa_calon.alamat <> '' ".
			"AND psb_siswa_calon.nama <> '' ".
			"ORDER BY psb_siswa_calon.no_daftar DESC";
$sqlresult = $sqlcount;

$count = mysql_num_rows(mysql_query($sqlcount));
$pages = $p->findPages($count, $limit);
$result = mysql_query("$sqlresult LIMIT ".$start.", ".$limit);
$pagelist = $p->pageList($_GET['page'], $pages, $target);
$data = mysql_fetch_array($result);


//js
require("../../inc/js/swap.js");
require("../../inc/menu/psb_adm.php");
xheadline($judul);

//view //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
echo '<form action="'.$filenya.'" method="post" name="formx">
<table width="100%" border="1" cellspacing="0" cellpadding="3">
<tr align="center" bgcolor="'.$warnaheader.'">
<td width="1">&nbsp;</td>
<td width="100"><strong><font color="'.$warnatext.'">No.Daftar/Username</font></strong></td>
<td><strong><font color="'.$warnatext.'">Nama</font></strong></td>
<td><strong><font color="'.$warnatext.'">Sekolah Asal</font></strong></td>
<td width="150"><strong><font color="'.$warnatext.'">Waktu Pendaftaran</font></strong></td>
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
		$kd = nosql($data['sckd']);



		//detail e
		$qdt = mysql_query("SELECT DATE_FORMAT(tgl_lahir, '%d') AS ltgl, ".
					"DATE_FORMAT(tgl_lahir, '%m') AS lbln, ".
					"DATE_FORMAT(tgl_lahir, '%Y') AS lthn, ".
					"psb_siswa_calon.* ".
					"FROM psb_siswa_calon ".
					"WHERE kd = '$kd'");
		$rdt = mysql_fetch_assoc($qdt);
		$d_noreg = nosql($rdt['no_daftar']);
		$d_username = nosql($rdt['usernamex']);
		$d_nama = balikin($rdt['nama']);
		$d_asal_sekolah = balikin($rdt['asal_sekolah']);
		$d_tgl_daftar = $rdt['tgl_daftar'];



		echo "<tr valign=\"top\" bgcolor=\"$warna\" onmouseover=\"this.bgColor='$warnaover';\" onmouseout=\"this.bgColor='$warna';\">";
		echo '<td>
		<a href="daftar_prt.php?swkd='.$kd.'&noregx='.$d_noreg.'&page='.$page.'" title="Print...">
		<img src="'.$sumber.'/img/print.gif" width="16" height="16" border="0">
		</a>
		</td>
		<td>'.$d_noreg.'</td>
		<td>'.$d_nama.'</td>
		<td>'.$d_asal_sekolah.'</td>
		<td>'.$d_tgl_daftar.'</td>
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
