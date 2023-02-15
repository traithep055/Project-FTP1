<!DOCTYPE html>
<html>
<head>
  <title>Upload a file to FTP server</title>
</head>
<style>
  body {
    background-color: #FEEAF1; 
  }
  h1 {
    color: #2176AE; 
    text-align: center; 
  }
  form {
    display: flex;
    justify-content: center; 
    align-items: center;
    height: 10vh; 
  }
  input[type=file], input[type=submit] {
    margin: 10px; 
  }
</style>

<body>
<h1>Upload File</h1>
  <?php
    if (isset($_POST['submit'])) {
      // FTP connection settings
      $ftp_server = "ftp";
      $ftp_username = "bru";
      $ftp_password = "123";

      // connect to FTP server
      $conn_id = ftp_connect($ftp_server) or die("Could not connect to FTP server");

      // login to FTP server
      if (@ftp_login($conn_id, $ftp_username, $ftp_password)) {
        // get the uploaded file
        $file = $_FILES['file']['name'];
        $file_tmp = $_FILES['file']['tmp_name'];
        if (!empty($file)) {
          // upload the file
          if (ftp_put($conn_id, $file, $file_tmp, FTP_BINARY)) {
            echo "File uploaded successfully";
          } else {
            echo "Error uploading file";
          }
        } else {
          echo "No file selected";
        }
      } else {
        echo "Could not login to FTP server";
      }

      // close the FTP connection
      ftp_close($conn_id);
    }
  ?>

  <form method="post" enctype="multipart/form-data">
    <input type="file" name="file">
    <input type="submit" name="submit" value="Upload">
  </form>
</body>
</html>
