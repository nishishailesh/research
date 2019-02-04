<?php

$GLOBALS['main_user_location']='/var/gmcs_config/db_config.php';
$GLOBALS['user_database']='research';
$GLOBALS['user_table']='user';
$GLOBALS['user_id']='id';
$GLOBALS['user_pass']='password';
$GLOBALS['expiry_period']='+ 6 months';
$GLOBALS['expirydate_field']='expirydate';

//////Project specific globals
$GLOBALS['required_srcm_reviewer']=3;


$GLOBALS['proposal_type']=array(
									'Dissertation',
									'PhD',
									'Poster',
									'Paper',
									'Clinical Trial',
									'Other'
								);


$GLOBALS['attachment_type']=array(
									'',
									'Protocol',
									'Permission from MS',
									'Permission from Dean',
									'Permission from collaborator',
									'Permission from resource-site',
									'Undertakings',
									'Covering Letter',
									'Patient information consent form',
									'Patient information sheet',
									'Other'
								);
?>
