<?php

namespace Drupal\post_list_block\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Block\BlockPluginInterface;
use Drupal\Core\Form\FormStateInterface;

/**
 * Provides a 'Hello' Block.
 *
 * @Block(
 *   id = "PostList_block",
 *   admin_label = @Translation("PostList block"),
 *   category = @Translation("PostList World"),
 * )
 */
class PostListBlock extends BlockBase implements BlockPluginInterface{

  /**
   * {@inheritdoc}
   */
  public function build() {
    // $config = $this->getConfiguration();

    // if (!empty($config['post_list_block_name'])) {
    //   $post_name = $config['post_list_block_name'];
    // }
    // else {
    //   $post_name = $this->t('to no one');
    // }
    // return array(
    //   '#markup' => $this->t('Post: @post_name!', array (
    //       '@post_name' => $post_name,
    //     )
    //   ),
    // );
  }

   /**
   * {@inheritdoc}
   */
  public function defaultConfiguration() {
    $default_config = \Drupal::config('post_list_block.settings');
    return array(
      'post_list_block_name' => $default_config->get('post.name'),
    );
  }

  /**
   * {@inheritdoc}
   */
  public function blockForm($form, FormStateInterface $form_state) {
    $form = parent::blockForm($form, $form_state);

    $config = $this->getConfiguration();

    $form['post_list_block_name'] = array(
      '#type' => 'textfield',
      '#title' => $this->t('Who'),
      '#description' => $this->t('Add a Post title?'),
      '#default_value' => isset($config['post_list_block_name']) ? $config['post_list_block_name'] : '',
    );

    return $form;
  }

    /**
   * {@inheritdoc}
   */
  public function blockSubmit($form, FormStateInterface $form_state) {
    parent::blockSubmit($form, $form_state);
    $values = $form_state->getValues();
    $this->configuration['post_list_block_name'] = $values['post_list_block_name'];
  }

}