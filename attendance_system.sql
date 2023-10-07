CREATE DATABASE IF NOT EXISTS attendance_system;


USE attendance_system;


CREATE TABLE student (
    serial INT PRIMARY Key NOT NULL,
    name VARCHAR(50) NOT NULL,
    id VARCHAR(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

CREATE TABLE attendance (
    attendance_id INT AUTO_INCREMENT PRIMARY KEY,
    student_serial INT NOT NULL,
    class_date DATE NOT NULL,
    is_present BOOLEAN NOT NULL,
    FOREIGN KEY (student_serial) REFERENCES student(serial)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

INSERT INTO `student` (`serial`, `name`, `id`) VALUES
(1, 'Fardin Alam Alif', 'MUH2025001M'),
(2, 'Fazilater Jahan', 'BFH2025002F'),
(3, 'Shoriful Habib', 'MUH2025003M'),
(4, 'Md. Asif Mahmud', 'MUH2025004M'),
(5, 'Md. Rabiul Islam Santo', 'MUH2025005M'),
(6, 'Nure Jannat', 'BKH2025006F'),
(7, 'Mir Mohammad Tahsin', 'MUH2025007M'),
(8, 'Kazi Ashikur Rahman', 'MUH2025008M'),
(9, 'Jannatun Nur Etu', 'BFH2025009F'),
(10, 'Sanjida Akter Samanta', 'BFH2025010F'),
(11, 'Md. Mahbub Hasan Talukder', 'MUH2025011M'),
(12, 'Md. Zahid Hasan', 'ASH2025012M'),
(13, 'Suraiya Akter', 'BKH2025013F'),
(14, 'Rubya Rashed', 'MUH2025014M'),
(15, 'Sumaiya Begum', 'BKH2025015F'),
(16, 'Md Raju Mia', 'MUH2025016M'),
(17, 'Mossa. Sumaiya Akter', 'BKH2025017F'),
(18, 'Md. Sanwar Hossain', 'MUH2025018M'),
(19, 'Md. Mamun Hossain', 'MUH2025019M'),
(20, 'Israt Jahan Jhumu', 'BKH2025020F'),
(21, 'Prity Rani Das', 'BFH2025021F'),
(22, 'Hasanur Rahman Shishir', 'MUH2025022M'),
(23, 'Sumaiyea Akter Prema', 'BKH2025023F'),
(24, 'Md. Nasim Molla', 'MUH2025024M'),
(25, 'Md. Foysal Mahmud', 'MUH2025025M'),
(26, 'Wakil Ahammad', 'ASH2025026M'),
(27, 'Imtiaz Chowdhury', 'MUH2025027M'),
(28, 'Mahamudul Hasan', 'MUH2025028M'),
(29, 'Mithun Chandra Sarker', 'MUH2025029M'),
(30, 'Abdullah Al Rafi', 'ASH2025030M'),
(31, 'Mehedi Hasan', 'MUH2025032M'),
(32, 'Md. Saiful Islam', 'MUH2025033M'),
(33, 'Toriqul Islam Shobuj', 'MUH2025035M'),
(34, 'Khos Mahmuda Akter', 'BKH2025036F'),
(35, 'Irfanul Haque Nabil', 'ASH1925021M');