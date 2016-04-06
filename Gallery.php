<?php
namespace cmsgears\widgets\gallery;

use \Yii;
use yii\base\Widget;
use yii\helpers\Html;

use cmsgears\core\common\services\resources\GalleryService;

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

        if( isset( $gallery ) && $gallery->active ) {

			$galleryHtml	= $this->renderWidget( [ 'gallery' => $gallery ] );

	        return Html::tag( 'div', $galleryHtml, $this->options );
		}
    }

	public function renderWidget( $config = [] ) {

		$gallery		= $config[ 'gallery' ];
		$items 			= [];
		$galleryHtml	= '';

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

		return $galleryHtml;
	}
}

?>