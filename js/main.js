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
});