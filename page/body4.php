<?php
session_start();
echo "		
    <center>
        <div>
            <h4>User Dashboard</h4><br/>
        </div>	
    </center>
    <div class='div-form-btn'>
        <form method='post'>
            <div>
                <input type='hidden' name='username' value='" . $_SESSION['Iusername'] . "'>
                <input type='submit' class='submit-btn' name='btn-to-login' value='Exit' />
                <input type='submit' class='submit-btn' name='btn-to-chng-pass' value='Change Password' />  
            </div>   
        </form>
    <div>";
