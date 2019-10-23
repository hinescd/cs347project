This git repository contains source code for our CS 347 Full Stack Web Development project.

Authors: Charlie Hines, Rob Verdisco, Taylour Davis, Geoffrey Wright

Below is the project overview:

# Overview

This web application seeks to meet the needs of the James Madison University’s TA (Teacher Assistant) program. Upon completion of this project the web application will provide the functionality described within this document. In summary, program managers will be able to add/remove TA’s from the system, update semesters, approve TA covers. TA’s will have the ability to add and remove TA sessions with students and request covers for their times. Standard end-users will be able to ask anonymous(?) questions to be answered, request times for assistance and view scheduled TA hours. Also for those managing the software data analytics will be collected for further use.

# Features

## Required

* Onboarding
  * Roles:
    * TA (Can see names on calendar, request covers, sign up to fill a requested cover)
    * Manager (Can add new TAs, define semesters, schedule shifts, approve covers)
  * Register with system
    * Name
    * Email
  * Solicit preferences
    * Scheduling
    * Courses
    * Min/max hrs/wk?
* Login
  * Based on info from registration
* Define Semester
  * Set TA lab dates/hours
* Manually Schedule Semester
  * Give Manager a UI:
    * Looking at capabilities, preferences, semester definition
* Swap duties
  * Request a cover
  * Queue potential cover-ers
  * Manager approval of a cover makes it official
* Show calendar
  * Different views: public doesn’t show TA names
* Collect data
  * Student sign in to office hours
## Additional
* Showing TA arrival/departure times on calendar
* (Anonymous?) question board
* Email notifications for cover approvals
* Dark mode toggle

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
