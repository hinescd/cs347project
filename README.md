This git repository contains source code for our CS 347 Full Stack Web Development project.

Authors: Charlie Hines, Rob Verdisco, Taylour Davis, Geoffrey Wright

Below is the project overview:

# Overview

This web application seeks to meet the needs of the James Madison University’s TA (Teacher Assistant) program. Upon completion of this project the web application will provide the functionality described within this document. In summary, program managers will be able to add/remove TA’s from the system, update semesters, approve TA covers. TA’s will have the ability to add and remove TA sessions with students and request covers for their times. Standard end-users will be able to ask anonymous(?) questions to be answered, request times for assistance and view scheduled TA hours. Also for those managing the software data analytics will be collected for further use.

# How to run and other quirks of this project

This project was not deloyed to a remote system. Doing so should not be too complicated, however this project was created, tested, and run using XAMMP suite of tools run locally.

Included in this project directory is a ddl.sql file titled "BuildAppDb" with XAMMP installed this ddl file needs to be dropped into the XAMMP directory and "sourced" via MySQL console or, if the function exists in phpMyAdmin, phpMyAdmin. This will construct the database with the required structure and insert test data and users. Finally in the XAMPP directory the httpd.conf file will need to be modified to make the server root point to the project directory.

With these things in place you should be able to bring up a web-browser and enter "localhost" to be directed to the web application.

# Features

## Required

* Onboarding
  * Roles:
    * TA (Can see names on calendar, request covers, sign up to fill a requested cover) **completed**
    * Manager (Can add new TAs, define semesters, schedule shifts, approve covers) **completed**
  * Register with system
    * Name **completed**
    * Email **completed**
  * Solicit preferences
    * Scheduling **unimplemented**
    * Courses **completed**
    * Min/max hrs/wk? **unimplemented**
* Login
  * Based on info from registration **completed**
* Define Semester
  * Set TA lab dates/hours **completed**
* Manually Schedule Semester
  * Give Manager a UI: **completed**
    * Looking at capabilities, preferences, semester definition
* Swap duties
  * Request a cover **completed**
  * Queue potential cover-ers **completed**
  * Manager approval of a cover makes it official **completed**
* Show calendar
  * Different views: public doesn’t show TA names **completed**
* Collect data
  * Student sign in to office hours **completed**
## Additional
* Showing TA arrival/departure times on calendar **completed**
* (Anonymous?) question board **completed**
* Email notifications for cover approvals **unimplemented**
* Dark mode toggle **completed**

# Plan
* Milestone 1 (Oct 24)
  * Design of pages and flow on paper
    * Include user interactions
    * Main page calendar
    * Login modal window for TA, manager
    * Question board page/modal
    * Cover requests page/modal
    * TA onboarding page/modal
    * Scheduling page/modal
    * Help page/modal
  * Work breakup: we all meet together and agree on designs
* Milestone 2 (Oct 31)
  * Static HTML & CSS (bootstrap) for each page
    * Work can be divided by page
* Milestone 3 (Nov 7)
  * JavaScript
    * Form validation
      * Question board (Taylour Davis)
      * TA onboarding (Robert Verdisco)
      * Cover requests (Robert Verdisco)
    * Dark mode toggle (Geoffrey)
  * Database design (Charlie)
    * Login info, schedule info, cover info, questions, question answers
* Milestone 4 (Nov 14)
  * PHP interaction with database
    * Ensure users only have access to pages appropriate for their role (Robert Verdisco)
    * Populate calendar based on scheduling and cover info from database (Charlie)
    * Scheduling page should add/delete/modify information in the schedule table (Geoffrey)
    * TAs should be able to create and delete cover requests (cannot delete if a cover has already been approved) (Taylour Davis)
    * Question board should read from/write to questions & answers tables (Taylour Davis)
* Final deliverable (Dec 2)
  * Fixing stuff up
    * Whatever isn’t finished from previous milestones (there’ll probably be a decent amount left from milestone 4 in particular)

# Questions/Research
* Login validation
* Do we want students to be able to answer questions on the question board?
* Geoffrey Wright (look into industry standard colors that meet accessibility standards.)
* Taylour Davis (Learn BootStrap)
* Do we want a single-page webapp or multiple pages?
* Robert Verdisco (Look into website interaction with databases)
* Learn PHP(Everyone)

# SUMMARY OF COMPLETION
As in all things design there were questions and design changes throughout our project process. This led to certain features being dropped,
unimplemented, or implemented in ways that were not original to the plan. Some of these features include:

* The forum being uncoupled from the landing page. It was discovered that this caused problems in the implementation of the home page.
Specifically the handling of the loading of the forum from within another webpage. The forum was decoupled, but legacy design flaws still
shine through. Given time it would be benificial to create "forumindex.php", "classpage.php", "forumpage.php", and "searchpage.php" templates
that could navigate and reload on an individual basis.
* Notification via email was scrapped as challenges that were presented in implementing other functions were deemed more pressing.
* In the "solicit preferences" section, shecduling and min/max hours a week were not implemented only in that managers set scheduals for TAs
This puts the onace on the Managers to add schedualed hours to the system that meet TA preferences.