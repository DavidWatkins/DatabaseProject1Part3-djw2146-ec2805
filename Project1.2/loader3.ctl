load data
infile 'support_requests.csv'
into table Support_requests
fields terminated by "," optionally enclosed by '"'		  
( description, category, percent_fulfilled, projname )