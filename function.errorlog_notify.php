<?php

	$domain = 'the-domain.com';
	$email = 'notify@youremail.com';
	$reply = 'noreply@'.$domain;
	$subject = 'ErrorLog Alert ('.$domain.')';
	$path = '/home/directory/public_html';
	$errorlog = 'error_log';
	

	function rglob($pattern, $flags = 0, $path=''){
	    if(!$path && ($dir = dirname($pattern)) != '.'):
	        if($dir == '\\' || $dir == '/'):
				$dir = '';
	        endif;
			return rglob(basename($pattern), $flags, $dir.'/');
	    endif;

		$paths = glob($path.'*', GLOB_ONLYDIR | GLOB_NOSORT);
	    $files = glob($path.$pattern, $flags);

		foreach ($paths as $p):
			$files = array_merge($files, rglob($pattern, $flags, $p . '/'));
	    endforeach;
		return $files;
	}

	$rglob = rglob('error_log', GLOB_MARK, $path);

	foreach($rglob as $grr):
		if(filesize($grr) > 0):
			$x .= filesize($grr).': '.$grr."\n";
		endif;
	endforeach;

	if(!empty($x)):
		$msg = $x."\r\n\n";
		$headers = "From: ".$subject." <".$reply."> \r\nReply-To: ".$reply." \r\nReturn-Path: ".$reply." \r\n";
		mail($email, $subject, $msg, $headers, '-f '.$reply);
	endif;

?>
