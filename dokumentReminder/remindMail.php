<?php 
	require 'DocumentRemind.php';

	$connection_string = "host=192.168.0.137 dbname=Internal user=openpg password=openpgpwd";
	$connection = pg_connect($connection_string);

	$query = '
		SELECT
		"public".x_view_age_document_legal.x_tahun_terbit,
		"public".x_view_age_document_legal.x_remark,
		"public".x_view_age_document_legal.x_name,
		"public".x_view_age_document_legal.x_nomor_surat,
		"public".x_view_age_document_legal.x_tanggal_terbit,
		"public".x_view_age_document_legal.x_tanggal_expire,
		"public".x_view_age_document_legal.x_legal_name,
		"public".x_view_age_document_legal.x_company_name,
		"public".x_view_age_document_legal.age
		FROM
		"public".x_view_age_document_legal
	';

	// WHERE
	// "public".x_view_age_document_legal.age = 60
	
	$result = pg_exec($connection, $query);

	$numrows = pg_num_rows($result);

	if($numrows > 0):
		$body = "<table width='100%' border='1' cellpadding='0' cellspacing='0'>
				<tr>
					<th colspan='7'>Notifikasi Masa Berlaku Legal</th>
				</tr>	
				<tr>											
					<th>Company</th>											
					<th>Jenis Legal</th>
					<th>Nama</th>
					<th>Nomor Surat</th>
					<th>Keterangan</th>
					<th>Tanggal Expired</th>
					<th>Sisa Masa Berlaku (hari)</th>
				</tr>";
		foreach (pg_fetch_all($result) as $data) {
			$body .= "
				<tr>
					<td>".$data['x_company_name']."</td>
					<td>".$data['x_legal_name']."</td>
					<td>".$data['x_name']."</td>
					<td>".$data['x_nomor_surat']."</td>
					<td>".$data['x_remark']."</td>
					<td>".$data['x_tanggal_expire']."</td>
					<td>".$data['age']."</td>
				</tr>
			"; 
		}
		$body .= "</table>";
		$sendMail = new SentMail();
		$sendMail->setMessage($body);
		$sendMail->sendEmail();
	endif;
 ?>