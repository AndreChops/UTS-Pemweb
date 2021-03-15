<?php
    session_start();
    require_once "db.php";

    $namemail = $password = $captcha = "";
        
    if($_SERVER["REQUEST_METHOD"] == "POST"){

        if(empty(trim($_POST["namemail"]))){
            //err = "*Username/email tidak boleh kosong.";
            echo "<script>window.location='index.php?log1_err=1'</script>";
            exit();
        }
        else{
            $namemail = trim($_POST["namemail"]);
        }
            
        if(empty(trim($_POST["log_password"]))){
            //err = "*Password tidak boleh kosong.";
            echo "<script>window.location='index.php?log2_err=1'</script>";
            exit();
        }
        else{
            $password = trim($_POST["log_password"]);
        }

        if(empty(trim($_POST["captcha"]))){
            //err = "*Captcha tidak boleh kosong.";
            echo "<script>window.location='index.php?log3_err=1'</script>";
            exit();
        }
        else {
            if(isset($_POST["captcha"])) {
                $captcha = $_POST["captcha"];
                if($captcha != $_SESSION["captcha"]) {
                    //err = "*Captcha tidak cocok.";
                    echo "<script>window.location='index.php?log3_err=2'</script>";
                    exit();
                }
            }
            else{
                echo "<script>window.location='index.php?log3_err=3'</script>";
                exit();
            }
        }
                
        $query = "SELECT fname, lname, password, role FROM user WHERE username = :namemail OR email = :namemail";
                
        if($stmt = $conn->prepare($query)){
                    
            $stmt->bindParam(":namemail", $param_namemail, PDO::PARAM_STR);
                    
            $param_namemail = trim($_POST["namemail"]);
                    
            if($stmt->execute()){
                if($stmt->rowCount() == 1){
                    if($row = $stmt->fetch()){
                        $hashed_password = md5($password);
                        if($hashed_password === $row["password"]){
                            $_SESSION["loggedin"] = true;
                            $_SESSION["role"] = $row["role"];
                            $_SESSION["name"] = $row["fname"].' '.$row["lname"];
                            //Login Success
                            echo "<script>window.location='index.php'</script>";
                            exit();
                        }
                        else{
                            //err = "*Password Anda salah.";
                            echo "<script>window.location='index.php?log_err=1'</script>";
                            exit();
                        }
                    }
                }
                else{
                    //err = "*Akun dengan tidak ditemukan.";
                    echo "<script>window.location='index.php?log_err=1'</script>";
                    exit();
                }
            }
            else{
                //echo "Terjadi kesalahan. Silahkan coba lagi.";
                echo "<script>window.location='index.php?log1_err=2'</script>";
                exit();
            }
            unset($stmt);
        }
        unset($conn);
    }
?>