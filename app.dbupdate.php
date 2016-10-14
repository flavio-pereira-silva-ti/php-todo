
<?php
require 'app.dbconn.php';

create_db();
create_tables();
create_user_admin();

function create_db() {
  
  // Create connection
  $conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, '', DB_PORT);

  // Check connection
  if ($conn->connect_error) {
    die("Connection failed: $conn->connect_error");
  }

  // Create database
  $sql = 'CREATE DATABASE IF NOT EXISTS ' . DB_NAME;
  if ($conn->query($sql) === FALSE) {
    echo "Error creating database: $conn->error";
  }

  $conn->close();
}

function create_tables() {
  
  $conn = get_conn();

  // Create tables
  $sql = 'CREATE TABLE IF NOT EXISTS USER (
  id BIGINT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  email VARCHAR(255) NOT NULL,
  password VARCHAR(255) NOT NULL,
  name VARCHAR(255) NOT NULL,
  created TIMESTAMP,
  CONSTRAINT UNQ_EMAIL UNIQUE (email)
  )';
  if ($conn->query($sql) === FALSE) {
    die("Error creating table: $conn->error");
  }
  $sql = 'CREATE INDEX IDX_EMAIL USING BTREE ON USER(email)';

  $sql = 'CREATE TABLE IF NOT EXISTS TODO (
  id BIGINT NOT NULL AUTO_INCREMENT PRIMARY KEY,
  title VARCHAR(255) NOT NULL,
  description TEXT,
  deadline TIMESTAMP,
  is_done BOOLEAN NOT NULL DEFAULT 0,
  created TIMESTAMP,
  user_id BIGINT NOT NULL,
  FOREIGN KEY (user_id) REFERENCES USER(id)
  )';
  if ($conn->query($sql) === FALSE) {
    die("Error creating table: $conn->error");
  }
  $sql = 'CREATE INDEX IDX_USER_ID USING BTREE ON TODO(user_id)';

  $conn->close();
}

function create_user_admin() {
  $conn = get_conn();
  
  $email = 'sysadmin@company.com';
  
  $sql = "SELECT id FROM USER WHERE email = '$email'";
  
  if ($conn->query($sql)->num_rows === 0) {
    $password = password_hash('sysadmin', PASSWORD_DEFAULT);
    $name = 'admin';
    $sql = "INSERT INTO USER (email, password, name) VALUES ('$email', '$password', '$name')";
    if ($conn->query($sql) === FALSE) {
      die("Error creating user admin: $conn->error");
    }
  }
  
  $conn->close();
}
?>