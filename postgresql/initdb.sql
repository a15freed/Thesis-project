drop table if exists testtabell cascade;
	CREATE TABLE testtabell(
		id INT PRIMARY KEY 	NOT NULL,
		testtext jsonb 		NOT NULL,
	);