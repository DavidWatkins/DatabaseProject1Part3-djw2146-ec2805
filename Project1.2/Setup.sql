CREATE TABLE Users (
    name CHAR(40),
    email CHAR(40),
    password CHAR(16) NOT NULL,
    school CHAR(40),
    photo BLOB,
    PRIMARY KEY (email));

CREATE TABLE Projects (
    projname CHAR(120),
    email CHAR(40),
    description CHAR(1400),
	date_created DATE,
    user_email CHAR(40) NOT NULL,
    PRIMARY KEY (projname),
    FOREIGN KEY (user_email) REFERENCES Users);

CREATE TABLE Publicity_links (
    url CHAR(140),
    website_name CHAR(80),
    projname CHAR(120),
    PRIMARY KEY (url, projname),
    FOREIGN KEY (projname) REFERENCES Projects);

CREATE TABLE Support_requests (
    description CHAR(700),
    category CHAR(10),
    percent_fulfilled REAL,
    projname CHAR(120),
    PRIMARY KEY (projname, category),
    FOREIGN KEY (projname) REFERENCES Projects ON DELETE CASCADE,
    CONSTRAINT fill_max CHECK (percent_fulfilled >= 0 AND percent_fulfilled <= 1));

CREATE TABLE Help_requests (
    role CHAR(40),
    projname CHAR(120),
    category CHAR(10),
    PRIMARY KEY (projname, category),
    FOREIGN KEY (projname, category) REFERENCES Support_requests ON DELETE CASCADE);

CREATE TABLE Food_requests (
    item CHAR(40),
    quantity INTEGER,
    projname CHAR(120),
    category CHAR(10),
    PRIMARY KEY (projname, category),
    FOREIGN KEY (projname, category) REFERENCES Support_requests ON DELETE CASCADE);

CREATE TABLE Money_requests (
    amount REAL,
    is_all_or_nothing CHAR(1),
    projname CHAR(120),
    category CHAR(10),
    PRIMARY KEY (projname, category),
    FOREIGN KEY (projname, category) REFERENCES Support_requests ON DELETE CASCADE);

CREATE TABLE Contributions (
    user_email CHAR(40),
    projname CHAR(120),
    category CHAR(10),
    percent_fulfilled REAL,
    PRIMARY KEY (user_email, projname, category),
    FOREIGN KEY (user_email) REFERENCES Users,
    FOREIGN KEY (projname, category) REFERENCES Support_requests ON DELETE CASCADE,
    CHECK (percent_fulfilled >= 0 AND percent_fulfilled <= 1));

CREATE TABLE Comments (
    user_email CHAR(40),
    projname CHAR(120),
    content CHAR(700),
    timestamp TIMESTAMP,
    PRIMARY KEY (user_email, projname, timestamp),
    FOREIGN KEY (user_email) REFERENCES Users,
    FOREIGN KEY (projname) REFERENCES Projects ON DELETE CASCADE);

CREATE TABLE Likes (
    user_email CHAR(40),
    projname CHAR(120),
    PRIMARY KEY (user_email, projname),
    FOREIGN KEY (user_email) REFERENCES Users,
    FOREIGN KEY (projname) REFERENCES Projects ON DELETE CASCADE);

CREATE TABLE Updates (
    projname CHAR(120),
    content BLOB,
    timestamp TIMESTAMP,
    PRIMARY KEY (projname, timestamp),
    FOREIGN KEY (projname) REFERENCES Projects ON DELETE CASCADE);

CREATE TABLE Team_memberships (
    projname CHAR(120),
    user_email CHAR(40),
    PRIMARY KEY (projname, user_email),
    FOREIGN KEY (user_email) REFERENCES Users,
    FOREIGN KEY (projname) REFERENCES Projects ON DELETE CASCADE);
