load data
infile 'money_requests.csv'
into table Money_requests
fields terminated by "," optionally enclosed by '"'		  
( amount, is_all_or_nothing, projname, category )