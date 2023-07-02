<?php

namespace Drupal\surveymanager\Form;

use Drupal\Core\Form\FormBase;
use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Entity\EntityTypeManagerInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Job Certificates form.
 */
class JobCertificatesForm extends FormBase {

  /**
   * The entity type manager.
   *
   * @var \Drupal\Core\Entity\EntityTypeManagerInterface
   */
  protected $entityTypeManager;

  /**
   * JobCertificatesForm constructor.
   *
   * @param \Drupal\Core\Entity\EntityTypeManagerInterface $entity_type_manager
   *   The entity type manager.
   */
  public function __construct(EntityTypeManagerInterface $entity_type_manager) {
    $this->entityTypeManager = $entity_type_manager;
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container) {
    return new static(
      $container->get('entity_type.manager')
    );
  }

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
      '#type' => 'entity_autocomplete',
      '#title' => $this->t('Job ID'),
      '#target_type' => 'job_entity', // Replace 'job_entity' with the correct entity type for jobs.
      '#required' => TRUE,
    ];

    $form['certificate_id'] = [
      '#type' => 'entity_autocomplete',
      '#title' => $this->t('Certificate ID'),
      '#target_type' => 'certificate_entity', // Replace 'certificate_entity' with the correct entity type for certificates.
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
