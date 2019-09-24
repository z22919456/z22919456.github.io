
<?php

/*
DONT FORGET TO DELETE THIS SCRIPT WHEN FINISHED!
*/

ini_set( 'display_errors', 1 );
error_reporting( E_ALL );

$from = 'testEmail@mail.dacpump.com.tw';

/*
ini_set( 'SMTP', 'smtp.example.com' );
ini_set( 'SMTP_PORT', 25 );
ini_set( 'sendmail_from', $from );
*/

$server = array( 
	'HTTP_HOST', 'SERVER_NAME', 'SERVER_ADDR', 'SERVER_PORT',
	'SERVER_ADMIN', 'SERVER_SIGNATURE', 'SERVER_SOFTWARE', 
	'REMOTE_ADDR', 'DOCUMENT_ROOT', 'REQUEST_URI', 
	'SCRIPT_NAME', 'SCRIPT_FILENAME',
);

$to    		= ( isset( $_POST['email'] ) ? $_POST['email'] : FALSE );
$fname		= ( isset( $_POST['fname'] ) ? $_POST['fname'] : "" );
$lname		= ( isset( $_POST['lname'] ) ? $_POST['lname'] : "" );
$email		= ( isset( $_POST['email'] ) ? $_POST['email'] : "" );
$company	= ( isset( $_POST['company'] ) ? $_POST['company'] : "" );
$country	= ( isset( $_POST['country'] ) ? $_POST['country'] : "" );
$phone	= ( isset( $_POST['phone'] ) ? $_POST['phone'] : "" );
$message 	= ( isset( $_POST['message'] ) ? $_POST['message'] : "" );
$subject    = $fname . " " . $lname . " send you a message form your webside.";
if ( ! $to )
{
	header("Location: ../../../GT-Contact_failt.html");
	exit;
};

// foreach ( $server as $s )
// {
// 	$message .= sprintf( '%s: %s', $s, $_SERVER[$s] ) . PHP_EOL;
// };

$message = 	"姓名：" . $fname . $lname . "\n" .
			"E-mail：" . $email . "\n" .
			"手機：" . $phone . "\n" .
			"公司：" . $company . "\n" .
			"國家：" . $country . "\n" .
			"訊息：" . $message . "\n" .


$headers = "\n----------------------------\n"
	 . 'From: ' . $from . PHP_EOL 
	 . 'Reply-To: ' . $from . PHP_EOL 
	 . 'X-Mailer: PHP/' . phpversion(); 

$success = mail( $to, $subject, $message, $headers );


if ( isset( $success ) )
{	
	header("Location: ../../../GT-Contact_ok.html");
	echo 'E-mail sent to: ' . $to;
	echo '<br />';
	echo 'Successful mail?: <strong ' . ( $success ? 'style="color:green;">YES' : 'style="color:red;">NO' ) . '</strong>';
}
else
{
	header("Location: ../../../GT-Contact_failt.html");
	echo '<br />';
	echo 'E-mail set as: '.$to;
};

echo '<hr />';	
echo '<style>	* { font-family: Helvetica, Arial, sans-serif;  } th { text-align: left; } td { padding: 3px 5px; }	</style>';
echo '<table>';	

foreach ( $server as $s )
{
	echo '<tr><th>$_SERVER[\'' . $s . '\']</th><td>' . $_SERVER[$s] . '</td></tr>';
};

echo '</table>';

if ( isset( $success ) )
{
	echo '<!--'; 
	var_dump( $success );		
	echo '-->';
};
?>