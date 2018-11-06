
DELIMITER @@; 

CREATE
    TRIGGER `encode` BEFORE INSERT ON `mybase`.`members`
    FOR EACH ROW BEGIN
        /*SELECT  AS tempa;
        SELECT  AS tempb;*/
        IF  STRCMP (NEW.st, 'A') = 0 THEN  
            SET NEW.icd = 'E10.x';
        END IF;
        IF  STRCMP (NEW.st, 'B') = 0 THEN  
            /*INSERT INTO `members`.icd VALUES('E11.x');*/
            SET NEW.icd = 'E11.x';
        END IF;
END; 

@@  -- Altered delimiter terminated compound statement

DELIMITER ; -- restore delimiter to standard semicolon

DELIMITER @@;

CREATE
    TRIGGER `encodetow` BEFORE INSERT ON `mybase`.`events`
    FOR EACH ROW BEGIN
        /*SELECT CAST(title AS UNSIGNED) FROM `events` AS tempaa;
        SELECT CAST(title AS UNSIGNED) FROM `events` AS tempbb;*/
        IF CAST(NEW.title AS UNSIGNED) < 71 THEN  
            /*Hypoglycemia, unspecified. E16.2*/
             SET NEW.icdlh = 'E16.2';
        END IF;
        IF  CAST(NEW.title AS UNSIGNED) > 179 THEN  
            /*ICD-10-CM Code R73.9. Hyperglycemia 180 mg/dl*/
            SET NEW.icdlh = 'E16.9';
        END IF;
END; 

@@  -- Altered delimiter terminated compound statement

DELIMITER ; -- restore delimiter to standard semicolon

