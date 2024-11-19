<?php
session_start();
if (!isset($_SESSION['role_id']) || $_SESSION['role_id'] != 3) {
    header("Location: ../login.html");
    exit();
}

require_once 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $name = $_POST['name'];
    $email = $_POST['email'];
    $role_id = $_POST['role_id'];

    $sql = "UPDATE users SET name=?, email=?, role_id=? WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssii", $name, $email, $role_id, $id);

    if ($stmt->execute()) {
        header("Location: ./frontend/admin/ManageAccount.php");
    } else {
        echo "Error updating record: " . $conn->error;
    }

    $stmt->close();
    $conn->close();
} else {
    $id = $_GET['id'];
    $sql = "SELECT id, name, email, role_id FROM users WHERE id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $stmt->bind_result($id, $name, $email, $role_id);
    $stmt->fetch();
    $stmt->close();
    $conn->close();
    ?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Edit User</title>
    </head>

    <body>
        <h2>Edit User</h2>
        <form action="edit_user.php" method="post">
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <div>
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($name); ?>" required>
            </div>
            <div>
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($email); ?>" required>
            </div>
            <div>
                <label for="role_id">Role:</label>
                <select id="role_id" name="role_id">
                    <option value="2" <?php if ($role_id == 2)
                        echo 'selected'; ?>>Staff</option>
                    <option value="3" <?php if ($role_id == 3)
                        echo 'selected'; ?>>Admin</option>
                </select>
            </div>
            <button type="submit">Update User</button>
        </form>
    </body>

    </html>
    <?php
}
?>