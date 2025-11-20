<?php

declare(strict_types=1);

namespace Drupal\drush_module\Form;

use Drupal\Core\Form\ConfigFormBase;
use Drupal\Core\Form\FormStateInterface;

/**
 * Configure Drush Module settings for this site.
 */
final class AdminSettingsForm extends ConfigFormBase {

  /**
   * {@inheritdoc}
   */
  public function getFormId(): string {
    return 'drush_module_admin_settings';
  }

  /**
   * {@inheritdoc}
   */
  protected function getEditableConfigNames(): array {
    return ['drush_module.settings'];
  }

  /**
   * {@inheritdoc}
   */
  public function buildForm(array $form, FormStateInterface $form_state): array {
    $form['example'] = [
      '#type' => 'textfield',
      '#title' => $this->t('Example'),
      '#default_value' => $this->config('drush_module.settings')->get('example'),
    ];
    return parent::buildForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function validateForm(array &$form, FormStateInterface $form_state): void {
    // @todo Validate the form here.
    // Example:
    // @code
    //   if ($form_state->getValue('example') === 'wrong') {
    //     $form_state->setErrorByName(
    //       'message',
    //       $this->t('The value is not correct.'),
    //     );
    //   }
    // @endcode
    parent::validateForm($form, $form_state);
  }

  /**
   * {@inheritdoc}
   */
  public function submitForm(array &$form, FormStateInterface $form_state): void {
    $this->config('drush_module.settings')
      ->set('example', $form_state->getValue('example'))
      ->save();
    parent::submitForm($form, $form_state);
  }

}
