# Systeme de Gestion Hospitalier

Ce projet est un petit systeme de gestion hospitalier realise en PHP et MySQL.

Il permet de gerer :
- les patients
- les medecins
- les rendez-vous
- le rapport des rendez-vous a venir

## Fonctionnalites

### Patients
- afficher la liste des patients
- ajouter un patient
- modifier un patient
- supprimer un patient
- rechercher un patient par nom ou prenom

### Medecins
- afficher la liste des medecins
- ajouter un medecin
- modifier un medecin
- supprimer un medecin

### Rendez-vous
- afficher la liste des rendez-vous
- ajouter un rendez-vous

### Rapport
- afficher les rendez-vous a venir dans les 7 prochains jours

## Technologies utilisees
- PHP
- MySQL
- HTML
- CSS
- XAMPP

## Structure du projet

```text
hopital/
├── config/
│   └── database.php
├── css/
│   └── style.css
├── includes/
│   ├── header.php
│   └── footer.php
├── index.php
├── patients.php
├── ajouter_patient.php
├── modifier_patient.php
├── supprimer_patient.php
├── rendez_vous.php
├── ajouter_rendez_vous.php
├── medecins.php
├── ajouter_medecin.php
├── modifier_medecin.php
├── supprimer_medecin.php
└── rapport_rendez_vous.php