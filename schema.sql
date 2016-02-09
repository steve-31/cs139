DROP TABLE users;

CREATE TABLE users
(
UserID int PRIMARY KEY,
Title  VARCHAR(10),
FirstName VARCHAR(20),
Surname VARCHAR(20),
Email VARCHAR(50),
Username VARCHAR(20),
Password VARCHAR(20),
PromEmail int,
NotifEmail int
);

DROP TABLE Lists;
CREATE TABLE Lists 
(

ListID int PRIMARY KEY,
UserID int,
Name VARCHAR(20),
LastEdit DATETIME,
Category VARCHAR(10),
FOREIGN KEY(UserID) REFERENCES users(UserID)
);
DROP TABLE Items;
CREATE TABLE Items
(
ItemID int PRIMARY KEY,
ListID int,
Content TEXT,
Done int,
DueDate DATETIME,
FOREIGN KEY(ListID) REFERENCES Lists(ListID)
);


