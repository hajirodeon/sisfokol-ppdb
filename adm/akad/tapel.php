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
require("../../inc/cek/psb_adm.php");
$tpl = LoadTpl("../../template/index.html");

nocache;

//nilai
$filenya = "tapel.php";
$diload = "document.formx.tahun1.focus();";
$judul = "Data Tahun Pelajaran";
$judulku = "[$adm_session] ==> $judul";
$judulx = $judul;
$s = nosql($_REQUEST['s']);




//PROSES ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//jika batal
if ($_POST['btnBTL'])
	{
	//diskonek
	xfree($qbw);
	xclose($koneksi);

	//re-direct
	xloc($filenya);
	exit();
	}



//jika edit
if ($s == "edit")
	{
	//nilai
	$kdx = nosql($_REQUEST['kd']);

	//query
	$qx = mysql_query("SELECT * FROM psb_m_tapel ".
				"WHERE kd = '$kdx'");
	$rowx = mysql_fetch_assoc($qx);
	$e_tahun1 = nosql($rowx['tahun1']);
	$e_tahun2 = nosql($rowx['tahun2']);
	$e_status = nosql($rowx['status']);
	$e_biaya = nosql($rowx['biaya']);
	$e_dayatampung = nosql($rowx['dayatampung']);

	//jika aktif
	if ($e_status == "true")
		{
		$e_status_ket = "AKTIF";
		}
	else if ($e_status == "false")
		{
		$e_status_ket = "Tidak Aktif";
		}
	}



//jika simpan
if ($_POST['btnSMP'])
	{
	//nilai
	$kd = nosql($_POST['kd']);
	$tahun1 = nosql($_POST['tahun1']);
	$tahun2 = nosql($_POST['tahun2']);
	$status = nosql($_POST['status']);
	$biaya = nosql($_POST['biaya']);
	$dayatampung = nosql($_POST['dayatampung']);


	//nek null
	if ((empty($tahun1)) OR (empty($tahun2)) OR (empty($biaya)) OR (empty($dayatampung)))
		{
		//diskonek
		xfree($qbw);
		xclose($koneksi);

		//re-direct
		$pesan = "Input Tidak Lengkap. Harap Diulangi...!!";
		pekem($pesan,$filenya);
		exit();
		}
	else
		{
		//jika baru
		if (empty($s))
			{
			//cek
			$qcc = mysql_query("SELECT * FROM psb_m_tapel ".
									"WHERE tahun1 = '$tahun1' ".
									"AND tahun2 = '$tahun2'");
			$rcc = mysql_fetch_assoc($qcc);
			$tcc = mysql_num_rows($qcc);

			//nek ada
			if ($tcc != 0)
				{
				//diskonek
				xfree($qbw);
				xclose($koneksi);

				//re-direct
				$pesan = "Tahun Pelajaran : $tahun1/$tahun2, Sudah Ada. Silahkan Ganti Yang Lain...!!";
				pekem($pesan,$filenya);
				exit();
				}
			else
				{
				if ($status == "true")
					{
					//hapus field dahulu
					 mysql_query("ALTER TABLE `bikin_nomer` DROP `noid`");
					
					
					//netralkan dulu
					mysql_query("UPDATE psb_m_tapel SET status = 'false'");
					
					
					//kasi field baru
					mysql_query("ALTER TABLE `bikin_nomer` ADD `noid` INT(50) NOT NULL AUTO_INCREMENT FIRST,
									ADD PRIMARY KEY (`noid`),
									ADD UNIQUE (`noid`)");
					}

					
				//query
				mysql_query("INSERT INTO psb_m_tapel(kd, tahun1, tahun2, status, biaya, dayatampung, postdate) VALUES ".
								"('$x', '$tahun1', '$tahun2', '$status', '$biaya', '$dayatampung', '$today')");

				//diskonek
				xfree($qbw);
				xclose($koneksi);

				//re-direct
				xloc($filenya);
				exit();
				}
			}

		//jika update
		else if ($s == "edit")
			{
			if ($status == "true")
				{
				//hapus field dahulu
				 mysql_query("ALTER TABLE `bikin_nomer` DROP `noid`");
				
				
				//netralkan dulu
				mysql_query("UPDATE psb_m_tapel SET status = 'false'");
				
				
				//kasi field baru
				mysql_query("ALTER TABLE `bikin_nomer` ADD `noid` INT(50) NOT NULL AUTO_INCREMENT FIRST,
								ADD PRIMARY KEY (`noid`),
								ADD UNIQUE (`noid`)");
				}

			//query
			mysql_query("UPDATE psb_m_tapel SET tahun1 = '$tahun1', ".
							"tahun2 = '$tahun2', ".
							"status = '$status', ".
							"dayatampung = '$dayatampung', ".
							"biaya = '$biaya' ".
							"WHERE kd = '$kd'");

			//diskonek
			xfree($qbw);
			xclose($koneksi);

			//re-direct
			xloc($filenya);
			exit();
			}
		}
	}


//jika hapus
if ($_POST['btnHPS'])
	{
	//ambil nilai
	$jml = nosql($_POST['jml']);

	//ambil semua
	for ($i=1; $i<=$jml;$i++)
		{
		//ambil nilai
		$yuk = "item";
		$yuhu = "$yuk$i";
		$kd = nosql($_POST["$yuhu"]);

		//del
		mysql_query("DELETE FROM psb_m_tapel ".
						"WHERE kd = '$kd'");
		}

	//diskonek
	xfree($qbw);
	xclose($koneksi);

	//re-direct
	xloc($filenya);
	exit();
	}
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


//isi *START
ob_start();

//query
$q = mysql_query("SELECT * FROM psb_m_tapel ".
					"ORDER BY tahun1 ASC");
$row = mysql_fetch_assoc($q);
$total = mysql_num_rows($q);

//js
require("../../inc/js/checkall.js");
require("../../inc/js/swap.js");
require("../../inc/js/number.js");
require("../../inc/menu/psb_adm.php");
xheadline($judul);

//view //////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
echo '<form action="'.$filenya.'" method="post" name="formx">
<p>
Tahun Akademik :
<br>
<input name="tahun1" type="text" value="'.$e_tahun1.'" size="4" maxlength="4" onKeyPress="return numbersonly(this, event)"> /
<input name="tahun2" type="text" value="'.$e_tahun2.'" size="4" maxlength="4" onKeyPress="return numbersonly(this, event)">
</p>

<p>
Status :
<br>
<select name="status">
<option value="'.$e_status.'" selected>-'.$e_status_ket.'-</option>
<option value="true" selected>Aktif</option>
<option value="false" selected>Tidak Aktif</option>
</select>
</p>

<p>
Biaya Pendaftaran PPDB :
<br>
Rp.<input name="biaya" type="text" value="'.$e_biaya.'" size="10" onKeyPress="return numbersonly(this, event)">,00
</p>

<p>
Daya Tampung :
<br>
<input name="dayatampung" type="text" value="'.$e_dayatampung.'" size="5" onKeyPress="return numbersonly(this, event)"> Calon Siswa.
</p>

<p>
<input name="btnSMP" type="submit" value="SIMPAN">
<input name="btnBTL" type="submit" value="BATAL">
</p>';

if ($total != 0)
	{
	echo '<table width="600" border="1" cellspacing="0" cellpadding="3">
	<tr bgcolor="'.$warnaheader.'">
	<td width="1">&nbsp;</td>
	<td width="1">&nbsp;</td>
	<td><strong><font color="'.$warnatext.'">Tahun Pelajaran</font></strong></td>
	<td width="150"><strong><font color="'.$warnatext.'">Biaya PSB</font></strong></td>
	<td width="150"><strong><font color="'.$warnatext.'">Daya Tampung</font></strong></td>
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

		$nomer = $nomer + 1;
		$i_kd = nosql($row['kd']);
		$i_tahun1 = nosql($row['tahun1']);
		$i_tahun2 = nosql($row['tahun2']);
		$i_status = nosql($row['status']);
		$i_biaya = nosql($row['biaya']);
		$i_dayatampung = nosql($row['dayatampung']);



		//jika aktif
		if ($i_status == "true")
			{
			$i_status_ket = "[<font color='red'><strong>AKTIF</strong></font>].";
			}
		else if ($i_status == "false")
			{
			$i_status_ket = "";
			}


		echo "<tr valign=\"top\" bgcolor=\"$warna\" onmouseover=\"this.bgColor='$warnaover';\" onmouseout=\"this.bgColor='$warna';\">";
		echo '<td>
		<input type="checkbox" name="item'.$nomer.'" value="'.$i_kd.'">
        	</td>
		<td>
		<a href="'.$filenya.'?s=edit&kd='.$i_kd.'">
		<img src="'.$sumber.'/img/edit.gif" width="16" height="16" border="0">
		</a>
		</td>
		<td>
		'.$i_tahun1.'/'.$i_tahun2.' '.$i_status_ket.'
		</td>
		<td>
		'.xduit2($i_biaya).'
		</td>
		<td>
		'.$i_dayatampung.'
		</td>
	    </tr>';
		}
	while ($row = mysql_fetch_assoc($q));

	echo '</table>
	<table width="400" border="0" cellspacing="0" cellpadding="3">
	<tr>
	<td>
	<input name="jml" type="hidden" value="'.$total.'">
	<input name="s" type="hidden" value="'.$s.'">
	<input name="kd" type="hidden" value="'.$kdx.'">
	<input name="btnALL" type="button" value="SEMUA" onClick="checkAll('.$total.')">
	<input name="btnBTL" type="reset" value="BATAL">
	<input name="btnHPS" type="submit" value="HAPUS">
	</td>
	</tr>
	</table>';
	}
else
	{
	echo '<p>
	<font color="red">
	<strong>TIDAK ADA DATA. Silahkan Entry Dahulu...!!</strong>
	</font>
	</p>';
	}

echo '</form>';
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


//isi
$isi = ob_get_contents();
ob_end_clean();

require("../../inc/niltpl.php");


//diskonek
xfree($qbw);
xclose($koneksi);
exit();
?>