<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Music Station</title>
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
                    <h2>หนังสือ</h2>
                    <a href="book_add.php" class="btn btn-link">เพิ่มหนังสือ</a>
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th> รหัส </th>
                                <th> ชื่อผู้เขียน </th>
                                <th> ชื่อหนังสือ </th>
                                <th> ราคา </th>
                                <th colspan="2"> หน่วย </th>
                            </tr>                
                        </thead>
                        <tbody>
                            <?php
                                include 'connectdb.php';
                                $sql =  'SELECT * FROM book order by b_id';
                                $result = mysqli_query($conn,$sql);
                                while (($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) != NULL) {
                                    echo '<tr>';
                                    echo '<td>' . $row['b_id'] . '</td>';
                                    echo '<td>' . $row['b_owner'] . '</td>';
                                    echo '<td>' . $row['b_name'] . '</td>';
                                    echo '<td>' . $row['b_price'] . '</td>';
                                    echo '<td>' . $row['b_bath'] . '</td>';
                                    echo '<td>';
                            ?>
                                <a href="book_edit.php?b_id=<?php echo $row['b_id'];?>" class="btn btn-warning">แก้ไข</a>
                                <a href="JavaScript:if(confirm('ยืนยันการลบ')==true){window.location='book_delete.php?b_id=<?php echo $row["b_id"];?>'}" class="btn btn-danger">ลบ</a>
                            <?php
                                    echo '</td>';
                                    echo '</tr>';
                                }
                                mysqli_free_result($result);
                                mysqli_close($conn);
                            ?>
                        </tbody>    
                    </table>
                </div>    
            </div>
        </div>    
    </body>
</html>