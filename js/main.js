$(document).ready(function(){  
  $('input[name="del-btn"]').click(function(){  
      const username = $(this).data('username');
      Swal.fire({  
          title: "Are you sure?",  
          text: "You won't be able to revert this!",  
          icon: "warning",  
          showCancelButton: true,  
          confirmButtonColor: "#3085d6",  
          cancelButtonColor: "#d33",  
          confirmButtonText: "Yes, delete it!"  
        }).then((result) => {  
          if (result.isConfirmed) {  
            $.ajax({  
              type: "POST",  
              url: "localhost/Web3/PhpCodes/lib/boot.php",
              data: {  
                  'del-btn': true,  
                  'username': username  
              },  
              success: function(response) {  
                  Swal.fire({  
                      title: "Deleted!",  
                      text: "Your file has been deleted.",  
                      icon: "success"  
                  });  
              },  
              error: function() {  
                  Swal.fire({  
                      title: "Error!",  
                      text: "There was an error deleting your file.",  
                      icon: "error"  
                  });  
              }  
            });  
          }  
        });  
  });  
});


