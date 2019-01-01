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
		/////
		//1//
		/////
		if($_POST['action']=='assign_reviewer')
		{
			echo '<div class="jumbotron">';
				list_single_application($link,$_POST['proposal_id']);
			echo '</div>';
			echo '<div class="jumbotron">';
				list_srcm_reviewer($link,$_POST['proposal_id']);
			echo '</div>';
		}

		/////
		//2//
		/////
		if($_POST['action']=='save_reviewer')
		{
			save_srcm_reviewer($link,$_POST);
			echo '<div class="jumbotron">';
				list_single_application($link,$_POST['proposal_id']);
				list_srcm_reviewer($link,$_POST['proposal_id']);
			echo '</div>';
		}

		/////
		//5//
		/////		
		if($_POST['action']=='send_to_ecms')
		{
			set_application_status($link,$_POST['proposal_id'],'030.sent_to_ecms');
		}
				
		echo '<ul class="nav nav-pills">
			<li class="nav-item"><a class="nav-link active" data-toggle="pill" href="#applied">Applied</a></li>
			<li class="nav-item"><a class="nav-link" data-toggle="pill" href="#assigned">Assigned (SRC)</a></li>
			<li class="nav-item"><a class="nav-link" data-toggle="pill" href="#reviewed">Reviewed (SRC)</a></li>
		</ul>
		
		<div class="tab-content">';
		
			echo '<div class="jumbotron tab-pane container active" id=applied>';
				list_application_status($link,'001.applied','assign_reviewer');
			echo '</div>';
			echo '<div class="jumbotron tab-pane container" id=assigned>';
				list_application_status($link,'010.srcm_assigned','assign_reviewer');
			echo '</div>';
			echo '<div class="jumbotron tab-pane container" id=reviewed>';
				list_application_status($link,'020.srcm_approved','send_to_ecms','Send to ecms');
			echo '</div>';
			
		echo '</div>';//for tab-content
	}

	if($user_info['type']=='srcm')
	{	

		/////
		//3//
		/////
		if($_POST['action']=='save_comment')
		{
			save_comment($link,$_SESSION['login'],$_POST['proposal_id'],$_POST['comment']);
		}	
			
		/////
		//4//
		/////		
		if($_POST['action']=='approve')
		{
			save_approve($link,$_SESSION['login'],$_POST['proposal_id'],$_POST['comment']);
			if(pending_review($link,$_POST['proposal_id'],'srcm')==0)
			{
					set_application_status($link,$_POST['proposal_id'],'020.srcm_approved');
			}
		}	
						
		if($_POST['action']=='view_application' || $_POST['action']=='save_comment' ||$_POST['action']=='approve')
		{
			view_entire_application($link,$_POST['proposal_id']);
		}		
		
	
			echo '<div class="jumbotron tab-pane container active" id=assigned>';
				list_application_for_reviewer($link,'010.srcm_assigned','view_application',$_SESSION['login']);
			echo '</div>';
	}



//////////////user code ends////////////////
tail();
my_print_r($_POST);
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
