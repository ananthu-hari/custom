<?php

namespace Drupal\surveymanager\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Url;
use Drupal\user\UserAuthInterface;
use Drupal\user\Entity\User;
use Symfony\Component\DependencyInjection\ContainerInterface;


/**
 * Implements the vessel form.
 */
class smVessel extends FormBase {
  
  /**
   * {@inheritdoc}
   */
  public function getFormId() {
    return 'vessel_form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state) {
    $form['name'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Vessel Name'),
      '#maxlength' => 64,
      '#default_value' => '',
      '#required' => FALSE,
    ];

    $form['imo'] = [
      '#type' => 'textfield',
      '#title' => $this->t('IMO Number'),
      '#maxlength' => 64,
      '#default_value' => '',
      '#required' => TRUE,
    ];

    $form['actions']['submit'] = [
      '#type' => 'submit',
      '#value' => $this->t('Save'),
    ];

    return $form;
  }

  /**
   * {@inheritdoc}
   */
  public function validateForm(array &$form, FormStateInterface $form_state) {
    // Perform validation if needed.
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state) {
    // Save the form data to the 'sm_vessels' table.
    $connection = \Drupal::service('database');
    $connection->insert('sm_vessels')
      ->fields([
        'name' => $form_state->getValue('name'),
        'imo' => $form_state->getValue('imo'),
      ])
      ->execute();

    $this->messenger()->addMessage($this->t('Vessel details saved successfully.'));
  }
}
