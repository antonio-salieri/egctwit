CREATE TABLE following
(
    id       INTEGER PRIMARY KEY AUTOINCREMENT NOT NULL,
    userId	 INTEGER NOT NULL,
    followingName VARCHAR(255) NOT NULL,
    followingId INTEGER NOT NULL,
    followingOrder INTEGER NOT NULL
);
