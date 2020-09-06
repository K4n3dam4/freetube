# Freetube 1.2
### created by Nils Boehm

Freetube is an online video platform. It has a working backend and includes a  simple content management system.

### Content
1. Config
2. Channels


**1. Config**

1. Move the freetube folder into your Mamp/Xamp server environment
2. Dump the freetube_dump.sql file in a MySQL database tool like phpadmin
3. Open the Config.php file in the app/config directory
4. Change URLROOT to your server directory
5. Configure the database connection in the DatabaseConfig class

**IMPORTANT: If you need to rename the freetube folder you must also change the directory names in the Config and HTACCESS files.


**2. Channels**

To log into admin account use the following credentials:
* Channel Email: *john.doe@gmail.com*
* Password: *TestPasswort#123*

To log into other existing accounts please refer to your database. Every existing channel has the same password: *TestPasswort#123*

