<?php
session_start();

?>
<!DOCTYPE html>
<html lang="ar">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>
<body>
    <script>
      $(document).ready(function() {
    fetch('http://127.0.0.1:8000/login/google/callback?state=eiT62tQKr6SLgoYwkUvUnbS2loNX3cYCsKBiluY7&code=4%2F0Ab_5qlko5Koz3De1-GmwjEsuoj_5ik2dVZu2kVg4qaETQTtITYt-lcv1DbB4lLJSwLR-pg&scope=email+profile+openid+https%3A%2F%2Fwww.googleapis.com%2Fauth%2Fuserinfo.email+https%3A%2F%2Fwww.googleapis.com%2Fauth%2Fuserinfo.profile&authuser=0&prompt=none', {
        method: 'GET',
        headers: {
            'Authorization': 'Bearer ' + yourGoogleToken,  
        }
    })
    .then(response => response.json())  
    .then(data => {
        if (data.token) {
            localStorage.setItem('token', data.token);

            localStorage.setItem('user_id', data.user.id);
            localStorage.setItem('user_name', data.user.name);
            localStorage.setItem('user_email', data.user.email);
            localStorage.setItem('user_role', data.user.role);

            window.location.href = "home.php"; 
        } else {
            alert("error in doc!");
        }
    })
    .catch(error => {
        console.error("error", error);
    });
});

    </script>

</body>
</html>
