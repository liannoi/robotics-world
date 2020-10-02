<div class="row mt-5 mb-4">
    <div class="col-sm-12">
        <h2 class="font-weight-bold text-monospace text-success text-center">OK</h2>
    </div>
</div>

<?

require_once "app/models/User.php";
require_once "app/models/UserRole.php";

use App\Models\UserBuilder;
use App\Models\UserRoleBuilder;

// 1. Add user.
$user = (new UserBuilder())->withUsername($_POST["user"]["username"])
    ->withEmail($_POST["user"]["email"])
    ->withPassword($_POST["user"]["password"])
    ->withStatus($_POST["user"]["status"])
    ->build();

$user->create($user);

// 2. Getting the id of the last added user.
$users = (new UserBuilder())->build()->getAll();
$lastUserId = end($users)->userId;

// 3. Assign the selected roles to the newly registered user in the staging database relationship.
$roles = $_POST["user"]["roles"];

foreach ($roles as $role) {
    $userRole = ((new UserRoleBuilder())->withUser($lastUserId)
        ->withRole($role)
        ->build());

    $userRole->create($userRole);
}

?>

<script>
  window.location.replace('/');
</script>
