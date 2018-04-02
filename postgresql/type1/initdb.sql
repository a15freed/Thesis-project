drop table if exists json_table;
	CREATE TABLE json_table(
		id SERIAL	PRIMARY KEY NOT NULL,
		data jsonb 				NOT NULL
	);