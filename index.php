<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://cdn.datatables.net/2.2.2/css/dataTables.dataTables.css" />
</head>
<body>
    <header class="w-100 h-auto bg-primary py-4 rounded-2">
        <h1 class="fw-bold text-uppercase text-light text-center">crud ajax</h1>
    </header>
    <main class="container-fluid d-flex flex-column justify-content-center">
        <div class="container">
            <div class="row">
                <div class="col-6 p-4">
                    <h3><i class="fa-solid fa-users"></i> All User</h3>
                </div>
                <div class="col-6 d-flex align-items-center justify-content-end">
                    <a href="#" class="btn btn-primary py-2 px-3 mx-1 fs-5" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="fa-solid fa-user-plus"></i> Add</a>
                </div>
            </div>
        </div>
        <div class="container p-3" id="showUser">
            
        </div>
        <div class="container">
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel"><i class="fa-solid fa-user-plus"></i> Add User</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="" method="post" id="form-data">
                    <div class="row">
                        <div class="col-6">
                            <input type="text" name="fname" placeholder="First Name" class="form-control my-1" id="fname">
                    </div>
                        <div class="col-6">
                        <input type="text" name="lname" placeholder="Last Name" class="form-control my-1" id="lname">
                    </div>
                    </div>
                    <input type="email" name="email" placeholder="Email Address" class="form-control my-3" id="email">
                    <input type="text" name="phone" placeholder="Phone Number" class="form-control my-3" id="phone">
                    <div class="modal-footer">
                    <button type="reset" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" name="insert" id="insert"  class="btn btn-primary">Save changes</button>
                </div>
                    </form>
                </div>
                
                </div>
            </div>
            </div>
        </div>
            <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel"><i class="fa-regular fa-pen-to-square"></i>  Edit User</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="" method="post" id="edit-form-data">
                    <div class="row">
                        <div class="col-6">
                            <input type="hidden" name="i_d" id="i_d">
                            <input type="text" name="f_name" class="form-control my-1" id="f_name">
                    </div>
                        <div class="col-6">
                        <input type="text" name="l_name" class="form-control my-1" id="l_name">
                    </div>
                    </div>
                    <input type="email" name="e_mail" class="form-control my-3" id="e_mail">
                    <input type="text" name="p_hone" class="form-control my-3" id="p_hone">
                    <div class="modal-footer">
                    <button type="reset" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" name="update" id="update"  class="btn btn-primary">Update</button>
                </div>
                    </form>
                </div>
                
                </div>
            </div>
        </div>
    </main>
</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.7.1.js"integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="crossorigin="anonymous"></script>
<script src="https://cdn.datatables.net/2.2.2/js/dataTables.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    $(document).ready(function(){
        const showUser =()=>{
            $.ajax({
                url:"action.php", 
                type: "POST",
                data: {action:"view"},
                success:function (res){
                    $('#showUser').html(res);
                    $('table').DataTable({
                        order:[0,'desc'] 
                    });
                }, 
                error:function(err){
                    console.log(err);
                }
            })
        }
        showUser();
        $('#insert').click(function(e){
        if($('#form-data')[0].checkValidity()){
            e.preventDefault();
            $.ajax({
                url:"action.php",
                type:"POST",
                data: $('#form-data').serialize()+"&action=insert",
                success:function(res){
                    Swal.fire({
                        title: "Add Success",
                        icon: "success",
                        draggable: false
                        });
                    $('#exampleModal').modal('hide');
                    $('#form-data')[0].reset();
                    showUser();
                },
                error: function(err){
                    Swal.fire({
                        title: "Complete all your fields",
                        icon: "error",
                        draggable: false
                        });
                }

        })

    }
})
        $("body").on("click",".btnEdit",function(e){
            e.preventDefault();
            var currentID = $(this).attr('id');
            $.ajax({
                url:"action.php",
                type:"POST",
                data:{edit: currentID},
                success:function(res){
                    data = JSON.parse(res);
                    $('#i_d').val(data.id);
                    $('#f_name').val(data.fname);
                    $('#l_name').val(data.lname);
                    $('#e_mail').val(data.email);
                    $('#p_hone').val(data.phone);

                }
            })
            
        })
        $('#update').click(function(e){
        if($('#edit-form-data')[0].checkValidity()){
            e.preventDefault();
            $.ajax({
                url:"action.php",
                type:"POST",
                data: $('#edit-form-data').serialize()+"&action=update",
                success:function(res){
                    Swal.fire({
                        title: "Add Success",
                        icon: "success",
                        draggable: false
                        });
                    $('#editModal').modal('hide');
                    $('#edit-form-data')[0].reset();
                    showUser();
                },
                error: function(err){
                    Swal.fire({
                        title: "Complete all your fields",
                        icon: "error",
                        draggable: false
                        });
                    console.log(err);
                }

        })

    }
})
    $('body').on("click",".btnDelete",function(e){
        e.preventDefault();
        var td = $(this).closest('tr');
        del_Id = $(this).attr('id');
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
                    url:"action.php",
                    type:"POST",
                    data:{del_Id:del_Id},
                    success: function(res){
                        showUser();     
                    }
                })
            }
});
    })
    })
</script> 
</html>