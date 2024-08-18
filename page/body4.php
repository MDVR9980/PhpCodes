<?php
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

if (isset($_GET['passSuccess'])) { 
    ?> 
    <script>  
        Swal.fire({  
            position: "top-end",  
            icon: "success",  
            title: "Change password successfully!",  
            showConfirmButton: false,  
            timer: 1500  
        }).then(() => {
            
            window.location.href = "../page/dashboard.php";
        });
    </script>
        <?php
}