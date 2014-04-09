load data
infile 'projects.csv'
into table Projects
fields terminated by "," optionally enclosed by '"'		  
( projname, email, description, date_created, user_email )