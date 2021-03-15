<?php

    require_once "db.php";

    $fname = $lname = $username = $email = $password = $bdate = $gender = "";
        
    if($_SERVER["REQUEST_METHOD"] == "POST"){

        if(empty(trim($_POST["fname"]))){
            //err = "**Silahkan masukkan First Name.";
            echo "<script>window.location='index.php?reg1_err=1'</script>";
            exit();
        }
        else{
            $fname = trim($_POST["fname"]);
        }

        if(empty(trim($_POST["lname"]))){
            //err = "**Silahkan masukkan Last Name.";
            echo "<script>window.location='index.php?reg2_err=1'</script>";
            exit();
        }
        else{
            $lname = trim($_POST["lname"]);
        }
        
        if(empty(trim($_POST["username"]))){
            //err = "**Silahkan masukkan Username.";
            echo "<script>window.location='index.php?reg3_err=1'</script>";
            exit();
        }
        else{
            $username = trim($_POST["username"]);
        }

        if(empty(trim($_POST["email"]))){
            //err = "*Silahkan masukkan Email.";
            echo "<script>window.location='index.php?reg4_err=1'</script>";
            exit();
        }
        else{
            $email = trim($_POST["email"]);
            if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
                //err = "*Format Email yang Anda masukkan tidak valid.";
                echo "<script>window.location='index.php?reg4_err=2'</script>";
                exit();
            }
        }
            
        if(empty(trim($_POST["reg_password"]))){
            //err = "**Silahkan masukkan Password.";
            echo "<script>window.location='index.php?reg5_err=1'</script>";
            exit();
        }
        else {
            $password = trim($_POST["reg_password"]);
            if(strlen($password) < 4){
                //err = "*Password harus memiliki minimal 4 karakter.";
                echo "<script>window.location='index.php?reg5_err=2'</script>";
                exit();
            }
        }
        
        $query = "SELECT * FROM user WHERE username = :username OR email = :email";

        if($stmt = $conn->prepare($query)){

            $stmt->bindParam(":username", $param_username, PDO::PARAM_STR);
            $stmt->bindParam(":email", $param_email, PDO::PARAM_STR);

            $param_username = $username;
            $param_email = $email;

            if($stmt->execute()){
                if($stmt->rowCount() != 1){
                    unset($stmt);

                    $query = "INSERT INTO user (fname, lname, username, email, password, bdate, gender, role) VALUES (:fname, :lname, :username, :email, :password, :bdate, :gender, 'user')";
                    
                    if($stmt = $conn->prepare($query)){
                        
                        $stmt->bindParam(":fname", $param_fname, PDO::PARAM_STR);
                        $stmt->bindParam(":lname", $param_lname, PDO::PARAM_STR);
                        $stmt->bindParam(":username", $param_username, PDO::PARAM_STR);
                        $stmt->bindParam(":email", $param_email, PDO::PARAM_STR);
                        $stmt->bindParam(":password", $param_password, PDO::PARAM_STR);
                        $stmt->bindParam(":bdate", $param_bdate, PDO::PARAM_STR);
                        $stmt->bindParam(":gender", $param_gender, PDO::PARAM_STR);
                        
                        $param_fname = $fname;
                        $param_lname = $lname;
                        $param_username = $username;
                        $param_email = $email;
                        $param_password = md5($password);
                        $param_bdate = $bdate;
                        $param_gender = $gender;
                        
                        if($stmt->execute()){
                            //Registration Success
                            echo "<script>window.location='index.php?reg_err=0'</script>";
                            exit();
                        }
                        else{
                            //err = "*Terjadi kesalahan. Silahkan coba lagi";
                            echo "<script>window.location='index.php?reg_err=2'</script>";
                            exit();
                        }
                        unset($stmt);
                    }
                    unset($conn);
                }
                else{
                    //err = "*Akun dengan username/email tersebut telah digunakan.";
                    echo "<script>window.location='index.php?reg_err=1'</script>";
                    exit();
                }
            }
            else{
                //err = "*Terjadi kesalahan. Silahkan coba lagi";
                echo "<script>window.location='index.php?reg_err=2'</script>";
                exit();
            }
        }
    }
?>
