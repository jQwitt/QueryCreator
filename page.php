<?php
    session_start(); 
    require 'php/setup.php'; 
?>
<!DOCTYPE html>
<html lang="en">
    <head> 
        <meta charset="utf-8">
        <meta name="keywords" content="">
        <meta name="developer" content="Jack Witt">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>queryCreator | Jack Witt</title>
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <!-- google JQuery cdn -->
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <!-- google fonts cdn -->
        <link href="https://fonts.googleapis.com/css?family=Open+Sans|Roboto&display=swap" rel="stylesheet">
        <!-- font awesome cdn -->
        <script src="https://kit.fontawesome.com/4cc95541fa.js" crossorigin="anonymous" ></script>
    </head>
    <body>
        <div class='splash'>
            test
        </div>
        <div class='nav-bar'>
            <div class='nav'>
                <h2>SQL QueryCreator</h2>
            </div>
            <div id ='links'>
                <a href='https://www.linkedin.com/in/joseph-witt-52a960171/' target='_blank'>
                    <i class='blue fab fa-linkedin-in fa-2x'></i>
                </a>
                <a href='https://github.com/jQwitt' target='_blank'>
                    <i class='purple fab fa-github fa-2x'></i>
                </a>
                <a href='mailto:jwitt1452@gmail.com?subject=Job Opportunity!' target='_blank'>
                    <i class='red fas fa-envelope fa-2x'></i>
                </a>
            </div>
        </div>
        <div class='content container cols-4'>
            <div id='main' class='row-1'>
                <!-- query results added here -->
            </div>
            <div class='log row-2'>
                <div id='updates'></div>
                <div class='export'>
                    <button id='expt' class='blue'>Export Log</button>
                </div> 
            </div>
            <div class='tools'>
                <div class='container cols-4'>
                    <div id='connectionInputs' class='row-1 span-full container cols-4 rows-5'>
                        <input class='span-full row-1' type='text' name='user' placeholder='Username'>
                        <input class='span-full' type='text' name='pass' placeholder='Password'>
                        <input class='span-full' type='text' name='host' placeholder='Host Address'>
                        <input class='span-full' type='text' name='port' placeholder='Port'>
                        <input class='span-full' type='text' name='db' placeholder='Database'>
                    </div>
                    <button id='conn' class='green row-2 span-full'>Set Connection</button>

                    <!-- add custom controls here -->

                    <button id='drop-queryInputs' class='blue row-3 span-full'>Use Custom SQL</button>
                    <div id='queryInputs' class='container cols-4 row-4 span-full hidden'>
                        <textarea name='custom-query' class='row-1 span-full' placeholder='Enter Query Here...' style='resize: none; height: 2rem;'></textarea>
                        <button id='run' class='green row-2 span-left'>Run</button>
                        <button id='clear' class='red row-2'>Clear</button>
                        <button id='safe' class='green row-2'>Safe ON</button>
                    </div>
                    
                    
                </div>
            </div>
        </div>
        <div class='footer'>
            <h5>Copyright 2019 Jack Witt</h5>
        </div>
        <script type='text/javascript' src='scripts/phpCaller.js'></script> 
        <!-- <script type='text/javascript' src='scripts/splashAnimate.js'></script> FIX --> 
    </body>
</html> 

<!-- 
    TO DO 

    CUSTOM QUERY WRITER FUNCTIONALITY 
        - view
        - buttons to build it 
    EXPORT / IMPORT DATA INTO DATABASE
        - add data and create a table 
        - download the end results of a table 
        - drag and drop files
-->