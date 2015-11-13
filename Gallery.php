<?php
namespace cmsgears\widgets\gallery;

use \Yii;
use yii\base\Widget;
use yii\base\InvalidConfigException;
use yii\helpers\Html;

use cmsgears\core\common\services\GalleryService;

// TODO: Add a bootstrap view apart from cmgtools

class Gallery extends \cmsgears\core\common\base\Widget {

	// Variables ---------------------------------------------------

	// Public Variables --------------------

	/**
	 * The gallery name.
	 */
    public $galleryName;

	// Constructor and Initialisation ------------------------------

	// yii\base\Object

    public function init() {

        parent::init();

		// Do init tasks
    }

	// Instance Methods --------------------------------------------

	// yii\base\Widget

	/**
	 * @inheritdoc
	 */
    public function run() {

        if( !isset( $this->galleryName ) ) {

            throw new InvalidConfigException( 'Gallery name is required.' );
        }

		$gallery		= GalleryService::findByName( $this->galleryName );
		$items 			= [];
		$galleryHtml	= '';

        if( !isset( $gallery ) ) {

            throw new InvalidConfigException( "Gallery does not exist. Please create it via admin having name set to $this->galleryName." );
        }

		// Paths
		$wrapperPath	= $this->template . "/wrapper";
		$itemPath		= $this->template . "/item";

		// Generate Items Html

		$gitems = $gallery->files;

        foreach( $gitems as $item ) {

            $items[] = $this->render( $itemPath, [ 'item' => $item ] );
        }

		$itemsHtml		= implode( "\n", $items );
		$galleryHtml	= $this->render( $wrapperPath, [ 'gallery' => $gallery, 'itemsHtml' => $itemsHtml ] );

        return Html::tag( 'div', $galleryHtml, $this->options );
    }
}

?>