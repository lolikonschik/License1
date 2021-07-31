<?php

function Write($NAME, $SECTION, $OPTION, $VALUE)
{
	$FileName = $NAME . ".ini";
	$File = fopen($FileName,"a+");
	$Text = fread($File, Filesize($FileName));
	if (preg_match("/(\[$SECTION\][^\[]*)/", $Text, $M) and strpos($M1 = $M[1], "\n$OPTION = ") > -1)
	{
			$M2 = preg_replace("/$OPTION = [^\r\n]*/", "$OPTION = $VALUE", $M1);
			$Text = str_replace($M1, $M2, $Text);
	}
	elseif (strpos($Text, "[$SECTION]") > -1) 	$Text = preg_replace("/(\[$SECTION\][^\[]*)(.*)/", "$1\r\n$OPTION = $VALUE\r\n$2", $Text);
	else 					$Text = $Text . "[" . $SECTION . "]\r\n" . $OPTION . " = " . $VALUE . "\r\n";
	
	@ftruncate($File, 0);
	fwrite($File, preg_replace("/(^[\r\n]*|[\r\n]+)[\s\t]*[\r\n]+/", "\n", $Text));
	fclose($File);
}

function Get($FileName, $SECTION, $OPTION)
{
	$ini = parse_ini_File($FileName.".ini", true);
	return str_replace('"', '', json_encode($ini[$SECTION][$OPTION]));
}

function Delete($FileName)
{
	if(file_exists($FileName))  unlink($FileName . '.ini');
}

?>