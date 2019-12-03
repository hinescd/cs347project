DROP DATABASE IF EXISTS App_Database;
CREATE DATABASE IF NOT EXISTS App_Database;
CREATE USER IF NOT EXISTS 'app_db_user'@'localhost' identified by 'securepassword';
GRANT ALL PRIVILEGES ON App_Database.* TO 'app_db_user'@'localhost';
USE App_Database;

/*CREATE TABLES FOR DATABASE*/
CREATE TABLE classforum
(
  forumID INT NOT NULL AUTO_INCREMENT,
  className TEXT NOT NULL,
  CONSTRAINT ClassForum_ForumID_pk PRIMARY KEY (forumID)
);

CREATE TABLE question
(
  questionID INT NOT NULL AUTO_INCREMENT,
  forumID INT NOT NULL,
  title TEXT NOT NULL,
  details TEXT NOT NULL,
  asked DATETIME NOT NULL DEFAULT NOW(),
  author TEXT,
  CONSTRAINT Question_questionID_pk PRIMARY KEY (questionID),
  CONSTRAINT Question_forumID_fk FOREIGN KEY (forumID) REFERENCES classforum (forumID)
);

CREATE TABLE answer
(
  answerID INT NOT NULL AUTO_INCREMENT,
  questionID INT NOT NULL,
  answer TEXT NOT NULL,
  answered DATETIME NOT NULL DEFAULT NOW(),
  author TEXT,
  CONSTRAINT Answer_answerID_pk PRIMARY KEY (answerID),
  CONSTRAINT Answer_questionID_fk FOREIGN KEY (questionID) REFERENCES question (questionID)
);

CREATE TABLE person
(
  personID INT NOT NULL AUTO_INCREMENT,
  name TEXT NOT NULL,
  email TEXT NOT NULL,
  role TEXT NOT NULL,
  class TEXT,
  availability TEXT,
  password_hash TEXT,
  CONSTRAINT Person_personID_pk PRIMARY KEY (personID)
);

CREATE TABLE semester
(
  semesterID INT NOT NULL AUTO_INCREMENT,
  start DATETIME NOT NULL,
  end DATETIME NOT NULL,
  CONSTRAINT Semester_semesterID_pk PRIMARY KEY (semesterID)
);

CREATE TABLE shift
(
  shiftID INT NOT NULL AUTO_INCREMENT,
  taID INT NOT NULL,
  semesterID INT NOT NULL,
  start DATETIME NOT NULL,
  end DATETIME NOT NULL,
  cover_requested BOOLEAN NOT NULL DEFAULT 0,
  CONSTRAINT Shift_shiftID_pk PRIMARY KEY (shiftID),
  CONSTRAINT Shift_taID_fk FOREIGN KEY (taID) REFERENCES person (personID) ON DELETE CASCADE
);

CREATE TABLE cover
(
  shiftID INT NOT NULL,
  covererID INT NOT NULL,
  approvedBy INT,
  CONSTRAINT Cover_shiftIDcovererID_pk PRIMARY KEY (shiftID, covererID),
  CONSTRAINT Cover_shiftID_fk FOREIGN KEY (shiftID) REFERENCES shift (shiftID),
  CONSTRAINT Cover_covererID FOREIGN KEY (covererID) REFERENCES person (personID) ON DELETE CASCADE,
  CONSTRAINT Cover_approvedBy FOREIGN KEY (approvedBy) REFERENCES person (personID) ON DELETE CASCADE
);

INSERT INTO classforum (className)
	VALUES ('CS101'),
	('CS247'),
	('CS361');
	
INSERT INTO question (forumID, title, details, asked, author)
	VALUES (1, 'Computer Problems!', 'I can not get my computer turned on!',NOW(),'Script Kiddie'),
	(1, 'What is this major?', 'I do not know what computer science is!',NOW(),'Script Kiddie'),
	(1, 'Email problems!', 'How do I access my JMU email!',NOW(),'Script Kiddie'),
	(2, 'Java!?!?', 'What is Java even? Coffee!?!?',NOW(),'Script Kiddie'),
	(2, 'Checkstyle issues...', 'My IDE is not checkstyling correctly!',NOW(),'Script Kiddie'),
	(3, 'I want to get out of here!', 'When do I graduate?',NOW(),'Script Kiddie');
	
INSERT INTO answer (questionID, answer, answered, author)
	VALUES (1, 'Is your computer plugged in?', NOW(), 'CS Senior'),
	(1, 'You probably got a virus that killed your HD.', NOW(), 'CS Senior'),
	(2, 'It seems your major is in another castle.', NOW(), 'CS Senior'),
	(3, 'Go to Microsoft Outlook and enter your details.', NOW(), 'CS Senior'),
	(5, 'Then you should probably go see another styleist.', NOW(), 'CS Senior'),
	(6, 'No one ever really graduates. We just tell ourselves we did as we look for work.', NOW(), 'CS Senior');

INSERT INTO person (name, email, role, class, availability)
  VALUES ('Charlie Hines', 'hinescd@dukes.jmu.edu', 'TA', 'CS159', 'I''m literally never available.'),
  ('John Doe', 'someta@ta.com', 'TA', 'CS240', 'Unavailable wednesdays'),
  ('Jane Doe', 'jane@doe.com', 'TA', 'CS149', 'I can''t work before noon ever'),
  ('Master Manager', 'manager@manager.com', 'MANAGER', NULL, NULL);

INSERT INTO semester (start, end)
  VALUES ('2019-08-26', '2019-12-13');

INSERT INTO shift (taID, semesterID, start, end, cover_requested)
  VALUES (1, 1, '2019-11-01 21:00', '2019-11-01 23:00', 0),
  (1, 1, '2019-11-08 21:00', '2019-11-08 23:00', 0),
  (1, 1, '2019-11-15 21:00', '2019-11-15 23:00', 1),
  (1, 1, '2019-11-22 21:00', '2019-11-22 23:00', 0),
  (1, 1, '2019-11-29 21:00', '2019-11-29 23:00', 0),
  (1, 1, '2019-11-05 21:00', '2019-11-05 23:00', 0),
  (1, 1, '2019-11-12 21:00', '2019-11-12 23:00', 0),
  (1, 1, '2019-11-19 21:00', '2019-11-19 23:00', 0),
  (1, 1, '2019-11-26 21:00', '2019-11-26 23:00', 0),
  (2, 1, '2019-11-04 17:00', '2019-11-03 20:00', 0),
  (2, 1, '2019-11-11 17:00', '2019-11-10 20:00', 0),
  (2, 1, '2019-11-18 17:00', '2019-11-17 20:00', 0),
  (2, 1, '2019-11-25 17:00', '2019-11-24 20:00', 0),
  (2, 1, '2019-11-07 17:00', '2019-11-07 20:00', 0),
  (2, 1, '2019-11-14 17:00', '2019-11-14 20:00', 0),
  (2, 1, '2019-11-21 17:00', '2019-11-21 20:00', 0),
  (2, 1, '2019-11-28 17:00', '2019-11-28 20:00', 0),
  (3, 1, '2019-11-06 17:00', '2019-11-06 20:00', 0),
  (3, 1, '2019-11-13 17:00', '2019-11-13 20:00', 0),
  (3, 1, '2019-11-20 17:00', '2019-11-20 20:00', 0),
  (3, 1, '2019-11-27 17:00', '2019-11-27 20:00', 0),
  (1, 1, '2019-12-02 21:00', '2019-12-02 23:00', 0),
  (1, 1, '2019-12-09 21:00', '2019-12-09 23:00', 0),
  (1, 1, '2019-12-16 21:00', '2019-12-16 23:00', 0),
  (1, 1, '2019-12-23 21:00', '2019-12-23 23:00', 0),
  (1, 1, '2019-12-30 21:00', '2019-12-30 23:00', 0),
  (1, 1, '2019-12-05 21:00', '2019-12-05 23:00', 0),
  (1, 1, '2019-12-12 21:00', '2019-12-12 23:00', 0),
  (1, 1, '2019-12-19 21:00', '2019-12-19 23:00', 0),
  (1, 1, '2019-12-26 21:00', '2019-12-26 23:00', 0),
  (2, 1, '2019-12-04 17:00', '2019-12-03 20:00', 0),
  (2, 1, '2019-12-11 17:00', '2019-12-10 20:00', 0),
  (2, 1, '2019-12-18 17:00', '2019-12-17 20:00', 0),
  (2, 1, '2019-12-25 17:00', '2019-12-24 20:00', 0),
  (2, 1, '2019-12-06 17:00', '2019-12-06 20:00', 0),
  (2, 1, '2019-12-13 17:00', '2019-12-13 20:00', 0),
  (2, 1, '2019-12-20 17:00', '2019-12-20 20:00', 0),
  (2, 1, '2019-12-27 17:00', '2019-12-27 20:00', 0),
  (3, 1, '2019-12-06 17:00', '2019-12-06 20:00', 0),
  (3, 1, '2019-12-13 17:00', '2019-12-13 20:00', 0),
  (3, 1, '2019-12-20 17:00', '2019-12-20 20:00', 0),
  (3, 1, '2019-12-27 17:00', '2019-12-27 20:00', 0);

INSERT INTO cover (shiftID, covererID, approvedBy)
  VALUES (3, 2, 4),
  (3, 3, NULL);
