<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js" integrity="sha384-FKyoEForCGlyvwx9Hj09JcYn3nv7wiPVlz7YYwJrWVcXK/BmnVDxM+D2scQbITxI" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">

</head>
<body>
    <div class="container">
        <div class="card" style="width: 30rem;">
  <div class="card-body">
    <h1 class="card-title">Walcome back!</h1>
    <h2 class="card-subtitle mb-2 text-body-secondary">Log in</h2>
    <form action="homepage.php">
    <div class="mb-3">
        <label for="usn" class="form-label">User Name :</label>
        <input type="text" class="form-control" id="usn" placeholder="User Name">
    </div>
    <div class="mb-3">
        <label for="pass" class="form-label">Password :</label>
        <input type="password" class="form-control" id="pass" placeholder="Password">
    </div>
    <div class="d-grid gap-2 col-6 mx-auto">
        <button class="btn btn-primary" type="submit">Log in</button>
    </div>
    </form>
  </div>
        </div>
    </div>
</body>
</html>