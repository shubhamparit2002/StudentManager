<?php
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if (isset($_POST['name'])) {
        $name = $_POST['name'];
        $stmt = $pdo->prepare("INSERT INTO classes (name) VALUES (?)");
        $stmt->execute([$name]);
    } elseif (isset($_POST['delete_class_id'])) {
        $class_id = $_POST['delete_class_id'];
        $stmt = $pdo->prepare("DELETE FROM classes WHERE class_id = ?");
        $stmt->execute([$class_id]);
    }
    header('Location: classes.php');
    exit;
}

// Fetch all classes
$query = "SELECT * FROM classes";
$stmt = $pdo->query($query);
$classes = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Manage Classes</title>
</head>
<body>
    <h1>Classes</h1>
    <table border="1">
        <thead>
            <tr>
                <th>Class Name</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($classes as $class): ?>
                <tr>
                    <td><?= $class['name'] ?></td>
                    <td>
                        <form action="" method="post" style="display:inline;">
                            <input type="hidden" name="delete_class_id" value="<?= $class['class_id'] ?>">
                            <input type="submit" value="Delete">
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <h2>Add New Class</h2>
    <form action="" method="post">
        <label for="name">Class Name:</label>
        <input type="text" name="name" required><br>
        <input type="submit" value="Add Class">
    </form>

    <a href="index.php">Back to Home</a>
</body>
</html>
