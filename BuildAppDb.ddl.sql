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
  forumID int NOT NULL,
  details TEXT NOT NULL,
  asked DATETIME NOT NULL DEFAULT NOW(),
  author TEXT,
  CONSTRAINT Question_questionID_pk PRIMARY KEY (questionID),
  CONSTRAINT Question_forumID_fk FOREIGN KEY (forumID) REFERENCES classforum (forumID)
);

CREATE TABLE answer
(
  answerID INT NOT NULL AUTO_INCREMENT,
  questionID int NOT NULL,
  answer TEXT NOT NULL,
  answered DATETIME NOT NULL DEFAULT NOW(),
  author TEXT,
  CONSTRAINT Answer_answerID_pk PRIMARY KEY (answerID),
  CONSTRAINT Answer_questionID_fk FOREIGN KEY (questionID) REFERENCES question (questionID)
);

/* Test data Geoffrey used for forum loading */
INSERT INTO classforum (className)
	VALUES ('CS101'),
	('CS247'),
	('CS361');
	
INSERT INTO question (forumID, details, asked, author)
	VALUES (1, 'I can not get my computer turned on!',NOW(),'Script Kiddie'),
	(1, 'I do not know what computer science is!',NOW(),'Script Kiddie'),
	(1, 'How do I access my JMU email!',NOW(),'Script Kiddie'),
	(2, 'What is Java even? Coffee!?!?',NOW(),'Script Kiddie'),
	(2, 'My IDE is not checkstyling correctly!',NOW(),'Script Kiddie'),
	(3, 'When do I graduate?',NOW(),'Script Kiddie');
	
INSERT INTO answer (questionID, answer, answered, author)
	VALUES ('1', 'Is your computer plugged in?', NOW(), 'CS Senior'),
	(1, 'You probably got a virus that killed your HD.', NOW(), 'CS Senior'),
	(2, 'It seems your major is in another castle.', NOW(), 'CS Senior'),
	(3, 'Go to Microsoft Outlook and enter your details.', NOW(), 'CS Senior'),
	(5, 'Then you should probably go see another styleist.', NOW(), 'CS Senior'),
	(6, 'No one ever really graduates. We just tell ourselves we did as we look for work.', NOW(), 'CS Senior');