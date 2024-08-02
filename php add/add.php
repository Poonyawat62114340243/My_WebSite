<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Add New Entry</title>
  <!-- Bootstrap CSS -->
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  <!-- Custom CSS -->
  <style>
    body {
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      background-color: #f8f9fa; /* Light gray background */
    }
    .container {
      background-color: #ffffff; /* White container background */
      padding: 40px;
      border-radius: 8px;
      box-shadow: 0px 0px 20px rgba(0, 0, 0, 0.1); /* Soft shadow effect */
      width: 100%;
      max-width: 500px; /* Adjust max-width as per your design */
    }
    h2 {
      text-align: center;
      margin-bottom: 30px;
    }
    .form-group {
      margin-bottom: 20px;
    }
  </style>
</head>
<body>

<div class="container">
  <h2>Add New Entry</h2>
  <form action="add_process.php" method="POST">
    <div class="form-group">
      <label for="name_team">Team Name</label>
      <input type="text" class="form-control" id="name_team" name="name_team" required>
    </div>
    <div class="form-group">
      <label for="name_city">City Name</label>
      <input type="text" class="form-control" id="name_city" name="name_city" required>
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
    <a href="../html/index.php" class="btn btn-secondary">Cancel</a>
  </form>
</div>

<!-- Bootstrap JS and dependencies (jQuery and Popper.js) -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
