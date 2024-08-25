CREATE DATABASE DailyZen;
use DailyZen;
DROP DATABASE DailyZen;

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
	email VARCHAR(100) NOT NULL UNIQUE,
    first_name VARCHAR(50),
    last_name VARCHAR(50),
    password VARCHAR(255) NOT NULL
);

CREATE TABLE user_daily_scores (
    id INT NOT NULL AUTO_INCREMENT,
    user_id INT NOT NULL,
    score_date DATE NOT NULL,
    happiness TINYINT NOT NULL CHECK (happiness BETWEEN 1 AND 5),
	workload_management TINYINT NOT NULL CHECK (workload_management BETWEEN 1 AND 5),
    anxiety_management TINYINT NOT NULL CHECK (anxiety_management BETWEEN 1 AND 5),
	CONSTRAINT pri_rating PRIMARY KEY(id),
    CONSTRAINT fork_user FOREIGN KEY (user_id)
    REFERENCES users(id) ON UPDATE CASCADE ON DELETE CASCADE
);

drop table users;
drop table user_daily_scores;

SELECT * FROM users;
SELECT * FROM user_daily_scores;

INSERT INTO user_daily_scores (user_id, score_date, happiness, workload_management, anxiety_management) VALUES
(1, '2024-08-01', 4, 2, 3),
(1, '2024-08-02', 3, 3, 2),
(1, '2024-08-03', 5, 1, 4),
(1, '2024-08-04', 4, 2, 3),
(1, '2024-08-05', 3, 3, 2),
(1, '2024-08-06', 4, 2, 3),
(1, '2024-08-07', 5, 1, 4),
(1, '2024-08-08', 3, 3, 2),
(1, '2024-08-09', 4, 2, 3),
(1, '2024-08-10', 5, 1, 4),
(1, '2024-08-11', 4, 2, 3),
(1, '2024-08-12', 3, 3, 2),
(1, '2024-08-13', 4, 2, 3),
(1, '2024-08-14', 5, 1, 4),
(1, '2024-08-15', 3, 3, 2),
(1, '2024-08-16', 4, 2, 3),
(1, '2024-08-17', 5, 1, 4),
(1, '2024-08-18', 3, 3, 2),
(1, '2024-08-19', 4, 2, 3),
(1, '2024-08-20', 5, 1, 4),
(1, '2024-08-21', 4, 2, 3),
(1, '2024-08-22', 3, 3, 2),
(1, '2024-08-23', 4, 2, 3),
(1, '2024-08-24', 5, 1, 4);

DELETE FROM user_daily_scores
WHERE user_id = 1
AND score_date BETWEEN '2024-08-01' AND '2024-08-31';

SELECT * FROM user_daily_scores WHERE user_id = 1 AND score_date=curdate();

