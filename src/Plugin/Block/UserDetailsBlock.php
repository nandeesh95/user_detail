<?php

namespace Drupal\user_details\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\user\Entity\User;
use Drupal\Core\Cache\Cache;

/**
 * Provides a block with a simple text.
 *
 * @Block(
 *   id = "userdetails_block",
 *   admin_label = @Translation("User Details Block"),
 * )
 */
class UserDetailsBlock extends BlockBase
{

  /**
   * {@inheritdoc}
   * The block shows current user details.
   */
  public function build()
  {
    $currentuser_id = \Drupal::service('user_details.user_details_block')->CurrentUserId();
    $uid = \Drupal::entityQuery('user')
      ->condition('uid', $currentuser_id)
      ->execute();
    $current_user = array_values($uid);
    $users = User::load($current_user[0]);
    $details = [
      'Name' => $users->name->value,
      'Email' => $users->mail->value,
    ];
    $blokcHTML = "<h5>Name : " . $details['Name'] . "<br> Email : " . $details['Email'] . "</h5>";
    return [
      '#markup' => $blokcHTML,
    ];
  }

  public function getCacheTags()
  {
    if ($user = \Drupal::routeMatch()->getParameter('user')) {
      return Cache::mergeTags(parent::getCacheTags(), array('user:' . $user->id()));
    } else {
      //Return default tags instead.
      return parent::getCacheTags();
    }
  }

  public function getCacheContexts()
  {
    return Cache::mergeContexts(parent::getCacheContexts(), array('route'));
  }
}

