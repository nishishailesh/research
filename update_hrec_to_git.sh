echo 'give username:'
read password
mysqldump -d -u$password research -p > research_blank.sql 
git add *
git commit
git push https://github.com/nishishailesh/research master
