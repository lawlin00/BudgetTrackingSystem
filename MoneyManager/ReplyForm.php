<?php

ob_start();
include("header.php");
$buffer=ob_get_contents();
ob_end_clean();
$uid = $_SESSION['userid'];
$buffer=str_replace("%title%","Add Feedback",$buffer);
echo $buffer;

include 'FeedbackLayout2.php';?>
<style>
	body {
		font-family: 'Nunito', sans-serif;

		overflow-x: hidden;
		font-weight: 400;
		-webkit-font-smoothing: antialiased;
		-moz-osx-font-smoothing: grayscale;
		text-shadow: 1px 1px 1px rgba(0,0,0,0.004);
		margin: 0;
	}



	 h4{
		font-weight: 400;
		padding:0;
		margin:0;
	}


	/********************************************************************/

	.feedback_container{
		text-align: center;
		padding: 50px;

	}

	.title_feedback{
		font-size: 31px;
		font-weight: 800;
		padding-bottom: 30px;
		color:white;
	}



	.comment_div textarea{
		width: 70%;
		border: 2px solid #f18700;
		resize: none;
		outline: 0;
		font-weight: 800;
		padding: 20px;
		font-size: 18px;
	}

	.submit_btn a{
		margin-top: 40px;
		text-decoration: none
	}

	.submit_btn a{
		display: inline-block;
		background: #f18700;
		color: #fff;
		font-size: 20px;
		font-weight: 700;
		padding: 10px 40px;
		text-transform: uppercase;
	}



	@media only screen and (max-width: 640px){

		.feedback_container {
			text-align: center;
			padding: 30px;

		}

		.title_feedback {
			font-size: 24px;
		}


	}
</style>

<?php
include 'conn.php';
$uid = $_GET['uid'];
$fid = $_GET['fid'];
?>

<form action="UpdateReplyFeedback.php" method="POST" >
        <div class="feedback_container">
		<input type="hidden" name="uid" value="<?php echo $uid;?>">
			<input type="hidden" name="fid"  value="<?php echo $fid;?>">  
				  <div class="comment_div">
					  <h4 class="title_feedback">Comments / Suggestions?</h4>
					  <textarea rows="8" name="Rcomment" required></textarea>
				  </div>

				  <button type="submit" class="btn btn-primary">Send</button>

		</div>
</form>
		<?php  include 'footer.php'; ?>
