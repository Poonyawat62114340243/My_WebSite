<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Bootstrap Table Example</title>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Custom CSS -->
  <link href="style.css" rel="stylesheet">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Chakra+Petch:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700&display=swap" rel="stylesheet">
  <style>
    /* Custom CSS for footer */
    .footer {
      background-color: #343a40;
      color: white;
      padding: 20px 0;
      position: absolute;
      bottom: 0;
      width: 100%;
      text-align: center;
    }
  </style>
</head>
<body style="padding-bottom: 80px; position: relative; min-height: 100vh;">

<div class="container mt-4">
  <!-- Header Bar -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container-fluid">
      <a class="navbar-brand" href="index.php">Home</a>
      <div class="ms-auto">
        <div class="ms-3">
          <input type="text" id="searchInput" class="form-control search-input" placeholder="Search...">
        </div>
        <button id="exportCSV" class="btn btn-success ms-3">Export to CSV</button>
        <a href="/Visual%20mycoding/php%20add/add.php" class="btn btn-primary ms-3">Add</a>
      </div>
    </div>
  </nav>
  
  <h2 class="mb-4">Update Team</h2>

  <!-- Update Modal -->
  <div class="modal fade" id="updateModal" tabindex="-1" aria-labelledby="updateModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="updateModalLabel">Update Team Details</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <!-- Form directly inside the modal -->
        <form id="updateForm" action="html/update_process.php" method="POST">
          <div class="modal-body">
            <input type="hidden" id="updateNumber" name="updateNumber">
            <div class="mb-3">
              <label for="updateNameTeam" class="form-label">Team Name</label>
              <input type="text" class="form-control" id="updateNameTeam" name="updateNameTeam" required>
            </div>
            <div class="mb-3">
              <label for="updateNameCity" class="form-label">City Name</label>
              <input type="text" class="form-control" id="updateNameCity" name="updateNameCity" required>
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Save Changes</button>
          </div>
        </form>
      </div>
    </div>
  </div>

   <!-- Delete Confirmation Modal -->
  <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="deleteModalLabel">Confirm Deletion</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          Are you sure you want to delete this record?
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
          <button id="confirmDeleteBtn" type="button" class="btn btn-danger">Delete</button>
        </div>
      </div>
    </div>
  </div>

  <!-- Table -->
  <table class="table table-dark mt-3">
    <thead>
      <tr>
        <th scope="col">Number</th>
        <th scope="col">Team Name</th>
        <th scope="col">City Name</th>
        <th scope="col">Actions</th>
      </tr>
    </thead>
    <tbody id="tableBody">
      <?php
        include 'conn.php';

        $sql = "SELECT * FROM teamsoccer";
        $result = $conn->query($sql);

        if (!$result) {
            die("Query failed: " . $conn->error);
        }

        if ($result->num_rows > 0) {
            $count = 1; // Initialize a counter for numbering

            while ($row = $result->fetch_assoc()) {
                echo '<tr>';
                echo '<td>' . htmlspecialchars($count) . '</td>'; // Output the current count
                echo '<td>' . htmlspecialchars($row['Name_Team']) . '</td>'; 
                echo '<td>' . htmlspecialchars($row['Name_City']) . '</td>'; 
                echo '<td>';
                echo '<button type="button" class="btn btn-info update-btn" data-bs-toggle="modal" data-bs-target="#updateModal" data-number="' . $row['Number'] . '" data-name-team="' . htmlspecialchars($row['Name_Team']) . '" data-name-city="' . htmlspecialchars($row['Name_City']) . '">Update</button>';
                echo '<button type="button" class="btn btn-danger ms-2 delete-btn" data-bs-toggle="modal" data-bs-target="#deleteModal" data-number="' . $row['Number'] . '">Delete</button>';
                echo '</td>';
                echo '</tr>';

                $count++; // Increment the counter after each row
            }
        } else {
            echo '<tr><td colspan="4">No data found</td></tr>';
        }

        $conn->close();
      ?>
    </tbody>
  </table>
</div>

<!-- Bootstrap JavaScript and dependencies -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>

<!-- JavaScript for handling update modal, CSV export, and table filtering -->
<script>
  document.addEventListener('DOMContentLoaded', function() {
    // Initialize Bootstrap modals
    var updateModal = new bootstrap.Modal(document.getElementById('updateModal'), {
      keyboard: false
    });

    var deleteModal = new bootstrap.Modal(document.getElementById('deleteModal'), {
      keyboard: false
    });

    // Handle update form submission
    var updateForm = document.getElementById('updateForm');
    updateForm.addEventListener('submit', function(event) {
      event.preventDefault(); // Prevent default form submission

      // Collect form data
      var formData = new FormData(updateForm);
      
      fetch('html/update_process.php', {
        method: 'POST',
        body: formData
      })
      .then(response => response.json())
      .then(data => {
        if (data.success) {
          updateModal.hide(); // Hide the modal upon success
          // Optionally update the table dynamically
          fetchTableData();
        } else {
          console.error('Error updating record:', data.message);
        }
      })
      .catch(error => {
        console.error('Error updating record:', error);
      });
    });

    // Event listener for showing the update modal and populating data
    var updateButtons = document.querySelectorAll('.update-btn');
    updateButtons.forEach(button => {
      button.addEventListener('click', function() {
        var number = this.getAttribute('data-number');
        var nameTeam = this.getAttribute('data-name-team');
        var nameCity = this.getAttribute('data-name-city');

        document.getElementById('updateNumber').value = number;
        document.getElementById('updateNameTeam').value = nameTeam;
        document.getElementById('updateNameCity').value = nameCity;

        updateModal.show(); // Show the update modal
      });
    });

    // Event listener for showing the delete modal
    var deleteButtons = document.querySelectorAll('.delete-btn');
    deleteButtons.forEach(button => {
      button.addEventListener('click', function() {
        var number = this.getAttribute('data-number');
        
        // Handle delete confirmation
        var confirmDeleteBtn = document.getElementById('confirmDeleteBtn');
        confirmDeleteBtn.addEventListener('click', function() {
          deleteModal.hide(); // Hide the delete modal
          // Implement your delete logic here, for example, redirecting to delete PHP script
          window.location.href = '../php%20del/del.php?Number=' + encodeURIComponent(number);
        });

        deleteModal.show(); // Show the delete modal
      });
    });

    // Function to fetch updated table data
    function fetchTableData() {
      fetch('fetch_table_data.php') // Replace with the actual URL
        .then(response => response.text())
        .then(data => {
          document.getElementById('tableBody').innerHTML = data;
        })
        .catch(error => {
          console.error('Error fetching table data:', error);
        });
    }

    // Export to CSV button click event
    var exportCSVButton = document.getElementById('exportCSV');
    exportCSVButton.addEventListener('click', function() {
      fetch('export_csv.php')
        .then(response => {
          if (!response.ok) {
            throw new Error('Network response was not ok');
          }
          return response.blob();
        })
        .then(blob => {
          // Create a temporary link element
          var url = window.URL.createObjectURL(new Blob([blob]));
          var a = document.createElement('a');
          a.style.display = 'none';
          a.href = url;
          a.download = 'teamsoccer.csv';
          document.body.appendChild(a);
          a.click();
          window.URL.revokeObjectURL(url);
        })
        .catch(error => {
          console.error('Error exporting to CSV:', error);
        });
    });

    // Search functionality
    var searchInput = document.getElementById('searchInput');
    searchInput.addEventListener('input', function() {
      var searchText = this.value.trim().toLowerCase();
      var rows = document.querySelectorAll('#tableBody tr');

      rows.forEach(row => {
        var cells = row.getElementsByTagName('td');
        var found = false;
        for (var i = 0; i < cells.length; i++) {
          var cellContent = cells[i].textContent.toLowerCase();
          if (cellContent.includes(searchText)) {
            found = true;
            break;
          }
        }
        row.style.display = found ? '' : 'none';
      });
    });
  });
</script>

<!-- Footer -->
<footer class="footer">
  <div class="container">
    <p>&copy; 2024 Designed by Poonyawat Mandee</p>
  </div>
</footer>


</body>
</html>
