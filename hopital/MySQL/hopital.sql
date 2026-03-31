-- Création de la base de données
CREATE DATABASE IF NOT EXISTS hopital;
USE hopital;

-- Création de la table 'patients'
CREATE TABLE IF NOT EXISTS patients (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(100) NOT NULL,
    prenom VARCHAR(100) NOT NULL,
    date_naissance DATE,
    adresse VARCHAR(255),
    telephone VARCHAR(20)
);

-- Création de la table 'rendez_vous'
CREATE TABLE IF NOT EXISTS rendez_vous (
    id INT AUTO_INCREMENT PRIMARY KEY,
    patient_id INT,
    date_heure DATETIME,
    motif TEXT,
    FOREIGN KEY (patient_id) REFERENCES patients(id)
);

-- Création de la table 'medecins'
CREATE TABLE IF NOT EXISTS medecins (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(100) NOT NULL,
    prenom VARCHAR(100) NOT NULL,
    specialite VARCHAR(100)
);

-- Insertion de données d'exemple pour les patients (joueurs de football célèbres)
INSERT INTO patients (nom, prenom, date_naissance, adresse, telephone) VALUES
('Mbappé', 'Kylian', '1998-12-20', 'Paris, France', '0123456789'),
('Griezmann', 'Antoine', '1991-03-21', 'Mâcon, France', '0987654321'),
('Pogba', 'Paul', '1993-03-15', 'Lagny-sur-Marne, France', '0234567890'),
('Benzema', 'Karim', '1987-12-19', 'Lyon, France', '0345678901'),
('Kanté', 'N\'Golo', '1991-03-29', 'Paris, France', '0456789012'),
('Varane', 'Raphaël', '1993-04-25', 'Lille, France', '0567890123'),
('Lloris', 'Hugo', '1986-12-26', 'Nice, France', '0678901234'),
('Coman', 'Kingsley', '1996-06-13', 'Paris, France', '0789012345'),
('Dembélé', 'Ousmane', '1997-05-15', 'Vernon, France', '0890123456'),
('Giroud', 'Olivier', '1986-09-30', 'Chambéry, France', '0901234567');

-- Insertion de données d'exemple pour les rendez-vous
INSERT INTO rendez_vous (patient_id, date_heure, motif) VALUES
(1, '2023-10-01 10:00:00', 'Suivi de blessure'),
(2, '2023-10-02 14:30:00', 'Consultation de routine'),
(3, '2023-10-03 09:00:00', 'Rééducation'),
(4, '2023-10-04 11:00:00', 'Bilan de santé'),
(5, '2023-10-05 15:00:00', 'Consultation post-match');

-- Insertion de données d'exemple pour les médecins (médecins célèbres de séries)
INSERT INTO medecins (nom, prenom, specialite) VALUES
('Shepherd', 'Derek', 'Neurochirurgie'),
('House', 'Gregory', 'Diagnosticien'),
('Grey', 'Meredith', 'Chirurgie générale'),
('Cox', 'Perry', 'Médecine interne'),
('Brennan', 'Temperance', 'Anthropologie médico-légale');