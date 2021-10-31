# BitcubeEval


<h1>Bitcube evaluation </h1>

<h4>For this To work you need</h4>
    <p>PHPMYADMIN , PHP v7.4 min .</p>

<h4>Database Setup:</h4>
Import the db file in the directory 

<h4>Connection Details :</h4>
<table>
    <th>DB NAME</th>
    <th>DB USER</th>
    <th>DB PASSWORD</th>
    <th>DB HOSTNAME</th>
    <tr><td>bitcubeeval</td><td>root</td><td></td><td>localhost</td></tr>
</table>

<h4>If you setting are diferent from this :</h4>
<p>Change the config.php file in the folowing code</p>

public function connect($db="")<br >
{<br >
    &nbsp;&nbsp;&nbsp;&nbsp;if($_SERVER['HTTP_HOST']=='pondacams.com'){<br >
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$conn = new mysqli('localhost','root','','BitcubeEval');<br >
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;return $conn;<br >
    &nbsp;&nbsp;&nbsp;&nbsp;}else{<br >
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;$conn = new mysqli('localhost','root','','BitcubeEval');<br >
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;return $conn;<br >
    &nbsp;&nbsp;&nbsp;&nbsp;}<br >

}<br >

