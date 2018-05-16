#!/usr/bin/php
<?php
/*
 * Outline Simple Shell - ECS518U Lab 4
 *
 *    COMMANDS          ERRORS CHECKED
 *    1. info XX         - check file/dir exists
 *    2. files
 *    3. delete  XX      - check file exists and delete succeeds
 *    4. copy XX YY      - XX exists, YY does not exist; copy succeeds
 *    5. where
 *    6. down DD         - check directory exists and change succeeds
 *    7. up              - check not at top
 */


date_default_timezone_set('Europe/London') ;
//$argc = $_SERVER['argc'];

$prompt = "PShell>" ;
fwrite(STDOUT, "$prompt ") ;
while (1) {
    $line = trim(fgets(STDIN)); // reads one line from STDIN
    $fields = preg_split("/\s+/", $line) ; 

    switch ($fields[0]) {
        case "files": 
            filesCmd();
           break ;
        case "info": 
            infoCmd($fields);
            break ;
        case "delete" :
            deleteCmd($fields);
            break;
        case "copy" :
            copyCmd($fields);
            break;
        case "where":
            whereCmd();
            break;
        case "down":
            downCmd($fields);
            break;
        case "up":
            upCmd();
            break;
            
        default:
	  echo("Unknown command $fields[0]\n") ;
    }

    fwrite(STDOUT, "$prompt ");
}

// ========================
//   files command
//      List file and directory names
//      No arguments
// ========================
function filesCmd() {
    if (empty(glob("*")))
        echo ("There are no files in this directory.\n");
    else {
        foreach (glob("*") as $filename) {
            if (is_dir($filename))
                echo("directory: ".$filename . "\n") ;
            else
                echo("file: ".$filename . "\n") ;
        }
    }
  
}

// ========================
//   info command
//      List file information
//      1 argument: file name
// ========================
function infoCmd($fields) {
    $file = $fields[1];
    //get file stats
    $stat = stat($file);
    if (file_exists($file)) {
        //Whether the name is a directory or ordinary file
        if (is_dir($file))
            echo($file . " is a  directory.\n");
        else
            echo($file . " is a  file.\n");
        //The owner of the file or directory
        //echo("Owner: " .fileowner($fields) . "\n");
        echo("Owner: " . posix_getpwuid($stat['uid'])['name'] . "\n");
        //The date the file or directory was last changed
        //echo("Last modified: ",filemtime($fields), "\n");
        echo("Last modified: " . date("Y-m-d\TH:i:s\Z", $stat['mtime']) . "\n");
        //For files that are not directories
        if (!is_dir($file)) {
            //o The size of the file in bytes
            echo("File size: ". $stat['size']. " bytes\n");
            //echo("File size: ",filesize($fields), "\n");
            //o Whether the file is executable
            if (is_executable($file))
                echo($file . " is executable.\n");
            else 
                echo($file . " is NOT executable.\n");
            //if (fileperms($fields))
            //echo("File permissions: ",fileperms($fields), "\n");
        }
    }
    else
        echo("No info yet") ;
}



//---------------------- 
// Other functions
//---------------------- 

// ========================
//   delete command
//      delete the file
//      1 argument: file name
// ========================
function deleteCmd($fields) { 
    $file = $fields[1];
    //check if file exists
    if (file_exists($file)) {
        //delete file, if successful, print success notice
        //else, print failure notice
        if (unlink($file))
            echo ($file . "has been deleted succesfully\n");
        else
            echo ("delete operation unsuccessful\n");
        
    }
}
// ========================
//   copy command
//      copies file/directory to another diectory
//      2 arguments: source file path, destination directory path
// ========================
function copyCmd($fields) { 
    $file = $fields[1];
    $target = $fields[2];
    //check if source file exists
    if (file_exists($file)) {
        //check if target file already exists
        if (!file_exists($target)){
            //if not, copy and print success message if successful
            if (copy($file, $target))
                echo ("copy successful\n");
            //otherwise print failure notice
            else
                echo("copy failed\n");
        }
        else
            echo "$target already exists in destination directory.\n";
        
    }
    else 
        echo "source file does not exist.\n";
}//END copyCmd
// ========================
//   where command
//      print current working directory
//      no arguments
// ========================
function whereCmd() { 
//getcwd()
    echo("The current directory is: " . getcwd() . "\n");
}
// ========================
//   down command
//      change to specified directory, inside current directory
//      1 argument: destination directory
// ========================
function downCmd($fields) { 
    echo("directory before change: " . getcwd() . "\n");//output directory before change
    if (chdir($fields[1]))
    //change directory
        echo ("directory change successful.\n");
    else
        echo ("directory change NOT successful.\n");
    //output directory after change
    echo("directory after change: " . getcwd() . "\n");
}//END downCmd
// ========================
//   up command
//      change to parent directory
//      no arguments
// ========================
function upCmd() {
    //get parent directory path
    if (getcwd()!==("/")){
        //print current working directory
        echo ("current directory before change: " . getcwd() . "\n");
        chdir("../");//go back one directory
        //print new working directory
        echo ("current directory after change: ". getcwd() . "\n");
    }
    else 
        echo "Cannot change to parent directory - already in top directory\n";
    //dirname(getcwd($fields), 1);*/
    
    

}//END upCmd

?>