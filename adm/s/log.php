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
$filenya = "log.php";
$judul = "Log History Input";
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

$sqlcount = "SELECT psb_login_log.kd_login AS pkd, ".
		"psb_login_log.url_inputan AS iput, ".
		"psb_login_log.postdate AS pdate ".
		"FROM psb_login_log ".
		"WHERE kd_tapel = '$tp_tapelkd' ".
		"ORDER BY postdate DESC";
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

<table width="800" border="1" cellspacing="0" cellpadding="3">
<tr align="center" bgcolor="'.$warnaheader.'">
<td width="150"><strong><font color="'.$warnatext.'">Postdate</font></strong></td>
<td width="200"><strong><font color="'.$warnatext.'">Nama</font></strong></td>
<td><strong><font color="'.$warnatext.'">Log History</font></strong></td>
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
		$d_kd = nosql($data['pkd']);
		$d_iput = balikin($data['iput']);
		$d_pdate = $data['pdate'];



		//detail e
		$qdt = mysql_query("SELECT * FROM psb_m_login ".
					"WHERE kd = '$d_kd'");
		$rdt = mysql_fetch_assoc($qdt);
		$dt_username = balikin($rdt['username']);
		$dt_nama = balikin($rdt['nama']);


		echo "<tr valign=\"top\" bgcolor=\"$warna\" onmouseover=\"this.bgColor='$warnaover';\" onmouseout=\"this.bgColor='$warna';\">";
		echo '<td>'.$d_pdate.'</td>
		<td>['.$dt_nama.' : '.$dt_username.'].</td>
		<td>'.$d_iput.'</td>
        	</tr>';
		}
	while ($data = mysql_fetch_assoc($result));
	}


echo '</table>
<table width="100%" border="0" cellspacing="0" cellpadding="3">
<tr>
<td>'.$pagelist.' <strong><font color="#FF0000">'.$count.'</font></strong> Data.</td>
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