# 3380-Final-Projet
---
*List of Group Members
* Sara Caponi
* Kate Gardner
* Erika Eckfeld
---
###Description Of Application

Our application is created for MU students to easily find events going on around campus. We included a fall and spring semester caldner page with a table of events with listed date/time, location, descritpion, and the orginization holding the event. The table can be easily changed by viewers to showcase the most current happenings around campus. The events in the table can be deleted, added, and updated with the click of a button. The purpose of the application is to be like a virutal collaborative planner for students to interact with their colleages. 

---
###Database Schema

CREATE TABLE fall(
id INT NOT NULL AUTO_INCREMENT PRIMARY,
orginization varchar(200) NOT NULL,
event varchar(200) NOT NULL,
description mediumtext,
location varchar(200) NOT NULL,
whatTime DATETIME NOT NULL
);

---

