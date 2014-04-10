load data
infile 'comments.csv'
into table Comments
fields terminated by "," optionally enclosed by '"'		  
( user_email, projname, content, timestamp )