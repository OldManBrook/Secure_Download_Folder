<?php
if(!empty($_GET['file'])){
	$dl_file = preg_replace("([^\w\s\d\-_~,;:\[\]\(\).]|[\.]{2,})", '', $_GET['file']); // simple file name validation
	$dl_file = filter_var($dl_file, FILTER_SANITIZE_URL); // Remove (more) invalid characters
    //$fileName = basename($_GET['file']);
	$folder = $folder = glob('$_SERVER[\'DOCUMENT_ROOT\']/az-*', GLOB_ONLYDIR);
	$newfolder = $folder[0];
    $filePath = $newfolder.'/downloadfiles/'.$dl_file;
    if(!empty($dl_file)){
        // Define headers
        header("Cache-Control: public");
        header("Content-Description: File Transfer");
		header('Content-Length: ' . filesize($filePath));
        header("Content-Disposition: attachment; filename=$dl_file");
        header("Content-Type: application/octet-stream");
        header("Content-Transfer-Encoding: binary");
        
        // Read the file
        readfile($filePath);
        exit;
    }else{
        echo 'The file does not exist.';
    }
}
?>
