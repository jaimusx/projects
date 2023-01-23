-- Create Primary Database
CREATE DATABASE cst499_website;

-- Create table for students
CREATE TABLE tblstudent (
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY, 
    firstName VARCHAR(255) NOT NULL, 
    lastName VARCHAR(255) NOT NULL, 
    address VARCHAR(255) NOT NULL, 
    phone VARCHAR(255) NOT NULL, 
    email VARCHAR(255) NOT NULL, 
    pwd VARCHAR(255) NOT NULL)
;

-- Create table for Semesters
CREATE TABLE tblsemesters (
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    semester VARCHAR(255) NOT NULL
);

-- Create table for Courses
CREATE TABLE tblcourses (
    id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    availability INT NOT NULL,
    course VARCHAR(255) NOT NULL,
    semester_id INT NOT NULL,
    FOREIGN KEY (semester_id) REFERENCES tblsemesters(id)
);

-- Create table for enrolling for courses
CREATE TABLE tblenrollment (
    record INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    course VARCHAR(255) NOT NULL,
    studentID VARCHAR(255) NOT NULL,
    firstName VARCHAR(255) NOT NULL, 
    lastName VARCHAR(255) NOT NULL,
    semester VARCHAR(255) NOT NULL,
    semester_id VARCHAR(255) NOT NULL
);

-- Create table for enrolling for courses
CREATE TABLE tblwaitlist (
    course VARCHAR(255) NOT NULL,
    studentID VARCHAR(255) NOT NULL,
    firstName VARCHAR(255) NOT NULL, 
    lastName VARCHAR(255) NOT NULL,
    semester VARCHAR(255) NOT NULL,
    semester_id VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL
);

-- Insert semesters into table
INSERT INTO tblsemesters (semester) VALUES
    ('Spring 2023'),
    ('Summer 2023'),
    ('Fall 2023'),
    ('Winter 2023');

-- Insert courses into table
INSERT INTO tblcourses (semester_id, course, availability) VALUES 
    (1, "ENG101-Essays for College Level", 5),
    (1, "SCI101-Science for College Level", 0),
    (1, "MAT101-College Level Algebra", 10),
    (1, "PSY101-Psychology 1", 9),
    (2, "ENG201-Literature 1", 2),
    (2, "SCI201-Science 2", 20),
    (2, "MAT201-College Level Trigonometry", 11),
    (2, "PSY201-Psychology 2", 1),
    (3, "ENG301-Literature 2", 30),
    (3, "SCI301-Physics 1", 7),
    (3, "MAT301-Calculus 1", 0),
    (3, "GEN301-College Level GenEd", 15),
    (4, "ENG328-Technical Documentation", 4),
    (4, "SCI399-Physics 2", 22),
    (4, "MAT399-Calculus 2", 10),
    (4, "GEN499-Capstones to General Education", 3)
    ;