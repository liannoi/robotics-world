<div class="row mt-5 mb-5">
    <div class="col-sm-12">
        <?

        require_once "app/Models/User.php";
        require_once "app/Exceptions/AuthenticationException.php";
        require_once "storage/app/UserStorage.php";

        use App\Exceptions\AuthenticationException;
        use App\Models\UserBuilder;
        use Storage\App\UserStorage;

        $username = $_POST["user"]["username"];

        $users = (new UserBuilder())->withUsername($username)
            ->withPassword($_POST["user"]["password"])
            ->build();

        try {
            $user = $users->auth();
        } catch (AuthenticationException $e) {
            echo "<h6 class='text-center text-monospace text-danger'>{$e->getMessage()}</h6>";
            return;
        }

        echo "<h6 class='font-weight-bold text-monospace text-success text-center'>OK</h6>";
        $userStorage = new UserStorage();
        $userStorage->writeSession($user);

        if ($_POST["user"]["remember"] === "true") {
            $userStorage->writeCookie($user);
        }

        ?>
    </div>
</div>

<script>
  window.location.replace('/');
</script>
