<?php
require_once 'db.php';

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header('Location: index.php');
    exit;
}

$answers = $_POST['answer'] ?? [];
$total = 0;
$correct = 0;
$wrong = 0;
$unanswered = 0;

// fetch relevant questions to compare
$ids = array_keys($answers);
if (count($ids) === 0) {
    // user submitted nothing — still show zero result
    $questionsRes = $mysqli->query("SELECT * FROM questions");
} else {
    // safe: build comma separated ints
    $ids_clean = array_map('intval', $ids);
    $id_list = implode(',', $ids_clean);
    $questionsRes = $mysqli->query("SELECT * FROM questions WHERE id IN ($id_list)");
}

$allQuestions = [];
while ($row = $questionsRes->fetch_assoc()) {
    $allQuestions[$row['id']] = $row;
}

foreach ($allQuestions as $id => $row) {
    $total++;
    if (!isset($answers[$id])) {
        $unanswered++;
        continue;
    }
    $selected = (int)$answers[$id];
    if ($selected === (int)$row['correct_option']) $correct++;
    else $wrong++;
}

// If there are questions not in $allQuestions (maybe because no answers), count them too:
if ($total === 0) {
    // fallback: count all questions in DB
    $res = $mysqli->query("SELECT COUNT(*) as cnt FROM questions");
    $r = $res->fetch_assoc();
    $total = (int)$r['cnt'];
    $unanswered = $total - ($correct + $wrong);
}
$score = $correct; // or calculate percent
$percent = $total ? round(($correct/$total)*100, 2) : 0;
?>
<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <title>Quiz Result</title>
  <link rel="stylesheet" href="css/style.css">
</head>
<body>
  <div class="container">
    <h2>Your Result</h2>
    <p>Total Questions: <strong><?= $total ?></strong></p>
    <p>Correct: <strong><?= $correct ?></strong></p>
    <p>Wrong: <strong><?= $wrong ?></strong></p>
    <p>Unanswered: <strong><?= $unanswered ?></strong></p>
    <p>Score: <strong><?= $score ?></strong> / <?= $total ?> (<?= $percent ?> %)</p>
    <a class="btn" href="quiz.php">Try Again</a> &nbsp; <a href="index.php">Home</a>
  </div>
</body>
</html>
