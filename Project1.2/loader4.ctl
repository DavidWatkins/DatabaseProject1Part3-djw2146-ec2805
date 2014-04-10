load data
infile 'help_requests.csv'
into table Help_requests
fields terminated by "," optionally enclosed by '"'		  
( role, projname, category )