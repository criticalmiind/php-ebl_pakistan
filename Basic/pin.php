<?php
include('php-includes/connect.php');
include('php-includes/check-login.php');
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

    <title>EBL Pakistan™ - Pin</title>

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
                        <h1 class="page-header">PINs Available</h1>
                        <?php include('../announcement.php'); ?>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
                <div class="row">
                    <div class="col-lg-12">

                        <p style="color:red;" dir="rtl">
                            <strong>
                                نوٹ کریں؛
                            </strong>
                            <br>
                            <strong>
                                PIN
                            </strong>
                            کوڈ کبھی
                            <strong>
                                Expire
                            </strong>
                            نہیں ہوتا۔
                            <br>
                            <strong>
                                PIN
                            </strong>
                            کوڈ صرف
                            <strong>
                                اسی اکاؤنٹ
                            </strong>
                            سے
                            <strong>
                                استعمال
                            </strong>
                            ہوتا ہے
                            جس میں
                            <strong>
                                موجود
                            </strong>
                            ہے۔
                            <br><br>
                            <strong>
                                PIN
                            </strong>
                            کوڈ جتنے چاہیں
                            <strong>
                                اکٹھے
                            </strong>
                            لے سکتے ہیں اور
                            <strong>
                                کچھ
                                PIN
                            </strong>
                            کوڈ
                            <strong>
                                اضافی
                            </strong>
                            اپنے
                            <strong>
                                پاس رکھیں
                            </strong>
                            تاکہ
                            <strong>
                                ضرورت
                            </strong>
                            پڑنے پر
                            <strong>
                                ارجنٹ
                            </strong>
                            جوئننگ
                            <strong>
                                لگا
                            </strong>
                            سکیں !
                        </p>
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped">
                                <tr>
                                    <th>S.n.</th>
                                    <th>Pin</th>
                                </tr>
                                <?php
                                $i = 1;
                                $query = mysqli_query($con, "select * from pin_list where userid='$userid' and status='open'");
                                if (mysqli_num_rows($query) > 0) {
                                    while ($row = mysqli_fetch_array($query)) {
                                        $pin = $row['pin'];
                                ?>
                                        <tr>
                                            <td><?php echo $i ?></td>
                                            <td><?php echo $pin ?></td>
                                        </tr>
                                    <?php
                                        $i++;
                                    }
                                } else {
                                    ?>
                                    <tr>
                                        <td colspan="2">Sorry you have no pin.</td>
                                    </tr>
                                <?php
                                }
                                ?>
                            </table>
                        </div>
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