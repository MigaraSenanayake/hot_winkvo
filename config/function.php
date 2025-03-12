<?php
session_start();
require 'dbcon.php';

// Input field validation
function validate($inputData) {
    global $conn;
    $inputData = trim($inputData); // Removes extra spaces
    $inputData = htmlspecialchars($inputData, ENT_QUOTES, 'UTF-8'); // Prevents XSS
    return mysqli_real_escape_string($conn, $inputData); // Escapes input for SQL
}


// Redirect from one page to another page with the message (status)
function redirect($url, $status)
{
    $_SESSION['status'] = $status;
    header('Location: ' . $url);
    exit(0);
}
// Display messages or status after any process
function alertMessage_1()
{
    if (isset($_SESSION['status'])) {
        echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                <h6>' . $_SESSION['status'] . '</h6>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div>';
        unset($_SESSION['status']);
    }
}


// Display messages or status after any process
function alertMessage()
{
    if (isset($_SESSION['status'])) {
        // Display modal with customizable color
        echo '
            <div class="modal fade" id="statusModal" tabindex="-1" aria-labelledby="statusModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content" style="background-color: #fff3cd; color: #8a5e11;">
                        
                        <div class="modal-body">
                            <center><h5>' . $_SESSION['status'] . '</h5>  </center>
                        </div>
                    </div>
                </div>
            </div>';
             
        unset($_SESSION['status']);

        // JavaScript to automatically open and close the modal
        echo '<script>
                var modal = new bootstrap.Modal(document.getElementById("statusModal"));
                modal.show();
                setTimeout(function() {
                    modal.hide();
                }, 4000); // Auto-close after 4 seconds
              </script>';
    }
}



// Insert record using this function
function insert($tableName, $data)
{
    global $conn;

    $table = validate($tableName);

    $columns = array_keys($data);
    $values = array_values($data);

    // Prepared statement for insertion
    $columnString = implode(", ", $columns);
    $paramString = implode(", ", array_fill(0, count($columns), "?"));
    $query = "INSERT INTO $table ($columnString) VALUES ($paramString)";

    $stmt = $conn->prepare($query);
    if ($stmt === false) {
        return ['status' => 500, 'message' => 'Prepare failed: ' . htmlspecialchars($conn->error)];
    }

    // Dynamically bind parameters
    $types = str_repeat('s', count($values)); // Assuming all values are strings
    $stmt->bind_param($types, ...$values);

    if ($stmt->execute()) {
        $stmt->close();
        return ['status' => 200, 'message' => 'Record inserted successfully'];
    } else {
        $error = $stmt->error ? $stmt->error : 'Unknown error';
        $stmt->close();
        return ['status' => 500, 'message' => 'Failed to insert record: ' . htmlspecialchars($error)];
    }
}

// Update record using this function
function update($tableName, $id, $data)
{
    global $conn;

    $table = validate($tableName);
    $id = validate($id);

    // Building the update query dynamically
    $setString = "";
    $params = [];
    foreach ($data as $column => $value) {
        $setString .= "$column = ?, ";
        $params[] = $value;
    }
    $setString = rtrim($setString, ", ");

    // Prepared statement for update
    $query = "UPDATE $table SET $setString WHERE id = ?";
    $params[] = $id;

    $stmt = $conn->prepare($query);
    if ($stmt === false) {
        return ['status' => 500, 'message' => 'Prepare failed: ' . htmlspecialchars($conn->error)];
    }

    // Dynamically bind parameters
    $types = str_repeat('s', count($params) - 1) . 'i'; // Assuming all values are strings except id
    $stmt->bind_param($types, ...$params);

    if ($stmt->execute()) {
        $stmt->close();
        return ['status' => 200, 'message' => 'Record updated successfully'];
    } else {
        $error = $stmt->error ? $stmt->error : 'Unknown error';
        $stmt->close();
        return ['status' => 500, 'message' => 'Failed to update record: ' . htmlspecialchars($error)];
    }
}

// Retrieve all records from a table
function getAll($tableName, $status = NULL)
{
    global $conn;

    $table = validate($tableName);

    // Use prepared statements
    if ($status == 'status') {
        $query = "SELECT * FROM $table WHERE status = 0";
    } else {
        $query = "SELECT * FROM $table";
    }

    $stmt = $conn->prepare($query);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result;
}

// Retrieve a single record by ID
function getById($tableName, $id)
{
    global $conn;

    $table = validate($tableName);

    // Ensure ID is numeric to prevent SQL injection
    if (!is_numeric($id)) {
        return ['status' => 400, 'message' => 'Invalid ID provided'];
    }

    $stmt = $conn->prepare("SELECT * FROM $table WHERE id = ? LIMIT 1");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result) {
        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();
            return ['status' => 200, 'data' => $row, 'message' => 'Record found'];
        } else {
            return ['status' => 404, 'message' => 'No data found'];
        }
    } else {
        return ['status' => 500, 'message' => 'Query failed: ' . htmlspecialchars($conn->error)];
    }
}

// Delete data from the database using ID
function delete($tableName, $id)
{
    global $conn;

    $table = validate($tableName);

    // Ensure ID is numeric to prevent SQL injection
    if (!is_numeric($id)) {
        return ['status' => 400, 'message' => 'Invalid ID provided'];
    }

    $stmt = $conn->prepare("DELETE FROM $table WHERE id = ? LIMIT 1");
    if ($stmt === false) {
        return ['status' => 500, 'message' => 'Prepare failed: ' . htmlspecialchars($conn->error)];
    }

    $stmt->bind_param("i", $id);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        $stmt->close();
        return ['status' => 200, 'message' => 'Record deleted successfully'];
    } else {
        $error = $stmt->error ? $stmt->error : 'Unknown error';
        $stmt->close();
        return ['status' => 500, 'message' => 'Failed to delete record: ' . htmlspecialchars($error)];
    }
}

// Check parameter ID in the query string
function checkParamId($type)
{
    if (isset($_GET[$type]) && !empty($_GET[$type])) {
        return $_GET[$type];
    } else {
        return '<h5>ID Not Found</h5>';
    }
}

// Logout the user by destroying the session
function logoutSession()
{
   unset($_SESSION['loggedIn']);
   unset($_SESSION['loggedInUser']);
}

function jasonresponse($status, $status_type, $message){

    $response = [
        'status' => $status,
        'status_type' => $status_type,
        'message' => $message
        ];
        echo json_encode($response);
        return;
}

