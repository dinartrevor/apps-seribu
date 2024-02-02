CREATE TABLE donations (
  id INT PRIMARY KEY AUTO_INCREMENT,
  user_id INT,
  title VARCHAR(250),
  amount DECIMAL(38, 5),
  image text NULL,
  notes text NULL,
  created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
  deleted_at TIMESTAMP,
  FOREIGN KEY (user_id) REFERENCES users(id),
  INDEX (user_id)
);

CREATE TABLE donation_payment_methods (
  id INT PRIMARY KEY AUTO_INCREMENT,
  donation_id INT,
  payment_method_id INT,
  account_number VARCHAR(100),
  account_holder_name VARCHAR(100),
  FOREIGN KEY (donation_id) REFERENCES donations(id),
  FOREIGN KEY (payment_method_id) REFERENCES payment_methods(id),
  INDEX (donation_id),
  INDEX (payment_method_id)
);