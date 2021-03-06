<!DOCTYPE html>
<html lang="en">
<head>
    <title>Registration Page</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container">
    <h2>Registration Page</h2>
    <form action="/index.php" method="post">

        <div class="form-group">
            <label for="first_name">First Name:</label>
            <input type="text" class="form-control" id="first_name" placeholder="Enter first name" name="first_name"
                   required value="<?php echo $first_name; ?>">
            <small>Alphabetical (A-Z|a-z) only, Number of letters allowed 2-20.</small>
            <?php if (isset($errors['first_name'])): ?>
                <div class="alert alert-danger alert-dismissible" role="alert">
                    <strong>Not Valid!</strong> <?php echo $errors['first_name']; ?>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            <?php endif; ?>
        </div>

        <div class="form-group">
            <label for="last_name">Last Name:</label>
            <input type="text" class="form-control" id="last_name" placeholder="Enter last name" name="last_name"
                   required value="<?php echo $last_name; ?>">
            <small>Alphabetical (A-Z|a-z) only, Number of letters allowed 2-20.</small>
            <?php if (isset($errors['last_name'])): ?>
                <div class="alert alert-danger alert-dismissible" role="alert">
                    <strong>Not Valid!</strong> <?php echo $errors['last_name']; ?>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            <?php endif; ?>
        </div>

        <div class="form-group">
            <label for="email_name">Email Name:</label>
            <input type="email" class="form-control" id="email_name" placeholder="Enter email name" name="email_name"
                   required value="<?php echo $email_name; ?>">
            <small>Number of characters allowed 7-20, Only this format is allowed (a-z|A-Z|1-9|.-_)@(a-z).com.</small>
            <?php if (isset($errors['email_name'])): ?>
                <div class="alert alert-danger alert-dismissible" role="alert">
                    <strong>Not Valid!</strong> <?php echo $errors['email_name']; ?>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            <?php endif; ?>
        </div>

        <div class="form-group">
            <label for="phone_number">Phone Number:</label>
            <input type="number" class="form-control" id="phone_number" placeholder="Enter phone number"
                   name="phone_number"
                   required value="<?php echo $phone_number; ?>">
            <small>Numerical only, Only jordanian mobile numbers are allowed, Allowed format is 9627(0-9), The length of
                characters must be 12 chars.
            </small>
            <?php if (isset($errors['phone_number'])): ?>
                <div class="alert alert-danger alert-dismissible" role="alert">
                    <strong>Not Valid!</strong> <?php echo $errors['phone_number']; ?>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            <?php endif; ?>
        </div>

        <div class="form-group">
            <button id="verify" type="button" class="btn btn-info">Send SMS to Verify</button>
        </div>

        <div class="form-group">
            <label for="verification_code">Verification Code:</label>
            <input type="number" class="form-control" id="verification_code" placeholder="Enter verification code"
                   name="verification_code"
                   required value="<?php echo $verification_code; ?>">
            <small>The length is 4 digits only.
            </small>
            <?php if (isset($errors['verification_code'])): ?>
                <div class="alert alert-danger alert-dismissible" role="alert">
                    <strong>Not Valid!</strong> <?php echo $errors['verification_code']; ?>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            <?php endif; ?>
        </div>

        <button type="submit" class="btn btn-primary" name="register">Register</button>
    </form>
</div>
<script>
    $(function () {
        // Handler for .ready() called.
        $("#verify").click(function (e) {
            e.preventDefault();
            $.ajax({
                type: "POST",
                url: "/index.php",
                data: {
                    verify_phone: $('#phone_number').val(),
                    access_token: '123456'
                },
                success: function (result) {
                    alert(result);
                },
                error: function (result) {
                    alert('error');
                }
            });
        });
    });
</script>
</body>
</html>