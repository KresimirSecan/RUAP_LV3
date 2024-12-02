<html>
<head>
  <Title>Registration Form</Title>
  <style type="text/css">
    body {
      background-color: #fff;
      border-top: solid 10px #000;
      color: #333;
      font-size: .85em;
      margin: 20px;
      padding: 20px;
      font-family: "Segoe UI", Verdana, Helvetica, Sans-Serif;
    }

    h1, h2, h3 {
      color: #000;
      margin-bottom: 10px;
      padding-bottom: 0;
    }

    h1 {
      font-size: 2em;
    }

    h2 {
      font-size: 1.75em;
    }

    h3 {
      font-size: 1.2em;
    }

    .form-container {
      width: 100%;
      max-width: 500px;
      margin: 0 auto;
      padding: 20px;
      border: 1px solid #ccc;
      border-radius: 8px;
    }

    .form-container input[type="text"] {
      width: 100%;
      padding: 10px;
      margin: 10px 0;
      border: 1px solid #ccc;
      border-radius: 4px;
      font-size: 1em;
    }

    .form-container input[type="submit"] {
      width: 100%;
      padding: 10px;
      background-color: #4CAF50;
      color: white;
      border: none;
      border-radius: 4px;
      font-size: 1.2em;
      cursor: pointer;
    }

    .form-container input[type="submit"]:hover {
      background-color: #45a049;
    }

    table {
      margin-top: 1em;
      width: 100%;
      border-collapse: collapse;
    }

    th, td {
      padding: 10px;
      text-align: left;
      border-bottom: 1px solid #ddd;
    }

    th {
      font-size: 1.2em;
    }

    td {
      font-size: 1em;
    }

  </style>
</head>

<body>
  <h1>Register here!</h1>
  <p>Fill in your name and email address, then click <strong>Submit</strong> to register.</p>

  <div class="form-container">
    <form method="post" action="index.php" enctype="multipart/form-data">
      <label for="name">Name</label>
      <input type="text" name="name" id="name" required />

      <label for="email">Email</label>
      <input type="text" name="email" id="email" required />

      <input type="submit" name="submit" value="Submit" />
    </form>
  </div>

  <?php
    // DB connection info
    $host = "lv3-bae7bcftc4djbvdw.northeurope-01.azurewebsites.net";
    $user = "gfboqjixbv";
    $pwd = "wHvUbEr2\$balqW0R";
    $db = "lv3-database";

    // Connect to database.
    $conn = mysqli_connect($host, $user, $pwd, $db);
    if (mysqli_connect_errno()) {
      echo "<h3>Failed to connect to MySQL:</h3> " . mysqli_connect_error();
    }

    // Insert registration info
    if (!empty($_POST)) {
      $name = $_POST['name'];
      $email = $_POST['email'];
      $date = date("Y-m-d");

      // Insert data
      $sql_insert = "INSERT INTO registration_tbl (name, email, date)
                     VALUES ('$name','$email','$date')";
      if ($conn->query($sql_insert) === TRUE) {
        echo "<h3>You're registered!</h3>";

        // Retrieve data
        $sql_select = "SELECT * FROM registration_tbl";
        $registrants = $conn->query($sql_select);
        if ($registrants->num_rows > 0) {
          echo "<h2>People who are registered:</h2>";
          echo "<table>";
          echo "<tr><th>Name</th><th>Email</th><th>Date</th></tr>";
          while ($registrant = $registrants->fetch_assoc()) {
            echo "<tr><td>" . $registrant['name'] . "</td>";
            echo "<td>" . $registrant['email'] . "</td>";
            echo "<td>" . $registrant['date'] . "</td></tr>";
          }
          echo "</table>";
        } else {
          echo "<h3>No one is currently registered.</h3>";
        }
      } else {
        echo "<h3>Insert Failed</h3>";
      }
    }
  ?>
</body>
</html>
