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
  CONSTRAINT Shift_taID_fk FOREIGN KEY (taID) REFERENCES person (personID)
);

CREATE TABLE cover
(
  shiftID INT NOT NULL,
  covererID INT NOT NULL,
  approvedBy INT,
  CONSTRAINT Cover_shiftIDcovererID_pk PRIMARY KEY (shiftID, covererID),
  CONSTRAINT Cover_shiftID_fk FOREIGN KEY (shiftID) REFERENCES shift (shiftID),
  CONSTRAINT Cover_covererID FOREIGN KEY (covererID) REFERENCES person (personID),
  CONSTRAINT Cover_approvedBy FOREIGN KEY (approvedBy) REFERENCES person (personID)
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
  VALUES ('Charlie Hines', 'hinescd@dukes.jmu.edu', 'TA', 'CS159', 'I''m literally never available.');