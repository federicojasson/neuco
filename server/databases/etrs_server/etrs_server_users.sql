DELIMITER ; -- Sets the statement delimiter

-- Creates the database users
-- USAGE is used to specify users that have no privileges
GRANT USAGE ON *.* TO
'etrs_server_user'@'localhost' IDENTIFIED BY PASSWORD '*2470C0C06DEE42FD1618BB99005ADCA2EC9D1E19';

-- TODO: 2470C0C06DEE42FD1618BB99005ADCA2EC9D1E19 is 'password' (change it before release)