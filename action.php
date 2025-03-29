<?php

include("db.php");
$db = new Database();

if(isset($_POST['action'])){
    if($_POST['action'] == "view"){
        $output = '';
        $data = $db->display();
        if($db->countUser()>0){
            $output .= '<table class="table align-middle table-striped">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>';
            foreach($data as $row){
                $output .= '
                    <tr>
                            <td>'.$row['id'].'</td>
                            <td >'.$row['fname'].'</td>
                            <td>'.$row['lname'].'</td>
                            <td>'.$row['email'].'</td>
                            <td>'.$row['phone'].'</td>
                            <td>
                                <a href="#" class="fs-4 mx-1 btnInfo" id="'.$row['id'].'"><i class="fa-solid fa-circle-info"></i></a>
                                <a href="#" class="fs-4 text-warning mx-1 btnEdit" id="'.$row['id'].'" data-bs-toggle="modal" data-bs-target="#editModal"><i class="fa-regular fa-pen-to-square"></i></a>
                                <a href="#" class="fs-4 text-danger mx-1 btnDelete" id="'.$row['id'].'" ><i class="fa-solid fa-trash"></i></a>
                            </td>
                        </tr>
                ';
            }
            $output .= '
                </tbody>
                    </table>
            ';
            echo $output;
        }
        else{
            echo '
                <h3 class="text-center text-secondary mt-5">
                    There is no user data in system yet...
                </h3> 
            ';
        }
    } elseif ($_POST['action'] == "insert"){
        $fname = $_POST['fname'];
        $lname = $_POST['lname'];
        $email = $_POST['email'];
        $phone = $_POST['phone'];

        if ($db->input($fname,$lname,$email,$phone)) {
            echo "success";
        } else {
            echo "error";
        }
    } 
}
if(isset($_POST['edit'])){
    $id = $_POST['edit'];
    $row = $db->getUserID($id);
    echo json_encode($row);
}
if ($_POST['action'] == "update"){
    $id = $_POST['i_d'];
    $fname = $_POST['f_name'];
    $lname = $_POST['l_name'];
    $email = $_POST['e_mail'];
    $phone = $_POST['p_hone'];
    $db -> update($id,$fname,$lname,$email,$phone);
}
if(isset($_POST['del_Id'])){
    $id = $_POST['del_Id'];
    $db->remove($id);
}
?>