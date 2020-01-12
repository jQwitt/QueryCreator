$(document).ready(function() {
    // helper functions 
    function dom(id) { return (typeof(id) === "string") ? $('#'+id)[0] : null; }
    function toggleVis(id) { 
        switch (typeof(id)) {
            case "string": 
                $('#'+id).toggleClass('hidden'); 
                break; 
            case "object":
                $(id).toggleClass('hidden'); 
                break;
        }
    }
    // utility to update log with correct syntax
    let log = dom('updates'); 
    function updateLog(s) {
        if (typeof(s) == "string") 
            log.innerHTML += (new Date().toLocaleString()) + ": " + s + "<br>"; 
    };
    // handles custom user input for a connection 
    var connectionSet = false; 
    let conn = dom('conn');  
    conn.onclick = () => { 
        if (!connectionSet) {
            $.ajax({
                url: 'php/setConnection.php',
                type: 'POST',
                data: {
                    // null coalesce env defaults for faster testing
                    'user': $('input[name="user"]').val() || 'root', 
                    'pass': $('input[name="pass"]').val() || 'root',
                    'host': $('input[name="host"]').val() || 'localhost',
                    'port': $('input[name="port"]').val() || 8889,
                    'db': $('input[name="db"]').val() || 'myDatabase'
                }, 
                success: (data) => { 
                    updateLog(data); 
                    var s = JSON.stringify(data);
                    // spaghetti code :( scans last chunk of output to see if connection viable
                    if (s.substring(s.length-6, s.length-1) === 'cess!') {
                        $(conn).toggleClass('red', 'green');
                        conn.innerHTML = 'Reset Connection' 
                        connectionSet = true; 
                    }
                }
            });
        } else {
            updateLog('connection variables reset'); 
            $(conn).toggleClass('red', 'green');
            conn.innerHTML = 'Set Connection' 
            connectionSet = false;  
        }
    };  
    // exports the log to a .txt
    let exp = dom('expt');
    exp.onclick = () => {
        // modeled after Carlos Delgado's approach (see .readMe)
        let toEXP = log.innerText;
        let toDL = document.createElement('a');
            toDL.setAttribute('href', 'data:text/plain;charset=utf-8,' + encodeURIComponent(toEXP));
            toDL.setAttribute('download', 'log.txt');
            toDL.style.display = 'none';
        document.body.appendChild(toDL);
        toDL.click();
        document.body.removeChild(toDL);
    };
    // controls user given queries  
    let main = dom('main');
    let run = dom('run');
    let clr = dom('clear');  
    let safe = dom('safe'); 
    let safety = true; 
    let dropCQ = dom('drop-queryInputs');  
    let CQ = dom('queryInputs'); 
    dropCQ.onclick = () => { $(CQ).toggleClass('hidden'); };
    safe.onclick = () => { 
        $(safe).toggleClass('red','green'); 
        if ($(safe).hasClass('red')) {
            safe.innerHTML = 'Safe OFF'; 
            safety = false; 
        } else {
            safe.innerHTML = 'Safe ON'; 
            safety = true; 
        }
    }
    run.onclick = () => { 
        if (connectionSet) {
            let q = $('textarea[name="custom-query"]').val();
            if (q.length) {
                $.ajax({
                    url: 'php/customQuery.php',
                    type: 'POST', 
                    data: { 'input': q, 'safe': safety }, 
                    cache: false, 
                    success: (results) => { 
                        main.innerHTML = ''; 
                        main.innerHTML = results; 
                        updateLog('ran query: '+q); 
                    }
                });
            } else {
                updateLog('error: cannot run an empty query'); 
            }
        } else {
            updateLog('error: connection has not been set');
        }
    }; 
    clr.onclick = () => { $('textarea[name="custom-query"]')[0].value = ""; }; 
    // initial calls  
    updateLog('welcome to the SQL Query Creator!'); 
});   

//ADD HELPERS
//  setinnertoEmpty() -> sets innerHTML to ""
//  hide('id') -> toggles class 'hidden' for object passed in
//  DOM CACHING
//          $('#id')[0] can be getDOM('id') -> returns the dop object
