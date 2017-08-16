<?php
/**
 * @file
 * Contains \Drupal\hello\HelloController.
 */

namespace Drupal\post_list_block\Controller;


use Drupal\Core\Controller\ControllerBase;


class PostListController extends ControllerBase {
  public function content() {
    // return array(
    //     '#markup' => '' . t('Hello there!') . '',
    // );

     // $events = 'test';
        
     //    return [
     //        '#theme' => 'events_listing_display',
     //        '#events' => $events,
     //    ];
  }

  public function events () {
		$events = "My Custom events";
        return [
        	'#theme' => 'post_list_block',
        	'#source_text' => $events,
        ];
	}


}