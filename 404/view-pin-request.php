<?php
include('php-includes/check-login.php');
include('php-includes/connect.php');
$product_amount = 750;
?>
<?php
//Clicked on send buton
if(isset($_POST['send'])){
	$userid = mysqli_real_escape_string($con,$_POST['userid']);
	$bank = mysqli_real_escape_string($con,$_POST['bank']);	
	$amount = mysqli_real_escape_string($con,$_POST['amount']);
	$trxid = mysqli_real_escape_string($con,$_POST['trxid']);
	$account = mysqli_real_escape_string($con,$_POST['account']);
	$id = mysqli_real_escape_string($con,$_POST['id']);
	$date = date("Y-m-d H:i:s");
	
	// Change the line below to your timezone!
    date_default_timezone_set('Asia/Karachi');
    $date = date('Y-m-d H:i:s', time());
    
	$no_of_pin = $amount/$product_amount;
	//Insert pin
	$i=1;
	while($i<=$no_of_pin){
		$new_pin = pin_generate();
		mysqli_query($con,"insert into pin_list (`userid`,`bank`,`trxid`,`pin`,`date`) values('$userid','$bank','$trxid','$new_pin','$date')");
		$i++;	
	}
	
	//updae pin request status
	mysqli_query($con,"update pin_request set status='close' where id='$id' limit 1");
	
	echo '<script>alert("Pin send successfully.");window.location.assign("view-pin-request.php");</script>';	
}

//Pin generate
function pin_generate(){
	global $con;
	$generated_pin = rand(100000,999999);
	
	$query = mysqli_query($con,"select * from pin_list where pin = '$generated_pin'");
	if(mysqli_num_rows($query)>0){
		pin_generate();
	}
	else{
		return $generated_pin;
	}
	
}
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Mlml Website  - View Pin Request</title>

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

        <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header">Admin - View pin request</h1>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
                <div class="row">
                	<div class="col-lg-12">
                    	<div class="table-responsive">
                        	<table class="table table-striped table-bordered">
                            	<tr>
                                	<th>S.n.</th>
                                    <th>Date</th>                                	
                                    <th>Userid</th>
                                    <th>To</th>                                    
                                    <th>From</th>
                                    <th>Trx ID</th>
                                    <th>Amount</th>                                     
                                    <th>Send</th>
                                    <th>Cancel</th>
                                </tr>
                                <?php
									$query = mysqli_query($con,"select * from pin_request where NOT bank='03046639739' AND status='open'");
									if(mysqli_num_rows($query)>0){
										$i=1;
										while($row=mysqli_fetch_array($query)){
											$id = $row['id'];
											$date = $row['date'];											
											$email = $row['email'];
											$bank = $row['bank'];											
											$account = $row['account'];
											$trxid = $row['trxid'];
											$amount = $row['amount'];											
										?>
                                        	<tr>
                                            	<td><?php echo $i; ?></td>
                                                <td><?php echo $date; ?></td>                                            	
                                                <td><?php echo $email; ?></td>
                                                <td><?php echo $bank; ?></td>                                                
                                                <td><?php echo $account; ?></td>
                                                <td><?php echo $trxid; ?></td>
                                                <td><?php echo $amount; ?></td>                                                
                                                <form method="post">
                                                	<input type="hidden" name="userid" value="<?php echo $email ?>">
                                                	<input type="hidden" name="bank" value="<?php echo $bank ?>">                                                	
                                                    <input type="hidden" name="account" value="<?php echo $account ?>">
                                                	<input type="hidden" name="trxid" value="<?php echo $trxid ?>">
                                                    <input type="hidden" name="amount" value="<?php echo $amount ?>">
                                                    <input type="hidden" name="id" value="<?php echo $id ?>">
                                                	<td><input type="submit" name="send" value="Send" class="btn btn-primary"></td>
                                                </form>
                                                <td>Cancel</td>
                                            </tr>
                                        <?php
											$i++;
										}
									}
									else{
									?>
                                    	<tr>
                                        	<td colspan="6" align="center">You have no pin request.</td>
                                        </tr>
                                    <?php
									}
								?>
                            </table>
                        </div><!--/.table-responsive-->
                    </div>
                </div><!--/.row-->
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
