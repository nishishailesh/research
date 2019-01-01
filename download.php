<?php
$GLOBALS['nojunk']='';
require_once 'base/verify_login.php';
require_once 'research_common.php';

////////User code below/////////////////////	

	$link=get_link($GLOBALS['main_user'],$GLOBALS['main_pass']);
	download($link,'research',$_POST['table'],$_POST['field'],$_POST['primary_key'],$_POST['primary_key_value']);

function download($link,$d,$t,$f,$pk,$pkv)
{
	$sql='select * 
			from `'.$t.'`
			where `'.$pk.'`=\''.$pkv.'\'';
			
	$result=run_query($link,$d,$sql);
	$ar=get_single_row($result);
	$filename=$t.'_'.$f.'_'.$pkv.'.pdf';
	$h='Content-Disposition: attachment; filename="'.$filename.'"';
	header($h);
	echo $ar[$f];
}


//////////////user code ends////////////////
tail();
?>
