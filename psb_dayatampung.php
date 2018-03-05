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
$tpl = LoadTpl("template/index.html");


nocache;

//nilai
$filenya = "psb_dayatampung.php";
$judul = "Daya Tampung";
$judulku = $judul;




//ketahui tapel aktif
$qtp = mysql_query("SELECT * FROM psb_m_tapel ".
						"WHERE status = 'true'");
$rtp = mysql_fetch_assoc($qtp);
$tp_tapelkd = nosql($rtp['kd']);
$tp_tahun1 = nosql($rtp['tahun1']);
$tp_tahun2 = nosql($rtp['tahun2']);
$tp_dayatampung = nosql($rtp['dayatampung']);





//isi *START
ob_start();

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
<br>';




echo '<table border="1" cellspacing="0" cellpadding="3">
<tr bgcolor="'.$warnaheader.'">
<td width="100"><strong><font color="'.$warnatext.'">Tahun Pelajaran</font></strong></td>
<td width="50"><strong><font color="'.$warnatext.'">Daya Tampung</font></strong></td>
</tr>';


echo "<tr valign=\"top\" bgcolor=\"$warna\" onmouseover=\"this.bgColor='$warnaover';\" onmouseout=\"this.bgColor='$warna';\">";
echo '<td>
'.$tp_tahun1.'/'.$tp_tahun2.'
</td>
<td>
'.$tp_dayatampung.'
</td>
</tr>';

echo '</table>

</td>
</tr>
</table>


</form>';
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

//isi
$isi = ob_get_contents();
ob_end_clean();

require("inc/niltpl.php");



//diskonek
xclose($koneksi);
exit();
?>