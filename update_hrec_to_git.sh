echo 'Give mysql password'
read password
mysqldump -d -uroot research -p$password > research_blank.sql 
for tname in view_info_data
do
	mysqldump  -uroot -p$password research $tname -p$password > "research_$tname.sql"
done
git add *
git commit
git push https://github.com/nishishailesh/research master


