<?php
require_once 'db.php';
$q = $mysqli->query("SELECT * FROM questions ORDER BY id ASC");
$questions = $q->fetch_all(MYSQLI_ASSOC);
if (!$questions) {
    die("No questions found. Please add some via admin panel.");
}
?>
<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <title>Quiz</title>
  <link rel="stylesheet" href="css/style.css">
  <script src="js/script.js" defer></script>
</head>
<body>
  <div class="container">
    <h2>Quiz</h2>
    <form id="quizForm" method="post" action="submit.php">
      <?php foreach ($questions as $index => $row): ?>
        <div class="question-block">
          <p class="qno">Q<?= $index+1 ?>. <?= nl2br(htmlspecialchars($row['question'])) ?></p>
          <div class="options">
            <label><input type="radio" name="answer[<?= $row['id'] ?>]" value="1"> <?= htmlspecialchars($row['option1']) ?></label><br>
            <label><input type="radio" name="answer[<?= $row['id'] ?>]" value="2"> <?= htmlspecialchars($row['option2']) ?></label><br>
            <label><input type="radio" name="answer[<?= $row['id'] ?>]" value="3"> <?= htmlspecialchars($row['option3']) ?></label><br>
            <label><input type="radio" name="answer[<?= $row['id'] ?>]" value="4"> <?= htmlspecialchars($row['option4']) ?></label>
          </div>
        </div>
      <?php endforeach; ?>
      <button type="submit" class="btn">Submit Answers</button>
    </form>
    <p><a href="index.php">Back to home</a></p>
  </div>
</body>
</html>
