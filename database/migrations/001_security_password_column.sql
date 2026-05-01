-- Required for password_hash() values. The old varchar(45) is too short.
ALTER TABLE tbl_user MODIFY password varchar(255) NOT NULL DEFAULT '';
