DROP DATABASE IF EXISTS App_Database;
CREATE DATABASE IF NOT EXISTS App_Database;
USE App_Database;

/*CREATE TABLES FOR DATABASE*/
CREATE TABLE ClassForum
(
  forumID INT NOT NULL AUTO_INCREMENT,
  className TEXT NOT NULL,
  CONSTRAINT ClassForum_ForumID_pk PRIMARY KEY (forumID)
);

CREATE TABLE Question
(
  questionID INT NOT NULL AUTO_INCREMENT,
  forumID int NOT NULL,
  details TEXT NOT NULL,
  asked DATETIME NOT NULL DEFAULT NOW(),
  author TEXT,
  CONSTRAINT Question_questionID_pk PRIMARY KEY (questionID),
  CONSTRAINT Question_forumID_fk FOREIGN KEY (forumID) REFERENCES ClassForum (forumID)
);

CREATE TABLE Answer
(
  answerID INT NOT NULL AUTO_INCREMENT,
  questionID int NOT NULL,
  answer TEXT NOT NULL,
  answered DATETIME NOT NULL DEFAULT NOW(),
  author TEXT,
  CONSTRAINT Answer_answerID_pk PRIMARY KEY (answerID),
  CONSTRAINT Answer_questionID_fk FOREIGN KEY (questionID) REFERENCES Question (questionID)
);