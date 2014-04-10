load data
infile 'publicity_links.csv'
into table Publicity_links
fields terminated by "," optionally enclosed by '"'		  
( url, website_name, projname)