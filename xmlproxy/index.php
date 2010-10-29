<?php
/*
Copyright (C) 2010 European Broadcasting Union
http://tech.ebu.ch
*/
/*
This file is part of EBU-radiovis-chumby.
https://code.google.com/p/ebu-radiovis-chumby/

EBU-radiovis-server is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as
published by the Free Software Foundation, either version 3 of the
License, or (at your option) any later version.

EBU-radiovis-server is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with EBU-radiovis-server.  If not, see <http://www.gnu.org/licenses/>.
*/

include "RadioDNS.php";

header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); 
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT"); 
header("Cache-Control: no-cache, must-revalidate"); 
header("Pragma: no-cache"); 
header ("content-type: text/xml; charset=UTF-8");

$url = $_GET['url'];
$parsedurl = checkURL($url);
$type = $parsedurl["type"];

$dns = new RadioDNS();


switch($type){
	case "fm": 
		$rdns = $dns->lookupFMService(/*$parsedurl["ecc"]*/"4E1", $parsedurl["pi"], $parsedurl["freq"]);
		if($rdns == null) xmlerror("NOT FOUND");
		printxml($rdns);
	break;
	case "dab":
		//TODO
	echo $xml."<error type='not implemented'/>";
	break;
	case "am":
		//TODO
		echo $xml."<error type='not implemented'/>";
	break;
	case "hd":
		//TODO
		echo $xml."<error type='not implemented'/>";
	break;
	default:
		echo $xml."<error type='bad format type'/>";
	die();
}

function printxml($rdns){

	$xml ='<?xml version="1.0" encoding="UTF-8"?>';
	$xml.='<radiodns fqdnaddress="'.$rdns["authorative_fqdn"].'">';
	$xml.='<applications>';
		$keys = array_keys($rdns["applications"]);
		if($keys!=null){
			$values = $rdns["applications"];
			for($i=0;$i<count($rdns["applications"]);$i++){
				$v = $values[$keys[$i]];
				$xml.='<service name="'.$keys[$i].'" supported='.(($v["supported"] == null)? '"no"':'"yes"').'>';
				for($j=0;$j<count($v["servers"]); $j++){
					$xml.='<server';
					foreach($v["servers"][$j] as $kj => $vj)
						$xml.=' '.$kj.'="'.$vj.'"';
					$xml.='/>';
				}
				$xml.='</service>';
			}
		}
	$xml.='</applications>';
	$xml.='</radiodns>';
	die($xml);

}


function checkURL($u){
	$surl = split("\.", $u);
	$n = count($surl);
	
	$type = $surl[$n-3];
	$ret = array();
	if($type=="fm" && count($surl) == 6){
			$ret["type"] = $type;
			$ret["freq"] = $surl[0]/100;
			$ret["pi"] = $surl[1];
			$ret["ecc"] = strtoupper($surl[2]);	
			return	$ret;
	}else{
		xmlerror("NOT IMPLEMENTED");
	}
}

function xmlerror($str){
	die('<?xml version="1.0" encoding="UTF-8"?><error type="'.$str.'"/>');
}



?>
