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
require("../inc/config.php");
require("../inc/fungsi.php");
require("../inc/koneksi.php");
require("../inc/class/paging.php");
require("../inc/cek/psb_adm.php");
$tpl = LoadTpl("../template/index.html");


nocache;

//nilai
$filenya = "buku_tamu.php";
$judul = "Buku Tamu";
$judulku = "$judul  [$adm_session]";
$s = nosql($_REQUEST['s']);
$btkd = nosql($_REQUEST['btkd']);



//PROSES ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//jika hapus
if ($s == "hapus")
	{
	//entri history ////////////////////////////////////////////////////////////////////////////////////////////////
	//ketahui tapel aktif
	$qtp = mysql_query("SELECT * FROM psb_m_tapel ".
				"WHERE status = 'true'");
	$rtp = mysql_fetch_assoc($qtp);
	$tp_tapelkd = nosql($rtp['kd']);
	$tp_tahun1 = nosql($rtp['tahun1']);
	$tp_tahun2 = nosql($rtp['tahun2']);


	$ketnya = "$judulku [HAPUS DATA]";
	mysql_query("INSERT INTO psb_login_log(kd, kd_tapel, kd_login, url_inputan, postdate) VALUES ".
			"('$x', '$tp_tapelkd', '$kd1_session', '$ketnya', '$today')");
	//entri history ////////////////////////////////////////////////////////////////////////////////////////////////



	//query
	mysql_query("DELETE FROM psb_buku_tamu ".
					"WHERE kd = '$btkd'");

	//re-direct
	xloc($filenya);
	exit();
	}
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////





//isi *START
ob_start();

//menu
require("../inc/menu/psb_adm.php");
xheadline($judul);

//view //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
echo '<form action="'.$filenya.'" method="post" name="formx">';

//query
$p = new Pager();
$start = $p->findStart($limit);

$sqlcount = "SELECT * FROM psb_buku_tamu ".
				"ORDER BY postdate DESC";
$sqlresult = $sqlcount;

$count = mysql_num_rows(mysql_query($sqlcount));
$pages = $p->findPages($count, $limit);
$result = mysql_query("$sqlresult LIMIT ".$start.", ".$limit);
$pagelist = $p->pageList($_GET['page'], $pages, $target);
$data = mysql_fetch_array($result);


if ($count != 0)
	{
	echo '<table width="100%" border="0" cellspacing="0" cellpadding="3">';

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

		$d_kd = nosql($data['kd']);
		$d_nama = balikin2($data['nama']);
		$d_alamat = balikin2($data['alamat']);
		$d_kelamin = nosql($data['kelamin']);
		$d_email = balikin2($data['email']);
		$d_web = balikin2($data['web']);
		$d_komentar = balikin2($data['komentar']);
		$d_ip = nosql($data['ip']);
		$d_postdate = $data['postdate'];


		echo "<tr valign=\"top\" bgcolor=\"$warna\" onmouseover=\"this.bgColor='$warnaover';\" onmouseout=\"this.bgColor='$warna';\">";
		echo '<td>
		<em>'.$d_komentar.'</em>
		<br>
		Nama : <strong>'.$d_nama.'</strong>,
		Alamat : <strong>'.$d_alamat.'</strong>,
		Kelamin : <strong>'.$d_kelamin.'</strong>,
		<br>
		E-Mail : <strong>'.$d_email.'</strong>,
		Web : <strong>'.$d_web.'</strong>,
		IP : <strong>'.$d_ip.'</strong>
		<br>
		Postdate : <strong>'.$d_postdate.'</strong>
		<br>
		[<a href="buku_tamu.php?s=hapus&btkd='.$d_kd.'">HAPUS</a>]
		</td>
        </tr>';
		}
	while ($data = mysql_fetch_assoc($result));

	echo '</table>
	<table width="100%" border="0" cellspacing="0" cellpadding="3">
	<tr>
	<td align="right">'.$pagelist.' <strong><font color="#FF0000">'.$count.'</font></strong> Komentar.</td>
	</tr>
	</table>';
	}
else
	{
	echo '<font color="red"><strong>Tidak Ada Yang Menulis Buku Tamu.</strong></font>';
	}



echo '</form>
<br>
<br>
<br>';
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

//isi
$isi = ob_get_contents();
ob_end_clean();

require("../inc/niltpl.php");


//diskonek
xclose($koneksi);
exit();
?>