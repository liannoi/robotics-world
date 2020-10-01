<div class="row mt-5 mb-4">
    <div class="col-md-12">
        <h3 class="text-center font-weight-light">Sign in</h3>
    </div>
</div>

<div class="row mb-5">
    <div class="offset-sm-4"></div>

    <div class="col-sm-4">
        <form action="sign_in_result" method="post" id="form_sign_in">
            <div class="form-group">
                <label for="user_name">Login:</label>

                <input type="text" class="form-control" id="user_login" name="user[login]">
            </div>

            <div class="form-group">
                <label for="user_password">Password:</label>

                <input type="text" class="form-control" id="user_password" name="user[password]">
            </div>

            <div class="form-check mb-4">
                <input type="checkbox" class="form-check-input" name="user[remember]" id="user_remember"
                       value="remember">

                <label for="user_remember" class="form-check-label">Remember me</label>
            </div>

            <div class="form-row">
                <div class="col-sm-12">
                    <button type="submit" class="btn btn-success w-100 p-3 font-weight-bold">Sign in</button>
                </div>
            </div>
        </form>
    </div>

    <div class="offset-sm-4"></div>
</div>
