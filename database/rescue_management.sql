CREATE DATABASE rescue_management_system;

USE rescue_management_system;


-- =========================================
-- USERS TABLE
-- =========================================

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(150) NOT NULL UNIQUE,
    phone VARCHAR(20),
    password VARCHAR(255) NOT NULL,
    role ENUM('admin', 'volunteer', 'witness', 'help_seeker') NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        ON UPDATE CURRENT_TIMESTAMP
);


-- =========================================
-- NOTIFICATIONS TABLE
-- =========================================

CREATE TABLE notifications (
    id INT AUTO_INCREMENT PRIMARY KEY,
    created_by INT NOT NULL,
    title VARCHAR(150) NOT NULL,
    message TEXT NOT NULL,
    alert_type ENUM('normal', 'important', 'emergency')
        NOT NULL DEFAULT 'normal',
    status ENUM('active', 'inactive')
        NOT NULL DEFAULT 'active',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        ON UPDATE CURRENT_TIMESTAMP,

    CONSTRAINT fk_notifications_admin
        FOREIGN KEY (created_by)
        REFERENCES users(id)
        ON DELETE RESTRICT
        ON UPDATE CASCADE
);


-- =========================================
-- FEEDBACK TABLE
-- =========================================

CREATE TABLE feedback (
    id INT AUTO_INCREMENT PRIMARY KEY,
    help_seeker_id INT NOT NULL,
    rescue_request_id INT DEFAULT NULL,
    message TEXT NOT NULL,
    status ENUM('pending', 'reviewed', 'resolved')
        NOT NULL DEFAULT 'pending',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        ON UPDATE CURRENT_TIMESTAMP,

    CONSTRAINT fk_feedback_help_seeker
        FOREIGN KEY (help_seeker_id)
        REFERENCES users(id)
        ON DELETE RESTRICT
        ON UPDATE CASCADE
);


-- =========================================
-- RESCUE REPORTS TABLE
-- =========================================

CREATE TABLE rescue_reports (
    id INT AUTO_INCREMENT PRIMARY KEY,
    emergency_request_id INT NOT NULL,
    admin_id INT NOT NULL,
    rescue_status ENUM(
        'pending',
        'ongoing',
        'completed',
        'cancelled'
    ) NOT NULL DEFAULT 'pending',
    description TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,

    CONSTRAINT fk_rescue_reports_admin
        FOREIGN KEY (admin_id)
        REFERENCES users(id)
        ON DELETE RESTRICT
        ON UPDATE CASCADE
);