<?php
    session_start();
    echo "		
    <center>
        <div>
            <h4>User Dashboard</h4><br/>
        </div>	
    </center>
    <div class='cbtn'>
        <form method='post'>
            <div class='btn'>
                <input type='hidden' name='username' value='".$_SESSION['Iusername']."'>
                <input type='submit' name='btn-to-login' value='Exit' />
                <input type='submit' name='btn-to-chng-pass' value='Change Password' />
            </div>   
        </form>
    <div>";
?>