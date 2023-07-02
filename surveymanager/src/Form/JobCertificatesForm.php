<?php

namespace Drupal\surveymanager\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Job Certificates form.
 */
class JobCertificatesForm extends FormBase {

  /**
   * {@inheritdoc}
   */
  public function getFormId(): string {
    return 'sm_job_certificates_form';
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state): array {
    $form['job_id'] = [
      '#type' => 'number',
      '#title' => $this->t('Job ID'),
      '#required' => TRUE,
    ];

    $form['certificate_id'] = [
      '#type' => 'number',
      '#title' => $this->t('Certificate ID'),
      '#required' => TRUE,
    ];

    $form['number'] = [
      '#type' => 'number',
      '#title' => $this->t('Certificate Number'),
      '#required' => TRUE,
    ];

    $form['issued_on'] = [
      '#type' => 'date',
      '#title' => $this->t('Issued Date'),
      '#required' => TRUE,
    ];

    $form['expire_on'] = [
      '#type' => 'date',
      '#title' => $this->t('Expiry Date'),
      '#required' => TRUE,
    ];

    $form['url'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Certificate URL'),
      '#maxlength' => 64,
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
  public function submitForm(array &$form, FormStateInterface $form_state) {
    // Handle form submission.
  }

}
