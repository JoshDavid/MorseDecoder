<html>
<head>
   <title> Courses taken </title>
   <link rel="stylesheet" type="text/css" href="style.css">
<?php
   include_once('header.php');
?>
</head>

<body>
<h2> Enter a message in Morse Code. The decoded result will be printed. </h2>
<!--
<p>
   Planned addition :
   Select which character you would like to delimit your morse code message by.

</p>
<form id="inputform" action="MorseDecoder.php" method="post">
   <select name="Delimiter">
     <option value="a">/</option>
     <option value="b"> </option>
   </select>
<br>
-->
<form id="inputform" action="" method="post">
<textarea rows="4" cols="50" form="inputform" name="textarea"  placeholder="Enter Morse code here. Letters are separated by a '/' and spaces are treated as actual spaces in the message."></textarea>
</br>
<input type="submit">
</form>
</br>

<?php
// build the morse hashtable
$ht = Array();  // HashTable to store the MorseSymbol with alphanumeric keys
$data = file("Morse.txt");
foreach ($data as $k=>$v){
   $a = preg_split("/\t/", trim($v));
   $ht[$a[1]] = $a[0]; // key = morse code ; value = alphanumeric symbol.
}
$ht[" "] = " "; // Tell the hash table what to do if a space occurs.
// Make the hash table with the keys being Morse Code and the values being the
// alphanumeric symbols.
if(isset($_POST['textarea'])){
   $input = $_POST['textarea'];
   $Messages = $input;
}

$nl="<br />\n"; // new line in html and in php
echo "Decoded Message:$nl$nl";
$Messages=$Messages."/";
$d = preg_split("/\//", trim($Messages)); // delimit by the presence of a '/'
decodeMorse($d,$ht);

function decodeMorse ($LineOfMorse, $ht) {
   $l = count($LineOfMorse)-1; // length of the input array
   for ($i = 0; $i < $l; $i++) {
      $m=$LineOfMorse[$i];
      echo $ht[$m];
   }
   echo("$nl");
}
?>

</body>
</html>
