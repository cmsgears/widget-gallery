<?php
namespace cmsgears\widgets\gallery;

use \Yii;
use yii\base\Widget;
use yii\base\InvalidConfigException;
use yii\helpers\Html;

use cmsgears\core\common\services\GalleryService;

// TODO: Add a bootstrap view apart from cmgtools

class Gallery extends Widget {

	// Variables ---------------------------------------------------

	// Public Variables --------------------

	/**
	 * The html options for the parent container.
	 */
	public $options;

	/**
	 * The path at which view file is located. It can have alias. By default it's the views folder within widget directory.
	 */
	public $viewPath	= null;

	/**
	 * The view file used to render widget.
	 */
	public $view		= 'simple';

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
	 * The method returns the view path for this widget if set while calling widget. 
	 */
	public function getViewPath() {

		if( isset( $this->viewPath ) ) {

			return $this->viewPath;
		}

		return parent::getViewPath();
	}

	/**
	 * @inheritdoc
	 */
    public function run() {

        if( !isset( $this->galleryName ) ) {

            throw new InvalidConfigException( "Gallery name is required." );
        }

		$gallery	= GalleryService::findByName( $this->galleryName );
		$items 		= [];

		// Paths
		$wrapperPath	= $this->view . "/wrapper";
		$itemPath		= $this->view . "/item";

		if( isset( $gallery ) ) {

			// Generate Items Html

			$gitems = $gallery->files;
	
	        foreach( $gitems as $item ) {
	
	            $items[] = $this->render( $itemPath, [ 'item' => $item ] );
	        }
		}
		else {

			echo "<p>Gallery does not exist. Please create it via admin having name set to $this->galleryName.</p>";
		}

		$itemsHtml		= implode( "\n", $items );
		$galleryHtml	= $this->render( $wrapperPath, [ 'gallery' => $gallery, 'itemsHtml' => $itemsHtml ] );

        return Html::tag( 'div', $galleryHtml, $this->options );
    }
}

?>