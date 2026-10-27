CREATE DATABASE IF NOT EXISTS msme_portal_db;
USE msme_portal_db;

-- Table for storing MSME Diagnostic Submissions
CREATE TABLE IF NOT EXISTS diagnostic_submissions (
    id INT AUTO_INCREMENT PRIMARY KEY,
    company_name VARCHAR(255) NOT NULL,
    owner_name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    sector VARCHAR(100) NOT NULL,
    employee_count VARCHAR(50) NOT NULL,
    score_financial INT NOT NULL,
    score_operations INT NOT NULL,
    score_digital INT NOT NULL,
    score_market INT NOT NULL,
    score_supply INT NOT NULL,
    score_compliance INT NOT NULL,
    overall_score FLOAT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

CREATE TABLE IF NOT EXISTS roadmaps (
    id INT AUTO_INCREMENT PRIMARY KEY,
    company_name VARCHAR(255) NOT NULL,
    target_goal VARCHAR(255) NOT NULL,
    timeline VARCHAR(50) NOT NULL,
    milestones TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
INSERT INTO diagnostic_submissions (company_name, owner_name, email, sector, employee_count, score_financial, score_operations, score_digital, score_market, score_supply, score_compliance, overall_score) 
VALUES ('Apex Agro Industries', 'Ramesh Kumar', 'ramesh@apexagro.com', 'Manufacturing', '50-250', 70, 60, 45, 80, 65, 90, 68.3);