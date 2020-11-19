<?php session_start();
include 'db.php';

$output = ""; 

$query = "SELECT * FROM users ORDER BY id DESC";

$users = mysqli_query($db, $query);

$i = 0;
while($user = mysqli_fetch_assoc($users))
{
    
    if($user)
    {
        $output .= '
                
                <tr>
                    <td>'.++$i.'</td>
                    <td>'.$user["User"].'</td>
                    <td><a class="btn btn-info btn-sm" href="index.php?userId='.$user["id"].' ">Start Chat</a></td>
                </tr>
            ';

    //     $output .= '
    //     <thead>
    //       <tr>
    //         <th scope="col">#</th>
    //         <th scope="col">Name</th>
    //         <th scope="col">Last</th>
    //         <th scope="col">Handle</th>
    //       </tr>
    //     </thead>
    //     <tbody>
    //       <tr>
    //         <th scope="row">1</th>
    //         <td>Mark</td>
    //         <td>Otto</td>
    //         <td>@mdo</td>
    //       </tr>
    //     </tbody>
    //   ';    

    }

}
echo $output;