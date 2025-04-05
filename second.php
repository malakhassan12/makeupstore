

<?php
    session_start(); // Start session before accessing $_SESSION

    $conn = mysqli_connect('localhost', 'root', '', 'sign_db') or die('Connection failed');

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $Fname = isset($_POST['Firstname']) ? mysqli_real_escape_string($conn, $_POST['Firstname']) : '';
        $Sname = isset($_POST['Secondname']) ? mysqli_real_escape_string($conn, $_POST['Secondname']) : '';
        $Email = isset($_POST['Email']) ? mysqli_real_escape_string($conn, $_POST['Email']) : '';
        $Pass = isset($_POST['password']) ? $_POST['password'] : '';


        // Initialize response array
        $response = ['success' => false, 'message' => ''];



        if (!empty($Fname) && !empty($Sname) && !empty($Email) && !empty($Pass)) {
            $check_email = mysqli_query($conn, "SELECT * FROM sign_form WHERE email = '$Email'");
            
            if (mysqli_num_rows($check_email) > 0) {
                $response['message']  = "Email is already registered.";
            } else {
                $insert = mysqli_query($conn, "INSERT INTO `sign_form` (first_name, second_name, email, password) VALUES ('$Fname', '$Sname', '$Email', '$Pass')");
                
                if ($insert) {
                    $response['success'] = true;
                    $response['message'] = "User logged in successfully!";
                }
                else {
                    $response['message']  = "User registration failed!";
                }
            }
        } else {
            $response['message'] = "Please fill in all fields!";
        }

        // Return JSON response
        header('Content-Type: application/json'); 
        echo json_encode($response);
        exit();

    }
?>









<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=, initial-scale=1.0">
    <link href="css/all.min.css" rel="stylesheet">
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/bootstrap.min.css.map" rel="stylesheet">
    <link href="css/fontawesome.css" rel="stylesheet">
    <link href="css/master.css" rel="stylesheet">
    <link href="css/normaliz.css" rel="stylesheet">
    <title>Register</title>
    <title>Document</title>
</head>
<body>

    <div class="regi2">
        <div class="container">
            <div class="signup ">
                
                <div class="parent ">
                    <div class="row text-center">
                        <h2 style="font-weight: bold;font-size: 30px;">sign up</h2>
                    </div>
                    <br>
                    <form method="post" class="bookform" id="signupForm" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                        <div class="row rowf" style="position: relative;">
                            <div class="spe">
                                <i class="fa-solid fa-user"></i>
                                <input type="text" placeholder="" name="Firstname" id="Firstname" required>
                                <label for="Firstname" >First name</label>

                            </div>
                            <div class="wrongf">

                            </div>
                        </div>
                        <br>
                        <div class="row rows" style="position: relative;">
                            <div class="spe">
                                <i class="fa-solid fa-user"></i>
                                <input type="text" placeholder="" name="Secondname" id="Secondname" required>
                                <label for="Secondname" >Second name</label>

                            </div>
                            <div class="wrongs">

                            </div>
                        </div>
                        <br>
                        <div class="row rowe" style="position: relative;">
                            <div class="spe">
                                <i class="fa-solid fa-envelope" ></i>
                                <input type="email" placeholder="" name="Email" id="Email" required>
                                <label for="Email" >Email</label>

                            </div>
                            <div class="wronge">

                            </div>
                        </div>
                        <br>
                        <div class="row rowp" style="position: relative;">
                            <div class="spe">
                                <i class="fa-solid fa-lock" ></i>
                                <input type="password" placeholder="" name="password" id="password" required>
                                <label for="password" >Password</label>

                            
                            </div>
                            <div class="wrongp">

                            </div>

                        </div>
                        <br>
                        <div class="in row">
                        <input type="submit" class="uni" name="submit" value="Sign up">
                        </div>
                        
                    </form>

                    <div class="row res text-center">

                    </div>

                    

                    <div class="row text-center">
                        <span><p>----------or----------</p></span>
                        <div class="icons">
                            <div class="google">
                                <i class="fa-brands fa-google"></i>
                            </div>
    
                            <div class="facebook">
                                <i class="fa-brands fa-facebook"></i>
                            </div>
    
                        </div>
    
                    </div>

                    <div class="row">
                        <p>already have account ? <a href="index.html">Sign in</a></p>
                    </div>
                </div>
                    
            </div>
        </div>
    </div>
    
    

    <script src="js/main.js"></script>
    <script src="js/all.min.js"></script>
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="js/bootstrap.bundle.min.js.map"></script>
    <script src="js/jquery-1.12.4.min.js"></script>
</body>
</html>





