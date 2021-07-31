<?php

include("ILib.php");
$cmd = base64_decode($_GET['cmd']);

switch ($cmd)
{
	case 'GetLicense':
		echo base64_encode(Get('App/Data', 'App', 'LIC'));
		break;

	case 'GetRun':
		echo base64_encode(Get('App/Data', 'App', 'RUN'));
		break;

	case 'PutLicense':
		Write('App/Data', 'App', 'LIC', Get('App/Data', 'App', 'LIC') + 1);
		echo base64_encode(Get('App/Data', 'App', 'LIC'));
		break;

	case 'PutRun':
		Write('App/Data', 'App', 'RUN', Get('App/Data', 'App', 'RUN') + 1);
		echo base64_encode(Get('App/Data', 'App', 'RUN'));
		break;
}

?>