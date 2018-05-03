# 3380-Final-Project
---
* List of Group Members
* Sara Caponi
* Kate Gardner
* Erika Eckfeld
---
### Link to project 
* URL: http://saracaponi.epizy.com/FinalProject.php
---
### Description Of Application

Our application is created for MU students to easily find events going on around campus.  The user can sign up for an account to login to their personal portal for events that can be selected. A list of events going around campus will be easily viewed and the user can select the events they are interested to be bookmarked into "their events". The events can be deleted and added as the user pleases to personalize their own scheudle. The purpose of the application is to be like a virutal collaborative planner for students to interact with their colleages. 

---
### Database Schema

CREATE TABLE Events(  
id INT NOT NULL AUTO_INCREMENT PRIMARY,  
orginization varchar(200) NOT NULL,  
event varchar(200) NOT NULL,  
description mediumtext,  
location varchar(200) NOT NULL,  
whatTime DATETIME NOT NULL  
);  

CREATE TABLE rsvpEvent(  
id INT NOT NULL AUTO_INCREMENT PRIMARY,  
userID INT NOT NULL,  
eventID INT NOT NULL  
);  

CREATE TABLE users(  
id INT NOT NULL AUTO_INCREMENT PRIMARY,  
username varchar(200) NOT NULL,  
password varchar(200) NOT NULL,  
loggedIn char(2) NOT NULL  
);  


---

### ERD for the database

![ERD](https://raw.githubusercontent.com/SaraCaponi/3380-Final-Projet/master/erdPhoto.png)




---

### Create, Read, Update, Delete

* Create: Creation is implemented when the user signs up for an account and is put in a database. Also, when you add an event to your events you create a record in RSVP event. (newUser.php line 24, fallSemester.php line 43)
* Read: When you view your personal events of view the calender. (fallSemester.php line 14, myEvents.php line12)
* Update: When you log in or out it changes a field in the table. (finalProject.php line 28, myEvents.php line43)
* Delete: When you delete an event from your events, it is deleted from the RSVP table. (myEvents.php line 34)


---

### Video Demonstartion
* URL : https://youtu.be/2FSton5KdQA

---

### LOG IN
* Can use  
> USERNAME: test  
> PASSWORD: testing 
* Or can create a new user account to view content 
