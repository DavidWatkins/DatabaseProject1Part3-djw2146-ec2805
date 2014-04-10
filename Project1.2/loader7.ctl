load data
infile 'contributions.csv'
into table Contributions
fields terminated by "," optionally enclosed by '"'		  
( user_email, projname, category, percent_fulfilled )