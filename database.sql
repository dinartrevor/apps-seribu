CREATE TABLE roles (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50) NOT NULL
);

CREATE TABLE permissions (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50) NOT NULL
);

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    npm VARCHAR(100) NULL UNIQUE,
    role_id INT,
    status TINYINT DEFAULT 1,
    FOREIGN KEY (role_id) REFERENCES roles(id),
    INDEX (role_id)
);

CREATE TABLE role_permissions (
    role_id INT,
    permission_id INT,
    PRIMARY KEY (role_id, permission_id),
    FOREIGN KEY (role_id) REFERENCES roles(id),
    FOREIGN KEY (permission_id) REFERENCES permissions(id),
    INDEX (role_id),
    INDEX (permission_id)
);


ALTER TABLE roles
    ADD COLUMN created_by VARCHAR(255) DEFAULT 'superadmin',
    ADD COLUMN updated_by VARCHAR(255),
    ADD COLUMN deleted_by VARCHAR(255),
    ADD COLUMN created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    ADD COLUMN updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    ADD COLUMN deleted_at TIMESTAMP;

ALTER TABLE permissions
    ADD COLUMN created_by VARCHAR(255) DEFAULT 'superadmin',
    ADD COLUMN updated_by VARCHAR(255),
    ADD COLUMN deleted_by VARCHAR(255),
    ADD COLUMN created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    ADD COLUMN updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    ADD COLUMN deleted_at TIMESTAMP;

ALTER TABLE users
    ADD COLUMN created_by VARCHAR(255) DEFAULT 'superadmin',
    ADD COLUMN updated_by VARCHAR(255),
    ADD COLUMN deleted_by VARCHAR(255),
    ADD COLUMN created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    ADD COLUMN updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    ADD COLUMN deleted_at TIMESTAMP;



-- Table For Master Data

CREATE TABLE payment_methods (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    -- is_free_admin TINYINT NULL,
    type ENUM('Transfer Virtual Account', 'Transfer Manual', 'E-Wallet', 'Credit Card', 'Paylater', 'Other') NOT NULL DEFAULT 'Other',
    image TEXT NULL,
    created_by VARCHAR(255) DEFAULT 'superadmin',
    updated_by VARCHAR(255),
    deleted_by VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    deleted_at TIMESTAMP
);

