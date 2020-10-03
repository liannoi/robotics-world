<div class="row mt-5 mb-5">
    <div class="col-sm-12 mt-3">
        <?

        require_once "app/Models/User.php";
        require_once "app/Models/UserRole.php";
        require_once "app/Rules/RegexValidator.php";

        use App\Exceptions\ValidationException;
        use App\Models\User;
        use App\Models\UserBuilder;
        use App\Models\UserRoleBuilder;
        use App\Rules\RegexValidator;

        // 1. Preparation.
        $username = $_POST["user"]["username"];
        $email = $_POST["user"]["email"];
        $password = $_POST["user"]["password"];
        $repeatPassword = $_POST["user"]["repeat_password"];
        $validator = new RegexValidator();

        // 2. Validation.
        try {
            $validator->username($username);
            $validator->email($email);
            $validator->password($password, $repeatPassword);
        } catch (ValidationException $e) {
            echo "<h6 class='text-center text-monospace text-danger'>{$e->getMessage()}</h6>";
            return;
        }

        // 3. Add user.
        (new UserBuilder())->withUsername($username)
            ->withEmail($email)
            ->withPassword($password)
            ->withStatus($_POST["user"]["status"])
            ->build()
            ->create();

        // 4. Getting the id of the last added user.
        $users = (new User())->getAll();
        $lastUserId = end($users)->userId;

        // 5. Assign the selected roles to the newly registered user in the staging database relationship.
        $roles = $_POST["user"]["roles"];

        foreach ($roles as $role) {
            ((new UserRoleBuilder())->withUser($lastUserId)
                ->withRole($role)
                ->build())
                ->create();
        }

        ?>
    </div>
</div>

<script>
  window.location.replace('/');
</script>
