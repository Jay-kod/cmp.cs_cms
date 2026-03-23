-- Filtered from: database backup/dcms_backup_2026-03-18_11-47-19.sql
-- Purpose: restore ONLY Admin + Super Admin login users (by email).
-- Run example (from project root):
--   mysql -u root dcms_db < "database backup/filtered_users_only_from_dcms_backup_2026-03-18_11-47-19.sql"

INSERT INTO `users`
    (`name`, `email`, `is_admin`, `role`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`)
VALUES
    ('Super Admin', 'admin@dcms.nsuk.edu.ng', 1, 'super_admin', '2026-02-23 14:25:01',
     '$2y$12$gjgp.PVvCCG5uB5Y/s4wHOkN6apDw7igS.kYGp61bKQ1WFSVuziqe',
     'UGqMyb597QnEmGiSzqjdZJRGoCznNb0fGVuNjPgB6M8woZF3MQXw6yCVZf8c',
     '2026-02-22 19:50:06', '2026-02-23 14:25:01'),
    ('Admin User', 'staff@dcms.nsuk.edu.ng', 1, 'admin', '2026-02-23 14:25:01',
     '$2y$12$a2U1i61NNH/bw75fiaZMlOyT1z0LMPDodrW1UL3mPctQM2mz6B0eu',
     'CRVlqPoBhWhRectpHWJo9LuvOI93fRL8xNtdE1R6DB2SPLUL3a341duaP4dN',
     '2026-02-23 14:25:01', '2026-02-23 14:25:01')
ON DUPLICATE KEY UPDATE
    `name` = VALUES(`name`),
    `is_admin` = VALUES(`is_admin`),
    `role` = VALUES(`role`),
    `email_verified_at` = VALUES(`email_verified_at`),
    `password` = VALUES(`password`),
    `remember_token` = VALUES(`remember_token`),
    `created_at` = VALUES(`created_at`),
    `updated_at` = VALUES(`updated_at`);

