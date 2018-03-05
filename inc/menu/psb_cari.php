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

//PROSES ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//cari
if ($_POST['btnCRI'])
	{
	//ambil nilai
	$katkunci = nosql($_POST['katkunci']);
	$kunci = cegah2($_POST['kunci']);

	//cek empty
	if ((empty($katkunci)) OR (empty($kunci)))
		{
		//re-direct
		$pesan = "Input Tidak Lengkap. Harap Diulangi...!!";
		pekem($pesan,$filenya);
		exit();
		}
	else
		{
		//re-direct
		$ke = "psb_cari.php?katkunci=$katkunci&kunci=$kunci";
		xloc($ke);
		exit();
		}
	}




//reset
if ($_POST['btnRST'])
	{
	//re-direct
	xloc($filenya);
	exit();
	}
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


//cari
echo '<TABLE WIDTH="100%" bgcolor="'.$warna02.'" BORDER="0" CELLPADDING="0" CELLSPACING="3">
<TR>
<TD align="right">
Pendaftaran : ';

//pencarian
echo '<select name="katkunci">
<option value="" selected></option>
<option value="cn01">Nama</option>
<option value="cn02">Alamat</option>
<option value="cn03">Asal Sekolah</option>
</select>

<input name="kunci" type="text" value="" size="25">
<input name="btnCRI" type="submit" value="CARI">
<input name="btnRST" type="submit" value="RESET">';


echo '</TD>
</TR>
</TABLE>';
?>