-- Synthetic local demo data only. These are not real identity numbers.
-- Import once, after attendance_system.sql, into an empty local database.
START TRANSACTION;
INSERT INTO `class` (`class_id`, `form`, `class_name`) VALUES
(1, '5', 'Demo Class');
INSERT INTO `member` (`name`, `ic_number`, `class_id`, `role`, `password`) VALUES
('Demo Administrator', '000000000001', 1, 'Admin', 'DemoAdmin123'),
('Demo Member', '000000000002', 1, 'Student', 'DemoMember123');
INSERT INTO `activity` (`activity_id`, `activity_name`, `activity_date`, `start_time`) VALUES
(1, 'Demo Training Session', '2026-01-01', '14:00');
COMMIT;
