$(function(){
    $(document).on('click','#delete',function(e){
      e.preventDefault();
      var link = $(this).attr('href');

      Swal.fire({
title: "Are you sure?",
text: "Delete this data",
icon: "warning",
showCancelButton: true,
confirmButtonColor: "#3085d6",
cancelButtonColor: "#d33",
confirmButtonText: "Yes, delete it!"
}).then((result) => {
if (result.isConfirmed) {
  window.location.href = link;
  Swal.fire(
    'Deleted!',
    'Your file has been deleted.',
     'success'
  );
}
});
    })
  });



  $(function(){
    $(document).on('click','#confirm',function(e){
      e.preventDefault();
      var link = $(this).attr('href');

      Swal.fire({
title: "Are you sure?",
text: "Confirm this order",
icon: "warning",
showCancelButton: true,
confirmButtonColor: "#3085d6",
cancelButtonColor: "#d33",
confirmButtonText: "Yes, confirm it!"
}).then((result) => {
if (result.isConfirmed) {
  window.location.href = link;
  Swal.fire(
    'Confirmed!',
    'Your order has been confirmed.',
     'success'
  );
}
});
    })
  })  ;



  $(function(){
    $(document).on('click','#processing',function(e){
        e.preventDefault();
        var link = $(this).attr("href");


                  Swal.fire({
                    title: 'Are you sure to Processing?',
                    text: "Once Processing, You will not be able to pending again",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, Processing!'
                  }).then((result) => {
                    if (result.isConfirmed) {
                      window.location.href = link
                      Swal.fire(
                        'Processing!',
                        'Processing Changes',
                        'success'
                      )
                    }
                  }) 


    });

  });

//picked


$(function(){
    $(document).on('click','#picked',function(e){
        e.preventDefault();
        var link = $(this).attr("href");


                  Swal.fire({
                    title: 'Are you sure to Picked?',
                    text: "Once Picked, You will not be able to pending again",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, Picked!'
                  }).then((result) => {
                    if (result.isConfirmed) {
                      window.location.href = link
                      Swal.fire(
                        'Picked!',
                        'Picked Changes',
                        'success'
                      )
                    }
                  }) 


    });

  });

// shipped


$(function(){
    $(document).on('click','#shipped',function(e){
        e.preventDefault();
        var link = $(this).attr("href");


                  Swal.fire({
                    title: 'Are you sure to shipped?',
                    text: "Once shipped, You will not be able to pending again",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, shipped!'
                  }).then((result) => {
                    if (result.isConfirmed) {
                      window.location.href = link
                      Swal.fire(
                        'shipped!',
                        'shipped Changes',
                        'success'
                      )
                    }
                  }) 


    });

  });

  //delivered



$(function(){
    $(document).on('click','#delivered',function(e){
        e.preventDefault();
        var link = $(this).attr("href");


                  Swal.fire({
                    title: 'Are you sure to delivered?',
                    text: "Once delivered, You will not be able to pending again",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delivered!'
                  }).then((result) => {
                    if (result.isConfirmed) {
                      window.location.href = link
                      Swal.fire(
                        'delivered!',
                        'delivered Changes',
                        'success'
                      )
                    }
                  }) 


    });

  });