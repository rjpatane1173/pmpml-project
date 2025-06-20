-- Create the database if it doesn't exist
CREATE DATABASE IF NOT EXISTS pmpml_db;

-- Use the database
USE pmpml_db;

-- Drop table if it already exists to avoid errors during multiple imports
DROP TABLE IF EXISTS users;

-- Create the users table
CREATE TABLE users (
  id INT NOT NULL AUTO_INCREMENT,
  name VARCHAR(100) NOT NULL,
  email VARCHAR(100) NOT NULL UNIQUE,
  password VARCHAR(255) NOT NULL,
  created_at TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (id)
);

