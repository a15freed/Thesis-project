drop table if exists json_table;
	CREATE TABLE json_table(
		id INT PRIMARY KEY 	NOT NULL,
		data jsonb 			NOT NULL
	);