<?php 
    include('connect.php');
    $inputed_image = $_FILES['profile_image']['name'];
    $username = $_SESSION['username'];
    $request = "SELECT * FROM users  WHERE username = '$username'";
    $requested = $connect->query($request);
    while ($user = $requested->fetch_assoc()) {
        $user_id = $user['id'];
    }
    $prev_profile = "SELECT * FROM profiles WHERE username = '$username' and user_id = '$user_id'";
    $profile_found = $connect->query($prev_profile);
    if ($profile_found->num_rows > 0) {
        while ($prev_profile = $profile_found->fetch_assoc()) {
            $profile_image = $prev_profile['profile_image'];
        }
        if (file_exists("profile_images/".$profile_image)) {
            unlink("profile_images/".$profile_image);
        }
        if (move_uploaded_file($_FILES['profile_image']['tmp_name'], "profile_images/".$inputed_image)) {
            $save = "UPDATE profiles SET profile_image = '$inputed_image' WHERE username = '$username' and user_id = '$user_id'";
                if ($connect->query($save)) {
                    header('location: profile.php');
                }
            }    
    }
    else {
        if (move_uploaded_file($_FILES['profile_image']['tmp_name'], "profile_images/".$inputed_image)) {
            $save = "INSERT INTO profiles (user_id, username, profile_image) VALUES ('$user_id', '$username', '$inputed_image')";
                if ($connect->query($save)) {
                    header('location: profile.php');
                }
            }
    }



    
?>