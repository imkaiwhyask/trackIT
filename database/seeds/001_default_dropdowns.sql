USE trackit_db;

INSERT INTO tbl_assettype (type) VALUES
('Laptop'),
('Desktop'),
('Monitor'),
('Printer'),
('Mobile Phone'),
('Tablet')
ON DUPLICATE KEY UPDATE type = VALUES(type);

INSERT INTO tbl_os (os) VALUES
('Windows'),
('macOS'),
('Linux')
ON DUPLICATE KEY UPDATE os = VALUES(os);

INSERT INTO tbl_assetstatus (status) VALUES
('Available'),
('Assigned'),
('For Repair'),
('For Disposal'),
('Disposed'),
('Lost')
ON DUPLICATE KEY UPDATE status = VALUES(status);

INSERT INTO tbl_condition (type) VALUES
('Brand New'),
('Good'),
('Fair'),
('For Repair'),
('Defective')
ON DUPLICATE KEY UPDATE type = VALUES(type);

INSERT INTO tbl_adstatus (status) VALUES
('Yes'),
('No')
ON DUPLICATE KEY UPDATE status = VALUES(status);

INSERT INTO tbl_role (role) VALUES
('IT'),
('User'),
('Admin')
ON DUPLICATE KEY UPDATE role = VALUES(role);

INSERT INTO tbl_type (main, mobile) VALUES
('Desktop', ''),
('Laptop', ''),
('Monitor', ''),
('Printer', ''),
('Mobile Phone', 'Mobile Phone'),
('Tablet', 'Tablet');
ON DUPLICATE KEY UPDATE main = VALUES(main), mobile = VALUES(mobile);

INSERT INTO tbl_accessories (asset, qty, colname, type, country) VALUES
('Bag', '0', 'bag', 'Laptop', 'Philippines'),
('Keyboard', '0', 'keyboard', 'Desktop', 'Philippines'),
('Mouse', '0', 'mouse', 'Laptop', 'Philippines'),
('UPS', '0', 'ups', 'Desktop', 'Philippines'),
('Charger', '0', 'charger', 'Laptop', 'Philippines'),
('Docking Station', '0', 'dockingStation', 'Laptop', 'Philippines'),
('Monitor 1', '0', 'monitor1', 'Desktop', 'Philippines'),
('Monitor 2', '0', 'monitor2', 'Desktop', 'Philippines')
ON DUPLICATE KEY UPDATE asset = VALUES(asset);
