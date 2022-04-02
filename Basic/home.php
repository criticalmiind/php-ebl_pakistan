<?php
include('php-includes/check-login.php');
include('php-includes/connect.php');
$userid = $_SESSION['userid'];
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>EBL Pakistan™  - Home</title>

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
                        
                        <h1 class="page-header">Welcome </h1>
                    
                        <?php include('../announcement.php'); ?>
                        
                        <h2 class="panel-title"><?php echo $_SESSION['userid']; ?></h2>
                 	 <?php
						$query = mysqli_query($con,"select * from user where email='$userid'");
						$result = mysqli_fetch_array($query);
					?>
					
                    <div class="">

                    	<div class="">
                            <div class="">
                                Acc#
                            	<?php 
								echo $result['account']
								?>
                            </div>
                        </div>
                    </div>	
<br>                       
                        
                        
                        
                        
                        
                        
                        
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
                <div class="row">
                	 <?php
						$query = mysqli_query($con,"select * from income where userid='$userid'");
						$result = mysqli_fetch_array($query);
					?>
					
                    <div class="col-lg-3">
                    	<div class="panel panel-success">
                        	<div class="panel-heading">
                            	<h4 class="panel-title">Current Income</h4>
                            </div>
                            <div class="panel-body">
                            	<?php 
								echo $result['current_bal']
								?>
                            </div>
                        </div>
                    </div>					
					
                	<div class="col-lg-3">
                    	<div class="panel panel-info">
                        	<div class="panel-heading">
                            	<h4 class="panel-title">Reward Income</h4>
                            </div>
                            <div class="panel-body">
                            	<?php 
								echo $result['day_bal']
								?>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3">
                    	<div class="panel panel-danger">
                        	<div class="panel-heading">
                            	<h4 class="panel-title">Total Income</h4>
                            </div>
                            <div class="panel-body">
                            	<?php 
								echo $result['total_bal']
								?>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3">
                    	<div class="panel panel-warning">
                        	<div class="panel-heading">
                            	<h4 class="panel-title">Available Pin</h4>
                            </div>
                            <div class="panel-body">
                            	<?php 
								echo  mysqli_num_rows(mysqli_query($con,"select * from pin_list where userid='$userid' and status='open'"));
								?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 dir="rtl"> <class="page-header">Dashboard</h1>
<h5 dir="rtl">
Basic
<strong>
پلان
</strong>
کے مطابق
<strong>
100/100
</strong>
تک
<strong>
200روپیہ
</strong>
اور
<strong>
100/100
</strong>
کے بعد
<strong>
ہر پیئر
</strong>
پر
<strong>
100روپیہ
Profit
</strong>
ہوتا ہے اور
<strong>
باقی کا
</strong>
آپ کے
<strong>
Reward
</strong>
کیلئے
<strong>
جمع
</strong>
ہوتا رہتا ہے
جو آپ کو
<strong>
Star
</strong>
لیول پرجا کر
<strong>
اکٹھا
</strong>
مل جاتا ہے
<strong>
یاد رکھیں؛
ریوارڈ
</strong>
پیئر
کا
<strong>
نارمل
بونس 
</strong>
نہیں
ہوتا
<strong>
اور    
Reward
</strong>
کی رقم
<strong>
72گھنٹوں
</strong>
میں
آپ کو
<strong>
Transfer
</strong>
کر دی جاتی ہے
<strong>
!
</strong>
</h5>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->            
            
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
