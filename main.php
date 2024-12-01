<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Data</title>
    <link rel="stylesheet" href="style.css">
    <link href="https://cdn.jsdelivr.net/npm/daisyui@4.12.14/dist/full.min.css" rel="stylesheet" type="text/css" />
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
<section>
        <div id="form_data">
            <form action="" method="post"  enctype="multipart/form-data">
                <div class="full_form">
                    <h2 class="text-center text-2xl mt-5 mb-5 font-bold">Form Data</h2>
                    <div id="input_label">
                        <label for="email">Email</label><br>
                        <input type="text" name="inputEmail" id="email" placeholder="Enter Your Email" required><br>
                        <label for="password">Password</label><br>
                        <input type="password" name="inputPassword" id="password" placeholder="Enter Password" required><br>
                        <label for="image">Image</label><br>
                        <input type="file" name="imgFile" id="image" required><br>
                        <button type="submit" name="imgUpload" class="px-3 py-2 border-2  rounded-lg">Upload</button>
                    </div>
                    <div id="submit_btn">
                        <button type="submit" name="btnSubmit" value="Submit">Submit</button>
                    </div>
                </div>
            </form>
        </div>
    </section>
    <?php
        if(isset($_POST['imgUpload'])){
            $fileName = $_FILES['imgFile']['name'];
            $tempFile = $_FILES['imgFile']['tmp_name'];
            $fileType = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
            $fileSize = $_FILES['imgFile']['size'];
            $img = "image";
            $kb = $fileSize/1024;


            if($kb > 100 || !in_array($fileType, ["jpg", "png", "jpeg", "gif"])){
               if($kb > 100){
                    echo "Image is too large. Your image must be a maximum of 100 KB. ";
               }
               if(!in_array($fileType, ["jpg", "png", "jpeg", "gif"])){
                    echo "Also Sorry, only jpg, png, jpeg, or gif formats are allowed!";
               }
            }
            else{
                move_uploaded_file($tempFile, $img.$fileName);
                echo "Successfully";
            }
        }
    ?>

<?php
    if(isset($_POST['imgUpload'])){
        echo "<img src='$img$fileName' style = 'width:300px; margin-left: 60%;'>";
    }
?>

<?php
    if(isset($_POST['btnSubmit'])){
        $email = $_POST['inputEmail'];
        $password = $_POST['inputPassword'];
        
        if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
            echo "<p style='color:red;'>Please enter a valid email address.</p>";
        }
        else{
            echo "<p style='color:green;'>Email is valid.</p>";
        };

        if(!preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d).{8,}$/', $password)){
            echo "<p class='text-red-500 text-center mt-10 text-xl font-semibold'>
            Password must be at least 8 characters long and include one uppercase letter, one lowercase letter, and one number.
            </p>";
        }
        else{
            echo "Your Password Is Valid";
        }
    }
?>

<?php
    require('pages/process.php');
    if (isset($_POST["btn_submit"])) {
        $name = $_POST["inputName"];
        $id = $_POST["inputId"];
        $batch = $_POST["inputBatch"];

        $process = new Process($name, $id, $batch);
        $process->save();
    }
    ?>
<?php
        Process::displayShow();
        ?>
</body>
</html>