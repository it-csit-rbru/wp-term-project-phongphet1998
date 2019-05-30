<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>ORDER</title>
        <!-- Bootstrap -->
        <link href="bootstrap/css/bootstrap.css" rel="stylesheet" type="text/css">
        <link href="bootstrap/css/bootstrap-theme.css" rel="stylesheet" type="text/css">
        <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script src="bootstrap/js/jquery.min.js"></script>
        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <script src="bootstrap/js/bootstrap.min.js"></script>        
        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
            <script src="bootstrap/js/html5shiv.min.js"></script>
            <script src="bootstrap/js/respond.min.js"></script>
        <![endif]-->
    </head>
    <body style="background-color: #CCFFCC;">        
        <div class="container">
            <div class="row"> 
                <div class="jumbotron" style="background-color: #66FF33;">
                    <?php include 'topbanner.php';?>
                </div>
            </div>
            <div class="row">
                <?php include 'menu.php';?>
            </div>
            <div class="row">
                <div class="col-sm-12 col-md-3 col-lg-3">
                    <p>THE ORDER</p>
                </div>  
                <div class="col-sm-12 col-md-9 col-lg-9">
                    <h4>แก้ไขออเดอร์</h4>
                    <?php
                        $or_id = $_REQUEST['or_id'];
                        if(isset($_GET['submit'])){
                            $or_id = $_GET['or_id'];
                            $or_cm_id = $_GET['or_cm_id'];
                            $or_num = $_GET['or_num'];
                            $or_date = $_GET['or_date'];
                            $sql = "update orders set ";
                            $sql .= "or_cm_id='$or_cm_id',or_num='$or_num',or_date='$or_date'";
                            $sql .="where or_id='$or_id'";
                            include 'connectdb.php';
                            mysqli_query($conn,$sql);
                            mysqli_close($conn);
                            echo "แก้ไขเพลง $or_cm_id $or_num $or_date เรียบร้อยแล้ว<br>";
                            echo '<a href="orders_list.php">แสดงรายการเพลงทั้งหมด</a>';
                        }else{
                    ?>
                    <form class="form-horizontal" role="form" name="orders_edit.php" action="<?php echo $_SERVER['PHP_SELF'];?>">
                    <div class="form-group">
                            <input type="hidden" name="or_id" id="or_id" value="<?php echo "$or_id";?>">
                            <label for="or_cm_id" class="col-md-2 col-lg-2 control-label">ชื่อศิลปิน</label>
                            <div class="col-md-10 col-lg-10">
                                <select name="or_cm_id" id="or_cm_id" class="form-control" value="<?php echo $for_cm_id;?>">
                                <?php
                                    include 'connectdb.php';
                                    $sql2 = "select * from orders where or_id='$or_id'";
                                    $result2 = mysqli_query($conn,$sql2);
                                    $row2 = mysqli_fetch_array($result2,MYSQLI_ASSOC);
                                    $for_num = $row2['or_num'];
                                    $for_date = $row2['or_date'];
                                    $for_cm_id = $row2['or_cm_id'];
                                    $sql =  "SELECT * FROM custumer order by cm_id";
                                    $result = mysqli_query($conn,$sql);
                                    while (($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) != NULL) {
                                        echo '<option value=';
                                        echo '"' . $row['cm_id'].'"';
                                        if($row['cm_id']==$for_cm_id){
                                            echo ' selected="selected" ';
                                        }
                                        echo ">";
                                        echo $row['cm_fname'] . $row['cm_lname'];
                                        echo '</option>';
                                    }
                                    mysqli_free_result($result2);
                                    mysqli_close($conn);
                                ?>
                                </select>
                           </div>    
                        </div>
                        <div class="form-group">
                            <label for="or_num" class="col-md-2 col-lg-2 control-label">ชื่อเพลง</label>
                            <div class="col-md-10 col-lg-10">
                                <input type="text" name="or_num" id="or_num" class="form-control" 
                                       value="<?php echo $for_num;?>">
                            </div>    
                        </div>    
                        <div class="form-group">
                            <label for="or_date" class="col-md-2 col-lg-2 control-label">วันที่ปล่อยเพลง</label>
                            <div class="col-md-10 col-lg-10">
                                <input type="date" name="or_date" id="or_date" class="form-control" 
                                       value="<?php echo $for_date;?>">
                            </div>    
                        </div>
                        <div class="form-group">
                            <div class="col-md-10 col-lg-10">
                                <input type="submit" name="submit" value="ตกลง" class="btn btn-default">
                            </div>    
                        </div> 
                    </form>
                    <?php
                        }
                    ?>
                </div>    
            </div>
        </div>    
    </body>
</html>