# BitcubeEval
Bitcube evaluation 
For this To work you need  PHPMYADMIN , PHP v7.4 min .

Database Setup:
Import the db file in the directory 

Connection Details :

DB NAME : bitcubeeval
USER    : root
PASSWORD: NONE
HOSTNAME: localhost

if you setting are diferent from this :
Change the config.php file in the folowing code
public 
function connect($db=""){
    if($_SERVER['HTTP_HOST']=='pondacams.com'){
        $conn = new mysqli('localhost','root','','BitcubeEval');
        return $conn;
    }else{
        $conn = new mysqli('localhost','root','','BitcubeEval');
        return $conn;
    }

}
