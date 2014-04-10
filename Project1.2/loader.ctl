load data
infile 'Users.csv'
into table Users
fields terminated by "," optionally enclosed by '"'		  
( name, email, password, school, photo )