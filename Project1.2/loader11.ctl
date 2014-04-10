load data
infile 'team_memberships.csv'
into table Team_memberships
fields terminated by "," optionally enclosed by '"'		  
( projname, user_email )