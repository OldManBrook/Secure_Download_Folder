<!doctype html>
<html>

<head>
  <meta charset="UTF-8">
  <title>Directory Contents</title>
  <link rel="stylesheet" href=".style.css">
  <script src=".sorttable.js"></script>
</head>
<body>
  <div id="container">
    <h1>Directory Contents</h1>
    <table class="sortable">
      <thead>
        <tr>
          <th>Filename</th>
          <th>Type</th>
          <th>Size <small>(bytes)</small></th>
          <!--th>Date Modified</th-->
        </tr>
      </thead>
      <tbody>
    <?php
	  //Get current date
    $current_Date = date('Ymd');
    //Search for current folder  
		$folder = glob('{$_SERVER[\'DOCUMENT_ROOT\']}/az-*', GLOB_ONLYDIR);
		$oldfolder = $folder[0];
    //Create random string
		$s = substr(str_shuffle(str_repeat("0123456789abcdefghijklmnopqrstuvwxyz", 5)), 0, 5);
    //Create new folder name
		$newfolder = "{$_SERVER['DOCUMENT_ROOT']}/az-".$current_Date.$s;
    //Check if current date is in current folder name
		If (date('Ymd') != substr(basename($oldfolder),3,-5)) {
		try {
    //Rename Folder
		rename($oldfolder,$newfolder);
		//echo "Folder renamed from ".$oldfolder." to ".$newfolder."<br>";
		} catch (Exception $e) {
		echo 'Caught exception: ',  $e->getMessage(), "\n";
		}
		}else{
			$newfolder = $oldfolder;
			}	
		
		// Opens directory
		$myDirectory=opendir($newfolder."/downloadfiles/");
        
        // Gets each entry
		//while(false !== ($entryName = readdir($myDirectory))) {
        while($entryName=readdir($myDirectory)) {
          $dirArray[]=$entryName;
        }
        
        // Finds extensions of files
        function findexts ($filename) {
          $filename=strtolower($filename);
          $exts=split("[/\\.]", $filename);
          $n=count($exts)-1;
          $exts=$exts[$n];
          return $exts;
        }
        
        // Closes directory
        closedir($myDirectory);
        
        // Counts elements in array
        $indexCount=count($dirArray);
        
        // Sorts files
        sort($dirArray);
        
        // Loops through the array of files
        for($index=0; $index < $indexCount; $index++) {
        
          // Allows ./?hidden to show hidden files
          if($_SERVER['QUERY_STRING']=="hidden")
          {$hide="";
          $ahref="./";
          $atext="Hide";}
          else
          {$hide=".";
          $ahref="./?hidden";
          $atext="Show";}
          if(substr("$dirArray[$index]", 0, 1) != $hide) {
          
          // Gets File Names
          $name=$dirArray[$index];
          $namehref=$dirArray[$index];
          
          // Gets Extensions 
          $extn=findexts($dirArray[$index]); 
          
          // Gets file size 
          //$size=number_format(filesize($_SERVER['DOCUMENT_ROOT'].'/12w/mame_rom_q/'.$dirArray[$index])); 
          $size=number_format(filesize($newfolder."/mame_rom_q/".$dirArray[$index])); //".$newfolder."
		  
          // Gets Date Modified Data
          //$modtime=date("M j Y g:i A", filemtime($_SERVER['DOCUMENT_ROOT'].'/12w/mame_rom_q/'.$dirArray[$index]));
		  $modtime=date("M j Y g:i A", filemtime($newfolder."/mame_rom_q/".$dirArray[$index]));
          //$timekey=date("YmdHis", filemtime($_SERVER['DOCUMENT_ROOT'].'/12w/mame_rom_q/'.$dirArray[$index]));
		  $timekey=date("YmdHis", filemtime($newfolder."/mame_rom_q/".$dirArray[$index]));
          
          // Prettifies File Types, add more to suit your needs.
          switch ($extn){
            case "png": $extn="PNG Image"; break;
            case "jpg": $extn="JPEG Image"; break;
            case "svg": $extn="SVG Image"; break;
            case "gif": $extn="GIF Image"; break;
            case "ico": $extn="Windows Icon"; break;
            
            case "txt": $extn="Text File"; break;
            case "log": $extn="Log File"; break;
            case "htm": $extn="HTML File"; break;
            case "php": $extn="PHP Script"; break;
            case "js": $extn="Javascript"; break;
            case "css": $extn="Stylesheet"; break;
            case "pdf": $extn="PDF Document"; break;
            
            case "zip": $extn="ZIP Archive"; break;
            case "bak": $extn="Backup File"; break;
            
            default: $extn=strtoupper($extn)." File"; break;
          }
          
          // Separates directories
          if(is_dir($dirArray[$index])) {
            $extn="&lt;Directory&gt;"; 
            $size="&lt;Directory&gt;"; 
            $class="dir";
          } else {
            $class="file";
          }
          
          // Cleans up . and .. directories 
          if($name=="."){$name=". (Current Directory)"; $extn="&lt;System Dir&gt;";}
          if($name==".."){$name=".. (Parent Directory)"; $extn="&lt;System Dir&gt;";}
          
          // Print 'em
          print("
          <tr class='$class'>
            <td><a href='dl.php?file=$namehref'>$name</a></td>
            <td><a href='dl.php?file=$namehref'>$extn</a></td>
            <td><a href='dl.php?file=$namehref'>$size</a></td>
            <td sorttable_customkey='$timekey'><a href='dl.php?file=$namehref'>$modtime</a></td>
          </tr>");
          }
        }
      ?>
      </tbody>
    </table>
  
    <h2><?php //print("<a href='$ahref'>$atext hidden files</a>"); ?></h2>
    
  </div>
  <script type="text/javascript">
//Check if page has been loaded direct, redirect to index if true
if(top.location == window.location) {
    window.location = '/';
}
window.onload=function(){
     document.body.style.display='block';
}
</script>
</body>

</html>
