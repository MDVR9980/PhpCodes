$(document).ready(function() {  
    const swalWithBootstrapButtons = Swal.mixin({  
        customClass: {  
            confirmButton: "btn btn-success",
            cancelButton: "btn btn-danger"
        },  
    });  

    $('.del-btn').on('click', function(e) {  
        e.preventDefault();  
        
        // const userName = $("input[name='username']").val();
        const ID = $(this).data('id');
        // console.log(id);
        swalWithBootstrapButtons.fire({  
            title: "آیا مطمئن هستید؟",  
            text: "این عمل قابل برگشت نخواهد بود!",  
            icon: "warning",  
            showCancelButton: true,  
            confirmButtonText: "بله، حذف کن!",  
            cancelButtonText: "نه، لغو کن!",  
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
                                title: "حذف شد!",  
                                text: "سابقه شما حذف شد.",  
                                icon: "success"  
                            }).then(() => {  
                                location.reload();  
                            });  
                        } else {  
                            swalWithBootstrapButtons.fire({  
                                title: "خطا!",  
                                text: res.message,  
                                icon: "error"  
                            });  
                        }  
                    },  
                    error: function() {  
                        swalWithBootstrapButtons.fire({  
                            title: "خطا!",  
                            text: "هنگام حذف سابقه خطایی رخ داد.",  
                            icon: "error"  
                        });  
                    }  
                });  
            } else if (result.dismiss === Swal.DismissReason.cancel) {  
                swalWithBootstrapButtons.fire({  
                    title: "لغو شد",  
                    text: "سابقه شما ایمن است :)",  
                    icon: "error"  
                });  
            }  
        });  
    }); 

    const flashdata = $('.flash-data').data('flashdata');  
    if (flashdata) {  
        Swal.fire({  
            icon: 'success',  
            title: 'Record deleted',  
            text: 'The record has been deleted',  
            confirmButtonText: 'OK', // اضافه کردن متن "OK"  
            customClass: {  
                confirmButton: "btn btn-success" // دکمه OK سبز  
            }  
        });  
    }   
});


