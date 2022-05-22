select 
    co.id, 
    co.title course_title, 
    ca.title category_title 
from 
    courses co 
inner join 
    categories ca on co.category_id = ca.id 
order by 
    co.id;
    
id  course_title  category_title
--  ------------  --------------
1   PHP Basic     プログラミング
2   PHP Database  プログラミング
3   Python Basic  プログラミング
4   Web Design    デザイン


select 
    *
from 
    courses co 
inner join 
    categories ca 
on 
    co.category_id = ca.id 
order by 
    co.id;

id  title         learning_time  category_id  id  title  
--  ------------  -------------  -----------  --  -------
1   PHP Basic     30             1            1   プログラミング
2   PHP Database  50             1            1   プログラミング
3   Python Basic  40             1            1   プログラミング
4   Web Design    50             2            2   デザイン


select
 co.id course_id, 
 co.title course_title, 
 se.id section_id, 
 se.title section_title, 
 se.no section_no, 
 hi.created_at 
from
 histories hi 
 inner join sections se on hi.section_id = se.id 
 inner join courses co on se.course_id = co.id 
where
 hi.account_id = :account_id
order by
 hi.created_at desc;
