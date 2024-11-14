<body class="bg-gradient-primary">

  <div class="container">

    <div class="card o-hidden border-0 shadow-lg my-5">
      <div class="card-body p-0">
        <!-- Nested Row within Card Body -->
        <div class="row">
          <div class="col-lg-7">
            <div class="p-5">
              <div class="text-center">
                <h1 class="h4 text-gray-900 mb-4">Create an Account!</h1>
              </div>
              <form class="mt-5 mb-5 login-input" action="<?=base_url('home/aksi_t_register')?>" method="post">
                <div class="form-group row">
                  <div class="col-sm-6 mb-3 mb-sm-0">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" class="form-control form-control-user" id="username" 
                    placeholder="Your username" name="username" required>
                  </div>
                  <div class="col-sm-6 mb-3 mb-sm-0">
                    <label for="nama_lengkap" class="form-label">Full Name</label>
                    <input type="text" class="form-control form-control-user" id="nama_lengkap"
                    placeholder="Your full name" name="nama_lengkap" required>
                  </div>
                </div>

                <div class="form-group row">
                  <div class="col-sm-6 mb-3 mb-sm-0">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control form-control-user" id="email"
                    placeholder="Your email" name="email" required>
                  </div>
                </div>

                <div class="form-group row">
                  <div class="col-sm-6 mb-3 mb-sm-0">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control form-control-user" id="pw"
                    placeholder="Password" name="pw" required>
                  </div>
                  <div class="col-sm-6 mb-3 mb-sm-0">
                    <label for="alamat" class="form-label">Address</label>
                    <input type="text" class="form-control form-control-user" id="alamat"
                    placeholder="Your address" name="alamat" required>
                  </div>
                </div>

                <button class="btn btn-primary btn-user btn-block" type="submit">Create an Account</button>
              </form>
              <hr>

              <div class="text-center">
                <a class="small" href="<?= base_url('home/login') ?>">Already have an account? Login!</a>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>
</body>
