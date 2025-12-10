<?php
require_once '../db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $question = trim($_POST['question']);
    $opt1 = trim($_POST['option1']);
    $opt2 = trim($_POST['option2']);
    $opt3 = trim($_POST['option3']);
    $opt4 = trim($_POST['option4']);
    $correct = (int)$_POST['correct_option'];

    if ($question && $opt1 && $opt2 && $opt3 && $opt4 && in_array($correct, [1,2,3,4])) {
        $stmt = $mysqli->prepare("INSERT INTO questions (question, option1, option2, option3, option4, correct_option) VALUES (?, ?, ?, ?, ?, ?)");
        $stmt->bind_param("sssssi", $question, $opt1, $opt2, $opt3, $opt4, $correct);
        $stmt->execute();
        $stmt->close();
        $msg = "Question added successfully.";
    } else {
        $msg = "Please fill all fields correctly.";
    }
}
?>
<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <title>Admin - Add Question</title>
  <link rel="stylesheet" href="../css/style.css">
</head>
<body class="page-admin">
  <div class="container">
    <h2>Add Question</h2>
    <?php if (!empty($msg)) echo "<p class='info'>$msg</p>"; ?>
    <form method="post">
      <label>Question</label>
      <textarea name="question" required></textarea>
      <label>Option 1</label>
      <input type="text" name="option1" required>
      <label>Option 2</label>
      <input type="text" name="option2" required>
      <label>Option 3</label>
      <input type="text" name="option3" required>
      <label>Option 4</label>
      <input type="text" name="option4" required>
      <label>Correct Option (1-4)</label>
      <input type="number" name="correct_option" min="1" max="4" required>
      <button type="submit">Add Question</button>
    </form>
    <p><a href="view_questions.php">View all questions</a> | <a href="../index.php">Go to Quiz</a></p>
  </div>
</body>
</html>
