<?php
//$GLOBALS['main_user']='root';
//$GLOBALS['main_pass']='root';
$GLOBALS['main_user_location']='/var/gmcs_config/staff.conf';
$GLOBALS['user_database']='research';
$GLOBALS['user_table']='user';
$GLOBALS['user_id']='id';
$GLOBALS['user_pass']='password';
$GLOBALS['expiry_period']='+ 6 months';
$GLOBALS['expirydate_field']='expirydate';

//////Project specific globals
$GLOBALS['required_srcm_reviewer']=3;
$GLOBALS['required_ecm_reviewer']=2;


$GLOBALS['proposal_type']=array(
									'Dissertation',
									'Research Project',
									'Poster/Paper',
									'PhD',
									'Clinical Trial',
									'Other'
								);


$GLOBALS['attachment_type']=array(
									'',
									'Covering Letter',
									'Permission from MS',
									'Permission from Dean',
									'Permission from collaborator',
									'Permission from resource-site',
									'Protocol',
									'Data collection questionnaire',
									'Assesment tools',
									'Patient information sheet',
									'Patient informed consent form',
									'References',
									'Undertakings',								
									'Other'
								);
?>
