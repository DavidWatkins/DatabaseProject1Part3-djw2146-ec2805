load data
infile 'likes.csv'
into table Likes
fields terminated by "," optionally enclosed by '"'		  
( user_email, projname )