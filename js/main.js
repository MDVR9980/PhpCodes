$(document).ready(function() {  
    const swalWithBootstrapButtons = Swal.mixin({  
        customClass: {  
            confirmButton: "btn btn-success",
            cancelButton: "btn btn-danger"
        },  
    });  
    $('.del-btn').on('click', function(e) {  
        e.preventDefault();  
        const ID = $(this).data('id');
        swalWithBootstrapButtons.fire({  
            title: "Are you sure you want to delete?",  
            text: "This action cannot be reversed!",  
            icon: "warning",  
            showCancelButton: true,  
            confirmButtonText: "Yes, delete it!",  
            cancelButtonText: "No, cancel it!",  
            reverseButtons: true  
        }).then((result) => {  
            if (result.isConfirmed) {  
                $.ajax({  
                    url: '../lib/boot.php', 
                    type: 'POST',  
                    data: {   
                        Id: ID 
                    },  
                    success: function(response) {  
                        const res = JSON.parse(response);  
                        if (res.success) {  
                            swalWithBootstrapButtons.fire({  
                                title: "Deleted",  
                                text: "The record was deleted.",  
                                icon: "success"  
                            }).then(() => {  
                                location.reload();  
                            });  
                        } else {  
                            swalWithBootstrapButtons.fire({  
                                title: "Error",  
                                text: res.message,  
                                icon: "error"  
                            });  
                        }  
                    },  
                    error: function() {  
                        swalWithBootstrapButtons.fire({  
                            title: "Error!",  
                            text: "An error occurred while deleting the record.",  
                            icon: "error"  
                        });  
                    }  
                });  
            } else if (result.dismiss === Swal.DismissReason.cancel) {  
                swalWithBootstrapButtons.fire({  
                    title: "Canceled",  
                    text: "Your record is safe.",  
                    icon: "error"  
                });  
            }  
        });  
    });
    
    $('input[name="btn-register"]').on('click', function(e) {   
        e.preventDefault();  
    
        const formData = {  
            nameuser: $("input[name='nameuser']").val(),  
            familyuser: $("input[name='familyuser']").val(),  
            username: $("input[name='username']").val(),  
            userpass: $("input[name='userpass']").val(),  
            captcha: $("input[name='captcha']").val(),  
            'captcha-rand': $("input[name='captcha-rand']").val(),  
            subscribe: $("input[name='subscribe']").is(':checked'),  
            'btn-register': true  
        };  
    
        $.ajax({  
            url: '../lib/boot.php',  
            type: 'POST',  
            data: formData,  
            success: function(response) {  
                const res = JSON.parse(response);  
                if (res.success) {  
                    Swal.fire({  
                        position: "top-end",  
                        icon: "success",  
                        title: res.message,  
                        showConfirmButton: false,  
                        timer: 1500  
                    }).then(() => {  
                        window.location.href = "./login.php";
                    });  
                } else {  
                    if (res.errors) {  
                        Swal.fire({  
                            icon: "error",  
                            title: "Error",  
                            html: res.errors.join("<br/>")  
                        });  
                    } else {  
                        Swal.fire({  
                            icon: "error",  
                            title: "Error",  
                            text: res.message  
                        });  
                    }  
                }  
            }  
        });  
    });

    $('input[name="btn-login"]').on('click', function(e) {  
        e.preventDefault();  
    
        const formData = {  
            Iusername: $("input[name='Iusername']").val(),  
            userpass: $("input[name='userpass']").val(),  
            captcha: $("input[name='captcha']").val(),  
            'captcha-rand': $("input[name='captcha-rand']").val(),  
            tuser: $("#user-level").val(),  
            subscribe: $("input[name='subscribe']").is(':checked'),  
            'btn-login': true  
        };  
        console.log(formData);  
    
        $.ajax({  
            url: '../lib/boot.php',  
            type: 'POST',  
            data: formData,  
            success: function(response) {  
                const res = JSON.parse(response);  
                if (res.success) {  
                    Swal.fire({  
                        position: "top-end",  
                        icon: "success",  
                        title: res.message,  
                        showConfirmButton: false,  
                        timer: 1500  
                    }).then(() => {  
                        const userRole = formData.tuser;
                        if (userRole === 'Superuser') {  
                            window.location.href = "dashboard2.php";
                        } else if (userRole === 'User') {  
                            window.location.href = "dashboard.php";
                        } else {  
                            window.location.href = "dashboard.php";
                        }  
                    });  
                } else {  
                    Swal.fire({  
                        icon: "error",  
                        title: "Error",  
                        text: res.errors ? res.errors.join(', ') : "An unknown error occurred."  
                    });  
                }  
            }  
        });  
    });
});

