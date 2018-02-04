<?php
		echo '<h2>Function to look for a current folder name and rename it if the date is different</h2><br>';
		//Get current date
    $current_Date = date('Ymd');
		echo 'Current Date string as Ymd: '.$current_Date.'<br /><br />';
	  //Search for current folder name
		$folder = glob($_SERVER['DOCUMENT_ROOT'].'/az-*', GLOB_ONLYDIR);
		echo 'Found current folder: '.$folder[0].'<br /><br />';
		$s = substr(str_shuffle(str_repeat("0123456789abcdefghijklmnopqrstuvwxyz", 5)), 0, 5);
		echo 'New Random Generated String: '.$s.'<br /><br />';
		$oldfolder = $folder[0];
    //Display date in current folder
		echo "Condition checks current date as <br>Current Ymd: ".date('Ymd').'<br />';
    //Display current date
    echo "&nbsp;&nbsp;Folder Ymd: ".substr(basename($oldfolder),3,-5);
		echo '<br><br>';
    //Check for date match
		If (date('Ymd') != substr(basename($oldfolder),3,-5)) {	
		try {
		$newfolder = "{$_SERVER['DOCUMENT_ROOT']}/az-".$current_Date.$s;
		//Rename folder 
		rename($oldfolder,$newfolder);
		echo "Dates are not equal.<br>The folder will be renamed from <b>".$oldfolder."</b> to <b>".$newfolder."</b><br>";
		} catch (Exception $e) {
		echo 'Caught exception: ',  $e->getMessage(), "\n";
		}
		}else{
			echo "The Dates match so no rename will be performed!";
			// set variable to current folder name
			$newfolder = $oldfolder;
			}
 ?>
