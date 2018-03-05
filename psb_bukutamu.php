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
$tpl = LoadTpl("template/index.html");


nocache;

//nilai
$filenya = "psb_bukutamu.php";
$judul = "Buku Tamu";
$judulku = $judul;
$s = nosql($_REQUEST['s']);






//PROSES ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
if ($_POST['btnSMP'])
	{
	//ambil nilai
	$nama = cegah($_POST['nama']);
	$alamat = cegah($_POST['alamat']);
	$kelamin = nosql($_POST['kelamin']);
	$email = cegah($_POST['email']);
	$web = cegah($_POST['web']);
	$komentar = cegah($_POST['komentar']);
	$ip = nosql($_SERVER['REMOTE_ADDR']);


	//cek null
	if ((empty($nama)) OR (empty($alamat)) OR (empty($komentar)))
		{
		//re-direct
		$pesan = "Input Tidak Lengkap. Harap Diulangi...!!";
		pekem($pesan,$filenya);
		exit();
		}
	else
		{
		//entry data
		mysql_query("INSERT INTO psb_buku_tamu(kd, nama, alamat, kelamin, email, web, komentar, ip, postdate) VALUES ".
						"('$x', '$nama', '$alamat', '$kelamin', '$email', '$web', '$komentar', '$ip', '$today')");

		//re-direct
		$pesan = "Terima Kasih Anda Telah Turut Memberikan Saran dan Kritik.";
		pekem($pesan,$filenya);
		exit();
		}
	}
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////








//isi *START
ob_start();

//view //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
echo '<form action="'.$filenya.'" method="post" name="formx">';
echo '<table width="100%" border="0" cellspacing="3" cellpadding="0">
<tr align="left" valign="top">
<td width="25%">';
//ambil data menu
require("inc/menu/psb_menu.php");
echo '</td>

<td align="left">
<big><strong>'.$judul.'</strong></big>
<br>
[<a href="'.$filenya.'?s=baru" title="Tulis Baru">Tulis Baru</a>]
<br>';



//jika tulis
if ($s == "baru")
	{
	echo '<p>
	Harap Diisi Form Berikut Ini dengan Lengkap :
	<br>
	Nama :
	<br>
	<input name="nama" type="text" value="" size="30">
	<br>
	<br>
	
	Alamat :
	<br>
	<input name="alamat" type="text" value="" size="50">
	<br>
	<br>
	
	Kelamin :
	<br>
	<select name="kelamin">
	<option value="" selected></option>
	<option value="L">Laki-Laki</option>
	<option value="P">Perempuan</option>
	</select>
	<br>
	<br>
	
	E-Mail :
	<br>
	<input name="email" type="text" value="" size="30">
	<br>
	<br>
	
	Web :
	<br>
	<input name="web" type="text" value="" size="30">
	<br>
	<br>
	
	Komentar :
	<br>
	<textarea name="komentar" cols="50" rows="5" wrap="virtual"></textarea>
	<br>
	<br>
	
	IP :
	<br>
	<strong>'.$_SERVER['REMOTE_ADDR'].'</strong>
	<br>
	<br>

	<p>
	<input name="btnRST" type="reset" value="BATAL">
	<input name="btnSMP" type="submit" value="SIMPAN">
	</p>';
	}
else
	{
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
	
			$d_nama = balikin($data['nama']);
			$d_alamat = balikin($data['alamat']);
			$d_kelamin = nosql($data['kelamin']);
			$d_email = balikin($data['email']);
			$d_web = balikin($data['web']);
			$d_komentar = balikin($data['komentar']);
			$d_ip = nosql($data['ip']);
			$d_postdate = $data['postdate'];
	
			echo "<tr valign=\"top\" bgcolor=\"$warna\" onmouseover=\"this.bgColor='$warnaover';\" onmouseout=\"this.bgColor='$warna';\">";
			echo '<td>
			<em>'.$d_komentar.'</em>
			<br>
			Nama : <em>'.$d_nama.'</em>,
			Alamat : <em>'.$d_alamat.'</em>,
			Kelamin : <em>'.$d_kelamin.'</em>,
			<br>
			E-Mail : <em>'.$d_email.'</em>,
			Web : <em>'.$d_web.'</em>,
			IP : <em>'.$d_ip.'</em>
			<br>
			Postdate : <em>'.$d_postdate.'</em>
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
		echo '<h3>
		<font color="red"><strong>Belum Ada Yang Mengisi Buku Tamu.</strong></font>
		</h3>';
		}
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