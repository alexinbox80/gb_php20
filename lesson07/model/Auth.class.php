<?php

class Auth extends User
{
    private $error = "";
    private $is_authorized = false;
    private $user_id = '';
    //private $cart_id = '';
    //private $order_id = '';

    function __construct($data)
    {
        parent::__construct($data);
    }

    public function getError()
    {
        return $this->error;
    }

    protected function makePasswdMd5($login, $passwd)
    {
        $salt = "zyjdfhm";
        return strrev(md5($salt) . $passwd . md5($login));
    }

    public static function isAuthorized(): bool
    {
        if (!empty($_SESSION["user_id"])) {
            return (bool)$_SESSION["user_id"];
        }
        return false;
    }

    protected function saveSession($remember = false, $http_only = true, $days = 7)
    {
        $_SESSION["user_id"] = $this->user_id;

        if ($remember) {
            // Save session id in cookies
            $sid = session_id();

            $expire = time() + $days * 24 * 3600;
            $domain = ""; // default domain
            $secure = false;
            $path = "/";

            $cookie = setcookie("sid", $sid, $expire, $path, $domain, $secure, $http_only);
        }
    }

    public static function logout()
    {
        if (!empty($_SESSION["user_id"])) {
            unset($_SESSION["user_id"]);
        }
    }

    public static function login($data): array
    {
        $user = new Auth($data);

        $flag = $user->auth();
        $result = [];

        if ($flag) {
            $result = ['info' => 'User is registered in the system!',
                'status' => 'ok'];
        }

        if (($user->getError() != "") && ($_POST['act'] == 'action-login')) {

            $result = [
                'info' => $user->getError(),
                'status' => 'error'];
        } else if ($_POST['act'] == 'logout') {
            $result = [
                'info' => $user->getError(),
                'status' => 'ok'];
        }

        return $result;
    }

    public function auth(): bool
    {

        if ($this->IsPost()) {
            $login = $_POST['authLogin'] ? strip_tags($_POST['authLogin']) : "";
            $passwd = $_POST['authPasswd'] ? strip_tags($_POST['authPasswd']) : "";
            $rememberme = $_POST['authRemember-me'] ? strip_tags($_POST['authRemember-me']) : "";
            $action = $_POST['act'] ? strip_tags($_POST['act']) : "";

            if (isset($rememberme)) {
                $remember = true;
            }

            switch ($action) {
                case 'action-login':
                    if (($login == "") || ($passwd == "")) {
                        $this->error = "Empty login or password!";
                        $this->is_authorized = false;
                    } else {

                        $passwdMd5 = $this->makePasswdMd5($login, md5($passwd));

                        $sql = "SELECT users.user_id, user_role.role_id, roles.role
                                FROM user_role
                                INNER JOIN users ON user_role.user_id = users.user_id
                                INNER JOIN roles ON user_role.role_id = roles.role_id
                                WHERE login = :login AND passwd = :passwd LIMIT 1";

                        $authUser = db::getInstance()->Select(
                            $sql,
                            ['login' => $login, 'passwd' => $passwdMd5]);

                        if (!$authUser[0]['user_id']) {
                            $this->is_authorized = false;
                            $this->error = "Wrong login or password!";
                        } else {
                            $this->is_authorized = true;
                            $this->user_id = $authUser[0]['user_id'];

                            //$this->cart_id = '';
                            //$this->order_id = '';

                            //last active
                            $sql = "UPDATE users
                                    SET lastActive = NOW()
                                    WHERE login = :login AND passwd = :passwd";
                            $res = db::getInstance()->Query($sql,
                                ['login' => $login, 'passwd' => $passwdMd5]);
                            $this->saveSession($remember);
                        }

                    }
                    break;
                case 'action-logout':
                    $this->error = "Site logout success!";
                    $this->logout();
                    break;
            }
        }

        //echo "login = " . $login . " passwd = " . $passwd . " rememberme = " . $rememberme . " action = " . $action . "<br>\n";

        return $this->is_authorized;
    }

    /**
     * website registration function
     *
     * @param array $user array of form field values,
     * @return true on success
     *
     */
    public static function regs(array $user): bool
    {
        $result = true;

        $sql = "SELECT users.user_id, user_role.role_id, roles.role
                FROM user_role
                INNER JOIN users ON user_role.user_id = users.user_id
                INNER JOIN roles ON user_role.role_id = roles.role_id
                WHERE login = :login OR email = :email LIMIT 1";

        $authUser = db::getInstance()->Select(
            $sql,
            ['login' => $user['login'], 'email' => $user['email']]);

        if ($authUser[0]['user_id']) {
            $result = false;
        } else {
            $result = true;
            // writing to the database
            try {

                $passwdMd5 = self::makePasswdMd5($user['login'], md5($user['passwd']));


                $sql = "SELECT * FROM roles WHERE role = 'user'";
                $role_id = db::getInstance()->Select($sql,[])[0]['role_id'];

                if (Auth::isAuthorized()) {
                    $user_id = $_SESSION['user_id'];
                } else {
                    $user_id = $_COOKIE['user_id'];
                }

                //$user_id = UUID::v4();

                if (db::getInstance()->beginTransaction()) {

                    $sql = "INSERT INTO  users (user_id, lastName, firstName, address,
                                            email, phone, gender, login, passwd, status, dateCreate, lastActive)
                            VALUES (:user_id, :lastName, :firstName, NULL, :email, NULL, :gender,
                                    :login, :passwd, :status, NOW(), NULL)";

                    $res = db::getInstance()->Query(
                        $sql,
                        [
                            'user_id' => $user_id,
                            'lastName' => $user['secondName'],
                            'firstName' => $user['firstName'],
                            'email' => $user['email'],
                            'gender' => $user['gender'],
                            'login' => $user['login'],
                            'passwd' => $passwdMd5,
                            'status' => Status::ACTIVE
                        ]);

                    $sql = "INSERT INTO  user_role (user_id, role_id)
                            VALUES (:user_id, :role_id)";
                    $res = db::getInstance()->Query(
                        $sql,
                        [
                            'user_id' => $user_id,
                            'role_id' => $role_id
                        ]);

                    db::getInstance()->commit();

                }
            } catch (PDOException $e) {
                if (db::getInstance()->inTransaction()) {
                    db::getInstance()->rollBack();
                    die($e->getMessage());
                }
            }
        }

        return $result;
    }

    protected function IsGet()
    {
        return $_SERVER['REQUEST_METHOD'] == 'GET';
    }

    protected function IsPost()
    {
        return $_SERVER['REQUEST_METHOD'] == 'POST';
    }
}
