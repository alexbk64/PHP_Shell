# PHP_Shell
A simple PHP shell for ECS518U Operating Systems lab work. 


<h3>Requirements for your shell</h3>
<table border="2">
        <caption>Your simple shell should provide the following functions:</caption>
        <tr>
        <th>Cmd Name</th><th>Arguments</th><th>Behaviour</th><th>Error Conditions to Check
        </tr>
        <tr>
            <td>info</td><td>1: file or directory</td><td>List information about the file or directory (see below for specifics)</td><td>file or directory must exist</td>
        </tr>
        <tr>
          <td>files</td><td>(none)</td><td>List the files and directories by name, showing which are directories</td><td>none</td>
        </tr>
        <tr>
        <td>delete</td><td>1: file</td><td>Delete the file</td><td>File must exist</td>
        </tr>
        <tr>
        <td>copy</td><td>1: the 'from' file<br/>2: the 'to' file</td><td>Copy the 'from' file to the 'to' file</td><td>The 'from' file must exist and the 'to' file must not exist</td>
        </tr>
        <tr>
        <td>where</td><td>(none)</td><td>Show the current directory</td><td>(none)</td>
        </tr>
        <tr>
        <td>down</td><td>1: directory name</td><td>Change to the specified directory, inside the current directory</td><td>The directory exists</td>
        </tr>
        <tr>
        <td>up</td><td>(none)</td><td>Change to the parent of the current directory</td><td>If you are at the top of the directory tree, you should not be able to go further up</td>
        </tr>
</table><br/>
The ‘error conditions’ should be checked by your code. For example, if the user asks for ‘info’ on a file that does not exist, the shell should display a helpful error message before continuing.<br/>
<p><h3>The following general error conditions should also be checked:</h3><ol>
<li>The correct number of arguments is given.</li>
<li>Operations on the file system succeed. For example, it may not be possible to delete a file (e.g. because of permissions).</li></ol></p>
<p><h3>The following information should be listed by the info command:</h3><ul>
<li>Whether the name is a directory or ordinary file</li>
<li>The owner of the file or directory</li>
<li>The date the file or directory was last changed</li>
<li>For files that are not directories</li><ul>
<li>The size of the file in bytes</li>
<li>Whether the file is executable</li></ul></ul></p>
<p><h3>It is ok to include additional information.</h3>
Apart from the requirements described above, you are free to design the interface as you like. Where the requirements are ambiguous, decide how your shell will behave.</p>
