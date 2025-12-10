-- quiz_db.sql
CREATE DATABASE IF NOT EXISTS quiz_db;
USE quiz_db;

CREATE TABLE IF NOT EXISTS questions (
  id INT AUTO_INCREMENT PRIMARY KEY,
  question TEXT NOT NULL,
  option1 VARCHAR(255) NOT NULL,
  option2 VARCHAR(255) NOT NULL,
  option3 VARCHAR(255) NOT NULL,
  option4 VARCHAR(255) NOT NULL,
  correct_option TINYINT NOT NULL COMMENT '1..4',
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- sample questions
INSERT INTO questions (question, option1, option2, option3, option4, correct_option) VALUES
('Which language runs in a web browser?', 'Java', 'C', 'JavaScript', 'Python', 3),
('What does CSS stand for?', 'Cascading Style Sheets', 'Computer Style Sheets', 'Creative Style System', 'Colorful Style Sheet', 1),
('Which HTML tag is used for the largest heading?', '<h6>', '<h1>', '<head>', '<heading>', 2);
