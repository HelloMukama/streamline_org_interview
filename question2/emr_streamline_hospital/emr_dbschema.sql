1. patients
   - id (PK)
   - file_number
   - first_name
   - last_name
   - gender
   - date_of_birth
   - phone_number
   - next_of_kin_relationship
   - next_of_kin_phone_number
   - created_at
   - updated_at
   - deleted_at

2. medical_records
   - id (PK)
   - patient_id (FK to patients)
   - staff_id (FK to users)
   - symptoms
   - lab_test_id (FK to lab_tests)
   - medical_diagnosis_id (FK to medical_diagnoses)
   - treatment
   - outcome (e.g admitted, died, referred or discharged)
   - created_at
   - updated_at
   - deleted_at

3. lab_tests
   - id (PK)
   - name
   - duration
   - result
   - senior_lab_technician_id (FK to users)
   - created_at
   - updated_at

4. medical_diagnoses
   - id (PK)
   - name
   - icd_11_code
   - is_primary_diagnosis (boolean)
   - created_at
   - updated_at

5. drugs
   - id (PK)
   - name
   - brand_name
   - form
   - code
   - created_at
   - updated_at

6. prescriptions
   - id (PK)
   - medical_record_id (FK to medical_records)
   - drug_id (FK to drugs)
   - pharmacist_id (FK to users)
   - instructions
   - created_at
   - updated_at

7. appointments
   - id (PK)
   - patient_id (FK to patients)
   - clinic_id (FK to clinics)
   - staff_id (FK to users)
   - clinical_notes
   - date_and_time
   - status (i.e. postponed, brought forward, canceled, started or completed)
   - created_at
   - updated_at

8. clinics
    - id (PK)
    - name
    - created_at
    - updated_at

9. users
    - id (PK)
    - name
    - email
    - password
    - role (e.g. doctors, nurses, surgeons, pharmacists, lab technicians, senior lab technicians, administrators)
    - created_at
    - updated_at

10. audit_logs
    - id (PK)
    - user_id (FK to users)
    - action (e.g., created, modified, deleted)
    - table_name
    - record_id
    - created_at
    - updated_at
