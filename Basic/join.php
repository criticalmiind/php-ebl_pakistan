<?php
include('php-includes/connect.php');
include('php-includes/check-login.php');
$userid = $_SESSION['userid'];
$capping = 9999999;
?>
<?php
//User cliced on join
if (isset($_GET['join_user'])) {
	$side = '';
	$pin = mysqli_real_escape_string($con, $_GET['pin']);
	$email = mysqli_real_escape_string($con, $_GET['email']);
	$mobile = mysqli_real_escape_string($con, $_GET['mobile']);
	$account = mysqli_real_escape_string($con, $_GET['account']);
	$under_userid = mysqli_real_escape_string($con, $_GET['under_userid']);
	$side = mysqli_real_escape_string($con, $_GET['side']);
	$password = "123456";

	$flag = 0;

	if ($pin != '' && $email != '' && $mobile != '' && $account != '' && $under_userid != '' && $side != '') {
		//User filled all the fields.
		if (pin_check($pin)) {
			//Pin is ok
			if (email_check($email)) {
				//Email is ok
				if (!email_check($under_userid)) {
					//Under userid is ok
					if (side_check($under_userid, $side)) {
						//Side check
						$flag = 1;
					} else {
						echo '<script>alert("The side you selected is not available.");</script>';
					}
				} else {
					//check under userid
					echo '<script>alert("Invalid Under userid.");</script>';
				}
			} else {
				//check email
				echo '<script>alert("This user id already availble.");</script>';
			}
		} else {
			//check pin
			echo '<script>alert("Invalid pin");</script>';
		}
	} else {
		//check all fields are fill
		echo '<script>alert("Please fill all the fields.");</script>';
	}

	//Now we are heree
	//It means all the information is correct
	//Now we will save all the information
	if ($flag == 1) {

		//Insert into User profile
		$query = mysqli_query($con, "insert into user(`pin`,`email`,`password`,`mobile`,`account`,`under_userid`,`side`) values('$pin','$email','$password','$mobile','$account','$under_userid','$side')");

		//Insert into Tree
		//So that later on we can view tree.
		$query = mysqli_query($con, "insert into tree(`userid`) values('$email')");

		//Insert to side
		$query = mysqli_query($con, "update tree set `$side`='$email' where userid='$under_userid'");

		//Update pin status to close
		$query = mysqli_query($con, "update pin_list set status='close' where pin='$pin'");

		//Inset into Icome
		$query = mysqli_query($con, "insert into income (`userid`) values('$email')");
		echo mysqli_error($con);
		//This is the main part to join a user\
		//If you will do any mistake here. Then the site will not work.

		//Update count and Income.
		$temp_under_userid = $under_userid;
		$temp_side_count = $side . 'count'; //leftcount or rightcount

		$temp_side = $side;
		$total_count = 1;
		$i = 1;
		while ($total_count > 0) {
			$i;
			$q = mysqli_query($con, "select * from tree where userid='$temp_under_userid'");
			$r = mysqli_fetch_array($q);
			$current_temp_side_count = $r[$temp_side_count] + 1;
			$temp_under_userid;
			$temp_side_count;
			mysqli_query($con, "update tree set `$temp_side_count`=$current_temp_side_count where userid='$temp_under_userid'");

			//income
			if ($temp_under_userid != "") {
				$income_data = income($temp_under_userid);
				//check capping
				//$income_data['day_bal'];
				if ($income_data['day_bal'] < $capping) {
					$tree_data = tree($temp_under_userid);

					//check leftplusright
					//$tree_data['leftcount'];
					//$tree_data['rightcount'];
					//$leftplusright;

					$temp_left_count = $tree_data['leftcount'];
					$temp_right_count = $tree_data['rightcount'];
					//Both left and right side should at least 1 user
					if ($temp_left_count > 0 && $temp_right_count > 0) {
						if ($temp_side == 'left') {
							$temp_left_count;
							$temp_right_count;
							if ($temp_left_count <= $temp_right_count) {

								$new_day_bal = $income_data['day_bal'] + 0;
								$new_current_bal = $income_data['current_bal'] + 200;
								$new_total_bal = $income_data['total_bal'] + 200;

								//update income
								mysqli_query($con, "update income set day_bal='$new_day_bal', current_bal='$new_current_bal', total_bal='$new_total_bal' where userid='$temp_under_userid' limit 1");
							}
						} else {
							if ($temp_right_count <= $temp_left_count) {

								$new_day_bal = $income_data['day_bal'] + 0;
								$new_current_bal = $income_data['current_bal'] + 200;
								$new_total_bal = $income_data['total_bal'] + 200;
								$temp_under_userid;
								//update income
								if (mysqli_query($con, "update income set day_bal='$new_day_bal', current_bal='$new_current_bal', total_bal='$new_total_bal' where userid='$temp_under_userid'")) {
								}
							}
						}
					} //Both left and right side should at least 1 user

				}
				//change under_userid
				$next_under_userid = getUnderId($temp_under_userid);
				$temp_side = getUnderIdPlace($temp_under_userid);
				$temp_side_count = $temp_side . 'count';
				$temp_under_userid = $next_under_userid;

				$i++;
			}

			//Chaeck for the last user
			if ($temp_under_userid == "") {
				$total_count = 0;
			}
		} //Loop




		echo mysqli_error($con);

		echo '<script>alert("New account has been activated successfully.");</script>';
	}
}
?>
<!--/join user-->
<?php
//functions
function pin_check($pin)
{
	global $con, $userid;

	$query = mysqli_query($con, "select * from pin_list where pin='$pin' and userid='$userid' and status='open'");
	if (mysqli_num_rows($query) > 0) {
		return true;
	} else {
		return false;
	}
}
function email_check($email)
{
	global $con;

	$query = mysqli_query($con, "select * from user where email='$email'");
	if (mysqli_num_rows($query) > 0) {
		return false;
	} else {
		return true;
	}
}
function side_check($email, $side)
{
	global $con;

	$query = mysqli_query($con, "select * from tree where userid='$email'");
	$result = mysqli_fetch_array($query);
	$side_value = $result[$side];
	if ($side_value == '') {
		return true;
	} else {
		return false;
	}
}
function income($userid)
{
	global $con;
	$data = array();
	$query = mysqli_query($con, "select * from income where userid='$userid'");
	$result = mysqli_fetch_array($query);
	$data['day_bal'] = $result['day_bal'];
	$data['current_bal'] = $result['current_bal'];
	$data['total_bal'] = $result['total_bal'];

	return $data;
}
function tree($userid)
{
	global $con;
	$data = array();
	$query = mysqli_query($con, "select * from tree where userid='$userid'");
	$result = mysqli_fetch_array($query);
	$data['left'] = $result['left'];
	$data['right'] = $result['right'];
	$data['leftcount'] = $result['leftcount'];
	$data['rightcount'] = $result['rightcount'];

	return $data;
}
function getUnderId($userid)
{
	global $con;
	$query = mysqli_query($con, "select * from user where email='$userid'");
	$result = mysqli_fetch_array($query);
	return $result['under_userid'];
}
function getUnderIdPlace($userid)
{
	global $con;
	$query = mysqli_query($con, "select * from user where email='$userid'");
	$result = mysqli_fetch_array($query);
	return $result['side'];
}

?>
<!DOCTYPE html>
<html lang="en">

<head>

	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
	<link rel="stylesheet" href="./style.css">

	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<title>Joining Form</title>
		<link rel="stylesheet" href="css/normalize.css">
		<link href='https://fonts.googleapis.com/css?family=Nunito:400,300' rel='stylesheet' type='text/css'>
		<link rel="stylesheet" href="css/main.css">
	</head>

	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="">
	<meta name="author" content="">

	<title>EBL Pakistan™ - Join</title>

	<!-- Bootstrap Core CSS -->
	<link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

	<!-- MetisMenu CSS -->
	<link href="vendor/metisMenu/metisMenu.min.css" rel="stylesheet">

	<!-- Custom CSS -->
	<link href="dist/css/sb-admin-2.css" rel="stylesheet">

	<!-- Custom Fonts -->
	<link href="vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">



</head>

<body>

	<div id="wrapper">

		<!-- Navigation -->
		<?php include('php-includes/menu.php'); ?>

		<h1>New Joining</h1>

		<?php include('../announcement.php'); ?>

		<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
		<script src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/3/jquery.inputmask.bundle.js"></script>
		<div class="row">

			<form method="get">
				<p style="color:red;" dir="rtl"><strong>
						يادرکھیں؛ ڈیٹا ناقابلِ تبدیل ہوتا ہے
						!
					</strong>
				</p>
				<div class="form-group">
					<label>PIN/Token</label> </dir><input type="number" name="pin" dir="" placeholder="خریداری پر جو ٹوکن نمبر ملتا ہے لکھیں؟" class="form-control" required>
				</div>

				<legend><span class="number">1</span>Account Details</legend>

				<div class="form-group">
					<label>Full Name</label>
					<input type="text" name="mobile" dir="" placeholder="نئے ممبر کا پورا نام لکھیں؟" class="form-control" required>
				</div>

				<div class="form-group">
					<label>Userid </label>
					<input type="email" name="email" dir="" placeholder="نئے ممبر کا ای-میل لکھیں؟" class="form-control" required>
				</div>

				<div class="form-group">
					<label>Account #</label>
					<input type="text" data-inputmask="'mask': '03999999999'" name="account" placeholder="نئے ممبر کا اکاؤنٹ والا موبائل نمبر لکھیں؟" class="form-control" required>
				</div>

				<legend><span class="number">2</span>Your Support</legend>
				<p>By creating an account you agree to our <a href="https://eblpakistan.com/ToS" style="color:dodgerblue">Terms & Conditions</a> and our <a href="https://eblpakistan.com/Privacy" style="color:dodgerblue">Privacy Policy</a>.</p>

				<div class="form-group">
					<label>Under userid</label>
					<input type="text" name="under_userid" dir="" placeholder="جس کے نیچے لگانا اس کا ای۔میل لکھیں؟" class="form-control" required>
				</div>
				<div class="form-group">
					<label>Side</label><br>
					<input type="radio" name="side" value="left"> Left
					<input type="radio" name="side" value="right"> Right
				</div>

				<div class="form-group">
					<input type="submit" name="join_user" class="btn btn-lg btn-success btn-block" value="Create Account">

				</div>

				<script>
					$(":input").inputmask();
				</script>
			</form>
		</div>
	</div>
	<!--/.row-->
	</div>
	<!-- /.container-fluid -->
	</div>
	<!-- /#page-wrapper -->

	</div>
	<!-- /#wrapper -->

	<!-- jQuery -->
	<script src="vendor/jquery/jquery.min.js"></script>

	<!-- Bootstrap Core JavaScript -->
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>

	<!-- Metis Menu Plugin JavaScript -->
	<script src="vendor/metisMenu/metisMenu.min.js"></script>

	<!-- Custom Theme JavaScript -->
	<script src="dist/js/sb-admin-2.js"></script>

</body>

</html>