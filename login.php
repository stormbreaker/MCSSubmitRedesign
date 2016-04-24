<?php
    require 'user.php';

    if ($_SERVER['REQUEST_METHOD'] === 'POST')
    {
      if (isset($_POST['username']) && isset($_POST['password']))
      {
        $username = $_POST['username'];
        $password = $_POST['password'];

        if (!User::authenticate($username, $password))
        {
            echo "<script type='text/javascript'>alert('Unable to login');</script>";
        }

        header('Location: index.php');
      }
      elseif (isset($_POST['logout']))
      {
        if (User::isAuthenticated())
        {
          User::getCurrentUser()->logOut();
        }
      }
    }
?>
