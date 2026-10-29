-- Table #1 students table
CREATE TABLE IF NOT EXISTS students (

    -- Primary key for the students table
    student_id INT AUTO_INCREMENT PRIMARY KEY,


    -- Student name
    student_first_name VARCHAR(50) NOT NULL,
    student_last_name VARCHAR(50) NOT NULL,

    -- Student course
    student_course VARCHAR(50) NOT NULL,

    -- Student created at timestamp
    student_created_at TIMESTAMP NOT NULL 
    DEFAULT CURRENT_TIMESTAMP

) ENGINE=InnoDB 
DEFAULT CHARSET=utf8mb4 
COLLATE=utf8mb4_general_ci;

-- Table #2 books 

CREATE TABLE IF NOT EXISTS books (
    -- Primary key for the books table
    book_id INT AUTO_INCREMENT PRIMARY KEY,
    -- Book details
    book_title VARCHAR(50) NOT NULL,
    book_author VARCHAR(100) NOT NULL,
    book_category VARCHAR(50) NOT NULL,

    -- Book created at timestamp
    book_created_at TIMESTAMP NOT NULL
    DEFAULT CURRENT_TIMESTAMP


) ENGINE=InnoDB 
DEFAULT CHARSET=utf8mb4 
COLLATE=utf8mb4_general_ci;

-- Table #3 borrow
CREATE TABLE IF NOT EXISTS borrow(
    borrow_id INT AUTO_INCREMENT PRIMARY KEY,

    -- Foreign key references
    student_id INT NOT NULL,
    book_id INT NOT NULL,

    -- Borrow timestamp not null by default
    borrow_date TIMESTAMP NOT NULL 
    DEFAULT CURRENT_TIMESTAMP,

    -- Borrow return timestamp  null by default
    borrow_return_date TIMESTAMP NULL
    DEFAULT NULL,

    -- Borrow table constraints and foreign keys
    CONSTRAINT fk_borrow_student
        FOREIGN KEY (student_id)
        REFERENCES students(student_id)
        ON UPDATE CASCADE
        ON DELETE RESTRICT,

        CONSTRAINT fk_borrow_book
        FOREIGN KEY (book_id)
        REFERENCES books(book_id)
        ON UPDATE CASCADE
        ON DELETE RESTRICT

) ENGINE=InnoDB 
DEFAULT CHARSET=utf8mb4 
COLLATE=utf8mb4_general_ci;

INSERT INTO students (
    student_first_name,
    student_last_name,
    student_course
) VALUES
('HAZEL JANE', 'LIHOTAN', 'BSIT'),
('MARLOWE', 'COGUIHAN', 'BS CRIM'),
('VIBIAN', 'HINOYOG', 'BEED'),
('CHEZY DEIGH', 'CAHALIN', 'BSBA');

INSERT INTO books (
    book_title,
    book_author,
    book_category
) VALUES
   ('Hating Game', 'Sally Thorne', 'Romance'),
   ('The Love Hypothesis', 'Ali Hazelwood', 'Romance'),
   ('It Ends With Us', 'Colleen Hoover', 'Romance');

   INSERT INTO borrow (
    student_id,
    book_id
   ) VALUES 
   (1, 1),
   (2, 1),
   (3, 3);
    