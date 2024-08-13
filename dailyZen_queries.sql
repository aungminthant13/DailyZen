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
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    score_date DATE NOT NULL,
    happiness_score INT CHECK (happiness_score BETWEEN 1 AND 5),
    anxiety_score INT CHECK (anxiety_score BETWEEN 1 AND 5),
    workload_score INT CHECK (workload_score BETWEEN 1 AND 5),
    FOREIGN KEY (user_id) REFERENCES users(id)
);

drop table users;
drop table user_daily_scores;

SELECT * FROM users;
SELECT * FROM user_daily_scores;




