<?php
require_once '../db.php';
$result = $mysqli->query("SELECT * FROM questions ORDER BY created_at DESC");
?>
<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <title>Admin - View Questions</title>
  <link rel="stylesheet" href="../css/style.css">
</head>
<body class="page-admin">
  <div class="container">
    <h2>All Questions</h2>
    <p><a href="add_question.php">Add new</a> | <a href="../index.php">Go to Quiz</a></p>
    <table class="questions">
      <thead>
        <tr><th>#</th><th>Question</th><th>Options</th><th>Correct</th><th>Action</th></tr>
      </thead>
      <tbody>
      <?php while ($row = $result->fetch_assoc()): ?>
        <tr>
          <td><?=htmlspecialchars($row['id'])?></td>
          <td><?=nl2br(htmlspecialchars($row['question']))?></td>
          <td>
            1) <?=htmlspecialchars($row['option1'])?><br>
            2) <?=htmlspecialchars($row['option2'])?><br>
            3) <?=htmlspecialchars($row['option3'])?><br>
            4) <?=htmlspecialchars($row['option4'])?>
          </td>
          <td><?=htmlspecialchars($row['correct_option'])?></td>
          <td><a href="delete_question.php?id=<?= $row['id'] ?>" onclick="return confirm('Delete this?')">Delete</a></td>
        </tr>
      <?php endwhile; ?>
      </tbody>
    </table>
  </div>
</body>
</html>
