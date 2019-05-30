<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>BOOK</title>
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
                <div class="jumbotron" style="background-color: #9933FF;">
                    <?php include 'topbanner.php';?>
                </div>
            </div>
            <div class="row">
                <?php include 'menu.php';?>
            </div>
            <div class="row">
                <div class="col-sm-12 col-md-3 col-lg-3">
                    <p>THE BOOK</p>
                </div>  
                <div class="col-sm-12 col-md-9 col-lg-9">
                    <h4>แก้ไขหนังสือ</h4>
                    <?php
                        $b_id = $_REQUEST['b_id'];
                        if(isset($_GET['submit'])){
                            $b_id = $_GET['b_id'];
                            $b_owner = $_GET['b_owner'];
                            $b_name = $_GET['b_name'];
                            $b_price = $_GET['b_price'];
                            $b_bath = $_GET['b_bath'];
                            $sql = "update book set ";
                            $sql .= "b_owner='$b_owner',b_name='$b_name',b_price='$b_price',b_bath='$b_bath'";
                            $sql .="where b_id='$b_id'";
                            include 'connectdb.php';
                            mysqli_query($conn,$sql);
                            mysqli_close($conn);
                            echo "แก้ไขหนังสือ $b_owner $b_name $b_price $b_bath เรียบร้อยแล้ว<br>";
                            echo '<a href="book_list.php">แสดงหนังสือทั้งหมด</a>';
                        }else{
                    ?>
                    <?php
                            include 'connectdb.php';
                            $sql2 = "select * from book where b_id ='$b_id'";
                            $result2 = mysqli_query($conn,$sql2);
                            $row2 = mysqli_fetch_array($result2,MYSQLI_ASSOC);
                            $fb_owner = $row2['b_owner'];
                            $fb_name = $row2['b_name'];
                            $fb_price = $row2['b_price'];
                            $fb_bath = $row2['b_bath'];
                            mysqli_free_result($result2);
                            mysqli_close($conn);
                        ?>
                    <form class="form-horizontal" role="form" name="book_edit" action="<?php echo $_SERVER['PHP_SELF'];?>">
                        <div class="form-group">
                        <input type="hidden" name="b_id" id="b_id" value="<?php echo "$b_id";?>">
                            <label for="b_owner" class="col-md-2 col-lg-2 control-label">ชื่อผู้แต่ง</label>
                            <div class="col-md-10 col-lg-10">
                                <input type="text" name="b_owner" id="b_owner" class="form-control" value="<?php echo $fb_owner;?>">
                            </div>    
                        </div>    
                        <div class="form-group">
                            <label for="b_name" class="col-md-2 col-lg-2 control-label">ชื่อหนังสือ</label>
                            <div class="col-md-10 col-lg-10">
                                <input type="text" name="b_name" id="b_name" class="form-control" value="<?php echo $fb_name;?>">
                            </div>    
                        </div>
                        <div class="form-group">
                            <label for="b_price" class="col-md-2 col-lg-2 control-label">ราคา</label>
                            <div class="col-md-10 col-lg-10">
                                <input type="text" name="b_price" id="b_price" class="form-control" value="<?php echo $fb_price;?>">
                            </div>    
                        </div>
                        <div class="form-group">
                            <label for="b_bath" class="col-md-2 col-lg-2 control-label">หน่วย</label>
                            <div class="col-md-10 col-lg-10">
                                <input type="text" name="b_bath" id="b_bath" class="form-control" value="<?php echo $fb_bath;?>">
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