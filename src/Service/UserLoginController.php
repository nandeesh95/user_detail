<?php


namespace Drupal\user_details\Service;

use Drupal\user\UserAuth;
use Drupal\user\Entity\User;
use Symfony\Component\HttpFoundation\RedirectResponse;

final class UserLoginController
{
  private $user_auth;

  public function __construct(UserAuth $user_auth)
  {
    $this->user_auth = $user_auth;
  }

  /**
   * {@inheritdoc}
   * Using Service- 'user.auth' to get current logged in user.
   */
  public function getUserData($username, $password)
  {
    $uid = $this->user_auth->authenticate($username, $password);
    $user = User::load($uid);
    return $user;
  }

}

