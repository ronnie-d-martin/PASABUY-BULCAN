<h1 align="center"> Change password </h1>
<?php if(isset($_GET["success"])){
        echo "<script>Swal.fire({
            position: 'center',
            icon: 'success',
            title: 'Succesfully Changed',
            showConfirmButton: false,
            timer: 2000,
        })</script>";
    }
 else if(isset($_GET["error1"])){
        echo "<script> Swal.fire({
            icon: 'error',
            title: 'Oops...',
            text: 'Password did not match!',
        })</script>";
    }
 else if(isset($_GET["error2"])){
    echo "<script> Swal.fire({
        icon: 'error',
        title: 'Oops...',
        text: 'Password did not match!',
    })</script>";

 }
else if(isset($_GET["error3"])){
    echo "<script> Swal.fire({
        icon: 'error',
        title: 'Oops...',
        text: 'Password must be 8 character or above!',
    })</script>"; 
}?>
    <form action="accountPassFunction.php" method ="post" class="formPassword">
        <div class="form-group">
            <label> Your old password: </label>
            <input type="password" name="old_pass"class="form-control" required>
        </div>

        <div class="form-group">
            <label> Your new password: : </label>
            <input type="password" name="new_pass"class="form-control" required placeholder="(must be 8 characters or above)">
        </div>

        <div class="form-group">
            <label> Confirm your new password: </label>
            <input type="password" name="new_pass_again"class="form-control" required>
        </div>

        <div class="text-center">
            <button type="submit" class="btn btn-info" id="passBtn">
            <i class="fa fa-user-md"></i> Update Now
            </button>   
        </div>

    </form>
    <script src="js/changepass.js"></script>