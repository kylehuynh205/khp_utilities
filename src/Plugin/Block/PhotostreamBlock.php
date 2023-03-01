<?php

namespace Drupal\utilities\Plugin\Block;

use Drupal\Core\Block\BlockBase;

/**
 * Provides a 'PhotostreamBlock' block.
 *
 * @Block(
 *  id = "photostream_block",
 *  admin_label = @Translation("Photostream"),
 * )
 */
class PhotostreamBlock extends BlockBase {

    /**
     * {@inheritdoc}
     */
    public function build() {
        $nids = \Drupal::entityQuery('node')
                ->accessCheck(FALSE)
                ->condition('type', 'flickr_photo')
                ->sort('field_date_uploaded' , 'DESC')
                //->pager('70')
                ->execute();
        
        $nodes =  \Drupal\node\Entity\Node::loadMultiple($nids);
        return [
            'results' => [
                '#theme' => 'photostream_block',
                '#photos' => $nodes,
                '#path' => base_path()
            ],
            /*'pager' => [
                '#type' => 'pager',
            ],*/
        ];
        //return $build;
    }

}
