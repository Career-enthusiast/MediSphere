CREATE DATABASE MediSphere;
USE MediSphere;
CREATE TABLE Users(
user_id INT PRIMARY KEY AUTO_INCREMENT,
username VARCHAR(40),
email VARCHAR(50),
password VARCHAR(10)
);

-- Remove the 'username' column
ALTER TABLE Users
DROP COLUMN username;

-- Add 'first_name' and 'last_name' columns
ALTER TABLE Users
ADD first_name VARCHAR(40),
ADD last_name VARCHAR(40);

ALTER TABLE Users
ADD role VARCHAR(10);

USE Medisphere;
ALTER table users
ADD document_proof varchar(60);


CREATE TABLE User_Profile(
user_id INT,
age INT NOT NULL,
gender VARCHAR(10),
FOREIGN KEY (user_id) REFERENCES Users(user_id)
);
CREATE TABLE user_orders(
user_id INT,
order_id INT PRIMARY KEY,
total_amount INT,
order_date DATE /*In YYYY-MM-DD FORMAT*/,
FOREIGN KEY (user_id) REFERENCES Users(user_id)
);

CREATE TABLE IF NOT EXISTS Conditions (
    condition_id INT AUTO_INCREMENT PRIMARY KEY,
    condition_name VARCHAR(100) NOT NULL
);

CREATE TABLE IF NOT EXISTS Symptoms (
    symptom_id INT AUTO_INCREMENT PRIMARY KEY,
    symptom_name VARCHAR(100) NOT NULL
);
SELECT * FROM Symptoms;
SELECT * FROM Conditions;
DELETE FROM Conditions;


CREATE TABLE IF NOT EXISTS Medications (
    medication_id INT AUTO_INCREMENT PRIMARY KEY,
    medication_name VARCHAR(100) NOT NULL,
    brand VARCHAR(100),
    price DECIMAL(10,2) NOT NULL,
    description TEXT,
    side_effects TEXT,
    dosage VARCHAR(100),
    medicine_picture VARCHAR(255)
);
ALTER TABLE Medications AUTO_INCREMENT = 101;

-- Creating Symptom-Condition-Medication Link Table
CREATE TABLE IF NOT EXISTS Symptom_Condition_Medication (
    symptom_id INT,
    condition_id INT,
    medication_id INT,
    PRIMARY KEY (symptom_id, condition_id, medication_id),
    FOREIGN KEY (symptom_id) REFERENCES Symptoms(symptom_id),
    FOREIGN KEY (condition_id) REFERENCES Conditions(condition_id),
    FOREIGN KEY (medication_id) REFERENCES Medications(medication_id)
);

-- Inserting Symptoms
INSERT INTO Symptoms (symptom_name) VALUES 
('Fever'),--1
('Cough'),--2
('Headache'),--3
('Nausea'),--4
('Fatigue'),--5
('Sore Throat'),--6
('Dizziness'),--7
('Chest Pain'),--8
('Abdominal Pain'),--9
('Body aches'),--10
('Diarrhea'),--11
('Skin rash'),--12
('Chills'),--13
('Shortness of breathe'),--14
('Palpitations'),--15
('Vision changes'),--16
('Sweating'),--17
('Ring in ears'),--18
('Sleep disturbances'),--19
('Wheezing'),--20
('Chest tightness'),--21
('Difficult breathing'),--22
('Anxiety'),--23
('Nasal congestion'),--24
('Feeling tired'),--25
('Bloating'),--26
('Heartburn'),--27
('Loss of appetite'),--28
('Weight loss'),--29
('Indigestion'),--30
('Changes in stool'),--31
('Mouth sores'),--32
('Swelling in legs'),--33
('High blood pressure'),--34
('Cold sweats'),--35
('Heart rhythm issues'),--36
('Increased thirst'),--37
('Frequent urination'),--38
('Blurred vision'),--39
('Slow healing sores'),--40
('Tingling in hands/feet'),--41
('Increased hunger'),--42

-- Inserting Conditions
INSERT INTO Conditions (condition_name) VALUES 
('Infections'),  --1
('Blood pressure'), --2
('Asthma'),   --3
('Ulcers'),   --4
('Heart stroke'), --5
('Diabetes'),  --6
('Obesity'),  --7
('Depression'),  --8
('Cholestrol Disorders'), --9
('Insomnia');   --10

-- Inserting Medications
INSERT INTO Medications (medication_name, brand, price, description, side_effects, dosage, medicine_picture) VALUES
('Paracetamol', 'Crocin', 10.00, 'Reduces fever and relieves pain.', 'Nausea, rash, liver damage', '500mg every 4-6 hours', 'paracetamol.jpg'),--101
('Ibuprofen', 'Brufen', 15.00, 'Anti-inflammatory, used for pain and fever.', 'Upset stomach, headache, dizziness', '200-400mg every 4-6 hours', 'ibuprofen.jpg'),--102
('Aspirin', 'Disprin', 12.00, 'Analgesic and antipyretic', 'Gastrointestinal bleeding', '300 mg every 4 hours', 'aspirin.jpg'),--103
('Dextromethorphan', 'Benadryl Cough', 10.00, 'Cough suppressant', 'Drowsiness', '10 mg every 4-6 hours', 'dextromethorphan.jpg'),--104
('Guaifenesin', 'Robitussi', 12.00, 'Expectorant that helps clear mucus', 'Dizziness, Nausea', '200 mg every 4 hours', 'guaifenesin.jpg'),--105
('Bromhexine', 'Mucolite', 15.00, 'Mucolytic agent that helps in cough', 'Gastrointestinal disturbances', '8 mg three times a day', 'bromhexine.jpg'),--106
('Amoxicillin', 'Amoxil', 20.00, 'Antibiotic for bacterial infections', 'Nausea, Diarrhea', '500 mg every 8 hours', 'amoxicillin.jpg'),--107
('Cefixime', 'Suprax', 25.00, 'Broad-spectrum antibiotic', 'Nausea, Headache', '400 mg once daily', 'cefixime.jpg'),--108
('Chlorhexidine', 'Hexidine', 8.00, 'Antiseptic for throat infections', 'Mouth irritation', 'Gargle 2-3 times a day', 'chlorhexidine.jpg'),--109
('Diclofenac', 'Voltaren', 18.00, 'Nonsteroidal anti-inflammatory drug', 'Stomach pain, Nausea', '50 mg every 8 hours', 'diclofenac.jpg'),--110
('Ondansetron', 'Zofran', 20.00, 'Antiemetic used for nausea', 'Headache, Constipation', '8 mg every 8 hours', 'ondansetron.jpg'),--111
('Metoclopramide', 'Primperan', 15.00, 'Used for nausea and vomiting', 'Drowsiness, Fatigue', '10 mg three times a day', 'metoclopramide.jpg'),--112
('Prochlorperazine', 'Compazine', 22.00, 'Antipsychotic used as an antiemetic', 'Drowsiness, Dizziness', '5-10 mg every 6-8 hours', 'prochlorperazine.jpg'),--113
('Loperamide', 'Imodium', 12.00, 'Antidiarrheal medication', 'Constipation', '2 mg after each loose stool', 'loperamide.jpg'),--114
('Attapulgite', 'Kaopectate', 10.00, 'Absorbent used for diarrhea', 'Constipation', '4 mg every 4 hours', 'attapulgite.jpg'),--115
('Probiotics', 'Enterogermina', 15.00, 'Restores gut flora after diarrhea', 'Bloating, Gas', '1 capsule daily', 'probiotics.jpg'),--116
('Hydrocortisone cream', 'Cortaid', 8.00, 'Topical corticosteroid for inflammatory skin conditions', 'Skin thinning, Irritation', 'Apply as needed', 'hydrocortisone.jpg'),--117
('Calamine lotion', 'Caladryl', 7.00, 'Relieves itching and irritation', 'Dryness, Stinging', 'Apply as needed', 'calamine.jpg'),--118
('Antihistamines', 'Allegra', 12.00, 'Reduces allergy symptoms including rashes', 'Drowsiness, Dry mouth', '180 mg once daily', 'antihistamines.jpg'),--119
('Vitamin B complex', 'Neurobion', 15.00, 'Supports energy metabolism', 'Allergic reactions', '1 tablet daily', 'vitamin_b.jpg'),--120
('Iron supplements', 'Hemarate', 12.00, 'Helps in boosting energy and fighting anemia', 'Constipation', '100-200 mg daily', 'iron.jpg'),--121



-- Mapping Symptom → Condition → Medication
INSERT INTO Symptom_Condition_Medication (condition_id, symptom_id, medication_id) VALUES
(1,1,101), (1,1,102), (1,1,103),(1,2,104), (1,2,105), (1,2,106),(1,6,107), (1,6,108), (1,6,109),(1,10,101), (1,10,102), (1,10,110),(1,4,111), (1,4,112), (1,4,113),
(1,11,114), (1,11,115), (1,11,116),(1,12,117), (1,12,118), (1,12,119),(1,5,101), (1,5,120), (1,5,121),(1,13,101), (1,13,102), (1,13,103),(1,3,101), (1,3,102), (1,3,103),


CREATE TABLE order_details(
order_id INT,
medication_id INT,
quantity INT NOT NULL,
price DECIMAL(10,2),
FOREIGN KEY (order_id) REFERENCES user_orders(order_id),
FOREIGN KEY (medication_id) REFERENCES Medications(medication_id)
);


CREATE TABLE payment_methods(
order_id INT ,
payment_type VARCHAR(30),
card_number VARCHAR(19),
FOREIGN KEY (order_id) REFERENCES user_orders(order_id)
);
CREATE TABLE cart(
user_id INT,
cart_id INT PRIMARY KEY,
medication_id INT,
quantity INT NOT NULL,
FOREIGN KEY (user_id) REFERENCES Users(user_id),
FOREIGN KEY (medication_id) REFERENCES Medications(medication_id)
);

SELECT * FROM Medications; 

SELECT 
    C.condition_name, 
    M.medication_name, 
    M.brand, 
    M.price, 
    M.description, 
    M.side_effects, 
    M.dosage
FROM 
    Medications M
JOIN 
    Symptom_Condition_Medication SCM ON M.medication_id = SCM.medication_id
JOIN 
    Symptoms S ON SCM.symptom_id = S.symptom_id
JOIN 
    Conditions C ON SCM.condition_id = C.condition_id
WHERE 
    S.symptom_id = 4;  -- This is for the symptom "Nausea"

--Code which I have added on phpmyadmin 5th Nov
ALTER TABLE symptom_condition_medication 
DROP FOREIGN KEY symptom_condition_medication_ibfk_2;

TRUNCATE TABLE Conditions;

ALTER TABLE symptom_condition_medication 
ADD CONSTRAINT symptom_condition_medication_ibfk_2 
FOREIGN KEY (condition_id) REFERENCES Conditions(condition_id);

ALTER TABLE Conditions AUTO_INCREMENT = 1;

INSERT INTO Conditions (condition_name) VALUES
('Infections'),('Blood pressure'), ('Asthma'), ('Ulcers'), ('Heart stroke'), 
('Diabetes'), ('Obesity'), ('Depression'), ('Cholesterol Disorders'), ('Insomnia');

--Same done with symptoms and medications to alter data and auto_increment from 1 with foreign key constraint 
--symptom_condition_medication_ibfk_2
INSERT INTO Symptoms (symptom_name) VALUES 

('Fever'), ('Cough'), ('Headache'), ('Nausea'), ('Fatigue'), ('Sore Throat'), ('Dizziness'), ('Chest Pain'), ('Abdominal Pain'), ('Body aches'), ('Diarrhea'), ('Skin rash'), ('Chills'), ('Shortness of breathe'), ('Palpitations'), ('Vision changes'), ('Sweating'), ('Ring in ears'), ('Sleep disturbances'), ('Wheezing'), ('Chest tightness'), ('Difficult breathing'), ('Anxiety'),
 ('Nasal congestion'), ('Feeling tired'), ('Bloating'), ('Heartburn'), ('Loss of appetite'), ('Weight loss'), ('Indigestion'), ('Changes in stool'), ('Mouth sores'), ('Swelling in legs'), ('High blood pressure'), ('Cold sweats'), ('Heart rhythm issues'), ('Increased thirst'), ('Frequent urination'),
 ('Blurred vision'), ('Slow healing sores'), ('Tingling in hands/feet'), ('Increased hunger');

 --From here non-generic starts....
-- Categories Table
CREATE TABLE Medicine_Categories (
    Category_ID INT AUTO_INCREMENT PRIMARY KEY,
    Category_Name VARCHAR(50) NOT NULL,
    Description TEXT
);

-- Medicines Table
CREATE TABLE Medicines (
    Medicine_ID INT AUTO_INCREMENT PRIMARY KEY,
    Medicine_Name VARCHAR(100) NOT NULL,
    Brand_Name VARCHAR(50),
    Category_ID INT,
    Price DECIMAL(10, 2),
    Description TEXT,
    Side_Effects TEXT,
    Dosage VARCHAR(100),
    Medicine_Picture TEXT,
    Prescription_Required BOOLEAN DEFAULT TRUE,
    FOREIGN KEY (Category_ID) REFERENCES Medicine_Categories(Category_ID)
); 


SELECT * FROM Symptoms;
SELECT * FROM Conditions;
DELETE FROM Conditions;
-- Query to fetch medicines visible only to doctors
SELECT m.*
FROM Medicines m
JOIN Medicine_Categories c ON m.Category_ID = c.Category_ID
JOIN Users u ON u.Role = 'Doctor'
WHERE m.Prescription_Required = TRUE;

-- Insert categories
INSERT INTO Medicine_Categories (Category_Name, Description)
VALUES
    ('Anesthesia', 'Medicines used for inducing anesthesia'),
    ('Painkillers', 'Medicines used for pain relief'),
    ('Antidepressants', 'Medicines used for treating depression and mood disorders'),
    ('Antibiotics', 'Non-generic antibiotics for bacterial infections'),
    ('Antipsychotics', 'Medicines for managing severe mental health conditions');

INSERT INTO Medicines (Medicine_Name, Brand_Name, Category_ID, Price, Description, Side_Effects, Dosage, Medicine_Picture)
VALUES
--Anesthesia
('Propofol', 'Diprivan', 1, 150.00, 'Induces and maintains general anesthesia.', 'Respiratory depression, Low blood pressure', '2-2.5 mg/kg IV', 'url_propofol.jpeg'),
('Ketamine', 'Ketalar', 1, 200.00, 'Used for starting and maintaining anesthesia.', 'Hallucinations, Hypertension', '1-4.5 mg/kg IV', 'url_ketamine.jpeg'),
('Midazolam', 'Versed', 1, 120.00, 'Used as sedative before surgeries.', 'Drowsiness, Low blood pressure', '1-5 mg IV', 'url_midazolam.jpeg'),
('Etomidate', 'Amidate', 1, 180.00, 'Used for short-term anesthesia.', 'Adrenal suppression, Nausea', '0.2-0.6 mg/kg IV', 'url_etomidate'),
('Thiopental', 'Pentothal', 1, 130.00, 'Barbiturate for anesthesia induction.', 'Cardiac depression, Respiratory depression', '3-5 mg/kg IV', 'url_thiopental'),
('Isoflurane', 'Forane', 1, 250.00, 'Inhaled anesthetic for surgeries.', 'Nausea, Low blood pressure', '1-2% inhaled', 'url_isoflurane'),
('Sevoflurane', 'Ultane', 1, 270.00, 'Inhaled anesthetic for induction and maintenance.', 'Dizziness, Nausea', '2-4% inhaled', 'url_sevoflurane'),
('Desflurane', 'Suprane', 1, 280.00, 'Inhaled anesthetic with rapid onset.', 'Cough, Respiratory irritation', '4-6% inhaled', 'url_desflurane'),
('Dexmedetomidine', 'Precedex', 1, 240.00, 'Sedative for ICU and surgeries.', 'Low blood pressure, Bradycardia', '0.2-0.7 mcg/kg/hr IV', 'url_dexmedetomidine'),
('Fentanyl', 'Sublimaze', 1, 300.00, 'Opioid anesthetic adjunct.', 'Respiratory depression, Nausea', '50-100 mcg IV', 'url_fentanyl'),

--Painkillers
('Morphine', 'MS Contin', 2, 120.00, 'Opioid for severe pain management.', 'Nausea, Drowsiness, Addiction', '15-30 mg every 4 hours', 'url_morphine'),
('Fentanyl', 'Duragesic', 2, 180.00, 'Potent opioid for pain relief.', 'Respiratory depression, Dizziness', '25-100 mcg/hour (patch)', 'url_fentanyl'),
('Oxycodone', 'OxyContin', 2, 140.00, 'Opioid analgesic for severe pain.', 'Constipation, Nausea', '10-30 mg every 4-6 hours', 'url_oxycodone'),
('Hydromorphone', 'Dilaudid', 2, 130.00, 'Opioid painkiller for acute pain.', 'Nausea, Drowsiness', '2-4 mg every 4-6 hours', 'url_hydromorphone'),
('Tramadol', 'Ultram', 2, 110.00, 'Used for moderate to severe pain.', 'Nausea, Dizziness', '50-100 mg every 4-6 hours', 'url_tramadol'),
('Methadone', 'Dolophine', 2, 150.00, 'Opioid used for pain and detoxification.', 'Nausea, Respiratory depression', '2.5-10 mg every 8-12 hours', 'url_methadone'),
('Codeine', 'Various', 2, 90.00, 'Used for mild to moderate pain.', 'Drowsiness, Constipation', '15-60 mg every 4 hours', 'url_codeine'),
('Aspirin', 'Bayer', 2, 15.00, 'NSAID for pain and inflammation.', 'Gastrointestinal upset', '300-600 mg every 4-6 hours', 'url_aspirin'),
('Ibuprofen', 'Advil', 2, 20.00, 'NSAID for mild to moderate pain.', 'Stomach pain, Nausea', '200-400 mg every 4-6 hours', 'url_ibuprofen'),
('Celecoxib', 'Celebrex', 2, 25.00, 'NSAID used for chronic pain.', 'Stomach upset, Dizziness', '100-200 mg twice daily', 'url_celecoxib'),

-- Antidepressants
('Sertraline', 'Zoloft', 3, 50.00, 'SSRI for depression and anxiety.', 'Nausea, Fatigue', '50 mg once daily', 'url_sertraline'),
('Amitriptyline', 'Elavil', 3, 40.00, 'Tricyclic antidepressant for mood disorders.', 'Drowsiness, Dry mouth', '10-150 mg daily', 'url_amitriptyline'),
('Fluoxetine', 'Prozac', 3, 45.00, 'SSRI for mood stabilization.', 'Insomnia, Nausea', '20-80 mg daily', 'url_fluoxetine'),
('Duloxetine', 'Cymbalta', 3, 70.00, 'SNRI for depression and pain relief.', 'Dry mouth, Dizziness', '30-120 mg daily', 'url_duloxetine'),
('Escitalopram', 'Lexapro', 3, 55.00, 'SSRI for treating anxiety and depression.', 'Nausea, Fatigue', '10-20 mg daily', 'url_escitalopram'),
('Bupropion', 'Wellbutrin', 3, 60.00, 'Atypical antidepressant for mood disorders.', 'Dry mouth, Insomnia', '150-300 mg daily', 'url_bupropion'),
('Venlafaxine', 'Effexor', 3, 65.00, 'SNRI for severe depression.', 'Nausea, Sweating', '75-225 mg daily', 'url_venlafaxine'),
('Paroxetine', 'Paxil', 3, 50.00, 'SSRI for anxiety and panic disorders.', 'Drowsiness, Weight gain', '20-50 mg daily', 'url_paroxetine'),
('Mirtazapine', 'Remeron', 3, 80.00, 'Tetracyclic antidepressant for mood improvement.', 'Weight gain, Drowsiness', '15-45 mg daily', 'url_mirtazapine'),
('Trazodone', 'Desyrel', 3, 50.00, 'Atypical antidepressant with sedative effects.', 'Drowsiness, Dizziness', '150-300 mg daily', 'url_trazodone'),

-- Antibiotics
('Amoxicillin', 'Amoxil', 4, 30.00, 'Broad-spectrum penicillin antibiotic.', 'Nausea, Rash', '500 mg every 8 hours', 'url_amoxicillin'),
('Cefixime', 'Suprax', 4, 45.00, 'Third-generation cephalosporin.', 'Diarrhea, Stomach upset', '400 mg once daily', 'url_cefixime'),
('Azithromycin', 'Zithromax', 4, 50.00, 'Macrolide antibiotic for bacterial infections.', 'Diarrhea, Nausea', '500 mg once daily', 'url_azithromycin'),
('Clarithromycin', 'Biaxin', 4, 60.00, 'Macrolide antibiotic for respiratory infections.', 'Metallic taste, Diarrhea', '250-500 mg twice daily', 'url_clarithromycin'),
('Doxycycline', 'Vibramycin', 4, 55.00, 'Tetracycline antibiotic for various infections.', 'Nausea, Sun sensitivity', '100 mg twice daily', 'url_doxycycline'),
('Levofloxacin', 'Levaquin', 4, 70.00, 'Fluoroquinolone for respiratory infections.', 'Tendon rupture, Nausea', '500-750 mg once daily', 'url_levofloxacin'),
('Metronidazole', 'Flagyl', 4, 35.00, 'Antibiotic for anaerobic infections.', 'Metallic taste, Nausea', '500 mg every 8 hours', 'url_metronidazole'),
('Ciprofloxacin', 'Cipro', 4, 50.00, 'Fluoroquinolone for bacterial infections.', 'Diarrhea, Tendon pain', '250-750 mg twice daily', 'url_ciprofloxacin'),
('Vancomycin', 'Vancocin', 4, 90.00, 'Antibiotic for severe infections.', 'Red man syndrome, Kidney damage', '15-20 mg/kg IV every 8-12 hours', 'url_vancomycin'),
('Linezolid', 'Zyvox', 4, 100.00, 'Oxazolidinone antibiotic for resistant infections.', 'Bone marrow suppression, Nausea', '600 mg every 12 hours', 'url_linezolid'),

-- Antipsychotics
 ('Risperidone', 'Risperdal', 5, 70.00, 'Atypical antipsychotic for schizophrenia.', 'Weight gain, Dizziness', '2-6 mg daily', 'url_risperidone'),
('Olanzapine', 'Zyprexa', 5, 65.00, 'Antipsychotic for bipolar disorder.', 'Sedation, Weight gain', '10-20 mg daily', 'url_olanzapine'),
('Quetiapine', 'Seroquel', 5, 80.00, 'Atypical antipsychotic for depression and mania.', 'Drowsiness, Weight gain', '150-600 mg daily', 'url_quetiapine'),
('Haloperidol', 'Haldol', 5, 60.00, 'Typical antipsychotic for schizophrenia.', 'Tremors, Dystonia', '0.5-10 mg daily', 'url_haloperidol'),
('Aripiprazole', 'Abilify', 5, 75.00, 'Atypical antipsychotic for mood stabilization.', 'Anxiety, Dizziness', '10-30 mg daily', 'url_aripiprazole'),
('Ziprasidone', 'Geodon', 5, 70.00, 'Atypical antipsychotic for acute psychosis.', 'Sedation, Nausea', '20-80 mg twice daily', 'url_ziprasidone'),
('Clozapine', 'Clozaril', 5, 90.00, 'Antipsychotic for treatment-resistant schizophrenia.', 'Weight gain, Agranulocytosis', '300-600 mg daily', 'url_clozapine'),
('Paliperidone', 'Invega', 5, 85.00, 'Atypical antipsychotic for schizoaffective disorder.', 'Tremors, Nausea', '3-12 mg daily', 'url_paliperidone'),
('Lurasidone', 'Latuda', 5, 85.00, 'Antipsychotic for depressive episodes.', 'Sedation, Nausea', '20-120 mg daily', 'url_lurasidone'),
('Asenapine', 'Saphris', 5, 95.00, 'Atypical antipsychotic for bipolar I disorder.', 'Oral numbness, Drowsiness', '5-10 mg twice daily', 'url_asenapine');

 --To get auto increment from starting, first delete then alter auto_increment

 --added on 5th nov
 ALTER TABLE User_Profile
ADD medical_history TEXT,
ADD location VARCHAR(50);

ALTER TABLE User_Profile MODIFY age INT NULL;

--added on 12th Nov
ALTER TABLE user_orders DROP PRIMARY KEY;

-- Modify the order_id column to add AUTO_INCREMENT and make it the primary key again
DROP TABLE order_details;
DROP TABLE payment_methods;
DROP TABLE user_orders;

CREATE TABLE user_orders(
user_id INT,
order_id INT PRIMARY KEY AUTO_INCREMENT,
total_amount INT,
order_date DATE /*In YYYY-MM-DD FORMAT*/,
FOREIGN KEY (user_id) REFERENCES Users(user_id)
);

CREATE TABLE order_details(
order_id INT,
medication_id INT,
quantity INT NOT NULL,
price DECIMAL(10,2),
FOREIGN KEY (order_id) REFERENCES user_orders(order_id),
FOREIGN KEY (medication_id) REFERENCES Medications(medication_id)
);
CREATE TABLE payment_methods(
order_id INT ,
payment_type VARCHAR(30),
card_number VARCHAR(19),
FOREIGN KEY (order_id) REFERENCES user_orders(order_id)
);

-- added on 14th nov
CREATE TABLE NutritionalSupplements (
    SupplementName VARCHAR(100),
    Price DECIMAL(10, 2),
    ns_qty VARCHAR(50),  
    Dosage VARCHAR(200),
    Picture VARCHAR(255),
    Description TEXT
);

INSERT INTO NutritionalSupplements (SupplementName, Price, ns_qty, Description, Dosage, Picture) VALUES
('Olfit Softgel Capsule', 359.1, 'Per 30 capsules', 'Joint health and mobility support.', 'Take 1 capsule daily with water, or as directed by a healthcare provider.', 'path/to/olfit_softgel.jpg'),
('Vitomax Capsule', 225, 'Per 10 capsules', 'Energy and immune boost.', 'Take 1 capsule daily, preferably with a meal, or as prescribed.', 'path/to/vitomax_capsule.jpg'),
('ERACT-X Sachet', 95.4, '10 gm', 'Vitality enhancer and promotes general wellness.', 'Dissolve 1 sachet in water and take once daily, or as advised by a physician.', 'path/to/eract_x_sachet.jpg'),
('Reno albumen cardamom powder', 703.1, '200 gm', 'Renal support with cardamom.', 'Mix 1-2 scoops in water or milk daily, as directed by a healthcare professional.', 'path/to/reno_albumen_cardamom.jpg'),
('Kompact junior chocolate flavour powder', 386.1, '200 gm', 'Nutritional chocolate powder for kids supporting growth and development.', 'Mix 1-2 tablespoons in milk or water; recommended once daily.', 'path/to/kompact_junior_chocolate.jpg'),
('Ziprovit powder', 243, '200 gm', 'A multivitamin and mineral powder supplement formulated to boost energy and immunity.', 'Take 1-2 teaspoons in water or milk daily, or as prescribed.', 'path/to/ziprovit_powder.jpg'),
('Hijam Plus Sachet', 119.0, '12.5 gm', 'Nutritional supplement for use with mothers milk.', 'Mix 1-2 scoops with water or milk once daily, as directed by a physician.', 'path/to/hijam_plus_sachet.jpg'),
('Osmoset Vanilla flavour powder', 476.1, '200 gm', 'Nutritional powder formulated for hydration and electrolyte balance.', 'As prescribed by a doctor.', 'path/to/osmoset_vanilla.jpg'),
('Himalayan organics Chelated Iron with Vitamin C', 509.5, '120 tablets', 'Rich source of iron and Vitamin C for production of RBC.', '1 tablet per day (preferred after meal)', 'path/to/himalayan_organics_chelated_iron.jpg'),
('Ultra D3 drops', 39.2, '15 ml', 'Medicine to treat Vitamin D3 deficiency for children.', '1 ml daily', 'path/to/ultra_d3_drops.jpg'),
('Feroglobin B12 capsule', 116.6, '15 capsules', 'Nutritional supplement with vitamins and minerals.', '1 per day (after meal)', 'path/to/feroglobin_b12_capsule.jpg'),
('Ozivas daily womens multi', 449.1, '60 tablets', 'Nutritional needs of women with a blend of 23 vital vitamins, minerals, and herbs.', '1 tablet per day (after 1 hour of meal)', 'path/to/oziva_daily_womens_multi.jpg'),
('Calcimax-P Suspension', 168.3, '200 ml', 'To help maintain strong bones.', '5 ml per day (2.5ml two times)', 'path/to/calcimax_p_suspension.jpg'),
('Ultra Magnesium 200 mg Tablet', 170.6, '200 mg', 'A dietary supplement essential for normal psychological function and optimum strength.', 'As prescribed by the doctor.', 'path/to/ultra_magnesium_200mg.jpg'),
('Pentasure 2.0 Vanilla Flavour High Protein Powder', 1904, '400 gm', 'To offer increased energy levels and superior protein intake.', 'For 110 ml reconstituted feeding, mix 4 level scoops with 70 ml of freshly boiled and cooled water.', 'path/to/pentasure_high_protein.jpg'),
('Pediasure Chocolate Flavour Nutrition Powder for Kids Growth', 770, '400 gm', 'To support healthy growth and development in children.', 'Mix 3 tablespoons in 130 ml of milk OR 5 tablespoons in 190 ml of water.', 'path/to/pediasure_chocolate.jpg'),
('Aquasol A Capsule', 32, 'Per 30 capsules', 'To treat Vitamin A deficiency and nutritional deficiencies.', '1-2 capsules daily', 'path/to/aquasol_a_capsule.jpg'),
('Calcimax D 1000 Tablet', 341.6, 'Per 30 capsules', 'To treat and prevent calcium and vitamin D deficiency.', 'Take as advised by the doctor.', 'path/to/calcimax_d_1000.jpg'),
('OZiva Hair Vitamins', 449, 'Per 30 capsules', 'For hair growth and hairfall control.', 'Take one Oziva hair capsule twice daily with water.', 'path/to/oziva_hair_vitamins.jpg'),
('Ourdaily Vitamin E', 42, 'Per 10 capsules', 'Promotes healthy skin.', 'Take one capsule daily or as directed by your physician.', 'path/to/ourdaily_vitamin_e.jpg'),
('Zincovit tablet', 103.1, 'Per 15 tablets', 'Supports overall body functioning with essential vitamins and minerals.', 'As prescribed by physician.', 'path/to/zincovit_tablet.jpg');

INSERT INTO Medications (medication_name, brand, price, description, side_effects, dosage, medicine_picture) VALUES
('Amlodipine', 'Amlogard', 25.00, 'Calcium channel blocker for hypertension', 'Swelling, Flushing', '5-10 mg once daily', 'amlodipine.jpg'),--122
('Lisinopril', 'Lisinopril-Actavis', 30.00, 'ACE inhibitor for hypertension', 'Cough, High potassium levels', '10-40 mg once daily', 'lisinopril.jpg'),--123
('Hydrochlorothiazide', 'Hydrodiuril', 18.00, 'Thiazide diuretic for hypertension', 'Low potassium, Dizziness', '12.5-50 mg once daily', 'picture_url_hydrochlorothiazide'),--124
('Atenolol', 'Tenormin', 20.00, 'Beta-blocker used to treat high blood pressure', 'Fatigue, Cold hands/feet', '25-100 mg once daily', 'picture_url_atenolol'),--125
('Metoprolol', 'Lopressor', 22.00, 'Selective beta-blocker for hypertension', 'Dizziness, Fatigue', '25-100 mg once daily', 'picture_url_metoprolol'),--126
('Carvedilol', 'Dilatrend', 28.00, 'Alpha/beta blocker for hypertension', 'Dizziness, Fatigue', '6.25-25 mg twice daily', 'picture_url_carvedilol'),--127
('Nitroglycerin', 'Nitrostat', 35.00, 'Nitrate used for chest pain', 'Headache, Dizziness', '0.3-0.6 mg sublingually', 'picture_url_nitroglycerin'),--128
('Isosorbide mononitrate', 'Imdur', 30.00, 'Prevents chest pain in angina', 'Dizziness, Flushing', '30-60 mg once daily', 'picture_url_isosorbide'),--129
('Furosemide', 'Lasix', 15.00, 'Loop diuretic to reduce fluid retention', 'Low potassium, Dizziness', '20-80 mg once daily', 'picture_url_furosemide'),--130
('Spironolactone', 'Aldactone', 20.00, 'Potassium-sparing diuretic', 'Dizziness, High potassium', '25-100 mg once daily', 'picture_url_spironolactone'),--131
('Propranolol', 'Inderal', 25.00, 'Beta-blocker to manage heart rhythm', 'Dizziness, Fatigue', '10-40 mg once daily', 'picture_url_propranolol'),--132
('Metoclopramide', 'Primperan', 15.00, 'Used for nausea and vomiting', 'Drowsiness, Fatigue', '10 mg three times a day', 'picture_url_metoclopramide'),--133
('Ondansetron', 'Zofran', 20.00, 'Antiemetic used for nausea', 'Headache, Constipation', '8 mg every 8 hours', 'picture_url_ondansetron'),--134
('Domperidone', 'Motilium', 15.00, 'Antiemetic to relieve nausea', 'Dry mouth, Dizziness', '10 mg three times a day', 'picture_url_domperidone'),--135
('Clonidine', 'Catapres', 30.00, 'Alpha agonist that treats hypertension', 'Drowsiness, Dry mouth', '0.1-0.2 mg twice daily', 'picture_url_clonidine'),--136

('Albuterol','Ventolin',30.00,'Bronchodilator for quick relief of asthma symptoms','Tremors, Nervousness','90-180 mcg as needed','picture_url_albuterol'),--137
('Levalbuterol','Xopenex',35.00,'Short-acting bronchodilator for asthma ','Dizziness, Tachycardia','45 mcg every 4-6 hours','picture_url_levalbuterol'),--138
('Salbutamol','Asthalin',25.00,'Fast-acting bronchodilator','Headache, Palpitations','100-200 mcg as needed','picture_url_salbutamol'),--139
('Montelukast','Singulair',50.00,'Leukotriene receptor antagonist','Headache, Stomach pain','10 mg once daily','picture_url_montelukast'),--140
('Budesonide','Pulmicort',60.00,'Inhaled corticosteroid for asthma management','Throat irritation, Cough','200-400 mcg twice daily','picture_url_budesonide'),--141
('Fluticasone','Flovent',55.00,'Inhaled corticosteroid to prevent asthma attacks','Oral thrush, Cough','100-250 mcg twice daily','picture_url_fluticasone'),--142
('Salmeterol','Serevent',50.00,'Long-acting bronchodilator','Headache, Palpitations','50 mcg twice daily','picture_url_salmeterol'),--143
('Budesonide','Symbicort',70.00,'Combination inhaler for asthma control','Thrush, Cough','160/4.5 mcg twice daily','picture_url_symbicort'),--144
('Theophylline','Theo-24',40.00,'Bronchodilator for asthma management','Nausea, Insomnia','400 mg once daily','picture_url_theophylline'),--145
('Ipratropium','Atrovent',25.00,'Anticholinergic bronchodilator','Dry mouth, Dizziness','20 mcg four times a day','picture_url_ipratropium'),--146

('Omeprazole','Prilosec',50.00,'Proton pump inhibitor for reducing stomach acid','Headache, Nausea','20 mg once daily','picture_url_omeprazole'),--147
('Ranitidine','Zantac',30.00,'H2 blocker that decreases acid production','Dizziness, Diarrhea','150 mg twice daily','picture_url_ranitidine'),--148
('Pantoprazole','Protonix',55.00,'Proton pump inhibitor to heal ulcers','Diarrhea, Abdominal pain','40 mg once daily','picture_url_pantoprazole'),--149
('Simethicone','Gas-X',15.00,'Anti-foaming agent to relieve bloating','Mild diarrhea, Constipation','40 mg as needed','picture_url_simethicone'),--150
('Famotidine','Pepcid',25.00,'H2 blocker for treating ulcers','Fatigue, Dizziness','20 mg twice daily','picture_url_famotidine'),--151
('Ondansetron','Zofran',45.00,'Antiemetic for nausea relief','Headache, Constipation','4 mg as needed','picture_url_ondansetron'),--152
('Metoclopramide','Reglan',40.00,'Helps with nausea and promotes gastric emptying','Drowsiness, Restlessness','10 mg before meals','picture_url_metoclopramide'),--153
('Esomeprazole','Nexium',60.00,'Proton pump inhibitor for heartburn relief','Headache, Diarrhea','20 mg once daily','picture_url_esomeprazole'),--154
('Dexlansoprazole','Dexilant',65.00,'Proton pump inhibitor to heal ulcers','Nausea, Diarrhea','30 mg once daily','picture_url_dexlansoprazole'),--155
('Loperamide','Imodium',20.00,'Antidiarrheal for treating loose stools','Constipation, Dizziness','4 mg after first loose stool','picture_url_loperamide'),--156
('Sucralfate','Carafate',40.00,'Protects ulcers in the stomach and intestines','Constipation, Dry mouth','1 g four times daily','picture_url_sucralfate'),--157

('Nitroglycerin','Nitrostat',20.00,'Vasodilator for angina relief','Headache, Dizziness','0.4 mg as needed','picture_url_nitroglycerin'),--158
('Clopidogrel','Plavix',35.00,'Antiplatelet to prevent blood clots','Bleeding, Rash','75 mg daily','picture_url_clopidogrel'),--159
('Metoprolol','Lopressor',30.00,'Beta-blocker to manage heart rhythm','Fatigue, Dizziness','25 mg twice daily','picture_url_metoprolol'),--160
('Carvedilol','Coreg',50.00,'Beta-blocker for heart failure management','Low blood pressure, Dizziness','6.25 mg twice daily','picture_url_carvedilol'),--161
('Furosemide','Lasix',25.00,'Diuretic to reduce fluid retention','Electrolyte imbalance, Dizziness','20 mg once daily','picture_url_furosemide'),--162
('Ramipril','Altace',40.00,'ACE inhibitor for heart failure','Cough, Dizziness','2.5 mg once daily','picture_url_ramipril'),--163
('Bisoprolol','Zebeta',55.00,'Beta-blocker to reduce heart workload','Fatigue, Low heart rate','5 mg once daily','picture_url_bisoprolol'),--164
('Hydrochlorothiazide','Hydrodiuril',15.00,'Diuretic to lower blood pressure','Dizziness, Dehydration','25 mg once daily','picture_url_hydrochlorothiazide'),--165
('Diltiazem','Cardizem',60.00,'Calcium channel blocker for heart rhythm','Dizziness, Fatigue','120 mg daily','picture_url_diltiazem'),--166
('Verapamil','Calan',50.00,'Calcium channel blocker for hypertension','Constipation, Dizziness','80 mg daily','picture_url_verapamil'),--167
('Spironolactone','Aldactone',35.00,'Diuretic to manage fluid retention','Hyperkalemia, Dizziness','25 mg once daily','picture_url_spironolactone'),--168
('Torsemide','Demadex',45.00,'Loop diuretic for heart failure','Dizziness, Electrolyte imbalance','10 mg once daily','picture_url_torsemide'),--169
('Lisinopril','Prinivil',40.00,'ACE inhibitor to lower blood pressure','Cough, Dizziness','10 mg once daily','picture_url_lisinopril'),--170
('Amlodipine','Norvasc',50.00,'Calcium channel blocker for hypertension','Swelling, Flushing','5 mg once daily','picture_url_amlodipine'),--171
('Sertraline','Zoloft',45.00,'SSRI for anxiety and depression','Nausea, Dizziness','50 mg once daily','picture_url_sertraline'),--172
('Escitalopram','Lexapro',50.00,'SSRI for anxiety and depression','Fatigue, Nausea','10 mg once daily','picture_url_escitalopram'),--173
('Amiodarone','Cordarone',70.00,'Antiarrhythmic for heart rhythm stabilization','Lung toxicity, Dizziness','200 mg once daily','picture_url_amiodarone'),--174
('Dofetilide','Tikosyn',80.00,'Antiarrhythmic to maintain normal heart rhythm','Headache, Dizziness','500 mcg twice daily','picture_url_dofetilide'),--175
('Sotalol','Betapace',75.00,'Antiarrhythmic to control heart rate','Dizziness, Fatigue','80 mg twice daily','picture_url_sotalol'),--176
('Warfarin','Coumadin',35.00,'Anticoagulant to prevent blood clots after surgery','Bleeding, Nausea','5 mg once daily','picture_url_warfarin'),--177
('Clopidogrel','Plavix',35.00,'Antiplatelet to prevent blood clots','Bleeding, Rash','75 mg daily','picture_url_clopidogrel'),--178
('Atorvastatin','Lipitor',50.00,'Statin to lower cholesterol and reduce heart strain','Muscle pain, Nausea','10 mg once daily','picture_url_atorvastatin'),--179

('Metformin','Glucophage',25.00,'Biguanide that improves insulin sensitivity','Nausea, Diarrhea','500 mg twice daily','picture_url_metformin'),--180
('Canagliflozin','Invokana',40.00,'SGLT2 inhibitor that helps lower blood sugar','Urinary tract infections, Thirst','100 mg once daily','picture_url_canagliflozin'),--181
('Dapagliflozin','Farxiga',45.00,'SGLT2 inhibitor that promotes glucose excretion','Dehydration, Low blood pressure','10 mg once daily','picture_url_dapagliflozin'),--182
('Metformin','Glucophage',25.00,'Improves insulin sensitivity and lowers blood sugar','Nausea, Diarrhea','500 mg twice daily','picture_url_metformin'),--183
('Empagliflozin','Jardiance',50.00,'SGLT2 inhibitor that helps lower blood sugar','Urinary tract infections, Thirst','10 mg once daily','picture_url_empagliflozin'),--184
('Glipizide','Glucotrol',30.00,'Sulfonylurea that stimulates insulin release','Hypoglycemia, Weight gain','5 mg once daily','picture_url_glipizide'),--185
('Metformin','Glucophage',25.00,'Enhances insulin action and lowers glucose levels','Nausea, Diarrhea','500 mg twice daily','picture_url_metformin'),--186
('Pioglitazone','Actos',55.00,'Thiazolidinedione that improves insulin sensitivity','Weight gain, Edema','15 mg once daily','picture_url_pioglitazone'),--187
('Insulin Glargine','Lantus',70.00,'Long-acting insulin for blood sugar control','Hypoglycemia, Injection site reactions','Individualized','picture_url_insulin_glargine'),--188
('Metformin','Glucophage',25.00,'Helps control blood sugar levels','Nausea, Diarrhea','500 mg twice daily','picture_url_metformin'),--189
('Insulin Aspart','Novolog',60.00,'Fast-acting insulin for blood sugar management','Hypoglycemia, Weight gain','Individualized','picture_url_insulin_aspart'),--190
('Dapagliflozin','Farxiga',45.00,'Helps lower blood sugar through glucose excretion','Dehydration, Low blood pressure','10 mg once daily','picture_url_dapagliflozin'),--191
('Metformin','Glucophage',25.00,'Helps manage blood glucose levels','Nausea, Diarrhea','500 mg twice daily','picture_url_metformin'),--192
('Insulin Detemir','Levemir',75.00,'Long-acting insulin for stable blood sugar control','Hypoglycemia, Injection site reactions','Individualized','picture_url_insulin_detemir'),--193
('Glyburide','Diabeta',30.00,'Sulfonylurea to stimulate insulin production','Hypoglycemia, Weight gain','2.5 mg once daily','picture_url_glyburide'),--194
('Metformin','Glucophage',25.00,'Improves insulin sensitivity','Nausea, Diarrhea','500 mg twice daily','picture_url_metformin'),--195
('Pregabalin','Lyrica',50.00,'Treats nerve pain associated with diabetes','Dizziness, Drowsiness','75 mg twice daily','picture_url_pregabalin'),--196
('Duloxetine','Cymbalta',55.00,'Treats nerve pain and depression','Nausea, Fatigue','60 mg once daily','picture_url_duloxetine'),--197
('Metformin','Glucophage',25.00,'Helps regulate blood sugar levels','Nausea, Diarrhea','500 mg twice daily','picture_url_metformin'),--198
('Glipizide','Glucotrol',30.00,'Stimulates insulin release from the pancreas','Hypoglycemia, Weight gain','5 mg once daily','picture_url_glipizide'),--199
('Insulin Lispro','Humalog',60.00,'Fast-acting insulin to control post-meal blood sugar','Hypoglycemia, Weight gain','Individualized','picture_url_insulin_lispro'),--200
('Metformin','Glucophage',25.00,'Helps control blood glucose levels','Nausea, Diarrhea','500 mg twice daily','picture_url_metformin'),--201
('Cefalexin','Keflex',40.00,'Antibiotic for bacterial skin infections','Diarrhea, Allergic reactions','500 mg four times daily','picture_url_cefalexin'),--202
('Duloxetine','Cymbalta',55.00,'Antidepressant for mood stabilization','Nausea, Fatigue','60 mg once daily','picture_url_duloxetine'),--203
('Liraglutide','Saxenda',65.00,'GLP-1 agonist for appetite regulation','Nausea, Vomiting','0.6 mg once daily','picture_url_liraglutide'),--204
('Metformin','Glucophage',25.00,'Helps manage blood sugar levels','Nausea, Diarrhea','500 mg twice daily','picture_url_metformin'),--205
('Ondansetron','Zofran',50.00,'Antiemetic for nausea relief','Headache, Constipation','4 mg as needed','picture_url_ondansetron'),--206
('Prochlorperazine','Compazine',35.00,'Antipsychotic that can alleviate nausea','Drowsiness, Dizziness','5 mg every 6 hours','picture_url_prochlorperazine'),--207

('Orlistat','Xenical',60.00,'Lipase inhibitor that reduces fat absorption','Abdominal pain, Diarrhea','120 mg with each meal','picture_url_orlistat'),--208
('Phentermine','Adipex-P',45.00,'Appetite suppressant for short-term weight loss','Increased heart rate, Insomnia','37.5 mg once daily','picture_url_phentermine'),--209
('Lorcaserin','Belviq',70.00,'Serotonin receptor agonist that helps reduce appetite','Headache, Dizziness','10 mg twice daily','picture_url_lorcaserin'),--210
('Liraglutide','Saxenda',150.00,'GLP-1 receptor agonist that decreases appetite','Nausea, Vomiting','0.6 mg once daily','picture_url_liraglutide'),--211
('Naltrexone/Bupropion','Contrave',85.00,'Combination medication that reduces cravings','Nausea, Constipation','1 tablet (8 mg/90 mg) once daily','picture_url_naltrexone_bupropion'),--212
('Metformin','Glucophage',30.00,'Primarily for diabetes, it can aid weight loss','Gastrointestinal upset','500 mg twice daily','picture_url_metformin'),--213
('Phentermine','Adipex-P',45.00,'Appetite suppressant that can boost energy','Increased heart rate, Insomnia','37.5 mg once daily','picture_url_phentermine'),--214
('Bupropion','Wellbutrin',50.00,'Antidepressant that can also help with weight loss','Insomnia, Dry mouth','150 mg once daily','picture_url_bupropion'),--215
('Caffeine','Various',15.00,'Stimulant that can increase energy levels','Nervousness, Insomnia','200 mg as needed','picture_url_caffeine'),--216
('Meloxicam','Mobic',35.00,'Nonsteroidal anti-inflammatory drug for pain relief','Stomach upset, Dizziness','15 mg once daily','picture_url_meloxicam'),--217
('Ibuprofen','Advil',25.00,'Pain reliever that reduces inflammation','Stomach pain, Nausea','400 mg every 6-8 hours','picture_url_ibuprofen'),--218
('Acetaminophen','Tylenol',20.00,'Analgesic for mild to moderate pain','Liver damage (overdose)','500 mg every 4-6 hours','picture_url_acetaminophen'),--219
('Orlistat','Xenical',60.00,'Reduces fat absorption, may help with weight management','Abdominal pain, Diarrhea','120 mg with each meal','picture_url_orlistat'),--220
('Salbutamol','Ventolin',45.00,'Bronchodilator for asthma and breathing issues','Tremors, Palpitations','100-200 mcg as needed','picture_url_salbutamol'),--221
('Montelukast','Singulair',45.00,'Prevents asthma symptoms and can improve breathing','Headache, Stomach pain','10 mg once daily','picture_url_montelukast'),--222
('Lisinopril','Prinivil',35.00,'ACE inhibitor for hypertension','Dizziness, Cough','10 mg once daily','picture_url_lisinopril'),--223
('Amlodipine','Norvasc',40.00,'Calcium channel blocker for high blood pressure','Swelling, Dizziness','5 mg once daily','picture_url_amlodipine'),--224
('Hydrochlorothiazide','Microzide',25.00,'Diuretic that helps reduce blood pressure','Electrolyte imbalance','12.5 mg once daily','picture_url_hydrochlorothiazide'),--225
('Modafinil','Provigil',70.00,'Promotes wakefulness and helps with daytime sleepiness','Headache, Nausea','200 mg once daily','picture_url_modafinil'),--226
('Continuous Positive Airway Pressure (CPAP)','N/A',30.00,'Device to help keep airways open during sleep','Dry mouth, Skin irritation','N/A','picture_url_cpapsystem'),--227
('Doxepin','Silenor',55.00,'Sedative for sleep issues related to sleep apnea','Drowsiness, Dry mouth','3 mg to 6 mg at bedtime','picture_url_doxepin'),--228
('Metformin','Glucophage',30.00,'Improves insulin sensitivity and helps with weight loss','Gastrointestinal upset','500 mg twice daily','picture_url_metformin'),--229
('Pioglitazone','Actos',75.00,'Increases insulin sensitivity','Edema, Weight gain','15 mg once daily','picture_url_pioglitazone'),--230
('Liraglutide','Saxenda',150.00,'GLP-1 receptor agonist that improves blood sugar control','Nausea, Vomiting','0.6 mg once daily','picture_url_liraglutide'),--231
('Tretinoin','Retin-A',50.00,'Used for acne and other skin issues','Skin irritation, Dry skin','Apply once daily at night','picture_url_tretinoin'),--232
('Benzoyl Peroxide','Clearasil',20.00,'Antibacterial for acne treatment','Skin irritation, Dryness','Apply once daily','picture_url_benzoyl_peroxide'),--233
('Clindamycin','Cleocin',35.00,'Antibiotic for skin infections and acne','Skin dryness, Irritation','Apply twice daily','picture_url_clindamycin'),--234
('Sertraline','Zoloft',60.00,'Antidepressant that helps improve mood','Nausea, Dizziness','50 mg once daily','picture_url_sertraline'),--235
('Fluoxetine','Prozac',55.00,'Selective serotonin reuptake inhibitor (SSRI)','Insomnia, Weight gain','20 mg once daily','picture_url_fluoxetine'),--236
('Bupropion','Wellbutrin',50.00,'Antidepressant that can aid weight loss','Insomnia, Dry mouth','150 mg once daily','picture_url_bupropion'),--237

('Sertraline','Zoloft',60.00,'SSRI that helps improve mood and reduce anxiety','Nausea, Dizziness','50 mg once daily','picture_url_sertraline'),--238
('Fluoxetine','Prozac',55.00,'Antidepressant that increases serotonin levels','Insomnia, Weight gain','20 mg once daily','picture_url_fluoxetine'),--239
('Escitalopram','Lexapro',65.00,'SSRI used for treatment of depression and anxiety','Nausea, Fatigue','10 mg once daily','picture_url_escitalopram'),--240
('Bupropion','Wellbutrin',50.00,'Atypical antidepressant that helps with motivation','Insomnia, Dry mouth','150 mg once daily','picture_url_bupropion'),--241
('Venlafaxine','Effexor',70.00,'SNRI that treats depression and anxiety disorders','Nausea, Sweating','75 mg once daily','picture_url_venlafaxine'),--242
('Mirtazapine','Remeron',80.00,'Tetracyclic antidepressant that can improve sleep','Drowsiness, Weight gain','15 mg once daily','picture_url_mirtazapine'),--243
('Duloxetine','Cymbalta',70.00,'SNRI that also helps with pain relief','Nausea, Dry mouth','30 mg once daily','picture_url_duloxetine'),--244
('Trazodone','Desyrel',50.00,'Antidepressant that can aid sleep and improve mood','Drowsiness, Dizziness','150 mg at bedtime','picture_url_trazodone'),--245
('Lithium','Lithobid',90.00,'Mood stabilizer often used for bipolar disorder','Nausea, Tremors','300 mg two to three times daily','picture_url_lithium'),--246
('Sertraline','Zoloft',60.00,'SSRI that helps regulate appetite and mood','Nausea, Dizziness','50 mg once daily','picture_url_sertraline'),--247
('Fluoxetine','Prozac',55.00,'Can help in weight stabilization','Insomnia, Weight gain','20 mg once daily','picture_url_fluoxetine'),--248
('Naltrexone/Bupropion','Contrave',85.00,'Combination medication that helps reduce cravings','Nausea, Constipation','1 tablet (8 mg/90 mg) once daily','picture_url_naltrexone_bupropion'),--249
('Atomoxetine','Strattera',80.00,'Non-stimulant used to treat ADHD that can aid focus','Nausea, Fatigue','40 mg once daily','picture_url_atomoxetine'),--250
('Methylphenidate','Ritalin',70.00,'Stimulant that can enhance concentration','Insomnia, Decreased appetite','10 mg once daily','picture_url_methylphenidate'),--251
('Citalopram','Celexa',60.00,'SSRI that helps improve focus and mood','Nausea, Fatigue','20 mg once daily','picture_url_citalopram'),--252
('Trazodone','Desyrel',50.00,'Antidepressant that aids sleep','Drowsiness, Dry mouth','150 mg at bedtime','picture_url_trazodone'),--253
('Amitriptyline','Elavil',40.00,'TCA used for depression and insomnia','Drowsiness, Weight gain','25 mg at bedtime','picture_url_amitriptyline'),--254
('Doxepin','Silenor',55.00,'Used for sleep issues related to depression','Drowsiness, Dry mouth','3 mg to 6 mg at bedtime','picture_url_doxepin'),--255
('Sertraline','Zoloft',60.00,'Helps improve mood and outlook','Nausea, Dizziness','50 mg once daily','picture_url_sertraline'),--256
('Fluoxetine','Prozac',55.00,'Increases serotonin levels to help mood','Insomnia, Weight gain','20 mg once daily','picture_url_fluoxetine'),--257
('Venlafaxine','Effexor',70.00,'SNRI that treats depressive symptoms','Nausea, Sweating','75 mg once daily','picture_url_venlafaxine'),--258
('Bupropion','Wellbutrin',50.00,'Atypical antidepressant that helps regulate mood','Insomnia, Dry mouth','150 mg once daily','picture_url_bupropion'),--259
('Paroxetine','Paxil',65.00,'SSRI that helps manage anxiety and irritability','Drowsiness, Nausea','20 mg once daily','picture_url_paroxetine'),--260
('Duloxetine','Cymbalta',70.00,'SNRI that can help with irritability','Nausea, Fatigue','30 mg once daily','picture_url_duloxetine'),--261
('Sertraline','Zoloft',60.00,'Improves mood and social interactions','Nausea, Dizziness','50 mg once daily','picture_url_sertraline'),--262
('Venlafaxine','Effexor',70.00,'Treats depression and can improve social interactions','Nausea, Sweating','75 mg once daily','picture_url_venlafaxine'),--263
('Mirtazapine','Remeron',80.00,'Can help improve mood and social engagement','Drowsiness, Weight gain','15 mg once daily','picture_url_mirtazapine'),--264
('Fluoxetine','Prozac',55.00,'Antidepressant that can help reduce suicidal ideation','Insomnia, Weight gain','20 mg once daily','picture_url_fluoxetine'),--265
('Sertraline','Zoloft',60.00,'SSRI that can improve mood and reduce suicidal thoughts','Nausea, Dizziness','50 mg once daily','picture_url_sertraline'),--266
('Quetiapine','Seroquel',90.00,'Antipsychotic that can help manage severe depression','Drowsiness, Weight gain','300 mg once daily','picture_url_quetiapine'),--267

('Atorvastatin','Lipitor',70.00,'Statin that reduces LDL cholesterol levels','Muscle pain, Liver enzyme changes','10 mg once daily','picture_url_atorvastatin'),--268
('Rosuvastatin','Crestor',80.00,'Statin that helps lower cholesterol and triglycerides','Muscle pain, Nausea','5 mg once daily','picture_url_rosuvastatin'),--269
('Simvastatin','Zocor',60.00,'Statin that lowers cholesterol by inhibiting its production','Muscle pain, Constipation','20 mg once daily','picture_url_simvastatin'),--270
('Atorvastatin','Lipitor',70.00,'Reduces total cholesterol levels in the blood','Muscle pain, Liver enzyme changes','10 mg once daily','picture_url_atorvastatin'),--271
('Lovastatin','Mevacor',55.00,'Statin used to lower total cholesterol and LDL levels','Muscle pain, Nausea','20 mg once daily','picture_url_lovastatin'),--272
('Ezetimibe','Zetia',65.00,'Reduces cholesterol absorption from the diet','Diarrhea, Fatigue','10 mg once daily','picture_url_ezetimibe'),--273
('Fenofibrate','Tricor',75.00,'Lowers triglyceride levels and can raise HDL cholesterol','Stomach pain, Headache','48 mg once daily','picture_url_fenofibrate'),--274
('Niacin','Niacor',50.00,'B vitamin that can help lower triglycerides and increase HDL','Flushing, Itching','500 mg three times daily','picture_url_niacin'),--275
('Omega-3 Fatty Acids','Lovaza',90.00,'Fish oil supplement that can lower triglyceride levels','Fishy aftertaste, Nausea','4 grams daily','picture_url_omega3'),--276
('Atorvastatin','Lipitor',70.00,'Reduces risk of heart disease by lowering cholesterol','Muscle pain, Liver enzyme changes','10 mg once daily','picture_url_atorvastatin'),--277
('Rosuvastatin','Crestor',80.00,'Statin that helps reduce chest pain symptoms','Muscle pain, Nausea','5 mg once daily','picture_url_rosuvastatin'),--278
('Aspirin','Bayer',25.00,'Blood thinner that reduces the risk of heart attacks','Stomach upset, Bleeding','81 mg once daily','picture_url_asprin'),--279
('Atorvastatin','Lipitor',70.00,'Lowers cholesterol levels, improving overall health','Muscle pain, Liver enzyme changes','10 mg once daily','picture_url_atorvastatin'),--280
('Niacin','Niacor',50.00,'Increases HDL cholesterol, which can improve energy','Flushing, Itching','500 mg three times daily','picture_url_niacin'),--281
('Fibrates','Trilipix',60.00,'Used to lower triglycerides and cholesterol','Stomach pain, Headache','135 mg once daily','picture_url_fibrates'),--282
('Ezetimibe','Zetia',65.00,'Helps lower cholesterol levels, reducing nausea','Diarrhea, Fatigue','10 mg once daily','picture_url_ezetimibe'),--283
('Fenofibrate','Tricor',75.00,'Lowers triglyceride levels, may help with nausea','Stomach pain, Headache','48 mg once daily','picture_url_fenofibrate'),--284
('Atorvastatin','Lipitor',70.00,'Effective in lowering cholesterol and triglycerides','Muscle pain, Liver enzyme changes','10 mg once daily','picture_url_atorvastatin'),--285
('Atorvastatin','Lipitor',70.00,'Helps manage cholesterol to prevent cardiovascular issues','Muscle pain, Liver enzyme changes','10 mg once daily','picture_url_atorvastatin'),--286
('Rosuvastatin','Crestor',80.00,'Lowers cholesterol, reducing heart disease risk','Muscle pain, Nausea','5 mg once daily','picture_url_rosuvastatin'),--287
('Aspirin','Bayer',25.00,'Prevents blood clots, improving blood flow','Stomach upset, Bleeding','81 mg once daily','picture_url_asprin'),--288
('Atorvastatin','Lipitor',70.00,'Statin that can help lower blood pressure indirectly','Muscle pain, Liver enzyme changes','10 mg once daily','picture_url_atorvastatin'),--289
('Rosuvastatin','Crestor',80.00,'Helps improve heart health and reduce blood pressure','Muscle pain, Nausea','5 mg once daily','picture_url_rosuvastatin'),--290
('Lisinopril','Prinivil',30.00,'ACE inhibitor that lowers blood pressure','Cough, Dizziness','10 mg once daily','picture_url_lisinopril'),--291
('Atorvastatin','Lipitor',70.00,'Rare side effect, needs monitoring','Muscle pain, Liver enzyme changes','10 mg once daily','picture_url_atorvastatin'),--292
('Rosuvastatin','Crestor',80.00,'Requires regular liver function tests','Muscle pain, Nausea','5 mg once daily','picture_url_rosuvastatin'),--293
('Simvastatin','Zocor',60.00,'Should be monitored for liver function','Muscle pain, Constipation','20 mg once daily','picture_url_simvastatin'),--294
('Atorvastatin','Lipitor',70.00,'Reduces risk of heart disease in patients with history','Muscle pain, Liver enzyme changes','10 mg once daily','picture_url_atorvastatin'),--295
('Rosuvastatin','Crestor',80.00,'Lowers cholesterol levels to prevent heart issues','Muscle pain, Nausea','5 mg once daily','picture_url_rosuvastatin'),--296
('Simvastatin','Zocor',60.00,'Effective in patients with family history of heart disease','Muscle pain, Constipation','20 mg once daily','picture_url_simvastatin'),--297

('Zolpidem','Ambien',80.00,'A sedative used for short-term treatment of insomnia','Dizziness, Drowsiness','5 mg before bedtime','picture_url_zolpidem'),--298
('Eszopiclone','Lunesta',85.00,'Non-benzodiazepine that helps initiate sleep','Dry mouth, Dizziness','1 mg before bedtime','picture_url_eszopiclone'),--299
('Ramelteon','Rozerem',75.00,'Melatonin receptor agonist that helps with sleep onset','Drowsiness, Fatigue','8 mg before bedtime','picture_url_ramelteon'),--300
('Zolpidem','Ambien',80.00,'Helps maintain sleep through the night','Dizziness, Drowsiness','5 mg before bedtime','picture_url_zolpidem'),--301
('Trazodone','Desyrel',60.00,'Antidepressant with sedative properties','Drowsiness, Dry mouth','50 mg before bedtime','picture_url_trazodone'),--302
('Doxepin','Silenor',70.00,'TCA used for insomnia that promotes sleep','Drowsiness, Weight gain','3 mg before bedtime','picture_url_doxepin'),--303
('Zolpidem','Ambien',80.00,'Used for maintaining sleep through the night','Dizziness, Drowsiness','5 mg before bedtime','picture_url_zolpidem'),--304
('Trazodone','Desyrel',60.00,'Helps improve sleep duration and quality','Drowsiness, Dry mouth','50 mg before bedtime','picture_url_trazodone'),--305
('Doxepin','Silenor',70.00,'Effective in treating insomnia in older adults','Drowsiness, Weight gain','3 mg before bedtime','picture_url_doxepin'),--306
('Eszopiclone','Lunesta',85.00,'Improves overall sleep quality','Dry mouth, Dizziness','1 mg before bedtime','picture_url_eszopiclone'),--307
('Melatonin','Various',30.00,'Hormone supplement that regulates sleep-wake cycles','Drowsiness, Headache','3 mg before bedtime','picture_url_melatonin'),--308
('Zaleplon','Sonata',75.00,'Short-acting hypnotic that helps with sleep quality','Dizziness, Drowsiness','10 mg before bedtime','picture_url_zaleplon'),--309
('Trazodone','Desyrel',60.00,'Can help improve sleep, reducing daytime fatigue','Drowsiness, Dry mouth','50 mg before bedtime','picture_url_trazodone'),--310
('Doxepin','Silenor',70.00,'Improves sleep and reduces daytime sleepiness','Drowsiness, Weight gain','3 mg before bedtime','picture_url_doxepin'),--311
('Modafinil','Provigil',100.00,'Used for excessive daytime sleepiness','Headache, Nausea','200 mg in the morning','picture_url_modafinil'),--312
('Diazepam','Valium',90.00,'Benzodiazepine that reduces anxiety and aids sleep','Drowsiness, Confusion','5 mg before bedtime','picture_url_diazepam'),--313
('Lorazepam','Ativan',85.00,'Benzodiazepine used for anxiety and sleep disorders','Drowsiness, Fatigue','1 mg before bedtime','picture_url_lorazepam'),--314
('Trazodone','Desyrel',60.00,'Reduces anxiety symptoms while promoting sleep','Drowsiness, Dry mouth','50 mg before bedtime','picture_url_trazodone'),--315
('Escitalopram','Lexapro',80.00,'SSRI that treats anxiety and depression, aiding sleep','Nausea, Drowsiness','10 mg once daily','picture_url_escitalopram'),--316
('Venlafaxine','Effexor',85.00,'SNRI that helps with anxiety and sleep','Nausea, Drowsiness','75 mg once daily','picture_url_venlafaxine'),--317
('Clonazepam','Klonopin',90.00,'Benzodiazepine for anxiety that aids sleep','Drowsiness, Confusion','0.5 mg before bedtime','picture_url_clonazepam'),--318
('Zolpidem','Ambien',80.00,'Aids in reducing restlessness, allowing sleep onset','Dizziness, Drowsiness','5 mg before bedtime','picture_url_zolpidem'),--319
('Eszopiclone','Lunesta',85.00,'Helps calm restlessness and improve sleep duration','Dry mouth, Dizziness','1 mg before bedtime','picture_url_eszopiclone'),--320
('Diphenhydramine','Benadryl',30.00,'Antihistamine that can induce sleep','Drowsiness, Dry mouth','25 mg before bedtime','picture_url_diphenhydramine'),--321
('Zolpidem','Ambien',80.00,'Helps restore sleep, reducing irritability','Dizziness, Drowsiness','5 mg before bedtime','picture_url_zolpidem'),--322
('Melatonin','Various',30.00,'Hormone that regulates sleep patterns','Drowsiness, Headache','3 mg before bedtime','picture_url_melatonin'),--323
('Valerian Root','Various',40.00,'Herbal remedy that may improve sleep quality','Drowsiness, Upset stomach','500 mg before bedtime','picture_url_valerian'),--324
('Zolpidem','Ambien',80.00,'Aids in overcoming sleep disturbances due to noise','Dizziness, Drowsiness','5 mg before bedtime','picture_url_zolpidem'),--325
('Eszopiclone','Lunesta',85.00,'Effective in helping maintain sleep amidst disturbances','Dry mouth, Dizziness','1 mg before bedtime','picture_url_eszopiclone'),--326
('Melatonin','Various',30.00,'Aids in achieving restful sleep even with noise','Drowsiness, Headache','3 mg before bedtime','picture_url_melatonin');--327

--for fever
('Acetaminophen','Tylenol',18.00,'Reduces fever and mild pain',' Liver toxicity with prolonged use','500 mg every 6 hours','picture_url_acetaminophen.jpg'),--328
('Naproxen','Aleve',20.00,'NSAID for fever and inflammation','Heartburn, Drowsiness ','250 mg every 8 hours ','picture_url_naproxen.jpg'),--329
('Diclofenac',' Voltaren',18.00,'Pain and fever reducer','Stomach pain, Nausea','50 mg every 8 hours','picture_url_diclofenac.jpg'),--330
('Mefenamic Acid','Ponstan',25.00 ,'Relieves fever and pain','Dizziness, Abdominal pain','500 mg every 8 hours ','picture_url_mefenamic.jpg'),--331
('Ibuprofen and Paracetamol Combination',' Combiflam',12.00,'Combined effect for fever and pain relief','Dizziness, Gastric irritation.jpg','500 mg every 8 hours','picture_url_combiflam'),--332
-- for cough
('Codeine','Codipront',20.00,'Narcotic cough suppressant','Constipation, Drowsiness','15 mg every 4-6 hours','picture_url_codeine.jpg'),--333
('Ambroxol','Levopront',18.00 ,'Expectorant and mucolytic','Nausea, Diarrhea','30 mg twice daily ','picture_url_ambroxol.jpg'),--334
('Levodropropizine','Lasolvan',20.00 ,'Reduces coughing reflex, effective in dry cough','Dizziness, Abdominal discomfort ','60 mg three times a day','picture_url_levodropropizine.jpg'),--335
('Butamirate Citrate','Sinecod',18.00 ,'Non-opioid cough suppressant for dry cough','Nausea, Dizziness','50 mg three times a day','picture_url_sinecod.jpg'),--336
('Pholcodine','Phensedyl',15.00 ,'Opioid derivative cough suppressant','Sedation, Constipation','10 mg every 6-8 hours','picture_url_pholcodine.jpg'),--337

--for headache
('Naproxen','Aleve',20.00,'NSAID for pain relief','Stomach pain, Heartburn','250 mg every 8-12 hours','picture_url_naproxen.jpg'),--338
('Diclofenac',' Voltaren',22.00,' Anti-inflammatory, reduces pain','Heartburn, Nausea','50 mg every 8 hours','picture_url_diclofenac.jpg'),--339
('Celecoxib','Celebrex',30.00,'COX-2 inhibitor, reduces pain and inflammation','Stomach pain, Diarrhea','100-200 mg twice daily','picture_url_celecoxib.jpg'),--340
('Indomethacin','Indocin',25.00,'NSAID for moderate to severe pain','Nausea, Dizziness','25-50 mg three times daily','picture_url_indomethacin.jpg'),--341
('Tramadol','Ultram',35.00,'Pain reliever for moderate pain','Drowsiness, Dizziness','50 mg every 4-6 hours','picture_url_tramadol.jpg'),--342

--for dizziness
('Meclizine','Antivert',15.00,'Antihistamine for motion sickness and dizziness ','Drowsiness, Dry mouth','25-50 mg once daily','picture_url_meclizine.jpg'),--343
('Betahistine','Serc',20.00,'Reduces vertigo by improving inner ear blood flow','Headache, Stomach upset','8-16 mg three times daily','picture_url_betahistine.jpg'),--344
('Prochlorperazine','Stemetil',18.00,'Used for dizziness and nausea control','Drowsiness, Dry mouth',' 5-10 mg three times daily','picture_url_prochlorperazine.jpg'),--345
('Diazepam','Valium',25.00,'Reduces dizziness by calming the nervous system','Drowsiness, Fatigue','2-10 mg as needed','picture_url_diazepam.jpg'),--346
('Tramadol','Ultram',35.00,'Pain reliever for moderate pain','Drowsiness, Dizziness','50 mg every 4-6 hours','picture_url_tramadol.jpg');--347

INSERT INTO Symptom_Condition_Medication (condition_id, symptom_id, medication_id) VALUES
(1,1,328),(1,1,329),(1,1,330),(1,1,331),(1,1,332),
(1,2,333),(1,2,334),(1,2,335),(1,2,336),(1,2,337),
(2,3,338),(2,3,339),(2,3,340),(2,3,341),(2,3,342),
(2,7,343),(2,7,344),(2,7,345),(2,7,346),(2,7,347);

INSERT INTO Symptom_Condition_Medication (condition_id, symptom_id, medication_id) VALUES
(2,3,101),(2,3,102),(2,3,103),(2,7,125),(2,7,126),(2,7,127),(2,5,128),(2,5,129),(2,5,130),(2,4,131),(2,4,132),(2,4,103),(2,4,134),(2,4,135),(2,4,136),(2,14,137),
(2,14,138),(2,14,139),(2,15,140),(2,15,141),(2,15,124),(2,16,142),(2,16,143),(2,16,144),(2,4,145),(2,4,146),(2,4,147),(2,17,148),(2,17,149),(2,17,103),(2,19,150),(2,19,151),(2,19,152),

(3,14,137),(3,14,138),(3,14,139),(3,2,140),(3,2,141),(3,2,142),(3,20,137),(3,20,143),(3,20,144),(3,21,145),(3,21,146),(3,21,147),(3,22,137),(3,22,141),(3,22,138),
(3,5,140),(3,5,141),(3,5,142),(3,23,137),(3,23,138),(3,23,143),(3,19,140),(3,19,141),(3,19,142),(3,24,142),(3,24,140),(3,24,146),(3,25,145),(3,25,137),(3,25,143),

(4,9,147),(4,9,148),(4,9,149),(4,26,150),(4,26,147),(4,26,151),(4,4,152),(4,4,147),(4,4,153),(4,27,148),(4,27,154),(4,27,151),(4,28,147),(4,28,148),(4,28,155),
(4,5,147),(4,5,151),(4,5,154),(4,29,147),(4,29,148),(4,29,149),(4,30,147),(4,30,148),(4,9,106),(4,31,156),(4,31,147),(4,31,148),(4,32,157),(4,32,147),(4,32,148),

(5,8,278),(5,8,158),(5,8,159),(5,14,160),(5,14,161),(5,14,162),(5,5,163),(5,5,164),(5,5,124),(5,15,160),(5,15,166),(5,15,167),(5,33,162),(5,33,168),(5,33,169),
(5,34,170),(5,34,171),(5,34,124),(5,23,125),(5,23,172),(5,23,173),(5,35,160),(5,35,136),(5,35,158),(5,36,174),(5,36,175),(5,36,176),(5,5,177),(5,5,159),(5,5,179),

(6, 37, 180), (6, 37, 181), (6, 37, 182), (6, 38, 183), (6, 38, 184), (6, 38, 185), (6, 5, 186), (6, 5, 187), (6, 5, 188), (6, 39, 189),(6, 39, 190),(6, 39, 191),(6, 40, 192),(6 , 40, 193),(6, 40, 194),
(6, 41, 195), (6, 41, 196), (6, 41, 197), (6, 42, 198), (6, 42, 199), (6, 42, 200), (6, 43, 201), (6, 43, 188), (6, 43, 202), (6, 70, 195),(6, 70, 203),(6, 70, 204),(6, 4, 205),(6, 4, 206),(6, 4, 207),

(7, 44, 208), (7, 44, 209), (7, 44, 210), (7, 45, 211), (7, 45, 212), (7, 45, 213), (7, 5, 214), (7, 5, 215), (7, 5, 216), (7, 46, 217),(7, 46, 218),(7, 46, 219),(7, 47, 220),(7, 47, 221),(7, 47, 222),
(7, 34, 223), (7, 34, 224), (7, 34, 225), (7, 48, 226), (7, 48, 227), (7, 48, 228), (7, 49, 229), (7, 49, 230), (7, 49, 231), (7, 50, 232),(7, 50, 233),(7, 50, 234),(7, 51, 235),(7, 51, 236),(7, 51, 237),

(8, 52, 238), (8, 52, 239), (8, 52, 240), (8, 53, 241), (8, 53, 242), (8, 53, 243), (8, 5, 244), (8, 5, 245), (8, 5, 246), (8, 71, 247),(8, 71, 248),(8, 71, 249),(8, 54, 250),(8, 54, 251),(8, 54, 252),
(8, 19, 253), (8, 19, 254), (8, 19, 255), (8, 55, 256), (8, 55, 257), (8, 55, 258), (8, 56, 259), (8, 56, 260), (8, 56, 261), (8, 57, 262),(8, 57, 263),(8, 57, 264),(8, 58, 265),(8, 58, 266),(8, 58, 267),

(9, 59, 268), (9, 59, 269), (9, 59, 270), (9, 60, 271), (9, 60, 272), (9, 60, 273), (9, 61, 274), (9, 61, 275), (9, 61, 276), (9, 8, 277),(9, 8, 278),(9, 8, 279),(9, 5, 280),(9, 5, 281),(9, 5, 282),
(9, 4, 283), (9, 4, 284), (9, 4, 285), (9, 14, 286), (9, 14, 287), (9, 14, 288), (9, 34, 289), (9, 34, 290), (9, 34, 291), (9, 62, 292),(9, 62, 293),(9, 62, 294),(9, 63, 295),(9, 63, 296),(9, 63, 297),

(10, 64, 298), (10, 64, 299), (10, 64, 300), (10, 65, 301), (10, 65, 302), (10, 65, 303), (10, 66, 304), (10, 66, 305), (10, 66, 306), (10, 67, 307),(10, 67, 308),(10, 67, 309),(10, 5, 310),(10, 5, 311),(10, 5, 312),
(10, 23, 313), (10, 23, 314), (10, 23, 315), (10, 68, 316), (10, 68, 317), (10, 68, 318), (10, 69, 319), (10, 69, 320), (10, 69, 321), (10, 56, 322),(10, 56, 323),(10, 56, 324),(10, 19, 325),(10, 19, 326),(10, 19, 327);

INSERT INTO Symptoms (symptom_name) VALUES 
('Skin infections'),
('Weight gain'),
('Increased appetite'),
('Joint pain'),
('Breathing difficulties'),
('Sleep apnea'),
('Insulin resistance'),
('Skin problems'),
('Emotional distress'),
('Persistent sadness'),
('Loss of interest'),
('Difficult concentration'),
('Feeling of hopelessness'),
('Irritability'),
('Social withdrawl'),
('Suicidal thoughts'),
('High LDL cholestrol'),
('High total cholestrol'),
('High triglycerides'),
('Jaundice'),
('Family history of heart disease'),
('Difficulty falling asleep'),
('Waking up frequently'),
('Early morning awakening'),
('Poor sleep quality'),
('Stress'),
('Restlessness'),
('Mood Changes'),
('Changes in Appetite');

-- added on 14th nov
DELETE FROM NutritionalSupplements;


INSERT INTO NutritionalSupplements (SupplementName, Price, ns_qty, Description, Dosage, Picture) VALUES
('Olfit Softgel Capsule', 359.1, 'Per 30 capsules', 'Joint health and mobility support.', 'Take 1 capsule daily with water, or as directed by a healthcare provider.', 'olfit_softgel.jpg'),
('Vitomax Capsule', 225, 'Per 10 capsules', 'Energy and immune boost.', 'Take 1 capsule daily, preferably with a meal, or as prescribed.', 'vitomax_capsule.jpg'),
('ERACT-X Sachet', 95.4, '10 gm', 'Vitality enhancer and promotes general wellness.', 'Dissolve 1 sachet in water and take once daily, or as advised by a physician.', 'eract_x_sachet.jpg'),
('Reno albumen cardamom powder', 703.1, '200 gm', 'Renal support with cardamom.', 'Mix 1-2 scoops in water or milk daily, as directed by a healthcare professional.', 'reno_albumen_cardamom.jpg'),
('Kompact junior chocolate flavour powder', 386.1, '200 gm', 'Nutritional chocolate powder for kids supporting growth and development.', 'Mix 1-2 tablespoons in milk or water; recommended once daily.', 'kompact_junior_chocolate.jpg'),
('Ziprovit powder', 243, '200 gm', 'A multivitamin and mineral powder supplement formulated to boost energy and immunity.', 'Take 1-2 teaspoons in water or milk daily, or as prescribed.', 'ziprovit_powder.jpg'),
('Hijam Plus Sachet', 119.0, '12.5 gm', 'Nutritional supplement for use with mothers milk.', 'Mix 1-2 scoops with water or milk once daily, as directed by a physician.', 'hijam_plus_sachet.jpg'),
('Osmoset Vanilla flavour powder', 476.1, '200 gm', 'Nutritional powder formulated for hydration and electrolyte balance.', 'As prescribed by a doctor.', 'osmoset_vanilla.jpg'),
('Himalayan organics Chelated Iron with Vitamin C', 509.5, '120 tablets', 'Rich source of iron and Vitamin C for production of RBC.', '1 tablet per day (preferred after meal)', 'himalayan_organics_chelated_iron.jpg'),
('Ultra D3 drops', 39.2, '15 ml', 'Medicine to treat Vitamin D3 deficiency for children.', '1 ml daily', 'ultra_d3_drops.jpg'),
('Feroglobin B12 capsule', 116.6, '15 capsules', 'Nutritional supplement with vitamins and minerals.', '1 per day (after meal)', 'feroglobin_b12_capsule.jpg'),
('Ozivas daily womens multi', 449.1, '60 tablets', 'Nutritional needs of women with a blend of 23 vital vitamins, minerals, and herbs.', '1 tablet per day (after 1 hour of meal)', 'oziva_daily_womens_multi.jpg'),
('Calcimax-P Suspension', 168.3, '200 ml', 'To help maintain strong bones.', '5 ml per day (2.5ml two times)', 'calcimax_p_suspension.jpg'),
('Ultra Magnesium 200 mg Tablet', 170.6, '200 mg', 'A dietary supplement essential for normal psychological function and optimum strength.', 'As prescribed by the doctor.', 'ultra_magnesium_200mg.jpg'),
('Pentasure 2.0 Vanilla Flavour High Protein Powder', 1904, '400 gm', 'To offer increased energy levels and superior protein intake.', 'For 110 ml reconstituted feeding, mix 4 level scoops with 70 ml of freshly boiled and cooled water.', 'pentasure_high_protein.jpg'),
('Pediasure Chocolate Flavour Nutrition Powder for Kids Growth', 770, '400 gm', 'To support healthy growth and development in children.', 'Mix 3 tablespoons in 130 ml of milk OR 5 tablespoons in 190 ml of water.', 'pediasure_chocolate.jpg'),
('Aquasol A Capsule', 32, 'Per 30 capsules', 'To treat Vitamin A deficiency and nutritional deficiencies.', '1-2 capsules daily', 'aquasol_a_capsule.jpg'),
('Calcimax D 1000 Tablet', 341.6, 'Per 30 capsules', 'To treat and prevent calcium and vitamin D deficiency.', 'Take as advised by the doctor.', 'calcimax_d_1000.jpg'),
('OZiva Hair Vitamins', 449, 'Per 30 capsules', 'For hair growth and hairfall control.', 'Take one Oziva hair capsule twice daily with water.', 'oziva_hair_vitamins.jpg'),
('Ourdaily Vitamin E', 42, 'Per 10 capsules', 'Promotes healthy skin.', 'Take one capsule daily or as directed by your physician.', 'ourdaily_vitamin_e.jpg'),
('Zincovit tablet', 103.1, 'Per 15 tablets', 'Supports overall body functioning with essential vitamins and minerals.', 'As prescribed by physician.', 'zincovit_tablet.jpg');

-- added on 17th nov
ALTER TABLE user_orders
ADD COLUMN refill_reminder_sent BOOLEAN DEFAULT FALSE,
ADD COLUMN refill_date DATE;

UPDATE user_orders
SET refill_date = DATE_ADD(order_date, INTERVAL 30 DAY);

--added on 22nd nov
ALTER TABLE user_orders 
ADD COLUMN refill_date DATE AFTER order_date,
ADD COLUMN refill_reminder_sent BOOLEAN DEFAULT FALSE AFTER refill_date;


--added on 24th nov
USE Medisphere;
ALTER table users
ADD document_proof varchar(60);