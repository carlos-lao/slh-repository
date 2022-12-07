# slh-repository
#### CSCI 401 Group 10 Project
***Group Members:***
- Carlos Lao
- Desiree Khoo
- Jaylen Jackson
- Joe Mulholland
- Sophia Kawaguchi

## Table of Contents
1. [Running the Software](#running-the-software)
2. [Operating Instructions](#operating-instructions)
3. [Database Guide](#database-guide)
  3.1. [User Attributes](#user-attributes)
  3.2. [Post Attributes](#post-attributes)
4. [Support](#support)

## Running the Software

To run the software, you will need to download [MySQL Workbench](https://dev.mysql.com/downloads/workbench/) and [MAMP](https://www.mamp.info/en/downloads/). The relevant pages have been hyperlinked.

MySQL Workbench has been confirmed to work on Version 5.7.24.
MAMP has been confirmed to work on Version 5.0.0.
Additionally, PHP should be Version 8.0.1, and Java should be Version 19. 

If you are encountering any problems with getting the code to work, please make sure that you are using the correct versions that we have above, in case anything has been deprecated in the time since we have completed this project.

MySQL Workbench is currently being used for running the database, and MAMP is being used for running the PHP pages and getting access to myphpadmin. myphpadmin is an administrative tool to be able to perform administrative tasks on the SQL database.
Within MySQL Workbench, make sure that you are running on localhost, with port number 8889 (localhost:8889). You will want to set up a new connect, and upload the database that is on our Github repository, or your own! Currently, due to the sensitive medical information that the database stores, the information that we have is dummy data and is not part of any real person’s information.

Within MAMP, you should be using Apache Port 8888, Nginx Port 7888, and MySQL Port 8889. “Set Web & MAMP ports to:” should be the MAMP default, and 80 % 3306. These can all be found and changed within the Ports tab of Preferences. 

At this point, the project should be ready to be run like any locally hosted piece of software.

## Operating Instructions

As the project information says, this project was created to function as a repository for students to upload information that they wish about drug and alcohol abuse. The project supports many types of files, such as audio, video, photo, and text.

Login/signup should be done with USC information. We wanted to avoid using the USC single-sign-on (SSO) – instead our goal was to create a sign up experience which required users to validate their USC email by sending an email to the email address used to sign up with a validation code and storing the user’s password and email within our system.

There are 3 different types of roles that accounts can have upon login – students, moderators, and admins – each which inherit the abilities of the previously mentioned roles. Students will only be able to upload or edit their information. Moderators have the ability to change any information, prevent a student from continuing to edit their information Admins have the same abilties as moderators, in addition to being able to alter a users’ powers and abilities within the application.

Within the dashboard, users have the ability to choose to view information, upload information, perform any other function of the software within their browser. Within each individual page, buttons should make it clear as to how to go about performing an individual task, such as performing a search, uploading a PDF, or anything else.

## Database Guide

### User Attributes
***`accessLevel` Attribute*** _(i.e., user access level)_
- 0 = normal user
- 1 = moderator
- 2 = admin

### Post Attributes
***`locked` Attribute*** _(i.e., whether or not a post can be edited by a student user)_
- 1 = locked
- 0 = unlocked

***Media Types*** _(note that media tags are stored as a string of digits under `mediaType`)_
- 1 = pdf
- 2 = image
- 3 = video
- 4 = audio

***Sample `tags` JSON Attribute*** <br>
`{"tags": ["Under 21", "Testing", "Los Angeles"]}`

***Sample `content` JSON Attribute*** <br>
`["post1.pdf", "filename.pdf"]`

## Support
If anyone has any problems while trying to do anything, please do not hesitate to contact Joe at [jmulholl@usc.edu](mailto:jmulholl@usc.edu); he will attempt to redirect emails from this address post-graduation but, in the event that he do not reply within a few days, please reach out to him at [philliesjoe7@gmail.com](mailto:philliesjoe7@gmail.com). Additionally, feel free to contact the owner of this repository at one of the following emails: [crlao@usc.edu](mailto:crlao@usc.edu), [cdrivlao@gmail.com](mailto:cdrivlao@gmail.com), or [cdrlao28@gmail.com](mailto:cdrlao28@gmail.com).
