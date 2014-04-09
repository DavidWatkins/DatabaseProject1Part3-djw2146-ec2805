load data
infile 'food_requests.csv'
into table Food_requests
fields terminated by "," optionally enclosed by '"'		  
( item, quantity, projname, category )