<?php

namespace App\Controllers;

use Framework\Database;
use Framework\Session;
use Framework\Validation;


class UserController
{

  protected $db;
  public function __construct()
  {
    $config = require basePath("config/db.php");
    $this->db = new Database($config);
  }

  /**
   * 
   * Show login page
   *
   * @return void
   *
   * */

  public function login()
  {
    return loadView("user/login");
  }


  /**
   *
   * Authenticate user login
   * @return void
   *
   * */

  public function authenticate()
  {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $errors = [];

    $userData = (object)['email' => $email, 'password' => $password];

    if (!Validation::email($email)) {
      $errors[$email] = "Enter a valid email";
    }

    if (!Validation::string($password, 6)) {
      $errors[$password] = "Password must be atleas 6 character";
    }

    if (!empty($errors)) {
      loadView('user/login', [
        'errors' => $errors,
        'user' => $userData
      ]);
      exit;
    }

    $params = [
      'email' => $email
    ];


    $sql = "SELECT * FROM users WHERE email= :email";

    $user = $this->db->query($sql, $params)->fetch();

    if (!$user) {
      $errors['email'] = "Wrong credentials";
      inspectAndDie($errors);
      loadView('user/login', [
        'errors' => $errors,
        'user' => $userData
      ]);
      exit;
    }
    if (!password_verify($password, $user->password)) {

      $errors['email'] = "Wrong credentials";
      loadView('user/login', [
        'errors' => $errors,
        'user' => $userData
      ]);
      exit;
    }

    Session::set('user', [
      'user_id' => $user->id,
      'name' => $user->name,
      'email' => $user->email,
      'city' => $user->city
    ]);
    redirect('/');
  }

  /**
   *
   * Show register page
   * @return void
   *
   * */
  public function register()
  {
    return loadView('user/register');
  }

  /**
   *
   * Store user data
   * @return void
   *
   * */
  public function store()
  {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $city = $_POST['state'];
    $state = $_POST['state'];
    $password = $_POST['password'];
    $password_confirmation = $_POST['password_confirmation'];


    $errors = [];


    if (!Validation::string($name)) {
      $errors['name'] = "Name field required";
    }

    if (!Validation::email($email)) {
      $errors['email'] = "Email must be valid";
    }
    if (!Validation::string($password, 6)) {
      $errors['password'] = "Password must contain atleas 06 letters or number";
    }
    if (!Validation::match($password, $password_confirmation)) {
      $errors['password_confirmation'] = "Password need to match with confirm password";
    }
    $userData = [
      'name' => $name,
      'email' => $email,
      'state' => $state,
      'city' => $city,
      'password' => $password,
      'password_confirmation' => $password_confirmation
    ];

    if (!empty($errors)) {
      return loadView('user/register', [
        'errors' => $errors,
        'data' => (object)$userData
      ]);
      exit;
    }

    $param = [
      'email' => $email
    ];
    $sql = "SELECT email FROM users WHERE email = :email ";
    $user = $this->db->query($sql, $param)->fetch();

    if ($user) {
      $errors['email'] = "Email already exist";
      loadView('user/register', [
        'errors' => $errors,
        'data' => (object)$userData
      ]);

      exit;
    }
    unset($userData['password_confirmation']);
    $userData['password'] = password_hash($password, PASSWORD_DEFAULT);
    $inserSql = "INSERT INTO users (name,email,city,state,password) VALUES(:name, :email, :city, :state, :password)";
    $this->db->query($inserSql, $userData);


    $userId = $this->db->conn->lastInsertId();

    Session::set('user', [
      'user_id' => $userId,
      'name' => $name,
      'email' => $email,
      'city' => $city
    ]);



    redirect('/auth/login');
  }
  /**
   *
   * logout user
   * @return void
   *
   * */
  public function logout()
  {
    Session::clearAll();

    $params = session_get_cookie_params();
    setcookie('PHPSESSID', "", time() - 86400, $params['path'], $params['domain']);

    redirect("/");
  }
}
