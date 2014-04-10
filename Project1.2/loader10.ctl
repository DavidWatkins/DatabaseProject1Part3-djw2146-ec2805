load data
infile 'updates.csv'
into table Updates
fields terminated by "," optionally enclosed by '"'		  
( projname, content, timestamp )