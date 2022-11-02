<?php 
/**
 * Aplikasi Insentif
 * 
 * 
 * 
 * @author B.E.
 */
if (!isset($_GET['pg'])) {
	include 'dashboard.php';
} else {
	switch ($_GET['pg']) {
		case 'dashboard':
			include 'dashboard.php';
			break;
    	case 'admin':
			include 'admin.php';
			break;
		case 'persediaan':
			include 'persediaan.php';
			break;
		case 'beli':
			include 'beli.php';
			break;
		case 'setor':
			include 'setor.php';
			break;

		case 'brgmasuk':
			include 'brgmasuk.php';
			break;

		case 'anggota':
			include 'anggota.php';
			break;

		case 'undian':
			include 'undian.php';
			break;

		case 'cetak':
			include 'cetak_pdf.php';
			break;
			
		default:	        
	    	echo "<label>404 Halaman tidak ditemukan</label>";
	    break;
		
	}
}

?>