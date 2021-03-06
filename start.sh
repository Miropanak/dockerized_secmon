#!/bin/bash

#copy configuration and installation files
cp docker-compose/db.php config/
cp docker-compose/anomaly_config.ini config/
cp docker-compose/docker-compose.yml .

#Set up color
RED='\033[0;31m'
GREEN='\033[0;32m'
NORMAL='\033[0m'

#Password creating
echo Create password for database user \'secmon\'
while true; do
	read -s -p "Enter Password: " password1
	echo
	
	if [ "${password1,,}" = "password" ];
		then echo -e "${RED}Entered passwor is forbidden, try again...${NORMAL}"; continue;
	fi
	
	if [ ${#password1} -lt 8 ];
		then echo -e "${RED}Entered password is shorten than 8 characters, try again...${NORMAL}"; continue;
	fi
	
	read -s -p "Re-enter Password: " password2
	echo

	if [ "${password1}" != "$password2" ]
		then echo -e "${RED}Sorry, passwords do not match, try again...${NORMAL}"; continue;
		else break;
	fi
done
echo -e "${GREEN}Password succesfully created${NORMAL}"

#update password in install and config files
sed -i "s/<password>/$password1/g" config/db.php
sed -i "s/<password>/$password1/g" config/anomaly_config.ini
sed -i "s/<password>/$password1/g" docker-compose.yml

docker-compose down
docker-compose build --no-cache
docker-compose up -d
docker exec -it app composer update
docker exec -it app ./yii migrate --interactive=0
sudo chown -R $USER:apache .
echo -e "Initializing SecMon admin user ...${GREEN}"
curl 127.0.0.1:8080/secmon/web/user/init
echo -e "${NORMAL}"
docker-compose restart
echo -e "${GREEN}Installation has been successfully completed${NORMAL}"
