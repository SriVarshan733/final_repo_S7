sudo apt update 
sudo su
sudo apt install apache2
sudo apt install php libapache2-mod-php php-mysql
sudo apt install mysql-client
cd /var/www/html/
rm index.html
git clone https://github.com/SriVarshan733/final_repo_S7.git
cd final_repo_S7 
mv * ../
cd ..
mysql -u admin -h  AWS-RDS-DATABSE-ENDPOINT -P 3306 -p
CREATE DATABASE kk;
use kk;
exit
cd admin/assets/
chmod 777 uploads