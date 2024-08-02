<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Update Team</title>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-4">
  <h2 class="mb-4">Update Team</h2>

  <!-- Update Modal -->
  <div class="modal fade" id="updateModal" tabindex="-1" aria-labelledby="updateModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="updateModalLabel">Update Team Details</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <form id="updateForm" action="update_process.php" method="POST">
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

</div>

<!-- Bootstrap JavaScript and dependencies -->
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>

<!-- JavaScript for handling update modal -->
<script>
  var updateModal = document.getElementById('updateModal');
  updateModal.addEventListener('show.bs.modal', function (event) {
    var button = event.relatedTarget;
    var number = button.getAttribute('data-number');
    var nameTeam = button.getAttribute('data-name-team');
    var nameCity = button.getAttribute('data-name-city');

    document.getElementById('updateNumber').value = number;
    document.getElementById('updateNameTeam').value = nameTeam;
    document.getElementById('updateNameCity').value = nameCity;
  });
</script>

</body>
</html>
