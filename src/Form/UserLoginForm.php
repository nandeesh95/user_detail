<?php

namespace Drupal\user_details\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

class UserLoginForm extends FormBase
{
  /**
   * {@inheritdoc}
   */
  public function getFormId()
  {
    return 'login_form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state)
  {
    $form['user_name'] = array(
      '#type' => 'textfield',
      '#title' => t('UserName'),
      '#description' => t('Please enter your Username'),
      '#required' => TRUE,
    );
    $form['password'] = array(
      '#type' => 'password',
      '#title' => t('Password'),
      '#description' => t('Please enter your password'),
      '#size' => 32,
      '#maxlength' => 32,
      '#required' => TRUE,
    );
    $form['actions']['#type'] = 'actions';
    $form['actions']['submit'] = array(
      '#type' => 'submit',
      '#value' => $this->t('Log in'),
      '#button_type' => 'primary',
    );

    return $form;
  }


  /**
   * Form submission handler.
   *
   * @param array $form
   *   An associative array containing the structure of the form.
   * @param \Drupal\Core\Form\FormStateInterface $form_state
   *   The current state of the form.
   * Using custom service to login the user
   */
  public function submitForm(array &$form, FormStateInterface $form_state)
  {
    $username = $form_state->getValue('user_name');
    $password = $form_state->getValue('password');
    $user = \Drupal::service('user_details.user_login_detials')->getUserData($username, $password);
    user_login_finalize($user);
  }
}
