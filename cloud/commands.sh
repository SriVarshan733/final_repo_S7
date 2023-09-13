sudo apt update 
sudo su
sudo apt install apache2
sudo apt install software-properties-common
sudo add-apt-repository ppa:deadsnakes/ppa
sudo apt update
sudo apt install python3.8
wget https://bootstrap.pypa.io/get-pip.py
sudo python3.8 get-pip.py
pip install mysql-connector-python
import mysql.connector
print(mysql.connector.__version__)
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
