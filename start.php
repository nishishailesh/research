<?php
//$GLOBALS['nojunk']='';
require_once 'base/verify_login.php';
require_once 'research_common.php';

//div for ajax
echo '<div class=bg_warning id=\'message\'></div>';
////////User code below/////////////////////	

	$link=get_link($GLOBALS['main_user'],$GLOBALS['main_pass']);

	$user_info=get_user_info($link,$_SESSION['login']);
	//my_print_r($user_info);
	echo '<table class="table table-dark"><tr><td>'.$user_info['id'].'</td><td>'.$user_info['name'].'</td><td>'.$user_info['type'].'</td><td>'.$user_info['department'].'</td></tr></table>';
	
	if($user_info['type']=='srcms')
	{
		if($_POST['action']=='assign_reviewer')
		{
			echo '<div class="jumbotron">';
				list_single_application($link,$_POST['proposal_id']);
				list_srcm_reviewer($link,$_POST['proposal_id']);
			echo '</div>';
		}

		if($_POST['action']=='save_reviewer')
		{
			save_srcm_reviewer($link,$_POST);
			echo '<div class="jumbotron">';
				list_single_application($link,$_POST['proposal_id']);
				list_srcm_reviewer($link,$_POST['proposal_id']);
			echo '</div>';
		}
		//list_application_for_srcm_assignment($link);
		echo '<div class="jumbotron">';
			list_application_status($link,'001.applied','assign_reviewer');
		echo '</div>';
		echo '<div class="jumbotron">';
			list_application_status($link,'010.srcm_assigned','none');
		echo '</div>';
	}
//////////////user code ends////////////////
tail();
//my_print_r($_POST);
?>

<script>
	//run function x when document is ready(ready event)
	//jQuery(document).ready(on_ready);
	
	//function update_reviewer()
	//{
		//if(jQuery(this).is(":checked"))
		//{
			////alert("Checked");
			//p='checked';
		//}
		//else
		//{
			////alert("UnChecked");
			//p='Unchecked';
		//}

		//jQuery.ajax(
					//{
						//url: "start.php", 
						//async: false, 
						//success: function(result)
										//{
											//$("#pp").html(p);
										//}
					//}
				   //);
		
	//}
	//function on_ready()
	//{
		//jQuery(".sr").on("change",update_reviewer);		
	//}

</script>
