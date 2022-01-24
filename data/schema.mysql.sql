CREATE DATABASE beejee_tasks;

CREATE TABLE `user` (
  `id` INT PRIMARY KEY AUTO_INCREMENT,
  `username` VARCHAR(255) UNIQUE NOT NULL,
  `password` VARCHAR(255) NOT NULL,
  `is_admin` BOOLEAN NOT NULL DEFAULT false
);

CREATE TABLE `task` (
  `id` INT PRIMARY KEY AUTO_INCREMENT,
  `username` VARCHAR(255) NOT NULL,
  `email` VARCHAR(255) NOT NULL,
  `text` TEXT NOT NULL,
  `status` VARCHAR(255) NOT NULL,
  `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_text_at` TIMESTAMP NULL
);

INSERT INTO user (`username`, `password`, `is_admin`)
VALUES ('admin', '123', true);

INSERT INTO user (`username`, `password`, `is_admin`)
VALUES ('user_1', 'user_1', false);

INSERT INTO task (`username`, `email`, `text`, `status`)
VALUES ('student_1', 'student_1@example.com', 'text', 'Completed');

INSERT INTO task (`username`, `email`, `text`, `status`)
VALUES ('student_2', '2_student_2@example.com', 'text2', 'In progress');

INSERT INTO task (`username`, `email`, `text`, `status`)
VALUES ('3_student', 'student_3@example.com', 'text3', 'Completed');

INSERT INTO task (`username`, `email`, `text`, `status`)
VALUES ('student_4', '3_student_4@example.com', 'text3', 'Completed');

INSERT INTO task (`username`, `email`, `text`, `status`)
VALUES ('z_student_5', 'student_5@example.com', 'text3', 'Completed');

INSERT INTO task (`username`, `email`, `text`, `status`)
VALUES ('a_student_6', 'z_student_6@example.com', 'text3', 'In progress');

INSERT INTO task (`username`, `email`, `text`, `status`)
VALUES ('student_7', 'a_student_7@example.com', 'text3', 'Completed');
