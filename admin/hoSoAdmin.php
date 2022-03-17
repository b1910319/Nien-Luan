<?php
    include_once("../class/nguoiDung.php");
    $nguoiDung = new nguoiDung();
    $laythongtinadmin = $nguoiDung->infoAdmin();
?>
<!DOCTYPE html>
<html lang="en">

<body>
    <?php include("include/header.php") ?>
    <?php include ("include/rightBar.php") ?>
    <div class="container ho-so-admin" style="margin-top: 100px;">
        <h1 class="alert alert-secondary" role="alert" >HỒ SƠ ADMIN</h1>
        <div class="ho-so-admin-body">
            <table class="table table-bordered table-hover" style="color: black;">
                <thead>
                    <th scope="col">Mã Admin</th>
                    <th scope="col">Tên Admin</th>
                    <th scope="col">User Admin</th>
                    <th scope="col">Email Admin</th>
                    <th scope="col">SDT Admin</th>
                </thead>
                <tbody>
                    <?php
                        if ($laythongtinadmin){
                            while ($result = $laythongtinadmin->fetch_assoc()){
                                ?>
                                    <tr>
                                        <th scope="row"><?php echo $result['ma_admin']?></th>
                                        <td><?php echo $result['ten_admin'] ?></td>
                                        <td><?php echo $result['user_admin'] ?></td>
                                        <td><?php echo $result['email_admin'] ?></td>
                                        <td><?php echo $result['sdt'] ?></td>
                                    </tr>
                                <?php
                            }
                        }
                    ?>
                </tbody>
            </table>
        </div>
    </div>

</html>