<?PHP
# Start session function
session_start();

# Clear all session variables
session_unset();

# Destroy session
session_destroy();

echo"<script>window.location.href='index.php';</script>";
?>
