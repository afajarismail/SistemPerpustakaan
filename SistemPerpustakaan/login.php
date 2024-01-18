<?php
//menyertakan file program koneksi.php pada register
require('koneksi.php');
//inisialisasi session
session_start();

$error = '';
$validate = '';

//mengecek apakah sesssion username tersedia atau tidak jika tersedia maka akan diredirect ke halaman index
if( isset($_SESSION['username']) ) header('Location: index.php');
        
//mengecek apakah form disubmit atau tidak
if( isset($_POST['submit']) ){
        
        // menghilangkan backshlases
        $username = stripslashes($_POST['username']);
        //cara sederhana mengamankan dari sql injection
        $username = mysqli_real_escape_string($con, $username);
         // menghilangkan backshlases
        $password = stripslashes($_POST['password']);
         //cara sederhana mengamankan dari sql injection
        $password = mysqli_real_escape_string($con, $password);
       
        echo $username ." <= username   pass =>  ". $password;
        //cek apakah nilai yang diinputkan pada form ada yang kosong atau tidak
        if(!empty(trim($username)) && !empty(trim($password))){

            //select data berdasarkan username dari database
            $query      = "SELECT * FROM admin WHERE username = '$username'";
            $result     = mysqli_query($con, $query);
            $rows       = mysqli_num_rows($result);

            echo "<br/> rows ".$rows;
            if ($rows != 0) {
                $password = md5($password);
                $data = mysqli_fetch_assoc($result);

                if($password == $data['password']){
                    $_SESSION['username'] = $username;
                    $_SESSION['role'] = "admin";
                    $_SESSION['id'] = $data['id_admin'];
                    echo "masuk";
               
                    header('location:buku_admin.php');

                }

                            
            //jika gagal maka akan menampilkan pesan error
            } else {
                $query      = "SELECT * FROM mhs WHERE nim = '$username'";
                $result     = mysqli_query($con, $query);
                $rows       = mysqli_num_rows($result);
                $data = mysqli_fetch_assoc($result);
                // echo "rows ".$rows;
                var_dump($data);
        
                if ($rows != 0) {
                    $password = md5($password);
                    $hash = $data["password"];
                    $id_smt = $data["id_smt"];
                    
                    echo" <br> ". $id_smt;
                    if($password == $hash){
                        $_SESSION['username'] = $username;
                        $_SESSION['role'] = ($id_smt > 4) ? "mhs-ta" : "mhs";

                
                        if($id_smt > 4){
                            header("location:page_mhs_ta.php");
                        } else {
                            header('location: page_mhs.php');
                        }
                        echo "masuk";
            }
            
        }else {
            $error =  'Data tidak boleh kosong !!';
        }
    } 
}
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
<!-- meta tags -->
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
 
<!-- Bootstrap CSS -->
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

<!-- costum css -->
<link rel="stylesheet" href="style.css">
</head>
<body>
        <section class="container-fluid mb-4">
            <!-- justify-content-center untuk mengatur posisi form agar berada di tengah-tengah -->
            <section class="row justify-content-center ">
            <section class="col-12 col-sm-6 col-md-4">
                <form class="form-container" action="login.php" method="POST">
                    <h4 class="text-center font-weight-bold"> Silahkan Login </h4>
                    <?php if($error != ''){ ?>
                        <div class="alert alert-danger" role="alert"><?= $error; ?></div>
                    <?php } ?>
                   
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" class="form-control" id="username" name="username" placeholder="Masukkan username">
                    </div>
                    <div class="form-group">
                        <label for="InputPassword">Password</label>
                        <input type="password" class="form-control" id="InputPassword" name="password" placeholder="Password">
                        <?php if($validate != '') {?>
                            <p class="text-danger"><?= $validate; ?></p>
                        <?php }?>
                    </div>
                 
                    <button type="submit" name="submit" class="btn btn-primary btn-block">Login</button>
                    <div class="form-footer mt-2">
                        
                    </div>
                </form>
            </section>
            </section>
        </section>

    <!-- Bootstrap requirement jQuery pada posisi pertama, kemudian Popper.js, dan  yang terakhit Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
</body>
</html>