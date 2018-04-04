drop table if exists json_table;
	CREATE TABLE json_table(
		ID serial	PRIMARY KEY,
		data jsonb 	NOT NULL
	);