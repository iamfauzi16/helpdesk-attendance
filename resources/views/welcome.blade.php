<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">

    <title>Attendance - Blibli Helpdesk</title>
    <Style>
      body {
        background-color: white;
        height: 100vh;
      }
      .wrap-image {
        display: flex;
        align-items: center;
        justify-content: center;
      }
     
      .wrap-login {
        background-color: blue;
        height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
      }
      .card-size {
        width: 80vh;
      }
    </Style>
  </head>
  <body>
    <div class="wrap">
      <div class="container-fluid">
        <div class="row justify-content-center">
          <div class="col-md-6 wrap-image">
            <img src="{{ asset('img/blibli-removebg-preview.png') }}" alt="image" width="200px;"/>
          </div>
          <div class="col-md-6 shadow-lg wrap-login">
            <div class="card shadow-lg card-size">
              <div class="card-body">
                <h3>Blibli Helpdesk</h3>
                <p class="text-secondary">Attendance System Management</p>
                <a href="{{ route('login') }}" class="btn btn-primary btn-lg d-block mt-4">Login</a>
              </div>
            </div>
          </div>
        </div>
      </div>
     
    </div>

  
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>

  </body>
</html>
