<?php

require '\PHPMailer-master\PHPMailerAutoload.php';

$servername = "192.168.1.155";
$username = "root";
$password = "";
$dbname = "remindme";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$sql = "SELECT objects.plat as oplat, objects.address as oaddress, objects.location as olocation, objects.id as oid, 
items.name as iname, types.name as tname, reminds.deadline as rdead, objects.name as oname 
FROM objects,reminds,items,types where 
objects.id = reminds.object_id and 
reminds.item_id = items.id and 
objects.type_id = types.id and
( objects.state = '1' and reminds.state = '0') and
( reminds.next=CURDATE() or
DATE(reminds.deadline - INTERVAL items.nremind1 DAY) = CURDATE() or 
DATE(reminds.deadline - INTERVAL items.nremind2 DAY) = CURDATE() )";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // output data of each row
    while($row = $result->fetch_assoc()) {
        	
			echo "we  ";
			
			sendMail($row);
		
		
    }
	
} else {
    echo "0 results";
}
$conn->close();


function sendMail($row) {
	
	// ------------ send mail ---------------
				
				$datew=date_create($row["rdead"]);
					
				$sender = "admin@prasetia.co.id";  
					
				$header = "X-Mailer: PHP/".phpversion() . "Return-Path: $sender";
			 
				$mail = new PHPMailer();
			 
				$mail->IsSMTP();
				$mail->Host = "smtp.gmail.com"; 
				$mail->SMTPAuth = true;
				$mail->SMTPSecure = "ssl";
				$mail->Port = 465;
				$mail->SMTPDebug  = 2; // turn it off in production
				$mail->Username   = "admin@prasetia.co.id";  
				$mail->Password   = "PDadmin1"; 
				$mail->From = "admin@prasetia.co.id";
				$mail->FromName = "From Reminder Application";
				$mail->AddAddress("daud.sugari@prasetiadwidharma.co.id");
				//; santi.ariesta@prasetiadwidharma.co.id  ; moylina.tambunan@prasetiadwidharma.co.id  ; yolla.naldi@prasetiadwidharma.co.id  ; vita.nurwari@prasetiadwidharma,co.id ; rika.netika@prasetiadwidharma.co.id ; rahmat.junardi@prasetiadwidharma.co.id ; sekar.yunita@prasetiadwidharma.co.id 
				
				//$mail->AddAddress("ririn.sundari@prasetiadwidharma.co.id");
				//$mail->AddCC("ririnsucis@gmail.com");
				$mail->AddCC("hrga@prasetia.co.id");
				//; shadik.syarif@prasetia.co.id
				$mail->IsHTML(true);
				$mail->CreateHeader($header);
				$mail->Subject = "REMINDER VEHICLE / BUILDING";
				$mail->Body		= "<table width='100%' border='1' cellpadding='0' cellspacing='0'>				
										<tr>
											<th colspan='5'>DETAIL VEHICLE / BUILDING</th>
										</tr>
										<tr>											
											<th>Type</th>											
											<th>Plat Number</th>
											<th>Name</th>
											<th>Location</th>
											<th>Address</th>
										</tr>
										<tr>
											<td>".$row["tname"]."</td>
											<td>".$row["oplat"]."</td>
											<td>".$row["oname"]."</td>
											<td>".$row["olocation"]."</td>
											<td>".$row["oaddress"]."</td>
										</tr>										
									</table>
									<br/>
									<table width='auto'>
										<tr>
											<th colspan='5'>*Mohon untuk segera dilakukan Proses <b><u><font color='blue'>".$row["iname"].
											"</font></u></b> sebelum Deadline <b><u><font color='blue'>".date_format($datew,"d M Y")."</font></u></b>. 
											Agar tidak terjadi hal-hal yang merugikan.</th>
										</tr>
									</table>
									"; 
				$mail->AltBody = nl2br("");
				
				//send the message, check for errors
				$mail->send();
			//----------end send mail---------------------
}


?>
