<?php
// Include config file
require_once "config.php";
 
// Define variables and initialize with empty values
$client_name = $client_Surname = $phoneNum = $email = $password = $client_address =  "";
$client_name_err = $client_Surname_err = $phoneNum_err = $email_err = $password_err = $client_address_err= "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Validate client_name
    if(empty(trim($_POST["client_name"]))){
        $client_name_err = "Please enter your name";
    } elseif(!preg_match('/^[a-zA-Z]+$/', trim($_POST["client_name"]))){
        $client_name_err = "Your name can only contain letters";
    } else{
        // Prepare a select statement
        $sql = "SELECT id FROM users WHERE client_name = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_client_name);
            
            // Set parameters
            $param_client_name = trim($_POST["client_name"]);
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                /* store result */
                mysqli_stmt_store_result($stmt);
                $client_name = trim($_POST["client_name"]);
                
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }
    //Validate surname information
    if(empty(trim($_POST["client_Surname"]))){
        $client_Surname_err = "Please enter your surname";
    } elseif(!preg_match('/^[a-zA-Z]+$/', trim($_POST["client_Surname"]))){
        $client_Surname_err = "Your surname can only contain letters";
    } else{
        // Prepare a select statement
        $sql = "SELECT id FROM users WHERE client_Surname = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_client_Surname);
            
            // Set parameters
            $param_client_Surname = trim($_POST["client_Surname"]);
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                /* store result */
                mysqli_stmt_store_result($stmt);
                $client_Surname = trim($_POST["client_Surname"]);
                
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
            // Close statement
            mysqli_stmt_close($stmt);
        }
    }

    if(empty(trim($_POST["phoneNum"]))){
        $phoneNum_err = "Please enter your surname";
    } elseif(!preg_match('/^[0-9]+$/', trim($_POST["phoneNum"]))){
        $phoneNum_err = "Your phone number can only contain numbers";
    } else{
        // Prepare a select statement
        $sql = "SELECT id FROM users WHERE phoneNum = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_phoneNum);
            
            // Set parameters
            $param_phoneNum = trim($_POST["phoneNum"]);
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                /* store result */
                mysqli_stmt_store_result($stmt);
                $phoneNum = trim($_POST["phoneNum"]);
                
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
            // Close statement
            mysqli_stmt_close($stmt);
        }
    }
    if(empty(trim($_POST["email"]))){
        $email_err = "Please enter your email";
    } elseif(!preg_match('/[a-z0-9._%+-]+@[a-z0-9.-]+.[a-z]{3,}$/', trim($_POST["email"]))){
        $email_err = "Your email can start with anything, but has to be followed up by an @ and then domain";
    } else{
        // Prepare a select statement
        $sql = "SELECT id FROM users WHERE email = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_email);
            
            // Set parameters
            $param_email = trim($_POST["email"]);
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                /* store result */
                mysqli_stmt_store_result($stmt);
                $email = trim($_POST["email"]);
                
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
            // Close statement
            mysqli_stmt_close($stmt);
        }
    }
    
    // Validate password
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter a password.";     
    } elseif(strlen(trim($_POST["password"])) < 6){
        $password_err = "Password must have atleast 6 characters.";
    } else{
        $password = trim($_POST["password"]);
    }
    
    //Validate Address
    if(empty(trim($_POST["client_address"]))){
        $client_address_err = "Please enter your address";
    } elseif(!preg_match('/[a-z0-9._%+-]+$/', trim($_POST["client_address"]))){
        $client_address_err = "Your address contains invalid characters, please enter again";
    } else{
        // Prepare a select statement
        $sql = "SELECT id FROM users WHERE client_address = ?";
        
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_client_address);
            
            // Set parameters
            $param_client_address = trim($_POST["client_address"]);
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                /* store result */
                mysqli_stmt_store_result($stmt);
                $client_address = trim($_POST["client_address"]);
                
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
            // Close statement
            mysqli_stmt_close($stmt);
        }
    }
    
    // Check input errors before inserting in database
    if(empty($client_name_err) && empty($client_Surname_err) && empty($phoneNum_err) && empty($email_err) && empty($password_err) && empty($client_address_err) ){
        
        // Prepare an insert statement
        $sql = "INSERT INTO users (client_name,client_Surname,phoneNum,email, password, client_address) VALUES (?, ?, ?, ?, ?, ?)";
         
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "ssssss", $param_client_name,$param_client_Surname,$param_phoneNum,$param_email, $param_password, $param_client_address);
            
            // Set parameters
            $param_client_name = $client_name;
            $param_client_Surname = $client_Surname;
            $param_phoneNum = $phoneNum;
            $param_email = $email;
            $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash
            $param_client_address = $client_address;
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                // Redirect to login page
                header("location: login.php");
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }
    
    // Close connection
    mysqli_close($link);
}
?>
 
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Sign Up</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body{ font: 14px sans-serif;text-align: center; background-color: green; }
        .wrapper{width: 360px; padding: 20px; position: absolute;left: 50%;top: 50%;transform: translate(-50%, -50%);border: 3px solid #000000;padding: 10px;background-color: lightgreen;}
    </style>
</head>
<body>
    <div class="wrapper">
        <h2>Sign Up</h2>
        <p>Please fill this form to create an account.</p>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group">
                <label>First Name</label>
                <input type="text" name="client_name" class="form-control <?php echo (!empty($client_name_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $client_name; ?>">
                <span class="invalid-feedback"><?php echo $client_name_err; ?></span>
            </div>   
            <div class="form-group">
                <label>Surname</label>
                <input type="text" name="client_Surname" class="form-control <?php echo (!empty($client_Surname_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $client_Surname; ?>">
                <span class="invalid-feedback"><?php echo $client_Surname_err; ?></span>
            </div>   
             
            <div class="form-group">
                <label>Phone Number</label>
                <input type="text" name="phoneNum" class="form-control <?php echo (!empty($phoneNum_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $phoneNum; ?>">
                <span class="invalid-feedback"><?php echo $phoneNum_err; ?></span>
            </div>   
             
            <div class="form-group">
                <label>Email: </label>
                <input type="text" name="email" class="form-control <?php echo (!empty($email_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $email; ?>">
                <span class="invalid-feedback"><?php echo $email_err; ?></span>
            </div>   
             
            <div class="form-group">
                <label>Address</label>
                <input type="text" name="client_address" class="form-control <?php echo (!empty($client_address_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $client_address; ?>">
                <span class="invalid-feedback"><?php echo $client_address_err; ?></span>
            </div>

            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password" class="form-control <?php echo (!empty($password_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $password; ?>">
                <span class="invalid-feedback"><?php echo $password_err; ?></span>
            </div>

            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Submit">
            </div>
            <p>Already have an account? <a href="login.php">Login here</a>.</p>
        </form>
    </div>    
</body>
</html>